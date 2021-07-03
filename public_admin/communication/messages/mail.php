<?php

ini_set('max_execution_time', 2100); //300 seconds = 5 minutes

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Other resources. */
require_once 'includes/auth.php';

require_once 'class/campaign.php';

$campaignObject		= new class_campaign();

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$campaignData = $campaignObject->getByCode($reference);

	if($campaignData) {
		$smarty->assign('campaignData', $campaignData);
		
	} else {
		header('Location: /communication/message/');
		exit;
	}
} else {
	header('Location: /communication/message/');
	exit;
}

 /* Competition mail */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 		= array();
	$formValid	= true;
	$success	= NULL;
	
	$participantData = $campaignObject->_participant->getAll();
	
	if($participantData) {
		for($i = 0; $i < count($participantData); $i++) {
			$participantData[$i]['category'] = 'campaign_send';		
			$success = $campaignObject->_comm->sendCampaign($participantData[$i], $campaignData);	
		}
	}
	
	header('Location: /communication/message/comms.php?code='.$campaignData['campaign_code']);	
	exit;		
					
}


 /* Display the template  */	
$smarty->display('communication/message/mail.tpl');
?>