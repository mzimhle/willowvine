<?php
require_once 'config/setup.php';
require_once 'class/job.php';

global $smarty, $location, $areaData, $type, $sectionData;

/* Objects. */
$jobObject 		= new class_job();

$searchJob	= (isset($_GET['searchJob']) && trim($_GET['searchJob'] !='') ) ? trim($_GET['searchJob']) : '';

$whereArea		= is_array($areaData) && isset($areaData['fkAreaId']) ? 'fk_area_id = '.$areaData['fkAreaId'] : NULL;
$whereType		= $type != '' ? 'job_type = \''.$type.'\'' : NULL;
$whereSection	= isset($sectionData[0]['pk_section_id']) && (int)$sectionData[0]['pk_section_id'] != 0 ? 'fk_section_id = '.$sectionData[0]['pk_section_id'] : NULL;

$jobByAreaData = $jobObject->jobCountByArea($location->sessionArea, $searchJob, $whereArea, $whereType, $whereSection);
$jobByTypeData = $jobObject->jobCountByType($location->sessionArea, $searchJob, $whereArea, $whereType, $whereSection);

if(count($jobByTypeData) > 0) $smarty->assign('jobByTypeData', $jobByTypeData);
if(count($jobByAreaData) > 0) $smarty->assign('jobByAreaData', $jobByAreaData);

$smarty->assign('location', $location->sessionArea);

$smarty->display('includes/filter_jobs_right.tpl');
?>