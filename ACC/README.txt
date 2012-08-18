INHALT
======
1. Addon-Informationen
2. Systemvoraussetzungen
3. Addon-Beschreibung
4. Installation
5. Wichtige Hinweise
6. Lizenzbestimmungen


1. Addon-Informationen
----------------------
Addon-Name			: ACC (Admin-Control-Center)
Addon-Beschreibung	: Siehe Punkt 2
Addon-Version		: 3.1.0
Addon-Autor			: Steffen Haase
Copyright			: (c) 2010 - 2012 by SHS (Steffen Haase Software)
Contact				: info@sh-software.de


2. Systemvoraussetzungen
------------------------
- PHP 5.3.x
- ionCube-Loader (liegt dem Addon bei)
- JFChat-Lizenz ab Community-/C-Lizenz
- Aktivierte Speicherung der Passwörter in MD5


3. Addon-Beschreibung
---------------------
Dieses Addon ist ein externes Administrations-Tool für die JFChat-Software von Tommy Kammerer.
Aufgrund mehrerer Anfragen von Usern, wurde das ACC v3.1.0 komplett neu aufgebaut, damit eigene Erweiterungen 
seitens der User (ähnlich dem NP-Addon) genutzt werden können. Im Zuge dieses Neuaufbaus kann eine ältere Version
des Addons nicht durch diese Version geupdated werden!

In der jetzigen Fassung beinhaltet das ACC folgende Funktionen:

- Mitglieder-Verwaltung incl. der Möglichkeit ein neues Mitglied direkt über das ACC anlegen zu können!
- Freischaltfunktion für Nickpage-Galeriebilder (Gilt nur in Verbindung mit dem Nickpage-Addon ab mind. 
  Version 2.4.9!)
- Freischaltfunktion für Profilbilder (Gilt nur in Verbindung mit dem PictureUpload-Addon!)
- Übersicht über div. Informationen (Mitglieder-Datenbestand, Profilbilder, Galeriebilder)
- Möglichkeit mehrere ACC-Admins/Gruppen anzulegen
- Möglichkeit eigene Erweiterungen einzubinden


4. Installation
---------------
Schritt 1:	Als erstes lädst du das Verzeichnis "acc" ins HTML-Verzeichnis deines Webservers hoch.
			WICHTIG: Bitte beim hochladen der Dateien den Punkt 4 dieser README beachten!
Schritt 2:	Anpassen der Konfigurations-Daten in der "config.php"
Schritt 4:	Nun rufst du das Installations-Script im Webbrowser auf: http://domain.tld/acc/install/install.php
Schritt 5:	Folge den Anweisungen die dir im Webbrowser angezeigt werden.

FERTIG!


5. Wichtige Hinweise
--------------------
Einige Scripte dieses Addons sind verschlüsselt und beinhalten binären Code. Diese Dateien sollten beim
hochladen per FTP im sog. Binär-Modus hochgeladen werden! Hierbei handelt es sich um die nachfolgenden
Scripte:

- Alle PHP-Scripte im Verzeichnis "classes/Shs"
- Alle PHP-Scripte im Verzeichnis "include"
- index.php

Damit das Addon korrekt funktioniert muss ionCube auf dem Server installiert sein, hierzu liegen dem Addon
zwei ionCube-Loader-Wizards bei (ein mal für 32bit- und ein mal 64bit-Systeme). Lade den für dein System 
passenden Loader-Wizard ins HTML-Verzeichnis deines Webservers hoch und rufe danach im Browser die Datei 
"loader-wizard.php" auf. Das Script prüft ob auf dem Server ionCube installiert ist. Sollte dies nicht
der Fall sein, so bietet es euch die Möglichkeit die nötigen ionCube-Loader Dateien herunter zu laden und 
gibt euch Anweisungen wie ihr ionCube auf eurem Server installiert und aktiviert.

6. Lizenzbestimmungen
---------------------
Das Addon unterliegt der GPL v 3.0 (siehe LIZENZ.TXT)

Stand: 18.08.2012

