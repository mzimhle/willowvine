<?php /* Smarty version 2.6.20, created on 2015-05-29 23:59:47
         compiled from /home/willowvi/public_html/templates/mail/registration_email_verify.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/home/willowvi/public_html/templates/mail/registration_email_verify.html', 29, false),array('modifier', 'lower', '/home/willowvi/public_html/templates/mail/registration_email_verify.html', 36, false),array('modifier', 'capitalize', '/home/willowvi/public_html/templates/mail/registration_email_verify.html', 36, false),)), $this); ?>
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
                    <td align="left" style="font-size: 20px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #17628c; padding: 15px;" bgcolor="#17628c" colspan="2">
                    	<span style="font-size: 13px; font-weight: bold;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span><br />
						<span style="font-size: 40px; font-weight: bold;">Online Registration</span><br />
						<span style="font-size: 18px; font-weight: bold;">Email verification</span>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="font-size: 14px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #ef3c3f; padding: 15px;" bgcolor="#ef3c3f" colspan="2">
                    	Good day <b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mailinglist']['mailinglist_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mailinglist']['mailinglist_surname'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b>
						<p>Thank you for registering on our Willowvine website, please click on the below link to verify your email address.<p>
						<p><a href="http://www.willowvine.co.za/registration/verify/<?php echo $this->_tpl_vars['mailinglist']['mailinglist_hashcode']; ?>
">Click here to verify this email.</a></p>
						<p>If you cannot click on the above email, please copy and paste this link on your web browser's URL : <br /><b><i><a href="http://www.willowvine.co.za/registration/verify/<?php echo $this->_tpl_vars['mailinglist']['mailinglist_hashcode']; ?>
" target="_blank">http://www.willowvine.co.za/registration/verify/<?php echo $this->_tpl_vars['mailinglist']['mailinglist_hashcode']; ?>
</a></i></b></p>
                     <p>Thank You,<br />The Willowvine Team</p>
                    </td>
                </tr>
                <tr>
                    <td width="404" height="40" align="left" style="font-size: 14px; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #f16052; padding: 15px;" bgcolor="#f16052">
                    	You recieved this email from <a style="text-decoration: none; font-weight: bold; color: #FFFFFF;" href="http://www.willowvine.co.za">www.willowvine.co.za</a>
                    </td>
                    <td width="196" align="left" style="font-size: 18px; font-weight: bold; font-family: Helvetica, Verdana, Arial, sans-serif; color: #FFFFFF; background-color: #f16052; padding: 15px;" bgcolor="#f16052">
                    	<a href="http://www.willowvine.co.za/" style="color: #FFFFFF;"><img src="http://www.willowvine.co.za/templates/mail/images/w_icon.gif" alt="W" width="31" height="31" border="0" /></a> 
						<a href="https://www.facebook.com/willowvine" style="color: #FFFFFF;"><img src="http://www.willowvine.co.za/templates/mail/images/f_icon.gif" alt="f" width="31" height="31" border="0" /></a> 
						<a href="https://twitter.com/willowvine" style="color: #FFFFFF;"><img src="http://www.willowvine.co.za/templates/mail/images/tw_icon.gif" width="31" height="31" alt="t" border="0" /></a> 

                    </td>
                </tr>
            </table>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="40" align="center" valign="middle" style="font-size: 12px; font-family: Helvetica, Verdana, Arial, sans-serif;">
			<a style="text-decoration: none; color: black;" href="http://www.willowvine.co.za/mailer/view/<?php echo $this->_tpl_vars['tracking']; ?>
">Click here to view this mailer on a browser</a>
			<img src="http://www.willowvine.co.za/mailer/tracking/<?php echo $this->_tpl_vars['tracking']; ?>
" width="0" height="0" border="0"  />	
		</td>
	</tr>	
</table>
</body>
</html>