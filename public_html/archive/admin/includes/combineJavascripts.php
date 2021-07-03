<?php
/**
 * Standard includes
 */
require_once 'config/setup.php';

$javascripts ='';  

$javascripts .= file_get_contents(ROOT."/library/javascript/jquery/jquery.validate.js");
$javascripts .= file_get_contents(ROOT."/library/javascript/jquery/jquery.form.js");


echo $javascripts;
?>