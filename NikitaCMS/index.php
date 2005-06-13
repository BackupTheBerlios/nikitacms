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
 $start_time = explode(" ",microtime());
$start_time = $start_time[1] + $start_time[0];
// ^^ Aktuelle Zeit wir gemessen
// Dieser Teil kommt ganz am anfang deiner Seite
 
define('_DEBUG','1');
$startTime = microtime();
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
$kernel = new kernel(&$mysql, &$template);


// Module und Extensions laden (für die aktuelle Seite)
$kernel->load_modules(empty($_GET['id']) ? 1 : $_GET['id']);
$kernel->load_extensions(empty($_GET['id']) ? 1 : $_GET['id']);

// Page ausgeben
$kernel->renderPage();

// und dieser Teil kommt ganz am ende deiner Seite
$time_end = explode(" ",microtime());
$time_end = $time_end[1] + $time_end[0];
// ^^ Jetzt wird wieder die Aktuelle Zeit gemessen
$zeitmessung = $time_end-$start_time;
// ^^ Endzeit minus Startzeit = die Differenz der beiden Zeiten
$zeitmessung = substr($zeitmessung,0,8);
// ^^ Die Zeit wird auf 6 Kommastellen gekürzt
echo "<p align=\"center\">Ladezeit der Seite: $zeitmessung Sekunden.</p>";
// ^^ Ausgabe der Zeitmessung
?>