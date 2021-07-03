<?php 

ini_set('memory_limit','500M'); 

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

require_once 'class/job.php';

$jobObject = new class_job();

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
		$data['job_deleted'] = 1;
		
		$where = $jobObject->getAdapter()->quoteInto('pk_job_id = ?', $code);
		$success	= $jobObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
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
		$data['job_active'] = $status;
		
		$where 		= $jobObject->getAdapter()->quoteInto('pk_job_id = ?', trim($_GET['code']));
		$success	= $jobObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
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

if(isset($_GET['action']) && trim($_GET['action']) == 'jobsearch') {

	$search = isset($_REQUEST['search']) && trim($_REQUEST['search']) != '' ? trim($_REQUEST['search']) : null;
	$start 	= isset($_REQUEST['iDisplayStart']) ? $_REQUEST['iDisplayStart'] : 0;
	$length = isset($_REQUEST['iDisplayLength']) ? $_REQUEST['iDisplayLength'] : 20;
	
	$jobData = $jobObject->getSearch($search, $start, $length);
	$alljobs = array();

	if($jobData) {
		for($i = 0; $i < count($jobData['records']); $i++) {
			$item = $jobData['records'][$i];
			$affiliatelink 	= $item['jobs_affiliate'] != '' ?  '<a href="'.$item['job_affiliateLink'].'" target="_blank">'.$item['jobs_affiliate'].'</a>' : 'YES';
			$affiliate 		= $item['jobs_affiliate'] != '' ?  $item['jobs_affiliate'] : 'N/A/';
			
			$alljobs[$i] = array($item['job_added'], 
											'<a class="'.($item['job_active'] == 0 ? 'error' : 'success').'" href="/admin/jobs/view/details.php?pk_job_id='.$item['pk_job_id'].'">'.$item['job_title'].'</a>', 
											$item['areaMap_shortPath'], 
											$affiliatelink,
											'<button onclick="javascript:changestatus(\''.$item['pk_job_id'].'\', \''.($item['job_active'] == 0 ? 1 : 0).'\');">Change Status</button>',
											'<button onclick="javascript:deleteitem(\''.$item['pk_job_id'].'\');">Delete</button>');
		}
	}

	if($jobData) {
		$response['sEcho'] = $_REQUEST['sEcho'];
		$response['iTotalRecords'] = $jobData['displayrecords'];		
		$response['iTotalDisplayRecords'] = $jobData['count'];
		$response['aaData']	= $alljobs;
	} else {
		$response['result'] 	= false;
		$response['message']	= 'There are no items to show.';			
	}
	
    echo json_encode($response);
    die();	
}

/* End Pagination Setup. */

/* display template */
$smarty->display('admin/jobs/view/default.tpl');

$jobObject = $action = $jobId = $jobIds = $where = $data = $jobData = null;
unset($jobObject, $action, $jobId, $jobIds, $where, $data, $jobData);
?>