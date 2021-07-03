<?php /* Smarty version 2.6.20, created on 2014-11-24 11:34:11
         compiled from admin/jobs/jobApplication/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/jobs/jobApplication/details.tpl', 48, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Users | jobApplication |  View details</title>
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
            <li><a href="/admin/help/jobApplications.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/users/" title="Users">Users</a></li>
			<li><a href="/admin/users/jobApplication/" title="jobApplications">jobApplication</a></li>
			<li><a href="#" title="jobApplications">View jobApplication</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit jobApplication: <?php echo $this->_tpl_vars['jobApplicationData']['jobApplication_name']; ?>
</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>jobApplication Active?</h4></td>
            <td><input type="checkbox" name="jobApplication_active" id="jobApplication_active" value="1" <?php if ($this->_tpl_vars['jobApplicationData']['jobApplication_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>
          <tr>
            <td><h4>Added:</h4></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['jobApplicationData']['jobApplication_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
          </tr>	
          <tr>
            <td><h4>Job Title:</h4></td>
            <td><?php echo $this->_tpl_vars['jobApplicationData']['job_title']; ?>
</td>
          </tr>			  
          <tr>
            <td><h4>Job By:</h4></td>
            <td><?php echo $this->_tpl_vars['jobApplicationData']['job_poster_name']; ?>
</td>
          </tr>
          <tr>
            <td><h4>Job Email:</h4></td>
            <td><?php echo $this->_tpl_vars['jobApplicationData']['job_poster_email']; ?>
</td>
          </tr>	
          <tr>
            <td><h4>Job Location:</h4></td>
             <td><?php echo $this->_tpl_vars['jobApplicationData']['job_area']; ?>
</td>
          </tr> 		  
          <tr>
            <td><h4>Email:</h4></td>
             <td><?php echo $this->_tpl_vars['jobApplicationData']['jobApplication_email']; ?>
</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Message:</h4></td>
             <td><?php echo $this->_tpl_vars['jobApplicationData']['jobApplication_comments']; ?>
</td>
          </tr>	 	
           <tr>
            <td class="left_col"><h4>Download CV:</h4></td>
             <td><a href="<?php echo $this->_tpl_vars['jobApplicationData']['jobApplication_pathToCV']; ?>
" target="_blank"><?php echo $this->_tpl_vars['jobApplicationData']['jobApplication_userFilename']; ?>
</a></td>
          </tr>	 			  		  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content Section -->
 </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>