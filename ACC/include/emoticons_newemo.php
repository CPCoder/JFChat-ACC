<?php
/*
 * Project		ACC
 * Filename		emoticons_newemo.php
 * Author		Steffen Haase
 * Date			08.04.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/File.php';
require_once ACC_PATH_SERVER.'classes/Shs/Tools.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Tools = Tools::getInstance();

$js_emoedit = ACC_PATH_SERVER.'lib/emoticons_edit.js';
if (is_file($js_emoedit)) {
	$javascript = file_get_contents($js_emoedit);
}

if ($acc_GetPost->getString('ac') == 'save') {

} else {
	$acc_Template->setSubTPL('emoticons_newemo');
	$acc_Template->assignVars(array(
						'jscript' => $javascript,
						'emo_name' => 'Emoticon-Aufruf',
						'emo_url' => 'HTTP-Pfad zur Grafik'
	));
}


?>