<?php
/*
 * Project		ACC
 * Filename		lang_german.php
 * Author		Steffen Haase
 * Date			03.10.2011
 * License		GPL v3
 */

/*
 * Systemmeldungs-Typen
 */
$acc_Language['msg']['type']['sys']					= 'Systemmeldung';
$acc_Language['msg']['type']['err']					= 'Fehler';

/*
 * Systemmeldungen
 */
$acc_Language['msg']['system']['loginok']			= 'Login erfolgreich!<br>Du wirst jetzt weitergeleitet. Sollte die Weiterleitung '.
														'nicht funktionieren, so klick bitte auf den folgenden Link:<br><br>'.
														'<a href="{REDIRECT_URL}">Zur &Uuml;bersicht</a>';
$acc_Language['msg']['system']['logout']			= 'Du hast dich erfolgreich ausgeloggt.<br><br>'.
														'<a href="{LOGIN_URL}"><b>Zur Login-Seite</b></a>';
$acc_Language['msg']['system']['memberupdateok']	= 'Die Accountdaten des Users "{USERNAME}" wurden erfolgreich gespeichert.<br><br>'.
														'<a href="{MEMBER_URL}"><b>Zur&uuml;ck zur Mitglieder-&Uuml;bersicht</b></a>';
$acc_Language['msg']['system']['memberupdatenotok']	= 'Leider konnten die Accountdaten des Users {USERNAME} nicht aktualisiert werden!<br>'.
														'F&uuml;r genauere Infos bitte in die Logdatei schauen.<br><br>'.
														'<a href="{MEMBER_URL}"><b>Zur&uuml;ck zur Mitglieder-&Uuml;bersicht</b></a>';
$acc_Language['msg']['system']['membersaveok']		= 'Der neue User "{USERNAME}" wurde erfolgreich angelegt.<br><br>'.
														'<a href="{MEMBER_URL}"><b>Zur&uuml;ck zur Mitglieder-&Uuml;bersicht</b></a>';
$acc_Language['msg']['system']['membersavenotok']	= 'Leider konnte der neue Account nicht angelegt werden!<br>'.
														'F&uuml;r genauere Infos bitte in die Logdatei schauen.<br><br>'.
														'<a href="{MEMBER_URL}"><b>Zur&uuml;ck zur Mitglieder-&Uuml;bersicht</b></a>';
$acc_Language['msg']['system']['sessionexp']		= 'Leider ist deine Session abgelaufen<br><br>'.
                                        				'<a href="{LOGIN_URL}"><b>Zur Login-Seite</b></a>';
$acc_Language['msg']['system']['nopermission']		= '<b>Du hast f&uuml;r diesen Bereich keine Berechtigung!</b>';
$acc_Language['msg']['system']['groupnamechanged']	= '<b>Der Name der Gruppe wurde erfolgreich ge&auml;ndert!</b><br><br>';

$acc_Language['navi']['overview']['main']			= '&Uuml;bersicht';
$acc_Language['navi']['acc']['main']				= 'ACC';
$acc_Language['navi']['acc']['admins']				= 'Admins';
$acc_Language['navi']['acc']['newadmin']			= 'Neuen Admin anlegen';
$acc_Language['navi']['acc']['groups']				= 'Gruppen';
$acc_Language['navi']['acc']['newgroup']			= 'Neue Gruppe anlegen';
$acc_Language['navi']['members']['main']			= 'Mitglieder';
$acc_Language['navi']['members']['new']				= 'Neues Mitglied anlegen';
$acc_Language['navi']['gallery']['main']			= 'Galeriebilder';
$acc_Language['navi']['pictures']['main']			= 'Profilbilder';
$acc_Language['navi']['emoticons']['main']			= 'Emoticons';
$acc_Language['navi']['emoticons']['new']			= 'Neues Emoticon anlegen';
$acc_Language['navi']['logout']['main']				= 'Logout';


/*
 * Geschlechter
 */
$acc_Language['gender']['male']						= 'm&auml;nnlich';
$acc_Language['gender']['female']					= 'weiblich';
$acc_Language['gender']['unknown']					= 'unbekannt';

/*
 * Fehlermeldungen
 */
$acc_Language['msg']['error']['wrapper']			= '<div id="errors">{MESSAGE}</div>';
$acc_Language['msg']['error']['emptylogin']			= 'Bitte einen Benutzernamen und ein Passwort angeben!<br>';
$acc_Language['msg']['error']['wronglogin']			= 'Unbekannte Zugangsdaten!<br>';
$acc_Language['msg']['error']['sitenotavailable']	= 'Sorry, aber diese Seite existiert nicht!';
$acc_Language['msg']['error']['emptymembersearch']	= 'Es m&uuml;ssen mind 3 Zeichen eingegeben werden!';
$acc_Language['msg']['error']['msqlerror']			= '<b>Fehler im MySQL-Query!</b>';
$acc_Language['msg']['error']['unknowuserid']		= '<b>Unbekannte UserID!</b>';
$acc_Language['msg']['error']['unknowuser']			= '<b>Unbekannter User!<br><br></b>';
$acc_Language['msg']['error']['isingroup']			= '<b>Dieser Benutzer ist schon in der Gruppe!</b>';
$acc_Language['msg']['error']['sendmail']			= '<br><br><b>Leider konnte die eMail nicht verschickt werden!</b><br><br>'.
                                      					'<u>Fehlermeldung:</u><br>{MAILERRORS}';

/*
 * Username Überprüfung
 */
$acc_Language['msg']['check']['isregistered']		= 'Dieser Username ist schon registriert!<br>';
$acc_Language['msg']['check']['namelength']			= 'Der Username darf nur zwischen {NAME_MIN_LENGTH} und {NAME_MAX_LENGTH} Zeichen lang sein!<br>';

/*
 * Fehlermeldungen Mitglied anlegen/bearbeiten
 */
$acc_Language['msg']['error']['username']			= 'Das Feld "Username" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['geburtsdatum']		= 'Bitte ein korrektes Geburtsdatum im Format JJJJ-MM-DD angeben!<br>';
$acc_Language['msg']['error']['emailadresse']		= 'Das Feld "eMail-Adresse" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['password']			= 'Das Passwort muss mind. 8 Zeichen lang sein!<br>';
$acc_Language['msg']['error']['rechte']				= 'Das Feld "Rechte" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['forenrechte']		= 'Das Feld "Forenrechte" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['maxPMs']				= 'Das Feld "Max. PMs" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['maxfriends']			= 'Das Feld "Max. Freunde" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['nplock']				= 'Das Feld "Nickpagesperre" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['nponlyfriends']		= 'Das Feld "Nickpage nur f&uuml;r Freunde" darf nicht leer sein!<br>';
$acc_Language['msg']['error']['filenotdeleted']		= 'Die Datei konnte nicht gel&ouml;scht werden!';
$acc_Language['msg']['error']['filenotcopy']		= 'Die Datei konnte nicht verschoben werden!';

/*
 * Sonstige Meldungen
 */
$acc_Language['msg']['members']['errorline']		= '<tr><td colspan="7" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>{ERROR}</p></td></tr>';
$acc_Language['msg']['members']['nomembers']		= '<tr><td colspan="7" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>Es sind keine Mitglieder in der Datenbank!</p></td></tr>';
$acc_Language['msg']['members']['nosearchresult']	= '<tr><td colspan="7" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>Es wurden keine Mitglieder zur Suchanfrage gefunden!</p></td></tr>';
$acc_Language['msg']['acc']['errorline']			= '<tr><td colspan="6" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>{ERROR}</p></td></tr>';
$acc_Language['msg']['acc']['nomembers']			= '<tr><td colspan="6" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>Es sind keine Mitglieder in der Datenbank!</p></td></tr>';
$acc_Language['msg']['acc']['nosearchresult']		= '<tr><td colspan="6" style="font-weight:bold;text-align:center;">'.
														'<p></p><p>Es wurden keine Mitglieder zur Suchanfrage gefunden!</p></td></tr>';
$acc_Language['msg']['acc']['add_success']			= 'Das Mitglied "{USERNAME}" wurde erfolgreich als ACC-Administrator hinzugef&uuml;gt!<br>'.
														'Um den neuen Admin einer Gruppe zu zuordnen, bitte die entsprechende Gruppe bearbeiten.'.
														'<br><br><a href="index.php?site=acc&subsite=groups">Zu der Gruppen-&Uuml;bersicht</a><br>'.
														'<a href="index.php?site=acc&subsite=admins">Zu der Admin-&Uuml;bersicht</a><br><br>';
$acc_Language['msg']['acc']['nogroupmember']		= '<b>Keine Gruppenmitglieder vorhanden!</b>';
$acc_Language['msg']['acc']['nogroupsectors']		= '<b>Keine Gruppen-Bereiche vorhanden!</b>';
$acc_Language['msg']['acc']['groupnameexists']		= '<b>Es existiert schon eine Gruppe mit diesem Namen (Gruppen-ID: {GROUPID})!</b><br><br>';			
$acc_Language['msg']['acc']['groupadded']			= '<b>Die neue Gruppe wurde erfolgreich angelegt!</b><br><br>';
$acc_Language['msg']['acc']['groupdeleted']			= '<b>Die Gruppe wurde erfolgreich gel&ouml;scht!</b><br><br>';

/*
 * Seitennavigation
 */
$acc_Language['sitenav']['entries']					= 'Eintr&auml;ge';
$acc_Language['sitenav']['entry']					= 'Eintrag';
$acc_Language['sitenav']['sites']					= 'Seiten';
$acc_Language['sitenav']['site']					= 'Seite';
$acc_Language['sitenav']['entriesinfo']				= 'Es gibt insgesamt {COUNT_ENTRIES} {ENTRIES} auf {COUNT_SITES} {SITES}.<br>';

/*
 * Emoticons
 */
$acc_Language['emoticons']['hidden']				= 'Nein';
$acc_Language['emoticons']['visible']				= 'Ja';

/*
 * eMail
 */
$acc_Language['mail']['register']['subject']		= 'Deine Accountdaten';
$acc_Language['mail']['passchange']['subject']		= 'Dein neues Passwort';
$acc_Language['mail']['gallery']['subject']			= 'Galeriebild';
$acc_Language['mail']['pictures']['subject']		= 'Profilbild';
$acc_Language['mail']['register']['text']			= "Hallo {USERNAME},\n\nnachfolgend findest du deine Zugangsdaten für die Community.\n\n".
														"Username : {USERNAME}\nPasswort : {PASSWORD}\n\nLink zur Community:\n{COMURL}\n\n\n".
														"Mit freundlichen Grüßen\n\nDein {COMNAME}-Team\n\nHinweis: Dies ist eine automatisch ".
														"erstellte eMail, bitte nicht darauf antworten!";
$acc_Language['mail']['passchange']['text']			= "Hallo {USERNAME},\n\ndein Passwort wurde von einem Administrator geändert.\n\n".
														"Neues Passwort: {PASSWORD}\n\nLink zur Community:\n{COMURL}\n\n\nMit freundlichen ".
														"Grüßen\n\nDein {COMNAME}-Team\n\nHinweis: Dies ist eine automatisch erstellte eMail, ".
														"bitte nicht darauf antworten!";
$acc_Language['mail']['gallery']['accept']			= "Hallo {USERNAME},\n\ndein Galeriebild wurde von einem Administrator freigeschaltet.\n\n".
														"\n\n\nMit freundlichen Grüßen\n\nDein {COMNAME}-Team\n\nHinweis: Dies ist eine ".
														"automatisch erstellte eMail, bitte nicht darauf antworten!";
$acc_Language['mail']['gallery']['declined']		= "Hallo {USERNAME},\n\ndein Galeriebild wurde von einem Administrator abgelehnt, da es ".
														"nicht den Upload-Bestimmungen entspricht!.\n\n\nMit freundlichen Grüßen\n\nDein ".
														"{COMNAME}-Team\n\nHinweis: Dies ist eine automatisch erstellte eMail, bitte nicht ".
														"darauf antworten!";
$acc_Language['mail']['pictures']['accept']			= "Hallo {USERNAME},\n\ndein Profilbild wurde von einem Administrator freigeschaltet.\n\n".
														"\n\n\nMit freundlichen Grüßen\n\nDein {COMNAME}-Team\n\nHinweis: Dies ist eine ".
														"automatisch erstellte eMail, bitte nicht darauf antworten!";
$acc_Language['mail']['pictures']['declined']		= "Hallo {USERNAME},\n\ndein Profilbild wurde von einem Administrator abgelehnt, da es ".
														"nicht den Upload-Bestimmungen entspricht!.\n\n\nMit freundlichen Grüßen\n\nDein ".
														"{COMNAME}-Team\n\nHinweis: Dies ist eine automatisch erstellte eMail, bitte nicht ".
														"darauf antworten!";

/*
 * Galerie
 */
$acc_Language['gallery']['noimages']				= '<tr><td colspan="3" style="text-align:center;"><br><b>Es sind keine Bilder zum '.
														'Freischalten vorhanden!</b><br><br></td></tr>';
$acc_Language['gallery']['accept']					= '<b>Das Bild wurde freigegeben und der User wurde per eMail &uuml;ber die Freischaltung '.
														'informiert.</b><br><br>';
$acc_Language['gallery']['declined']				= '<b>Das Bild wurde abgelehnt und der User wurde per eMail &uuml;ber die Ablehnung '.
														'informiert.</b>';

/*
 * Profilbilder
 */
$acc_Language['pictures']['noimages']				= '<tr><td colspan="3" style="text-align:center;"><br><b>Es sind keine Bilder zum '.
														'Freischalten vorhanden!</b><br><br></td></tr>';
$acc_Language['pictures']['accept']					= '<b>Das Bild wurde freigegeben und der User wurde per eMail &uuml;ber die Freischaltung '.
														'informiert.</b><br><br>';
$acc_Language['pictures']['declined']				= '<b>Das Bild wurde abgelehnt und der User wurde per eMail &uuml;ber die Ablehnung '.
														'informiert.</b>';

?>