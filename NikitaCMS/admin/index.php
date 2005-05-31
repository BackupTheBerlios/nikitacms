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

include('../includes/database.php');
include('../includes/config.inc.php');
include('../includes/class.html.php');
include('class.admintemplate.php');
include('class.admin.corefunctions.php');

/*
 * 
 * Abfolge: 
 * 
 * testen auf login, wenn nicht -> login formular anzeigen 
 * 					 wenn ja -> admin cp laden
 * 
 * 
 */
 
$mysql = new mysql($aMainconfig['db_host'],$aMainconfig['db_database'],$aMainconfig['db_user'],$aMainconfig['db_password']);
$admin = new admin_core();

include('../lang/german.php');

if(isset($_GET['action']) && $_GET['action'] == 'admin_login') {
	

	
} else {
	$admin->check_login();
}
 

?>
