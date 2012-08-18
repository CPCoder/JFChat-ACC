<?php
/*
 * Project		ACC
 * Filename		members_edit.php
 * Author		Steffen Haase
 * Date			11.10.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/SessionManager.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Thirdparty/Swift/lib/swift_required.php';
require_once ACC_PATH_SERVER.'include/functions.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Sesssion = SessionManager::getInstance();
$acc_Template = TplEngine::getInstance();

$js_tools = ACC_PATH_SERVER.'lib/tools.js';
$js_membersedit = ACC_PATH_SERVER.'lib/members_edit.js';
$user = '';
$page = $acc_GetPost->getInt('page');

if ($acc_Config['nickpage']['used'] === true) {
	$np_columns = array('nplock', 'nponlyfriends');
	$registry = array_merge((array)$registry, (array)$np_columns);
	$requiredfields = array_merge((array)$requiredfields, (array)$np_columns);
}

$columns = implode(", ", $registry);

if ($acc_GetPost->getInt('save') == 1 && $_SESSION['csr'] == $acc_GetPost->getString('csr')) {
	$errors = '';
	$flag = true;
	foreach ($requiredfields as $key => $val) {
		if ($val != 'username' && $val != 'password') {
			if (!$acc_GetPost->_isSet($val)) {
				$flag = false;
				$errors .= $acc_Language['msg']['error'][$val];
			}
		}
	}
	if ($acc_GetPost->_isSet('password')) {
		echo 'Passwortfeld gesetzt';
	}
	if ($acc_GetPost->_isSet('password') && strlen($acc_GetPost->getString('password')) < 8) {
		$flag = false;
		$errors .= $acc_Language['msg']['error']['password'];
	}
	if ($acc_GetPost->_isSet('geburtsdatum') && 
		!checkBirthdate($acc_GetPost->getString('geburtsdatum')) && 
		$flag) {
		$flag = false;
		$errors .= $acc_Language['msg']['error']['geburtsdatum'];
	}
	if ($flag === false) {
		$acc_Template->setSubTPL('members_edit');
		foreach ($registry as $key => $val) {
			if ($val != 'password') {
				$acc_Template->assignVar($val, $acc_GetPost->getString($val));
			} else {
				if (strlen($acc_GetPost->getString('password')) >= 8) {
					$acc_Template->assignVar('password', $acc_GetPost->getString('password'));
				}
			}
		}
		$csr = getHash(generate_pass());
		$_SESSION['csr'] = $csr;
		$acc_Template->assignVars(array(
			'errors' => str_replace(
						'{MESSAGE}', 
						'<b>Fehler!</b><br>'.$errors.'<br>', 
						$acc_Language['msg']['error']['wrapper']),
			'csr' => $csr,
			'id' => $id
		));
		if (is_file($js_tools)) {
			$javascript = file_get_contents($js_tools);
			$javascript .= file_get_contents($js_membersedit);
			$acc_Template->assignVar('jscript', $javascript);
		}
	} else {
		$updates = '';
		unset($_SESSION['csr']);
		foreach ($registry as $key => $val) {
			if ($val == 'password') {
				if ($acc_GetPost->_isSet('password') && strlen($acc_GetPost->getString('password')) >= 8) {
					$updates .= ', '.$val.'=\''.md5($acc_GetPost->getString('password')).'\'';
				}
			} else {
				if ($val != 'username') {
					$updates .= ', '.$val.'=\''.$acc_DB->escapeString($acc_GetPost->getString($val)).'\'';
				}
			}
		}
		$updates = substr($updates, 2);
		$dbflag = $acc_DB->executeQuery(
			"UPDATE ".TABLE_JF_REGISTRY." ".
			"SET ".$updates." ".
			"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
		, 'members_edit.php');
		$acc_Template->setSubTPL('sysmessage');
		if ($dbflag === true) {
			$memberurl = 'index.php?site=members&amp;page={PAGE}&amp;'.
							'flag={FLAG}&amp;enc={ENC}&amp;search={SEARCH}&amp;sort={SORT}';
			$sysmessage = $acc_Language['msg']['system']['memberupdateok'];
			$email_text = $acc_Language['mail']['passchange']['text'];
			$email_text = str_replace('{USERNAME}', $acc_GetPost->getString('username'), $email_text);
			$email_text = str_replace('{PASSWORD}', $acc_GetPost->getString('password'), $email_text);
			$email_text = str_replace('{COMURL}', JFCHAT_COMPLETEURL, $email_text);
			$email_text = str_replace('{COMNAME}', JFCHAT_COMNAME, $email_text);
			if (strlen($acc_GetPost->getString('password')) >= 8) {
				$transport = Swift_SmtpTransport::newInstance()
				->setHost($acc_Config['mail']['smtp']['host'])
				->setPort($acc_Config['mail']['smtp']['port'])
				->setEncryption($acc_Config['mail']['encryption'])
				->setUsername($acc_Config['mail']['smtp']['user'])
				->setPassword($acc_Config['mail']['smtp']['pass']);
				$mailer = Swift_Mailer::newInstance($transport);
				$message = Swift_Message::newInstance()
				->setCharset(ACC_CHARSET)
				->setSubject($acc_Language['mail']['passchange']['subject'])
				->setFrom(array($acc_Config['mail']['from'] => $acc_Config['mail']['fromname']))
				->setTo(array($acc_GetPost->getString('emailadresse') => $acc_GetPost->getString('username')))
				->setBody($email_text)
				;
				$sysmessage = $acc_Language['msg']['system']['membersaveok'];
				if (!$mailer->send($message, $failures)) {
					$sysmessage .= print_r($failures, true);
				}
			}
			$acc_Template->assignVars(array(
						'type' => $acc_Language['msg']['type']['sys'],
						'message' => $sysmessage,
						'username' => $acc_GetPost->getString('username'),
						'member_url' => $memberurl
			));
		} else {
			$memberurl = $acc_Config['install']['completeurl'].'index.php?site=members&amp;page={PAGE}&amp;'.
							'flag={FLAG}&amp;enc={ENC}&amp;search={SEARCH}&amp;sort={SORT}';
			$acc_Template->assignVars(array(
						'type' => $acc_Language['msg']['type']['sys'],
						'message' => $acc_Language['msg']['system']['memberupdatenotok'],
						'username' => $acc_GetPost->getString('username'),
						'member_url' => $memberurl
			));
		}
	}
} else {
	$acc_Template->setSubTPL('members_edit');
	$userdata = $acc_DB->queryAssocArray(
				"SELECT id, ".$columns." ".
				"FROM ".TABLE_JF_REGISTRY." ".
				"WHERE id='".$acc_DB->escapeString($acc_GetPost->getInt('id'))."'"
	, 'members_edit.php');
	
	if ($userdata !== false) {
		if ($userdata !== null) {
			foreach ($registry as $key => $val) {
				if ($val != 'password') {
					$acc_Template->assignVar($val, $userdata[0][$val]);
				}
			}
			$acc_Template->assignVar('id', $userdata[0]['id']);
			$csr = getHash(generate_pass());
			$_SESSION['csr'] = $csr;
			$acc_Template->assignVar('csr', $csr);
		} else {
			$acc_Template->assignVar('errors', str_replace('{MESSAGE}',
			$acc_Language['msg']['error']['msqlerror'],
			$acc_Language['msg']['error']['unknowuserid'])
			);
		}
	} else {
		$acc_Template->assignVar('errors', str_replace('{MESSAGE}',
		$acc_Language['msg']['error']['msqlerror'],
		$acc_Language['msg']['error']['wrapper'])
		);
	}
	
	if (is_file($js_tools)) {
		$javascript = file_get_contents($js_tools);
		$javascript .= file_get_contents($js_membersedit);
		$acc_Template->assignVar('jscript', $javascript);
	}
}
$acc_Template->assignVar('page', $page);
if ($acc_GetPost->getInt('flag') == 1) {
	if ($acc_GetPost->getInt('enc') == 1) {
		$acc_Template->assignVar('enc', 1);
		$search = urldecode($acc_GetPost->getString('search'));
	} else {
		$search = $acc_GetPost->getString('search');
	}
	$acc_Template->assignVars(array(
		'search' => $search,
		'flag' => 1
	));
}
if ($acc_GetPost->_isSet('sort')) {
	$acc_Template->assignVar('sort', $acc_GetPost->getString('sort'));
}
?>