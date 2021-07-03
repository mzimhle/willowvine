<?php /* Smarty version 2.6.20, created on 2014-12-27 19:54:16
         compiled from job_seeker/register/activate.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Home | Online Job Classified Adverts - Jobs, Careers, holiday or weekend work in your town or city and near you.</title>
<meta name="description" content="Register our CV with us and let the recruiters and employers come to you." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span class="dash">|</span> &nbsp; 
			<span class="orange_text">Job Seeker</span>
			<span class="dash">|</span> &nbsp; 
			<span class="orange_text">Account Activation</span>			
		</p>
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php if ($this->_tpl_vars['jobShareCount'] > 0): ?>	
	<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
		<span id="Login">View my Shortlist (<?php echo $this->_tpl_vars['jobShareCount']; ?>
)</span>								
	</a>		
	<?php endif; ?>
	<h1>
		Account Activation
	</h1>

	<div class="left_content">
	<span class="descr_text">
		Congradulations, your account has been activated by confirming your email, please press login on the top-right of the page or use our social network logins to login and add or update your CVs.
	</span>
	<!-- Pagination -->
	<div class="clear"></div>		
	<!-- End Pagination -->
	</div>
	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/social_plugin_login.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>