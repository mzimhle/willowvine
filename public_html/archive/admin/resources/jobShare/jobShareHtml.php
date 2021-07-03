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

require_once 'class/jobShare.php';

$jobShareObject = new class_jobShare();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 20;
$scrollingStyle	= 'Sliding';

/* Filter. */
$filter					= "jobShare_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "jobShare_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$jobShareData = $jobShareObject->getPaginatedjobShare($filter,'jobShare.jobShare_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$jobShareItems = $jobShareData->getCurrentItems();

$smarty->assign_by_ref('jobShareItems', $jobShareItems);

$paginator = $jobShareData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/jobShare/jobShareHtml.tpl');

?>