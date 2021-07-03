<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>WillowVine | Job Seeker - Password Recovery | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			<a href="/job_seeker/register/">Password Recovery</a> &nbsp; 
			</p>
		</div>
		<!-- End Navigation -->
		<div id="content">
			<div id="leftcontent_about">
				<h1>{if isset($jobSeekerData)}Password Sent{else}Email Not Found{/if}</h1>
				<p><b>{if isset($jobSeekerData)}We have sent you your password to the address: "{$jobSeekerData.jobSeeker_email}", please open and start logging in correctly.{else}
				Your email was not found, please try a different type of email or register with us by <a href="/job_seeker/register/">clicking here</a>{/if}</b></p>
				<br />
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
