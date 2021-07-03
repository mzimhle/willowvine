<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Willowvine | Job Seeker Registration | Completed</title>
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body>
<div id="home">
	<div id="main">
		<!-- Start Header -->
		{include_php file="includes/header.php"}
		<!-- End Header -->
		<!-- Start Navigation -->
		{include_php file="includes/navigation.php"}
		<!-- End Navigation -->
		<!-- Start Navigation -->
		<div id="contnav">
			<p>
			<a href="/">Home</a> &nbsp; 
			<span class="dash">|</span> &nbsp; 
			<a href="/job_seeker/">Jobs Seekers</a> &nbsp; 	
			<span class="dash">|</span> &nbsp; 
			<a href="/job_seeker/register/">Registration</a> &nbsp; 
			<span class="dash">|</span> &nbsp; 
			<a href="#">Completed by {$data.jobSeeker_name|lower} {$data.jobSeeker_surname|lower}</a> &nbsp; 
			</p>
		</div>
		<!-- End Navigation -->
		<div id="content">
			<div id="leftcontent_about">
				<h1>Thank you for registering {$data.jobSeeker_name}.</h1>
				<p>Please check your email address:  "<strong>{$data.jobSeeker_email}</strong>", we will send you confirmation code so as for you to complete registration and for us to confirm your email address, only then will you be able to log in and proceed.</p>
				<br />
				<span>You will now see this job in your Applied for Jobs list in your account.</span></p>
				<div class="virecv">
					<div class="thanks_heading">Last step you should be taking.</div>
					<div class="thanks_white">
						<div class="thanks_number"><a href="/jobs/search/"><img src="/images/employer_bullet_1.jpg" border="0" alt="1" title="1" width="24" height="23" /></a></div>
						<div class="viewcv_text thanks_txt">
							<div class="viewcv_text_heading">Confirm your email address.</div>
							Please go to your email account and click on a link you would have already recevieved to confirm your email address is genuine.
						</div>						
						<div class="clear"></div>
					</div>
					<div class="thanks_holderwrap">
						<div class="thanks_holdertop"></div>
						<div class="thanks_number"><a href="/job_seeker/account/"><img src="/images/thanks_2.jpg" border="0" alt="2" title="2" width="22" height="22" /></a></div>
						<div class="viewcv_text">
							<div class="viewcv_text_heading">Go to your account section</div>
							We noticed you are aleady a member, and have logged you in to streamline any other applications you may want to make
						</div>
						
						<div class="clear"></div>
						<div class="thanks_holderbottom"></div>
					</div>
					<div class="thanks_white">
						<div class="thanks_number"><a href="/job_seeker/account/"><img src="/images/employer_bullet_3.jpg" border="0" alt="3" title="3" width="24" height="23" /></a></div>
						<div class="viewcv_text thanks_txt">
							<div class="viewcv_text_heading">Manage your profile</div>
							We noticed you are aleady a member, and have logged you in to streamline any other applications you may want to make
						</div>
						
						<div class="clear"></div>
					</div>
				</div>
			</div><!-- ending of leftcontent -->
			<div id="rightcontent">
				<!-- Start login -->
				{include_php file="includes/login.php"}
				<!-- End login -->
				<!-- Start top jobs -->
				{include_php file="includes/top_jobs.php"}
				<!-- End top jobs -->	
				</div><!-- ending of rightbcon -->
			</div><!-- ending of rightcontent -->
		</div><!-- ending of content -->
	</div><!--ending of main-->
</div><!--ending of home--><div class="clear"></div>
<!-- Start footer -->
{include_php file="includes/footer.php"}
<!-- End footer -->
</body>
</html>
