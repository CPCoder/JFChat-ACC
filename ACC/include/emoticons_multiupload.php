<?php
/*
 * Project		ACC
 * Filename		emoticons_multiupload.php
 * Author		Steffen Haase
 * Date			08.04.2012
 * License		GPL v3
 */

require_once ACC_PATH_SERVER.'classes/Shs/DbConnect.php';
require_once ACC_PATH_SERVER.'classes/Shs/TplEngine.php';
require_once ACC_PATH_SERVER.'classes/Shs/Request.php';
require_once ACC_PATH_SERVER.'classes/Shs/File.php';
require_once ACC_PATH_SERVER.'classes/Shs/Tools.php';
require_once ACC_PATH_SERVER.'include/functions.php';

$acc_DB = DBConnect::getInstance();
$acc_GetPost = Request::getInstance();
$acc_Template = TplEngine::getInstance();
$acc_Tools = Tools::getInstance();

$jscript_upload = ACC_PATH_SERVER.'lib/emoticons_upload.js';
if (is_file($jscript_upload)) {
	$javascript = file_get_contents($jscript_upload);
}
$csr = getHash(generate_pass());

if ($acc_GetPost->getString('ac') == 'save') {
	echo '<pre>'.print_r($_REQUEST, true).'</pre><br>';
// 	if ($_FILES["zipfile"]["name"]) {
// 		$filename = $_FILES["zipfile"]["name"];
// 		$source = $_FILES["zipfile"]["tmp_name"];
// 		$type = $_FILES["zipfile"]["type"];
// 		$name = explode(".", $filename);
// 		$zip = false;
// 		$accepted_types = array(
// 							'application/zip', 
// 							'application/x-zip-compressed', 
// 							'multipart/x-zip', 
// 							'application/x-compressed'
// 							);
// 		foreach($accepted_types as $mime_type) {
// 			if($mime_type == $type) {
// 				$zip = true;
// 				break;
// 			}
// 		}
// 		if($zip === false) {
// 			$error = "The file you are trying to upload is not a .zip file. Please try again.<br>";
// 			$_SESSION['csr'] = $csr;
// 			$grouppref = strtolower(substr(md5($csr), 0, 4));
// 			$acc_Template->setSubTPL('emoticons_multiupload');
// 			$acc_Template->assignVars(array(
// 								'jscript' => $javascript,
// 								'emo_pref' => $grouppref.'_',
// 								'csr' => $csr,
// 								'errors' => $error,
// 								'fileid' => md5(uniqid()),
// 								'dynamic_scripts' => $dynamic_scripts
// 			));
// 		} else {
// 			$target_path = ACC_PATH_SERVER.'uploads/'.$acc_GetPost->getString('emopref');
// 			$unpacked_path = ACC_PATH_SERVER.'unpacked/'.$acc_GetPost->getString('emopref');
// 			mkdir($target_path);
// 			mkdir($unpacked_path);
// 			chmod($target_path, 0777);
// 			chmod($unpacked_path, 0777);
// 			$source_path = $target_path.'/'.$filename;
// 			$unpacked_path = $unpacked_path.'/';
// 			try {
// 				if(move_uploaded_file($source, $source_path)) {
// 					$zip = new ZipArchive();
// 					$x = $zip->open($source_path);
// 					if ($x === true) {
// 						$zip->extractTo($unpacked_path);
// 						$zip->close();
// 						removeDir($target_path);
// 					}
// 					$message = "Your .zip file was uploaded and unpacked.";
// 					$acc_Template->setSubTPL('sysmessage');
// 					$acc_Template->assignVars(array(
// 										'type' => $javascript,
// 										'message' => $message
// 										));
// 				} else {
// 					throw new Exception("There was a problem with the upload. Please try again.");
// 				}
// 			} catch (Exception $e) {
// 				$acc_Template->setSubTPL('sysmessage');
// 				$acc_Template->assignVars(array(
// 										'type' => $acc_Language['msg']['type']['err'],
// 										'message' => $e
// 										));
// 			}
// 		}
// 	}
} else {
	$_SESSION['csr'] = $csr;
	$grouppref = strtolower(substr(md5($csr), 0, 4));
	$acc_Template->setSubTPL('emoticons_multiupload');
	$acc_Template->assignVars(array(
						'jscript' => $javascript,
						'emo_pref' => $grouppref.'_',
						'csr' => $csr,
						'fileid' => md5(uniqid())
	));
}


?>