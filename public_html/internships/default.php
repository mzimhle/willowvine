<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'includes/auth.php';require_once 'class/internship.php';require_once 'class/category.php';$internshipObject = new class_internship();$categoryObject = new class_category();$categorypairs = $categoryObject->pairs();if($categorypairs) $smarty->assign('categorypairs', $categorypairs);/* Pagination. */$currentPage		= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;$perPage 			= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 20;$listedPages		= 10;$scrollingStyle	= 'Sliding';/* Setup Pagination. */$internshipData = $internshipObject->getPaginated($zfsession->filters['filters_intern_sql'],'internship.internship_added desc', $currentPage, $perPage, $listedPages, $scrollingStyle); $internshipItems = $internshipData->getCurrentItems();if($internshipItems) {	$smarty->assign_by_ref('internshipItems', $internshipItems);	$paginator = $internshipData->setView()->getPages();	$smarty->assign_by_ref('paginator', $paginator);}
/* Display Template. */
$smarty->display('internships/default.tpl');
?>