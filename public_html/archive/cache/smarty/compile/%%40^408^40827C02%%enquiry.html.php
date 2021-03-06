<?php /* Smarty version 2.6.20, created on 2015-01-12 15:48:52
         compiled from emails/enquiry.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/enquiry.html', 23, false),)), $this); ?>
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
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;"><strong><h2>Willowvine | Email Enquiry Confirmation</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center"><strong>Your enquiry has been received, you will be contacted soon.</strong></td></tr>
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
		<td><?php echo $this->_tpl_vars['data']['enquiry_name']; ?>
</td>
	</tr>
	<tr>
		<td height="30"><strong>Location:</strong></td>
		<td><?php echo $this->_tpl_vars['data']['areaName']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Reference:</strong></td>
		<td><?php echo $this->_tpl_vars['data']['enquiry_reference']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Message:</strong></td>
		<td><?php echo $this->_tpl_vars['data']['enquiry_comments']; ?>
</td>
	</tr>		
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
</table>
</body>
</html>