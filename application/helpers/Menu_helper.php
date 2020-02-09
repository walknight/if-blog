<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * if-blog
 *
 * @package		Menu Helper
 * @author		Ifuk Permana
 * @copyright	Copyright (c) 2019
 * @link		http://www.ifcode.my.id
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

function print_menu($data, $parent = 0) {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		$html = "\n$tab<ul id=\"nav\">";
		$i++;
		foreach ($data[$parent] as $v) {
			$child = print_menu($data, $v->id);
			$html .= "\n\t$tab<li>";
			$html .= '<a href="'.$v->url.'">'.$v->title.'</a>';
                if ($child) {
					$i--;
					$html .= $child;
					$html .= "\n\t$tab";
				}
			$html .= '</li>';
		}
		$html .= "\n$tab</ul>";
		return $html;
	} else {
		return false;
	}
}
