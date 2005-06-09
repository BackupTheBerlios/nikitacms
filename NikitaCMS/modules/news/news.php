<?php
/*
 * @file news.php, created on 09.04.2005
 * 
 * kijoto v0.1
 * 
 * Copyright (C) 2005 Philipp Ittershagen
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

class news_output {
	function show_news($title, $text, $author, $date) {
		$ret = HTML::div('title', $this->hK->bbcode->safe_text($title));
		$ret .= HTML::div('author', str_replace('%name%', $author, _CREATED_BY));
		$ret .= HTML::div('createdate',str_replace('%datum%', strftime('%d.%m.%Y',$date), _CREATED_ON));
		$ret .= HTML::div('content', $this->hK->bbcode->parse($text));
		return HTML::div('news_container', $ret);
	}
	function show_nav($act_page, $pages) {
	}
	
}


class news {
	var $hK;
	var $vars = array();
	var $config = array();
	
	function news($kernel_handler) {
		$this->hK = &$kernel_handler;
		$this->vars = $this->hK->getParams(array('option', 'page', 'news_id'));
		$this->hK->database->query('SELECT news_per_page FROM '. _PREF.'mod_news_cfg WHERE 1');
		$this->config = $this->hK->database->fetch_array();
	}
	
	function show($page_id) {
		$limit = '';
		$where = '';
		if(!empty($this->vars['page'])) {
			$limit = 'LIMIT '. ($this->vars['page'] - 1) * $this->config['news_per_page'] . ','. $this->config['news_per_page'];	
		}	
		if(!empty($this->vars['news_id'])) {
			$where = 'WHERE news_id = ' . $this->vars['news_id'];
		}
		
		$q = 	'SELECT * ' .
				'FROM '._PREF .'mod_news_content '. 
				$where . ' ' . 
				$limit;
				
		$this->hK->database->query($q);
		
		$ret = '';
		while($row = $this->hK->database->fetch_array()) {
			$ret .= news_output::show_news($row['title'], $row['text'], $row['author'], $row['date']);
		} 
		return $ret;
	}	
}
?>
