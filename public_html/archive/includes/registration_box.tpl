<div id="side_box" class="myform">
{if !isset($userData)}
<form id="jobSeekerForm" name="jobSeekerForm" method="post" action="{$currentLink|default:"/"}" enctype="multipart/form-data" >
<a class="standard_blue_btn fr" title="Login into your willowvine account to edit your CV" href="Javascript:showLogin();">
	<span id="Login">LOGIN</span>								
</a>
<h1>Register your CV</h1>
<p>Register your CV so that we can send it to recruiters who are interested or have job/career openings on your behalf.</p>
{if isset($jobSeekerRegister_success)}
<span style="color: green;">
	<b>Thank you, "{$registerData.jobSeeker_name}" for registering your CV, please check your email ("{$registerData.jobSeeker_email}") for confirmation.</b>
</span>
{else}
<label>Name<span class="small" {if isset($errorMessages.jobSeeker_name)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_name|default:"Please tell us your name."}</span></label>
<input type="text" name="jobSeeker_name" id="jobSeeker_name" value="{$registerData.jobSeeker_name}"/>

<label>Email<span class="small" {if isset($errorMessages.jobSeeker_email)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.jobSeeker_email|default:"Add a valid address."}</span></label>
<input type="text" name="jobSeeker_email" id="jobSeeker_email" value="{$registerData.jobSeeker_email}" />

<label>Password<span class="small" {if isset($errorMessages.jobSeeker_password)}style="color: red;font-weight: bold;"{/if}>So you can login.</span></label>
<input type="password" name="jobSeeker_password" id="jobSeeker_password" value="{$registerData.jobSeeker_password}" />

<label>Confirm Password<span class="small" {if isset($errorMessages.jobSeeker_password)}style="color: red;font-weight: bold;"{/if} >Make sure you remember it.</span></label>
<input type="password" name="jobSeeker_password_2" id="jobSeeker_password_2" value="{$registerData.jobSeeker_password_2}" />

<label>Your Area/Town<span class="small" {if isset($errorMessages.areaName)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.areaName|default:"Where you live"}</span></label>
<input type="text" id="areaName" name="areaName" class="ininput" value="{$registerData.areaName}"/>

<label {if isset($errorMessages.jobSeekerCV)}class="error"{/if}>{$errorMessages.jobSeekerCV|default:"CV Upload"}
	<span class="small">
		<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
		<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
		<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
	</span>
</label>
<input type="file" name="jobSeekerCV" id="jobSeekerCV" />
<a class="standard_blue_btn fl" title="Register my CV on willowvine" href="Javascript:document.forms.jobSeekerForm.submit();">
	<span id="Login">Add my CV please</span>								
</a>
{/if}
<div class="spacer"></div>
</form>
{else}
	<h1>{$userData.jobSeeker_name} {$userData.jobSeeker_surname}</h1>
	<p>{$userData.areaMap_shortPath}</p>
	<span>{$userData.jobSeeker_email}</span><br><br>
	<span>{$userData.jobSeeker_description}</span>
{/if}
</div>	
<div class="clear"></div>