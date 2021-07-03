<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communication</title>
{include_php file='includes/css.php'}
{include_php file='includes/javascript.php'}
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content recruiter -->
  <div id="content">
    {include_php file='includes/header.php'}
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
			<li><a href="/communication/" title="Communication">Communication</a></li>
			<li><a href="/communication/messages/" title="Messaages">Messaages</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Details</h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="{if isset($messageData)}/communication/messages/comms.php?code={$messageData._message_code}{else}#{/if}" title="Comms">Comms</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/communication/messages/details.php{if isset($messageData)}?code={$messageData._message_code}{/if}" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
			<td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="_message_name" id="_message_name" value="{$messageData._message_name}" size="60" />
				{if isset($errorArray._message_name)}<br /><span class="error">{$errorArray._message_name}</span>{else}<br /><em>Name of this message</em>{/if}
			</td>				
          </tr>
		  <tr>
			<td>
				<h4 class="error">Type:</h4><br />
				{if !isset($messageData)}
				<select name="_message_type" id="_message_type">
					<option value=""> ----- </option>
					<option value="EMAIL"> EMAIL </option>
					<option value="SMS"> SMS </option>
				</select>
				{if isset($errorArray._message_type)}<br /><span class="error">{$errorArray._message_type}</span>{else}<br /><em>type of this message</em>{/if}
				{else}
					<p class="success">{$messageData._message_type} message type</p>
					<input type="hidden" name="_message_type" id="_message_type" value="{$messageData._message_type}"/>
				{/if}
			</td>		  
		  </tr>
		  {if isset($messageData)}
			{if $messageData._message_type eq 'EMAIL'}
          <tr>
			<td>
				<h4 class="error">Subject:</h4><br />
				<input type="text" name="_message_subject" id="_message_subject" value="{$messageData._message_subject}" size="60" />
				{if isset($errorArray._message_subject)}<br /><span class="error">{$errorArray._message_subject}</span>{else}<br /><em>Subject on email</em>{/if}
			</td>					
          </tr>
          <tr>
			<td>
				<h4>Note:</h4><br />
				To add peoples names on the mailer please add the following variables on the mailer: <br /><br />
					<table>					
						<tr><td>[fullname]</td><td>=</td><td>Member Name and Surname</td></tr>
						<tr><td>[email]</td><td>=</td><td>Client email</td></tr>
						<tr><td>[domain]</td><td>=</td><td>Current domain</td></tr>
						<tr><td>[tracking]</td><td>=</td><td>Code for tracking email opened by client</td></tr>
						<tr><td>[date]</td><td>=</td><td>Date sent out to client</td></tr>
						{if isset($messageData)}<tr><td>Image paths</td><td>=</td><td>http://{$smarty.server.HTTP_HOST}/messages/{$messageData._message_code}/images/imagename.jpg</td></tr>
						{/if}
						{if isset($messageData) && $messageData._message_file neq ''}<tr><td>View file</td><td>=</td><td><a href="http://{$smarty.server.HTTP_HOST}{$messageData._message_file}" target="_blank" >http://{$smarty.server.HTTP_HOST}{$messageData._message_file}</a></td></tr>
					{/if}						
					</table><br />					
				<h4>Upload HTML File:</h4><br />
				<input type="file" name="htmlfile" id="htmlfile" />
				{if isset($errorArray.htmlfile)}<br /><span class="error">{$errorArray.htmlfile}</span>{else}<br /><em>Only .html and .htm allowed</em>{/if}					
			</td>
          </tr>
          <tr>
			<td>				
				<h4>Upload image files:</h4><br />
				<input type="file" name="imagefiles[]" id="imagefiles[]" multiple />
				{if isset($errorArray.imagefiles)}<br /><span class="error">{$errorArray.imagefiles}</span>{else}<br /><em>Only .png, .jpeg, .gif and .jpg allowed</em>{/if}					
			</td>
          </tr>		  
		  {else}
          <tr> 
			<td>
				<h4 class="error">Message:</h4><br />
				<textarea id="_message_text" name="_message_text" cols="60" rows="3">{$campaignData._message_text}</textarea>
				<br /><em id="charcount" class="error">0 characters entered.</em>
				{if isset($errorArray._message_text)}<br /><span class="error">{$errorArray._message_text}</span>{/if}
			</td>
          </tr>		  
		  {/if}
		{/if}		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
	<div class="mrg_top_10">
	  <a class="button cancel mrg_left_147 fl" href="/communication/messages/"><span>Cancel</span></a>
	  <a class="blue_button mrg_left_20 fl" href="javascript:submitForm();"><span>Save &amp; Complete</span></a>   
	</div>
    <div class="clearer"><!-- --></div>
	<br /><br />	
    </div><!--inner-->
<!-- End Content recruiter -->
 </div><!-- End Content recruiter -->
 {include_php file='includes/footer.php'}
</div>
{literal}
<script type="text/javascript" language="javascript">
{/literal}{if isset($messageData) && $messageData._message_type eq 'SMS'}{literal}
	$("#_message_text").keyup(function () {
		var i = $("#_message_text").val().length;
		$("#charcount").html(i+' characters entered.');
		if (i > 160) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else if(i == 0) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else {
			$('#charcount').removeClass('error');
			$('#charcount').addClass('success');
		} 
	});
{/literal}{/if}{literal}
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
{/literal}
<!-- End Main Container -->
</body>
</html>
