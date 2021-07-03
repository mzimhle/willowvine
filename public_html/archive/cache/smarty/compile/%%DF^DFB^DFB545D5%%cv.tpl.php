<?php /* Smarty version 2.6.20, created on 2015-01-13 11:40:46
         compiled from admin/users/jobSeekers/cv.tpl */ ?>
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
            <li><a href="/admin/users/jobSeekers/details.php?reference=<?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_reference']; ?>
" title="Details">Details</a></li>
			<li class="active"><a href="#" title="Details">CV's</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <tr>
			<td>added</td>
			<td>file name</td>
			<td>download file</td>
		   </tr>		 
          <tr>
		 <?php $_from = $this->_tpl_vars['jobSeekerCVData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <td align="left"><?php echo $this->_tpl_vars['item']['jobSeekerCV_added']; ?>
</td>
			<td align="left"><?php echo $this->_tpl_vars['item']['jobSeekerCV_userName']; ?>
</td>
			<td align="left"><a href="/media/jobSeeker/cv/<?php echo $this->_tpl_vars['jobSeekerData']['jobSeeker_reference']; ?>
/<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
</a></td>
          </tr>			  
		  <?php endforeach; else: ?>
          <tr>
            <td><h4>No CV'S uploaded.</h4></td>        
          </tr>				  
		  <?php endif; unset($_from); ?>
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