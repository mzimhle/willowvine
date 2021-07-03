<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

//standard config include.
require_once 'config/setup.php';
require_once 'class/jobSeeker.php';

/* Get parameter. */
$pwd = isset($_POST['pwd']) && trim($_POST['pwd']) != '' ? trim($_POST['pwd']) : '';

if($pwd != '') {
	/* Object. */
	$jobSeekerObject = new class_jobSeeker();

	/* Fetch the use. */
	$jobSeekerData = $jobSeekerObject->getByEmail($pwd);

	if(count($jobSeekerData) == 1) {
		
	/* Send password to this oak. */
	$smarty->assign('data', $jobSeekerData[0]);
	/* Send email to the registered user. */
	/* Send to the recruiter emails. */
	require('Zend/Mail.php');
	
	$mail = new Zend_Mail();
			
	/* Send Job to the Enquiring person. */		
	
	$message = $smarty->fetch('emails/jobSeeker_forgotPassword.html');	
	
	$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine Administrator'); //EDIT!!											
	$mail->addTo($jobSeekerData[0]['jobSeeker_email']); 									
	$mail->setSubject('Willowvine - Password Recovery');
	$mail->setBodyHtml($message);
	if($mail->send()) $smarty->assign('jobSeekerData', $jobSeekerData[0]);					
	$mail = NULL;						
	} 
} else {
		/* Get the hell out of here. */
		header('Location: /jobs/search/');
		exit;
}



//display template
$smarty->display('job_seeker/register/password.tpl');
?>