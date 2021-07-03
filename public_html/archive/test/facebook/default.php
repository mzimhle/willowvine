  <?php
  
require_once 'facebook.php';
  
//Post to Facebook
//Variables

//willowvine.dev
/* 
$app_id 				= "403087556391206";
$app_secret 		= "da27de9c87b1da3ce078822fac600de7"; 
$my_url 				= "http://willowvine.dev";

*/
// willowvine.co.za
$app_id 				= "208476749269525";
$app_secret 		= "baa224f206af2f57d6021259249750cf"; 
$my_url 				= "http://www.willowvine.co.za/";


	

// 




/*
	willowvine.dev
	$access_token 	= "BAAFumyKcsSYBANSIiTH7JCy8Igf6WSNW2dA1HsasYZCZByZC0FAM3eUIomoG8wHOJPDTgd8wZAedwjZAtiITvzfwN8oDzZCNwzrc3jJHXdJ8AZBEZBYAzTSSwpXGAfquAAXpXOmmJg8vSeM5bOs7xZBo3YuLUqc8cu0rlMmtOC3dHjzcQqpWccZB1OZAhTNspDlNKtwz33aYyiZCQgZDZD";
	willowvine.co.za
	$access_token	= "BAAC9m8aVihUBABC0HQoNiCZBwX0WIhLiGhZA6OGzTjKSumG35xD35zpgVlehuaQ2BJNkpeXKXBPLgvXxgluat3ILB8bIhb6FpnYjaOaQE3ipb7PpuXYKTTLCBiq5cI0uLV8hCeSxeiesBZAkDev0ZASF29OifqJIRg9ttsUuIMK1s7W3zlynLjA3yscsQ2f6pkFO49qZAPQZDZD";
*/

$page_id 			= "143264135760812";

//Create the facebook object
$facebook = new Facebook(array(
	'appId' 	=> $app_id,
	'secret' 	=> $app_secret,
	'perms'		=> 'offline_access',
	'cookie' 	=> true
));

$token = $facebook->getAccessToken();

//Write to the Page wall
try {
    $attachment = array(
                'access_token' => $token,
                'message'=> "Testing"
        );

    $result = $facebook->api("/$page_id/feed",'POST', $attachment);
var_dump( $result); exit;
} catch(Exception $e) {
    //Send me an email
    print_r($e);
}

?>