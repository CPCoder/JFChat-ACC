<?php
/*
 * Project		ACC
 * Filename		index.php
 * Author		Steffen Haase
 * Date			02.10.2011
 * License		GPL v3
 */
define('ACC_SCRIPT_STARTTIME', microtime(true));
define('ACC_PATH_SERVER', __DIR__.'/');
define('ACC_INSTALL', false);
define('ACC_VERSION', '3.1.0');

if (version_compare(PHP_VERSION, '5.3','<')) {
	echo '<br><br><center>'.
			'<h2>!! Fatal Error !!</h4>'.
			'Um das ACC (Admin-Control-Center) einsetzen zu k&ouml;nnen muss mind. PHP 5.3 installiert sein!<br><br>'.
			'<u>Installierte PHP-Version:</u><br>'.PHP_VERSION.'<br><br>'.
			'<u>Ben&ouml;tigte Mindest-PHP-Version</u><br>5.3.0';
	exit;
}
require_once 'config/error_reporting.php';
require_once 'config/config.php';
require_once 'config/defines.php';
require_once 'include/functions.php';
require_once 'classes/Shs/TplEngine.php';
require_once 'classes/Shs/Navigation.php';
require_once 'classes/Shs/SessionManager.php';
require_once 'classes/Shs/Request.php';
require_once 'classes/Shs/ErrorHandler.php';
require_once 'classes/Shs/DebugManager.php';
require_once 'classes/Shs/User.php';
require_once 'classes/Shs/Groups.php';
require_once 'lang/lang_'.ACC_LANG.'.php';

if (ACC_DEBUGMODE === true) {
	$acc_Debugger = DebugManager::getInstance();
	$old_error_handler = set_error_handler(array("ErrorHandler", "handleErrors"));
}

ini_set('session.cookie_domain', ACC_SESSION_DOMAIN);
ini_set('session.name', ACC_SESSION_NAME);
session_start();

$acc_GetPost = Request::getInstance();
if (!$acc_GetPost->_isSet('site')) {
	$acc_GetPost->setValue('site', 'login');
}

$sessionID = session_id();
if (!isset($_SESSION['session_id'])) {
	$_SESSION['session_id'] = $sessionID;
}

$acc_Template = TplEngine::getInstance();
$acc_Template->openTemplate('index');

$acc_Session = SessionManager::getInstance();
$acc_Session->initSession();
$acc_Session->checkSession();

$acc_permflag = true;

if ($acc_Session->isLoggedin()) {
	$acc_admin = new User($acc_Session->getUserID());
	$acc_Groups = Groups::getInstance();
	$acc_GroupIds = $acc_Groups->getGroupIDsAsString($acc_Session->getUserID());
	$acc_Navigation = Navigation::getInstance($acc_Language, $acc_GroupIds);
	if ($acc_GetPost->getString('site') == 'login') {
		$acc_Session->signOut();
		session_write_close();
		header('Location:'.ACC_COMPLETE_URL.'index.php?site=login');
	} elseif ($acc_GetPost->getString('site') == 'sessionexp') {
		include ACC_PATH_SERVER.'include/sessionexp.php';
	} elseif ($acc_GetPost->getString('site') == 'overview') {
		include ACC_PATH_SERVER.'include/overview.php';
	} elseif ($acc_GetPost->getString('site') == 'acc') {
		if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
			if ($acc_GetPost->getString('subsite') == 'admins') {
				include ACC_PATH_SERVER.'include/acc_admins.php';
			} elseif ($acc_GetPost->getString('subsite') == 'newadmin') {
				include ACC_PATH_SERVER.'include/acc_admins_new.php';
			} elseif ($acc_GetPost->getString('subsite') == 'groups') {
				include ACC_PATH_SERVER.'include/acc_groups.php';
			} elseif ($acc_GetPost->getString('subsite') == 'editgroup') {
				include ACC_PATH_SERVER.'include/acc_groups_edit.php';
			} else {
				include ACC_PATH_SERVER.'include/acc.php';
			}
		} else {
			$acc_permflag = false;
		}
	} elseif ($acc_GetPost->getString('site') == 'members') {
		if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
			if ($acc_GetPost->getString('subsite') == 'new') {
				include ACC_PATH_SERVER.'include/members_new.php';
			} elseif ($acc_GetPost->getString('subsite') == 'edit') {
				include ACC_PATH_SERVER.'include/members_edit.php';
			} else {
				include ACC_PATH_SERVER.'include/members.php';
			}
		} else {
			$acc_permflag = false;
		}
	} elseif ($acc_GetPost->getString('site') == 'gallery') {
		if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
			include ACC_PATH_SERVER.'include/gallery.php';
		} else {
			$acc_permflag = false;
		}
	} elseif ($acc_GetPost->getString('site') == 'emoticons') {
		if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
			if ($acc_GetPost->getString('subsite') == 'new') {
				include ACC_PATH_SERVER.'include/emoticons_new.php';
			} elseif ($acc_GetPost->getString('subsite') == 'newemo') {
				include ACC_PATH_SERVER.'include/emoticons_newemo.php';
			} elseif ($acc_GetPost->getString('subsite') == 'singleupload') {
				include ACC_PATH_SERVER.'include/emoticons_singleupload.php';
			} elseif ($acc_GetPost->getString('subsite') == 'multiupload') {
				include ACC_PATH_SERVER.'include/emoticons_multiupload.php';
			} elseif ($acc_GetPost->getString('subsite') == 'edit') {
				include ACC_PATH_SERVER.'include/emoticons_edit.php';
			} else {
				include ACC_PATH_SERVER.'include/emoticons.php';
			}
		} else {
			$acc_permflag = false;
		}
	} elseif ($acc_GetPost->getString('site') == 'pictures') {
		if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
			include ACC_PATH_SERVER.'include/pictures.php';
		} else {
			$acc_permflag = false;
		}
	} elseif ($acc_GetPost->getString('site') == 'checkname') {
		include ACC_PATH_SERVER.'include/checkname.php';
	} elseif ($acc_GetPost->getString('site') == 'logout') {
		include ACC_PATH_SERVER.'include/logout.php';
	} else {
		if (strstr($acc_GetPost->getString('site'), '..') || 
			strstr($acc_GetPost->getString('site'), '%2e%2e') || 
			strstr($acc_GetPost->getString('site'), '%2E%2E')){
			$template->setSubTPL('sysmessage');
			$template->assignVars(array(
				'type' => $acc_Language['msg']['type']['err'],
				'message' => $acc_Language['msg']['error']['sitenotavailable']
			));
		} else {
			if (file_exists('extensions/'.$acc_GetPost->getString('site').'.php')) {
				if ($acc_admin->hasPermission($acc_GetPost->getString('site'))) {
					include ACC_PATH_SERVER.'extensions/'.$acc_GetPost->getString('site').'.php';
				} else {
					$acc_permflag = false;
				}
			} else {
				$acc_Template->setSubTPL('sysmessage');
				$acc_Template->assignVars(array(
					'type' => $acc_Language['msg']['type']['err'],
					'message' => $acc_Language['msg']['error']['sitenotavailable']
				));
			}
		}
	}
	if ($acc_permflag === false) {
		$acc_Template->setSubTPL('sysmessage');
		$acc_Template->assignVars(array(
			'type' => $acc_Language['msg']['type']['sys'],
			'message' => $acc_Language['msg']['system']['nopermission']
		));
	}
} else {
	if ($acc_GetPost->getString('site') == 'sessionexp') {
		include ACC_PATH_SERVER.'include/sessionexp.php';
	} else {
		include ACC_PATH_SERVER.'include/login.php';
	}
}

if ($acc_Session->isLoggedin() && $acc_GetPost->getString('site') != 'login') {
	$acc_Template->assignVar('navigation', $acc_Navigation->getNavigation());
	$acc_Template->assignVar('COMPLETE_URL', ACC_COMPLETE_URL);
} else {
	$acc_Template->assignVar('navigation', file_get_contents(ACC_PATH_SERVER.'/templates/nonavi.tpl'));
}
$acc_Template->assignVars(array(
		'accversion' => substr(ACC_VERSION, 0, 1),
		'charset' => ACC_CHARSET
));

if ($acc_Session->isLoggedin() && $acc_GetPost->getString('site') != 'login') {
	if ($acc_Template->existsVar('checkpictures')) {
		if (ACC_CHECKPICTURES) {
			$acc_Template->assignVar('checkpictures', 1);
		} else {
			$acc_Template->assignVar('checkpictures', 0);
		}
	}
	if ($acc_Template->existsVar('npactive')) {
		if (ACC_NPACTIVE === true) {
			$acc_Template->assignVar('npactive', 1);
		} else {
			$acc_Template->assignVar('npactive', 0);
		}
	}
	if ($acc_Template->existsVar('nickchange')) {
		if (ACC_NICKCHANGE === true) {
			$acc_Template->assignVar('nickchange', 1);
		} else {
			$acc_Template->assignVar('nickchange', 0);
		}
	}
}

$acc_Template->removeEmptyVars();

if(ACC_DEBUGMODE) {
	$acc_Debugger->addDebugBox();
} else {
	$acc_Template->assignVar('debug_box', '');
}

$acc_Template->printTemplate();
$acc_Session->closeSession();

?>