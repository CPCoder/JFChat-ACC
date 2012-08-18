<?php
/*
 * Project		ACC
 * Filename		api.php
 * Author		Steffen Haase
 * Date			07.04.2012
 * License		GPL v3
 */

require_once 'config/config.php';
require_once 'config/defines.php';
require_once 'classes/Shs/Request.php';
define('ACC_PATH_SERVER', __DIR__.'/');

$acc_GetPost = Request::getInstance();

if ($acc_GetPost->getString('module') == 'emo') {
	require_once ACC_PATH_SERVER.'include/api_emo.php';
} elseif ($acc_GetPost->getString('module') == 'upload') {
	echo json_encode(uploadprogress_get_info($_REQUEST[$acc_GetPost->getString('fileid')]));
	
}

?>