<?php
/*
 * Project		ACC
 * Filename		emoticons.php
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

if ($acc_GetPost->_isSet('page')) {
	$page = $acc_GetPost->getInt('page');
} else {
	$page = 1;
}
$start = $page * ACC_MAX_ENTRIES - ACC_MAX_ENTRIES;
$errors = '';
$imagelist = '';
$sitenavigation = '';
$ext = '';
$listflag = true;
$flag = true;
$where = '';
$sort = 'all';
$acc_Template->setSubTPL('emoticons');

if ($acc_GetPost->_isSet('sort')) {
	if (in_array($acc_GetPost->getString('sort'), $orders)) {
		switch ($acc_GetPost->getString('sort')) {
			case 'hidden':
				$where = 'isvisible=0 ';
				break;
			default:
				$where = 'isvisible=1 ';
		}
		$acc_GetPost->setValue('flag', 0);
		$sort = $acc_GetPost->getString('sort');
	}
}
if ($acc_GetPost->_isSet('ac')) {
	if ($acc_GetPost->getString('ac') == 'delete') {
		$acc_DB->executeQuery(
			"DELETE FROM ".TABLE_JF_EMOTICONS." ".
			"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
		, 'emoticons.php');
	}
}
if ($acc_GetPost->getInt('flag') == 1) {
	if ($acc_GetPost->getInt('enc') == 1) {
		$search = trim(urldecode($acc_GetPost->getString('search')));
	} else {
		$search = $acc_GetPost->getString('search');
	}
	if (strlen($search) < 1) {
		$error = $error = str_replace(
								'{message}', 
		$acc_Language['msg']['error']['emptyemosearch'],
		$acc_Language['msg']['error']['color']
		);
		$acc_Template->replaceVar('errors', $error);
	} else {
		$flag = false;
		$ar = $acc_DB->queryObjectArray(
					"SELECT id, quelle, ziel, isvisible ".
					"FROM ".TABLE_JF_EMOTICONS." ".
					"WHERE quelle LIKE '%".$acc_DB->escapeString($search)."%' ".
					"ORDER BY quelle LIMIT $start, ".ACC_MAX_ENTRIES.""
		, 'emoticons.php');

		$count = $acc_DB->queryCount(
					"SELECT COUNT(id) ".
					"FROM ".TABLE_JF_EMOTICONS." ".
					"WHERE quelle LIKE '%".$acc_DB->escapeString($search)."%'"
		, 'emoticons.php');
	}
}
if ($flag === true) {
	$ar = $acc_DB->queryObjectArray(
				"SELECT id, quelle, ziel, isvisible ".
				"FROM ".TABLE_JF_EMOTICONS." ".
				$where.
				"ORDER BY quelle LIMIT $start, ".ACC_MAX_ENTRIES.""
	, 'emoticons.php');

	$where = trim($where);
	$count = $acc_DB->queryCount(
				"SELECT COUNT(id) ".
				"FROM ".TABLE_JF_EMOTICONS." ".
				$where
	, 'emoticons.php');
}
if ($count !== false) {
	$SitesComplete = ceil($count / ACC_MAX_ENTRIES);
	if ($start > $SitesComplete) {
		$start = $SitesComplete;
	}
	if ($flag === false) {
		$ext = 'site=emoticons&amp;flag=1&amp;enc=1&amp;search='.urlencode($search);
	} else {
		$ext = 'site=emoticons&amp;sort='.$sort;
	}
	$sitenavigation = buildCompleteNavigation($acc_Language, $count, $page, $SitesComplete, $ext);
} else {
	$emolist = str_replace(
		'{ERROR}', $acc_Language['msg']['error']['msqlerror'], 
	$acc_Language['msg']['emoticons']['errorline']
	);
	$listflag = false;
}
if ($ar !== false && $listflag === true) {
	if ($ar !== null) {
		$emolist = '';
		$i=0;
		foreach ($ar as $key) {
			$acc_Template->loadTPL('emoticons_list');
			switch ($key->isvisible) {
				case 0:
					$isvisible = $acc_Language['emoticons']['hidden'];
					break;
				default:
					$isvisible = $acc_Language['emoticons']['visible'];
			}
			$emoticon = $acc_Tools->getEmostringHttp(
							$acc_Tools->getEmostringDb($key->ziel),
							$acc_Config['emoticons']['jfchat']
						);
			$acc_Template->assignVarsTPL(array(
				'emo_id' => $key->id,
				'emo_name' => $acc_Config['emoticons']['prefix'].$key->quelle,
				'emo_source' => $emoticon,
				'isvisible' => $isvisible
			));
			if ($i%2) {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color2']);
			} else {
				$acc_Template->assignVarTPL('bgcolor', $acc_Config['table']['cell']['color1']);
			}
			$i++;
			$emolist .= $acc_Template->getTPL();
		}
	} else {
		if ($flag === false) {
			$memberlist = $acc_Language['msg']['emoticons']['nosearchresult'];
		} else {
			$memberlist = $acc_Language['msg']['emoticons']['nomembers'];
		}
	}
} else {
	$memberlist = str_replace(
		'{ERROR}', $acc_Language['msg']['error']['msqlerror'], 
	$acc_Language['msg']['emoticons']['errorline']
	);
}
$acc_Template->assignVars(array(
	'sitenavigation' => $sitenavigation,
	'emolist' => $emolist,
	'page' => $page,
	'ext' => $ext
));



?>