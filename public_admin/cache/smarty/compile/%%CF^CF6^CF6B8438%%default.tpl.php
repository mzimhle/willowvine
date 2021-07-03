<?php /* Smarty version 2.6.20, created on 2015-01-13 21:35:14
         compiled from account/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'account/default.tpl', 46, false),array('modifier', 'date_format', 'account/default.tpl', 50, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" contzlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta props and Jobs</title>
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
    	<div class="col-xs-12 col-md-9 db-gutter-right">
			<div class="tenderbox eachbox">
				<div class="titles htitle">
                    <div class="mainsearch minisearch">
				        <span class="fa fa-ellipsis-v"></span><a href="/account/edit/">Edit My Profile</a>
					</div>
                    <h1>Your Personal Profile</h1>
                </div>
                <p>
                    <em class="subhead">Current Login Type</em><br />
                    <?php echo $this->_tpl_vars['participantloginData']['participantlogin_type']; ?>

                </p>				
                <p>
                    <em class="subhead">Fullname</em><br />
                    <?php echo $this->_tpl_vars['participantloginData']['participant_name']; ?>
 <?php echo $this->_tpl_vars['participantloginData']['participant_surname']; ?>

                </p>
                <p>
                    <em class="subhead">Gender</em><br />
                    <?php echo ((is_array($_tmp=@$this->_tpl_vars['participantloginData']['participant_gender'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Not entered yet') : smarty_modifier_default($_tmp, 'Not entered yet')); ?>

                </p>	
                <p>
                    <em class="subhead">Date of Birth</em><br />
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['participantloginData']['participant_birthdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")))) ? $this->_run_mod_handler('default', true, $_tmp, 'Not entered yet') : smarty_modifier_default($_tmp, 'Not entered yet')); ?>

                </p>				
                <p>
                    <em class="subhead">Area</em><br />
                    <?php echo ((is_array($_tmp=@$this->_tpl_vars['participantloginData']['areapost_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Not entered yet') : smarty_modifier_default($_tmp, 'Not entered yet')); ?>

                </p>
                <p>
                    <em class="subhead">Email</em><br />
                    <?php echo $this->_tpl_vars['participantloginData']['participantlogin_username']; ?>

                </p>
                <p>
                    <em class="subhead">Profile Picture</em><br><br />
                    <img src="/download/profileimage/<?php echo $this->_tpl_vars['participantloginData']['participant_code']; ?>
/thumb" />
                </p><br />
            </div>
        </div>
		
        <div class="col-xs-12 col-md-3 no-gutter-left">
			<div class="newsbox eachbox no-gutter-left" id="go1">
				<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/register.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			</div>
        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>