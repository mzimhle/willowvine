<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Contact us.</title>
<meta name="keywords" content="jobs, careers, exam papers, career advise, contact us, contact details">
<meta name="description" content="Willowvine contact us for any queries, leave your email, name and message and we will get back to you as soon as possible.">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - Jobs, bursaries, careers and previous exam papers all in one place.">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
{include_php file='includes/css.php'}
</head>
<body>
{include_php file='includes/header.php'}
{include_php file='includes/menu.php'}
<section class="container">
	<div class="col-xs-12 col-md-8 db-gutter-right">
		<div class="tenderboxe eachbox">
		<p class="bissubhead">Enquiry Form</p>
		<p>Do you have any issues, suggestions or even praises for the Willowvine website? please share them with us, if we can we will do our best to get back to as soon as possible. Please fill in the below fields to send us an email.
			</p>
			
			<div class="bisform">
				{if isset($errorArray)}<p><b>Enquiry Error: {$errorArray}</b></p>{/if}			
				{if !isset($success)}
				<form id="bismsg" name="bismsg" role="form" method="POST" action="/contact/">
					<label>Full Name:</label>
					<input type="text" name="enquiry_name" id="enquiry_name" class="form-control" value="" /><br />
					<label>Your Email:</label>
					<input type="text" name="enquiry_email" id="enquiry_email" class="form-control" value="" /><br />
					<label>Your Area:</label>
					<input type="text" name="areapost_name" id="areapost_name" class="form-control" value="" />
					<input type="hidden" name="areapost_code" id="areapost_code" class="form-control" value="" />
					<br /> 				
					<label>Your Enquiry:</label>
					<textarea cols="5" name="enquiry_message" id="enquiry_message" class="form-control"></textarea>
					<br>
					<button class="btn" id="enquirySubmitBtn" name="enquirySubmitBtn" onclick="submitContactForm(); return false;">Send Enquiry</button>
				</form>
				{else}
					<p class="">Thank you very much for your enquiry, we will get back to you as soon as possible.</p>
				{/if}				
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4 no-gutter-left">
		<div class="eachbox visible-md visible-lg">
			<a target="_blank" href="http://www.willow-nettica.com/"><img alt="Willow-Nettica" title="Willow-Nettica" src="/images/willow_ad.jpg"></a>
		</div>
	</div>
        </div>
</section>
{include_php file='includes/footer.php'}
{literal}
<script type="text/javascript">
function submitContactForm() {
	$('#enquirySubmitBtn').hide();
	$.ajax({
		type: "POST",
		url: "/contact/",
		data: "action=contactValidate&enquiry_name="+$('#enquiry_name').val()+"&enquiry_email="+$("#enquiry_email").val()+"&areapost_code="+$("#areapost_code").val()+"&enquiry_message="+$("#enquiry_message").val(),
		dataType: "json",
		success: function(data){
			if(!data.result) {							
				actionNotify('Enquiry Error', displayMessage(data.message));
				$('#enquirySubmitBtn').show();
			} else {
				document.forms.bismsg.submit();
			}
		}
	});
	return false;	
}
</script>
{/literal}
</body>
</html>