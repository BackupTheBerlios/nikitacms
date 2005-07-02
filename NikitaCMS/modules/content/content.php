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

class admin_content {
	var $admHnd;
	function admin_content($admin_handler) {
		$this->admHnd = $admin_handler;
	}	
	
	function handleAdmin() {
		$this->admHnd->template->headLine('Content-Modul');
		switch($_GET['do']) {
			case 'edit':
			break;
			
			default:
			$this->admHnd->template->descr('Das Content-Modul verwaltet den Inhalt auf beliebigen Seiten. So kann man z.B. für jede Seite einen Teaser erstellen oder einen Statischen Text zur Seiet hinzufügen. Die folgendende Liste beinhaltet alle vorhandenen Datensätze.');
			$this->admHnd->mysql->query('SELECT * FROM '._PREF.'mod_content WHERE 1;');
			$data = $this->admHnd->mysql->get_rows();
			$this->admHnd->template->startList('Liste aller Content-Datensätze',1,array('Seiten-ID','Inhalt', 'Aktion'));
			foreach($data as $entry) {
				$this->admHnd->template->listItem(array($entry['page_id'],$entry['text'], '<a href="index.php?action=mod&id='.$_GET['id'].'&do=edit&data_id='.$entry['content_id'].'"<img border="0" src="/nikitaCMS/admin/templates/default/images/b_edit.png" alt="bearbeiten"/></a>&nbsp;<img src="/nikitaCMS/admin/templates/default/images/b_drop.png" alt="löschen"/>'));
			}
			$this->admHnd->template->endList();
			}

		
	}
	function edit() {
		
	}
	function saveedit() {
		
	}
}
 
class output_content {
	function show($row) {
		// hier bbcode etc...
		return nl2br($this->h_kernel->bbcode->parse($row['text']));
	}
}


class content {
	var $h_kernel;
	function content($kernel_handler) {
		$this->h_kernel = &$kernel_handler;
	}
	
	function show($page_id) {
		$this->h_kernel->database->query('SELECT * FROM '._PREF.'mod_content WHERE page_id = '.$page_id.';');
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