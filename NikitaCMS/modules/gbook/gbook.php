<?php
/*
 * @file gbook.php, created on 19.06.2005
 * 
 * Copyright (C) 2005 Philipp Ittershagen
 * 
 */
 
 
class gbook_output {
	
	
}

class gbook {
	var $hK;
	function gbook($kernel_handler) {
		$this->hK = &$kernel_handler;
	}	
	
	
	function show() {
		$q = 'SELECT name, datum, message, email, homepage FROM '. _PREF .'mod_gbook ORDER BY datum DESC LIMIT 0,25';
		$this->hK->database->query();	
		
	}
}
?>
