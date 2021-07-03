<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR .$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/setup.php';
require_once 'includes/auth.php';

/* Classes. */
require_once 'class/internship.php';

/* Object. */
$internshipObject	= new class_internship();

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

if(isset($_REQUEST['id']) && trim($_REQUEST['id']) == '') {
	$errorMessages[] = 'No internship selected';
} elseif((int)trim($_REQUEST['id']) == 0) {
	$errorMessages[] = 'No internship selected';
} else {
	/* Check if internship exists. */
	$internshipData = $internshipObject->getByInternshipId((int)trim($_REQUEST['id']));
	if(count($internshipData) == 0) {
		$errorMessages[] = 'No internship selected';
	}
}


if(count($errorMessages) == 0) {
	/* Get class file. */
	require_once 'class/internshipShare.php';
	/* Object. */
	$internshipShareObject = new class_internshipShare();
	
	/* Data. */
	$data = array();
	$data['internshipShare_name'] 			= strtolower(trim($_REQUEST['name']));
	$data['internshipShare_email'] 			= trim($_REQUEST['email']);
	$data['internshipShare_friendName'] 	= strtolower(trim($_REQUEST['friend_name']));
	$data['internshipShare_friendEmail'] 	= trim($_REQUEST['friend_email']);
	$data['fk_internship_id'] 				= (int)trim($_REQUEST['id']);
	$data['fk_jobSeeker_id']				= isset($userData) && count($userData) > 0 ? $userData[0]['jobSeeker_reference'] : NULL;
	
	$success = $internshipShareObject->insert($data);
	
	if(is_numeric($success)) {
		/* Data to be used for the email. */
		$smarty->assign('data', $data);
		$smarty->assign('internshipData', $internshipData);
		
		/* Send email to the registered user. */
		/* Send to the recruiter emails. */
		require('Zend/Mail.php');
	
		$mail = new Zend_Mail();
				
		/* Send Job to the Enquiring person. */		

		$message = $smarty->fetch('emails/sender_internshipShare.html');	
		
		$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine Internships/bursaries'); //EDIT!!											
		$mail->addTo($data['internshipShare_email']); 									
		$mail->addTo($data['internshipShare_friendEmail']);
		$mail->setSubject('"'.$data['internshipShare_name'] .'" shared an Internship/Bursary Link with you - '.$internshipData['internship_title']);
		$mail->setBodyHtml($message);
		$mail->send();	
		$mail = NULL; UNSET($mail);
		echo '<p style="color: green; font-weight: bold;">Internship has been sent to your friend <b>'.$data['internshipShare_friendName'] .'</b>, please check your email to see confirmation.</p>';
		exit;
	}
}

/* Display errors. */
$errors = implode(", ", $errorMessages);
echo $errors;
?>