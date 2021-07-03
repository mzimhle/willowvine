<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';
require_once 'class/participant.php';

$participantObject = new class_participant();

/* Ajax */
if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['participant_deleted'] = 1;
		$data['participant_code'] = $code;
		
		$where = $participantObject->getAdapter()->quoteInto('participant_code = ?', $code);
		$success	= $participantObject->update($data, $where);	
		
		if($success) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

if((isset($_GET['status']) && trim($_GET['status']) != '') && (isset($_GET['code']) && trim($_GET['code']) != '')) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['code']);
	$status						= (int)trim($_GET['status']) == 1 ? 0 : 1;
	
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['participant_active'] 	= $status;
		$data['participant_code'] 	= $code;
		
		$where 	= $participantObject->getAdapter()->quoteInto('participant_code = ?', trim($_GET['code']));
		$success	= $participantObject->update($data, $where);	
		
		if($success) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}


/* Setup Pagination. */
$participantData = $participantObject->getAll();
if($participantData) $smarty->assign('participantData', $participantData);

$smarty->display('participants/view/default.tpl');

?>