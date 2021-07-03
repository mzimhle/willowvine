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

/* Other classes. */
require_once 'class/section.php';


$sectionObject = new class_section();
 
/* Setup Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 10;
$listedPages	= 10;
$scrollingStyle	= 'Sliding';

$sectionData = $sectionObject->getPaginatedsection('section.section_added != ""','section.section_name ASC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$sectionItems = $sectionData->getCurrentItems();

$smarty->assign_by_ref('sectionItems', $sectionItems);

$paginator = $sectionData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/sections/section_jobs/sectionHtml.tpl');

?>