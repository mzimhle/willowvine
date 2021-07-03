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

require_once 'class/enquiry.php';

$enquiryObject	= new class_enquiry();

/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['pk_enquiry_id']) && $_GET['pk_enquiry_id'] != '') {
	
	$enquiryId = (int)$_GET['pk_enquiry_id'];
	
	$enquiryData = $enquiryObject->getByEnquiryId($enquiryId);
	if(count($enquiryData) > 0) {
		$smarty->assign('enquiryData', $enquiryData[0]);
	} else {
		header('Location: /admin/enquiries/');
		exit;	
	}
} else {
	header('Location: /admin/enquiries/');
	exit;
}

if(count($_POST) > 0) {

		if(trim($_POST['enquiry_message']) != '') {
			
				$smarty->assign('data', $_POST);
				/* Send email to the registered user. */
				/* Send to the recruiter emails. */
				require_once 'Zend/Mail.php';
			
				$mail = new Zend_Mail();
						
				/* Send Job to the Enquiring person. */		
				$message = $smarty->fetch('emails/enquiry_message.html');	
				$mail->setFrom('no-reply@willowvine.co.za' , 'Willowvine'); //EDIT!!											
				$mail->addTo($enquiryData[0]['enquiry_email']); 										
				$mail->setSubject('Willowvine Messange');
				$mail->setBodyHtml($message);
				$mail->send();	
				
				$mail = NULL;							
				/* Redirect. */
				$smarty->assign('success', 1);
					
		}
}
$smarty->display('admin/enquiries/details.tpl');

?>