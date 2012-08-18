<?php
/*
 * Project		ACC
 * Filename		overview.php
 * Author		Steffen Haase
 * Date			09.10.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/SessionManager.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Session = SessionManager::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Admin = new User($acc_Session->getUserID());

$acc_Template->setSubTPL('overview');

$acc_overview['members']['active'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE aktiv='1'"
									, 'overview.php');
$acc_overview['members']['inactive'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE aktiv='0'"
									, 'overview.php');
$acc_overview['members']['male'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE geschlecht='0'"
									, 'overview.php');
$acc_overview['members']['female'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE geschlecht='1'"
									, 'overview.php');
$acc_overview['members']['unknown'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE geschlecht='2'"
									, 'overview.php');
$acc_overview['gallery']['locked']	= $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_ACC_GALIMAGES." ".
										"WHERE locked=1"
									, 'overview.php');
$acc_overview['gallery']['free']	= $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_ACC_GALIMAGES." ".
										"WHERE locked=0"
									, 'overview.php');
$acc_overview['pictures']['locked'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE bildlocked='1'"
									, 'overview.php');
$defaultpic = $acc_Config['pictures']['db'].$acc_Config['pictures']['default'];
$acc_overview['pictures']['free'] = $acc_DB->queryCount(
										"SELECT COUNT(id) FROM ".TABLE_JF_REGISTRY." ".
										"WHERE bildlocked='0' AND bild!='".$defaultpic."'"
									, 'overview.php');


$acc_Template->assignVars(array(
	'gallocked' => $acc_overview['gallery']['locked'],
	'galfree' => $acc_overview['gallery']['free'],
	'piclocked' => $acc_overview['pictures']['locked'],
	'picfree' => $acc_overview['pictures']['free'],
	'members_active' => $acc_overview['members']['active'],
	'members_inactive' => $acc_overview['members']['inactive'],
	'members_male' => $acc_overview['members']['male'],
	'members_female' => $acc_overview['members']['female'],
	'members_unknown' => $acc_overview['members']['unknown'],
	'adminname' => $acc_admin->getUsername()
));

include 'config/additional_overview.php';


?>