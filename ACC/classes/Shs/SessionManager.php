<?php
/*
 * Project		ACC
 * Filename		SessionManager.php
 * Author		Steffen Haase
 * Date			06.11.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';

/**
 * Klasse für das Session-Management
 * 
 * Diese Klasse enthält Methoden für das Initialisieren und Prüfen einer Session.
 * 
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 * @ignore
 */
class SessionManager {
	
	private $_db				= null;
	private $_UserID			= 0;
	private $_UserLoggedIn		= false;
	private $_SessionExpiration	= 1800;
	private static $_instance;

	/**
	 * Erzeugt eine Instanz dieser Klasse
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @return Instanz dieser Klasse
	 */
	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * Konstruktor
	 * 
	 * @author Steffen Haase 
	 * @access private
	 */
	private function __construct() {
		$this->db = DBConnect::getInstance();
		if (defined('ACC_SESSION_EXPIRATION') && ACC_SESSION_EXPIRATION > 0) {
			$this->_SessionExpiration = (ACC_SESSION_EXPIRATION * 60);
		}
	}
	
	/**
	 * Gibt die ID des Users zurück.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @return Integer ID des Users
	 */
	public function getUserID() {
		return $this->_UserID;
	}
	
	/**
	 * Setzt alle notwendigen Uservariablen in dieser Klasse
	 * 
	 * @author Steffen Haase 
	 * @access public
	 */
	public function setUserData() {
		$this->_UserID			= $_SESSION['userid'];
		$this->_UserLoggedIn	= $_SESSION['loggedin'];
	}
	
	/**
	 * Setzt alle Variablen dieser Klasse auf die Standardwerte zurück.
	 * 
	 * @author Steffen Haase 
	 * @access private
	 * @ignore
	 */
	private function clearUserData() {
		$this->_UserID				= null;
		$this->_UserLoggedIn		= false;
	}
	
	/**
	 * Prüft ob der User eingeloggt ist.
	 * @author Steffen Haase 
	 * @access public
	 * @return Boolean true oder false 
	 */
	public function isLoggedin() {
		return $this->_UserLoggedIn;
	}
	
	/**
	 * Initialisiert eine Session
	 * 
	 * @author Steffen Haase 
	 * @access public
	 */
	public function initSession() {
		if (isset($_SESSION['userid'])) {
			$this->setUserData();
		} else {
			$this->clearUserData();
		}
	}
	
	/**
	 * Prüft ob die Session abgelaufen ist.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 */
	public function checkSession() {
		if (isset($_SESSION['session_creation_time'])) {
			if (($_SESSION['session_creation_time'] + $this->_SessionExpiration) < time()) {
				if ($this->_UserLoggedIn) {
					$this->clearUserData();
					session_write_close();
					header('Location: index.php?site=sessionexp');
				} else {
					$_SESSION['session_creation_time'] = time();
				}
			} else {
				$_SESSION['session_creation_time'] = time();
			}
		} else {
			$_SESSION['session_creation_time'] = time();
		}
	}
	
	/**
	 * Schliesst die Session
	 * 
	 * @author Steffen Haase 
	 * @access public
	 */
	public function closeSession() {
		$_SESSION['userid']		= $this->_UserID;
		$_SESSION['loggedin']	= $this->_UserLoggedIn;
	}
	
	/**
	 * Setzt alle Klassenvariablen auf Standardwerte zurück und löscht die Session-Daten
	 * 
	 * @author Steffen Haase 
	 * @access public
	 */
	public function signOut() {
		$this->clearUserData();
		unset($_SESSION['userid']);
		unset($_SESSION['loggedin']);
		session_destroy();
	}
	
}

?>