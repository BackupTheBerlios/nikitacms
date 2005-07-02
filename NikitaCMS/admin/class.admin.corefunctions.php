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
	var $mysql;
	var $template;
	var $kernel;
	function admin_core($mysql, $template, $kernel) {
		$this->mysql = &$mysql;	
		$this->template = &$template;
		$this->kernel = &$kernel;
	}
	function check_login() {
		$status = 0;
		if(isset($_GET['action']) && $_GET['action'] == 'admin_login') {
			$q = 'SELECT username, passwort  FROM ' . _PREF . 'users WHERE username=\''. $_POST['nick'] .'\' AND passwort =\''. md5($_POST['passwort']) .'\';';
			$this->mysql->query($q);
			if($this->mysql->get_row_count() == 1) {
				$status = 1;	
			} else {
				$status = -1;	
			}
		}
		elseif(isset($_COOKIE['admin_nick'])) {
			// Cookie testen
			$q = 'SELECT username, passwort  FROM ' . _PREF . 'users WHERE username=\''. $_COOKIE['admin_nick'] .'\' AND passwort =\''. $_COOKIE['admin_pw'] .'\';';
			$this->mysql->query($q);
			if($this->mysql->get_row_count() == 1) {
				$status = 2;	
			} else {
				$status = -2;	
			}
		} else {
			// login_formular
			$status = 0;
		}
		switch($status) {
			case 1: // erstes login, cookie setzen
				setcookie('admin_nick',$_POST['nick'],_COOKIE_EXPIRE);
				setcookie('admin_pw',md5($_POST['passwort']),_COOKIE_EXPIRE);
			break;
			case 2: // login per cookie, cookie auffrischen & haupt-page laden
				define('_ADMIN_SECURE',1);
				setcookie('admin_nick',$_COOKIE['admin_nick'],_COOKIE_EXPIRE);
				setcookie('admin_pw',$_COOKIE['admin_pw'],_COOKIE_EXPIRE);
				$this->loadNavigation();
				$this->loadMainframe();
			break;
			case -1: // login falsch
				$this->template->showLoginform();	
			break;
			case -2: // cookie enthält falsche Daten
				setcookie('admin_nick','');
				setcookie('admin_pw','');
			break;	
			default: 
				$this->template->showLoginform();
		}
	}	
	
	function loadNavigation() {
		$q = 'SELECT * FROM ' . _PREF . 'modules WHERE 1';
		$this->mysql->query($q);
		$data = $this->mysql->get_rows();
		$this->template->addMenuEntry('Home','index.php');
		$this->template->addMenuEntry('Module','-');
		foreach($data as $k => $v) {
			$this->template->addMenuEntry($v['name'],'index.php?action=mod&id='. $v['module_id']);
		}
		$q = 'SELECT * FROM ' . _PREF . 'extensions WHERE 1';
		$this->mysql->query($q);
		$data = $this->mysql->get_rows();
		$this->template->addMenuEntry('Erweiterungen','-');
		foreach($data as $k => $v) {
			$this->template->addMenuEntry($v['title'],'index.php?action=ext&id='. $v['extension_id']);
		}
	}
	function loadMainFrame() {
		if(!isset($_GET['action'])) {
			$this->template->headLine('Willkommen!');
			$this->template->descr(_ADMIN_GREETING);
		} else {
			if($_GET['action'] == 'mod') {
				$q = 'SELECT * FROM ' . _PREF . 'modules WHERE module_id=' . $_GET['id'];
				$this->mysql->query($q);
				$module = $this->mysql->fetch_array();
				$mod_admin_class = '';
				include ('../modules/'.$module['class_name'].'/'.$module['class_name'].'.php');
				$mod_content = '';
				eval ('$mod_admin_class = new admin_'.$module['class_name'].'($this);'); // modul_klasse aufrufen und $this übergeben (db, template, session usw)
				switch($_GET['do']) {
					case 'add':
						$mod_admin_class->add();
						break;
					case 'saveadd':
						$mod_admin_class->saveAdd();
						break;
					case 'edit':
						$mod_admin_class->edit();
						break;
					case 'saveedit':
						$mod_admin_class->saveEdit();
						break;
					default:
						$mod_admin_class->handleAdmin();	
				}
				
			} elseif($_GET['action'] == 'ext') {
				$this->mysql->query('SELECT * FROM ' . _PREF . 'extensions WHERE extension_id=' . $_GET['id']);
			} else {
				$this->template->error(_WRONG_LINK);	
			}
			
			
		}
	}
	function renderPage() {			
//			$a_queries = $this->mysql->_get_queries();
//			$this->template->add_debug(count($a_queries) . 'Queries ausgeführt.<br />');	
//			foreach ($a_queries as $k) {
//				$this->template->add_debug($k . '<br />');	
//			}
			$a_debug = $this->mysql->_get_debug();
			foreach ($a_debug as $k) {
				$this->template->add_debug($k . '<br />');	
			}
		$this->template->runTemplate('default');	
	}
}
?>
