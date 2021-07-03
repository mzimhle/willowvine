<?php /* Smarty version 2.6.20, created on 2015-01-13 11:41:38
         compiled from admin/users/jobSeekers/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/users/jobSeekers/details.tpl', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Users | jobSeeker |  View details</title>
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
            <li><a href="/admin/help/jobSeekers.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/users/" title="Users">Users</a></li>
			<li><a href="/admin/users/jobSeekers/" title="jobSeekers">jobSeeker</a></li>
			<li><a href="#" title="jobSeekers">View jobSeeker</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit jobSeeker: <?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_surname']; ?>
</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="/admin/users/jobSeekers/cv.php?jobSeeker_reference=<?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_reference']; ?>
" title="Details">CV's</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/users/jobSeekers/details.php?reference=<?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_reference']; ?>
" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td class="left_col"><h4>jobSeeker Active?</h4></td>
            <td><input type="checkbox" name="jobSeeker_active" id="jobSeeker_active" value="1" <?php if ($this->_tpl_vars['jobSeekerData']['jobSeeker_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>
          <tr>
            <td><h4>Added:</h4></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['jobSeekerData']['jobSeeker_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
          </tr>	
          <tr>
            <td><h4>Updated:</h4></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['jobSeekerData']['jobSeeker_updated'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
          </tr>	
          <tr>
            <td><h4>Last login:</h4></td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['jobSeekerData']['jobSeeker_lastLogin'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
          </tr>			  
          <tr>
            <td><h4>Full Name:</h4></td>
            <td><?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_surname']; ?>
</td>
          </tr>
          <tr>
            <td><h4>Email:</h4></td>
             <td><?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_email']; ?>
</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Password:</h4></td>
             <td><?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_password']; ?>
</td>
          </tr>	 
           <tr>
            <td class="left_col"><h4>Area:</h4></td>
             <td><?php echo $this->_tpl_vars['jobSeekerData']['areaMap_path']; ?>
</td>
          </tr>	
           <tr>
            <td class="left_col"><h4>Facebook Link:</h4></td>
             <td><a href="<?php echo $this->_tpl_vars['jobSeekerData']['fb_user_link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['jobSeekerData']['fb_user_link']; ?>
</a></td>
          </tr>	
           <tr>
            <td class="left_col"><h4>Twitter Link:</h4></td>
             <td><a href="<?php echo $this->_tpl_vars['jobSeekerData']['twitter_link']; ?>
" target="_blank"><?php echo $this->_tpl_vars['jobSeekerData']['twitter_link']; ?>
</a></td>
          </tr>			  
           <tr>
            <td class="left_col"><h4>Message user:</h4></td>
             <td><textarea cols="50" rows="10" id="jobSeeker_message" name="jobSeeker_message"></textarea></td>
          </tr>	
           <tr>
				<td  colspan="2" class="left_col">
					<a href="javascript: document.forms.detailsForm.submit();" title="Send Mail" class="blue_button fr mrg_bot_10">
						<span style="float:right;">Send Mail</span>
					</a>
				</td>
          </tr>	
	  	  <?php if (isset ( $this->_tpl_vars['success'] )): ?>
		  <tr>
            <td colspan="2" class="left_col"><span style="color: green;">Your email has been sent.</span></td>
          </tr>	
		  <?php endif; ?>
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