<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');


if (isset($_GET['image']) && trim($_GET['image']) != '') {
	
	/** Standard includes */
	require_once 'config/database.php';

	/* objects. */
	require_once 'class/_comm.php';

	$commsObject 	= new class_comm();
	
	$image = trim($_GET['image']);
	
	$commData = $commsObject->getByCode($image);

	if($commData) {
		
		require_once 'class/_tracker.php';
		
		$trackerObject = new class_comm_tracker();
			
		/* Insert data. */
		$data = array();
		$data['_comm_code'] 	= $commData['_comm_code'];
		
		$trackerObject->insert($data);
		
	}
}