<?php 

ini_set('memory_limit','500M'); 

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

require_once 'class/spam.php';

$spamObject = new class_spam();

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
		$data['spam_deleted'] = 1;
		$data['spam_code'] = $code;
		
		$where = $spamObject->getAdapter()->quoteInto('spam_code = ?', $code);
		$success	= $spamObject->update($data, $where);	
		
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
	$success				= NULL;
	$code					= trim($_GET['code']);
	$status					= (int)trim($_GET['status']) == 1 ? 1 : 0;
	
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['spam_active'] = $status;
		$data['spam_code'] = $code;
		
		$where 		= $spamObject->getAdapter()->quoteInto('spam_code = ?', trim($_GET['code']));
		$success	= $spamObject->update($data, $where);	
		
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

if(isset($_GET['action']) && trim($_GET['action']) == 'spamsearch') {

	$search = isset($_REQUEST['search']) && trim($_REQUEST['search']) != '' ? trim($_REQUEST['search']) : null;
	$start 	= isset($_REQUEST['iDisplayStart']) ? $_REQUEST['iDisplayStart'] : 0;
	$length = isset($_REQUEST['iDisplayLength']) ? $_REQUEST['iDisplayLength'] : 20;
	
	$spamData = $spamObject->getSearch($search, $start, $length);
	$allspams = array();

	if($spamData) {
		for($i = 0; $i < count($spamData['records']); $i++) {
			$item = $spamData['records'][$i];
			$allspams[$i] = array($item['spam_added'], 
											'<a class="'.($item['spam_active'] == 0 ? 'error' : 'success').'" href="/resources/spam/details.php?code='.$item['spam_code'].'">'.$item['spam_name'].'</a>', 
											$item['spam_email'], 
											$item['spam_cellphone'],
											$item['spam_website'], 
											'<button onclick="javascript:changestatus(\''.$item['spam_code'].'\', \''.($item['spam_active'] == 0 ? 1 : 0).'\');">Change Status</button>',
											'<button onclick="javascript:deleteitem(\''.$item['spam_code'].'\');">Delete</button>');
		}
	}

	if($spamData) {
		$response['sEcho'] = $_REQUEST['sEcho'];
		$response['iTotalRecords'] = $spamData['displayrecords'];		
		$response['iTotalDisplayRecords'] = $spamData['count'];
		$response['aaData']	= $allspams;
	} else {
		$response['result'] 	= false;
		$response['message']	= 'There are no items to show.';			
	}
	
    echo json_encode($response);
    die();	
}

/* End Pagination Setup. */

/* display template */
$smarty->display('resources/spam/default.tpl');

$spamObject = $action = $spamId = $spamIds = $where = $data = $spamData = null;
unset($spamObject, $action, $spamId, $spamIds, $where, $data, $spamData);
?>