<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* standard config include. */
require_once 'config/database.php';
require_once 'config/smarty.php';

global $smarty;

/* include the Zend class for Authentification */
require_once 'Zend/Session.php';
require_once('global_functions.php');

/* Set up the namespace */
$zfsession = new Zend_Session_Namespace('FrontLogin');

/* Check if logged in, otherwise redirect */
if (isset($zfsession->identity) || !is_null($zfsession->identity) || $zfsession->identity != '') {
	/* Class */
	require_once 'config/smarty.php';
	require_once 'class/participantlogin.php';
	
	/* Object */
	$participantloginObject 	= new class_participantlogin();
	
	/* Get Normal account details. */
	$participantloginData	= $participantloginObject->getByCode($zfsession->identity);		

	if($participantloginData) {
		$smarty->assign('participantloginData', $participantloginData);	
		
		$zfsession->participant = $participantloginData;
		
		global $participantloginData;	
	} else {
		/* Redirect to the main page. */
		header('Location: /');
		exit;	
	}
} else {
	
	/* Lets first check if we are not in the account folder. */
	if(strripos($_SERVER['REQUEST_URI'], '/account') !== false) {
		/* Redirect to the main page. */
		header('Location: /');
		exit;	
	} 
	
}

/* Job Shortlists. */
if(isset($participantloginData)) {
		
	$zfsession->shortlist 			= array();
	$zfsession->shortlistdata	= array();
	
	$zfsession->shortlistinternships		= array();
	$zfsession->shortlistinternshipsdata	= array();
	
	require_once 'class/shortlist.php';
	
	$shortlistObject	= new class_shortlist();
	
	/* JOBS */
	$tempData = $shortlistObject->getByParticipant($participantloginData['participant_code'], 'JOB');		
	
	if($tempData) {
		
		$zfsession->shortlistdata = $tempData;
		$zfsession->shortlist = $shortlistObject->getByParticipantList($participantloginData['participant_code'], 'JOB');
	}
	
	/* INTERNSHIPS */
	
	$internshipData = $shortlistObject->getByParticipant($participantloginData['participant_code'], 'INTERNSHIP');		
	
	if($internshipData) {
		
		$zfsession->shortlistinternshipsdata = $internshipData;
		$zfsession->shortlistinternships = $shortlistObject->getByParticipantList($participantloginData['participant_code'], 'INTERNSHIP');
	}
	
} else {

	$zfsession->shortlist = isset($zfsession->shortlist) ? $zfsession->shortlist : array();
	$zfsession->shortlistdata = isset($zfsession->shortlistdata) ? $zfsession->shortlistdata : array();
	
	$zfsession->shortlistinternships = isset($zfsession->shortlistinternships) ? $zfsession->shortlistinternships : array();
	$zfsession->shortlistinternshipsdata = isset($zfsession->shortlistinternshipsdata) ? $zfsession->shortlistinternshipsdata : array();
	
}

$smarty->assign('shortlist', $zfsession->shortlist);
$smarty->assign('shortlistdata', $zfsession->shortlistdata);
$smarty->assign('shortlistinternships', $zfsession->shortlistinternships);
$smarty->assign('shortlistinternshipsdata', $zfsession->shortlistinternshipsdata);

/* Search for jobs filters. */
$zfsession->filters					 = isset($zfsession->filters) ? $zfsession->filters : array();
$zfsession->filters['filters_sql'] = isset($zfsession->filters['filters_sql']) && trim($zfsession->filters['filters_sql']) != '' ? $zfsession->filters['filters_sql'] : 'job.job_deleted = 0';

/*************************************** JOB FILTER. */
if(isset($_POST['btnFilter'])) {

	$zfsession->filters = array();
	$zfsession->filters['filters_sql'] = 'job.job_deleted = 0';
	
	/* Lets filters jobs. */
	if(isset($_POST['filter_category']) && trim($_POST['filter_category']) != '') {
		
		require_once 'class/category.php';
		
		$categoryObject = new class_category();
		
		$categoryData = $categoryObject->getByCode(trim($_POST['filter_category']));

		if($categoryData) {			
			$zfsession->filters['filters_category'] = $categoryData['category_code'];
			$zfsession->filters['category'] = $categoryData;
			$zfsession->filters['filters_sql'] .= " and job.category_code = '".$categoryData['category_code']."'";			
		}
	}
	
	if(isset($_POST['filter_type']) && count($_POST['filter_type']) != 0) {
		$zfsession->filters['filters_type'] = $_POST['filter_type'];		
		$zfsession->filters['type'] = implode(', ', $_POST['filter_type']);		
		$temptypes = "'".implode("','", $_POST['filter_type'])."'";
		$zfsession->filters['filters_sql'] .= " and job.job_type in(".preg_replace("/[^a-z0-9\,\']+/i", "", $temptypes).")";
	}
	
	if(isset($_POST['filter_province']) && trim($_POST['filter_province']) != '') {
		
		$zfsession->filters['filters_province'] = trim($_POST['filter_province']);
		$zfsession->filters['filters_sql'] .= " and areapost.areapost_name like '%".strtolower(preg_replace("/[^a-z0-9\-]+/i", "", trim($_POST['filter_province'])))."%'";		
		
	}
	
	if(isset($_POST['filter_title']) && trim($_POST['filter_title']) != '') {
		
		$zfsession->filters['filters_title'] = trim($_POST['filter_title']);
		$zfsession->filters['filters_sql'] .= " and lower(job.job_title) like '%".strtolower(preg_replace("/[^a-z\-]+/i", "", trim($_POST['filter_title'])))."%'";		
		
	}
}

/*************************************** INTERNSHIP FILTER. */

/* Search for internship filters. */
$zfsession->filters['filters_intern_sql'] = isset($zfsession->filters['filters_intern_sql']) && trim($zfsession->filters['filters_intern_sql']) != '' ? $zfsession->filters['filters_intern_sql'] : 'internship.internship_deleted = 0';

if(isset($_POST['btnInternFilter'])) {

	$zfsession->filters = array();
	$zfsession->filters['filters_intern_sql'] = 'internship.internship_deleted = 0';
	
	/* Lets filters internships. */
	if(isset($_POST['filter_intern_category']) && trim($_POST['filter_intern_category']) != '') {
		
		require_once 'class/category.php';
		
		$categoryObject = new class_category();
		
		$categoryData = $categoryObject->getByCode(trim($_POST['filter_intern_category']));

		if($categoryData) {			
			$zfsession->filters['filter_intern_category'] = $categoryData['category_code'];
			$zfsession->filters['intern_category'] = $categoryData;
			$zfsession->filters['filters_intern_sql'] .= " and internship.category_code = '".$categoryData['category_code']."'";			
		}
	}
	
	if(isset($_POST['filter_intern_name']) && trim($_POST['filter_intern_name']) != '') {
		
		$zfsession->filters['filter_intern_name'] = trim($_POST['filter_intern_name']);
		$zfsession->filters['filters_intern_sql'] .= " and lower(internship.internship_name) like '%".strtolower(preg_replace("/[^a-z\-]+/i", "", trim($_POST['filter_intern_name'])))."%'";		
		
	}
	//print_r($zfsession->filters); exit;
}

/*************************************** CAREER FILTER. */

/* Search for internship filters. */
$zfsession->filters['filters_career_sql'] = isset($zfsession->filters['filters_career_sql']) && trim($zfsession->filters['filters_career_sql']) != '' ? $zfsession->filters['filters_career_sql'] : 'career.career_deleted = 0';

if(isset($_POST['btnCareerFilter'])) {

	$zfsession->filters = array();
	$zfsession->filters['filters_career_sql'] = 'career.career_deleted = 0';
	
	/* Lets filters careerships. */
	if(isset($_POST['filter_career_category']) && trim($_POST['filter_career_category']) != '') {
		
		require_once 'class/category.php';
		
		$categoryObject = new class_category();
		
		$categoryData = $categoryObject->getByCode(trim($_POST['filter_career_category']));

		if($categoryData) {			
			$zfsession->filters['filter_career_category'] = $categoryData['category_code'];
			$zfsession->filters['career_category'] = $categoryData;
			$zfsession->filters['filters_career_sql'] .= " and career.category_code = '".$categoryData['category_code']."'";			
		}
	}
	
	if(isset($_POST['filter_career_name']) && trim($_POST['filter_career_name']) != '') {
		
		$zfsession->filters['filter_career_name'] = trim($_POST['filter_career_name']);
		$zfsession->filters['filters_career_sql'] .= " and lower(career.career_name) like '%".strtolower(preg_replace("/[^a-z\-]+/i", "", trim($_POST['filter_career_name'])))."%'";		
		
	}
	//print_r($zfsession->filters); exit;
}

/*************************************** EXAM FILTER. */

/* Search for internship filters. */
$zfsession->filters['filters_exam_sql'] = isset($zfsession->filters['filters_exam_sql']) && trim($zfsession->filters['filters_exam_sql']) != '' ? $zfsession->filters['filters_exam_sql'] : 'exam.exam_deleted = 0';

if(isset($_POST['btnExamFilter'])) {

	$zfsession->filters = array();
	$zfsession->filters['filters_exam_sql'] = 'exam.exam_deleted = 0';
	
	/* Lets filters examships. */
	if(isset($_POST['filter_exam_subject']) && trim($_POST['filter_exam_subject']) != '') {
		
		require_once 'class/subject.php';
		
		$subjectObject = new class_subject();
		
		$subjectData = $subjectObject->getByCode(trim($_POST['filter_exam_subject']));

		if($subjectData) {			
			$zfsession->filters['filter_exam_subject'] = $subjectData['subject_code'];
			$zfsession->filters['exam_subject'] = $subjectData;
			$zfsession->filters['filters_exam_sql'] .= " and exam.subject_code = '".$subjectData['subject_code']."'";			
		}
	}
	
	if(isset($_POST['filter_exam_name']) && trim($_POST['filter_exam_name']) != '') {
		
		$zfsession->filters['filter_exam_name'] = trim($_POST['filter_exam_name']);
		$zfsession->filters['filters_exam_sql'] .= " and lower(exam.exam_name) like '%".strtolower(preg_replace("/[^a-z\-]+/i", "", trim($_POST['filter_exam_name'])))."%'";		
		
	}
	//print_r($zfsession->filters); exit;
}

$smarty->assign('filters', $zfsession->filters);

?>