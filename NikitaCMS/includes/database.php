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



class mysql {
	var $l_id;
	var $q_id;
	var $queries = array();
	var $debug = array();
	function mysql($host, $db, $user, $pass) {
		$this->l_id = mysql_connect($host, $user, $pass);
		if(mysql_select_db($db, $this->l_id)) {
			$this->debug[] = 'Mysql Datenbank ausgewählt.';	
		} else {
			$this->debug[] = '<font color="red">FEHLER: Mysql Datenbank NICHT ausgewählt.</font>';
		}
	}
	
	function query($str) {
		$this->q_id = mysql_query($str, $this->l_id);
		if($this->q_id) {
			$this->debug[] = '<font color="green">Query "'. $str .'" erfolgreich ausgeführt.</b>';	
		} else {
			$this->debug[] = '<font color="red">FEHLER: Query "'. $str .'" <b>NICHT</b> erfolgreich ausgeführt.</font>';
		}
		$this->queries[$this->q_id] = $str;
		return $this->q_id;
	}
	function get_row_count($query_id = 0) {
		return mysql_affected_rows($this->l_id);
	}
	function fetch_array($query_id = 0) {
		return mysql_fetch_array(($query_id != 0 ? $query_id : $this->q_id),MYSQL_ASSOC);
	}
	function get_row($query_id = 0) {
		return mysql_fetch_row(($query_id != 0 ? $query_id : $this->q_id));
	}
	function get_rows($query_id = 0) {
		$ret = array ();
		while ($row = mysql_fetch_array(($query_id != 0 ? $query_id : $this->q_id))) {
			$ret[] = $row;
		}
		return $ret;
	}
	
	function _get_debug() {
		return $this->debug;	
	}
	function _get_queries() {
		return $this->queries;	
	}
}
?>