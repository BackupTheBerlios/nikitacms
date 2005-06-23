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

require_once('stringparser_bbcode.class.php');
 class bbcode_define {
	var $bbcode;
	 function bbcode_define() {
		$this->bbcode = new StringParser_BBCode ();
	 	$this->bbcode->addFilter (STRINGPARSER_FILTER_PRE, array (&$this, 'convertlinebreaks'));
		//$this->bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), array (&$this, 'htmlspecialchars'));
		//$this->bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), array (&$this, 'nl2br'));
		$this->bbcode->addParser ('list', 'bbcode_stripcontents');
		$this->bbcode->addCode('php','usecontent',array(&$this,'do_bbcode_php'), array (),
		                  'inline', array ('block', 'inline'), array ('link'));
		$this->bbcode->addCode('code','usecontent',array(&$this,'do_bbcode_code'), array (),
		                  'inline', array ('block', 'inline'), array ('listitem', 'link'));
		$this->bbcode->addCode('quote','callback_replace',array(&$this,'do_bbcode_quote'), array ('usecontent_param' => 'name'),
		                  'inline', array ('block', 'inline'), array ('listitem', 'link'));
		$this->bbcode->addCode ('b', 'simple_replace', null, array ('start_tag' => '<b>', 'end_tag' => '</b>'),
		                  'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		$this->bbcode->addCode ('i', 'simple_replace', null, array ('start_tag' => '<i>', 'end_tag' => '</i>'),
		                  'inline', array ('listitem', 'block', 'inline', 'link'), array ());
		$this->bbcode->addCode ('url', 'usecontent?', array (&$this, 'do_bbcode_url'), array ('usecontent_param' => 'default'),
		                  'link', array ('listitem', 'block', 'inline'), array ('link'));
		$this->bbcode->addCode ('link', 'callback_replace_single', array (&$this, 'do_bbcode_url'), array (),
		                  'link', array ('listitem', 'block', 'inline'), array ('link'));
		$this->bbcode->addCode ('img', 'usecontent', array (&$this, 'do_bbcode_img'), array (),
		                  'image', array ('listitem', 'block', 'inline', 'link'), array ());
		$this->bbcode->addCode ('bild', 'usecontent', array (&$this, 'do_bbcode_img'), array (),
		                  'image', array ('listitem', 'block', 'inline', 'link'), array ());
		$this->bbcode->setOccurrenceType ('img', 'image');
		$this->bbcode->setOccurrenceType ('bild', 'image');
		$this->bbcode->setMaxOccurrences ('image', 2);
		$this->bbcode->addCode ('list', 'simple_replace', null, array ('start_tag' => '<ul>', 'end_tag' => '</ul>'),
		                  'list', array ('block', 'listitem'), array ());
		$this->bbcode->addCode ('*', 'simple_replace', null, array ('start_tag' => '<li>', 'end_tag' => '</li>'),
		                  'listitem', array ('list'), array ());
		$this->bbcode->setCodeFlag ('*', 'closetag', BBCODE_CLOSETAG_OPTIONAL);
		$this->bbcode->setCodeFlag ('*', 'paragraphs', true);
		$this->bbcode->setCodeFlag ('list', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
		$this->bbcode->setCodeFlag ('list', 'opentag.before.newline', BBCODE_NEWLINE_DROP);
		$this->bbcode->setCodeFlag ('list', 'closetag.before.newline', BBCODE_NEWLINE_DROP);
		//$this->bbcode->setRootParagraphHandling (true);
	 }
	 
	function convertlinebreaks ($text) {
	    return preg_replace ("/\015\012|\015|\012/", "\n", $text);
	}
	
	// Alles bis auf Neuezeile-Zeichen entfernen
	function bbcode_stripcontents ($text) {
	    return preg_replace ("/[^\n]/", '', $text);
	}
	
	function do_bbcode_code ($action, $attributes, $content, $params, &$node_object) {
		if ($action == 'validate') {
	        return true;
	    }
	    $content = wordwrap($content, 80, "\n");
	    return '<br/><b>Code:</b><div class="code">'.nl2br($content).'</div>';  
	}

	function do_bbcode_php ($action, $attributes, $content, $params, &$node_object) {
		if ($action == 'validate') {
	        return true;
	    }
	    $new_cont = $content;
	    ob_start();
	    
	    highlight_string($new_cont);
	    
	    $new_cont = ob_get_contents();
	    ob_end_clean();
	    
	    return '<br/><b>PHP-Code:</b><div class="php_code">'.$new_cont.'</div>';  
	}

	function do_bbcode_quote ($action, $attributes, $content, $params, &$node_object) {
		if ($action == 'validate') {
	        return true;
	    }
	    if(isset ($attributes['name'])) {
	    	return '<br/>Zitat von '.$attributes['name'].':<div class="quote">'.$content.'</div>';  
	    }
	    return '<br/>Zitat: <div class="quote">'.html_entity_decode($content).'</div>';  
	}
	function do_bbcode_url ($action, $attributes, $content, $params, $node_object) {
	    if ($action == 'validate') {
	        return true;
	    }
	    if (!isset ($attributes['default'])) {
	        return '<a href="'.htmlspecialchars ($content).'">'.htmlspecialchars ($content).'</a>';
	    }
	    return '<a href="'.htmlspecialchars ($attributes['default']).'">'.$content.'</a>';
	}
	 
	function do_bbcode_img ($action, $attributes, $content, $params, $node_object) {
	    if ($action == 'validate') {
	        return true;
	    }
	    return '<img src="'.htmlspecialchars($content).'" alt="" />';
	}
	
	function parse($text) {
		return $this->bbcode->parse ($text);
	}
	
	function safe_text($text) {
		return trim(nl2br(htmlentities($text)));
	}
}
?>


