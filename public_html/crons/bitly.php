<?php

set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';

require_once('TwitterAPIExchange.php');
require_once('class/job.php');
require_once('class/_twitter.php');

$jobObject 		= new class_job();
$twitterObject 	= new class_twitter();

$jobData = $jobObject->getForTwitter();

function getSmallLink($longurl){  

	$url = "http://api.bit.ly/shorten?version=2.0.1&longUrl=$longurl&login=willownettica&apiKey=R_7e4f545822114a9d9e6ace21904c57e1&format=json&history=1";  

	$s = curl_init();  
	curl_setopt($s,CURLOPT_URL, $url);  
	curl_setopt($s,CURLOPT_HEADER,false);  
	curl_setopt($s,CURLOPT_RETURNTRANSFER,1);  
	$result = curl_exec($s);  
	curl_close( $s );  

	$obj = json_decode($result, true); 

	return $obj["results"]["$longurl"]["shortUrl"];  
}
	
if($jobData) {
	
	$data = array();
	$data['job_code']				= $jobData['job_code'];
	$data['_twitter_message']	= $jobData['job_title'];
	$data['_twitter_text'] 			= '';
	$data['_twitter_link'] 			= '';
	
	if($jobData['job_type'] != '') {
		$data['_twitter_message']	= $data['_twitter_message'].' a '.ucfirst($jobData['job_type']).' job.';
	}
	
	$link = 'http://www.willowvine.com/job/'.$jobData['job_url'].'/'.$jobData['job_code'];
	
	$data['_twitter_link']	= getSmallLink($link);
	
	$data['_twitter_message'] = $data['_twitter_message'].' - '.$data['_twitter_link'];
	
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
		'oauth_access_token' 			=> "582896853-xDXSBmK7V5jk6liVFYcBPR2CCS7VEeosmLkCXiw4",
		'oauth_access_token' 			=> "582896853-xDXSBmK7V5jk6liVFYcBPR2CCS7VEeosmLkCXiw4",
		'oauth_access_token_secret' 	=> "zZPyrrtdkwpUB1WsUJER5hLD1gSWxnlovBNMtMOMoLuu2",
		'consumer_key' 					=> "IUQRDyao4atpRglcYaRWGYJEk",
		'consumer_secret' 					=> "dxlENS3s8i1H12L4SpFso33rlJwLhI5CtVXVGccE4uR0itpMIK"
	);

	/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/ 
	$url = 'https://api.twitter.com/1.1/statuses/update.json'; 

	// $url = 'https%3A%2F%2Fapi.twitter.com%2F1.1%2Fstatuses%2Fupdate.json'; 
	$requestMethod = 'POST'; 

	/** POST fields required by the URL above. See relevant docs as above **/ 
	$postfields = array( 'status' => $data['_twitter_message'], ); 

	// See more at: http://sharescripts.blogspot.com/2013/07/how-to-post-tweet-from-website-using-php.html#sthash.kGEWdqVv.dpuf
	/** Perform a POST request and echo the response **/ 
	$twitter = new TwitterAPIExchange($settings); 

	$data['_twitter_text'] = $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest(); 
	
	$twitterObject->insert($data);
}
?>	 