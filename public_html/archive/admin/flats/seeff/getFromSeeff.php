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
require_once 'class/property.php';


/* Fetch the JSON. */
$flatJson = file_get_contents('http://website.stats.seeff.com/test_area/xml/defaultz.php');

/* Decode it to an array. */
$flatArray = json_decode($flatJson);

/* Classes. */
$propertyObject = new class_property();

/* Delete all 'seeff' properties. */
$conn->query("DELETE FROM property WHERE property_affiliate = 'seeff'");
echo count($flatArray).'<br />';
/* Insert it into database. */
foreach($flatArray as $flat) {

	/* Declare. */
	$data = array();
	
	/* Assign to the array. */
	$data['fkAreaId'] 					= (int)$flat->fkAreaId;
	$data['fkActionId'] 				= (int)$flat->fkActionId;
	$data['property_affiliate'] 		= 'seeff';
	$data['fkPropertyTypeId'] 			= (int)$flat->fkPropertyTypeId;
	$data['fkCategoryId'] 				= (int)$flat->fkCategoryId;
	$data['fkPropertyTypeName'] 		= $flat->searchPropertyTypeName;
	$data['property_reference'] 		= (int)$flat->propertyReference;
	$data['property_price'] 			= $flat->propertyPrice;
	$data['property_bedrooms'] 			= (int)$flat->searchBedrooms;
	$data['property_bathrooms'] 		= (int)$flat->searchBathrooms;
	$data['property_garages'] 			= (int)$flat->searchGarages;
	$data['property_parking'] 			= (int)$flat->searchSecureParking;
	$data['property_rentalTerm'] 		= $flat->searchRentalTerm;
	$data['property_shortDescription'] 	= $flat->propertyShortDescription;
	$data['property_FullDescription'] 	= $flat->propertyFullDescription;
	$data['property_address'] 			= $flat->propertyAddress;
	$data['property_contactEmail'] 		= $flat->agentEmail;
	$data['property_contactNumber'] 	= $flat->agentCell;
	$data['property_image'] 			= $flat->searchImage;
	$data['property_created']			= date('Y-m-d H:m:i', strtotime($flat->propertyCreated));
	
	/* insert into database. */
	$success = $propertyObject->insert($data);	
	
	echo $data['property_reference'].'<br />';
	
	$success = NULL; UNSET($success);
}
?>