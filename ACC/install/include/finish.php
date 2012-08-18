<?php
/*
 * Project		ACC
 * Filename		finish.php
 * Author		Steffen Haase
 * Date			22.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';

$acc_Template = TplEngine::getInstance();
$acc_Template->setSubTPL('finish');

?>