<?php
/*
 * Project		ACC
 * Filename		acc_admins.php
 * Author		Steffen Haase
 * Date			13.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Groups.php';
require_once ACC_PATH_SERVER.'classes/Shs/User.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();

if ($acc_GetPost->_isSet('page')) {
	$page = $acc_GetPost->getInt('page');
} else {
	$page = 1;
}
$start = $page * ACC_MAX_ENTRIES - ACC_MAX_ENTRIES;
$acc_Template->setSubTPL('acc_admins');

if ($acc_GetPost->_isSet('ac')) {
	if ($acc_GetPost->getString('ac') == 'delete') {
		$acc_DB->executeQuery(
			"DELETE FROM ".TABLE_ACC_GROUPMAP." WHERE userid=".$acc_GetPost->getInt('id')
		, 'acc_admins.php');
		$acc_DB->executeQuery(
			"UPDATE ".TABLE_JF_REGISTRY." ".
			"SET acc=0 WHERE id=".$acc_GetPost->getInt('id')
		, 'acc_admins.php');
	}
}

$ar = $acc_DB->queryObjectArray(
			"SELECT id, username, aktiv, acc_mainadmin ".
			"FROM ".TABLE_JF_REGISTRY." ".
			"WHERE acc=1 ".
			"ORDER BY username LIMIT $start, ".ACC_MAX_ENTRIES.""
, 'acc_admins.php');

$count = $acc_DB->queryCount(
			"SELECT COUNT(id) ".
			"FROM ".TABLE_JF_REGISTRY." ".
			"WHERE acc=1"
, 'acc_admins.php');

$ext = '';
$listflag = true;
$sitenavigation = '';
if ($count !== false) {
	$SitesComplete = ceil($count / ACC_MAX_ENTRIES);
	if ($start > $SitesComplete) {
		$start = $SitesComplete;
	}
	$sitenavigation = buildCompleteNavigation($acc_Language, $count, $page, $SitesComplete, $ext);
} else {
	$adminlist = str_replace('{ERROR}', $acc_Language['msg']['error']['msqlerror'], $acc_Language['msg']['acc']['errorline']);
	$listflag = false;
}
if ($ar !== false && $listflag === true) {
	if ($ar !== null) {
		$groups = Groups::getInstance();
		$adminlist = '';
		$i=0;
		foreach ($ar as $key) {
			$user = new User($key->id);
			$usergroups = implode('<br>', $groups->getGroupNamesForUser($key->id));
			$userperms = implode(', ', $user->getUserPermissions());
			$acc_Template->loadTPL('acc_admins_list');
			$delete_link = '<a href="index.php?site=acc&amp;subsite=admins&amp;ac=delete&amp;id='.$key->id.
							'&amp;page='.$page.$ext.'"><font color="#FF0000">Entfernen</font></a>';
			$mainadmin = ' <span style="font-weight:bold;">(ACC Main-Admin)</span>';
			$acc_Template->assignVarsTPL(array(
				'user_id' => $key->id,
				'user_name' => ($key->acc_mainadmin == 1) ? $key->username.$mainadmin : $key->username,
				'user_groups' => $usergroups,
				'user_permissions' => $userperms,
				'user_active' => $key->aktiv,
				'delete_link' => ($key->acc_mainadmin == 1) ? '' : $delete_link
			));
			if ($i%2) {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color2']);
			} else {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color1']);
			}
			$i++;
			$adminlist .= $acc_Template->getTPL();
		}
	}
} else {
	$adminlist = str_replace('{ERROR}', $acc_Language['msg']['error']['msqlerror'], $acc_Language['msg']['acc']['errorline']);
}
$acc_Template->assignVars(array(
	'sitenavigation' => $sitenavigation,
	'adminlist' => $adminlist
));


?>