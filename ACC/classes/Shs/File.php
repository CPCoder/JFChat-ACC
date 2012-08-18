<?php
/*
 * Project		
 * Filename		File.php
 * Author		Steffen Haase
 * Date			12.01.2012
 * License		GPL v3
 */

/**
 * File
 * 
 * Diese Klasse beinhaltet Dateisystem-Methoden
 *  
 * @package Shs
 * @author Steffen Haase 
 * @version 1.0
 */
class File
{
	/**
	 * Konstruktor
	 * 
	 * @author Steffen Haase 
	 */
	public function __construct() {}
	
	/**
	 * Mit dieser Methode kann eine Datei gel�scht werden.
	 * 
	 * Im Erfolgsfall gibt die Methode "true" zur�ck, im Fehlerfall "false".
	 * 
	 * @author Steffen Haase 
	 * @see unlink()
	 * @param String $file Vollst�ndiger Pfad zur Datei, incl. Dateiname
	 * @return Boolean true oder false
	 */
	public function deleteFile($file) {
		if (is_file($file)) {
			return unlink($file);
		}
		return false;
	}
	
	/**
	 * Mit dieser Methode kann eine Datei verschoben werden.
	 * 
	 * Im Erfolgsfall gibt die Methode "true", im Fehlerfall "false" zur�ck.
	 * 
	 * @author Steffen Haase 
	 * @see rename()
	 * @param String $from Vollst�ndiger Pfad zum aktuellen Speicherort der Datei, incl. Dateiname
	 * @param String $to Vollst�ndiger Pfad zum neuen Speicherort der Datei, incl. Dateiname
	 * @return Boolean true oder false
	 */
	public function moveFile($from, $to) {
		if (is_file($from)) {
			return @rename($from, $to);
		}
		return false;
	}
	
	/**
	 * Diese Methode dient zum Auslesen der Unix-Rechte einer Datei, bzw. eines Verzeichnisses.
	 * 
	 * Als R�ckgabewert erh�lt man die Oktalen Rechte. Im Fehlerfall wird "false" zur�ckgegeben.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param String Name der Datei/des Verzeichnisses incl kompletten Pfad
	 * @return Integer Oktale Rechtemaske oder Boolean false
	 */
	public function getFilePerms($file) {
		if (is_file($file) || is_dir($file)) {
			return substr(sprintf('%o', fileperms($file)), -3);
		}
		return false;
	}
	
	/**
	 * Diese Methode pr�ft ob eine Datei, bzw. Ein Verzeichnis Schreibrechte besitzt.
	 * R�ckgabewerde sind true, oder false.
	 * 
	 * @author Steffen Haase 
	 * @access public
	 * @param String Name der Datei/des Verzeichnisses incl kompletten Pfad
	 * @return Boolean true oder false
	 */
	public function isWriteable($file) {
		if (is_file($file) || is_dir($file)) {
			return is_writable($file);
		}
		return false;
	}
	
}

?>