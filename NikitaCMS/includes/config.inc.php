<?php
/*
 * @file config.inc.php, created on 30.05.2005
 * 
 * 
 * 
 * Copyright (C) 2005 NikitaCMS
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
 *
 * 
 */
 
$aMainConfig = array();

$aMainConfig['db_host'] = 'localhost';
$aMainConfig['db_database'] = 'nikitacms';
$aMainConfig['db_user'] = 'root';
$aMainConfig['db_password'] = '';
$aMainConfig['db_prefix'] = 'nikita_';

define('_PATH','/nikitaCMS');
define('_PREF',$aMainConfig['db_prefix']);
?>
