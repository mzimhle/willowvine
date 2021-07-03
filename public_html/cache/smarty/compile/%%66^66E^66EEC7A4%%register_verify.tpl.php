<?php /* Smarty version 2.6.20, created on 2015-05-30 00:01:21
         compiled from templates/mail_response/register_verify.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Tenders, Trade Leads, Business Listings and Jobs</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, jobs">
<meta name="description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, jobs and more prospects to grow your business...">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, jobs and more prospects to grow your business.">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-12">
        	<!-- /// short list box /// -->
			<div class="tenderbox eachbox rightdarkborder">				
				<div class="titles">
					<h1>Email Verification Successful and Registration Completed</h1>
				</div>
				<div class="infolist cf">
					<p class="bluehighlight">Thank you for registering with us <?php echo $this->_tpl_vars['mailinglistData']['mailinglist_name']; ?>
 <?php echo $this->_tpl_vars['mailinglistData']['mailinglist_surname']; ?>
.</p>
					<p>Your log in details are as follows:</p>
					<span>Username: <b><?php echo $this->_tpl_vars['participantData']['participantlogin_username']; ?>
</b></span><br />	
					<span>Password: <b><?php echo $this->_tpl_vars['participantData']['participantlogin_password']; ?>
</b></span>			
					<p>Your registration and verification of the email address <b class="redhighlight"><?php echo $this->_tpl_vars['mailinglistData']['mailinglist_email']; ?>
</b> has been successful. You can now log in.</p>
					<p>We have also sent you log in details via your verified email address so you can keep them safe. You can simply change your log in details by going to your account.</p>
				</div>				
			</div>						
        </div>		
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>