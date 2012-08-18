<?php
/*
 * Project		ACC
 * Filename		Navigation.php
 * Author		Steffen Haase
 * Date			05.11.2011
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

/**
 * Klasse für die Generierung der Navigation
 * 
 * Diese Klasse muss nur einmal initialisiert werden und generiert die Navigation 
 * des ACC in Abhängigkeit der Gruppenberechtigungen
 * 
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 * @ignore
 */
class Navigation {
	
	private $_subnavi			= '';
	private $_template;
	private $acc_Language;
	private $_groupids;
	private $_db;
	private static $_instance;
	
	/**
	 * Gibt eine Instanz dieser Klasse zurück.
	 * 
	 * Die Gruppen-IDs müssen in einem String durch Komma getrennt übergeben werden!
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @param Array $lang
	 * @param Integer $groupids
	 * @return Object Instanz dieser Klasse 
	 */
	public static function getInstance(&$acc_Language, &$groupids) {
		if (!isset(self::$_instance)) {
			self::$_instance = new self($acc_Language, $groupids);
		}
		return self::$_instance;
	}
	
	/**
	 * Konstruktor
	 * 
	 * Erzeugt ein Objekt der Klasse
	 * 
	 * @author Steffen Haase, 
	 * @access private
	 * @param Array $lang
	 * @param String $groupids
	 */	
	private function __construct(&$acc_Language, &$groupids) {
		$this->_db			= DBConnect::getInstance();
		$this->_template	= TplEngine::getInstance();
		$this->_lang 		= $acc_Language;
		$this->_groupids 	= $groupids;
	}
	
	/**
	 * 
	 * Diese Methode erstellt die Navigation auf Basis der Gruppenberechtigung des eingeloggten Admins
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @return String HTML-Code der Navigationsleiste
	 */
	public function getNavigation() {
		$navi = '';
		$result = $this->_db->queryObjectArray(
			"SELECT navi.id, navi.section, navi.url, navi.flag ".
			"FROM ".TABLE_ACC_NAVIGATION." AS navi ". 
			"INNER JOIN ".TABLE_ACC_NAVMAP." AS navmap ".
			"ON navi.id=navmap.navid ".
			"WHERE navmap.groupid IN (".$this->_groupids.") ".
			"GROUP BY navi.id ".
			"ORDER BY navi.sort"
		, 'Navigation.php');
		
		if ($result !== false && $result !== null) {
			foreach ($result as $key) {
				if ($key->flag == 1) {
					$this->loadSubEntries($key->id);
				}
				$this->_template->loadTPL('navigation_entry');
				$this->_template->assignVarsTPL(array(
					'navlink' => $key->url,
					'navtext' => $this->_lang['navi'][$key->section]['main'],
					'subnavigation' => $this->_subnavi
				));
				$this->_subnavi = '';
				if ($key->section != 'gallery' && $key->section != 'pictures') {
					$navi .= $this->_template->getTPL();
				} else {
					if ($key->section == 'gallery' && ACC_NPACTIVE) {
						$navi .= $this->_template->getTPL();
					}
					if ($key->section == 'pictures' && ACC_CHECKPICTURES) {
						$navi .= $this->_template->getTPL();
					}
					$this->_template->clearTPL();
				}
			}
			$this->_template->loadTPL('navigation');
			$this->_template->assignVarTPL('naventries', $navi);
			$navi = $this->_template->getTPL();
		}
		return $navi;
	}
	
	/**
	 * Prüft ob der Navigationspunkt weitere Unternavigationen hat.
	 * 
	 * @author Steffen Haase, 
	 * @access private
	 * @param Integer $id ID des Navigationspunktes
	 * @return Boolean
	 */	
	private function hasSubEntries($id) {
		$res = $this->_db->querySingleItem(
			"SELECT COUNT(id) FROM ".TABLE_ACC_SUBNAVIGATION." WHERE navid=".$id
		, 'Navigation.php');
		
		if ($res !== false || $res !== null) {
			return true;
		}
		return false;
	}
	
	/**
	 * Erstellt die Unternavigation eines Navigationspunktes und speichert sie als HTML-Code in einer Klassenvariable ab.
	 * 
	 * @author Steffen Haase, 
	 * @access private
	 * @param Integer $id
	 */
	private function loadSubEntries($id) {
		$subnavi = '';
		$res = $this->_db->queryObjectArray(
			"SELECT section, subsection, url ".
			"FROM ".TABLE_ACC_SUBNAVIGATION." ".
			"WHERE navid=".$id." ".
			"ORDER BY sort"
		, 'Navigation.php');
		
		if ($res !== false && $res !== null) {
			foreach ($res as $key) {
				$this->_template->loadTPL('navigation_entry');
				$this->_template->assignVarsTPL(array(
					'navlink' => $key->url,
					'navtext' => $this->_lang['navi'][$key->section][$key->subsection],
					'subnavigation' => ''
				));
				$subnavi .= $this->_template->getTPL();
			}
			$this->_template->loadTPL('navigation_sublist');
			$this->_template->assignVarTPL('navisublist', $subnavi);
			$this->_subnavi = $this->_template->getTPL();
		}
	}
	
	/**
	 * Gibt die sog. Sections-Bezeichnugnen und deren IDs der Hauptnavigation als Array zurück, welche nicht
	 * in der Gruppe mit der ID $id enthalten sind.
	 * Im Fehlerfall gibt die Mehtode "null" zurück.
	 * 
	 * @author Steffen Haase, 
	 * @access private
	 * @return Array Multiarray mit den IDs und Bezeichnungen der Bereiche
	 */
	private function getMainEntries() {
		$res = $this->_db->queryObjectArray(
			"SELECT id, section ".
			"FROM ".TABLE_ACC_NAVIGATION." ".
			"ORDER BY id"
		, 'Navigation.php');
		if ($res !== false && $res != null) {
			return $res;
		}
		return null;
	}
	
	/**
	 * Listet alle Hauptmenüpunkte auf, welche nicht in der Gruppe mit der ID $id enthalten sind.
	 *  
	 * @author Steffen Haase 
	 * @param Integer $id ID der Gruppe
	 * @return Array Multiarray mit den IDs und Bezeichnungen der Bereiche
	 */
	public function getMainEntriesNotInGroup($id) {
		$entries = $this->getMainEntries();
		$result = array();
		$i=0;
		$flag = false;
		foreach ($entries as $key) {
			if (!$this->isEntryInGroup($key->id,$id)) {
				$result[$i]['id'] = $key->id;
				$result[$i]['section'] = $key->section;
				$i++;
				$flag = true;
			}
		}
		if ($flag === true) {
			return $result;
		}
		return null;
	}
	
	/**
	 * Listet alle Hauptmenüpunkte auf, welche in der Gruppe mit der ID $id enthalten sind.
	 *  
	 * @author Steffen Haase 
	 * @param Integer $id ID der Gruppe
	 * @return Array Multiarray mit den IDs und Bezeichnungen der Bereiche
	 */
	public function getMainEntriesInGroup($id) {
		$entries = $this->getMainEntries();
		$result = array();
		$i=0;
		$flag = false;
		foreach ($entries as $key) {
			if ($this->isEntryInGroup($key->id,$id)) {
				$result[$i]['id'] = $key->id;
				$result[$i]['section'] = $key->section;
				$i++;
				$flag = true;
			}
		}
		if ($flag === true) {
			return $result;
		}
		return null;
	}
	
	/**
	 * Prüft ob ein Navigationspunkt in einer Gruppe enthalten ist.
	 * 
	 * @author Steffen Haase 
	 * @param Integer $navid ID des Navigations-Bereiches
	 * @param Integer $groupid ID der Gruppe
	 * @return Boolean True oder False
	 */
	private function isEntryInGroup($navid, $groupid) {
		$count = $this->_db->queryCount(
			"SELECT navid FROM ".TABLE_ACC_NAVMAP." ".
			"WHERE navid=".$navid." AND groupid=".$groupid
		, 'Navigation.php');
		if ($count !== false && $count !== null && $count > 0) {
			return true;
		}
		return false;
	}
}

?>