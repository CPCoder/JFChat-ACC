<?php
/*
 * Project		
 * Filename		pictures.php
 * Author		Steffen Haase
 * Date			13.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/User.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Thirdparty/Swift/lib/swift_required.php';
require_once ACC_PATH_SERVER.'classes/Shs/File.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();

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

if (
$acc_GetPost->_isSet('ac') &&
$acc_GetPost->getString('ac') == 'accepted' &&
$acc_GetPost->_isSet('id')
) {
	// Bild freischalten
	$from = $acc_Config['pictures']['path']['server']['up'].$acc_GetPost->getInt('id').'.jpg';
	$to = $acc_Config['pictures']['path']['server']['save'].$acc_GetPost->getInt('id').'.jpg';
	$file = new File();
	if ($file->moveFile($from, $to)) {
		$bild = $acc_Config['pictures']['db'].$acc_GetPost->getInt('id').'.jpg';
		$dummy = $acc_DB->executeQuery(
			"UPDATE ".TABLE_JF_REGISTRY." ".
			"SET bild='".$bild."', bildlocked=0 ".
			"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
		, 'pictures.php');
		if ($dummy === true) {
			$result = $acc_DB->queryObjectArray(
						"SELECT username, emailadresse ".
						"FROM ".TABLE_JF_REGISTRY." ".
						"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
			, 'pictures.php');
			if ($result !== false) {
				$email_text = $acc_Language['mail']['pictures']['accept'];
				$email_text = str_replace('{USERNAME}', $result[0]->username, $email_text);
				$email_text = str_replace('{COMNAME}', JFCHAT_COMNAME, $email_text);
				$transport = Swift_SmtpTransport::newInstance()
				->setHost($acc_Config['mail']['smtp']['host'])
				->setPort($acc_Config['mail']['smtp']['port'])
				->setEncryption($acc_Config['mail']['encryption'])
				->setUsername($acc_Config['mail']['smtp']['user'])
				->setPassword($acc_Config['mail']['smtp']['pass']);
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance()
				->setCharset(ACC_CHARSET)
				->setSubject($acc_Language['mail']['pictures']['subject'])
				->setFrom(array($acc_Config['mail']['from'] => $acc_Config['mail']['fromname']))
				->setTo(array($result[0]->emailadresse => $result[0]->username))
				->setBody($email_text);
				if (!$mailer->send($message, $failures)) {
					$errors = print_r($failures, true);
				} else {
					$errors = $acc_Language['pictures']['accept'];
				}
			} else {
				$imagelist = str_replace(
								'{ERRORS}', 
				$acc_Language['msg']['error']['msqlerror'],
				$acc_Language['msg']['members']['errorline']
				);
			}
		}
	} else {
		$errors = str_replace(
				'{MESSAGE}', 
		$acc_Language['msg']['error']['filenotcopy'],
		$acc_Language['msg']['error']['wrapper']
		);
	}
} elseif (
	$acc_GetPost->_isSet('ac') &&
	$acc_GetPost->getString('ac') == 'declined' &&
	$acc_GetPost->_isSet('id')
) {
	$image = $acc_Config['pictures']['path']['server']['up'].$acc_GetPost->getInt('id').'.jpg';
	$file = new File();
	if ($file->deleteFile($image)) {
		$dummy = $acc_DB->executeQuery(
			"UPDATE ".TABLE_JF_REGISTRY." ".
			"SET bildlocked=0 ".
			"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
		, 'pictures.php');
		if ($dummy === true) {
			$result = $acc_DB->queryObjectArray(
				"SELECT username, emailadresse ".
				"FROM ".TABLE_JF_REGISTRY." ".
				"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
			, 'pictures.php');
			if ($result !== false) {
				$email_text = $acc_Language['mail']['pictures']['declined'];
				$email_text = str_replace('{USERNAME}', $result[0]->username, $email_text);
				$email_text = str_replace('{COMNAME}', JFCHAT_COMNAME, $email_text);
				$transport = Swift_SmtpTransport::newInstance()
				->setHost($acc_Config['mail']['smtp']['host'])
				->setPort($acc_Config['mail']['smtp']['port'])
				->setEncryption($acc_Config['mail']['encryption'])
				->setUsername($acc_Config['mail']['smtp']['user'])
				->setPassword($acc_Config['mail']['smtp']['pass']);
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance()
				->setCharset(ACC_CHARSET)
				->setSubject($acc_Language['mail']['pictures']['subject'])
				->setFrom(array($acc_Config['mail']['from'] => $acc_Config['mail']['fromname']))
				->setTo(array($result[0]->emailadresse => $result[0]->username))
				->setBody($email_text);
				if (!$mailer->send($message, $failures)) {
					$errors = print_r($failures, true);
				} else {
					$errors = $acc_Language['pictures']['declined'];
				}
			} else {
				$imagelist = str_replace(
						'{ERRORS}', 
				$acc_Language['msg']['error']['msqlerror'],
				$acc_Language['msg']['members']['errorline']
				);
			}
		}
	} else {
		$errors = str_replace(
						'{MESSAGE}', 
		$acc_Language['msg']['error']['filenotdeleted'],
		$acc_Language['msg']['error']['wrapper']
		);
	}
}

$result = $acc_DB->queryObjectArray(
	"SELECT id, username, lockedbild ".
	"FROM ".TABLE_JF_REGISTRY." ".
	"WHERE bildlocked=1 AND aktiv=1 ".
	"ORDER BY username ".
	"LIMIT $start, ".ACC_MAX_ENTRIES.""
, 'pictures.php');
$count = $acc_DB->queryCount(
				"SELECT COUNT(id) ".
				"FROM ".TABLE_JF_REGISTRY." ".
				"WHERE bildlocked=1 and aktiv=1"
, 'pictures.php');
if ($count !== false) {
	$SitesComplete = ceil($count / ACC_MAX_ENTRIES);
	if ($start > $SitesComplete) {
		$start = $SitesComplete;
	}
	$ext = 'site=pictures';
	$sitenavigation = buildCompleteNavigation($acc_Language, $count, $page, $SitesComplete, $ext);
} else {
	$imagelist = str_replace(
		'{ERRORS}', 
	$acc_Language['msg']['error']['msqlerror'],
	$acc_Language['msg']['members']['errorline']
	);
	$listflag = false;
}
if ($result !== false) {
	if ($result !== null) {
		foreach ($result as $key) {
			$image_url = 'http://'.$acc_Config['install']['domain'].$acc_Config['pictures']['path']['http']['up'].$key->id.'.jpg';
			$acc_Template->loadTPL('pictures_list');
			$acc_Template->assignVarsTPL(array(
				'image_url' => $image_url,
				'title' => $key->username,
				'username' => $key->username,
				'id' => $key->id
			));
			$imagelist .= $acc_Template->getTPL();
		}
	} else {
		$imagelist = $acc_Language['pictures']['noimages'];
	}
} else {
	$errors = str_replace(
		'{MESSAGE}', 
	$acc_Language['msg']['error']['msqlerror'],
	$acc_Language['msg']['error']['wrapper']
	);
}

$acc_Template->setSubTPL('pictures');
$acc_Template->assignVars(array(
	'sitenavigation' => $sitenavigation,
	'imagelist' => $imagelist,
	'page' => $page,
	'ext' => $ext,
	'errors' => $errors
));




?>