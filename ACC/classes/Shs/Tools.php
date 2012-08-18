<?php
/*
 * Project		
 * Filename		Tools.php
 * Author		Steffen Haase
 * Date			08.01.2012
 * License		GPL v3
 * 
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';

/**
* Klasse mit verschiedenen Tools
*
* Diese Klasse beinhaltet verschiedene Methoden für Berechnungen.
*
* @package Shs
* @author Steffen Haase 
* @version 1.0
* @ignore
*/
class Tools {
	
	private $_db;
	private static $_instance;
	
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	private function __construct() {
		$this->_db = DBConnect::getInstance();
	}
	
	public function genSectorDropDownForGroup($naventries, $acc_Language) {
		$list = '';
		foreach ($naventries as $key) {
			$list .= '<option value="'.$key['id'].'">'.$acc_Language['navi'][$key['section']]['main'].'</option>';
		}
		return $list;
	}
	
	public function isRegisteredName($name) {
		$result = $this->_db->querySingleItem(
			"SELECT id FROM ".TABLE_JF_REGISTRY." WHERE username='".$this->_db->escapeString($name)."' ".
			"AND aktiv='1'"
		, 'Tools.php');
		if ($result !== false) {
			if ($result !== null) {
				return true;
			}
			return false;
		}
		return null;
	}
	
	public function getUserID($name) {
		$result = $this->_db->querySingleItem(
					"SELECT id FROM ".TABLE_JF_REGISTRY." WHERE username='".$this->_db->escapeString($name)."' ".
					"AND aktiv='1'"
		, 'Tools.php');
		if ($result !== false && $result !== null) {
			return $result;
		}
		return null;
	}
	
	public function isInGroup($groupid, $userid) {
		$result = $this->_db->querySingleItem(
							"SELECT userid ".
							"FROM ".TABLE_ACC_GROUPMAP." ".
							"WHERE userid='".$userid."' AND groupid='".$groupid."'"
		, 'Tools.php');
		if ($result !== false && $result !== null) {
			return true;
		}
		return false;
	}
	
	public function getEmostringDb($emo) {
		if (strstr($emo, '"')) {
			$pos = strpos($emo, '"')+1;
			$emo = substr($emo, $pos);
			$pos = strpos($emo, '"');
			$emo = substr($emo, 0, $pos);
		}
		return $emo;
	}
	
	public function getEmostringHttp($emo,$flag) {
		if ($flag === true) {
			$emo = str_replace(
				'../EMOS/',
				JFCHAT_URL.'/EMOS/',
				$emo
			);
			$emo = str_replace(
				'../FORUM/',
				JFCHAT_URL.'/FORUM/',
				$emo
			);
			$emo = str_replace(
				'../forum/',
				JFCHAT_URL.'/forum/',
				$emo
			);
			$emo = str_replace(
				'../emos/',
				JFCHAT_URL.'/emos/',
				$emo
			);
			$emo = str_replace(
				'../',
				JFCHAT_URL.'/',
				$emo
			);
		} else {
			if (!strstr($emo, 'http://')) {
				$emo = 'http://'.$acc_Config['jfchat']['domain'].
				$acc_Config['emoticons']['path']['http'].
				$emo;
			}
		}
		return $emo;
	}
	
}

?>