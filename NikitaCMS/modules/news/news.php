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

class admin_news {
	var $admHnd;
	function admin_news($admin_handler) {
		$this->admHnd = $admin_handler;
	}	
	
	function add() {
		$this->admHnd->template->headLine('News-Modul - News hinzufügen');
		$ret = HTML::startForm($_GET['action'] . '&id=' . $_GET['id'] . '&do=saveadd');
		$ret .= HTML::textField('Titel');
		$ret .= HTML::textArea('Text') . '<br />';
		$ret .= HTML::submitButton('News speichern');
		$ret .= HTML::endForm();
		$this->admHnd->template->add_module($ret);
	}
	
	function saveAdd() {
		$this->admHnd->template->headLine('News-Modul - News speichern');
		$q = 'INSERT INTO `' . _PREF . 'mod_news_content` (`title`, `text`, `date`, `author`) VALUES (\''.$_POST['titel'].'\', \''.$_POST['text'].'\', \''. time() .'\', \''. $_COOKIE['adm_nick'] .'\');';
		if($this->admHnd->mysql->query($q)) {
			$info = 'Der News-Eintrag wurde erfolgreich gespeichert.';	
		} else {
			$info = 'Es scheint ein Problem mit der Datenbankanbindung zu geben. Bitte versuchen sie es später erneut.';	
		}	
		$this->admHnd->template->headLine('Info');
		$this->admHnd->template->descr($info);
		
	}
	function edit() {
		$this->admHnd->template->headLine('News-Modul - News bearbeiten');
		$this->admHnd->mysql->query('SELECT * FROM '._PREF.'mod_news_content WHERE news_id='.$_GET['data_id'].';');
		$data = $this->admHnd->mysql->fetch_array();
		$ret = HTML::startForm($_GET['action'] . '&id=' . $_GET['id'] . '&do=saveedit&data_id=' . $_GET['data_id']);
		$ret .= HTML::textField('Titel',$data['title']);
		$ret .= HTML::textArea('Text',$data['text']) . '<br />';
		$ret .= HTML::submitButton('Änderungen speichern');
		$ret .= HTML::endForm();
		$this->admHnd->template->add_module($ret);
	}
	function saveEdit() {
		$this->admHnd->template->headLine('News-Modul - News speichern');
		$q = 'UPDATE `' . _PREF . 'mod_news_content` SET `title`=\''.$_POST['titel'].'\', `text`=\''.$_POST['text'].'\' WHERE `news_id`='.$_GET['data_id'].';';
		if($this->admHnd->mysql->query($q)) {
			$info = 'Der News-Eintrag wurde erfolgreich gespeichert.';	
		} else {
			$info = 'Es scheint ein Problem mit der Datenbankanbindung zu geben. Bitte versuchen sie es später erneut.';	
		}	
		$this->admHnd->template->headLine('Info');
		$this->admHnd->template->descr($info);
	}
	function handleAdmin() {
		$this->admHnd->template->headLine('News-Modul');
		$this->admHnd->template->descr('Das News-Modul ist für die Anzeige und Aktualisierung der News auf ihrer Homepage verantwortlich. Unten sehen sie alle vorhandenen News aufgelistet.');
		$this->admHnd->template->headLine('News hinzufügen',2);
		$this->admHnd->template->descr('Klicken Sie <a href="index.php?action=mod&id='.$_GET['id']. '&do=add">hier</a>, um eine neue News hizuzufügen.');
		$this->admHnd->mysql->query('SELECT * FROM '._PREF.'mod_news_content WHERE 1;');
		$data = $this->admHnd->mysql->get_rows();
		$this->admHnd->template->startList('Liste aller News-Einträge',1,array('Inhalt', 'Aktion'));
		foreach($data as $entry) {
			$this->admHnd->template->listItem(array($entry['title'], '<a href="index.php?action=mod&id='.$_GET['id'].'&do=edit&data_id='.$entry['news_id'].'"><img border="0" src="/nikitaCMS/admin/templates/default/images/b_edit.png" alt="bearbeiten"/></a>&nbsp;<img src="/nikitaCMS/admin/templates/default/images/b_drop.png" alt="löschen"/>'));
		}
		$this->admHnd->template->endList();
		}
}


class news_output {
	function show_news($title, $text, $author, $date) {
		$ret = HTML::div('title', $this->hK->bbcode->safe_text($title));
		$ret .= HTML::div('author', str_replace('%name%', $author, _CREATED_BY));
		$ret .= HTML::div('createdate',str_replace('%datum%', strftime('%d.%m.%Y',$date), _CREATED_ON));
		$ret .= HTML::div('news_content', nl2br($this->hK->bbcode->parse($text)));
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
