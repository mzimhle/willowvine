<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title></title>
		<style type="text/css">
			.error {
				color:#b90000 !important;
				display:block !important;
				font-weight:bold !important;
			}

			.success {
				color:#339900 !important;
				display:block !important;
				font-weight:bold !important;
			}
			.header {
				font-size: 30px;
			}
			.sub-header {
				font-size: 21px;
			}
			p {
				margin-top: 1px; 
				margin-bottom: 1px;
			}
		</style>
	</head>
	<body>
<?php

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 300); //300 seconds = 1 minute

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* objects. */
require_once 'class/_message.php';
require_once 'class/spam.php';
require_once 'class/_comm.php';

function getPage($link) {
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER 	=> true,     // return web page
        CURLOPT_HEADER         		=> false,    // don't return headers
        CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
        CURLOPT_ENCODING       		=> "",       // handle all encodings
        CURLOPT_USERAGENT      		=> "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322", // who am i
        CURLOPT_AUTOREFERER    	=> true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT	=> 120,      // timeout on connect
        CURLOPT_TIMEOUT        		=> 120,      // timeout on response
        CURLOPT_MAXREDIRS      		=> 10,       // stop after 10 redirects
    );

    $curl = curl_init($link);
    curl_setopt_array($curl, $options);
    $urlContent = curl_exec($curl);
    curl_close($curl);
	
	/* Clean it up. */
	$curl = NULL; UNSET($curl);
	
	return  $urlContent;
}

$messageObject	= new class_message();
$spamObject			= new class_spam();
$commObject		= new class_comm();

$messageData = $messageObject->getToSpam();

if(isset($messageData[0]['_message_code']) && trim($messageData[0]['_message_code'] != '')) {
	echo '<p class="header">Messages</p>';	
	echo '<p>========================================================</p>';	 
	for($i = 0; $i < count($messageData); $i++) {
		
		$item = $messageData[$i];
		
		/* People / companies to spam. */
		$spamData = $spamObject->getByMessage($item['_message_code'], $item['_message_type'], 3);
		
		echo '<p class="sub-header">'.$item['_message_name'].'</p>';

		if($spamData) {
			if($item['_message_type'] == 'EMAIL') {
				
				/* Get template with message. */
				$link = $_SERVER['HTTP_HOST'].$item['_message_file'];
				
				$page = getPage($link);

				if($page) {
					
					for($s = 0; $s < count($spamData); $s++) {
						
						$success = $commObject->sendSpam($spamData[$s], $item, $page);
						
						if($success) {
							echo '<p class="success">'.$spamData[$s]['spam_name'].' - '.$spamData[$s]['spam_email'].'</p>';	
						} else {
							echo '<p class="error">'.$spamData[$s]['spam_name'].' - '.$spamData[$s]['spam_email'].'</p>';	
						}						
					}
					
				} else {
					echo '<p class="error">No html file.</p>';	
				}
				
			} else if($item['_message_type'] == 'SMS') {
			
			} else {
				echo '<p class="error">No message type.</p>';	
			}
		} else {
			echo '<p class="error">No people to message</p>';	
		}
		echo '<p>========================================================</p>';	 
	}
} else {
	echo '<p class="error">There are no messages to send out</p>';	
}


?>