<?php
/*
 * Project		ACC
 * Filename		logout.php
 * Author		Steffen Haase
 * Date			09.10.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/SessionManager.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

$acc_Template = TplEngine::getInstance();
$acc_Session = SessionManager::getInstance();

$acc_Template->setSubTPL('sysmessage');
$acc_Template->assignVars(array(
	'type' => $acc_Language['msg']['type']['sys'],
	'message' => $acc_Language['msg']['system']['logout'],
	'login_url' => ACC_COMPLETE_URL.'index.php'
));
$acc_Session->signOut();

?>