<?php
/*
 * Project		ACC
 * Filename		acc_admins_new.php
 * Author		Steffen Haase
 * Date			13.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/SessionManager.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'include/functions.php';
require_once ACC_PATH_SERVER.'classes/Shs/User.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Session = SessionManager::getInstance();
$acc_Template = TplEngine::getInstance();
$csr = getHash(generate_pass());

if ($acc_GetPost->_isSet('page')) {
	$page = $acc_GetPost->getInt('page');
} else {
	$page = 1;
}
$start = $page * ACC_MAX_ENTRIES - ACC_MAX_ENTRIES;

$flag = true;
$errors = '';
$adminlist = '';
$sitenavigation = '';

if (
	$acc_GetPost->_isSet('flag') && 
	$acc_GetPost->getInt('flag') == 1 &&
	$acc_GetPost->getString('csr') == $_SESSION['csr'] &&
	$acc_GetPost->_isSet('search')
	) {
	// Gefundene Mitglieder listen
	$result = $acc_DB->queryObjectArray(
				"SELECT id, username, rechte, aktiv ".
				"FROM ".TABLE_JF_REGISTRY." ".
				"WHERE username LIKE '%".$acc_DB->escapeString($acc_GetPost->getString('search'))."%' ".
				"AND acc='0' ".
				"ORDER BY username LIMIT $start, ".ACC_MAX_ENTRIES.""
			, 'acc_admins_new.php');
	$count = $acc_DB->queryCount(
				"SELECT COUNT(id) ".
				"FROM ".TABLE_JF_REGISTRY." ".
				"WHERE username LIKE '%".$acc_DB->escapeString($acc_GetPost->getString('search'))."%' ".
				"AND acc='0' "
		, 'acc_admins_new.php');
	$_SESSION['csr'] = $csr;
	$ext = 'site=acc&amp;subsite=newadmin&amp;search='.$acc_GetPost->getString('search').
			'&amp;flag=1&amp;csr='.$csr;
	$listflag = true;
	if ($count !== false) {
		$SitesComplete = ceil($count / ACC_MAX_ENTRIES);
		if ($start > $SitesComplete) {
			$start = $SitesComplete;
		}
		$sitenavigation = buildCompleteNavigation($acc_Language, $count, $page, $SitesComplete, $ext);
	} else {
		$adminlist = str_replace(
			'{ERROR}', 
			$acc_Language['msg']['error']['msqlerror'], 
			$acc_Language['msg']['acc']['errorline']
		);
		$listflag = false;
	}
	if ($result !== false && $listflag = true) {
		if ($result !== null) {
			$i=0;
			foreach ($result as $key) {
				$acc_Template->loadTPL('acc_admins_new_list');
				$acc_Template->assignVarsTPL(array(
					'user_id' => $key->id,
					'user_name' => $key->username,
					'user_rights' =>$key->rechte,
					'user_active' =>$key->aktiv,
					'csr' =>$csr
				));
				if ($i%2) {
					$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color2']);
				} else {
					$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color1']);
				}
				$i++;
				$adminlist .= $acc_Template->getTPL();
			}
		} else {
			$adminlist = str_replace(
				'{ERROR}', 
				$acc_Language['msg']['error']['msqlerror'], 
				$acc_Language['msg']['acc']['nosearchresult']
			);
		}
	} else {
		$adminlist = str_replace(
			'{ERROR}', 
			$acc_Language['msg']['error']['msqlerror'], 
			$acc_Language['msg']['acc']['errorline']
		);
	}
} elseif (
		$acc_GetPost->_isSet('ac') && 
		$acc_GetPost->getString('ac') == 'add' &&
		$acc_GetPost->_isSet('id') && 
		$acc_GetPost->getString('csr') == $_SESSION['csr']
	) {
	$flag = false;
	$user = new User($acc_GetPost->getInt('id'));
	$dummy = $acc_DB->executeQuery(
		"UPDATE ".TABLE_JF_REGISTRY." ".
		"SET acc=1 ".
		"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
	, 'acc_admins_new.php');
	if ($dummy !== false) {
		$message = str_replace('{USERNAME}', $user->getUsername(), $acc_Language['msg']['acc']['add_success']);
		$acc_Template->setSubTPL('sysmessage');
		$acc_Template->assignVars(array(
			'type' => $acc_Language['msg']['type']['sys'],
			'message' =>  $message
		));
	} else {
		$flag = true;
		$adminlist = str_replace(
			'{ERROR}', 
			$acc_Language['msg']['error']['msqlerror'],
			$acc_Language['msg']['acc']['errorline']
		);
	}
}

if ($flag) {
	$acc_Template->setSubTPL('acc_admins_new');
	$_SESSION['csr'] = $csr;
	$acc_Template->assignVars(array(
		'sitenavigation' => $sitenavigation,
		'csr' => $csr,
		'errors' => $errors,
		'userlist' => $adminlist
	));
	if ($acc_GetPost->_isSet('flag')) {
		$acc_Template->assignVar('page', $page);
	}
}

?>