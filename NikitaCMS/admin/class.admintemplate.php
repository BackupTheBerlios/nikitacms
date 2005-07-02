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
 
if(!defined('_SECURE_ACCESS')) {
	die('Zugriff verweigert.');	
}

class admintemplate {
	var $content = '';
	var $aMenu = array();
	var $site_path = _PATH;
	var $debug = '';
	var $i = 0;
	function add_module($content) {
		$this->content .= $content;	
	}

	function addMenuEntry($entry, $link) {
		$this->aMenu[$entry] = $link;	
	}	
	
	function showAdminMenu() {
		foreach($this->aMenu as $entry => $link) {
			if($link == '-') {
				echo '<span class="menu_head">' . $entry . '</span>';
			} else {
				echo '<a class="menu_entry" href="'. $link .'">' . $entry . '</a>' . "\n";
			}
		}	
		
	}
	function headLine($text,$number = 1) {
		$this->add_module('<h'. $number .'>' . $text . '</h'. $number .'>');	
	}
	function descr($text) {
		$this->add_module('<div class="descr">' . $text . '</div>');
	}
	
	function startList($title, $columns, $aColumnNames) {
		$this->content .= $this->headLine($title,2);
		$this->content .= '<table class="list">'."\n".'<tr>'."\n";
		for($i = 0; $i < count($aColumnNames); $i++) {
			$this->content .= '<td><b>'.$aColumnNames[$i].'</b></td>'."\n";	
		}
		$this->content .= '</tr>'."\n";
	}

	function listItem($aRow) {
		static $row = 0;
		if($row % 2) {
			$color = '#fefefe';
		} else {
			$color = '#efefef';
		}
		$this->content .= '<tr bgcolor="'.$color.'">'."\n".'<td>' . implode('</td><td>'."\n".'',$aRow) . '</td>'."\n".'</tr>'."\n";
		$row++; 	
	}
	function endList() {
		$this->content .= '</table>';	
	}	
	function error($descr) {
		$this->content = HTML::div('error_messsage',_ERROR_OCCURED . $descr); 	
	}
	
	function showContent() {
		echo $this->content; 
	}
	function runTemplate($template_name) {
		
		include('templates/'. $template_name .'/index.php');		
	}	
	
	function showLoginform() {
		$this->add_module(HTML::div('admin_login_wrapper',HTML::div('admin_login_title',_ADMIN_LOGIN) . HTML::div('admin_login',HTML::startForm('admin_login') . HTML::textField('Nick') . HTML::pwField('Passwort') . HTML::submitButton('Login') . HTML::endForm())));	
	}
	
	function debug_dump($var) {
		$this->debug .= '<pre>' . var_dump($var) . '</pre>';	
	}	
	
	function showDebug() {
		echo $this->debug;	
	}
		function add_debug($text) {
		$this->debug .= $text;	
	}
	function add_extension($ext_position, $ext_title, $ext_content, $ext_style_class = '') {
	$this->a_extensions[$ext_position][$this->i]['title'] = $ext_title;
	$this->a_extensions[$ext_position][$this->i]['content'] = $ext_content;
	$this->a_extensions[$ext_position][$this->i]['style_class'] = $ext_style_class;
	++$this->i;
	}
}
 

?>
