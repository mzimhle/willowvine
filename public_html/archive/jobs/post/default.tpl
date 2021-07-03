<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Post a an advert | Add a Job Advert for free</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Add a new job and a CV will be sent to you should an applicant apply.">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, post a free job advert.">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{include_php file="includes/auto_complete.php"}
<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
{literal}
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
});
</script>
{/literal}
</head>
<body OnLoad="document.jobPostForm.job_title.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Post a free Job Ad</span>	
		</p>
	</div>
	<div class="clear"></div>	
	<h1>
		Post a free Job Ad	
	</h1>
	<span>Post a job advert for FREE, applicants will send you a message and an attachment of their cv when the apply.</span>
	<br><br>
	<div class="clear"></div>
	<div class="left_content width_470">
		{if isset($postJob_success)}
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px" class="myform width_430" id="side_box">
			"{$postJob_success.job_title}" in "{$postJob_success.job_area}" Ad has been saved, check contact email for confirmation. Please note that the job will be vetted, then afterwards you will receive an email confirmation if its approved or not. Its going to take 24 hours for it to be vetted.
		</div>		
		{/if}
		<div id="side_box" class="myform width_430" style="margin: 0;" >
		<form id="jobPostForm" name="jobPostForm" method="post" action="/jobs/post/" >
		<p>Required<img src="/images/required_dot.png" style="margin-bottom: 7px;" /></p>
		<label>Job Title<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorArray.job_title)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_title|default:"Job or position title."}</span></label>
		<input type="text" name="job_title" id="job_title" class="width_225" value="{$jobData.job_title}"/>

		<label>Contact Name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorArray.job_poster_name)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_poster_name|default:"Contact, agency or company name"}</span></label>
		<input type="text" name="job_poster_name" id="job_poster_name" class="width_225" value="{$jobData.job_poster_name}" />

		<label>Contact Email<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorArray.job_poster_email)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_poster_email|default:"Valid email address."}</span></label>
		<input type="text" name="job_poster_email" id="job_poster_email" class="width_225" value="{$jobData.job_poster_email}" />

		<label>Contact Number<span class="small" {if isset($errorArray.job_poster_number)}style="color: red;font-weight: bold;"{/if} >{$errorArray.job_poster_number|default:"Contact's number"}</span></label>
		<input type="text" name="job_poster_number" id="job_poster_number" class="width_225" value="{$jobData.job_poster_number}" />

		<label>Job Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorArray.areaName)}style="color: red;font-weight: bold;"{/if}>{$errorArray.areaName|default:"Where the job is"}</span></label>
		<input type="text" id="areaName" name="areaName" class="width_225" value="{$jobData.areaName}"/>

		<label>Category<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorArray.fk_section_id)}style="color: red;font-weight: bold;"{/if} >Whow posted the this job</span></label>
		<select name="fk_section_id" id="fk_section_id" class="small">
			<option value="">- Category Type -</option>
			{html_options options=$sectionOptions selected=$jobData.fk_section_id}
		</select>
		
		<label>Job Type<span class="small">What type of employment contract</span></label>
		<select name="job_type" id="job_type" class="small">
			<option value="" {if $jobData.job_type eq ''}SELECTED{/if}>- Not Specified -</option>
			<option value="casual" {if $jobData.job_type eq 'casual'}SELECTED{/if}>Casual</option>
			<option value="temp" {if $jobData.job_type eq 'temp'}SELECTED{/if}>Temporary</option>
			<option value="contract" {if $jobData.job_type eq 'contract'}SELECTED{/if}>Contract</option>
			<option value="parttime" {if $jobData.job_type eq 'parttime'}SELECTED{/if}>Part-Time</option>
			<option value="permanent" {if $jobData.job_type eq 'permanent'}SELECTED{/if}>Permanent</option>
			<option value="graduate" {if $jobData.job_type eq 'graduate'}SELECTED{/if}>Graduate</option>
			<option value="internship" {if $jobData.job_type eq 'internship'}SELECTED{/if}>Internship</option>
			<option value="volunteer" {if $jobData.job_type eq 'volunteer'}SELECTED{/if}>Volunteer</option>
		</select>
		
		<label>Advert By<span class="small">Whow posted the this job</span></label>
		<select name="job_AdType" id="job_AdType" class="small">
			<option value="" {if $jobData.job_AdType eq ''}SELECTED{/if}>- Not Specified -</option>
			<option value="company" {if $jobData.job_AdType eq 'company'}SELECTED{/if}>Company</option>
			<option value="agency" {if $jobData.job_AdType eq 'agency'}SELECTED{/if}>Agency</option>
		</select>
		
		<a class="standard_blue_btn fl" title="Add job advert" href="javascript:savePost();">
			<span id="Login">Post/Add Job</span>								
		</a>	
		<div class="spacer"></div>		
		</div>	
		<br>
		{include_php file="includes/right_ad_container.php"}			
	</div>			
	<div class="right_content width_550" style="float: left;">
		<div id="side_box" class="myform width_520" style="margin: 0;" >					
		<label style="text-align: left; width: 430px;">Show on Map<span class="small" style="text-align: left; width: 430px;">Show job's town, area or address on google maps for directions, only select from the given list</span></label>
		<div class="clear"></div>	
		<br>		
		<input type="text" style="width: 480px; margin: auto;" id="job_address" name="job_address" class="width_430" value="{$jobData.job_address}"/>
		<input type="hidden" name="google_map_reference" id="google_map_reference" value="{$jobData.google_map_reference}" />
		<div class="clear"></div>
		<br>		
		<label style="text-align: left;">Description<img src="/images/required_dot.png" style="margin-bottom: 7px;" />
			<span class="small"  style="text-align: left; width: 430px;" {if isset($errorArray.job_page)}style="color: red;font-weight: bold; text-align: left;"{/if}>{$errorArray.job_page|default:"Job's details"}</span></label>
		<div class="clear"></div>
		<br>
		<textarea id="job_page" name="job_page" style="width: 500px; height: 490px;">{$jobData.job_page}</textarea> 
		<div class="clear"></div>
		</form>
		</div>			
	</div>
	{include_php file="includes/footer.php"}
</div>
{literal}
<script language="JavaScript" type="text/javascript">
function savePost() {
		nicEditors.findEditor('job_page').saveContent();	
		document.forms.jobPostForm.submit();
}

jQuery(document).ready(function() {
	function initialize() {

		var input = document.getElementById('job_address');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.setTypes([]);
		
		/* Get reference of the selected area. */
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			$('#google_map_reference').val(place.reference);
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	
	
    var input = document.getElementById('job_address');
    var autocomplete = new google.maps.places.Autocomplete(input);
	jQuery(function() {
		jQuery('.popUp').hover(
			function () {
				jQuery(this).find('span.pop').css('top',(jQuery(this).position().top - 80));
				jQuery(this).find('span.pop').css('left',(jQuery(this).position().left - 45));
				jQuery(this).find('span.pop').show();
			},
			function () {
				jQuery(this).find('span.pop').hide();
			}
		);
	});
	
		new nicEditor({
			iconsPath : '/library/javascript/nicedit/nicEditorIcons.gif',
			buttonList : ['bold','italic','underline','ol','indent','outdent','center', 'right','left','link','unlink','fontFormat'],
			maxHeight : '500',
		}).panelInstance('job_page');
});
</script>
{/literal}
</body>
</html>