<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Tenders, Trade Leads, Business Listings and Jobs</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, jobs">
<meta name="description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, jobs and more prospects to grow your business...">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, jobs and more prospects to grow your business.">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
{include_php file='includes/css.php'}
</head>
<body>
{include_php file='includes/header.php'}
{include_php file='includes/menu.php'}
<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-12">
        	<!-- /// short list box /// -->
			<div class="tenderbox eachbox rightdarkborder">				
				<div class="titles">
					<h1>Email Verification Successful and Registration Completed</h1>
				</div>
				<div class="infolist cf">
					<p class="bluehighlight">Thank you for registering with us {$mailinglistData.mailinglist_name} {$mailinglistData.mailinglist_surname}.</p>
					<p>Your log in details are as follows:</p>
					<span>Username: <b>{$participantData.participantlogin_username}</b></span><br />	
					<span>Password: <b>{$participantData.participantlogin_password}</b></span>			
					<p>Your registration and verification of the email address <b class="redhighlight">{$mailinglistData.mailinglist_email}</b> has been successful. You can now log in.</p>
					<p>We have also sent you log in details via your verified email address so you can keep them safe. You can simply change your log in details by going to your account.</p>
				</div>				
			</div>						
        </div>		
    </div>
</section>
{include_php file='includes/footer.php'}
</body>
</html>