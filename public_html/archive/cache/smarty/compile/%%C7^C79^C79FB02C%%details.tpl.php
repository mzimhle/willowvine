<?php /* Smarty version 2.6.20, created on 2015-01-13 11:44:44
         compiled from admin/enquiries/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Enquiries | View Enquiry</title>
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
            <li><a href="/admin/help/users.php" title="Get Help" class="help_icon"> Help</a></li>
            <li>|<a href="/admin/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
  	<br />
	<div id="breadcrumb">
        <ul>
            <li><a href="/admin/default.php" title="Home">Home</a></li>
            <li><a href="/admin/enquiries/" title="Users">Enquiries</a></li>
			<li>View Enquiry</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2>Edit enquiry for: <?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/enquiries/details.php?pk_enquiry_id=<?php echo $this->_tpl_vars['enquiryData']['pk_enquiry_id']; ?>
" method="post">
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <tr>
            <td><h4>Full Name:</h4></td>
            <td><?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
</td>
          </tr>
          <tr>
            <td><h4>Number:</h4></td>
            <td><?php echo $this->_tpl_vars['enquiryData']['enquiry_number']; ?>
</td>
          </tr>          
           <tr>
            <td class="left_col"><h4>Email:</h4></td>
            <td><?php echo $this->_tpl_vars['enquiryData']['enquiry_email']; ?>
</td>
          </tr>		  	   		   	   		   		   
          <tr>
            <td><h4>Area:</h4></td>
            <td><?php echo $this->_tpl_vars['enquiryData']['areaMap_shortPath']; ?>
</td>
           </tr>		  				  
		<tr>
            <td class="left_col" valign="top"><h4>Message:</h4></td>
            <td><?php echo $this->_tpl_vars['enquiryData']['enquiry_comments']; ?>
</td>
          </tr>	
           <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['success'] )): ?>style="color: green; font-weight: bold;"<?php endif; ?>><h4>Message enquirier:</h4></td>
             <td><textarea cols="50" rows="10" id="enquiry_message" name="enquiry_message"></textarea></td>
          </tr>	
           <tr>
				<td  colspan="2" class="left_col">
					<a href="javascript: document.forms.detailsForm.submit();" title="Send Mail" class="blue_button fr mrg_bot_10">
						<span style="float:right;">Send Mail</span>
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
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
</body>
</html>