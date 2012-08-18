<?php
/*
 * Project		ACC
 * Filename		emoticons_edit.php
 * Author		Steffen Haase
 * Date			29.01.2012
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

if ($acc_GetPost->getString('ac') == 'save') {
	$acc_GetPost->getInt('isvisible') == 1 ? $visible = 1 : $visible = 0;
	$query = $acc_DB->executeQuery(
		"UPDATE ".TABLE_JF_EMOTICONS." ".
		"SET quelle='".$acc_DB->escapeString($acc_GetPost->getString('name'))."', ".
			"ziel='".$acc_DB->escapeString($acc_GetPost->getString('url'))."', ".
			"isvisible=".$visible." ".
		"WHERE id='".$acc_DB->escapeString($acc_GetPost->getString('id'))."' "
	, 'emoticons_edit.php');
	if ($query !== false) {
		header('location: index.php?site=emoticons');
	} else {
		$acc_Template->setSubTPL('sysmessage');
		$acc_Template->assignVars(array(
					'type' => $acc_Language['msg']['type']['err'],
					'message' => $acc_Language['msg']['error']['msqlerror']
		));
	}
} else {
	$acc_Template->setSubTPL('emoticons_edit');
	$ar = $acc_DB->queryObjectArray(
			"SELECT id, quelle, ziel, isvisible ".
			"FROM ".TABLE_JF_EMOTICONS." ".
			"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
	, 'emoticons_edit.php');
	
	foreach ($ar as $key) {
		$emoticon = $acc_Tools->getEmostringHttp(
			$acc_Tools->getEmostringDb($key->ziel),
			$acc_Config['emoticons']['jfchat']
		);
		$checked1 = '';
		$checked2 = '';
		if ($key->isvisible == 1) {
			$checked1 = ' checked';
		} else {
			$checked2 = ' checked';
		}
		$acc_Template->assignVars(array(
							'emo_id' => $key->id,
							'emo_url' => $acc_Tools->getEmostringDb($key->ziel),
							'emo_name' => $key->quelle,
							'preview_url' => $emoticon,
							'emo_prefix' => $acc_Config['emoticons']['prefix'],
							'checked_1' => $checked1,
							'checked_2' => $checked2
		));
	}
	if (is_file($js_emoedit)) {
		$javascript = file_get_contents($js_emoedit);
	}
	$acc_Template->assignVars(array(
		'jscript' => $javascript,
		'domain' => ACC_COMPLETE_URL
	));
}

?>