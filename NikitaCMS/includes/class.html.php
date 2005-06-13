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

 
class HTML {
	function textField($name, $value = '', $size = 10) {
		return $name. '<br/> <input size="'. $size . '" class="inputbox" type="text" name="'. strtolower($name) .'" value="'. $value .'"/><br/>';	
	}

	function hiddenField($name, $value) {
		return '<input type="hidden" name="'. strtolower($name) .'" value="'. $value .'"/>';	
	}
	
	function pwField($name, $size = 10) {
		return $name. '<br/> <input size="'. $size . '" class="inputbox" type="password" name="'. strtolower($name) .'"/><br/>';	
	}	

	function submitButton($value) {
		return '<input class="button" type="submit" value="'. $value .'"/>';	
	}
	function startForm($action) {
		return '<form action="index.php?action='.$action.'" method="post" name="'.$action.'">';	
	}
	function endForm() {
		return '</form>';	
	}
	
	function div($class, $content) {
		return '<div class="'. $class .'">' . "\n" . $content . "\n" . '</div>';	
	}
	
	function jsPopup($text, $url = '') {
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		return '<script language="JavaScript">alert("'. $text .'"); window.location.href=\'index.php\';</script>';	
	}
} 

?>
