<?php
/*
 * NikitaCMS
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
 
 
/* @TODO: alles, nur nen dummy für debug */
class template {
	var $content = array();
	var $a_modules = array();
	var $a_extensions = array();
	var $i = 0;
	var $debug = '';
	var $site_path = _PATH;
	/* zeigt ein Modul auf der aktuellen Seite an */
	function add_module($mod_content) {
		$this->content[] = $mod_content;
	}
	function add_debug($text) {
		$this->debug .= $text;	
	}
	/* läd eine extension in das template, und zwar an den im template vorgemerkten Ort $ext_position */
	function add_extension($ext_position, $ext_title, $ext_content, $ext_style_class = '') {
	$this->a_extensions[$ext_position][$this->i]['title'] = $ext_title;
	$this->a_extensions[$ext_position][$this->i]['content'] = $ext_content;
	$this->a_extensions[$ext_position][$this->i]['style_class'] = $ext_style_class;
	++$this->i;
	}
	/* zeigt die ganze Seite an */

	function countExtensions($ext_position) {
		if(!empty($this->a_extensions[$ext_position])) {
			return count($this->a_extensions[$ext_position]);
		}
		else {
			return 0;	
		}
	}
	
	function showHeader() {
		echo '<title>default</title>';	
	}

	function showBody() {
		foreach($this->content as $cont) {
			echo $cont;	
		}
	}
	
	function showExtensions($ext_position) {
		$output = '';
		if(empty($this->a_extensions[$ext_position])) {
			echo 'no extensions for position ' . $ext_position;	
			return 0;
		}
		foreach($this->a_extensions[$ext_position] as $a_ext) {
			if(!empty($a_ext['style_class'])) {
				$style = $a_ext['style_class'];	
			} else {
				$style = 'ext_';
			}
			$output .= '<div class="'. $style .'container">' . "\n";
			if(!empty($a_ext['title'])) {
				$output .= "\t" . '<div class="'. $style .'title">'. $a_ext['title'] . '</div>' . "\n";
			}
			$output .= "\t" . '<div class="'. $style .'content">'. $a_ext['content'] .'</div>' . "\n";
			$output .= '</div>'. "\n";
		}
		echo $output;
	}
	
	function showDebug() {
		echo $this->debug;	
	}
	
	function runTemplate($template_name) {
		include('templates/'. $template_name .'/index.php');
	}
}

?>