<?php /* Smarty version 2.6.20, created on 2014-12-23 08:14:23
         compiled from administration/resources/recruiters/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recruiter</title>
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

	<div id="breadcrumb">
        <ul>
            <li><a href="/administration/" title="Home">Home</a></li>
            <li><a href="/administration/resources/" title="Resources">Resources</a></li>
			<li><a href="/administration/resources/recruiters/" title="Recruiter">Recruiter</a></li>
			<li><a href="/administration/resources/recruiters/details.php<?php if (isset ( $this->_tpl_vars['recruiterData']['recruiter_code'] )): ?>?code=<?php echo $this->_tpl_vars['recruiterData']['recruiter_code']; ?>
<?php endif; ?>" title="Details">Details</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Recruiter</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/administration/resources/recruiters/details.php<?php if (isset ( $this->_tpl_vars['recruiterData']['recruiter_code'] )): ?>?code=<?php echo $this->_tpl_vars['recruiterData']['recruiter_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="recruiter_name" id="recruiter_name" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_name']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['recruiter_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['recruiter_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Email:</h4><br />
				<input type="text" name="recruiter_email" id="recruiter_email" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_email']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['recruiter_email'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['recruiter_email']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4>Number:</h4><br />
				<input type="text" name="recruiter_number" id="recruiter_number" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_number']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['recruiter_number'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['recruiter_number']; ?>
</span><?php endif; ?>
			</td>			
          </tr>
		  <tr>
            <td>
				<h4 class="error">Website:</h4><br />
				<input type="text" name="recruiter_website" id="recruiter_website" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_website']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['recruiter_website'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['recruiter_website']; ?>
</span><?php endif; ?>
			</td>		  
            <td colspan="2">
				<h4>Address:</h4><br />
				<input type="text" name="recruiter_address" id="recruiter_address" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_address']; ?>
" size="90"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['recruiter_address'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['recruiter_address']; ?>
</span><?php endif; ?>
			</td>			
		  </tr>		  
		  <tr>
            <td colspan="3">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="<?php echo $this->_tpl_vars['recruiterData']['areapost_name']; ?>
" size="90"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="<?php echo $this->_tpl_vars['recruiterData']['areapost_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['areapost_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['areapost_code']; ?>
</span><?php endif; ?>
			</td>		  
		  </tr>
		  <tr> 
            <td>
				<?php if (isset ( $this->_tpl_vars['recruiterData']['recruiter_logo_path'] ) && trim ( $this->_tpl_vars['recruiterData']['recruiter_logo_path'] ) != ''): ?>
					<img src="<?php echo $this->_tpl_vars['recruiterData']['recruiter_logo_path']; ?>
" width="160" />
				<?php else: ?>
					<img src="/images/avatar.jpg"  width="160" />
				<?php endif; ?>			
			</td>		  
            <td colspan="3" valign="top">
				<h4>Image Path:</h4><br />
				<input type="text" name="recruiter_logo_path" id="recruiter_logo_path" value="<?php echo $this->_tpl_vars['recruiterData']['recruiter_logo_path']; ?>
" size="90"/>
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
<!-- End Content Section -->
 </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
		
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/areaparents.php",
			minLength: 2,
			select: function( event, ui ) {
			
				if(ui.item.id == \'\') {
					$(\'#areapost_name\').html(\'\');
					$(\'#areapost_code\').val(\'\');					
				} else {
					$(\'#areapost_name\').html(\'<b>\' + ui.item.value + \'</b>\');
					$(\'#areapost_code\').val(ui.item.id);	
				}
				$(\'#areapost_name\').val(\'\');										
			}
		});			
});
</script>
'; ?>

</body>
</html>