<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'includes/auth.php';require_once 'class/career.php';require_once 'class/category.php';$careerObject = new class_career();$categoryObject = new class_category();$categorypairs = $categoryObject->pairs();if($categorypairs) $smarty->assign('categorypairs', $categorypairs);/* Pagination. */$currentPage		= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;$perPage 			= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 20;$listedPages		= 10;$scrollingStyle	= 'Sliding';/* Setup Pagination. */$careerData = $careerObject->getPaginated($zfsession->filters['filters_career_sql'],'career.career_added desc', $currentPage, $perPage, $listedPages, $scrollingStyle); $careerItems = $careerData->getCurrentItems();if($careerItems) {	$smarty->assign_by_ref('careerItems', $careerItems);	$paginator = $careerData->setView()->getPages();	$smarty->assign_by_ref('paginator', $paginator);}
/* Display Template. */
$smarty->display('careers/default.tpl');
?>