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
require_once 'class/share.php';

$shareObject = new class_share();

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
		$data['share_deleted'] = 1;
		$data['share_code'] = $code;
		
		$where = $shareObject->getAdapter()->quoteInto('share_code = ?', $code);
		$success	= $shareObject->update($data, $where);	
		
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
		$data['share_active'] 	= $status;
		$data['share_code'] 	= $code;
		
		$where 	= $shareObject->getAdapter()->quoteInto('share_code = ?', trim($_GET['code']));
		$success	= $shareObject->update($data, $where);	
		
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
$shareData = $shareObject->getAll('INTERNSHIP');
if($shareData) $smarty->assign('shareData', $shareData);

$smarty->display('internships/share/default.tpl');

?>