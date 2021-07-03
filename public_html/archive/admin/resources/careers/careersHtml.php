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

require_once 'class/career.php';


$careerObject = new class_career();
 
/* Pagination. */
$currentPage	= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;
$perPage 		= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 30;
$listedPages	= 20;
$scrollingStyle	= 'Sliding';

/* Ajax */
$action	= (isset($_GET['a']) && !is_null($_GET['a']) && $_GET['a'] != '') ? $_GET['a'] : '';
$careerId		= (isset($_GET['careerId']) && !is_null($_GET['careerId']) && $_GET['careerId'] != '') ? $_GET['careerId'] : '';
$careerIds	= (isset($_GET['careerIds']) && !is_null($_GET['careerIds']) && $_GET['careerIds'] != '') ? $_GET['careerIds'] : '';

if ($action != '') {
	if ($careerId != '' || $careerIds != '') {
		if ($action == 'delete') {
			$careerIds = explode(',',$careerIds);			
			$data = array('career_deleted' => 1);
			foreach ($careerIds as $careerId) {
				$where = $careerObject->getAdapter()->quoteInto('pk_career_id = ?', $careerId);
				$careerObject->update($data, $where);
			}
		}
	}
	
	exit;
}

/* Filter. */
$filter					= "career_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "career_title~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$careerData = $careerObject->getPaginatedAdminCareer($filter,'careers.career_added DESC', $currentPage, $perPage, $listedPages, $scrollingStyle);
 
$careerItems = $careerData->getCurrentItems();

$smarty->assign_by_ref('careerItems', $careerItems);

$paginator = $careerData->setView()->getPages();

$smarty->assign_by_ref('paginator', $paginator);

/* End Pagination Setup. */

/* 
	display template
*/
$smarty->display('admin/resources/careers/careersHtml.tpl');

?>