<html>
	<head>
		<title>Dav</title>
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

function get_email_addresses($string) {
	$pattern="/(?:[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[A-Za-z0-9-]*[A-Za-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";

	preg_match_all($pattern, $string, $matches);
	
	return $matches;
}
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

function clearArea($title) {

	$name = strtolower(trim($title));
	$name = str_replace('south' , '' , $name);
	$name = str_replace('north' , '' , $name);
	$name = str_replace('east' , '' , $name);
	$name = str_replace('west', '', $name);	
	$name = str_replace('other', '', $name);	
	$name = str_replace('-', '', $name);	
	$name = str_replace('central', '', $name);	

	return trim($name);	
}

$jobObject			= new class_job();
$areapostObject	= new class_areapost();



$link = "http://careers.peopleclick.eu.com/careerscp/client_adcorpgroup/dav/search.do?functionName=search&com.peopleclick.cp.formdata.isAdvanced=false&com.peopleclick.cp.formdata.FLD_JPM_PROVINCE=-1&com.peopleclick.cp.formdata.FLD_JPM_PROVINCE=&com.peopleclick.cp.formdata.JPM_LOCATION=-1&com.peopleclick.cp.formdata.JPM_LOCATION=&com.peopleclick.cp.formdata.FLD_JPM_SUBURB=-1&com.peopleclick.cp.formdata.FLD_JPM_SUBURB=&com.peopleclick.cp.formdata.FLD_JP_POSITION_CATEGORY=-1&com.peopleclick.cp.formdata.FLD_JP_POSITION_CATEGORY=&com.peopleclick.cp.formdata.FLD_JPM_JOB_FUNCTION=-1&com.peopleclick.cp.formdata.FLD_JPM_JOB_FUNCTION=&com.peopleclick.cp.formdata.FLD_JPM_JOB_FUNCTION_DETAIL=-1&com.peopleclick.cp.formdata.FLD_JPM_JOB_FUNCTION_DETAIL=&com.peopleclick.cp.formdata.JPM_DURATION=-1&com.peopleclick.cp.formdata.JPM_DURATION=&com.peopleclick.cp.formdata.FLD_JPM_EMPLOYMENT_EQUITY=-1&com.peopleclick.cp.formdata.FLD_JPM_EMPLOYMENT_EQUITY=&com.peopleclick.cp.formdata.SEARCHCRITERIA_JOBPOSTAGE=-1&com.peopleclick.cp.formdata.SEARCHCRITERIA_JOBPOSTAGE=&com.peopleclick.cp.formdata.SEARCHCRITERIA_KEYWORDS=&com.peopleclick.cp.formdata.SEARCHCRITERIA_CLIENTREQID=&com.peopleclick.cp.formdata.SEARCHCRITERIA_ALLKEYWORDS=&com.peopleclick.cp.formdata.SEARCHCRITERIA_EXACTPHRASE=&com.peopleclick.cp.formdata.SEARCHCRITERIA_ANYKEYWORDS=&com.peopleclick.cp.formdata.SEARCHCRITERIA_WITHOUTKEYWORDS=&com.peopleclick.cp.formdata.hitsPerPage
=10&input=Search";

/* Object. */
if(trim($link) != '') {	
	echo '<h3>'.$link.'</h3>';
	
    $urlContent 	= getPage($link);

	for($i = 1; $i < 51; $i++) {
		echo '<br />========================================================================<br />';
		/* Get the first DIV in the results page. */
		$maintable = str_get_html($urlContent)->find('#searchResultsTable tbody tr', $i)->innertext;
		$success 	= true;

		if($maintable) {
			
			$currentarea = trim(clearArea(trim(str_get_html($maintable)->find('.pc-rtg-tableItem', 2)->innertext)));

			$areaData = $areapostObject->search($currentarea, 1);
			
			if($areaData) {

				$data = array();
				$data['recruiter_code'] 			= '0698';
				$data['areapost_code'] 			= isset($areaData[0]) ? $areaData[0]['areapost_code'] : null;;
				$data['category_code'] 			= null;
				$data['job_title'] 					= trim(str_get_html($maintable)->find('.pc-rtg-tableItem a', 0)->innertext);
				$data['job_poster_name'] 		= null;
				$data['job_poster_email'] 		= null;
				$data['job_poster_number'] 	= null;
				$data['job_type']					= null;
				$data['job_reference']			= trim(str_get_html($maintable)->find('.pc-rtg-tableItem', 0)->innertext);
				$data['job_link']						= 'http://careers.peopleclick.eu.com/careerscp/client_adcorpgroup/dav/'.trim(str_get_html($maintable)->find('.pc-rtg-tableItem a', 0)->href);
				$data['job_area']					= isset($areaData[0]) ? $areaData[0]['areapost_name'] : null;
				$data['job_address']				= null;			
				$data['job_page']					= null;				
				$data['job_added']					= date('Y-m-d', strtotime(str_get_html($maintable)->find('.pc-rtg-tableItem', 4)->innertext));
				$data['job_active']					= 1;
				$data['job_deleted']				= 0;			
				
				echo '<p class="success">'.$data['job_title'].' ('.$data['job_reference'].')</p>';
				
				/* Check if reference already exists before proceeding. */
				$jobData = $jobObject->getByReference($data['job_reference']);

				if(!$jobData) {
					/* get link of the job to get its details. */					
					$url = $data['job_link']; 
					parse_str(parse_url($url, PHP_URL_QUERY), $array);
					
					$code = isset($array['amp;jobPostId']) && trim($array['amp;jobPostId']) != '' ? trim($array['amp;jobPostId']) : '';					
					$code = isset($array['jobPostId']) && trim($array['jobPostId']) != '' ? trim($array['jobPostId']) : $code;
					
					$pagedetails = getPage('http://careers.peopleclick.eu.com/careerscp/client_adcorpgroup/dav/jobDetails.do?functionName=getJobDetail&jobPostId='.$code.'&localeCode=en-us');
					
					/* On success, process the details. */
					if($pagedetails) {
						/* We are just looking for the job type here. */						
						$p = 0;
						while(str_get_html($pagedetails)->find('.pc-rtg-label-preview', $p)->innertext != '') {						
							if (strpos(str_get_html($pagedetails)->find('.pc-rtg-label-preview', $p)->innertext,'Job Vacancy Type') !== false) {
								/* Look for job type. */
								$jobtype = strtolower(str_get_html($pagedetails)->find('.pc-rtg-label-preview', $p)->innertext);	

								$typearray = array('casual', 'temp', 'contract', 'parttime', 'permanent', 'graduate', 'internship', 'volunteer');
								
								for($s = 0; $s < count($typearray); $s++ ){
									if(strpos($jobtype, $typearray[$s]) !== false) 
									{
										echo '<p class="success">Job type found: '.$typearray[$s].'</p>';
										$data['job_type'] = $typearray[$s];
										break;
									}
								}
							}						
							$p++;
						}						
					}
					
					/* Get job description copy. */
					$html = str_get_html($pagedetails)->find('table p', 1)->innertext;
					
					/* Find name of the poster. */
					$data['job_poster_name'] = str_replace('&nbsp;' , ' ' , get_string_between($html, 'Contact', 'on')) != '' ? str_replace('&nbsp;' , ' ' , get_string_between($html, 'Contact', 'on')) : 'Madeleine Nydegger';
					
					/* Find the agent's email address. */
					$matches = get_email_addresses($html);

					if(count($matches) > 0) {
						for($m = 0; $m < count($matches[0]); $m++) {						
							if($jobObject->validateEmail($matches[0][$m]) != '') {						
								$data['job_poster_email'] = $jobObject->validateEmail($matches[0][$m]);
							}
						}
					} else {
						echo '<p class="error">There is no email address, break.</p>';
						break;
					}
					
					/* Find the job's telephone number to call. */
					$copy = $html;
					
					$copy = str_replace('+27' , '0' ,$copy);
					$copy = str_replace(' ' , '' ,$copy);
					$matches = array();
					preg_match_all('/[0-9]{10}+/', $copy, $matches);
					
					if(count($matches) > 0) {
						for($m = 0; $m < count($matches[0]); $m++) {						
							if($jobObject->validateCell($matches[0][$m]) != '') {						
								$data['job_poster_number'] = $jobObject->validateCell($matches[0][$m]);
							}
						}
					}
					
					/* Clean the copy and insert the job. */
					$html = delete_all_between('<a', '</a>', $html);
					$html = delete_all_between('<a', '</a>', $html);
					
					/* Remove email addresses from the content. */
					$pattern		= "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
					$replacement	= "[you must apply via willowvine website]";
					$html 			= preg_replace($pattern, $replacement, $html);
					
					/* Remove advertising crap. */
					$html = str_replace('dav.co.za', 'willowvine.co.za', $html);
					$html = str_replace('Dav', 'Willowvine', $html);
					
					$data['job_page']	= $html;
					
					if(trim($data['job_page']) != '') {
						if($jobObject->insert($data)) {
							echo '<p class="success">'.$data['job_title'].' in '.$data['job_area'].'</p>';
						} else {
							echo '<p class="error">'.$data['job_title'].' in '.$data['job_area'].'</p>';
						}				
					} else {
						echo '<p>No content was found.... description empty..</p>';
					}
				} else {
					echo '<p>Duplicate: '.$jobData['job_title'].' in '.$jobData['job_area'].'</p>';
				}
			} else {
				echo '<p class="error">Area not available.</p>';
			}					
		} else {
			echo '<p class="error">No Jobs</p>';
		}
	}	
} else {
	echo '<p class="error">No Link</p>';
}
?>
</body>
</html>