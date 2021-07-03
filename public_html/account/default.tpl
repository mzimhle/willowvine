<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" contzlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta props and Jobs</title>
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
    	<div class="col-xs-12 col-md-9 db-gutter-right">
			<div class="tenderbox eachbox">
				<div class="titles htitle">
                    <div class="mainsearch minisearch">
				        <span class="fa fa-ellipsis-v"></span><a href="/account/edit/">Edit My Profile</a>
					</div>
                    <h1>Your Personal Profile</h1>
                </div>
                <p>
                    <em class="subhead">Current Login Type</em><br />
                    {$participantloginData.participantlogin_type}
                </p>				
                <p>
                    <em class="subhead">Fullname</em><br />
                    {$participantloginData.participant_name} {$participantloginData.participant_surname}
                </p>
                <p>
                    <em class="subhead">Gender</em><br />
                    {$participantloginData.participant_gender|default:"Not entered yet"}
                </p>	
                <p>
                    <em class="subhead">Date of Birth</em><br />
                    {$participantloginData.participant_birthdate|date_format:"%A, %B %e, %Y"|default:"Not entered yet"}
                </p>				
                <p>
                    <em class="subhead">Area</em><br />
                    {$participantloginData.areapost_name|default:"Not entered yet"}
                </p>
                <p>
                    <em class="subhead">Email</em><br />
                    {$participantloginData.participantlogin_username}
                </p>
                <p>
                    <em class="subhead">Profile Picture</em><br><br />
                    <img src="/download/profileimage/{$participantloginData.participant_code}/thumb" />
                </p><br />
            </div>
        </div>
		
        <div class="col-xs-12 col-md-3 no-gutter-left">
			<div class="newsbox eachbox no-gutter-left" id="go1">
				{include_php file='includes/register.php'}
			</div>
        </div>	
    </div>
</section>
{include_php file='includes/footer.php'}
</body>
</html>