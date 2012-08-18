<?php

/*
 * Project		ACC
 * Filename		functions.php
 * Author		Steffen Haase
 * Date			03.10.2011
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/PasswordGenerator.php';

function isRegistered($name) {
	$db = DBConnect::getInstance();
	$result = $db->querySingleItem(
		"SELECT id FROM ".TABLE_JF_REGISTRY." WHERE username='".$db->escapeString($name)."' ".
		"AND aktiv='1'"
	, 'functions.php');
	if ($result !== false) {
		if ($result !== null) {
			return true;
		}
		return false;
	}
	return null;
}

function checkBirthdate($date) {
	return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
}

function generate_pass(){
	$password_generator = PasswordGenerator::getInstance(); 
	return $password_generator->getPassword();
}

function getHash($str) {
	return hash('sha256', $str);
}

function buildNavigation($SitesComplete, $page, $extVariables){
	$NavCeil = floor(ACC_NAV_COUNT / 2);
	$string = '';
	if ($page > 1) {
		$string .= '<a href="'.ACC_COMPLETE_URL.'index.php?'.$extVariables.'&amp;page=1"><<</a>&nbsp;&nbsp;';
		$string .= '<a href="'.ACC_COMPLETE_URL.'index.php?'.$extVariables.'&amp;page='.($page-1).'"> <</a>&nbsp;&nbsp;';
	} else {
		$string .= '<<&nbsp;&nbsp; <&nbsp;&nbsp;';
	}
	for ($x = $page-$NavCeil; $x <= $page+$NavCeil; $x++) {
		if (($x > 0 && $x < $page) || ($x > $page && $x <= $SitesComplete)) {
			$string .= '<a href="'.ACC_COMPLETE_URL.'index.php?'.$extVariables.'&amp;page='.$x.'">'.$x.'</a>&nbsp;&nbsp;';
		}
		if ($x == $page) {
			$string .= '['.$x.']&nbsp;&nbsp;';
		}
	}
	if ($page < $SitesComplete) {
		$string .= '<a href="'.ACC_COMPLETE_URL.'index.php?'.$extVariables.'&amp;page='.($page+1).'">></a>&nbsp;&nbsp;';
		$string .= '<a href="'.ACC_COMPLETE_URL.'index.php?'.$extVariables.'&amp;page='.$SitesComplete.'"> >></a>&nbsp;&nbsp;';
	} else {
		$string .= '>&nbsp;&nbsp >>&nbsp;&nbsp;';
	}
	return $string;
}

/**
* Generiert die komplette Seitennavigation incl. der Informationszeile
*
* @author Steffen Haase <info@sh-software.de>
* @param Array $lang Sprach-Array
* @param Integer $count Menge der Einträge
* @param Integer $start Aktuelle Seite
* @param Integer $SitesComplete Gesamtanzahl der Seiten
* @param String $ext Weitere URL-Parameter
* @return String Komplette Seitennavigation
*/
function buildCompleteNavigation(&$acc_Language, $count, &$page, &$SitesComplete, $ext) {
	if ($SitesComplete != 1) {
		$out['entries'] = $acc_Language['sitenav']['entries'];
		$out['sites'] = $acc_Language['sitenav']['sites'];
	} else {
		if ($count > 1) {
			$out['entries'] = $acc_Language['sitenav']['entries'];
		} else {
			$out['entries'] = $acc_Language['sitenav']['entry'];
		}
		$out['sites'] = $acc_Language['sitenav']['site'];
	}
	$SiteLinks = $acc_Language['sitenav']['entriesinfo'];
	$SiteLinks = str_replace('{COUNT_ENTRIES}', $count, $SiteLinks);
	$SiteLinks = str_replace('{COUNT_SITES}', $SitesComplete, $SiteLinks);
	$SiteLinks = str_replace('{ENTRIES}', $out['entries'], $SiteLinks);
	$SiteLinks = str_replace('{SITES}', $out['sites'], $SiteLinks);
	$extVariables = $ext;
	$SiteLinks .= buildNavigation($SitesComplete, $page, $extVariables);
	return $SiteLinks;
}

function removeDir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

?>