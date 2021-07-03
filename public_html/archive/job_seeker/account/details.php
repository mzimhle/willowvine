<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/setup.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

require_once 'class/jobSeeker.php';

$jobSeekerObject = new class_jobSeeker();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['reference']) && $_GET['reference'] != '') {
	
	$jobSeekerId = (int)$_GET['reference'];
	
	$jobSeekerData = $jobSeekerObject->getJobSeekerDetails($jobSeekerId);
	if(count($jobSeekerData) > 0) {
		$smarty->assign('jobSeekerData', $jobSeekerData[0]);
	}	
}

if(count($_POST) > 0) {

		if(trim($_POST['jobSeeker_message']) != '') {
			$data = array();
			$data['jobSeeker_active'] 	= isset($_POST['jobSeeker_active']) && (int)trim($_POST['jobSeeker_active']) != 0 ? 1 : 0;			

			/* Update jobSeeker table. */
			$where = $jobSeekerObject->getAdapter()->quoteInto('jobSeeker_reference = ?', $jobSeekerData[0]['jobSeeker_reference']);
			$success = $jobSeekerObject->update($data, $where);
			
			if(is_numeric($success)) {
				$smarty->assign('data', $_POST)
				/* Send email to the registered user. */
				/* Send to the recruiter emails. */
				require('Zend/Mail.php');
			
				$mail = new Zend_Mail();
						
				/* Send Job to the Enquiring person. */		
				$message = $smarty->fetch('emails/message.html');	
				$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
				$mail->addTo($jobSeekerData[0]['jobSeeker_email']); 										
				$mail->setSubject('Willowvine Messange');
				$mail->setBodyHtml($message);
				$mail->send();	
				
				$mail = NULL;			
				/* Redirect links. */
				$smarty->assign('enquiryData_success', $data);
				$data = $mail = $_POST = $errorMessages = NULL;		
			}
		}
}
$smarty->display('admin/users/jobSeekers/details.tpl');

?>