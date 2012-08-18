<?php
/*
 * Project		ACC
 * Filename		class.dbconnect.php
 * Author		Steffen Haase
 * Date			03.10.2011
 * License		GPL v3
 */

/**
 * DBConnect
 * 
 * Dient zum Ausführen von MySQL-Querys über die MySQLi-Klasse
 *
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 */
class DBConnect
{

	protected $_mysqli			= false;
	private $_debugmsg;
	private $_installflag		= false;
	private $_installerror;
	private $_installerrflag	= false;
	private static $_instance;
	
	/**
	 * Gibt eine Instanz dieser Klasse zurück.
	 * 
	 * @author Steffen Haase, 
	 * @access public
	 * @param Array $config
	 * @param Boolean $install (Optional)
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
	 * Erzeugt ein Objekt dieser Klasse.
	 *
	 * @author Steffen Haase, 
	 * @access private
	 * @param Array $config
	 * @param Boolean $install (Optional)
	 */
	private function __construct() {
		$this->_installflag = ACC_INSTALL;
		$this->_mysqli = new mysqli(
				ACC_DB_HOST,
				ACC_DB_USER,
				ACC_DB_PASS,
				ACC_DB_NAME,
				ACC_DB_PORT
			);
		if (mysqli_connect_errno()) {
			if ($this->_installflag === true) {
				$this->_installerrflag = true;
			} else {
				$this->_mysqli = false;
				exit();
			}
		}else{
			$this->_mysqli->query("SET NAMES '".ACC_DB_CHAR."'");
			$this->_mysqli->query("SET CHARACTER SET '".ACC_DB_CHAR."'");
		}
	}

	/**
	 * 
	 * @ignore
	 * @author Steffen Haase 
	 */
	public function hasInstallerError() {
		return $this->_installerrflag;
	}
	
	/**
	 *
	 * @ignore
	 */
	public function __destruct() {
		$this->close();
	}

	/**
	 *
	 * Beendet die Verbindung zur Datenbank
	 *
	 * @author Steffen Haase, info@sh-software.de
	 * @ignore
	 */
	public function close() {
		if ($this->_mysqli) {
			$this->_mysqli->close();
			$this->_mysqli = false;
		}
	}

	/**
	 *
	 * Führt das Query "$sql" in der Datenbank aus und gibt das Ergebnis als Array mit Objekten zurück.
	 * Diese Methode sollte bei Anfragen genutzt werden, die mehr als eine Spalte, oder eine Zeile betreffen!<br><br>
	 * 
	 * Im Falle eines Fehlers gibt die Methode <b>false</b> zurück und im Falle von nicht gefundenen Datensätzen <b>null</b>.
	 *
	 * @author Steffen Haase, 
	 * @param String $sql Query welches ausgeführt werden soll
	 * @param String $script Name der Datei, von welcher aus diese Funktion aufgerufen wird
	 * @return Array Ein Multiarray, oder false/null  
	 */
	public function queryObjectArray($sql, $script) {
		if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
			$this->printSQL($sql, $script);
		}
		try {
			if ($result = $this->_mysqli->query($sql)) {
				if ($result->num_rows) {
					while ($row = $result->fetch_object()) {
						$result_array[] = $row;
					}
					$result->close();
					return $result_array;
				} else {
					return null;
				}
			} else {
				throw new Exception('<font color="#ff0000"><b>Error: '.htmlentities($this->_mysqli->error).'</b></font><br>');
			}
		} catch (Exception $e) {
			if (ACC_DEBUGMODE || $this->_installflag) {
				$this->addDebugMessage($e->getMessage().'<b>Stack trace:</b><br>'.$e->getTraceAsString().'<br>');
			}
			$this->printLog($this->_mysqli->error, $sql, $script);
			return false;
		}
	}

	/**
	 *
	 * Führt das Query "$sql" in der Datenbank aus und gibt das Ergebnis als Assoc-Array zurück.
	 * Diese Methode sollte bei Anfragen genutzt werden, die mehr als eine Spalte, oder eine Zeile betreffen!<br><br>
	 * 
	 * Im Falle eines Fehlers gibt die Methode <b>false</b> zurück, bzw. <b>null</b> wenn kein Datensatz gefunden wurde.
	 *
	 * @author Steffen Haase, 
	 * @param String $sql Query welches ausgeführt werden soll
	 * @param String $script Name der Datei, von welcher aus diese Funktion aufgerufen wird
	 * @return Array Ein Multiarray, oder false/null 
	 */
	public function queryAssocArray($sql, $script) {
		if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
			$this->printSQL($sql, $script);
		}
		try {
			if ($result = $this->_mysqli->query($sql)) {
				if ($result->num_rows) {
					while ($row = $result->fetch_assoc()) {
						$result_array[] = $row;
					}
					$result->close();
					return $result_array;
				} else {
					return null;
				}
			} else {
				throw new Exception('<font color="#ff0000"><b>Error: '.htmlentities($this->_mysqli->error).'</b></font><br>');
			}
		} catch (Exception $e) {
			if (ACC_DEBUGMODE || $this->_installflag) {
				$this->addDebugMessage($e->getMessage().'<b>Stack trace:</b><br>'.$e->getTraceAsString().'<br>');
			}
			$this->printLog($this->_mysqli->error, $sql, $script);
			return false;
		}
	}

	/**
	 * Führt das Query "$sql" in der Datenbank aus und gibt das Ergebnis als Menge zurück.
	 * Diese Methode sollte benutzt werden, wenn nur die Menge der betroffenen Datensätze
	 * abzufragen ist.<br><br>
	 * 
	 * Im Falle eines Fehlers gibt die Methode <b>false</b> oder <b>null</b> zurück.
	 * 
	 * @author Steffen Haase, info@sh-software.de
	 * @param String $sql Query welches ausgeführt werden soll
	 * @param String $script Name der Datei, von welcher aus diese Funktion aufgerufen wird
	 * @return Integer Die Anzahl der Datensätze. 
	 */
	public function queryCount($sql, $script) {
		if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
			$this->printSQL($sql, $script);
		}
		try {
			if ($result = $this->_mysqli->query($sql)) {
				if ($row = $result->fetch_array()) {
					$result->close();
					return (int)$row[0];
				} else {
					return null;
				}
			} else {
				throw new Exception('<font color="#ff0000"><b>Error: '.htmlentities($this->_mysqli->error).'</b></font><br>');
			}
		} catch (Exception $e) {
			if (ACC_DEBUGMODE || $this->_installflag) {
				$this->addDebugMessage($e->getMessage().'<b>Stack trace:</b><br>'.$e->getTraceAsString().'<br>');
			}
			$this->printLog($this->_mysqli->error, $sql, $script);
			return false;
		}
	}

	/**
	 *
	 * Führt das Query "$sql" in der Datenbank aus und gibt das Ergebnis zurück.
	 * Diese Methode sollte benutzt werden, wenn nur eine Spalte von der Abfrage betroffen ist!<br><br>
	 * 
	 * Im Falle eines Fehlers gibt diese Methode <b>false</b> zurück, bzw. <b>null</b> wenn kein Datensatz gefunden wurde.
	 *
	 * @author Steffen Haase, info@sh-software.de
	 * @param String $sql Query welches ausgeführt werden soll
	 * @param String $script Name der Datei, von welcher aus diese Funktion aufgerufen wird
	 * @return String oder Integer
	 */
	public function querySingleItem($sql, $script) {
		if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
			$this->printSQL($sql, $script);
		}
		try {
			if ($result = $this->_mysqli->query($sql)) {
				if ($row = $result->fetch_array()) {
					$result->close();
					return $row[0];
				} else {
					return null;
				}
			} else {
				throw new Exception('<font color="#ff0000"><b>Error: '.htmlentities($this->_mysqli->error).'</b></font><br>');
			}
		} catch (Exception $e) {
			if (ACC_DEBUGMODE || $this->_installflag) {
				$this->addDebugMessage($e->getMessage().'<b>Stack trace:</b><br>'.$e->getTraceAsString().'<br>');
			}
			$this->printLog($this->_mysqli->error, $sql, $script);
			return false;
		}
	}

	/**
	 *
	 * Führt das Query "$sql" in der Datenbank aus.
	 * Diese Methode sollte für Inserts, bzw. Updates verwendet werden!<br><br>
	 * 
	 * Im Falle eines Fehler gibt die Methode <b>false</b> zurück.
	 *
	 * @author Steffen Haase, info@sh-software.de
	 * @param String $sql Query welches ausgeführt werden soll
	 * @param String $script Name der Datei, von welcher aus diese Funktion aufgerufen wird
	 * @return Boolean true oder false
	 */
	public function executeQuery($sql, $script) {
		if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
			$this->printSQL($sql, $script);
		}
		try {
			if ($this->_mysqli->query($sql)) {
				if ((ACC_DEBUGMODE || $this->_installflag) && ACC_DEBUG_QUERYS) {
					$this->printRowCount($this->getAffectedRows());
				}
				return true;
			} else {
				throw new Exception('<font color="#ff0000"><b>Error: '.htmlentities($this->_mysqli->error).'</b></font><br>');
			}
		} catch (Exception $e) {
			if (ACC_DEBUGMODE || $this->_installflag) {
				$this->addDebugMessage($e->getMessage().'<b>Stack trace:</b><br>'.$e->getTraceAsString().'<br>');
			}
			$this->printLog($this->_mysqli->error, $sql, $script);
			return false;
		}
	}
	
	public function getAffectedRows() {
		return $this->_mysqli->affected_rows;
	}

	/**
	 *
	 * Maskiert den übergebenen String für MySQL
	 * 
	 * @author Steffen Haase, info@sh-software.de
	 * @param String $sql Query welches ausgeführt werden soll
	 * @return String Maskierten String
	 */
	public function escapeString($sql) {
		return $this->_mysqli->real_escape_string($sql);
	}
	
	/**
	 * Prüft ob eine Tabelle "$name" in der Datenbank vorhanden ist.
	 * 
	 * @author Steffen Haase, info@sh-software.de
	 * @param String $name Name der Tabelle
	 * @return Boolean true oder false
	 */
	public function existsTable($name) {
		$res = $this->queryObjectArray(
			"SHOW TABLE STATUS LIKE '".$name."'"
		, 'DbConnect.php');
		if ($res !== null && $res !== false) {
			return true;
		}
		return false;
	}
	
	/**
	 * Prüft ob die Spalte $field in der Tabelle $table vorhanden ist. 
	 * 
	 * @author Steffen Haase 
	 * @param String $table Name der Tabelle
	 * @param String $field Name der Spalte
	 * @return Boolean true oder false
	 */
	public function existsColumn($table, $field) {
		$res = $this->queryObjectArray(
			"SHOW COLUMNS FROM ".$table." WHERE FIELD='".$field."'"
		, 'DbConnect.php');
		if ($res !== null && $res !== false) {
			return true;
		}
		return false;
	}

	/**
	 *
	 * @ignore
	 */
	private function printSQL($sql, $script) {
		$this->addDebugMessage("\n<b>Location:</b> ".$script."\n<b>Query:</b> ".htmlentities($sql)."\n");
	}

	/**
	 *
	 * @ignore
	 */
	private function printRowCount($txt) {
		$this->addDebugMessage("<b>Affected rows:</b> ".htmlentities($txt)."\n");
	}
	
	/**
	 *
	 * @ignore
	 */
	private function addDebugMessage($msg) {
		if (!isset($this->_debugmsg)) {
			$this->_debugmsg = $msg;
		} else {
			$this->_debugmsg .= $msg;
		}
	}

	/**
	 *
	 * @ignore
	 */
	public function insertID() {
		return $this->_mysqli->insert_id;
	}

	/**
	 *
	 * @ignore
	 */
	private function __clone() { }

	/**
	 * 
	 * @ignore
	 */
	public function getDebugMessages() {
		return $this->_debugmsg;
	}

	/**
	 * 
	 * @ignore
	 */
	public function clearDebugMessages() {
		$this->_debugmsg = '';
	}
	
	/**
	 * 
	 * @ignore
	 */
	public function hasDebugMessages() {
		if (isset($this->_debugmsg)) {
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * @ignore
	 */
	private function printLog($error, $query, $script) {
		$logfile = ACC_PATH_SERVER.'/logs/'.date('d.m.Y').'_error.txt';
		$message = date('d.m.Y H.i:s')."\nFILE : $script\nERROR: $error\nQUERY: $query\n\n";
		file_put_contents($logfile, $message, FILE_APPEND | LOCK_EX);
	}
}

?>
