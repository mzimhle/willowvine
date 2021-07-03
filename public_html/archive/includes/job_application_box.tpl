<div id="side_box" class="myform">
<form id="jobApplicationForm" name="jobApplicationForm" method="post" action="{$currentLink|default:"/"}" enctype="multipart/form-data" >
<h1>Apply below</h1>
<p>Fill in the below details to apply for this post, please remember to add your CV.</p>
{if isset($jobApplication_success)}
<span style="color: green;">
	<b>Thank you, "{$applicationData.jobApplication_name}" applying for this post, please check your email ("{$applicationData.jobApplication_email}") for confirmation of application.</b>
</span>
{else}
<label>Fullname<span class="small" {if isset($errorMessages.jobApplication_name)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobApplication_name|default:"Your name and surname."}</span></label>
<input type="text" name="jobApplication_name" id="jobApplication_name" value="{if isset($userData.jobSeeker_name)}{$userData.jobSeeker_name} {$userData.jobSeeker_surname}{else}{$application.jobApplication_name}{/if}"/>

<label>Email<span class="small" {if isset($errorMessages.jobApplication_email)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobApplication_email|default:"Add a valid address."}</span></label>
<input type="text" name="jobApplication_email" id="jobApplication_email" value="{if isset($userData.jobSeeker_email)}{$userData.jobSeeker_email}{else}{$application.jobApplication_email}{/if}" />

<label>Message<span class="small" {if isset($errorMessages.jobApplication_comments)}style="color: red;font-weight: bold;"{/if} >{$errorMessages.jobApplication_comments|default:"Add motivation message"}</span></label>
<textarea name="jobApplication_comments" id="jobApplication_comments">{$application.jobApplication_comments}</textarea>

{if !isset($userData.cv) and $userData.cv|@count eq 0}
<label {if isset($errorMessages.applicationCV1)}class="error"{/if}>{$errorMessages.applicationCV1|default:"CV Upload"}
	<span class="small">
		<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
		<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
		<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
	</span>
</label>
{/if}

{if isset($userData.cv) and $userData.cv|@count gt 0}
<label {if isset($errorMessages.userCV)}class="error"{/if}>{$errorMessages.userCV|default:"Select your CV"}
</label>	
	<div class="fl">
	{foreach from=$userData.cv item=item name=cvs}										
			<input type="radio" style="float: none; margin: 5px; width: 16px;" name="userCV" id="userCV" value="{$item.jobSeekerCV_filename}">{$item.jobSeekerCV_userName}
			<a href="/job_seeker/account/download.php?cv={$item.jobSeekerCV_filename}" alt="Download CV to view" class="orange_text" style="text-decoration: none;">(View)</a>
			<br>
	{/foreach}
	</div>
{else}
<input type="file" name="applicationCV1" id="applicationCV1" />
{/if}
<div class="clear"></div>	
<a class="standard_blue_btn fl" title="Apply for this job" href="Javascript:document.forms.jobApplicationForm.submit();">
	<span id="Login">Apply for this job</span>								
</a>
{/if}
<div class="spacer"></div>
</form>
</div>	
<div class="clear"></div>