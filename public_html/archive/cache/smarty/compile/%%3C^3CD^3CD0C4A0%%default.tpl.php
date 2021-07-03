<?php /* Smarty version 2.6.20, created on 2015-02-01 12:27:31
         compiled from admin/jobs/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'admin/jobs/default.tpl', 34, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Home | jobs</title>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 

</head>

<body>
<!-- Start Main Container -->
<div id="container">

    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    <div class="logged_in">
        <ul>
            <li><a href="/admin/help/" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
		<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/jobs/" title="Jobs">Jobs</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage jobs</h2>	
	  <p>Welcome back <?php echo ((is_array($_tmp=$this->_tpl_vars['admin']['administrator_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['admin']['administrator_surname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
! Please select one of the options below to proceed.</p>
	  <div class="section">
		<a href="/admin/jobs/scrape/" title="Manage Scraping"><img src="/admin/images/users.gif" alt="Manage Scraping" height="50" width="50" /></a>
		<a href="/admin/jobs/scrape/" title="Manage Scraping" class="title">Manage Scraping</a>
	  </div>
	
	  <div class="section mrg_left_50">
		<a href="/admin/jobs/view/" title="Manage Jobs"><img src="/admin/images/projects.gif" alt="Manage Jobs" height="50" width="50" /></a>
		<a href="/admin/jobs/view/" title="Manage Jobs" class="title">Manage Jobs</a>
	  </div>
	  <div class="clearer"><!-- --></div>
	  <div class="section">
		<a href="/admin/jobs/jobApplication/" title="Manage Job Applications"><img src="/admin/images/users.gif" alt="Manage Job Applications" height="50" width="50" /></a>
		<a href="/admin/jobs/jobApplication/" title="Manage Job Applications" class="title">Manage Job Applications</a>
	  </div>
	  <div class="clearer"><!-- --></div> 	  
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>



</div>
<!-- End Main Container -->
</body>
</html>