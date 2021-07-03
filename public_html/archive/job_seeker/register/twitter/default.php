<?php 
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');/* include the Zend class for Authentification */
require_once 'Zend/Session.php';

/* Set up the namespace */
$zfsession = new Zend_Session_Namespace('FrontLogin');

/* standard config include. */
require_once 'config/setup.php';

/* Get the class. */
require_once 'twitter/twitteroauth.php';
	
/* TwitterOAuth instance, with two new parameters we got in auth_twitter.php */
$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

/* Get token. */$request_token = $twitteroauth->getRequestToken('http://www.willowvine.co.za/includes/auth_twitter.php');

/* Saving them into the session */
$zfsession->oauth_token 		= $request_token['oauth_token'];
$zfsession->oauth_token_secret 	= $request_token['oauth_token_secret'];

/* If everything goes well.. */
if($twitteroauth->http_code==200){
    /* Let's generate the URL and redirect */
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: '.$url);
	exit;
} else {
	/* Clean up. */
	$zfsession = $twitteroauth = $request_token = NULL; 
	UNSET($zfsession, $twitteroauth, $request_token);
}

?>