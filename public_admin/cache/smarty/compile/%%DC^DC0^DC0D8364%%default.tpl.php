<?php /* Smarty version 2.6.20, created on 2015-01-30 14:41:47
         compiled from administration/jobs/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Willowvine</title>
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

    <div class="logged_in">
        <ul>
            <li><a href="/administration/help/" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/administration/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
		<div id="breadcrumb">
        <ul>
            <li><a href="/administration/default.php" title="Home">Home</a></li>
            <li><a href="/administration/jobs/" title="Jobs">Jobs</a></li>
        </ul>
	</div><!--breadcrumb-->  
  <div class="inner">  
   <h2>Manage jobs</h2>
	  <div class="section">
		<a href="/administration/jobs/view/" title="Manage Jobs"><img src="/administration/images/projects.gif" alt="Manage Jobs" height="50" width="50" /></a>
		<a href="/administration/jobs/view/" title="Manage Jobs" class="title">Manage Jobs</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/administration/jobs/application/" title="Manage Job Applications"><img src="/administration/images/users.gif" alt="Manage Job Applications" height="50" width="50" /></a>
		<a href="/administration/jobs/application/" title="Manage Job Applications" class="title">Manage Job Applications</a>
	  </div>
	  <div class="section mrg_left_50">
		<a href="/administration/jobs/share/" title="Manage Share"><img src="/administration/images/users.gif" alt="Manage Share" height="50" width="50" /></a>
		<a href="/administration/jobs/share/" title="Manage Share" class="title">Manage Share</a>
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