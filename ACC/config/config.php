<?php
/*
 * Project		ACC
 * Filename		index.php
 * Author		Steffen Haase
 * Date			02.10.2011
 * License		GPL v3
 */

/*
 * MySQL-Zugangsdaten
 */
$acc_Config['db']['host']							= 'localhost';
$acc_Config['db']['user']							= 'root';
$acc_Config['db']['pass']							= 'crehe73';
$acc_Config['db']['name']							= 'chatdb';
$acc_Config['db']['port']							= 3306;
$acc_Config['db']['pref']							= 'jf_';
$acc_Config['db']['char']							= 'latin1';

/*
 * Über den nachfolgenden Parameter kannst du den Zeichensatz festlegen.
 * Dieser Zeichensatz wird für die Ausgabe an den Webbrowser, als auch für
 * das Versenden von eMail genutzt.
 */
$acc_Config['charset']								= 'iso-8859-1';

/*
 * Session Konfiguration
 */
// Gültigkeits-Zeitraum einer Session in Minuten
// Standard: 30 Minuten
$acc_Config['session']['expiration']				= 30;
// Name der Session
$acc_Config['session']['name']						= 'acc_sess';
// Domain auf die die Session läuft
$acc_Config['session']['domain']					= 'warmachine.dyndns.info';

// Domain unter dem das ACC läuft
// Bsp.: domain.tld, oder www.domain.tld
$acc_Config['install']['domain']					= 'warmachine.dyndns.info';
// Server-Pfad zur ACC-Installation
//$acc_Config['install']['server']					= '/var/www/accnew/';
//$acc_Config['install']['server']					= '/home/sh/Workspaces/JFChat-Software/ACC/';
// HTTP-Pfad zur ACC-Installation
$acc_Config['install']['http']						= '/accnew/';

/*
 * JFChat-Community
 * Hier stellst du die Parameter (Domain, Port usw.) für deine JFChat-Community ein
 */
// JFChat-Domain
// Bsp.: domain.tld, oder www.domain.tld
$acc_Config['jfchat']['domain']						= 'warmachine.dyndns.info';
// JFChat-Port
$acc_Config['jfchat']['port']						= 9090;
//JFChat-Comstring
$acc_Config['jfchat']['comstring']					= '/servlet/jfchat';
// Name der Community
$acc_Config['jfchat']['comname']					= 'SHS-Community';

/*
 * Debug Modus
 * Nachfolgend kann der Debug-Modus aktiviert oder deaktiviert werden.
 * 
 * Desweiteren kann über den zweiten Parameter die Anzeige der MySQL-Querys 
 * an- und abgeschaltet werden. Diesen Parameter sollte man eigentlich nur dann 
 * aktivieren, wenn man seine MySQL-Querys überprüfen will, da die Debugausgabe 
 * sonst sehr lang werden kann! MySQL-Fehlermeldungen werden auch bei deaktiviertem
 * Parameter angezeigt!
 */
// Aktiviert den DEBUG-MODE
$acc_Config['debug']['active']						= true;
$acc_Config['debug']['querys']						= false;

// Sprache
$acc_Config['language']								= 'german';

// Standardgrafik wenn kein Avatar ausgewählt ist
$acc_Config['avatar']['default']					= 'noavatar.gif';

/*
 * Emoticons
 */
// Emoticon-Präfix
$acc_Config['emoticons']['prefix']					= '#';
// Wenn nicht das Standardverzeichnis zum Speichern der Emoticons genutzt wird, 
// muss dieser Parameter auf "false" gesetzt werden!
$acc_Config['emoticons']['jfchat']					= true;
// Zusatz DB-Eintrag
// Wenn innerhalb der JFChat-Software dann folgendes Format: ../<emoverzeichnis>/
// Steht $acc_Config['emoticon']['jfchat'] auf "false", dann darf dieser Parameter keinen Wert enthalten!
$acc_Config['emoticons']['db']						= '../EMOS/';
// Serverpfad zu den Emoticons
$acc_Config['emoticons']['path']['server']			= '/var/www/private/chatserver/webapps/ROOT/EMOS/';
// HTTP-Pfad zu den Emoticons (Muss nur gesetzt werden, wenn nicht Standard-Speicherplatz genutzt wird!)
$acc_Config['emoticons']['path']['http']				= '';

/*
 * Mailkonfiguration
 * 
 * Hier kann der Mailer konfiguriert werden.
 * 
 * Wichtiger Hinweis:
 * Wenn ihr den Parameter für die SSL-Verschlüsselung auf "true" setzt, dann
 * muss auch der Port umgestellt werden auf "465"!
 */
// Absender eMail-Adresse
$acc_Config['mail']['from']							= 'noreply@domain.tld';
// Absender Name
$acc_Config['mail']['fromname']						= 'Mail-BOT';
// SMTP Host
$acc_Config['mail']['smtp']['host']					= 'mail.sh-software.de';
// SMTP Port (Bei SSL-Verschlüsslung auf 465 umstellen!)
$acc_Config['mail']['smtp']['port']					= 465;
// SMTP User
$acc_Config['mail']['smtp']['user']					= 'info@sh-software.de';
// SMTP Passwort
$acc_Config['mail']['smtp']['pass']					= 'krusty45$';
/*
 * Hier kann zusätzlich eine Verschlüsselung festgelegt werden.
 * Mögliche Werte:
 * 'ssl'	> Die eMails werden mit SSL verschlüsselt
 * 'tls'	> Die eMails werden mit TLS verschlüsselt
 * null		> Die eMails werden nicht verschlüsselt
 * 
 * Hinweis:
 * 'ssl' oder 'tls' müssen hier als String übergeben werden! Der Wert "null"
 * darf weder in einfache, noch in doppelte Anführungszeichen stehen! 
 *
 * Wichtiger Hinweis:
 * Wenn der Wert auf 'ssl' oder 'tls' gesetzt wird, muss der Port auf '465'
 * eingestellt werden!
 */
$acc_Config['mail']['encryption']					= 'ssl';


/*
 * Den nachfolgenden Parameter sind nur dann zu setzen, wenn die Freischalt-Erweiterung
 * für Profilbilder verwendet wird! Hierzu wird auch das entsprechende Upload-Script benötigt!
 *
 * HINWEIS: Wenn Bilder im regulären JFChat Bilder-Verzeichnis gespeichert werden sollen, dann
 * 			bitte die Variable "$pictures['db']" so setzen:
 * 
 * 			$pictures['db'] = '../bilder/';
 * 
 * 			Infolge dessen muss natürlich auch die Variable "$pictures['path']['server']['save']" 
 * 			gesetzt werden:
 * 
 * 			$pictures['path']['server']['save'] = '/pfad/zum/chatserver/webapps/ROOT/bilder/;
 * 
 */
// Auf "true" setzen, wenn die Freischalt-Erweiterung für Profilbilder genutzt wird.
$acc_Config['pictures']['check']					= false;
// Wenn Bilder im regulären JFChat Bilder-Verzeichnis gespeichert werden sollen, dann
// bitte die Variable "$pictures['db']" so setzen:
// $acc_Config['pictures']['db'] = '../bilder/';
$acc_Config['pictures']['db']						= '';
// Standardgrafik wenn kein Userbild vorhanden ist
$acc_Config['pictures']['default']					= 'nopicture.gif';
// Server-Pfad zu dem Speicherort der Profil-Bilder
$acc_Config['pictures']['path']['server']['save']	= '/var/www/picupload/pictures/';
// Upload-Pfad für neue Profil-Bilder
$acc_Config['pictures']['path']['server']['up']		= '/var/www/picupload/picturesupload/';
// HTTP-Pfad für neue Profil-Bilder
$acc_Config['pictures']['path']['http']['up']		= '/picupload/picturesupload/';

/*
 * Nachfolgende Parameter sind nur zu setzen, wenn das Nickpage-Addon genutzt wird!
 */
// Auf "true" setzen, wenn das Nickpage-Addon genutzt wird.
$acc_Config['nickpage']['used']						= false; 
// Server-Pfad zum Nickpage-Addon
$acc_Config['nickpage']['path']['server']			= '/var/www/nickpagetest/';
// HTTP-Pfad zum Nickpage-Addon
$acc_Config['nickpage']['path']['http']				= '/nickpagetest/';

// Diesen Parameter nur dann auf "true" setzen, wenn das Nickchange-Modul genutzt wird!
$acc_Config['nickchange']							= false;

/*
 * Hier können die Hintergrundfarben für die Zeilen einer Tabelle definiert werden. Diese
 * Farben wechseln sich Zeilenweise ab!
 */
$acc_Config['table']['cell']['color1']				= '#FFFFFF';
$acc_Config['table']['cell']['color2']				= '#C5D6E3';

/*
 * Minimale und maximale Länge eines Usernamens
 */
$acc_Config['username']['length']['min']			= 3;
$acc_Config['username']['length']['max']			= 25;

/*
 * Registry-Spalten
 * Diese Spalten werden beim bearbeiten, bzw. neuem anlegen von einem Mitglied aus der Registry
 * abgefragt, bzw. eingetragen. Dieses Array kann jederzeit durch eigene Spalten erweitert werden.
 * Werden zusätzliche Spalten eingetragen, müssen in den Templates (Bearbeiten/Neu anlegen) die 
 * entsprechenden Formularfelder mit dem Spaltennamen definiert werden (name="spaltenname"). Der
 * Spaltenname kann dann zusätzlich als Value genutzt werden (value="{SPALTENNAME}").
 */
$registry = array(
	'username', 'password', 'emailadresse', 'rechte', 'forenrechte', 'maxPMs', 
	'maxfriends', 'objekte', 'ownroom', 'punkte', 'farbcode', 'avatar', 
	'wohnort', 'plz', 'geburtsdatum', 'geschlecht', 'homepageName', 
	'homepageUrl', 'motto', 'hobbies', 'icq', 'gutDrauf', 'machtWut', 'favLink', 
	'favMusik', 'wasInsel', 'signatur',	'beschreibung', 'optional1', 
	'optional2', 'optional3', 'optional4', 'optional5'
);

/*
 * Zwingende Formularfelder
 * Die Spalten/Formularfelder die hier definiert werden, müssen zwingend ausgefüllt werden!
 * 
 * WICHTIG:
 * Werden hier zusätzliche Felder definiert, so muss in der Sprachdatei (lang_xxxx.php)
 * auch eine entsprechende Fehlermeldung deklariert werden.
 * 
 * Beispiel:
 * Wird hier eine Spalte/ein Feld "meinfeld" definiert, so muss der entsprechende Eintrag in der
 * Sprachdatei wie folgt hinterlegt werden:
 * 
 * $lang['msg']['error']['meinfeld'] = 'Das Feld "Meinfeld" muss ausgef&uuml;llt werden!<br>';
 */
$requiredfields = array(
	'username', 'password', 'emailadresse', 'rechte', 'forenrechte', 'maxPMs', 
	'maxfriends', 'farbcode', 'geburtsdatum', 'geschlecht'
);


?>
