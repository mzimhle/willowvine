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

if ( !empty($_POST) && !is_null($_POST)) {

	$username	= (isset($_POST['email'])) ? $_POST['email'] : "-";
	$password	= (isset($_POST['password'])) ? $_POST['password'] : "-";
	$type 		= (isset($_POST['type'])) ? $_POST['type'] : "-";
	
	if($type == 'jobSeeker' || $type == 'jobseeker') {
		
		/* errors. */
		$message = 0;
		
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
				$message = 2;				
			}else{
				// Identity exists; store in session
				$zfsession->identity	= $result->getIdentity();
				$zfsession->type		= 'jobseeker';
				
				//record last login for user
				$data = array('jobSeeker_lastLogin' => date('Y-m-d H:i:s'));
				$where = $jobSeekerObject->getAdapter()->quoteInto('jobSeeker_email = ?', $username);
				$jobSeekerObject->update($data, $where);

				//session_write_close();
				header("Location: /job_seeker/account/");
				exit;

			}//end check for valid result
		} else{
			$message = 1;
		}//end check for user
	
		/* If we are here that means there was an error. */
		header("Location: /?er=".$message);
		exit;		
	} else if($type == 'recruiter'){
		
		/* errors. */
		$message = 0;
		
		$authAdapter
			->setTableName('recruiter')
			->setIdentityColumn('recruiter_email')
			->setCredentialColumn('recruiter_password')
		;

		// Set the input credential values (e.g., from a login form)
		$authAdapter
			->setIdentity($username)
			->setCredential($password)
		;

		$recruiterObject	= new class_recruiter();
		$recruiterData		= $recruiterObject->checkLogin($username, $password);
		$countRecruiter		= count($recruiterData);

		if ($countRecruiter > 0) {
			// Attempt authentication, saving the result
			$result = $authAdapter->authenticate();

			if (!$result->isValid()) {
				$message = 2;				
			}else{
				// Identity exists; store in session
				$zfsession->identity = $result->getIdentity();
				$zfsession->type		= 'recruiter';
				
				//record last login for user
				$data = array('recruiter_lastLogin' => date('Y-m-d H:i:s'));
				$where = $recruiterObject->getAdapter()->quoteInto('recruiter_email = ?', $username);
				$recruiterObject->update($data, $where);

				//session_write_close();
				header("Location: /recruiter/");
				exit;

			}//end check for valid result
		} else{
			$message = 1;
		}//end check for user
	
		/* If we are here that means there was an error. */
		header("Location: /?er=".$message);
		exit;	
	
	}
}
		/* If we are here that means this is a direct request for the file. */
		header("Location: /");
		exit;
?>