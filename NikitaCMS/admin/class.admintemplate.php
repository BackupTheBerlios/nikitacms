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
	function addContent($content) {
		$this->content .= $content;	
	}

	function addMenuEntry($entry, $link) {
		$this->aMenu[$entry] = $link;	
	}	
	
	function showAdminMenu() {
		foreach($this->aMenu as $entry => $link) {
			echo '<a class="menu_entry" href="'. $link .'">' . $entry . '</a>' . "\n";
		}	
		
	}
	
	function showContent() {
		echo $this->content; 
	}
	function runTemplate($template_name) {
		
		include('templates/'. $template_name .'/index.php');		
	}	
	
	function showLoginform() {
		echo HTML::div('admin_login_wrapper',HTML::div('admin_login_title',_ADMIN_LOGIN) . HTML::div('admin_login',HTML::startForm('admin_login') . HTML::textField('Nick') . HTML::pwField('Passwort') . HTML::submitButton('Login') . HTML::endForm()));	
	}
	function showDebug() {
		echo $this->debug;	
	}
		function add_debug($text) {
		$this->debug .= $text;	
	}
}
 

?>
