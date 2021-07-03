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

require_once 'class/jobApplication.php';


$jobApplicationObject = new class_jobApplication();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

/* Ajax */
$action			= (isset($_GET['a']) && !is_null($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';
$jobApplicationId	= (isset($_GET['jobApplicationId']) && !is_null($_GET['jobApplicationId']) && $_GET['jobApplicationId'] != '') ? $_GET['jobApplicationId'] : '';
$jobApplicationIds	= (isset($_GET['jobApplicationIds']) && !is_null($_GET['jobApplicationIds']) && $_GET['jobApplicationIds'] != '') ? $_GET['jobApplicationIds'] : '';

/* Filter. */
$filter					= "jobApplication_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "jobApplication_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$jobApplicationData = $jobApplicationObject->getPaginatedjobApplication($filter,'jobApplication.jobApplication_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$jobApplicationItems = $jobApplicationData->getCurrentItems();

$smarty->assign_by_ref('jobApplicationItems', $jobApplicationItems);

$paginator = $jobApplicationData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/jobs/jobApplication/jobApplicationHtml.tpl');

?>