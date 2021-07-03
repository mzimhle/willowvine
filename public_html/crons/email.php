<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Email CSV Scrape</title>
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
		</style>
	</head>
	<body>
	<p>Scraping emails from "/crons/media/email/", any file that does not start with "done_".</p>
	<p>Format should be "name, cellphone,email"</p>
<?php

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 240); //300 seconds = 1 minute

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/spam.php';

$spamObject	= new class_spam();

echo '<p> ===================================================== </p>';
echo '<p>Get files in "/crons/media/email/" without "done_".</p>';

$files = scandir($_SERVER['DOCUMENT_ROOT'].'/crons/media/email/');

if(count($files) > 0) {
	for($i = 0; $i < count($files); $i++) {
		
		$file = $files[$i];
		
		if($file != '.' && $file != '..' && strpos($file, 'done_') === false) {
			
			echo '<h4 class="success">File: '.$file.'</h4>';
			echo '<p>=======================</p>';
			
			$handle = @fopen($_SERVER['DOCUMENT_ROOT'].'/crons/media/email/'.$file, "r");
			
			if ($handle) {
			
				while (($buffer = fgets($handle, 4096)) !== false) {
					
					$line = explode(',', $buffer);
					
					$fullname 			= trim($line[0]);
					$cellphone			= $spamObject->validateCell(trim($line[1]));
					$emailaddress	= $spamObject->validateEmail(trim($line[2]));
					
					$contact = true;
					
					$checkExist = $spamObject->getByEmail($emailaddress);							

					if($emailaddress != '') {
					
						$data = array();
						$data['spam_name'] 		= $fullname;
						$data['spam_email']		= $emailaddress;
						$data['spam_cellphone']	= $cellphone;
						$data['spam_website']	= $spamObject->getMailDomain($emailaddress);
						
						if(!$checkExist) {
							$success = $spamObject->insert($data);
							echo '<p class="success">Added: '.$fullname.' - '.$emailaddress.' and '.$cellphone.'</p>';
						} else {
							$where 	= $spamObject->getAdapter()->quoteInto('spam_code = ?', trim($checkExist['spam_code']));
							$success	= $spamObject->update($data, $where);
							echo '<p class="success">Updated: '.$fullname.' - '.$emailaddress.' and '.$cellphone.'</p>';							
						}
					} else {
						echo "<p class='error'>No email or cellphone</p>";
					}
				}
				
				if (!feof($handle)) {
					echo "<p class='error'>Unexpected fgets() fail, probably no more lines left.</p>";
				}
				fclose($handle);
				
				/* Rename file. */
				rename($_SERVER['DOCUMENT_ROOT'].'/crons/media/email/'.$file,$_SERVER['DOCUMENT_ROOT'].'/crons/media/email/done_'.$file); 
			}			
		} else {
			echo '<p class="error">'.$file.' = Not a valid file or already processed.</p>';
		}
	}
} else {
	echo '<p class="error">There are no files.</p>';
}
?>
</body>
</html>