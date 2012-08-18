<?php
/*
 * Project		ACC
 * Filename		acc_groups_edit.php
 * Author		Steffen Haase
 * Date			13.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Navigation.php';
require_once ACC_PATH_SERVER.'classes/Shs/Tools.php';
require_once ACC_PATH_SERVER.'classes/Shs/Groups.php';
require_once ACC_PATH_SERVER.'classes/Shs/User.php';

$acc_db = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Groups = Groups::getInstance();
$_groupIds = $acc_Groups->getGroupIDsAsString($acc_Session->getUserID());
$acc_Navigation = Navigation::getInstance($acc_Language, $_groupIds);
$acc_Tools = Tools::getInstance();
$csr = $csr = getHash(generate_pass());

if ($acc_GetPost->_isSet('id')) {
	$id = $acc_GetPost->getInt('id');
}
$errors = '';

if ($acc_GetPost->_isSet('ac')) {
	if (
		$acc_GetPost->getString('ac') == 'changename' &&
		$acc_GetPost->_isSet('name')
	){
		$dummy = $acc_db->executeQuery(
			"UPDATE ".TABLE_ACC_GROUPS." ".
			"SET name='".$acc_db->escapeString($acc_GetPost->convertString('name'))."', ".
			"description='".$acc_db->escapeString($acc_GetPost->convertString('description'))."' ".
			"WHERE id='".$id."'"
		, 'acc_groups_edit.php');
		if ($dummy != false) {
			$errors = $acc_Language['msg']['system']['groupnamechanged'];
		}
	} elseif (
		$acc_GetPost->getString('ac') == 'deletemember' &&
		$acc_GetPost->_isSet('userid')
	) {
		$dummy = $acc_db->executeQuery(
			"DELETE FROM ".TABLE_ACC_GROUPMAP." ".
			"WHERE userid='".$acc_GetPost->getInt('userid')."' AND groupid='".$id."'"
		, 'acc_groups_edit.php');
	} elseif (
		$acc_GetPost->getString('ac') == 'deletesector' &&
		$acc_GetPost->_isSet('secid')
	) {
		$dummy = $acc_db->executeQuery(
			"DELETE FROM ".TABLE_ACC_NAVMAP." ".
			"WHERE groupid='".$id."' AND navid='".$acc_GetPost->getInt('secid')."'"
		, 'acc_groups_edit.php');
	} elseif (
		$acc_GetPost->getString('ac') == 'addmember' &&
		$acc_GetPost->_isSet('name')
	) {
		if ($acc_Tools->isRegisteredName($acc_GetPost->getString('name')) !== null) {
			if ($acc_Tools->isRegisteredName($acc_GetPost->getString('name')) !== false) {
				if ($acc_Tools->isInGroup($id, $acc_Tools->getUserID($acc_GetPost->getString('name')))) {
					$errors = str_replace(
						'{MESSAGE}', 
						$acc_Language['msg']['error']['isingroup'],
						$acc_Language['msg']['error']['wrapper']
					);
				} else {
					$dummy = $acc_db->executeQuery(
						"INSERT INTO ".TABLE_ACC_GROUPMAP." ".
						"(userid, groupid) ".
						"VALUES('".$acc_Tools->getUserID($acc_GetPost->getString('name'))."', '".$id."')"
					, 'acc_groups_edit');
					if (!$dummy) {
						$errors = str_replace(
							'{MESSAGE}', 
							$acc_Language['msg']['error']['msqlerror'],
							$acc_Language['msg']['error']['wrapper']
						);
					}
				}
			} else {
				$errors = str_replace(
								'{MESSAGE}', 
				$acc_Language['msg']['error']['unknowuser'],
				$acc_Language['msg']['error']['wrapper']
				);
			}
		} else {
			$errors = str_replace(
				'{MESSAGE}', 
				$acc_Language['msg']['error']['msqlerror'], 
				$acc_Language['msg']['error']['wrapper']
			);
		}
	} elseif (
		$acc_GetPost->getString('ac') == 'addsection' &&
		$acc_GetPost->_isSet('sectors')
	) {
		$dummy = $acc_db->executeQuery(
			"INSERT INTO ".TABLE_ACC_NAVMAP." ".
			"(groupid, navid) ".
			"VALUES('".$id."', '".$acc_GetPost->getInt('sectors')."')"
		, 'acc_groups_edit.php');
		if (!$dummy) {
			$errors = str_replace(
				'{MESSAGE}', 
				$acc_Language['msg']['error']['msqlerror'],
				$acc_Language['msg']['error']['wrapper']
			);
		}
	}
}
$groupmembers = $acc_Groups->getGroupMembers($id);
$groupmemberlist = '';
if (is_array($groupmembers)) {
	foreach ($groupmembers as $key) {
		$groupmemberlist .= '<a href="'.ACC_COMPLETE_URL.'index.php?site=acc&amp;subsite=editgroup'.
					'&amp;ac=deletemember&amp;userid='.$key->id.'&amp;id='.$id.'"><img src="'.ACC_COMPLETE_URL.
					'style/gfx/bin_closed.png" border="0" title="'.$key->username.
					' l&ouml;schen" alt="'.$key->username.' l&ouml;schen"></a> '.$key->username.'<br>';
	}
} else {
	$groupmemberlist = $acc_Language['msg']['acc']['nogroupmember'];
}

$sectorlist = $acc_Navigation->getMainEntriesInGroup($id);
$sectors = '';
if (is_array($sectorlist)) {
	foreach ($sectorlist as $key) {
		$sectors .= '<a href="'.ACC_COMPLETE_URL.'index.php?site=acc&amp;subsite=editgroup'.
					'&amp;ac=deletesector&amp;secid='.$key['id'].'&amp;id='.$id.'"><img src="'.ACC_COMPLETE_URL.
					'style/gfx/bin_closed.png" border="0" title="'.$acc_Language['navi'][$key['section']]['main'].
					' l&ouml;schen" alt="'.$acc_Language['navi'][$key['section']]['main'].' l&ouml;schen"></a> '.
					$acc_Language['navi'][$key['section']]['main'].'<br>';
	}
} else {
	$sectors = $acc_Language['msg']['acc']['nogroupsectors'];
}

$acc_Template->setSubTPL('acc_groups_edit');
$acc_Template->assignVars(array(
	'groupname' => $acc_Groups->getGroupName($id),
	'groupdesc' => $acc_Groups->getGroupDescription($id),
	'id' => $id,
	'errors' => $errors,
	'groupmembers' => $groupmemberlist,
	'sectors' => $sectors,
	'sections' => $acc_Tools->genSectorDropDownForGroup(
						$acc_Navigation->getMainEntriesNotInGroup($id), 
						$acc_Language
					)
));

?>