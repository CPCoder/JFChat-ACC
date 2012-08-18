<?php
/*
 * Project		ACC
 * Filename		api_emo.php
 * Author		Steffen Haase
 * Date			07.04.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'config/config.php';
require_once ACC_PATH_SERVER.'config/defines.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/Tools.php';
require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';


$acc_GetPost = Request::getInstance();
$acc_Tools = Tools::getInstance();
$acc_DB = DBConnect::getInstance();

if ($acc_GetPost->_isSet('namecheck')) {
	$name = $acc_GetPost->getString('namecheck');
	$ar = $acc_DB->queryObjectArray(
			"SELECT id FROM ".
			TABLE_JF_EMOTICONS." ".
			"WHERE quelle LIKE '".$acc_DB->escapeString($acc_GetPost->getString('namecheck'))."%' ".
			"AND id!=".$acc_GetPost->getInt('id')." "
		, 'api_emo.php');
	if ($ar !== null && $ar !== false) {
		echo json_encode(array('flag' => true));
	} else {
		echo json_encode(array('flag' => false));
	}
	
} elseif ($acc_GetPost->_isSet('url')) {
	$emoticon = $acc_Tools->getEmostringHttp(
		$acc_GetPost->getString('url'),
		$acc_Config['emoticons']['jfchat']
	);
	$ar = array(
		'http' => $emoticon
	);
	echo json_encode($ar);
} else {
	echo '';
}

?>