<?php /* Smarty version 2.6.20, created on 2015-01-28 16:12:11
         compiled from emails/job_application.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/job_application.html', 23, false),)), $this); ?>
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
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;" align="center"><strong><h2>Willowvine | Job Application</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center"><strong>Job Application by: <?php echo $this->_tpl_vars['applicationData']['jobApplication_name']; ?>
</strong></td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
		<td height="30"><strong>Date Sent:</strong></td>
		<td><p><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p></td>
	</tr>
	<tr>
		<td height="30"><strong>Applied for:</strong></td>
		<td><?php echo $this->_tpl_vars['jobData']['job_title']; ?>
 in <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Comments:</strong></td>
		<td><?php echo $this->_tpl_vars['applicationData']['jobApplication_comments']; ?>
</td>
	</tr>	
	<?php if ($this->_tpl_vars['jobData']['job_affiliateReference'] != ''): ?>
	<tr>
		<td height="30"><strong>Job Reference:</strong></td>
		<td><?php echo $this->_tpl_vars['jobData']['job_affiliateReference']; ?>
</td>
	</tr>
	<?php endif; ?>	
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="2" align="center"><a href="http://www.willowvine.co.za/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/">Click here to the job.</a></td>
	</tr>  
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
	</tr>	
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'emails/email_footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
  	
</table>
</body>
</html>