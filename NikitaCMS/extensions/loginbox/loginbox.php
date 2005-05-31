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
include('lang_german.php'); 

class output_loginbox {
	function show_loginbox() {
		$output = _LOGINBOX_WELCOME . "<br/>";
		$output .= HTML::startForm('loginbox');
		$output .= HTML::textField('Name');
		$output .= HTML::pwField('Passwort');
		$output	.= HTML::hiddenField('login','1');
		$output .= HTML::submitButton('Login');
		$output .= HTML::endForm();
		return $output;
	}
	function wrong_login() {
		return HTML::jsPopup(_LOGINBOX_WRONG_LOGIN);	
	}
	function show_loggedin($username) {
		$out = str_replace('%name%', $this->h_kernel->bbcode->safe_text($username), _LOGINBOX_GREETING);
		$out = str_replace('%datum%', strftime('%d.%m.%Y',time()), $out);
		$out = str_replace('%zeit%', strftime('%H:%M',time()), $out);
		$out .= HTML::startForm('loginbox');
		$out .= HTML::submitButton('Logout');
		$out .= HTML::hiddenField('logout','1');
		$out .= HTML::endForm();
		return $out;
	}
	function login_message() {
		return HTML::jspopup(_LOGGEDIN,'index.php');		
	}
	function logout_message() {
		return HTML::jspopup(_LOGGEDOUT,'index.php');		
	}
}

class loginbox {
	/*
	 * @value handle
	 */
	var $h_kernel;
	var $wrong_login = 0;
	var $userdata = array();
	
	function loginbox($kernel_handler) {
		$this->h_kernel= &$kernel_handler;
		
		// ist ein logout im Gange ?
		if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == '1') {
				setcookie('username','');    // cookie daten löschen ...
				setcookie('password','');
				$this->wrong_login = 3;
		}
		
		// ist ein login im gange ?
		if(isset($_REQUEST['login']) && $_REQUEST['login'] == '1') {
			$this->h_kernel->database->query(
					"SELECT * " . 
					"FROM "._PREF."_users " .
					"WHERE username = '". $_REQUEST['name']."' AND passwort='". md5($_REQUEST['passwort']) ."';");
			$row = $this->h_kernel->database->fetch_array();
			if(!empty($row)) {
				$this->userdata = $row;	
				setcookie('username',$row['username'],_COOKIE_EXPIRE);
				setcookie('password',$row['passwort'],_COOKIE_EXPIRE);
				$this->wrong_login = -1;
			} else {
				$this->wrong_login = 1;
			}
		}
		// cookie gucken, ob jemand eingeloggt ist
		if(!empty($_COOKIE['username'])) {
			// login daten des cookies testen
			$this->h_kernel->database->query('SELECT * FROM '._PREF.'_users 
								WHERE username="'.$_COOKIE['username'].'" 
								AND passwort="'.$_COOKIE['password'].'";');
			
			$row = $this->h_kernel->database->fetch_array();
			if(empty($row)) { // cookie daten liefern kein ergebn. bei mysql ?
				//error 
				setcookie('username','');    // cookie daten löschen ...
				setcookie('password','');
				$this->wrong_login = 1; // .. und error handler setzen
			} else {
				// ansonsten alles richtig, user daten speichern...
				$this->userdata = $row;
			}
		} else {
			// not logged in, guest visitor ? set $userdata['user_id'] to -1;
			$this->userdata['user_id'] = -1;
		}
	}
	
	function show($page_id) {
		/* login oder nicht */		
		$content = '';
		
		if($this->wrong_login == 1) {
			return output_loginbox::wrong_login();	
		}
		if($this->wrong_login == -1) {
			return output_loginbox::login_message();
		}
		if($this->wrong_login == 3) {
			return output_loginbox::logout_message();	
		}
		if($this->userdata['user_id'] == -1) {
			$content .= output_loginbox::show_loginbox();
		} else {
			// eingeloggt...
			$content = output_loginbox::show_loggedin($this->userdata['username']);
		}
		return $content;
	
	}
}
?>