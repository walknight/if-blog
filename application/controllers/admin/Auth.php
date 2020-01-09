<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 */

class Auth extends MY_Controller{

    protected $default_template = 'themes/admin';

    function __construct()
    {
        parent::__construct();
		
		$this->_init_template();        
		
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->lang->load('auth');
    }

    /**
	 * Initiation base template and base title
	 */
    public function _init_template()
    {
        $this->output->set_template('admin/masterpagelogin');
		$this->output->set_title('Administration Page');
    }

    /**
	 * Login the user
	 */
    function login()
    {
		$this->output->append_title('Login');
		
		if ($this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/dashboard', 'refresh');
        }
        
        $data['identity'] = set_value('identity');        
		$data['form_action'] = site_url('admin/auth/login');

		if($this->input->post())
        {
            $this->_rules();
            
            if ($this->form_validation->run() !== TRUE)
            {	
				$this->session->set_flashdata('error', validation_errors());
				redirect('admin/auth/login', 'refresh');
                //$this->login();   
            }
            else
            {
                $username = $this->input->post('identity');
                $password = $this->input->post('password');
                $remember = (bool) $this->input->post('remember');
				
				
                if($this->ion_auth->login($username, $password, $remember))
                {															
					$this->session->set_flashdata('success', $this->ion_auth->messages());
					$home_url = "";
					
					if($this->ion_auth->in_group('admin'))
					{
						$home_url = site_url("admin/dashboard");
						$this->session->set_userdata('home_url',$home_url);
						redirect($home_url, 'refresh');
					}
					else
					{
						$home_url = site_url("admin/welcome");
						$this->session->set_userdata('home_url',$home_url);
						redirect($home_url, 'refresh');
					}
					
					
                }
                else
                {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
				    redirect('admin/auth/login', 'refresh'); 
                }
            }
                            
        }
		
		// Check for remember_me data in retrieved session data
		$check_remember = $this->session->remember_me;
		
        if (isset($check_remember) && $check_remember == "1") {

            redirect('admin/dashboard', 'refresh');
		}

		$this->load->view($this->default_template.'/layout/auth/login_page', $data);
    }

     /**
	 * Logout the user
	 */

    function logout()
    {
		if ($this->ion_auth->logged_in())
		{
            $this->ion_auth->logout();
            $this->session->set_flashdata('success','You are logged out!');
            
			redirect('admin/auth/login');
		}
    }

    /**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$this->output->append_title($this->lang->line('forgot_password_heading'));
		$data['form_action'] = site_url('auth/forgot_password');
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE)
		{
			$data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
			];

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            
            $this->load->view($this->default_template.'/layout/auth/forgot_password', $data);
		}
		else
		{          
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect("admin/auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect("admin/auth/forgot_password", 'refresh');
			}
		}
	}

    /**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		$activation = FALSE;

		if ($code !== FALSE)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("admin/home/login", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	public function _rules()
    {
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

    }

}