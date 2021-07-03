<?php /* Smarty version 2.6.20, created on 2015-01-30 10:55:15
         compiled from emails/post_completed.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/post_completed.html', 25, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body style="margin:0; padding: 0;color: #3F3F3F;font-size: 12px;">
<p><br />
<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Verdana, Geneva, Arial, helvetica, sans-serif; color: #3F3F3F;font-size: 12px;;">
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">
		<img src="http://www.willowvine.co.za/emails/logo_big_cut.png" width="650" height="90" />
	</td>
  </tr>
	<tr>
		<td height="30" colspan="2" style="font-size: 15px;padding-bottom: 13px;" align="center"><strong><h2>Willowvine | New Job Post Created</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center" style="font-size: 16px;padding-bottom: 10px;"><strong>Job Title: <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</strong></td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
		<td height="30"><strong>Date Created:</strong></td>
		<td><p><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p></td>
	</tr>
	<tr>
		<td height="30"><strong>Added by:</strong></td>
		<td><?php echo $this->_tpl_vars['jobData']['job_poster_name']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Area:</strong></td>
		<td><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</td>
	</tr>
	<tr>
		<td height="30"><strong>View the job:</strong></td>
		<td><a href="http://www.willowvine.co.za/jobs/search/<?php echo $this->_tpl_vars['sectionData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/">Click here.</a>	</td>
	</tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
	</tr>		
	<tr>
		<td colspan="2" style="border-bottom: 1px solid #e1e1e7; padding-bottom: 15px; padding-top: 15px; font-size: 16px;" align="center">
			<strong>Additional Information regarding the new job</strong>			
	</td>
	</tr>	
	<tr>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/recruiter/jobs/edit.php?post=<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
&job=<?php echo $this->_tpl_vars['jobData']['job_hashcode']; ?>
" style="color: #CA7316; text-decoration: none;"><strong>1. To update/edit the job please click here.</strong></a></td>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/recruiter/jobs/delete.php?post=<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
&job=<?php echo $this->_tpl_vars['jobData']['job_hashcode']; ?>
" style="color: #CA7316; text-decoration: none;"><strong>2. To delete the job please click here.</strong></a></td>
	</tr>	
</table>
</body>
</html>