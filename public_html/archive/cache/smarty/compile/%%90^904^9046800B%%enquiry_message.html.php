<?php /* Smarty version 2.6.20, created on 2015-01-13 11:44:44
         compiled from emails/enquiry_message.html */ ?>
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
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;"><strong><h2>Willowvine | Message</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center"><strong>Good day, <?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
</strong></td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
<tr>
		<td height="20" colspan="2">&nbsp;</td>
	</tr>  
	<tr>
		<td colspan="2"  height="60"><?php echo $this->_tpl_vars['data']['enquiry_message']; ?>
<br><br>Kind Regards,<br>Willowvine</td>
	</tr>		
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
  	<td colspan="2" style="border-bottom: 5px solid #e1e1e7;">&nbsp;</td>
  </tr>			
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'emails/email_footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
    
</table>
</body>
</html>