<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* standard config include. */require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'includes/auth.php';require_once 'class/exam.php';require_once 'class/subject.php';$examObject = new class_exam();$subjectObject = new class_subject();$subjectpairs = $subjectObject->pairs();if($subjectpairs) $smarty->assign('subjectpairs', $subjectpairs);/* Pagination. */$currentPage		= (isset($_GET['page']) && $_GET['page'] !='' ) ? (int)$_GET['page'] : 1;$perPage 			= (isset($_GET['per_page~i']) && !is_null($_GET['per_page~i']) && $_GET['per_page~i'] != '' && is_numeric($_GET['per_page~i'])) ? $_GET['per_page~i'] : 20;$listedPages		= 10;$scrollingStyle	= 'Sliding';/* Setup Pagination. */$examData = $examObject->getPaginated($zfsession->filters['filters_exam_sql'],'exam.exam_added desc', $currentPage, $perPage, $listedPages, $scrollingStyle); $examItems = $examData->getCurrentItems();if($examItems) {	$smarty->assign_by_ref('examItems', $examItems);	$paginator = $examData->setView()->getPages();	$smarty->assign_by_ref('paginator', $paginator);}
/* Display Template. */
$smarty->display('exams/default.tpl');
?>