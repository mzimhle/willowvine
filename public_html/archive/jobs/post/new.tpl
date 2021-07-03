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
<script type="text/javascript" language="javascript" src="/library/javascript/niceforms/iceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/library/javascript/niceforms/niceforms-default.css" />

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
	<br /><br />
	<!----  Form Start ------->
	{if isset($postJob_success)}
	<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px; width: 100%" class="myform" id="side_box">
		"{$postJob_success.job_title}" in "{$postJob_success.job_area}" Ad has been saved, check contact email for confirmation. <br /><br />Please note that the job will be vetted, then afterwards you will receive an email confirmation if its approved or not. Its going to take 24 hours for it to be vetted.
	</div>	
	<br /><br />		
	{/if}	
	<div id="niceform">
<form id="jobPostForm" name="jobPostForm" method="post" action="/jobs/post/" class="niceform">
	<fieldset>
    	<legend>Contact Info</legend>
        <dl>
        	<dt><label for="job_title">Job Title:</label></dt>
            <dd>
				<input type="text" name="job_title" id="job_title" size="32" maxlength="128" value="{$jobData.job_title}"/>
				<br />
				<span class="small" {if isset($errorArray.job_title)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_title|default:"Job or position title."}</span>
			</dd>
        </dl>
        <dl>
        	<dt><label for="job_poster_name">Contact Name:</label></dt>
            <dd>
				<input type="text" name="job_poster_name" id="job_poster_name" size="32" maxlength="128"  value="{$jobData.job_poster_name}"/>
				<br />
				<span class="small" {if isset($errorArray.job_poster_name)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_poster_name|default:"Contact, agency or company name"}</span>
			</dd>			
        </dl>
        <dl>
        	<dt><label for="job_poster_email">Contact Email:</label></dt>
            <dd>
				<input type="text" name="job_poster_email" id="job_poster_email" size="32" maxlength="128" value="{$jobData.job_poster_email}"/>
				<br />
				<span class="small" {if isset($errorArray.job_poster_email)}style="color: red;font-weight: bold;"{/if}>{$errorArray.job_poster_email|default:"Valid email address"}</span>
			</dd>
        </dl>
        <dl>
        	<dt><label for="job_poster_number">Contact Number:</label></dt>
            <dd>
				<input type="text" name="job_poster_number" id="job_poster_number" size="32" maxlength="128" value="{$jobData.job_poster_number}" />
				<br />
				<span class="small" {if isset($errorArray.job_poster_number)}style="color: red;font-weight: bold;"{/if} >{$errorArray.job_poster_number|default:"Contact's number"}</span>
			</dd>
        </dl>
    </fieldset>
    <fieldset>
    	<legend>Job Details</legend>
        <dl>
        	<dt><label for="areaName">Job Area/Town:</label></dt>
            <dd>
				<input type="text" name="areaName" id="areaName" size="32" maxlength="128" value="{$jobData.areaName}"/>
				<br />
				<span class="small" {if isset($errorArray.areaName)}style="color: red;font-weight: bold;"{/if}>{$errorArray.areaName|default:"Where the job is"}</span>
			</dd>
        </dl>
        <dl>
        	<dt><label for="fk_section_id">Category:</label></dt>
            <dd>
				<select name="fk_section_id" id="fk_section_id">
					<option value="">- Category Type -</option>
					{html_options options=$sectionOptions selected=$jobData.fk_section_id}
				</select>
				<br />
				<span class="small" {if isset($errorArray.fk_section_id)}style="color: red;font-weight: bold;"{/if} >Whow posted the this job</span>
            </dd>
        </dl>
        <dl>
        	<dt><label for="job_type">Job Type:</label></dt>
            <dd>
				<select name="job_type" id="job_type">
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
            </dd>
        </dl>
        <dl>
        	<dt><label for="job_AdType">Advert By:</label></dt>
            <dd>
				<select name="job_AdType" id="job_AdType">
					<option value="" {if $jobData.job_AdType eq ''}SELECTED{/if}>- Not Specified -</option>
					<option value="company" {if $jobData.job_AdType eq 'company'}SELECTED{/if}>Company</option>
					<option value="agency" {if $jobData.job_AdType eq 'agency'}SELECTED{/if}>Agency</option>
				</select>
            </dd>
        </dl>
    </fieldset>
    <fieldset>
    	<legend>Job Page</legend>
        <dl>
        	<dt><label for="areaName">Show on a map:</label></dt>
            <dd>
				<input type="text" name="job_address" id="job_address" size="60" maxlength="128" value="{$jobData.job_address}"/>
				<input type="hidden" name="google_map_reference" id="google_map_reference" value="{$jobData.google_map_reference}" />
			</dd>
        </dl>        
		<dl>
        	<dt><label for="job_page">Description:</label></dt>
            <dd>
				<textarea name="job_page" id="job_page" rows="30" cols="80">{$jobData.job_page}</textarea>
				<br />
				<span class="small"{if isset($errorArray.job_page)}style="color: red;font-weight: bold; text-align: left;"{/if}>{$errorArray.job_page|default:"Job's description"}</span>				
			</dd>
        </dl>
    </fieldset>
    <fieldset class="action">
		<a class="standard_blue_btn fl" title="Add job advert" href="javascript:savePost();">
			<span id="Login">Post/Add Job</span>								
		</a>
    </fieldset>
</form>	
</div>
	<!----  Form End ------->
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