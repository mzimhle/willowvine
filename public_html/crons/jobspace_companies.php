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

function getPage($link) {
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER 	=> true,     // return web page
        CURLOPT_HEADER         	=> false,    // don't return headers
        CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
        CURLOPT_ENCODING       	=> "",       // handle all encodings
        CURLOPT_USERAGENT      	=> "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322", // who am i
        CURLOPT_AUTOREFERER    	=> true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT	=> 120,      // timeout on connect
        CURLOPT_TIMEOUT        	=> 120,      // timeout on response
        CURLOPT_MAXREDIRS      	=> 10,       // stop after 10 redirects
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
		'link' 				=> 'http://www.jobspace.co.za/jobs_at/kontak_recruitment-1789991',
		'category_code' => 3,
		'email'				=> 'recruitment@kontak.co.za',
		'poster'				=> 'Kontak'
	),
	1 => array(
		'link' 				=> 'http://www.jobspace.co.za/jobs_at/ezulwini_staffing-1791907',
		'category_code' => 2,
		'email'				=> 'ezulwinistaffing@gmail.com',
		'poster'				=> 'Ezulwini Staffing'
	),
	3 => array(
		'link' 				=> 'http://www.jobspace.co.za/jobs_at/mit_group-1784885',
		'category_code' => 19,
		'email'				=> 'ernie@mitgroup.co.za',
		'poster'				=> 'MIT Group'
	)				
);

$key 	= rand(0, count($itemsLink));
$page 	= '?ajax=itemList&page='.rand(1, 5);

/* Object. */
if(isset($itemsLink[$key]['link']) && trim($itemsLink[$key]['link']) != '') {

	/* Get variables. */	
	//$page		= isset($page) && (int)trim($page) > 0 ? (int)trim($page) : 1;
	$company 	= $itemsLink[$key];
	
	$link		= trim($company['link']).$page;
	
	$urlContent = getPage($link);

	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('.items', 0)->innertext;

	/* Loop through all the jobs. */
	$counter = 0;
	$badwords = array('loan', 'afford', 'apply', 'doctor', 'spell', 'potion', 'money', 'love', 'lower', 'married', 'voodoo', 'gambling', 'lottery', 'winning', 'powerful');
	
	while(($item = str_get_html($results)->find('.item_summary', $counter)->innertext) != NULL) {
	
		/* Get the job. */
		$data = array();
		$data['recruiter_code']		= '5183';
		$data['areapost_code'] 		= null;
		$data['category_code']		= $company['category_code'];
		$data['job_title']			= str_get_html($item)->find('a', 0)->innertext; 	
		$data['job_poster_name']	= $company['poster'];
		$data['job_poster_email'] 	= $company['email'];
		$data['job_poster_number']	= null;
		$data['job_type']			= null;
		$data['job_reference']		= null;
		$data['job_link']			= 'http://www.jobspace.co.za'.str_get_html($item)->find('a', 0)->href; 
		$data['job_area']			= null;
		$data['job_address']		= null;			
		$data['job_page']			= null;				
		$data['job_active']			= 1;
		$data['job_deleted']		= 0;
		
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
					$data['job_area'] 		= $areasearch[0]['areapost_name'];	
					
					$listedDate				= str_get_html($jobContent)->find('dd', 3)->innertext;
					
					if($listedDate == date('M d, Y', strtotime($listedDate))) {
						$data['job_added']  	= date('Y-m-d h:i:s A', strtotime($listedDate));	
					} else {
						$listedDate	= str_get_html($jobContent)->find('dd', 4)->innertext;
					}
					
					$data['job_added']  	= date('Y-m-d h:i:s A', strtotime($listedDate));			
					$page = str_get_html($jobContent)->find('.container .descriptionblock p', 0)->innertext;

					/* Remove email addresses from the content. */
					$pattern = "/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
					$replacement = "[you must apply via willowvine website]";
					$page = preg_replace($pattern, $replacement, $page);			
					
					$data['job_page']			= $page;

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
} else {
	echo 'None.';
}
?>
</body>
</html>