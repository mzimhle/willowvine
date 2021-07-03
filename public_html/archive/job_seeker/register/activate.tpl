<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Home | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Register our CV with us and let the recruiters and employers come to you." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span class="dash">|</span> &nbsp; 
			<span class="orange_text">Job Seeker</span>
			<span class="dash">|</span> &nbsp; 
			<span class="orange_text">Account Activation</span>			
		</p>
	</div>
	{include_php file="includes/search_jobs.php"}
	{if $jobShareCount gt 0}	
	<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
		<span id="Login">View my Shortlist ({$jobShareCount})</span>								
	</a>		
	{/if}
	<h1>
		Account Activation
	</h1>

	<div class="left_content">
	<span class="descr_text">
		Congradulations, your account has been activated by confirming your email, please press login on the top-right of the page or use our social network logins to login and add or update your CVs.
	</span>
	<!-- Pagination -->
	<div class="clear"></div>		
	<!-- End Pagination -->
	</div>
	<div class="right_content">
		{include_php file="includes/social_plugin_login.php"}
	</div>
	{include_php file="includes/footer.php"}
</div>

</body>
</html>