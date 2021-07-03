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

require_once 'class/internship.php';

$internshipObject = new class_internship();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 20;
$scrollingStyle	= 'Sliding';

/* Ajax */
$action	= (isset($_GET['a']) && !is_null($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';
$internshipId		= (isset($_GET['internshipId']) && !is_null($_GET['internshipId']) && $_GET['internshipId'] != '') ? $_GET['internshipId'] : '';
$internshipIds	= (isset($_GET['internshipIds']) && !is_null($_GET['internshipIds']) && $_GET['internshipIds'] != '') ? $_GET['internshipIds'] : '';

if ($action != '') {
	if ($internshipId != '' || $internshipIds != '') {
		if ($action == 'delete') {
			$internshipIds = explode(',',$internshipIds);			
			$data = array('internship_deleted' => 1);
			foreach ($internshipIds as $internshipId) {
				$where = $internshipObject->getAdapter()->quoteInto('pk_internship_id = ?', $internshipId);
				$internshipObject->update($data, $where);
			}
		}
	}
	
	exit;
}

/* Filter. */
$filter					= "internship_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "internship_title~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$internshipData = $internshipObject->getPaginatedAdmininternship($filter,'internships.internship_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$internshipItems = $internshipData->getCurrentItems();

$smarty->assign_by_ref('internshipItems', $internshipItems);

$paginator = $internshipData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/internships/internshipsHtml.tpl');

?>