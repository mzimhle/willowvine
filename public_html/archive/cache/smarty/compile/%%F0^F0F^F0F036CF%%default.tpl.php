<?php /* Smarty version 2.6.20, created on 2015-01-31 08:00:24
         compiled from contact_us/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'contact_us/default.tpl', 46, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Contact Us</title>
<meta name="description" content="Job Classified Adverts Contact us for Jobs, Careers, holiday or weekend work in your town or city and near you.">
<meta name="description" content="Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<style type="text/css">
	.error {font-size: 11px; color: red; width: 16em; float: left; }	
	.comment {font-size: 11px; color: #CA7316; margin-top: 5px;}
</style>
'; ?>

</head>
<body OnLoad="document.enquiryForm.enquiry_name.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

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
		<?php if (isset ( $this->_tpl_vars['enquiryData_success'] )): ?>
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px; width: 500px;" class="myform" id="side_box">
			Thank you for contacting us, your enquiry was sent successfully and we will look at it as soon as possible. 
		</div>		
		<?php endif; ?>
		<div id="side_box" class="myform" style="margin: 0; width: 500px;" >
		<form id="enquiryForm" name="enquiryForm" method="post" action="/contact_us/" >
		<p>Required<img src="/images/required_dot.png" style="margin-bottom: 7px;" /></p>
		<label>Full name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_name'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['enquiry_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "Your name and surname.") : smarty_modifier_default($_tmp, "Your name and surname.")); ?>
</span></label>
		<input type="text" name="enquiry_name" id="enquiry_name" class="width_280" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
"/>

		<label>Number<span class="small"><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['enquiry_number'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Contact number please') : smarty_modifier_default($_tmp, 'Contact number please')); ?>
</span></label>
		<input type="text" name="enquiry_number" id="enquiry_number" class="width_280" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_number']; ?>
" />

		<label>Email Address<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_email'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['enquiry_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "Valid email address.") : smarty_modifier_default($_tmp, "Valid email address.")); ?>
</span></label>
		<input type="text" name="enquiry_email" id="enquiry_email" class="width_280" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_email']; ?>
" />

		<label>Message<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_comments'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?> ><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['enquiry_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, "Please tell us give us your message/enquiry") : smarty_modifier_default($_tmp, "Please tell us give us your message/enquiry")); ?>
</span></label>
		<textarea id="enquiry_comments" name="enquiry_comments" cols="80" rows="10" class="width_280"><?php echo $this->_tpl_vars['enquiryData']['enquiry_comments']; ?>
</textarea>
		<div class="clear"></div>
		<label>Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['areaName'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['areaName'])) ? $this->_run_mod_handler('default', true, $_tmp, "Select from the drop down towns/suburbs") : smarty_modifier_default($_tmp, "Select from the drop down towns/suburbs")); ?>
</span></label>
		<input type="text" id="areaName" name="areaName" class="width_280" value="<?php echo $this->_tpl_vars['enquiryData']['areaName']; ?>
"/>
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
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/facebook_wall.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>		
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
	</div>

<?php echo '
<script language="JavaScript" type="text/javascript">
function enquiryFormSubmit() {
	document.forms.enquiryForm.submit();
}
  
$().ready(function() {
$("#areaName").focus().autocomplete(areas);
});
</script>
'; ?>

</body>
</html>