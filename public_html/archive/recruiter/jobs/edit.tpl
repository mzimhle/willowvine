<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Edit Job Post - {$jobData.job_title}</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Edit a job Post here - {$jobData.job_title} with job Reference {$jobData.job_reference}">
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
$("#areaMap_path").autocomplete(areas);
});
</script>
<style type="text/css">
	.error {font-size: 11px; color: red; width: 16em; float: left; }	
	.comment {font-size: 11px; color: #CA7316; margin-top: 5px;}
</style>
{/literal}
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
	<a href="#">Edit job post: {$jobData.job_title}</a>
	<span class="dash">|</span> &nbsp; 		
	</p>
</div>
<!-- End Navigation -->
		<div id="content">
			<div class="inleft">
				<p class="ptitle">Edit job post: {$jobData.job_title}</p><br /><br />
			</div><!-- ending of inleft -->
			<div class="clear"></div>
			<div class="adc">
				<img src="/images/adc_top.jpg" alt="" /><div class="clear"></div>
				<div class="adcc">
					<div class="inadc">
<form action="/recruiter/jobs/edit.php?post={$jobReference}&job={$jobHashCode}" method="post" name="jobForm" id="jobForm">
<p class="title brdr_btm">Complete the form to post your ad</p>
<input type="hidden" name="post" id="post" value="{$jobReference}" />
<input type="hidden" name="job" id="job" value="{$jobHashCode}" />

<div style="position:relative;">
<table width="940" border="0" cellspacing="0" cellpadding="0" class="postad">
<tr>
	<td colspan="2"><span><image src="/images/staricon.gif" style="margin: 5px;"/></span> = <span style="font-size: 11px;">{if isset($errorArray.job_page)}<span style="color: red; font-weight: bold;">Required but have errors: Please enter correct information.</span>{else}required fields{/if}</span></td>
</tr>
	<tr>
		<td valign="top" width="470">
			<table>
  <tr>
	<td valign="top" width="140"><label for="jobTitle" {if isset($errorArray.job_title)}style="color: red; font-weight: bold;"{/if}>Job Title</label></td>
	<td valign="top" width="320">
		<input type="text" size="40" value="{$jobData.job_title}" name="job_title" id="job_title" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">The job title / position.</span>
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_poster_name" {if isset($errorArray.job_poster_name)}style="color: red; font-weight: bold;"{/if}>Contact Name</label></td>
	<td valign="top">
		<input type="text" size="40" value="{$jobData.job_poster_name}" name="job_poster_name" id="job_poster_name" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Your name, company name or agency name.</span>
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_poster_email" {if isset($errorArray.job_poster_email)}style="color: red; font-weight: bold;"{/if}>Contact Email</label></td>
		<td valign="top">
		<input type="text" size="40" value="{$jobData.job_poster_email}" name="job_poster_email" id="job_poster_email" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Contact's email</span>
	</td>
  </tr>  
  <tr>
	<td valign="top"><label for="job_poster_number">Contact Number</label></td>
	<td valign="top"><input type="text" size="40" value="{$jobData.job_poster_number}" name="job_poster_number" id="job_poster_number" class="frm" />
		<div class="clear"></div>
		<span class="comment">Optional: Contact's number</span>		
	</td>
  </tr>    
  <tr>
	<td valign="top"><label for="areaMap_path" {if isset($errorArray.areaMap_path)}style="color: red; font-weight: bold;"{/if}>Town, Suburb or City</label></td>
	<td valign="top"><input type="text" name="areaMap_path" id="areaMap_path" value="{$jobData.areaMap_path}" size="60" /> 
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Job City, town or suburb (Select from the provided list)</span>		
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_type">Job Type</label></td>
	<td valign="top">
		<select name="job_type" id="job_type" class="frm">
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
		<div class="clear"></div>
		<span class="comment">What type of employment contract</span>		
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_AdType">Advert By</label></td>
	<td valign="top">
		<select name="job_AdType" id="job_AdType" class="frm">
			<option value="" {if $jobData.job_AdType eq ''}SELECTED{/if}>- Not Specified -</option>
			<option value="company" {if $jobData.job_AdType eq 'company'}SELECTED{/if}>Company</option>
			<option value="agency" {if $jobData.job_AdType eq 'agency'}SELECTED{/if}>Agency</option>
		</select>
	</td>
  </tr>  
  <tr>
	<td valign="top"><label for="fk_section_id" {if isset($errorArray.fk_section_id)}style="color: red; font-weight: bold;"{/if}>Category</label></td>
	<td valign="top">
		<select name="fk_section_id" id="fk_section_id" class="frm">
			<option value="">- Category Type -</option>
			{html_options options=$sectionOptions selected=$jobData.fk_section_id}
		</select>
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span></td>
  </tr>      			
			</table>
			
		</td>
			<td valign="top" width="470">
			<span {if isset($errorArray.job_page)}style="color: red; font-weight: bold;"{/if}>Description: </span><span><image src="/images/staricon.gif" style="margin: 5px;"/></span><br /><br />
			<textarea name="job_page" id="job_page" style="width: 470px; height: 400px;">{$jobData.job_page}</textarea><br /><br />
</td> 
	</tr>
  <tr>
	<td valign="top" colspan="2">
		<table>
			<tr>
				<td>
					<label for="job_address" class="fl">Optional: Address of the job's location, e.g. Street name, suburb, city/town.  (To show on Google Maps for directions)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
					<input type="text" value="{$jobData.job_address}" name="job_address" id="job_address" class="fr required" style="background:url(/images/ininput_long.jpg) no-repeat scroll 0 0 transparent; width:577px;"/>
					<div class="clear"></div>
					<span class="comment fr">Only make selection from the appearing drop-down after typing</span>
					<input type="hidden" name="google_map_reference" id="google_map_reference" value="{$jobData.google_map_reference}" />
				</td>
			</tr>
		</table>
	</td>	
  </tr>	
<tr>
	<td colspan="2" align="right">
			<a href="/jobs/post/"><img src="/images/recruiter/create_another_btn.gif" alt="1 - Create Another Ad" width="206" height="39" /></a>
		<a href="JavaScript:preview();" class="mrg_left5"><img src="/images/save.jpg" alt="2 - Preview" /></a>
	</td>
</tr>
  </table>
</table>
</div>

</form>
					</div><!-- ending of inadc -->
				</div><!-- ending of adcc --><div class="clear"></div>
				<img src="/images/adc_bottom.jpg" alt="" />
			</div><!-- ending of adc -->
		</div><!-- content -->
	</div><!-- main -->
</div><!-- home --><div class="clear"></div>
<div id="footerarea">
	<div id="footer">
{include_php file='includes/footer.php'}
{literal}
<script language="JavaScript" type="text/javascript">
function preview() {
		nicEditors.findEditor('job_page').saveContent();	
		document.forms.jobForm.submit();
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
			maxHeight : '500'
		}).panelInstance('job_page');
});
</script>
{/literal}
	</div><!-- footer -->
</div><!-- footerarea -->
</body>
</html>