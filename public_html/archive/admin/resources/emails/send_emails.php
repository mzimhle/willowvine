<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/setup.php';	
require_once 'class/internship.php';
require_once 'class/job.php';
require_once 'class/email.php';

/* Objects. */
$internshipObject	= new class_internship();
$jobObject			= new class_job();
$emailObject		= new class_email();

$internshipData = $internshipObject->getLatest(5);
$jobData 		= $jobObject->getRecentJobs(5);
$emailData		= $emailObject->getRandomEmails(1);

if(count($internshipData) == 0) {
	echo 'There are no internships.';
	exit;
}

$smarty->assign('internshipData', $internshipData);
$smarty->assign('jobData', $jobData);

require('Zend/Mail.php');

$mail = new Zend_Mail();
$message = $smarty->fetch('emails/send_emails.html');	

$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!	 
$mail->setSubject('Willowvine - Internships, Bursaries and Jobs');
$mail->setBodyHtml($message);

/* Setup data to update.*/
$data = array(); 
$data['email_sent'] = 1; 
$data['email_sentDate'] = date('Y-m-d H:i:s');

foreach($emailData as $item) {		
	/* Send Job to the Enquiring person. */												
	$mail->addTo($item['email_email']); 										
	/* Check if sent. */
	if($mail->send()) {
		/* Update. */
		$where = $emailObject->getAdapter()->quoteInto('email_email = ?', $item['email_email']);
		$success = $emailObject->update($data, $where);	
	}
}
$mail = $data = NULL;	
?>