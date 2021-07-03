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
/* Classes. */
require_once 'class/job.php';
require_once 'class/areaMap.php';
/* Objects. */
$areaMapObject = new class_areaMap();

$areaMapData = $areaMapObject->getAllareas('polygon_code != ""');
	
for($i = 0; $i < count($areaMapData); $i++) {
	echo getShortPath($areaMapData[$i], $areaMapObject);
}
?>