<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Pagination Config Bootstrap 3 CSS Style
 *
 */
//$config['per_page'] =  10;

$config['query_string_segment'] = 'start';

$config['full_tag_open'] = '<div><ul class="pagination pull-right">';
$config['full_tag_close'] = '</ul></div>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Prev';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a>';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['reuse_query_string'] = TRUE;
$config['use_page_numbers'] = TRUE;


/* End of file pagination.php */
/* Location: ./application/config/pagination.php */
