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
 
 
class output_content {
	function show($row) {
		// hier bbcode etc...
		return $row['text'];
	}
}


class content {
	var $h_kernel;
	function content($kernel_handler) {
		$this->h_kernel = &$kernel_handler;
	}
	
	function show($page_id) {
		$this->h_kernel->database->query('SELECT * FROM '._PREF.'_mod_content WHERE page_id = '.$page_id.';');
		$content = '';
		while($row = $this->h_kernel->database->fetch_array()){
			$content .= output_content::show($row);
		} // while
		return $content;
	}
	
	function add($text, $page_id) {
	
	
	}
	
	function change($text, $page_id) {
	
	
	}
	
	function delete($page_id) {
	
	
	}
}
?>