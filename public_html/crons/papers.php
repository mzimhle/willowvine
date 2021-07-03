<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Exam Papers</title>
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
<?php

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 240); //300 seconds = 1 minute

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'scrape/simple_html_dom.php';
require_once 'class/File.php';

$fileObject		= new File(array('docx', 'doc', 'pdf', 'txt'));

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

$link = 'http://www.papersharesa.co.za/papers/';

$page = getPage($link);

/* Object. */
if($page) {

		$ul = str_get_html($page)->find('ul', 0)->innertext;

		if($ul) {
		
			for($i = 1; $i < 15; $i++) {
				/* Get the first DIV in the results page. */		

				$href = htmlspecialchars_decode(trim(str_get_html($ul)->find('li a', $i)->href));
				$title = trim(str_get_html($ul)->find('li a', $i)->innertext);
				
				if(trim($href) != '/' && strpos($href, '.') === false) {
					
					$directory	= $_SERVER['DOCUMENT_ROOT'].'/crons/media/papers/'.$title;					
					
					if(!is_dir($directory)) mkdir($directory, 0777, true);
					
					if(is_dir($directory)) {
						echo '<h3>'.$title.'</h3>';
						$folder = getPage($link.$href);
						
						if($folder) {
						
							$folderul = str_get_html($folder)->find('ul', 0)->innertext;
							
							if($folderul) {
								
								for($f = 1; $f < 30; $f++) {
								
									$folderhref = htmlspecialchars_decode(str_get_html($folderul)->find('li a', $f)->href);
									$foldertitle = str_get_html($folderul)->find('li a', $f)->innertext;
									
									if(trim($folderhref) != '/papers/' && strpos($folderhref, '.') !== false) {
										
										$ext	= strtolower($fileObject->file_extention($folderhref));		
										
										$downloadfile	= $link.$href.$folderhref;
										$filename			= $foldertitle;
										$file					= $directory.$filename;

										if(file_put_contents($file, fopen($downloadfile, 'r'))) {
											echo '<p class="success">File Uploaded: '.$downloadfile.'</p>';
										} else {
											echo '<p class="success">File Upload Failed: '.$downloadfile.'</p>';
										}
									}				
								}
							}
						}
						echo '<p> =============================================================================== </p>';	
					}					
				} else {
					echo '<p class="error">Not a subject: '.$title.'</p>';
				}
			}
		} else {
			echo '<p class="error">No subjects</p>';
		}
} else {
	echo '<p class="error">Empty page</p>';
}
?>
</body>
</html>