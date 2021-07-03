<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

require_once 'class/share.php';

$shareObject = new class_share();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$code = trim($_GET['code']);
	
	$shareData = $shareObject->getByCode($code, 'JOB');
	
	if($shareData) {
		$smarty->assign('shareData', $shareData);
	} else {
		header('Location: /jobs/share');
		exit;
	}
} else {
	header('Location: /jobs/share');
	exit;
}

$smarty->display('jobs/share/details.tpl');

?>