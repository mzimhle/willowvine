<?php /* Smarty version 2.6.20, created on 2015-02-01 13:37:47
         compiled from contact/default.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Company Name Here</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, internships">
<meta name="description" content="Business Lounge - Jobs - <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge - Jobs - <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<section class="container">
	<div class="col-xs-12 col-md-8 db-gutter-right">
		<div class="tenderboxe eachbox">
		<p class="bissubhead">Enquiry Form</p>
		<p>Do you have any issues, suggestions or even praises for the Willowvine website? please share them with us, if we can we will do our best to get back to as soon as possible. Please fill in the below fields to send us an email.
			</p>
			
			<div class="bisform">
				<?php if (isset ( $this->_tpl_vars['errorArray'] )): ?><p><b>Enquiry Error: <?php echo $this->_tpl_vars['errorArray']; ?>
</b></p><?php endif; ?>			
				<?php if (! isset ( $this->_tpl_vars['success'] )): ?>
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
				<?php else: ?>
					<p class="">Thank you very much for your enquiry, we will get back to you as soon as possible.</p>
				<?php endif; ?>				
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
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script type="text/javascript">
function submitContactForm() {
	$(\'#enquirySubmitBtn\').hide();
	$.ajax({
		type: "POST",
		url: "/contact/",
		data: "action=contactValidate&enquiry_name="+$(\'#enquiry_name\').val()+"&enquiry_email="+$("#enquiry_email").val()+"&areapost_code="+$("#areapost_code").val()+"&enquiry_message="+$("#enquiry_message").val(),
		dataType: "json",
		success: function(data){
			if(!data.result) {							
				actionNotify(\'Enquiry Error\', displayMessage(data.message));
				$(\'#enquirySubmitBtn\').show();
			} else {
				document.forms.bismsg.submit();
			}
		}
	});
	return false;	
}
</script>
'; ?>

</body>
</html>