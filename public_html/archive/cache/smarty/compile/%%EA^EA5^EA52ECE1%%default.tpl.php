<?php /* Smarty version 2.6.20, created on 2014-12-17 19:26:16
         compiled from admin/resources/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'admin/resources/default.tpl', 34, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Home | Resources</title>

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
            <li><a href="/admin/resources/" title="Resources">Resources</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage Resources</h2>	
	  <p>Welcome back <?php echo ((is_array($_tmp=$this->_tpl_vars['admin']['administrator_name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['admin']['administrator_surname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
! Please select one of the options below to proceed.</p>
	  <div class="section">
		<a href="/admin/resources/areas/" title="Manage Areas"><img src="/admin/images/users.gif" alt="Manage Areas" height="50" width="50" /></a>
		<a href="/admin/resources/areas/" title="Manage Areas" class="title">Manage Areas</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/admin/resources/internships/" title="Manage internships"><img src="/admin/images/users.gif" alt="Manage internships" height="50" width="50" /></a>
		<a href="/admin/resources/internships/" title="Manage internships" class="title">Manage internships</a>
	  </div>
	  <div class="clearer"><!-- --></div> 
	  <div class="section">
		<a href="/admin/resources/careers/" title="Manage Careers"><img src="/admin/images/users.gif" alt="Manage Careers" height="50" width="50" /></a>
		<a href="/admin/resources/careers/" title="Manage Careers" class="title">Manage Careers</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/admin/resources/emails/" title="Manage emails"><img src="/admin/images/users.gif" alt="Manage emails" height="50" width="50" /></a>
		<a href="/admin/resources/emails/" title="Manage emails" class="title">Manage emails</a>
	  </div>	  
	  <div class="clearer"><!-- --></div> 
	  <div class="section">
		<a href="/admin/resources/jobShare/" title="Manage Job Share"><img src="/admin/images/users.gif" alt="Manage Job Share" height="50" width="50" /></a>
		<a href="/admin/resources/jobShare/" title="Manage Job Share" class="title">Manage Job Share</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/admin/resources/internshipShare/" title="Manage Internship Share"><img src="/admin/images/users.gif" alt="Manage Internship Share" height="50" width="50" /></a>
		<a href="/admin/resources/internshipShare/" title="Manage Internship Share" class="title">Manage Internship Share</a>
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