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
require_once 'class/areaMap.php';
require_once 'functions.php';

$areaMapObject = new class_areaMap();

/**
  * If the item exists populate the form with data
  */
if (!empty($_REQUEST['fkAreaId']) && $_REQUEST['fkAreaId'] != '') {
	
	$fkAreaId = (int)$_REQUEST['fkAreaId'];
	
	$areaData = $areaMapObject->getByfkAreaId($fkAreaId);
	if(count($areaData) > 0) {
		$smarty->assign('areaData', $areaData[0]);
	} else {
				header('Location: /admin/resources/areas/details.php');
				exit;	
	}
	
	$smarty->assign('fkfkAreaId', $fkAreaId);
} else {
				header('Location: /admin/resources/areas/details.php');
				exit;
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	/*
	if(isset($_POST['polygon_code']) && trim($_POST['polygon_code']) == '') {
		$errorArray['polygon_code'] = 'required';
		$formValid = false;
	}
	*/
	
	if(count($errorArray) == 0 && $formValid == true) {
			
		/* Create the file. */
			/* Get the province. */
			$provinceArray	= explode('|', $areaData[0]['areaMap_sPath']);
			$provinceData	= $areaMapObject->getByfkAreaId($provinceArray[2]);
			$provinceName	= StringToUrl_Areas($provinceData[0]['areaMap_name']);
			
		/* Define the data. */
			$data['polygon_filename']	= $AREA_HTTP_PATH.'/'.$provinceName.'/'.StringToUrl_Areas($areaData[0]['areaMap_name']).'.js';
			$data['polygon_code'] 		= isset($_POST['polygon_code']) && trim($_POST['polygon_code']) != '' ? trim($_POST['polygon_code']) : '';
			$data['areaMap_codePath']	= isset($_POST['areaMap_codePath']) && trim($_POST['areaMap_codePath']) != '' ? trim($_POST['areaMap_codePath']) : '';
			
			/* Create the file. */;					
			$file = $AREA_ROOT_PATH.'/'.$provinceName.'/'.StringToUrl_Areas($areaData[0]['areaMap_name']).'.js';			
			$fileHandler = fopen($file, 'w');
			fwrite($fileHandler, $data['polygon_code']);
			fclose($fileHandler);
		/* End Creating a file. */
		
		if(isset($areaData) && count($areaData) == 1) {		
			$where = $areaMapObject->getAdapter()->quoteInto('fkAreaId = ?', $fkAreaId);
			$success = $areaMapObject->update($data, $where);
		} 
		
		if(is_numeric($success) && $success > 0) {							
				header('Location: /admin/resources/areas/details.php?fkAreaId='.$areaData[0]['fkAreaId']);
				exit;
		}	
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
	
}

$smarty->display('admin/resources/areas/polygon.tpl');

?>