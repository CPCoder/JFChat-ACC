<?php
/*
 * Project		ACC
 * Filename		acc.php
 * Author		Steffen Haase
 * Date			06.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

$acc_DB = DBConnect::getInstance();
$acc_Template = TplEngine::getInstance();

$acc_Template->setSubTPL('acc');

$count_admins = $acc_DB->queryCount(
					"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." WHERE acc=1"
				, 'acc.php');
$count_groups = $acc_DB->queryCount(
					"SELECT COUNT(id) FROM ".TABLE_ACC_GROUPS
				, 'acc.php');

if (!$count_admins || is_null($count_admins)) {
	$count_admins = 0;
}
if (!$count_groups || is_null($count_groups)) {
	$count_groups = 0;
}

$acc_Template->assignVars(array(
	'count_admins' => $count_admins,
	'count_groups' => $count_groups,
	'complete_url' => ACC_COMPLETE_URL
));


?>