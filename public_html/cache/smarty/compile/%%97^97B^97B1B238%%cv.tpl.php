<?php /* Smarty version 2.6.20, created on 2015-05-25 07:06:51
         compiled from participants/view/cv.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
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

	<div id="breadcrumb">
        <ul>
            <li><a href="/" title="Home">Home</a></li>
            <li><a href="/participants/" title="Participants">Participants</a></li>
			<li><a href="/participants/view/" title="View">View</a></li>
			<li><a href="/participants/view/details.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Jobs"><?php echo $this->_tpl_vars['participantData']['participant_name']; ?>
 <?php echo $this->_tpl_vars['participantData']['participant_surname']; ?>
</a></li>
			<li>CVs</li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php echo $this->_tpl_vars['participantData']['participant_name']; ?>
 <?php echo $this->_tpl_vars['participantData']['participant_surname']; ?>
</h2>
    <div id="sidetabs">
        <ul >
            <li><a href="/participants/view/details.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Details">Details</a></li>
			<li class="active"><a href="#" title="CV">CV's</a></li>
			<li><a href="/participants/view/login.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Login">Login</a></li>
        </ul>
    </div><!--tabs-->
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/participants/view/cv.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
		 <tr>
			<td>Added</td>
			<td>File name</td>
			<td>Download file</td>
		   </tr>		 
          <tr>
		 <?php $_from = $this->_tpl_vars['cvData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr>
            <td align="left"><?php echo $this->_tpl_vars['item']['cv_added']; ?>
</td>
			<td align="left"><?php echo $this->_tpl_vars['item']['cv_name']; ?>
</td>
			<td align="left"><a href="<?php echo $this->_tpl_vars['item']['cv_path']; ?>
" target="_blank">Download</a></td>
          </tr>			  
		  <?php endforeach; else: ?>
          <tr>
            <td colspan="3"><h4>No CV uploaded.</h4></td>        
          </tr>				  
		  <?php endif; unset($_from); ?>
		  <tr>
			<td colspan="3">
				<input type="file" id="documentfile" name="documentfile" />
				<?php if (isset ( $this->_tpl_vars['errorArray'] )): ?><br /><?php echo $this->_tpl_vars['errorArray']; ?>
<?php endif; ?>
			</td>
		  </tr>
        </table>
      </form>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>	
    <div class="clearer"><!-- --></div>	  
	</div>	
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div>
 </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}
</script>
'; ?>

</body>
</html>