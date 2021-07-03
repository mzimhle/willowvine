<?php /* Smarty version 2.6.20, created on 2015-01-30 14:41:43
         compiled from administration/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Willowv</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  <div class="inner">  
   <h2>Willowvine Content Management System</h2>	
  <p>Welcome,  please select one of the options below to proceed.</p>
  <div class="section">
  	<a href="/administration/jobs/" title="Manage Jobs"><img src="/administration/images/users.gif" alt="Manage Jobs" height="50" width="50" /></a>
  	<a href="/administration/jobs/" title="Manage Jobs" class="title">Manage Jobs</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/administration/users/" title="Manage Users"><img src="/administration/images/projects.gif" alt="Manage Users" height="50" width="50" /></a>
  	<a href="/administration/users/" title="Manage Users" class="title">Manage Users</a>
  </div>
  <div class="section mrg_left_50">
  	<a href="/administration/sections/" title="Manage sections"><img src="/administration/images/users.gif" alt="Manage sections" height="50" width="50" /></a>
  	<a href="/administration/sections/" title="Manage sections" class="title">Manage sections</a>
  </div>
  <div class="clearer"><!-- --></div>  
  <div class="section">
  	<a href="/administration/enquiries/" title="Manage Enquiries"><img src="/administration/images/projects.gif" alt="Manage Enquiries" height="50" width="50" /></a>
  	<a href="/administration/enquiries/" title="Manage Enquiries" class="title">Manage Enquiries</a>
  </div>  
  <div class="section mrg_left_50">
  	<a href="/administration/resources/" title="Manage Resources"><img src="/administration/images/users.gif" alt="Manage Resources" height="50" width="50" /></a>
  	<a href="/administration/resources/" title="Manage Resources" class="title">Manage Resources</a>
  </div>
  <div class="clearer"><!-- --></div>
    </div><!--inner-->
  	
    
  </div><!-- End Content Section -->
	
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>



</div>
<!-- End Main Container -->
</body>
</html>