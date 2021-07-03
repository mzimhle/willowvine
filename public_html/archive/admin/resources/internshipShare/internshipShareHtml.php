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

require_once 'class/internshipShare.php';

$internshipShareObject = new class_internshipShare();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 20;
$scrollingStyle	= 'Sliding';

/* Filter. */
$filter					= "internshipShare_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "internshipShare_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$internshipShareData = $internshipShareObject->getPaginatedInternshipShare($filter,'internshipShare.internshipShare_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$internshipShareItems = $internshipShareData->getCurrentItems();

$smarty->assign_by_ref('internshipShareItems', $internshipShareItems);

$paginator = $internshipShareData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/internshipShare/internshipShareHtml.tpl');

?>