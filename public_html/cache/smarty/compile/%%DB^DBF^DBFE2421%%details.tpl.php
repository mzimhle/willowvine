<?php /* Smarty version 2.6.20, created on 2015-01-19 08:19:31
         compiled from administration/participants/view/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Participants</title>
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
            <li><a href="/administration/participants/" title="Participants">Participants</a></li>
			<li><a href="/administration/participants/view/" title="View">View</a></li>
			<li><a href="/administration/participants/view/details.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
" title="Jobs"><?php echo $this->_tpl_vars['participantData']['participant_name']; ?>
 <?php echo $this->_tpl_vars['participantData']['participant_surname']; ?>
</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Participant Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['participantData'] )): ?>/administration/participants/view/cv.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
<?php else: ?>#<?php endif; ?>" title="Details">CV</a></li>
			<li><a href="<?php if (isset ( $this->_tpl_vars['participantData'] )): ?>/administration/participants/view/login.php?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
<?php else: ?>#<?php endif; ?>" title="Login">Login</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/administration/participants/view/details.php<?php if (isset ( $this->_tpl_vars['participantData']['participant_code'] )): ?>?code=<?php echo $this->_tpl_vars['participantData']['participant_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4>Active ?</h4><br />
				<input type="checkbox" name="participant_active" id="participant_active" value="1" <?php if ($this->_tpl_vars['participantData']['participant_active'] == 1): ?>checked="checked"<?php endif; ?> />
			</td>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="participant_name" id="participant_name" value="<?php echo $this->_tpl_vars['participantData']['participant_name']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['participant_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['participant_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Surname:</h4><br />
				<input type="text" name="participant_surname" id="participant_surname" value="<?php echo $this->_tpl_vars['participantData']['participant_surname']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['participant_surname'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['participant_surname']; ?>
</span><?php endif; ?>
			</td>		
          </tr>	
          <tr>
            <td>
				<h4 class="error">Email:</h4><br />
				<input type="text" name="participant_email" id="participant_email" value="<?php echo $this->_tpl_vars['participantData']['participant_email']; ?>
" size="40"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['participant_email'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['participant_email']; ?>
</span><?php endif; ?>
			</td>
            <td colspan="2">
				<h4 class="error">Area:</h4><br />
				<input type="text" name="areapost_name" id="areapost_name" value="<?php echo $this->_tpl_vars['participantData']['areapost_name']; ?>
" size="60"/>
				<input type="hidden" name="areapost_code" id="areapost_code" value="<?php echo $this->_tpl_vars['participantData']['areapost_code']; ?>
" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['areapost_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['areapost_code']; ?>
</span><?php endif; ?>
			</td>
          </tr>			
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
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
			source: "/feeds/area.php",
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