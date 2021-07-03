<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Get parameter. */
$cde = isset($_GET['cde']) && trim($_GET['cde']) != '' ? trim($_GET['cde']) : '';

if($cde == '') {

	/* Get the hell out of here. */
	header('Location: /');
	exit;
	
} else {
	
	require_once 'class/participant.php';
	
	/* Object. */
	$participantObject 	= new class_participant();

	/* Fetch the use. */
	$mailinglistData = $participantObject->_mailinglist->getByHash($cde, 0);

	if($mailinglistData) {

		/* Activate account and stay on this page. */
		$data = array('participant_active' => 1, 'participant_code' => $mailinglistData['participant_code']);

		/* Update details. */
		$success = $participantObject->updateParticipant($data, 'EMAIL');

		if($success) {
			$smarty->assign('mailinglistData', $mailinglistData);
			
			$participantData = $participantObject->_participantlogin->getByParticipant($mailinglistData['participant_code'], 'EMAIL');
			
			if($participantData) {
				/* Send password and username details. */
				$participantObject->_comm->sendMail('templates/mail/login_password.html', 'LOGIN_DETAILS', $participantData, 'Willowvine Log In Details', array());

				$smarty->assign('participantData', $participantData);
			}
		} else {
			/* Get the hell out of here. */
			header('Location: /');
			exit;		
		}
		
	} else {
		/* Get the hell out of here. */
		header('Location: /');
		exit;
	}
}

//display template
$smarty->display('templates/mail_response/register_verify.tpl');
?>