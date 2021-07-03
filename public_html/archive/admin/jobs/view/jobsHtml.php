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

require_once 'class/job.php';


$jobObject = new class_job();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 20;
$scrollingStyle	= 'Sliding';

/* Ajax */
$action	= (isset($_GET['a']) && !is_null($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';
$jobId		= (isset($_GET['jobId']) && !is_null($_GET['jobId']) && $_GET['jobId'] != '') ? $_GET['jobId'] : '';
$jobIds	= (isset($_GET['jobIds']) && !is_null($_GET['jobIds']) && $_GET['jobIds'] != '') ? $_GET['jobIds'] : '';

if ($action != '') {
	if ($jobId != '' || $jobIds != '') {
		if ($action == 'delete') {
			$jobIds = explode(',',$jobIds);			
			$data = array('job_deleted' => 1);
			foreach ($jobIds as $jobId) {
				$where = $jobObject->getAdapter()->quoteInto('pk_job_id = ?', $jobId);
				$jobObject->update($data, $where);
			}
		}
	}
	
	exit;
}

/* Filter. */
$filter					= "job_deleted = 0";
$filter_fields			= "search_text~t, job_area~t"; // filter fields to remember
$filter_search_fields 	= "job_title~t, job_area~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$jobData = $jobObject->getPaginatedAdminjob($filter,'job.job_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$jobItems = $jobData->getCurrentItems();

$smarty->assign_by_ref('jobItems', $jobItems);

$paginator = $jobData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/jobs/view/jobsHtml.tpl');

?>