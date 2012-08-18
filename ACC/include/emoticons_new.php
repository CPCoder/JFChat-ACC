<?php
/*
 * Project		ACC
 * Filename		emoticons_new.php
 * Author		Steffen Haase
 * Date			29.01.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/File.php';
require_once ACC_PATH_SERVER.'classes/Shs/Tools.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Tools = Tools::getInstance();

$acc_Template->setSubTPL('emoticons_new');

?>