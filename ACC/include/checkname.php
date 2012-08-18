<?php
/*
 * Project		ACC
 * Filename		checkname.php
 * Author		Steffen Haase
 * Date			01.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';

$acc_DB = DBConnect::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_GetPost = Request::getInstance();

$result = $acc_DB->querySingleItem(
			"SELECT id FROM ".TABLE_JF_REGISTRY." WHERE username='".$acc_DB->escapeString($acc_GetPost->getString('name'))."'"
		, 'checkname.php');

$acc_Template->openTemplate('checkname');
if ($result !== false) {
	if ($result !== null) {
		$acc_Template->assignVar('message', $acc_Language['msg']['check']['isregistered']);
	} else {
		$acc_Template->assignVar('message', 'OK');
	}
}

?>