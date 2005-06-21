<?php
/*
 * @file navigation.php, created on 19.06.2005
 * 
 * Copyright (C) 2005 Philipp Ittershagen
 * 
 */
 class navigation_output {
 	function navItem($name, $page_id, $act_page_id) {
 		return HTML::div('menu_item',HTML::span('menu_link',HTML::a('index.php?id='.$page_id, $name)));
 	}	
 	
 }
 
 class navigation {
 	var $hK;
 	
 	function navigation($kernel_handler){
 		$this->hK = &$kernel_handler;	
 	}
 	
 	function show($page_id) {
 		$this->hK->database->query('SELECT * FROM '. _PREF .'navigation ORDER BY order_nr ASC;');
 		$ret = '';
 		while($row = $this->hK->database->fetch_array()) {
 			$ret .= navigation_output::navItem($row['title'], $row['navigation_id'], $page_id);
 		}
 		return $ret;
 	}
 }
?>
