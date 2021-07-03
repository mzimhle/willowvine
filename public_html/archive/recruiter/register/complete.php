<?php
/* standard config include. */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* Classes. */
require_once 'class/recruiter.php';

/* Objects. */
$recruiterObject = new class_recruiter();

$recruiterReference = isset($_GET['jsk']) && (int)trim($_GET['jsk']) != 0 ? (int)trim($_GET['jsk']) : 0;

if($recruiterReference == 0) {
	/* Redirect links. */
	header('Location: /recruiter/');
	exit;	
} else {
	/* Check reference exists. */
	$recruiterData = $recruiterObject->getByReferenceRegistration($recruiterReference);
	
	if(count($recruiterData) > 0) {
		$smarty->assign('data', $recruiterData[0]);
	} else {
		/* Redirect links. */
		header('Location: /recruiter/');
		exit;		
	}
}

/* display template */
$smarty->display('recruiter/register/complete.tpl');
?>