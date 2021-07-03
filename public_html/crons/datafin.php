<html>
	<head>
		<title>Datafin</title>
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
ini_set('max_execution_time', 300); //300 seconds = 1 minute

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';

require_once 'scrape/simple_html_dom.php';
require_once 'class/job.php';
require_once 'class/areapost.php';


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

function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}

$jobObject			= new class_job();
$areapostObject	= new class_areapost();

$link = 'http://www.datafin.com/vacancies/search/';

/* Object. */
if(trim($link) != '') {
	
	echo '<b>'.$link.'</b><br /><br />';
	
    $urlContent = getPage($link);
	$counter = 0;

	for($i = 0; $i < 20; $i++) {
		/* Get the first DIV in the results page. */
		$maintable = str_get_html($urlContent)->find('.main-content .clearfix', $i)->innertext;
		$success 	= true;
		
		if($maintable) {
			
			$reference = str_replace(' ', '', str_get_html($maintable)->find('.meta li strong', 0)->innertext);
			
			$data = array();
			$data['recruiter_code'] 			= '0521';
			$data['areapost_code'] 			= null;
			$data['category_code'] 			= 1;
			$data['job_title'] 					= str_get_html($maintable)->find('h1 a', 0)->innertext;;
			$data['job_poster_name'] 		= null;
			$data['job_poster_email'] 		= null;
			$data['job_poster_number'] 	= null;
			$data['job_type']					= null;
			$data['job_reference']			= $reference;
			$data['job_link']						= null;
			$data['job_area']					= null;
			$data['job_address']				= null;			
			$data['job_page']					= null;				
			$data['job_active']					= 1;
			$data['job_deleted']					= 0;
			
			/* Check if reference already exists before proceeding. */
			$jobData = $jobObject->getByReference($reference);
			
			if(!$jobData) {
			
				/* Look for job type. */
				$jobtype = str_replace('-', '',str_replace(' ', '', strtolower(str_get_html($maintable)->find('.meta li', 5)->innertext)));	

				$typearray = array('casual', 'temp', 'contract', 'parttime', 'permanent', 'graduate', 'internship', 'volunteer');
				
				for($s = 0; $s < count($typearray); $s++ ){
					if(strpos($jobtype, $typearray[$s]) !== false) 
					{
						$data['job_type'] = $typearray[$s];
						break;
					}
				}
				
				for($z = 1; $z <= 6; $z++) {
					
					$string = str_get_html($maintable)->find('.icon-thirds li em', $z)->innertext;

					if(str_replace(' ', '', strtolower($string)) != 'southafrica') {
						
						/************************************************************************** Check if its a date. */
						if($z == 1) {
							if($jobObject->validateDate($string) != '') {						
								$data['job_added'] = $jobObject->validateDate($string);
							} 
						}
						
						/************************************************************************** Check if its an area. */
						if($z == 3) {
							$areasearch = $areapostObject->searchParents($string, 1);
							
							if(!$areasearch) {
								$areasearch = $areapostObject->search($string, 1);
							}
							
							if($areasearch) {							
								$data['areapost_code'] 	= $areasearch[0]['areapost_code'];
								$data['job_area'] 			= $areasearch[0]['areapost_name'];
							}
						}
						
						/************************************************************************** Check if its a name. */
						if($z == 4) {						
							$data['job_poster_name'] = $string;
						}	
						
						/************************************************************************** Check if its number. */
						if($z == 5) {
							if($jobObject->validateCell($string) != '') {						
								$data['job_poster_number'] = $jobObject->validateCell($string);
							} 																	
						}
						
						/************************************************************************** Check if its an email. */
						if($z == 6) {
							$email = str_get_html($string)->find('a', 0)->innertext;

							if($jobObject->validateEmail($email) != '') {						
								$data['job_poster_email'] = $jobObject->validateEmail($email);
							} 																	
						}				
					}
				}
				
				if($data['job_poster_email'] != null) {
					
					$url = str_get_html($maintable)->find('.last p a', 0)->href;
					
					$url = 'http://www.datafin.com'.$url;
					
					/* Get page details. */
					$page = getPage($url);
					
					if($page) {
												
						$pagedata = str_get_html($page)->find('.clearfix .four-fifths', 1)->innertext;

						$out = delete_all_between('<ul', '</ul>', $pagedata);
						$out = delete_all_between('<a', '</a>', $out);
						$out = delete_all_between('<a', '</a>', $out);
						$out = delete_all_between('<h4>', '</h4>', $out);
						
						/* Remove email addresses from the content. */
						$pattern		= "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
						$replacement	= "[you must apply via willowvine website]";
						$out 			= preg_replace($pattern, $replacement, $out);
						
						/* Remove advertising crap. */
						$out = str_replace('www.datafin.com', 'www.willowvine.co.za', $out);
						$out = str_replace('DataFin IT Recruitment', 'Willowvine', $out);
						
						$data['job_link']	= $url;
						$data['job_page']	= $out;
										
						if($jobObject->insert($data)) {
							echo '<p class="success">'.$data['job_title'].' in '.$data['job_area'].'</p>';
							$counter++;
						} else {
							echo '<p class="error">'.$data['job_title'].' in '.$data['job_area'].'</p>';
						}
					} else {
						echo '<p class="error">Page not available: '.$data['job_title'].' in '.$data['job_area'].'</p>';
					}
				} else {
					echo '<p class="error">Email not available: '.$data['job_title'].' in '.$data['job_area'].'</p>';
				}
			} else {
				echo '<p>Duplicate: '.$jobData['job_title'].' in '.$jobData['job_area'].'</p>';
			}
		} else {
			echo '<p class="error">No Jobs</p>';
		}
		
		if($counter == 20) break;
	}	
} else {
	echo '<p class="error">No Link</p>';
}
?>
</body>
</html>