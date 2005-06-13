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

class kernel {
	var $database;
	var $template;
	var $sessionHandler;
	var $a_modules;
	var $bbcode;
	var $path;
	function kernel($db, $template, $path = '') {
		$this->database = $db;
		$this->template = $template;
		$this->path = $path;
		// we have to declare bbcode from now on
		$this->bbcode = new bbcode_define ();

	}
	
	function hasRight($right) {
		
	}
	function loadExtension($name) {
		
	}
	function getParams($a_param_names) {
		$a_ret = array();
		foreach($_REQUEST as $k => $v) {
			if (array_search($k, $a_param_names) != FALSE) {
				$a_ret[$k] = $v;
			}	
		}
		return $a_ret;
	}
	
	function load_extensions($page_id) {
		$this->database->query('SELECT * FROM '._PREF.'extensions WHERE page_id = '. $page_id .' OR page_id=-1;');
		
		$a_extensions = $this->database->get_rows();
		foreach ($a_extensions as $extension) {
				include ($this->path.'/extensions/'.$extension['class_name'].'/'.$extension['class_name'].'.php');
				$ext_content = '';
				eval ('$ext_class = new '.$extension['class_name'].'(&$this);'); // extension_klasse aufrufen und $this übergeben (db, template, session usw)
				eval ('$ext_content = $ext_class->'.$extension['show_func'].'('.$page_id.');');
				$this->template->add_extension($extension['position'],$extension['title'],$ext_content);
		}
	}
	
	function load_modules($page_id) {
		$this->database->query('SELECT * FROM '._PREF.'modules WHERE page_id = '. $page_id .' OR page_id=-1;');
		$a_modules = $this->database->get_rows();
		$modules = array();
		foreach ($a_modules as $module) {
			include ($this->path.'/modules/'.$module['class_name'].'/'.$module['class_name'].'.php');
			$mod_content = '';
			eval ('$this->modules["'. $module['class_name'] .'"] = new '.$module['class_name'].'($this);'); // modul_klasse aufrufen und $this übergeben (db, template, session usw)
			eval ('$mod_content = $this->modules["'. $module['class_name'] .'"]->'.$module['show_func'].'('.$page_id.');');
			$this->template->add_module($mod_content);
		}
	}
	
	function renderPage() {			
			$a_queries = $this->database->_get_queries();
			$this->template->add_debug(count($a_queries) . 'Queries ausgeführt.<br />');	
			foreach ($a_queries as $k) {
				$this->template->add_debug($k . '<br />');	
			}
		$this->template->runTemplate('default');	
	}
	

}
?>