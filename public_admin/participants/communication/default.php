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
require_once 'class/participant.php';

$participantObject = new class_participant();

/* Setup Pagination. */
$participantData = $participantObject->communication();
if($participantData) $smarty->assign('participantData', $participantData);

$smarty->display('participants/communication/default.tpl');

?>