<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author ifuk permana
 * @copyright 2010
 * @description create auto breadcrumbs navigation
 * @path /application/helpers/breadcrum.php
 */

include_once( BASEPATH . '/helpers/url_helper'.EXT);

if ( ! function_exists('create_breadcrumb'));

function create_breadcrumb($url_base="",$url=""){

	if($url_base == "" && $url == "")
	{
		return false;
	}
	$ci =& get_instance();
	
	$ci->load->helper('string');
	
	$link = uri_string($url);

	$base = $url_base;
	
	$slice = explode("/",$link);
	$print_link = "<ul id=\"breadcrumb\">";
	
	$print_link.="<li><a href=\"".$base."\"><img src=\"".base_url()."asset/images/home.gif\" alt=\"Home\" class=\"home\" /></a></li>";
	
	for($i=1;$i<count($slice);$i++):
	
			if($i == count($slice)-1)
			{
				$print_link.= "<li>".ucfirst($slice[$i])."</li>";
			} else {
				$print_link.= "<li><a href=index.php\"".reduce_double_slashes($base.$slice[$i-1]."/".$slice[$i])."\">".ucfirst($slice[$i])."</a></li>";
			}
			
	endfor;
	
	$print_link.="</ul>";
	
    return $print_link;

}

