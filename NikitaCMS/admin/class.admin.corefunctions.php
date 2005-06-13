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

class admin_core {
	var $mysql = '';
	var $template = '';
	var $kernel = '';
	function admin_core($mysql, $template, $kernel) {
		$this->mysql = &$mysql;	
		$this->template = &$template;
		$this->kernel = $kernel;
	}
	function check_login() {
		// wichtige funktionen :D
//		if($this->kernel->loginbox->validUser($_POST['nick'], $_POST['passwort'])) {
//			$this->template->addContent(HTML::adminLoginForm());	
//		} else {
//			
//		}	
	}	
	function renderPage() {			
			$a_queries = $this->mysql->_get_queries();
			$this->template->add_debug(count($a_queries) . 'Queries ausgeführt.<br />');	
			foreach ($a_queries as $k) {
				$this->template->add_debug($k . '<br />');	
			}
			$a_debug = $this->mysql->_get_debug();
			foreach ($a_debug as $k) {
				$this->template->add_debug($k . '<br />');	
			}
		$this->template->runTemplate('default');	
	}
}
?>
