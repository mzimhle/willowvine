<?php

function StringToUrl($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower($name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace("�", "e", $name);
	$name = str_replace("�", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "_", $name);
	$name = str_replace("\\", "_", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "_", $name);
	$name = str_replace(".", "_", $name);
	$name = str_replace("�", "e", $name);	

	return $name;
			
}

?>