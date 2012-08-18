<?php
/*
 * Project		ACC
 * Filename		defines.php
 * Author		Steffen Haase
 * Date			02.10.2011
 * License		GPL v3
 */

/*
 * Hier wird die Datenbank Konfiguration als Konstanten definiert
 */
define('ACC_DB_HOST',				$acc_Config['db']['host']);
define('ACC_DB_USER',				$acc_Config['db']['user']);
define('ACC_DB_PASS',				$acc_Config['db']['pass']);
define('ACC_DB_NAME',				$acc_Config['db']['name']);
define('ACC_DB_PORT',				$acc_Config['db']['port']);
define('ACC_DB_PREF',				$acc_Config['db']['pref']);
define('ACC_DB_CHAR',				$acc_Config['db']['char']);

/*
 * Hier werden die Datenbank Tabellen als Konstanten definiert
 */
define('TABLE_JF_REGISTRY',			ACC_DB_PREF.'registry');
define('TABLE_JF_EMOTICONS',		ACC_DB_PREF.'emos');
define('TABLE_ACC_NAVMAP',			ACC_DB_PREF.'acc_navmap');
define('TABLE_ACC_NAVIGATION',		ACC_DB_PREF.'acc_navigation');
define('TABLE_ACC_SUBNAVIGATION',	ACC_DB_PREF.'acc_subnavigation');
define('TABLE_ACC_GROUPS',			ACC_DB_PREF.'acc_groups');
define('TABLE_ACC_GROUPMAP',		ACC_DB_PREF.'acc_groupmap');
define('TABLE_ACC_GALIMAGES',		ACC_DB_PREF.'npgalimages');

/*
 * Hier werden sonstige Konstanten definiert
 */
define('ACC_CHECKPICTURES',			$acc_Config['pictures']['check']);
define('ACC_NPACTIVE',				$acc_Config['nickpage']['used']);
define('ACC_NICKCHANGE',			$acc_Config['nickchange']);
define('ACC_PATH_HTTP',				$acc_Config['install']['http']);
define('ACC_DOMAIN',				$acc_Config['install']['domain']);
define('ACC_DEBUGMODE',				$acc_Config['debug']['active']);
define('ACC_DEBUG_QUERYS',			$acc_Config['debug']['querys']);
define('ACC_LANG',					$acc_Config['language']);
define('ACC_SESSION_EXPIRATION',	$acc_Config['session']['expiration']);
define('ACC_SESSION_DOMAIN',		$acc_Config['session']['domain']);
define('ACC_SESSION_NAME',			$acc_Config['session']['name']);
define('ACC_CHARSET',				$acc_Config['charset']);
define('ACC_COMPLETE_URL', 			'http://'.ACC_DOMAIN.ACC_PATH_HTTP);


/*
 * JFChat-Konstanten
 * Diese Parameter bitte nicht ändern!
 */
define('JFCHAT_COMNAME',			$acc_Config['jfchat']['comname']);
define('JFCHAT_DOMAIN',				$acc_Config['jfchat']['domain']);
define('JFCHAT_PORT',				$acc_Config['jfchat']['port']);
define('JFCHAT_COMSTRING',			$acc_Config['jfchat']['comstring']);
define('JFCHAT_COMPLETEURL',		'http://'.JFCHAT_DOMAIN.':'.JFCHAT_PORT.JFCHAT_COMSTRING);
define('JFCHAT_URL',				'http://'.JFCHAT_DOMAIN.':'.JFCHAT_PORT);

/*
 * Hier kannst du das Aussehen von mehrseitigen Anzeigen beeinflussen
 */
// Anzahl der Einträge pro Seite
define('ACC_MAX_ENTRIES',		 	20);
// Anzahl der Seitenlinks vor und nach der aktuellen Seite
define('ACC_NAV_COUNT', 			10);

?>