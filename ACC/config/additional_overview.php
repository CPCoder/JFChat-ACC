<?php
/*
 * Project		ACC
 * Filename		additional_overview.php
 * Author		Steffen Haase
 * Date			09.10.2011
 * License		GPL v3
 */

/*
 * Diese Datei wird im Abschnitt der �bersicht eingebunden. Die �bersicht
 * ist die erste Seite, welche nach dem Login in das ACC angezeigt wird.
 * 
 * Wenn man eigene Extensions entwickelt hat, oder zus�tzliche Informationen
 * aus der Datenbank abruft und diese In dieser �bersicht anzeigen lassen m�chte, 
 * so macht man dies �ber diese Datei.
 * 
 * Es muss hierbei kein Template mittels "$acc_Template->setSubTPL()" eingebunden werden!
 * Man braucht hier lediglich nur die erforderlichen Informationen an entsprechende
 * Template-Variablen binden.
 * 
 * Beispiele
 * ---------
 * Einzelne Variable deklarieren: 
 * $acc_Template->assignVar('MYVAR', 'Mein Inhalt);
 * 
 * Mehrere Variablen auf einmal deklarieren:
 * $acc_Template->assignVars(array(
 * 		'MYVAR_1', 'Inhalt erste Variable',
 * 		'MYVAR_2', 'Inhalt zweite Variable',
 * 		'MYVAR_3', 'Inhalt dritte Variable'
 * ));
 * 
 */
?>