<?php /* Smarty version 2.6.20, created on 2013-06-25 08:38:32
         compiled from admin/resources/internships/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/resources/internships/details.tpl', 122, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['siteName']; ?>
 | Resources | internships | <?php if (isset ( $this->_tpl_vars['internshipData']['pk_internship_id'] )): ?>Edit internship<?php else: ?>Add a internship<?php endif; ?></title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
<script language="javascript" type="text/javascript" src="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.js"></script>
<link rel="stylesheet" type="text/css" href="/library/javascript/calendar/jquery.datepick.package/jquery.datepick.css" />
<?php echo '
<script type="text/javascript">
$().ready(function() {

$(\'#internship_closing_date\').datepick({dateFormat: \'yyyy-mm-dd\'});
$(\'#internship_opening_date\').datepick({dateFormat: \'yyyy-mm-dd\'});
	
$("#areaMap_path").autocomplete(areas);
});
</script>
'; ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content internship -->
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
			<li><a href="/admin/resources/" title="Resources">Resources</a></li>
			<li><a href="/admin/resources/internships/" title="internships">internships</a></li>
			<li><?php if (isset ( $this->_tpl_vars['internshipData']['pk_internship_id'] )): ?>Edit internship<?php else: ?>Add a internship<?php endif; ?></li>
        </ul>
	</div><!--breadcrumb--> 
  
	<div class="inner"> 
      <h2><?php if (isset ( $this->_tpl_vars['internshipData']['pk_internship_id'] )): ?>Edit internship: <?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
<?php else: ?>Add a new internship<?php endif; ?></h2>
    <div id="sidetabs">
        <ul > 
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div><!--tabs-->

	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/admin/resources/internships/details.php<?php if (isset ( $this->_tpl_vars['internshipData']['pk_internship_id'] )): ?>?pk_internship_id=<?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
<?php endif; ?>" method="post">
        <?php if (isset ( $this->_tpl_vars['internshipData']['pk_internship_id'] )): ?><input type="hidden" name="pk_internship_id" id="pk_internship_id" value="<?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
" /><?php endif; ?>
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
          <?php if (isset ( $this->_tpl_vars['internshipData'] ) && $this->_tpl_vars['internshipData']['internship_active'] == 1): ?>
		  <tr>
            <td class="left_col"><h4>View internship on Site:</h4></td>
            <td>
				<a href="/internships/<?php echo $this->_tpl_vars['internshipData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['internshipData']['internship_link']; ?>
/<?php echo $this->_tpl_vars['internshipData']['pk_internship_id']; ?>
/" target="_blank">View internship On site</a>
          </tr>	
		<?php endif; ?>		  
           <tr>
            <td class="left_col"><h4>internship Active?</h4></td>
            <td><input type="checkbox" name="internship_active" id="internship_active" value="1" <?php if ($this->_tpl_vars['internshipData']['internship_active'] == 1): ?> checked="checked" <?php endif; ?> /></td>
          </tr>	 
		<?php if (isset ( $this->_tpl_vars['internshipData']['internship_added'] )): ?>		  
          <tr>
            <td class="left_col"><h4>internship Added:</h4></td>
			<td><?php echo $this->_tpl_vars['internshipData']['internship_added']; ?>
</td>
          </tr>
		<?php endif; ?>		  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_title'] )): ?>style="color: red"<?php endif; ?>><h4>Title:</h4></td>
			<td><input type="text" name="internship_title" id="internship_title" value="<?php echo $this->_tpl_vars['internshipData']['internship_title']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_company'] )): ?>style="color: red"<?php endif; ?>><h4>Company:</h4></td>
			<td><input type="text" name="internship_company" id="internship_company" value="<?php echo $this->_tpl_vars['internshipData']['internship_company']; ?>
" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_name'] )): ?>style="color: red"<?php endif; ?>><h4>Contact Name:</h4></td>
			<td><input type="text" name="internship_contact_name" id="internship_contact_name" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_name']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_email'] )): ?>style="color: red"<?php endif; ?>><h4>Contact Email:</h4></td>
			<td><input type="text" name="internship_contact_email" id="internship_contact_email" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_email']; ?>
" size="60"/></td>
          </tr>		
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_contact_number'] )): ?>style="color: red"<?php endif; ?>><h4>Contact Number:</h4></td>
			<td><input type="text" name="internship_contact_number" id="internship_contact_number" value="<?php echo $this->_tpl_vars['internshipData']['internship_contact_number']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_opening_date'] )): ?>style="color: red"<?php endif; ?>><h4>Opening Date:</h4></td>
			<td><input type="text" name="internship_opening_date" id="internship_opening_date" value="<?php echo $this->_tpl_vars['internshipData']['internship_opening_date']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_closing_date'] )): ?>style="color: red"<?php endif; ?>><h4>Closing Date:</h4></td>
			<td><input type="text" name="internship_closing_date" id="internship_closing_date" value="<?php echo $this->_tpl_vars['internshipData']['internship_closing_date']; ?>
" size="60"/></td>
          </tr>	
          <tr>
            <td class="left_col" ><h4>City/Town/Area:</h4></td>
			<td><?php echo $this->_tpl_vars['internshipData']['internship_area']; ?>
</td>
          </tr>			  
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['areaMap_path'] )): ?>style="color: red"<?php endif; ?>><h4>City/Town/Area:</h4></td>
			<td><input type="text" name="areaMap_path" id="areaMap_path" value="<?php echo $this->_tpl_vars['internshipData']['areaMap_path']; ?>
" size="60"/></td>
          </tr>			  
		<?php if (isset ( $this->_tpl_vars['internshipData']['internship_link'] )): ?>		  
          <tr>
            <td class="left_col"><h4>internship Url Name:</h4></td>
            <td><?php echo $this->_tpl_vars['internshipData']['internship_link']; ?>
</td>
          </tr>		
		<?php endif; ?>		
          <tr>
            <td class="left_col" <?php if (isset ( $this->_tpl_vars['errorArray']['fk_section_id'] )): ?>style="color: red"<?php endif; ?>><h4>Section:</h4></td>
            <td>
				<select id="fk_section_id" name="fk_section_id">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sectionPairs'],'selected' => $this->_tpl_vars['internshipData']['fk_section_id']), $this);?>
</td>
				</select>
			</td>
          </tr>	
          <tr>
            <td class="left_col"><h4>Application Link:</h4></td>
			<td><input type="text" name="internship_appyLink" id="internship_appyLink" value="<?php echo $this->_tpl_vars['internshipData']['internship_appyLink']; ?>
" size="60"/></td>
          </tr>			  
		  <tr>
            <td class="left_col" valign="top" <?php if (isset ( $this->_tpl_vars['errorArray']['internship_page'] )): ?>style="color: red"<?php endif; ?>><h4>Page:</h4></td>
            <td>
				<textarea name="internship_page" id="internship_page" style="width: 590px; height: 800px;"><?php echo $this->_tpl_vars['internshipData']['internship_page']; ?>
</textarea>
          </tr>			  
        </table>
      </form>
	</div>
    <div class="clearer"><!-- --></div>
        <div class="mrg_top_10">
          <a href="/admin/resources/internships/" class="button cancel mrg_left_147 fl"><span>Cancel</span></a>
          <a href="javascript:submitForm();" class="blue_button mrg_left_20 fl"><span>Save &amp; Complete</span></a>   
        </div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
 </div> 	
<!-- End Content internship -->
 </div><!-- End Content internship -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript" language="javascript">
function submitForm() {
	nicEditors.findEditor(\'internship_page\').saveContent();
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){

		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			buttonList : [\'bold\',\'italic\',\'underline\',\'ol\',\'ul\',\'indent\',\'outdent\',\'center\', \'right\',\'left\',\'upload\',\'link\',\'unlink\',\'fontFormat\',\'xhtml\'],
			maxHeight : \'900\'
		}).panelInstance(\'internship_page\');			
});

</script>
'; ?>

<!-- End Main Container -->
</body>
</html>