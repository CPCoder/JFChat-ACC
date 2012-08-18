<?php
/*
 * Project		ACC
 * Filename		tablesetup.php
 * Author		Steffen Haase
 * Date			15.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'install/classes/DbTools.php';

$acc_Template = TplEngine::getInstance();
$acc_GetPost = Request::getInstance();
$acc_DB = DBConnect::getInstance();
$acc_DbTools = DbTools::getInstance();

if (
	$acc_GetPost->_isSet('ac') &&
	$acc_GetPost->getString('ac') == 'createtables'
) {
	$acc_DbTools->createTables();
	$acc_DbTools->insertData();
}
if (
$acc_GetPost->_isSet('ac') &&
$acc_GetPost->getString('ac') == 'addcolumns'
) {
	$acc_DbTools->addColumns();
}

$acc_Template->setSubTPL('tablesetup');
$error_string = '<span style="color:#FF0000;font-weight:bold;">Nicht vorhanden!</span>';
$success_string = '<span style="color:#047719;font-weight:bold;">OK!</span>';
$create_tables = '<a href="install.php?node=3&amp;ac=createtables">Fehlende Tabellen anlegen</a><br><br>';
$add_columns = '<a href="install.php?node=3&amp;ac=addcolumns">Fehlende Spalten anlegen</a><br><br>';
$link = '<a href="install.php?node=3">Daten erneut pr&uuml;fen</a><br><br>';
$tableflag = true;
$colflag = true;

if (!$acc_DB->existsTable(TABLE_ACC_GROUPS)) {
	$table_groups = $error_string;
	$tableflag = false;
} else {
	$table_groups = $success_string;
}
if (!$acc_DB->existsTable(TABLE_ACC_GROUPMAP)) {
	$table_groupmap = $error_string;
	$tableflag = false;
} else {
	$table_groupmap = $success_string;
}
if (!$acc_DB->existsTable(TABLE_ACC_NAVIGATION)) {
	$table_navigation = $error_string;
	$tableflag = false;
} else {
	$table_navigation = $success_string;
}
if (!$acc_DB->existsTable(TABLE_ACC_SUBNAVIGATION)) {
	$table_subnav = $error_string;
	$tableflag = false;
} else {
	$table_subnav = $success_string;
}
if (!$acc_DB->existsTable(TABLE_ACC_NAVMAP)) {
	$table_navmap = $error_string;
	$tableflag = false;
} else {
	$table_navmap = $success_string;
}

if (!$acc_DB->existsColumn(TABLE_JF_REGISTRY, 'acc')) {
	$column_acc = $error_string;
	$colflag = false;
} else {
	$column_acc = $success_string;
}
if (!$acc_DB->existsColumn(TABLE_JF_REGISTRY, 'acc_mainadmin')) {
	$column_acc_mainadmin = $error_string;
	$colflag = false;
} else {
	$column_acc_mainadmin = $success_string;
}

if ($tableflag === true) {
	$link = '<a href="install.php?node=4">Schritt 4: Admin festlegen</a><br><br>';
	$create_tables = '';
}
if ($colflag === true) {
	$link = '<a href="install.php?node=4">Schritt 4: Admin festlegen</a><br><br>';
	$add_columns = '';
}

$acc_Template->assignVars(array(
	'groups' => TABLE_ACC_GROUPS,
	'groupmap' => TABLE_ACC_GROUPMAP,
	'navigation' => TABLE_ACC_NAVIGATION,
	'subnavigation' => TABLE_ACC_SUBNAVIGATION,
	'navmap' => TABLE_ACC_NAVMAP,
	'table_groups' => $table_groups,
	'table_groupmap' => $table_groupmap,
	'table_navigation' => $table_navigation,
	'table_subnav' => $table_subnav,
	'table_navmap' => $table_navmap,
	'acc' => TABLE_JF_REGISTRY.'.acc',
	'acc_mainadmin' => TABLE_JF_REGISTRY.'.acc_mainadmin',
	'column_acc' => $column_acc,
	'column_acc_mainadmin' => $column_acc_mainadmin,
	'link' => $link,
	'link_create_tables' => $create_tables,
	'link_add_columns' => $add_columns
));

?>