<?php

function StringToFilename($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);	

	return $string;
			
}

function createReference($connObject) {
	/* New reference. */
	$reference = substr(md5(rand(123, 98745)), 1, 10);
	
	/* First check if it exists or not. */
	$itemCheck = $connObject->getByReference($reference);
	
	if(count($itemCheck) > 0) {
		/* It exists. check again. */
		createReference($connObject);
	} else {
		return $reference;
	}
}

function StringToUrl($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower($name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace("é", "e", $name);
	$name = str_replace("è", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "_", $name);
	$name = str_replace("\\", "_", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "_", $name);
	$name = str_replace(".", "_", $name);
	$name = str_replace("ë", "e", $name);
	$name = str_replace('___' , '_' , $name);
	$name = str_replace('__' , '_' , $name);

	return $name;
			
}
?>