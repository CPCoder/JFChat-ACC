<?php
/*
 * Project		ACC
 * Filename		acc_groups.php
 * Author		Steffen Haase
 * Date			13.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Groups.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Groups = Groups::getInstance();

$errors = '';


if ($acc_GetPost->_isSet('page')) {
	$page = $acc_GetPost->getInt('page');
} else {
	$page = 1;
}
$start = $page * ACC_MAX_ENTRIES - ACC_MAX_ENTRIES;
$acc_Template->setSubTPL('acc_groups');

if ($acc_GetPost->_isSet('ac')) {
	if (
		$acc_GetPost->getString('ac') == 'delete' &&
		$acc_GetPost->_isSet('id')
	) {
		$dummy = $acc_DB->executeQuery(
			"DELETE FROM ".TABLE_ACC_GROUPMAP." WHERE groupid=".$acc_GetPost->getInt('id')
		, 'acc_groups.php');
		$dummy = $acc_DB->executeQuery(
			"DELETE FROM ".TABLE_ACC_GROUPS." WHERE id=".$acc_GetPost->getInt('id')
		, 'acc_groups.php');
		if ($dummy) {
			$errors = $acc_Language['msg']['acc']['groupdeleted'];
		}
	}
	if (
		$acc_GetPost->getString('ac') == 'newgroup' && 
		$acc_GetPost->_isSet('name') && 
		$acc_GetPost->_isSet('description')
	) {
		if ($acc_Groups->existsGroup($acc_GetPost->getString('name'))) {
			$errors = str_replace(
				'{MESSAGE}',
				$acc_Language['msg']['acc']['groupnameexists'],
				$acc_Language['msg']['error']['wrapper']
			);
			$errors = str_replace(
				'{GROUPID}', 
				$acc_Groups->getGroupID($acc_GetPost->getString('name')),
				$errors
			);
		} else {
			echo 'OK';
			$dummy = $acc_DB->executeQuery(
				"INSERT INTO ".TABLE_ACC_GROUPS." ".
				"(name, description) ".
				"VALUES('".$acc_DB->escapeString($acc_GetPost->getString('name'))."', ".
				"'".$acc_DB->escapeString($acc_GetPost->getString('description'))."')"
			, 'acc_groups.php');
			if ($dummy) {
				$errors = $acc_Language['msg']['acc']['groupadded'];
			}
		}
	}
}

$ar = $acc_DB->queryObjectArray(
			"SELECT g.id, g.name, g.description ".
			"FROM ".TABLE_ACC_GROUPS." AS g ".
			"LEFT JOIN ".TABLE_ACC_NAVMAP." AS navmap ".
			"ON g.id=navmap.groupid ".
			"GROUP BY g.id ".
			"ORDER BY g.name LIMIT $start, ".ACC_MAX_ENTRIES
	, 'acc_groups.php');
	
$count = $acc_DB->queryCount(
			"SELECT COUNT(id) ".
			"FROM ".TABLE_ACC_GROUPS
	, 'acc_groups.php');
if (!$count || is_null($count)) {
	$count = 0;
}

$ext = '';
$listflag = true;
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
		$grouplist = '';
		$i=0;
		foreach ($ar as $key) {
			$delete_link = '<a href="index.php?site=acc&amp;subsite=groups&amp;ac=delete&amp;id='.$key->id.
							'&amp;page='.$page.$ext.'"><font color="#FF0000">Entfernen</font></a> | ';
			$edit_link = '<a href="index.php?site=acc&amp;subsite=editgroup&amp;id='.$key->id.
							'&amp;page='.$page.$ext.'">Bearbeiten</a>';
			$acc_Template->loadTPL('acc_groups_list');
			$acc_Template->assignVarsTPL(array(
				'group_id' => $key->id,
				'group_name' => $key->name,
				'group_description' => $key->description,
				'group_permissions' => implode(', ', $acc_Groups->getGroupPermissions($key->id)),
				'delete_link' => ($key->id == 1) ? '' : $delete_link,
				'edit_link' => ($key->id == 1) ? '' : $edit_link
			));
			if ($i%2) {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color2']);
			} else {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color1']);
			}
			$i++;
			$grouplist .= $acc_Template->getTPL();
		}
	}
} else {
	$adminlist = str_replace('{ERROR}', $acc_Language['msg']['error']['msqlerror'], $acc_Language['msg']['acc']['errorline']);
}
$acc_Template->assignVars(array(
	'sitenavigation' => $sitenavigation,
	'grouplist' => $grouplist,
	'page' => $page,
	'ext' => $ext,
	'errors' => $errors
));

?>