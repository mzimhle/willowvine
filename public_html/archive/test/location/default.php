<?php
/* Add this on all pages on top. */

set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/location.php';

echo 'your IP address:.'.$location->ipAddress.'<br /><br />';

print_r($_SESSION);
?>