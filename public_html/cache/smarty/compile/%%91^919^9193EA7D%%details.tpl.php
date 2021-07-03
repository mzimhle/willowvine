<?php /* Smarty version 2.6.20, created on 2015-02-01 15:47:07
         compiled from internships/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'internships/view/details.tpl', 42, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Internship</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
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
            <li><a href="/internships/view/" title="Internshiip">Internshiip</a></li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Internshiip Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/internships/view/details.php<?php if (isset ( $this->_tpl_vars['internshipData']['internship_code'] )): ?>?code=<?php echo $this->_tpl_vars['internshipData']['internship_code']; ?>
<?php endif; ?>" method="post">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="internship_name" id="internship_name" value="<?php echo $this->_tpl_vars['internshipData']['internship_name']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_name']; ?>
</span><?php endif; ?>
			</td>
            <td colspan="2">
				<h4>Category:</h4><br />
				<select id="category_code" name="category_code">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categoryPairs'],'selected' => $this->_tpl_vars['internshipData']['category_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['category_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['category_code']; ?>
</span><?php endif; ?>
			</td>			
          </tr>	
		  <tr>
            <td colspan="3">
				<h4>Link:</h4><br />
				<input type="text" name="internship_link" id="internship_link" value="<?php echo $this->_tpl_vars['internshipData']['internship_link']; ?>
" size="80"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_link'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_link']; ?>
</span><?php endif; ?>
			</td>		  
		  </tr>
           <tr>
            <td>
				<h4 class="error">Company:</h4><br />
				<input type="text" name="internship_company" id="internship_company" value="<?php echo $this->_tpl_vars['internshipData']['internship_company']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_company'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_company']; ?>
</span><?php endif; ?>
			</td>
            <td colspan="2">
				<h4>Areas:</h4><br />
				<input type="text" name="internship_area" id="internship_area" value="<?php echo $this->_tpl_vars['internshipData']['internship_area']; ?>
" size="60"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_area'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_area']; ?>
</span><?php endif; ?>
			</td>		
          </tr>	
           <tr>
            <td>
				<h4>Contact Person:</h4><br />
				<input type="text" name="internship_contact_name" id="internship_contact_name" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_name']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_contact_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4>Contact Email:</h4><br />
				<input type="text" name="internship_contact_email" id="internship_contact_email" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_email']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_email'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_contact_email']; ?>
</span><?php endif; ?>
			</td>	
            <td>
				<h4>Contact Number:</h4><br />
				<input type="text" name="internship_contact_number" id="internship_contact_number" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_number']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_number'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_contact_number']; ?>
</span><?php endif; ?>
			</td>			
          </tr>
           <tr>
            <td>
				<h4 class="error">Opening Date:</h4><br />
				<input type="text" name="internship_date_opening" id="internship_date_opening" value="<?php echo $this->_tpl_vars['internshipData']['internship_date_opening']; ?>
" size="15"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_date_opening'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_date_opening']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Closing Date:</h4><br />
				<input type="text" name="internship_date_closing" id="internship_date_closing" value="<?php echo $this->_tpl_vars['internshipData']['internship_date_closing']; ?>
" size="15"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['internship_date_closing'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_date_closing']; ?>
</span><?php endif; ?>
			</td>			
          </tr>				  
			<tr>
				<td colspan="3">
					<h4 class="error">Description:</h4><br />
					<textarea name="internship_page" id="internship_page" style="width: 850px; height: 400px;"><?php echo $this->_tpl_vars['internshipData']['internship_page']; ?>
</textarea>
					<?php if (isset ( $this->_tpl_vars['errorArray']['internship_page'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['internship_page']; ?>
</span><?php endif; ?>
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
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<!-- End Main Container -->
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'internship_page\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

	$( "#internship_date_opening" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#internship_date_closing" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	
	$( "#internship_date_closing" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#internship_date_opening" ).datepicker( "option", "maxDate", selectedDate );
		}
	});

	new nicEditor({
		iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList :   [\'fontSize\',\'bold\',\'italic\',\'underline\',\'strikeThrough\',\'subscript\',\'superscript\',\'xhtml\',\'image\'],
		maxHeight : \'800\'
	}).panelInstance(\'internship_page\');		
});
</script>
'; ?>

</body>
</html>