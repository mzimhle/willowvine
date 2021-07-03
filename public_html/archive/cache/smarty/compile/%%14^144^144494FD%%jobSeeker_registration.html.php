<?php /* Smarty version 2.6.20, created on 2014-12-27 19:48:35
         compiled from emails/jobSeeker_registration.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/jobSeeker_registration.html', 23, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body style="margin:0; padding: 0;color: #3F3F3F;font-size: 12px;">
<p><br />
<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Verdana, Geneva, Arial, helvetica, sans-serif; color: #3F3F3F;font-size: 12px;;">
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>
	<tr>
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;"><strong><h2>Willowvine | Email Registartion Confirmation</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center"><strong>Please <a href="http://willowvine.co.za/job_seeker/register/activate.php?cde=<?php echo $this->_tpl_vars['registerData']['jobSeeker_registrationCode']; ?>
">click on this link</a> to complete registration and activate your account. Afterwards you will be able to update your CV.</strong></td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
		<td height="30"><strong>Date Sent:</strong></td>
		<td><p><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p></td>
	</tr>
	<tr>
		<td height="30"><strong>Name:</strong></td>
		<td><?php echo $this->_tpl_vars['registerData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['registerData']['jobSeeker_surname']; ?>
</td>
	</tr>	
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
    <tr>
  	<td colspan="2" height="20">&nbsp;</td>
  </tr>	
    <tr>
  	<td colspan="2">
		If you cannot see or click on the link, copy the below link and paste it on the URL box.	
	</td>
	</tr>	
	<tr>
  	<td colspan="2">
		<a href="http://willowvine.co.za/job_seeker/register/activate.php?cde=<?php echo $this->_tpl_vars['registerData']['jobSeeker_registrationCode']; ?>
">
		http://willowvine.co.za/job_seeker/register/activate.php?cde=<?php echo $this->_tpl_vars['registerData']['jobSeeker_registrationCode']; ?>

		</a>
	</td>	
  </tr>
      <tr>
  	<td colspan="2" height="20" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
  <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'emails/email_footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</table>

</body>
</html>