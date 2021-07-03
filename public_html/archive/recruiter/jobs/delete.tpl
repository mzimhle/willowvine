<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Delete Job Post - {$jobData.job_title}</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Delete a job Post here - {$jobData.job_title} with job Reference {$jobData.job_reference}">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, post a free job advert.">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
</head>
<body OnLoad="document.jobForm.job_title.focus();">
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
	<a href="/recruiter/">Recruiters</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 
	<a href="/jobs/post/">Post a free job</a>
	<span class="dash">|</span> &nbsp; 	
	<a href="#">Delete job post: {$jobData.job_title}</a>
	<span class="dash">|</span> &nbsp; 		
	</p>
</div>
<!-- End Navigation -->
		<div id="content">
			<p class="ptitle">Are you sure you want to delete this post, <br />{$jobData.job_title} ?</p>
			<p><span class="orange_text">{$jobData.section_name}</span></p>
			<p><span>{$jobData.job_area}</span></p>		<br /><br />	
			<div class="clear"></div>	
			{if !isset($success)}
			<div class="complex_back" style="float: left;"><a href="/recruiter/jobs/delete.php?post={$jobData.job_reference}&job={$jobData.job_hashcode}&delete=yes">Yes, Delete this post</a></div>			
			{else}
			<span style="color: red; font-size: 20px; font-weight: bold;">This job post has been deleted.</span>
			{/if}
		</div><!-- content -->
	</div><!-- main -->
</div><!-- home --><div class="clear"></div>
<div id="footerarea">
	<div id="footer">
{include_php file='includes/footer.php'}
	</div><!-- footer -->
</div><!-- footerarea -->
</body>
</html>