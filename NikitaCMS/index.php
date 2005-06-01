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
define('_DEBUG','1');
define('_SECURE_ACCESS','1');
error_reporting(E_ALL);
require_once('includes/defines.php');
require_once('includes/config.inc.php');
require_once('includes/database.php');
require_once('core/kernel.php');
require_once('includes/class.template.php');
require_once('includes/class.html.php');
require_once('includes/class.bbcode_define.php');

$template = new template();
// MySQL Verbindung starten
$mysql = new mysql(	$aMainConfig['db_host'],
					$aMainConfig['db_database'],
					$aMainConfig['db_user'],
					$aMainConfig['db_password']);
					
// Kernel laden, mysql und template handler übergeben
$kernel = new kernel($mysql, $template);


// Module und Extensions laden (für die aktuelle Seite)
$kernel->load_modules(empty($_GET['id']) ? 1 : $_GET['id']);
$kernel->load_extensions(empty($_GET['id']) ? 1 : $_GET['id']);

// Page ausgeben
$kernel->renderPage();
?>