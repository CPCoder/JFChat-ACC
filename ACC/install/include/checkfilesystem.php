<?php
/*
 * Project		
 * Filename		checkfilesystem.php
 * Author		Steffen Haase
 * Date			14.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/File.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

$acc_Template = TplEngine::getInstance();
$acc_GetPost = Request::getInstance();
$acc_File = new File();

$acc_Template->setSubTPL('checkfilesystem');

$path_logs = ACC_PATH_SERVER.'logs/';

if ($acc_File->isWriteable($path_logs)) {
	$image = '<img src="./style/gfx/tick.png" border="0">';
	$link = '<a href="install.php?node=2">Schritt 2: Datenbank-Setup</a><br><br>';
} else {
	$image = '<img src="./style/gfx/cross.png" border="0">';
	$link = '<a href="install.php?node=1">Dateisystem neu pr6uuml;fen</a><br><br>';
}

$acc_Template->assignVars(array(
	'dir_logs' => $path_logs,
	'chmod_logs' => $acc_File->getFilePerms($path_logs),
	'checkimage' => $image,
	'link' => $link
));

?>