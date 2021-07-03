<?php /* Smarty version 2.6.20, created on 2013-06-25 01:01:21
         compiled from emails/send_emails.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'emails/send_emails.html', 38, false),array('modifier', 'strip_tags', 'emails/send_emails.html', 38, false),array('modifier', 'truncate', 'emails/send_emails.html', 38, false),)), $this); ?>
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
		<td height="30" colspan="2" style="font-size: 15px;padding-bottom: 13px;" align="center"><strong><h2>Bursaries, internships and jobs for 2012/2013</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center" style="font-size: 16px;padding-bottom: 10px;"><strong>Visit our website <a href="http://www.willowvine.co.za/" style="text-decoration: none; color: #CA7316; " >willowvine</a> to see for yourself.</strong></td></tr>
	<tr>
  	<td colspan="2" style="border-bottom: 5px solid #e1e1e7;">&nbsp;</td>
  </tr>	
  
	<tr>
		<td colspan="2" style="border-bottom: 5px solid #e1e1e7; padding-bottom: 5px; padding-top: 5px; font-size: 16px;" align="left">
			<strong>Latest Internships /  Bursaries</strong>			
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 15px;" align="left">
			<table width="100%">
				<?php $_from = $this->_tpl_vars['internshipData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<tr>
					<td style="padding-bottom: 20px;">
						<a style="text-decoration: none; color: black;" href="http://www.willowvine.co.za/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/" target="_blank">
							<b><?php echo $this->_tpl_vars['item']['internship_title']; ?>
</b><br>
							<span style="color: #CA7316; font-weight: bold;"><?php echo $this->_tpl_vars['item']['internship_company']; ?>
</span><br>
							<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['internship_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 250) : smarty_modifier_truncate($_tmp, 250)); ?>

						</a>
					</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>
	<tr>
  	<td colspan="2" style="border-bottom: 5px solid #e1e1e7;">&nbsp;</td>
  </tr>		
	<tr>
		<td colspan="2" style="border-bottom: 5px solid #e1e1e7; padding-bottom: 5px; padding-top: 5px; font-size: 16px;" align="left">
			<strong>Latest Jobs</strong>			
		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 15px;" align="left">
			<table width="100%">
				<?php $_from = $this->_tpl_vars['jobData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<tr>
					<td style="padding-bottom: 20px;">
						<a style="text-decoration: none; color: black;" href="http://www.willowvine.co.za/jobs/search/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['job_link']; ?>
/<?php echo $this->_tpl_vars['item']['job_reference']; ?>
/" target="_blank">
							<b><?php echo $this->_tpl_vars['item']['job_title']; ?>
</b><br>
							<span style="color: #CA7316; font-weight: bold;"><?php echo $this->_tpl_vars['item']['section_name']; ?>
</span><br>
							<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['job_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 250) : smarty_modifier_truncate($_tmp, 250)); ?>

						</a>
					</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
			</table>
		</td>
	</tr>	
	<tr>
  	<td colspan="2" style="border-bottom: 5px solid #e1e1e7;">&nbsp;</td>
  </tr>			
	<tr>
		<td colspan="2" style="border-bottom: 5px solid #e1e1e7; padding-bottom: 5px; padding-top: 5px; font-size: 16px;" align="left">
			<strong>Start up your career path with us!</strong>			
	</td>
	</tr>	
	<tr>
		<td height="30" style="color: #CA7316;"><a href="http://www.facebook.com/willowvine/" style="color: #CA7316; text-decoration: none;"><strong>Find us on Facebook</strong></a></td>
		<td height="30" style="color: #CA7316;"><a href="http://twitter.com/willowvine" style="color: #CA7316; text-decoration: none;"><strong>Follow us on twitter (@willowvine)</strong></a></td>
	</tr>
	<tr>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/" style="color: #CA7316; text-decoration: none;"><strong>Register your CV with us!</strong></a></td>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/internships/" style="color: #CA7316; text-decoration: none;"><strong>Search for bursaries/internships/scholarships</strong></a></td>
	</tr>
	<tr>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/careers/" style="color: #CA7316; text-decoration: none;"><strong>Learn about other careers</strong></a></td>
		<td height="30" style="color: #CA7316;"><a href="http://www.willowvine.co.za/jobs/search/" style="color: #CA7316; text-decoration: none;"><strong>Search for Jobs</strong></a></td>
	</tr>
	<tr>
  	<td colspan="2" style="border-bottom: 5px solid #e1e1e7;">&nbsp;</td>
  </tr>		
</table>
</body>
</html>