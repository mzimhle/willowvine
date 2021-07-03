<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Willowvine | Job Seeker Account | {$userData.jobSeeker_name} {$userData.jobSeeker_surname}</title>
<meta name="description" content="Register for jobs, search find, Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{include_php file="includes/auto_complete.php"}
</head>
<body>
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Account</span>	
			<span>|</span> &nbsp; 
			<span>Job Seeker</span>				
			<span>|</span> &nbsp; 
			<span class="green_text">{$userData.jobSeeker_name} {$userData.jobSeeker_surname}</span>							
		</p>
	</div>
	<div class="clear"></div>	
	<h1>
		{$userData.jobSeeker_name} {$userData.jobSeeker_surname}
	</h1>
	<span class="blue_text">{$userData.areaMap_path}</span>
	<br><br>
	<div class="clear"></div>
	<div class="left_content" style="width: 545px;">
		{if isset($updateSuccess)}
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px; width: 500px;" class="myform" id="side_box">
			Your details have been updated successfully.
		</div>		
		{/if}
		<div id="side_box" class="myform" style="margin: 0; width: 500px;" >
		<form id="jobSeekerForm" name="jobSeekerForm" method="post" action="/job_seeker/account/" >
		<h1>Personal Details</h1>
		<p>Update your personal and contact details below</p>
		<label>Name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.jobSeeker_name)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_name|default:"First name"}</span></label>
		<input type="text" name="jobSeeker_name" id="jobSeeker_name" class="width_280" value="{$userData.jobSeeker_name}"/>

		<label>Surname<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.jobSeeker_surname)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_surname|default:"Contact number please"}</span></label>
		<input type="text" name="jobSeeker_surname" id="jobSeeker_surname" class="width_280" value="{$userData.jobSeeker_surname}" />
		
		<label>Email<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.jobSeeker_email)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_email|default:"Valid email address."}</span></label>
		<input type="text" name="jobSeeker_email" id="jobSeeker_email" class="width_280" value="{$userData.jobSeeker_email}" />
		{if $userData.fb_user_id eq '' and $userData.twitter_uid eq ''}
		<label>Password<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.jobSeeker_password)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_password|default:"Your password please."}</span></label>
		<input type="text" name="jobSeeker_password" id="jobSeeker_password" class="width_280" value="{$userData.jobSeeker_password}" />
		{/if}
		<label>Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.areaMap_path)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.areaMap_path|default:"Where do you live"}</span></label>
		<input type="text" id="areaMap_path" name="areaMap_path" class="width_280" value="{$userData.areaMap_path}"/>
		
		<label>Describe yourself<span class="small" >Market yourself to recruiters</span></label>
		<textarea id="jobSeeker_description" name="jobSeeker_description" cols="80" rows="10" class="width_280">{$userData.jobSeeker_description}</textarea>
		<div class="clear"></div>
		<label>Job Alerts<span class="small">{$errorMessages.areaMap_path|default:"Where do you live"}</span></label>
		<select name="jobSeeker_alerts" id="jobSeeker_alerts" class="small" style="width: 50px;">
			<option value="1" {if $userData.jobSeeker_alerts eq 1}SELECTED{/if}>Yes</option>
			<option value="0" {if $userData.jobSeeker_alerts eq 0}SELECTED{/if}>No</option>
		</select>
		<div class="clear"></div>
		<a class="standard_blue_btn fr" title="Add job advert" href="javascript:document.forms.jobSeekerForm.submit()">
			<span id="Login">Update My Details</span>								
		</a>	
		</form>
		<div class="spacer"></div>		
		</div>				
	</div>			
	<div class="right_content" style="width: 455px;">		
		<div id="side_box" class="myform" style="margin: 0; width: 422px;" >
			<h1>My CV's</h1>
			<p>Add or delete your CV's below</p>
			<table width="422px" border="0" cellspacing="0" cellpadding="0">
			  {foreach from=$userData.cv item=item name=cvs}
				<tr>			  
					<td width="auto" style="border-bottom: 1px solid #E9E6E0;">	
						<br>
						{$smarty.foreach.cvs.iteration}. {$item.jobSeekerCV_userName}&nbsp;&nbsp;&nbsp;
						<br>
						<a href="/job_seeker/account/download.php?cv={$item.jobSeekerCV_filename}">(download)</a>&nbsp;&nbsp;&nbsp;<a href="/job_seeker/account/delete.php?cv={$item.jobSeekerCV_filename}">(delete)</a>																			
						<br>	
						<input type="hidden" name="cvName" id="cvName" value="{$item.jobSeekerCV_filename}" />
						<input type="hidden" name="cvId" id="cvId" value="{$item.pk_jobSeekerCV_id}" />	
						<div class="clear"></div>
						<br>
					</td>
				 </tr>
				{foreachelse}
				<tr>
					<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;">	
						You have not uploaded a any CV.
					</td>
				</tr>
				{/foreach}									
			</table>
			<br>
			<p>Upload another CV, remember maximun is 3 CV's and each should be less than 1Mb</p>
			<form action="/job_seeker/account/" method="post" name="upload" id="upload" enctype="multipart/form-data">
			<label>Upload CV
				<span class="small">
					<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
					<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
					<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
				</span>
			</label>
			<input type="file" name="jobSeekerCV" id="jobSeekerCV" />	
			<br>
			<span class="fr error">{$uploadErrorMessages.jobSeekerCV}</span>
			<a class="standard_blue_btn fl" title="Update CV sections" href="JavaScript:document.forms.upload.submit();">
				<span id="UpdateCV">Upload CV</span>								
			</a>	
			</form>
			<div class="spacer"></div>
		</div>
			<div class="clear"></div>
			{include_php file="includes/side_ad_container.php"}		
	</div>		
	{include_php file="includes/footer.php"}	
</div>

{literal}
<script language="JavaScript" type="text/javascript">
function enquiryFormSubmit() {
	document.forms.enquiryForm.submit();
}
  
$().ready(function() {
$("#areaMap_path").focus().autocomplete(areas);
});
</script>
{/literal}
</body>
</html>