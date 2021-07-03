<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/setup.php';
require_once 'class/administrator.php';
//include the Zend class for Authentification
require_once 'Zend/Auth.php';
require_once 'Zend/Auth/Adapter/DbTable.php';
require_once 'Zend/Session.php';

require_once 'class/jobSeeker.php';
require_once 'class/recruiter.php';

$zfsession = new Zend_Session_Namespace('FrontLogin');
$zfsession->setExpirationSeconds(3600);

// Get a reference to the singleton instance of Zend_Auth
$auth = Zend_Auth::getInstance();

// Set up the authentication adapter
$authAdapter = new Zend_Auth_Adapter_DbTable($conn);

//set default counter
$countUser = 0;

$username	= (isset($_REQUEST['email'])) ? $_REQUEST['email'] : "";
$password	= (isset($_REQUEST['password'])) ? $_REQUEST['password'] : "";
$forgot_email = (isset($_REQUEST['forgot_password_email'])) ? $_REQUEST['forgot_password_email'] : "";
$type 		= (isset($_REQUEST['type'])) ? $_REQUEST['type'] : "jobSeeker";
	
if($forgot_email != '') {
	/* errors. */
	$message = '';
	/* Object. */
	$jobSeekerObject = new class_jobSeeker();

	/* Fetch the use. */
	$jobSeekerData = $jobSeekerObject->getByEmail($forgot_email);

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
	
	$message = '<span style="color: green;">Please check your email "'.$forgot_email.'" for your password.</span>';
	} else {
		$message = 'Email not found. Please try again.';
	} 
	
	echo $message; 
	exit;
} else {
	
	/* errors. */
	$message = '';
	
	/* Check validation. */
	if($username == '' || $password == '') {
		$message = 'Please enter password and email.';
	}
	
	$authAdapter
		->setTableName('jobSeeker')
		->setIdentityColumn('jobSeeker_email')
		->setCredentialColumn('jobSeeker_password')
	;

	// Set the input credential values (e.g., from a login form)
	$authAdapter
		->setIdentity($username)
		->setCredential($password)
	;

	$jobSeekerObject	= new class_jobSeeker();
	$userData			= $jobSeekerObject->checkLogin($username, $password);
	$countUser			= count($userData);

	if ($countUser > 0) {
		// Attempt authentication, saving the result
		$result = $authAdapter->authenticate();

		if (!$result->isValid()) {
			$message = 'Please enter password and email.';				
		}else{
			// Identity exists; store in session
			$zfsession->identity	= $result->getIdentity();
			$zfsession->type		= 'jobseeker';
			
			//record last login for user
			$data = array('jobSeeker_lastLogin' => date('Y-m-d H:i:s'));
			$where = $jobSeekerObject->getAdapter()->quoteInto('jobSeeker_email = ?', $username);
			$jobSeekerObject->update($data, $where);
			
			$message = 'success';				
		}//end check for valid result
	} else{
		$message = 'User not found. Please try again.';
	}//end check for user

	/* If we are here that means there was an error. */
	echo $message;
	exit;	
}	
?>