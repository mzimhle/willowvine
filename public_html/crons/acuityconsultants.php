<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Acuity Consultants</title>
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
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/actuarial/'
				),
				1 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/analyst-jobs/'
				),				
				2 => array(
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/business-intelligence/'
				),
				3 => array(
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/business-analysis/'
				),
				4 => array(
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/consulting/'
				),	
				5 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/data-analysis/'
				),
				6 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/data-analysis-analyst-jobs/'
				),	
				7 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/data-warehousing/'
				),	
				8 => array(
					'category_code' => 67481,
					'link'			=> 'http://acuityconsultants.co.za/job-category/executive-jobs/'
				),	
				9 => array(
					'category_code' => 18,
					'link'			=> 'http://acuityconsultants.co.za/job-category/finance/'
				),	
				10 => array(
					'category_code' => 18,
					'link'			=> 'http://acuityconsultants.co.za/job-category/financial-jobs/'
				),	
				11 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/information-technology/'
				),
				12 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/it-jobs/'
				),	
				13 => array(
					'category_code' => 2,
					'link'			=> 'http://acuityconsultants.co.za/job-category/it-sales/'
				),	
				14 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/it-support/'
				),	
				15 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/systems-engineering/'
				),
				16 => array(
					'category_code' => 78976,
					'link'			=> 'http://acuityconsultants.co.za/job-category/project-management/'
				),		
				17 => array(
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/quantitative-analysis/'
				),		
				18 => array(
					'category_code' => 3,
					'link'			=> 'http://acuityconsultants.co.za/job-category/risk-analysis/'
				),		
				19 => array(
					'category_code' => 2,
					'link'			=> 'http://acuityconsultants.co.za/job-category/sales/'
				),		
				20 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/sap-jobs/'
				),
				21 => array(
					'category_code' => 78976,
					'link'			=> 'http://acuityconsultants.co.za/job-category/sap-business-systems-analysis/'
				),	
				22 => array(
					'category_code' => 78976,
					'link'			=> 'http://acuityconsultants.co.za/job-category/sap-programme-project-management/'
				),	
				23 => array(
					'category_code' => 1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/software-development/'
				),	
				24 => array(
					'category_code' =>1,
					'link'			=> 'http://acuityconsultants.co.za/job-category/software-testing/'
				),					
			);

$jobObject			= new class_job();
$areapostObject	= new class_areapost();

$rand = rand(0, 24);

$link = $linkArray[$rand];

/* Object. */
if(isset($link['link'])) {
	
	echo '<b>'.$link['link'].'</b><br /><br />';
	
    $urlContent = getPage($link['link']);
	
	if($urlContent) {

		$maintable = str_get_html($urlContent)->find('#tabs-content tbody', 0)->innertext;
		
		if($maintable) {
		
			for($i = 1; $i < 40; $i++) {
				/* Get the first DIV in the results page. */		

				$td = str_get_html($maintable)->find('tr', $i)->innertext;

				if($td) {
					
					$data = array();
					$data['recruiter_code'] 			= '9429';
					$data['areapost_code'] 			= null;
					$data['category_code'] 			= $link['category_code'];
					$data['job_title'] 					= str_get_html($td)->find('a', 0)->innertext;
					$data['job_poster_name'] 		= null;
					$data['job_poster_email'] 		= null;
					$data['job_poster_number'] 	= null;
					$data['job_type']					= 'permanent';
					$data['job_reference']			= null;
					$data['job_link']						= str_get_html($td)->find('a', 0)->href;
					$data['job_area']					= null;
					$data['job_address']				= null;			
					$data['job_page']					= null;				
					$data['job_active']					= 1;
					$data['job_deleted']				= 0;

					$jobData = $jobObject->getByLink($data['job_link']);

					if(!$jobData) {
						/* Go to job details. */
						$jobpage = getPage($data['job_link']);

						if($jobpage) {
						
							$meta = str_get_html($jobpage)->find('header .meta', 0)->innertext;
							
							if($meta) {
									
								for($z = 0; $z < 4; $z++) {
									
									$title = str_get_html($meta)->find('span strong', $z)->innertext;
									
									if($title == 'Location:') {
										
										$location = str_get_html($meta)->find('span b', $z)->innertext;
										
										$areasearch = $areapostObject->searchParents($location, 1);
										
										if(!$areasearch) {
											$areasearch = $areapostObject->search($location, 1);
										}
										
										if($areasearch) {							
											$data['areapost_code'] 	= $areasearch[0]['areapost_code'];
											$data['job_area'] 			= $areasearch[0]['areapost_name'];
										} else {
											$data['job_area'] 			= $location;
										}									
									}

									if($title == 'Consultant:') {
										
										$consultant = str_get_html($meta)->find('span', $z)->innertext;
										
										$consultant = delete_all_between('<strong>', '</strong>', $consultant);
																			
										$data['job_poster_name'] = $consultant; 
									}
									
								}
								
								/* Get Page. */								
								$page = str_get_html($jobpage)->find('.entry-content', 0)->innertext;

								$matches = array();
								$pattern = '/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/';
								preg_match_all($pattern,$page,$matches);
								
								if(count($matches) > 0) {	

									if(isset($matches[0][0]) && $jobObject->validateEmail($matches[0][0]) != '') {
										$data['job_poster_email']	= $matches[0][0];
									}
									
									if($data['job_poster_email'] != null) {
									
										/* Look for the telephone number. */
										$numberstring = str_replace(' ', '', $page);
										$matches = array();
										$pattern = '/[0-9]{10}/';
										preg_match_all($pattern,$numberstring,$matches);			
										
										if(isset($matches[0][0]) && $jobObject->validateCell($matches[0][0]) != '') {											
											$data['job_poster_number'] 	= $matches[0][0];											
										}
										
										$data['job_reference'] = 'ID#'.str_get_html($page)->find('#job_id', 0)->value;
										
										$page	= delete_all_between('<h2', '</h2>', $page);
										$page 	= delete_all_between('<h1', '</h1>', $page);
										$page 	= delete_all_between('<form', '</form>', $page);
										$page 	= delete_all_between('<hr', '/>', $page);
										
										/* Remove email addresses from the content. */
										$pattern			= "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
										$replacement	= "[you must apply via willowvine website]";
										$page 					= preg_replace($pattern, $replacement, $page);
						
										$data['job_page'] = $page;
									}
								}

								if($jobObject->insert($data)) {
									echo '<p class="success">'.$data['job_title'].' in '.$data['job_area'].'</p>';
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