<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Pagination Config Bootstrap 3 CSS Style
 * 
 */
$config['per_page'] =  10;
$config['query_string_segment'] = 'start';

$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Prev';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['reuse_query_string'] = false;
$config['use_page_numbers'] = false;
$config['use_global_url_suffix'] = true;
$config['attributes'] = array('class' => 'page-link');


/* End of file pagination.php */
/* Location: ./application/config/pagination.php */
