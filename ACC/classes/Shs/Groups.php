<?php
/*
 * Project		ACC
 * Filename		class.groups.php
 * Author		Steffen Haase
 * Date			06.11.2011
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';

/**
 * Klasse für Gruppen Daten
 * 
 * Diese Klasse enthält Methoden zum Abfragen verschiedener Daten zu den Gruppen.
 * 
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 */
class Groups {
	
	private $_db;
	private static $_instance;
	
	/**
	 * Gibt eine Instanz dieser Klasse zurück.
	 *
	 * @author Steffen Haase, 
	 * @access public
	 * @return Object Instanz dieser Klasse 
	 */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
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
	 */
	private function __construct() {
		$this->_db = DBConnect::getInstance();
	}
	
	/**
	 * Diese Methode gibt alle Gruppen eines ACC-Users zurück.
	 *
	 * Werden keine Gruppeninformationen gefunden, gibt die Methode <b>null</b> zurück!
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @param Integer $id ID des Users
	 * @return Array Multiarray mit den Gruppeninformationen als Objekt
	 */
	public function getUserGroups($id) {
		$result = $this->_db->queryObjectArray(
			"SELECT gmap.groupid, g.name, g.description ".
			"FROM ".TABLE_ACC_GROUPMAP." AS gmap ".
			"LEFT JOIN ".TABLE_ACC_GROUPS." AS g ".
			"ON gmap.groupid=g.id ".
			"WHERE gmap.userid='".$this->_db->escapeString($id)."'"
		, 'Groups.php');
		if ($result !== false && $result !== null) {
			return $result;
		}
		return null;
	}
	
	/**
	 * Gibt die Gruppen-IDs zurück
	 *  
	 * Werden keine Gruppen-IDs gefunden, gibt die Methode <b>null</b> zurück.
	 * 
	 * @author Steffen Haase 
	 * @access private
	 * @param Integer $id ID des Users
	 * @return Array Ein Array mit den Gruppen-IDs, oder null
	 */
	public function getGroupIDs($id) {
		$usergroups = $this->getUserGroups($id);
		$groupids = array();
		if ($usergroups !== null) {
			foreach ($usergroups as $key) {
				$groupids[] = $key->groupid;
			}
			return $groupids;
		}
		return null;
	}
	
	/**
	 * Gibt die Gruppen-IDs als String durch Komma getrennt zurück.
	 * 
	 * Werden keine Gruppen-IDs gefunden, gibt die Methode <b>null</b> zurück.
	 * 
	 * @author Steffen Haase 
	 * @access private
	 * @param Integer $id ID des Users
	 * @return String Gruppen-IDs durch Komma getrennt als String
	 */
	public function getGroupIDsAsString($id) {
		$usergroups = $this->getUserGroups($id);
		$groupids = array();
		if ($usergroups !== null) {
			foreach ($usergroups as $key) {
				$groupids[] = $key->groupid;
			}
			$idsstring = implode(',', $groupids);
			return $idsstring;
		}
		return null;
	}
	
	/**
	 * Diese Methode gibt die Berechtigungen einer Gruppe zurück.
	 * 
	 * Werden keine Berechtiguns-Informationen gefunden, so gibt die Methode <b>null</b> zurück.
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @param Integer $id ID der Gruppe
	 * @return Array Sortiertes Array mit den Berechtigungs-Informationen
	 */
	public function getGroupPermissions($id) {
		$sections = array();
		$result = $this->_db->queryObjectArray(
			"SELECT nav.section ".
			"FROM ".TABLE_ACC_NAVMAP." AS navmap ".
			"LEFT JOIN ".TABLE_ACC_NAVIGATION." AS nav ".
			"ON navmap.navid=nav.id ".
			"WHERE navmap.groupid IN(".$id.") ".
			"GROUP BY nav.section"
		, 'Groups.php');
		if ($result !== false && $result !== null) {
			foreach ($result as $key) {
				$sections[] = $key->section;
			}
			sort($sections);
			return $sections;
		}
		return null;
	}
	
	/**
	 * Gibt die Namen der Gruppen zurück, die dem User zugeordnet sind.<br><br>
	 * 
	 * Werden keine Gruppen-Informationen gefunden, so gibt diese Methode <b>null</b> zurück!
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param Integer $id ID des Users
	 * @return Array Ein sortiertes Array mit den Namen der Gruppen
	 */
	public function getGroupNamesForUser($id) {
		if (!is_null(($usergroups = $this->getUserGroups($id)))) {
			$groups = array();
			foreach ($usergroups as $key => $val) {
				$groups[] = $val->name;
			}
			sort($groups);
			return $groups;
		}
		return null;
	}
	
	/**
	 * 
	 * @author Steffen Haase 
	 * @ignore
	 */
	public function getAllGroups()  {
		
	}
	
	/**
	 * Gibt die Mitglieder zurück, wlche in der Gruppe enthalten sind.<br><br>
	 * 
	 * Werden keine Mitglieder gefunden, so gibt diese Methode <b>null</b> zurück!
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param Integer $id ID der Gruppe
	 * @return Array Multiarray mit den IDs und Namen der Mitglieder 
	 */
	public function getGroupMembers($id) {
		$res = $this->_db->queryObjectArray(
				"SELECT reg.id, reg.username ".
				"FROM ".TABLE_JF_REGISTRY." AS reg ".
				"INNER JOIN ".TABLE_ACC_GROUPMAP." AS gmap ".
				"ON gmap.userid=reg.id ".
				"WHERE gmap.groupid='".$id."' ".
				"ORDER BY reg.username"
			, 'Groups.php');
		if ($res !== false && $res !== null) {
			return $res;
		}
		return null;
	}
	
	/**
	 * Gibt den Namen der Gruppe zurück.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param Integer $id ID der Gruppe
	 * @return String Name der Gruppe
	 */
	public function getGroupName($id) {
		$res = $this->_db->querySingleItem(
				"SELECT name ".
				"FROM ".TABLE_ACC_GROUPS." ".
				"WHERE id=".$id
			, 'Groups.php');
		if ($res !== false && $res !== null) {
			return $res;
		}
		return null;
	}
	
	/**
	 * Gibt die Beschreibung der Gruppe zurück.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param Integer $id ID der Gruppe
	 * @return String Beschreibung der Gruppe
	 */
	public function getGroupDescription($id) {
		$res = $this->_db->querySingleItem(
						"SELECT description ".
						"FROM ".TABLE_ACC_GROUPS." ".
						"WHERE id=".$id
		, 'Groups.php');
		if ($res !== false && $res !== null) {
			return $res;
		}
		return null;
	}
	
	/**
	 * Gibt die ID der Gruppe zurück.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param Integer $id ID der Gruppe
	 * @return String Name der Gruppe
	 */
	public function getGroupID($name) {
		$res = $this->_db->querySingleItem(
				"SELECT id ".
				"FROM ".TABLE_ACC_GROUPS." ".
				"WHERE name='".$this->_db->escapeString($name)."'"
			, 'Groups.php');
		if ($res !== false && $res !== null) {
			return $res;
		}
		return null;
	}
	
	/**
	 * Prüft ob schon eine Gruppe mit dem Namen $name existiert.
	 * 
	 * @author Steffen Haase 
	 * @param String $name Name der Gruppe
	 * @return Boolean true oder false
	 */
	public function existsGroup($name) {
		$count = $this->_db->queryCount(
			"SELECT id FROM ".TABLE_ACC_GROUPS." ".
			"WHERE name='".$this->_db->escapeString($name)."'"
		, 'Groups.php');
		if ($count !== false && $count != null && $count > 0) {
			return true;
		}
		return false;
	}
}

?>