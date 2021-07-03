<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* Classes. */
require_once 'class/job.php';
require_once 'class/jobShare.php';

/* Object. */
$jobObject		= new class_Job();
$jobShareObject	= new class_jobShare();

$errorMessages = array();

/* Check email. */
if(isset($_REQUEST['email']) && trim($_REQUEST['email']) != '') {
	if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_REQUEST['email']))) {
		$errorMessages[] = 'Enter your valid email';
	} 
} else {
	$errorMessages[] = 'Your email missing';
}

/* Check name. */
if(isset($_REQUEST['name']) && trim($_REQUEST['name']) == '') {
	$errorMessages[] = 'Your name is missing';
}

/* Check email. */
if(isset($_REQUEST['friend_email']) && trim($_REQUEST['friend_email']) != '') {
	if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_REQUEST['friend_email']))) {
		$errorMessages[] = 'Enter your friend\'s valid email';
	} 
} else {
	$errorMessages[] = 'Your friend\'s email missing';
}

/* Check name. */
if(isset($_REQUEST['friend_name']) && trim($_REQUEST['friend_name']) == '') {
	$errorMessages[] = 'Your friend\'s name is missing';
}	

if(isset($_REQUEST['job']) && trim($_REQUEST['job']) == '') {
	$errorMessages[] = 'No job selected';
} elseif((int)trim($_REQUEST['job']) == 0) {
	$errorMessages[] = 'No job selected';
} else {
	/* Check if job exists. */
	$jobData = $jobObject->getByReference((int)trim($_REQUEST['job']));
	if(count($jobData) == 0) {
		$errorMessages[] = 'No job selected';
	}
}


if(count($errorMessages) == 0) {
	/* Get the class. */
	require_once 'class/enquiry.php';
	
	/* Object. */
	$jobShareObject = new class_jobShare();
	
	/* Data. */
	$data = array();
	$data['jobShare_name'] 			= strtolower(trim($_REQUEST['name']));
	$data['jobShare_email'] 		= trim($_REQUEST['email']);
	$data['jobShare_friendName'] 	= strtolower(trim($_REQUEST['friend_name']));
	$data['jobShare_friendEmail'] 	= trim($_REQUEST['friend_email']);
	$data['fkJobReference'] 		= (int)trim($_REQUEST['job']);
	$data['fkJobSeekerReference']	= isset($userData) && count($userData) > 0 ? $userData[0]['jobSeeker_reference'] : NULL;
	
	$success = $jobShareObject->insert($data);
	
	if(is_numeric($success)) {
		/* Data to be used for the email. */
		$smarty->assign('data', $data);
		$smarty->assign('jobData', $jobData[0]);
		
		/* Send email to the registered user. */
		/* Send to the recruiter emails. */
		require('Zend/Mail.php');
	
		$mail = new Zend_Mail();
				
		/* Send Job to the Enquiring person. */		

		$message = $smarty->fetch('emails/sender_jobShare.html');	
		
		$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
		$mail->addTo($data['jobShare_email']); 									
		$mail->addTo($data['jobShare_friendEmail']);
		$mail->setSubject('Willowvine - Job Shared - '.$jobData[0]['job_title']);
		$mail->setBodyHtml($message);
		$mail->send();	
		$mail = NULL; UNSET($mail);
		echo '<p style="color: green; font-weight: bold;">Job has been sent to your friend '.$data['jobShare_friendName'] .', please check your email to see confirmation.</p>';
		exit;
	}
}

/* Display errors. */
$errors = implode(", ", $errorMessages);
echo $errors;
?>