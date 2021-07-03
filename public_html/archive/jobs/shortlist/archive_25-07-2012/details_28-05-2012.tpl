<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortlisted: Ref. {$jobData.job_reference}, {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}</title>
<meta name="description" content="Shortlisted Advert - {$jobData.job_title}, {$jobData.section_name}, jobs in {$jobData.job_area}, reference: {$jobData.job_reference}">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, {$jobData.job_title}, {$jobData.section_name},  {$jobData.job_area}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
{literal}
<script type="text/javascript" language="javascript">
	function jobApplicationSubmit() {
			document.forms.applicationForm.submit();
	}	 
</script>
{/literal}
</head>
<body OnLoad="document.applicationForm.jobApplication_name.focus();">
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
	<a href="/jobs/shortlist/?searchJob={$searchJob}&searchArea={$searchArea}&page={$page}">Jobs</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 
	<a href="/jobs/shortlist/?sectionId={$jobData.pk_section_id}">{$jobData.section_name}</a>
	<span class="dash">|</span> &nbsp; 
	<span class="orange_text">{$jobData.job_title}</span></p>
	</p>
</div>
<!-- End Navigation -->
	<div id="content">
		<div class="inleft">
			<p class="ptitle">{$jobData.job_title}</p>
			<p><span class="orange_text">{$jobData.section_name}</span></p>
			<p><span>{$jobData.job_area}</span></p>
		</div>
		<div class="complex_back"><a href="/jobs/shortlist/">Back to Shortlist</a></div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		{if $jobData.jobs_affiliate neq '' && $jobData.job_poster_email eq ''}<div class="complex_back" style="margin-right: 20px"><a href="{$jobData.job_affiliateLink}" target="_blank">Apply</a></div>{/if}	
		<div class="clear"></div>
			<div class="complex_left" style="background: none; width: 475px; min-height: 500px;">
				<div class="complex_left_bottom" style="background: none; padding: 0px;">
					<div class="complex_inner" style="width: auto;">
						<!-- buttons -->
							<div class="applynow" style="width: 144px; float: left;">
								<a href='Javascript: showShare("{$jobData.job_title} in {$jobData.job_area}", {$jobData.job_reference});' alt="Willowvine share with a friend" class="yellow_btn">
									<span>Share</span>
								</a>	
								<div style="margin-top: 3px;">
									<a name="fb_share" alt="Facebook share with a facebook friend"type="button" share_url="http://www.willowvine.co.za/jobs/shortlist/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/"></a>
									<a href="https://twitter.com/share?url=http://www.willowvine.co.za/jobs/shortlist/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/" class="twitter_btn" target="_blank">
										<img src="/images/twitter.ico" width="16" height="16" />
									</a>
								</div>							
							</div>	
						 <span style="float: right;">
								<a href="Javascript:shortListRemove({$jobData.job_reference});" class="yellow_btn">
									<span id="share">Remove from shortlist</span>								
								</a>							
							</span>
						<div class="clear"></div>
						<!-- End buttons. -->
						<div class="apply_description">
							{$jobData.job_page|trim}
							<br />							
							{if $jobData.job_address neq ''}<a href="/jobs/shortlist/{$jobData.section_urlName}/directions/{$jobData.job_link}/{$jobData.job_reference}/?searchArea={$searchArea}&searchJob={$searchJob}&sectionId={$sectionId}&page={$page}" class="orange_text">Do you know how to gert to: {$jobData.job_address} ? Click here for directions.</a>{/if}
							<div class="complex_listdetail">
							<ul>
								<li><span>Added:</span> {$smarty.now|date_format:"%d %b %Y"}</li>
								<li><span>Area:</span> {$jobData.job_area}</li>
								<li>{if $jobData.job_AdType neq ''}<span>Advert by:</span> {$jobData.job_AdType}{else}<span>Advert by:</span> {$jobData.job_advertBy}{/if}</li>
								<li><span>Posted By: </span>{$jobData.job_poster_name}</li>
								{if $jobData.job_type neq ''}<li><span>Job Type: </span>{$jobData.job_type}</li>{/if}
							</ul>
							</div>
						</div>
				</div><br /><br />				
				</div>
			</div>
			{if $jobData.job_poster_email neq ''} 	
			<form action="/jobs/shortlist/{$jobData.section_urlName}/details/{$jobData.job_link}/{$jobData.job_reference}/?searchArea={$searchArea}&searchJob={$searchJob}&sectionId={$sectionId}&page={$page}" method="post" enctype="multipart/form-data" name="applicationForm" id="applicationForm">								
			<div class="complex_form">
				<div class="complex_form_top"></div>										
				<div class="complex_form_cent">
					<div class="complexform_title">{if isset($success)}<span style="color: green;">APPLICATION SENT.</span>{else}Please enter your application details{/if}</div>
					<div class="complex_form_label"><label for="jobApplication_name" {if isset($errorMessages.jobApplication_name)}style="color: red; font-weight: bold;"{/if}>{$errorMessages.jobApplication_name|default:'Name:'} </label></div>
					<div class="complex_form_field">
					<input type="text" class="text_input_ie_fix"  value="{$application.jobApplication_name|trim}" name="jobApplication_name" id="jobApplication_name" /></div>
					<div class="complex_formclear"></div>
					<div class="complex_form_label"><label for="jobApplication_email" {if isset($errorMessages.jobApplication_email)}style="color: red; font-weight: bold;"{/if}>{$errorMessages.jobApplication_email|default:'Email:'} </label></div>
					<div class="complex_form_field"><input type="text" class="text_input_ie_fix" value="{$application.jobApplication_email|trim}" name="jobApplication_email" id="jobApplication_email" /></div>
					<div class="complex_formclear"></div>
					<div class="complex_form_label"><label for="jobApplication_comments" {if isset($errorMessages.jobApplication_comments)}style="color: red; font-weight: bold;"{/if}>{$errorMessages.jobApplication_comments|default:'Comments:'} </label></div>
					<div class="complex_form_comments"><textarea cols="45" rows="3" class="complex_formstyle_comments" name="jobApplication_comments" id="jobApplication_comments">{$application.jobApplication_comments|trim}</textarea></div>
					<div class="complex_formclear"></div>		
					{if !isset($userData)}
					<div class="complex_form_label"><label for="applicationCV1" {if isset($errorMessages.applicationCV1)}style="color: red; font-weight: bold;"{/if}>{$errorMessages.applicationCV1|default:'CV:'} </label></div>
						<div class="complex_browse">
							<div id="divinputfile">
								<input name="applicationCV1" id="applicationCV1" size="20" onchange="this.form.fakefilepc.value = this.value;" type="file" />
								<div id="fakeinputfile"><input name="fakefilepc" id="fakefilepc" type="text" /></div>
							</div>
						</div>
					{else}
					<div class="complex_formclear"></div>
					<div class="complex_form_label"><label for="userCV" {if isset($errorMessages.userCV)}style="color: red; font-weight: bold;"{/if}>{$errorMessages.userCV|default:'Choose CV to send:'} </label></div>
					<div class="complex_form_comments" style="background: none;">
					  {foreach from=$userData.cv item=item name=cvs}										
								<input type="radio" name="userCV" value="{$item.jobSeekerCV_filename}">{$item.jobSeekerCV_userName}
								<a href="/job_seeker/account/download.php?cv={$item.jobSeekerCV_filename}" alt="Download CV to view" class="orange_text" style="text-decoration: none;">(View)</a>
								<br>
						{/foreach}					
					</div>
					{/if}
<!-- ending of complex_form_cent -->					
				</div><!-- ending of complex_form -->
			<div class="complex_formclear"></div>
			<div class="complex_form_cent">
				<input name="apply" type="button" class="applynowcomplex" id="apply" value="" onclick="jobApplicationSubmit();" />				
			</div><!-- ending of complex_form_cent -->			
			<div class="complex_form_bottom"></div>
			</div>			
		</form>
		{/if}
		<div style="display: inline; float: right; margin: 38px 0 0;width: 482px;">		
			<div class="description_links" style="margin-bottom: 20px;">
				<ul>
					<li><a href="/jobs/shortlist/?sectionId={$jobData.pk_section_id}">View {$jobData.section_name} jobs</a></li>
					<li><a href="/jobs/shortlist/?searchJob={$jobData.job_title}">View "{$jobData.job_title}" jobs</a></li>
					<li><a href="/jobs/shortlist/?searchArea={$jobData.job_area}">View Jobs in "{$jobData.job_area}"</a></li>
				</ul>
			</div>
		<div style="display: inline; float: right; margin: 38px 0 0;width: 482px;">
		{literal}
		<div style="float: left;">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-3167387384914043";
				/* jobDetails_1 */
				google_ad_slot = "8201534450";
				google_ad_width = 200;
				google_ad_height = 200;
				//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>		
		</div>
		<div style="float: right;">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-3167387384914043";
				/* jobDetails_2 */
				google_ad_slot = "7528167871";
				google_ad_width = 200;
				google_ad_height = 200;
				//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>		
		</div>
		{/literal}
		</div>						
		</div>
		<div class="clear"></div>
		</div><!-- ending of content -->
	</div><!--ending of main-->
</div><!--ending of home-->
{include_php file="includes/footer.php"}
</body>
</html>