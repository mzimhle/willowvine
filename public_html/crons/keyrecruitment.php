<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Key Recruitment</title>
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

$linkArray = array(
				0 => array(
					'category_code' => 61847,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=creative'
				),
				1 => array(
					'category_code' => 2,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=digital'
				),				
				2 => array(
					'category_code' => 67481,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=executive'
				),
				3 => array(
					'category_code' => 11,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=hospitality'
				),
				4 => array(
					'category_code' => 6,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=office'
				),	
				5 => array(
					'category_code' => 1,
					'link'			=> 'http://www.keyrecruitment.co.za/?jcat=technical-2'
				)					
			);

$jobObject		= new class_job();
$areapostObject	= new class_areapost();

$rand = rand(0, 5);

$link = $linkArray[$rand];

/* Object. */
if(isset($link['link'])) {
	
	echo '<b>'.$link['link'].'</b><br /><br />';
	
    $urlContent = getPage($link['link']);
	$counter = 0;

	if($urlContent) {
		
		$maintable = str_get_html($urlContent)->find('.l-content form', 0)->innertext;

		if($maintable) {

			for($i = 1; $i < 21; $i++) {
				/* Get the first DIV in the results page. */		

				$jobitemtable = str_get_html($maintable)->find('.job'.$i, 0)->innertext;

				if($jobitemtable) {
					
					$data = array();
					$data['recruiter_code'] 	= '9748';
					$data['areapost_code'] 		= null;
					$data['category_code'] 		= $link['category_code'];
					$data['job_title'] 			= str_get_html($jobitemtable)->find('td a', 0)->innertext;
					$data['job_poster_name'] 	= 'Key Recruitment';
					$data['job_poster_email'] 	= 'info@keyrecruitment.co.za';
					$data['job_poster_number'] 	= '0214611848';
					$data['job_type']			= 'permanent';
					$data['job_reference']		= null;
					$data['job_link']			= str_get_html($jobitemtable)->find('td a', 0)->href;
					$data['job_area']			= null;
					$data['job_address']		= 'The Palms Centre, 145 Sir Lowry Street, Fourth Floor, East Wing, Cape Town, 8001';			
					$data['job_page']			= null;				
					$data['job_active']			= 1;
					$data['job_deleted']		= 0;

					$jobData = $jobObject->getByLink($data['job_link']);

					if(!$jobData) {
						/* Go to job details. */
						$jobpage = getPage($data['job_link']);
						
						if($jobpage) {
						
							$jobtable = str_get_html($jobpage)->find('.l-content', 0)->innertext;
							
							if($jobtable) {
								
								for($z = 0; $z < 6; $z++) {
									
									$tr = str_get_html($jobtable)->find('table tr', $z)->innertext;
									
									$th = str_get_html($tr)->find('th', 0)->innertext;
									$td = str_get_html($tr)->find('td', 0)->innertext;
									
									if($th == 'Location') {
									
										$areasearch = $areapostObject->searchParents($td, 1);
										
										if(!$areasearch) {
											$areasearch = $areapostObject->search($td, 1);
										}
										
										if($areasearch) {							
											$data['areapost_code'] 	= $areasearch[0]['areapost_code'];
											$data['job_area'] 		= $areasearch[0]['areapost_name'];
										}									
									}
									
									if($th == 'Job Information') {

										/* Remove email addresses from the content. */
										$pattern		= "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
										$replacement	= "[you must apply via willowvine website]";
										$td 			= preg_replace($pattern, $replacement, $td);	
										
										/* Remove advertising crap. */
										$td = str_replace('keyrecruitment.co.za', 'willowvine.co.za', $td);
							
										$data['job_page'] = $td;
									}
								}

								if($jobObject->insert($data)) {
									echo '<p class="success">'.$data['job_title'].' in '.$data['job_area'].'</p>';
									$counter++;
								} else {
									echo '<p class="error">'.$data['job_title'].' in '.$data['job_area'].'</p>';
								}							
							}
						}
					} else {
						echo '<p class="error">Duplicate Job</p>';
					}
				} else {
					echo '<p class="error">No Jobs</p>';
				}
			}
		} else {
			echo '<p class="error">No jobs/p>';
		}
	} else {
		echo '<p class="error">No Link</p>';
	}
} else {
	echo '<p class="error">No Link</p>';
}
?>
</body>
</html>