<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ifuk Permana
 * @copyright 2019
 * @script Users Admin Controller
 * --------------------------------------------------------------------------
 *  Administration Users
 * --------------------------------------------------------------------------
 *		Module Controller Admin for Users
 * 
 */

class Users extends MY_AdminController {
	
    function __construct()
    {
        parent::__construct();
     
        $this->load->library(array('ion_auth','form_validation'));
		$this->load->helper('language');
		
		$this->lang->load('auth');
        
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect(site_url('admin/auth/login'), 'refresh');
        }
        
        if(!in_array('accessModUser', $this->_user_permission)) {			
            $this->session->set_flashdata('error','Sorry you don\'t have permission to see that page');
            redirect('admin/home/not_allowed', 'refresh');
        }
		
    }

    public function index()
    {        

		$data['users'] = $this->ion_auth->users()->result();

		foreach ($data['users'] as $k => $user)
		{
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}

        $data['message'] = $this->session->flashdata('success');
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

        $this->output->append_title('User List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
        $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->section('flashdata','themes/'.$this->_template['themes'].'/static/notification');
        $this->load->js('assets/js/mod_user.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/users/list_users', $data);

    }
    
    public function view($id)
    {
        $get = $this->ion_auth->user($id)->row();
        
        $get_group = $this->ion_auth->get_users_groups($get->id)->row();
        
        if ($get != FALSE) {

			foreach($get as $key => $value):
				$data[$key] = $value;
			endforeach;
			$data['group_user'] = $get_group->id;
			$data['readonly'] = 'readonly';
			$data['groups'] = $this->ion_auth->groups()->result();
			
            $this->output->append_title('View Users');
              
            $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
            $this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
				   
		   	$this->load->view('themes/'.$this->_template['themes'].'/layout/users/form_user', $data);

        } else {

            $this->session->set_flashdata('error',  $this->ion_auth->errors());

            redirect('admin/users');
        }
    }
    
    public function create_user()
    {
        $data = array(
            'button' => 'Create',
            'form_action' => site_url('admin/users/save_user'),
            'readonly' => '',
            'username' => set_value('username'),
            'email' => set_value('email'),
            'first_name' => set_value('first_name'),
            'last_name' => set_value('last_name'),
			'group' => set_select('group'),
			'phone' => set_value('phone'),
            'id_user' => ''
        );

        $data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
        );
        
        $data['groups'] = $this->ion_auth->groups()->result();
        
        $this->_init_form();
        
        $this->output->append_title('Create User');

        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
                
        $this->load->view('themes/'.$this->_template['themes'].'/layout/users/form_user', $data);
    }
    
    public function save_user()
    {

		$this->_rules();
		
        if ($this->form_validation->run() == FALSE) {			
			$this->create_user();
        } else {

            $username = $this->input->post('username', TRUE);
            $password  = $this->input->post('password', TRUE);
            $email = $this->input->post('email', TRUE);
            $first_name = $this->input->post('first_name', TRUE);
            $last_name = $this->input->post('last_name', TRUE);
            $group = array($this->input->post('group', TRUE));
            
            $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'phone' => $this->input->post('phone')
            );
            
            $add = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

            if($add != FALSE)
            {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect(site_url('admin/users'));
            }
            else
            {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect(site_url('admin/users'));
            }

            
        }
    }
    
    public function edit($id)
    {

        $get = $this->ion_auth->user($id)->row();
        
        $get_group = $this->ion_auth->get_users_groups($get->id)->row();
        
        if ($get != FALSE) {
            $data = array(
                'button' => 'Back',
                'form_action' => site_url('admin/users/update'),
                'readonly' => '',
                'username' => $get->username,
                'email' => $get->email,
                'first_name' => $get->first_name,
                'last_name' => $get->last_name,
				'group_user' => $get_group->id,
				'phone' => $get->phone,
                'id_user' => $get->id
	       );       
		
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$data['groups'] = $this->ion_auth->groups()->result();

        $this->output->append_title('Ubah Pengguna');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
                
        $this->load->view('themes/'.$this->_template['themes'].'/layout/users/form_edit_user', $data);

        } else {

            $this->session->set_flashdata('error',  $this->ion_auth->errors());

            redirect(site_url('admin/users'));
        }
    }

    public function update()
    {

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_user', TRUE));
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name',TRUE),
				'last_name' => $this->input->post('last_name',TRUE),
				'username' => $this->input->post('username', TRUE),
				'email' => $this->input->post('email', TRUE),
				'phone' => $this->input->post('phone', TRUE)
			);
			
			if($this->input->post('password'))
			{
				$data['password'] = $this->input->post('password');
			}

            $update = $this->ion_auth->update($this->input->post('id_user', TRUE), $data);

            if($update == TRUE)
            {
				if($this->input->post('old_group_id') != $this->input->post('group'))
				{
					//remove first
					$this->ion_auth->remove_from_group($this->input->post('old_group_id'), $this->input->post('id_user'));
					//add new
					$this->ion_auth->add_to_group($this->input->post('group'), $this->input->post('id_user'));
				}

                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect(site_url('admin/users'));
            }
            else
            {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect(site_url('admin/users'));
            }

            redirect(site_url('user'));
        }
    }

    public function delete()
    {
		
		$this->output->unset_template();

		if($this->input->post())
		{
			$id = $this->input->post('id_user');
		
			$delete = $this->ion_auth->delete_user($id);

			if($delete == TRUE)
			{
					$response['success'] = true;
					$response['messages'] = "Data berhasil dihapus.";
			}
			else
			{
					$response['success'] = false;
					$response['messages'] = "Terjadi kesalahan pada database. Hubungi administrator.";
			}
		}
		else
		{
			$response['success'] = false;
			$response['messages'] = "Refresh the page again!!";
		}

		$this->output
        ->set_content_type('application/json')
		->set_output(json_encode($response));		
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
			redirect("admin/auth/login", 'refresh');
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
			redirect('admin/users', 'refresh');
		}
    }
    
	public function index_group()
	{
		$data['groups'] = $this->ion_auth->groups()->result();
        
		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

        $this->output->append_title('Group List');
        
        $this->load->section('head','themes/'.$this->_template['themes'].'/static/top_nav');
		$this->load->section('menu','themes/'.$this->_template['themes'].'/static/side_menu');
        $this->load->js('assets/js/mod_user.js');

        $this->load->view('themes/'.$this->_template['themes'].'/layout/users/list_group', $data);

	}

	/**
	 * Create a new group
	 */
	public function create_group()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$data = array(            
            'form_action' => site_url('user/save_group'),
            'group_name' => set_value('group_name'),
            'description' => set_value('description')            
        );
        $data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
      
        $this->output->append_title('Create Group');
        $this->load->section('head','themes/adminlte/static/header');
		$this->load->section('menu','themes/adminlte/static/sidemenu');
                
		$this->load->view('themes/adminlte/pages/user/form_group',$data);		
	}

	/**
	 * View Group
	 */
	public function view_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		$data = array(            
            'form_action' => '#',
            'group_name' => $group->name,
			'description' => $group->description,
			'permission' => $group->permission,
			'id_group' => $group->id,
			'readonly' => 'readonly'        
        );
      
        $this->output->append_title('View Group');
        $this->load->section('head','themes/adminlte/static/header');
		$this->load->section('menu','themes/adminlte/static/sidemenu');
                
		$this->load->view('themes/adminlte/pages/user/view_group',$data);
		
	}

	public function save_group()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		if($this->input->post())
		{
			$this->_rules_group();

			if ($this->form_validation->run() == FALSE) {								
				$this->create_group();
			} else {
	
				$name = $this->input->post('group_name', TRUE);
				$description = $this->input->post('description', TRUE);
				
				$additional_data = array(
					'permission' => json_encode($this->input->post('permission', TRUE))
				);
				
				$add = $this->ion_auth->create_group($name, $description, $additional_data);
	
				if($add != FALSE)
				{
					$this->session->set_flashdata('success', $this->ion_auth->messages());
					redirect(site_url('user/index_group'));
				}
				else
				{
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect(site_url('user/create_group'));
				}
	
				
			}
		}
	}

	/**
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		$data = array(            
            'form_action' => site_url('user/update_group'),
            'group_name' => $group->name,
			'description' => $group->description,
			'permission' => $group->permission,
			'id_group' => $group->id            
        );
        $data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
      
        $this->output->append_title('Create Group');
        $this->load->section('head','themes/adminlte/static/header');
		$this->load->section('menu','themes/adminlte/static/sidemenu');
                
		$this->load->view('themes/adminlte/pages/user/edit_group',$data);
		
	}

	public function update_group()
	{		
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		if($this->input->post())
		{
			$this->_rules_group();

			$id = $this->input->post('id_group', TRUE);

			if ($this->form_validation->run() !== TRUE)
			{
				$this->edit_group($id);
			}
			else
			{
				$group_name = $this->input->post('group_name', TRUE);
				$description = $this->input->post('description', TRUE);
				
				$additional_data = array(
					'permission' => json_encode($this->input->post('permission', TRUE)),
					'description' => $description
				);

				$group_update = $this->ion_auth->update_group($id, $group_name, $additional_data);

				if ($group_update)
				{
					$this->session->set_flashdata('success', $this->lang->line('edit_group_saved'));
					redirect('user/index_group', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('user/edit_group/'.$id, 'refresh');
				}				
			}
		}
	}

	public function delete_group()
    {
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		
		$this->output->unset_template();

		if($this->input->post())
		{
			$id = $this->input->post('id_group');
		
			$delete = $this->ion_auth->delete_group($id);

			if($delete == TRUE)
			{
					$response['success'] = true;
					$response['messages'] = "Data group berhasil dihapus.";
			}
			else
			{
					$response['success'] = false;
					$response['messages'] = "Terjadi kesalahan pada database. Hubungi administrator. Code :".$this->ion_auth->messages();
			}
		}
		else
		{
			$response['success'] = false;
			$response['messages'] = "Refresh the page again!!";
		}

		$this->output
        ->set_content_type('application/json')
		->set_output(json_encode($response));		
    }
    
    public function _rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('group', 'User Group', 'trim|required|integer');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('password_confirm', 'Re-Password', 'trim|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
	
	public function _rules_group()
    {
        $this->form_validation->set_rules('group_name', 'Nama Group', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('permission[]', 'Permission', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    
    public function _init_template()
    {
        $this->output->set_template('adminlte/static/masterpage');
		$this->output->set_title('First Hijab Stock System');
    }
    
    public function _init_form()
    {
        // additional css or js for form
    }
    
}