<?php /* Smarty version 2.6.20, created on 2013-05-24 15:43:58
         compiled from emails/sender_internshipShare.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'emails/sender_internshipShare.html', 23, false),array('modifier', 'default', 'emails/sender_internshipShare.html', 31, false),)), $this); ?>
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
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;"><strong><h2>Willowvine | Shared Internship with a friend</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center"><strong>Good day, <?php echo $this->_tpl_vars['data']['internshipShare_friendName']; ?>
, your friend, <?php echo $this->_tpl_vars['data']['internshipShare_name']; ?>
, thought you might be interested in this internship/bursary offer.</td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
		<td height="30"><strong>Date Sent:</strong></td>
		<td><p><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p></td>
	</tr>
	<tr>
		<td height="30"><strong>Title:</strong></td>
		<td><?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Available in Area:</strong></td>
		<td><?php echo ((is_array($_tmp=@$this->_tpl_vars['internshipData']['areaMap_shortPath'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Depends on company offering') : smarty_modifier_default($_tmp, 'Depends on company offering')); ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Company offering:</strong></td>
		<td><?php echo ((is_array($_tmp=@$this->_tpl_vars['internshipData']['internship_company'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Closing Date:</strong></td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['internshipData']['internship_closing_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
</td>
	</tr>		
  <tr>
  	<td colspan="2" align="center"><a href="http://www.willowvine.co.za/internships/<?php echo $this->_tpl_vars['internshipData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['internshipData']['internship_link']; ?>
/<?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
/"><b>Click here to get full internship/bursary details</b></a></td>
  </tr>		
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'emails/email_footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
  
</table>
</body>
</html>