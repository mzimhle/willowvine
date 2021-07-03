<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Contact Us</title>
<meta name="description" content="Job Classified Adverts Contact us for Jobs, Careers, holiday or weekend work in your town or city and near you.">
<meta name="description" content="Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include_php file="includes/css.php"}
{include_php file="includes/javascript.php"}
{include_php file="includes/auto_complete.php"}
{literal}
<style type="text/css">
	.error {font-size: 11px; color: red; width: 16em; float: left; }	
	.comment {font-size: 11px; color: #CA7316; margin-top: 5px;}
</style>
{/literal}
</head>
<body OnLoad="document.enquiryForm.enquiry_name.focus();">
<div id="container">
	{include_php file="includes/navigation.php"}
	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Contact Us</span>	
		</p>
	</div>
	<div class="clear"></div>	
	<h1>
		Contact Us	
	</h1>
	<span>Do you have any issues, suggestions or even praises for the willowvine.co.za website? please share them with us, if we can we will do our best to get back to as soon as possible. Please fill in the below fields to send us an email.
</span>
	<br><br>
	<div class="clear"></div>
	<div class="left_content" style="width: 545px;">
		{if isset($enquiryData_success)}
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px; width: 500px;" class="myform" id="side_box">
			Thank you for contacting us, your enquiry was sent successfully and we will look at it as soon as possible. 
		</div>		
		{/if}
		<div id="side_box" class="myform" style="margin: 0; width: 500px;" >
		<form id="enquiryForm" name="enquiryForm" method="post" action="/contact_us/" >
		<p>Required<img src="/images/required_dot.png" style="margin-bottom: 7px;" /></p>
		<label>Full name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.enquiry_name)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.enquiry_name|default:"Your name and surname."}</span></label>
		<input type="text" name="enquiry_name" id="enquiry_name" class="width_280" value="{$enquiryData.enquiry_name}"/>

		<label>Number<span class="small">{$errorMessages.enquiry_number|default:"Contact number please"}</span></label>
		<input type="text" name="enquiry_number" id="enquiry_number" class="width_280" value="{$enquiryData.enquiry_number}" />

		<label>Email Address<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.enquiry_email)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.enquiry_email|default:"Valid email address."}</span></label>
		<input type="text" name="enquiry_email" id="enquiry_email" class="width_280" value="{$enquiryData.enquiry_email}" />

		<label>Message<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.enquiry_comments)}style="color: red;font-weight: bold;"{/if} >{$errorMessages.enquiry_comments|default:"Please tell us give us your message/enquiry"}</span></label>
		<textarea id="enquiry_comments" name="enquiry_comments" cols="80" rows="10" class="width_280">{$enquiryData.enquiry_comments}</textarea>
		<div class="clear"></div>
		<label>Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" {if isset($errorMessages.areaName)}style="color: red;font-weight: bold;"{/if}>{$errorMessages.areaName|default:"Select from the drop down towns/suburbs"}</span></label>
		<input type="text" id="areaName" name="areaName" class="width_280" value="{$enquiryData.areaName}"/>
		<div class="clear"></div>
		<br>
		<a class="standard_blue_btn fl" title="Add job advert" href="javascript:enquiryFormSubmit();">
			<span id="Login">Send Enquiry</span>								
		</a>	
		</form>
		<div class="spacer"></div>		
		</div>				
	</div>			
	<div class="right_content" style="width: 455px;">
		{include_php file="includes/facebook_wall.php"}
	</div>		
	{include_php file="includes/footer.php"}	
	</div>

{literal}
<script language="JavaScript" type="text/javascript">
function enquiryFormSubmit() {
	document.forms.enquiryForm.submit();
}
  
$().ready(function() {
$("#areaName").focus().autocomplete(areas);
});
</script>
{/literal}
</body>
</html>