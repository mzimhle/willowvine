<?php /* Smarty version 2.6.20, created on 2015-07-21 08:38:44
         compiled from jobs/application/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'jobs/application/details.tpl', 39, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Job Applications</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/jobs/" title="Jobs">Jobs</a></li>
			<li><a href="/jobs/application/" title="Applications">Applications</a></li>
			<li><a href="#" title="<?php echo $this->_tpl_vars['enquiryData']['job_title']; ?>
"><?php echo $this->_tpl_vars['enquiryData']['job_title']; ?>
</a></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Application for <?php echo $this->_tpl_vars['enquiryData']['job_title']; ?>
</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>			
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="#" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td>
				<h4>Added:</h4><br />
				<?php echo ((is_array($_tmp=$this->_tpl_vars['enquiryData']['enquiry_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

			</td>
            <td>
				<h4>Job Title:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['job_title']; ?>

			</td>
            <td>
				<h4>Job Location:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['job_area']; ?>

			</td>			
          </tr>		  
          <tr>
            <td>
				<h4>Job Post By:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['job_poster_name']; ?>

			</td>
            <td>
				<h4>Job Post Email:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['job_poster_email']; ?>

			</td>
            <td>
				<h4>Job Post Number:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['job_poster_number']; ?>

			</td>			
          </tr>
          <tr>
            <td>
				<h4>Applicant Name:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>

			</td>
            <td>
				<h4>Applicant Email:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['enquiry_email']; ?>

			</td>
            <td>
				<h4>Applicant Number:</h4><br />
				<?php echo $this->_tpl_vars['enquiryData']['enquiry_cellphone']; ?>

			</td>			
          </tr>		  
			<tr>
				<td colspan="3">
					<h4>Message:</h4><br />
					<?php echo $this->_tpl_vars['enquiryData']['enquiry_message']; ?>

				</td>
			</tr>	 	
           <tr>
            <td colspan="3">
				<h4>Download CV:</h4><br />
				<a href="<?php echo $this->_tpl_vars['enquiryData']['enquiry_file_path']; ?>
" target="_blank"><?php echo $this->_tpl_vars['enquiryData']['enquiry_file_name']; ?>
</a>
			</td>
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
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>