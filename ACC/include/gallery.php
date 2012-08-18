<?php
/*
 * Project		ACC
 * Filename		gallery.php
 * Author		Steffen Haase
 * Date			11.01.2012
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
	$dummy = $acc_DB->executeQuery(
		"UPDATE ".TABLE_ACC_GALIMAGES." ".
		"SET locked=0 ".
		"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
	, 'gallery.php');
	if ($dummy === true) {
		$user = $acc_DB->queryObjectArray(
			"SELECT reg.username, reg.emailadresse ".
			"FROM ".TABLE_JF_REGISTRY." AS reg ".
			"INNER JOIN ".TABLE_ACC_GALIMAGES." AS img ".
			"ON img.userid=reg.id ".
			"WHERE img.id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."' AND reg.aktiv=1"
		, 'gallery.php');
		if ($user !== false && $user !== null) {
			$email_text = $acc_Language['mail']['gallery']['accept'];
			$email_text = str_replace('{USERNAME}', $user[0]->username, $email_text);
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
			->setSubject($acc_Language['mail']['gallery']['subject'])
			->setFrom(array($acc_Config['mail']['from'] => $acc_Config['mail']['fromname']))
			->setTo(array($user[0]->emailadresse => $user[0]->username))
			->setBody($email_text)
			;
			if (!$mailer->send($message, $failures)) {
				$errors = print_r($failures, true);
			} else {
				$errors = $acc_Language['gallery']['accept'];
			}
		} else {
			$errors = str_replace(
				'{MESSAGE}', 
				$acc_Language['msg']['error']['msqlerror'], 
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
	$acc_GetPost->_isSet('ac') &&
	$acc_GetPost->getString('ac') == 'declined' &&
	$acc_GetPost->_isSet('id')
) {
	$result = $acc_DB->queryObjectArray(
				"SELECT reg.username, reg.emailadresse, img.image ".
				"FROM ".TABLE_JF_REGISTRY." AS reg ".
				"INNER JOIN ".TABLE_ACC_GALIMAGES." AS img ".
				"ON img.userid=reg.id ".
				"WHERE img.id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."' AND reg.aktiv=1"
	, 'gallery.php');
	if ($result !== false && $result !== null) {
		$image = $acc_Config['nickpage']['path']['server'].'gallery/'.$result[0]->image;
		$file = new File();
		if ($file->deleteFile($image)) {
			$dummy = $acc_DB->executeQuery(
				"DELETE FROM ".TABLE_ACC_GALIMAGES." ".
				"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
			, 'gallery.php');
			$email_text = $acc_Language['mail']['gallery']['declined'];
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
			->setSubject($acc_Language['mail']['gallery']['subject'])
			->setFrom(array($acc_Config['mail']['from'] => $acc_Config['mail']['fromname']))
			->setTo(array($result[0]->emailadresse => $result[0]->username))
			->setBody($email_text);
			if (!$mailer->send($message, $failures)) {
				$errors = print_r($failures, true);
			} else {
				$errors = $acc_Language['gallery']['declined'];
			}
		} else {
			$errors = str_replace(
				'{MESSAGE}', 
				$acc_Language['msg']['error']['filenotdeleted'], 
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
}

$result = $acc_DB->queryObjectArray(
	"SELECT ".
		"img.id, img.title, img.image, reg.username ".
	"FROM ".TABLE_ACC_GALIMAGES." AS img ".
	"LEFT JOIN ".TABLE_JF_REGISTRY." AS reg ".
	"ON img.userid=reg.id ".
	"WHERE img.locked=1 AND reg.aktiv=1 ".
	"ORDER BY img.id ".
	"LIMIT $start, ".ACC_MAX_ENTRIES.""
, 'gallery.php');
$count = $acc_DB->queryCount(
				"SELECT COUNT(img.id) ".
				"FROM ".TABLE_ACC_GALIMAGES." AS img ".
				"INNER JOIN ".TABLE_JF_REGISTRY." AS reg ".
				"ON reg.id=img.userid ".
				"WHERE img.locked=1 AND reg.aktiv=1"
, 'gallery.php');
if ($count !== false) {
	$SitesComplete = ceil($count / ACC_MAX_ENTRIES);
	if ($start > $SitesComplete) {
		$start = $SitesComplete;
	}
	$ext = 'site=gallery';
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
			$image_url = 'http://'.$acc_Config['install']['domain'].$acc_Config['nickpage']['path']['http'].'gallery/'.$key->image;
			$acc_Template->loadTPL('gallery_list');
			$acc_Template->assignVarsTPL(array(
				'image_url' => $image_url,
				'title' => $key->title,
				'username' => $key->username,
				'id' => $key->id
			));
			$imagelist .= $acc_Template->getTPL();
		}
	} else {
		$imagelist = $acc_Language['gallery']['noimages'];
	}
} else {
	$errors = str_replace(
		'{MESSAGE}', 
		$acc_Language['msg']['error']['msqlerror'], 
		$acc_Language['msg']['error']['wrapper']
	);
}

$acc_Template->setSubTPL('gallery');
$acc_Template->assignVars(array(
	'sitenavigation' => $sitenavigation,
	'imagelist' => $imagelist,
	'page' => $page,
	'ext' => $ext,
	'errors' => $errors
));

?>