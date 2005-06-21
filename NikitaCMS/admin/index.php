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

define('_SECURE_ACCESS','1');
define('_DEBUG',1);
include('../core/kernel.php');
include('../includes/database.php');
include('../includes/config.inc.php');
include('../includes/class.html.php');
include('class.admintemplate.php');
include('class.admin.corefunctions.php');
require_once('../includes/class.bbcode_define.php');

/*
 * 
 * Abfolge: 
 * 
 * testen auf login, wenn nicht -> login formular anzeigen 
 * 					 wenn ja -> admin cp laden
 * 
 * 
 */
 
$mysql = new mysql($aMainConfig['db_host'],$aMainConfig['db_database'],$aMainConfig['db_user'],$aMainConfig['db_password']);

$template = new admintemplate;

$kernel = new kernel(&$mysql, &$template, '../');
$kernel->load_modules(1);
$kernel->load_extensions(1);
$admin = new admin_core($mysql, $template, &$kernel);


include('../lang/german.php');

$admin->check_login();
$admin->renderPage();

?>
