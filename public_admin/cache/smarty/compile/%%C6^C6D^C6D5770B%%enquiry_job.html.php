<?php /* Smarty version 2.6.20, created on 2014-12-15 08:18:05
         compiled from templates/mail/enquiry_job.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'templates/mail/enquiry_job.html', 31, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Willowvine Mailer</title>
<?php echo '
<style type="text/css">
/* Client-specific Styles */
#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

/* Reset Styles */
body{margin:0; padding:0; background-color: #FFFFFF; font-size: 20px;}
img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
table td{border-collapse:collapse;}
#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}
a { text-decoration: none; color: white;}
</style>
'; ?>

</head>
<body style="margin: 0; padding: 0; text-align: center; background-color: #FFFFFF;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="background: #FFFFFF">
	<tr>
    	<td>
            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="87" align="left" valign="middle" colspan="2"><img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/templates/mail/images/mail_logo.gif" width="600" height="87" border="0" alt="Willowvine" style="font-family: Helvetica, Verdana, Arial, sans-serif; font-size: 60px; line-height: 0; color: #ef3c3f; font-weight: bold; display: block" /></td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 20px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #17628c; padding: 15px;" bgcolor="#17628c" colspan="2">
                    	<span style="font-size: 13px; font-weight: bold;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span><br />
						<span style="font-size: 40px; font-weight: bold;">Job Application</span><br />
						<span style="font-size: 18px; font-weight: bold;"><?php echo $this->_tpl_vars['enquiry']['job_title']; ?>
</span>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 14px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #ef3c3f; padding: 15px;" bgcolor="#ef3c3f" colspan="2">
                    	<p>Good day,</p>
						<p>An application has been made via the <a href="http://<?php echo $this->_tpl_vars['domain']; ?>
" target="_blank">www.willowvine.co.za</a> by :
						<br /><b><?php echo $this->_tpl_vars['enquiry']['enquiry_name']; ?>
 ( <?php echo $this->_tpl_vars['enquiry']['enquiry_email']; ?>
 )</b>.</p>
						<p>Application is for the job title : <b><?php echo $this->_tpl_vars['enquiry']['job_title']; ?>
</b>, below is the message from the applicant:</p>
						<p><i>"<?php echo $this->_tpl_vars['enquiry']['enquiry_message']; ?>
"</i></p>
						<p>Please see attached CV from the applicant.</p>
                     <p>Thank You,<br />The Willowvine Team</p>
                    </td>
                </tr>
                <tr>
                    <td width="404" height="40" align="left" style="font-size: 14px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #f16052; padding: 15px;" bgcolor="#f16052">
                    	You recieved this email from <a style="text-decoration: none; font-weight: bold; color: #FFFFFF;" href="http://<?php echo $this->_tpl_vars['domain']; ?>
">www.<?php echo $this->_tpl_vars['domain']; ?>
</a>
                    </td>
                    <td width="196" align="left" style="font-size: 18px; font-weight: bold; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #f16052; padding: 15px;" bgcolor="#f16052">
                    	<a href="http://www.bizlounge.co.za/" style="color: #FFFFFF;"><img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/templates/mail/images/w_icon.gif" alt="W" width="31" height="31" border="0" /></a> 
						<a href="https://www.facebook.com/willowvine" style="color: #FFFFFF;"><img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/templates/mail/images/f_icon.gif" alt="f" width="31" height="31" border="0" /></a> 
						<a href="https://twitter.com/willowvine" style="color: #FFFFFF;"><img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/templates/mail/images/tw_icon.gif" width="31" height="31" alt="t" border="0" /></a> 
						<!-- <a href="http://www.linkedin.com/company/business-lounge-sa" style="color: #FFFFFF;"><img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/templates/mail/images/in_icon.gif" alt="in" width="31" height="31" border="0" /></a> --> 
						<!-- <a href="#" style="color: #FFFFFF;"><img src="/images/g_icon.gif" width="28" height="31" alt="G" border="0" /></a> -->
                    </td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="40" align="center" valign="middle" style="font-size: 12px; font-family: Helvetica, Verdana, Arial, sans-serif;">
			<a style="text-decoration: none; color: black;" href="http://<?php echo $this->_tpl_vars['domain']; ?>
/mailer/view/<?php echo $this->_tpl_vars['tracking']; ?>
">Click here to view this mailer on a browser</a>
			<img src="http://<?php echo $this->_tpl_vars['domain']; ?>
/mailer/tracking/<?php echo $this->_tpl_vars['tracking']; ?>
" width="0" height="0" border="0"  />	
		</td>
	</tr>	
</table>
</body>
</html>