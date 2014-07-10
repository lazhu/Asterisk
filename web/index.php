<?php
/*
 * index.php
 *
 * Copyright 2012 Lazhu Gonnish <lazhu.gonish@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */
include('ExtensionStates.inc.php'); // Config
include('log4php/Logger.php'); // Logger for php
include('AsteriskMysql.php'); // AsteriskMysql class
include('ExtensionStates.php'); // ExtensionStates class

$AsteriskMysql = new AsteriskMysql($ESMysqlOptions);
$ESOptions['data'] = $AsteriskMysql->getExtensions($exten_tables, $exten_cols);

$ExtensionStates = new ExtensionStates($ESOptions);
$ExtensionStates->open();
$ExtensionStates->getData($exten_col, $cid_col);
$ExtensionStates->close();
$extensions = $ExtensionStates->getExtensionStates();

include('ExtensionStates.tpl.html');
?>
