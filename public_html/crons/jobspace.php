<html>
	<head>
		<title>Job Space</title>
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

exit;
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('max_execution_time', 300); //300 seconds = 1 minute

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';

require_once 'scrape/simple_html_dom.php';

require_once 'class/job.php';
require_once 'class/areapost.php';

error_reporting(!E_NOTICE);

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

$itemsLink = array (
	0 => array(
						'link' => 'http://www.jobspace.co.za/jobs/accounting-334',
						'category_code' => 3
			),
	1	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/banking_&_finance-337',
						'category_code' => 3	
	),
	2	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/hospitality-20004',
						'category_code' => 11
	),
	3	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/maintenance_&_facilities-20106',
						'category_code' => 4		
	),
	4	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/marketing_media_&_communication-10280',
						'category_code' => 2	
	),
	5	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/science-10143',
						'category_code' => 20		
	),
	6	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/tourism-350',
						'category_code' => 11		
	),
	7	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/other-352',
						'category_code' => 0
	),
	8	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/administration-335',
						'category_code' => 6	
	),
	9	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/computers_&_it-339',
						'category_code' => 1
	),
	10	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/engineering-342',
						'category_code' => 4	
	),
	11	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/hr_&_recruitment-344',
						'category_code' => 12
	),
	12	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/management_&_executive-20085',
						'category_code' => 6		
	),
	13	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/retail-347',
						'category_code' => 7		
	),
	14	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/sport_&_fitness-20114',
						'category_code' => 26	
	),
	15	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/trades_&_services-10144',
						'category_code' => 22	
	),
	16	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/agriculture-336',
						'category_code' => 21		
	),
	17	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/construction_&_architecture-340',
						'category_code' => 4		
	),
	18	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/healthcare-343',
						'category_code' => 26
	),
	19	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/legal_&_paralegal-345',
						'category_code' => 5		
	),
	20	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/manufacturing-346',
						'category_code' => 4		
	),
	21	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/sales-348',
						'category_code' => 2		
	),
	22	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/teaching_&_education-349',
						'category_code' => 12
	),
	23	=> array(
						'link' => 'http://www.jobspace.co.za/jobs/transport_&_logistics-351',
						'category_code' => 22	
	)
);
/*
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/accountant-10167', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/accounts_analyst-10168', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/accounts_clerk-10169', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/accounts_payable-10170', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/accounts_receivable-10171', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/financial_controller-10172', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/management-10173', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/payroll-10174', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/other-10175', 'category_code' => 3);


$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/actuary-20002', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/analyst-10188', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/client_services-10189', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/corporate_&_institutional-10190', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/credit_&_lending-10191', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/financial_planning-10192', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/funds_management_&_investment-10193', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/insurance-10194', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/management-10195', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/settlements-10196', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/tellers_&_branch_staff-10197', 'category_code' => 3);
$itemsLink[] = array('link' => 'http://www.jobspace.co.za/jobs/other-10198', 'category_code' => 3);

$itemsLink[] = array('link' => '', 'category_code' => 3);
$itemsLink[] = array('link' => '', 'category_code' => 3);
$itemsLink[] = array('link' => '', 'category_code' => 3);
$itemsLink[] = array('link' => '', 'category_code' => 3);
*/

$key 	= rand(0, 23);
$page 	= '?page='.rand(1, 100);

/* Object. */
if(isset($itemsLink[$key]['link']) && trim($itemsLink[$key]['link']) != '') {

	/* Get variables. */	
	//$page		= isset($page) && (int)trim($page) > 0 ? (int)trim($page) : 1;
	$link			= trim($itemsLink[$key]['link']).$page;
	$category	= (int)trim($itemsLink[$key]['category_code']);
	
	$urlContent = getPage($link);

	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.items', 0)->innertext;

	/* Loop through all the jobs. */
	$counter = 0;
	$badwords = array('loan', 'afford', 'apply', 'doctor', 'spell', 'potion', 'money', 'love', 'lower', 'married', 'voodoo', 'gambling', 'lottery', 'winning', 'powerful');
	
	while(($item = str_get_html($results)->find('.item_summary', $counter)->innertext) != NULL) {
	
		/* Get the job. */
		$data = array();
		$data['recruiter_code']			= '5183';
		$data['areapost_code'] 			= null;
		$data['category_code']			= $category;
		$data['job_title']					= str_get_html($item)->find('a', 0)->innertext; 	
		$data['job_poster_name']		= 'Job Poster';
		$data['job_poster_email'] 		= null;
		$data['job_poster_number']	= null;
		$data['job_type']					= null;
		$data['job_reference']			= null;
		$data['job_link']						= 'http://www.jobspace.co.za'.str_get_html($item)->find('a', 0)->href; 
		$data['job_area']					= null;
		$data['job_address']				= null;			
		$data['job_page']					= null;				
		$data['job_active']					= 1;
		$data['job_deleted']				= 0;
		
		$tempname = strtolower($data['job_title']);
		$bad = true;
		
		for($w = 0; $w < count($badwords); $w++) {
			$pos = strpos($tempname, $badwords[$w]);
			if ($pos !== FALSE) {
				$bad = false;
			}
		}		
		
		if($bad) {
			/* Fetch Data to temporary store. */
			$jobData = $jobObject->getByLink($data['job_link']);
			
			if(!$jobData) {
			
				$detailsContent = getPage($data['job_link']);
				
				/* Get current job important content. */
				$jobContent = str_get_html($detailsContent)->find('.itemblockcontainer', 0)->innertext;
				
				/* Pregmatch to find an email address. */
				$emailContent	= str_get_html($jobContent)->find('p', 0)->innertext;		
				$pattern		="/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i"; 			
				preg_match_all($pattern, $emailContent, $matches);
				
				if(count($matches) > 0) {
					for($i = 0; $i < count($matches); $i++) {
						if(isset($matches[$i][0])) {
							if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $matches[$i][0])) {
								$data['job_poster_email'] = $matches[$i][0];
							}			
						}
					}
				}
				
				if($data['job_poster_email'] != null) {
					/* Get the temporary area. */			
					$tempLocation		= str_get_html($jobContent)->find('dd', 1)->innertext;
					$tempTwoLocation	= str_get_html($tempLocation)->find('a', 0)->innertext;
					$tempThreeLocation	= str_get_html($tempLocation)->find('a', 1)->innertext;

					$areasearch = $areapostObject->searchParents($tempThreeLocation, 1);
					
					if(!$areasearch) {
						$areasearch = $areapostObject->search($tempThreeLocation, 1);
					}
										
					if($areasearch) {
						
						$data['areapost_code'] 	= $areasearch[0]['areapost_code'];
						$data['job_area'] 			= $areasearch[0]['areapost_name'];	
						$listedDate					= str_get_html($jobContent)->find('dd', 3)->innertext;			
						$data['job_added']  		= date('Y-m-d h:i:s A', strtotime($listedDate));			
						
						/* Remove email addresses from the content. */
						$pattern = "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
						$replacement = "[you must apply via willowvine website]";
						$emailContent = preg_replace($pattern, $replacement, $emailContent);			
						
						$data['job_page']			= $emailContent;
						
						/* Get job type. */
						$jobTypeTemp = str_get_html($jobContent)->find('dd', 2)->innertext;
						if(trim($jobTypeTemp) == 'Full Time') $data['job_type'] = 'permanent';
						if(trim($jobTypeTemp) == 'Part Time') $data['job_type'] = 'temp';
						if(trim($jobTypeTemp) == 'Contract') $data['job_type'] = 'contract';
						if(trim($jobTypeTemp) == 'Freelance') $data['job_type'] = 'contract';

						/* Insert job. */
						$success = $jobObject->insert($data);
						echo '<p class="success">'.$data['job_title'].' in '.$data['job_area'].'</p>';		
					} else {
						echo '<p class="error">No Area: '.$data['job_title'].'</p>';
					}
				} else {
					echo '<p class="error">No Email: '.$data['job_title'].'</p>';
				}
			} else {
				echo '<p>Duplicate Job: '.$data['job_title'].'</p>';
			}
		} else {
			echo '<p class="error">Bad words in title: '.$data['job_title'].'</p>';
		}
		
		/* Got to the next one. */
		$counter++;
		
		/* Clean up. */
		$where = $success = $data = $jobExists = $jobTypeTemp = $jobContent = $emailContent = $replacement = $pattern = $listedDate = $areaExists = $finalArea = NULL;
		$tempThreeLocation = $tempTwoLocation = $tempLocation = $matches = $emailContent = $detailsContent = $curl = NULL;
		
		UNSET($where  ,$success ,$data ,$jobExists ,$jobTypeTemp ,$jobContent ,$emailContent ,$replacement ,$pattern ,$listedDate ,$areaExists ,$finalArea);
		UNSET($tempThreeLocation ,$tempTwoLocation ,$tempLocation ,$matches ,$emailContent ,$detailsContent ,$curl);
	}	
}
?>
</body>
</html>