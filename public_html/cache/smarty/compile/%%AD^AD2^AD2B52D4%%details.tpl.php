<?php /* Smarty version 2.6.20, created on 2015-02-01 15:50:54
         compiled from exams/view/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'exams/view/details.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam</title>
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
            <li><a href="/exams/" title="Exam">Exam</a></li>
			<li><a href="/exams/view/" title="View">View</a></li>
			<li>Details</li>
        </ul>
	</div><!--breadcrumb--> 
	<div class="inner"> 
      <h2>Exam Details</h2>
    <div id="sidetabs">
        <ul >
            <li class="active"><a href="#" title="Details">Details</a></li>
        </ul>
    </div>
	<div class="detail_box">
      <form id="detailsForm" name="detailsForm" action="/exams/view/details.php<?php if (isset ( $this->_tpl_vars['examData']['exam_code'] )): ?>?code=<?php echo $this->_tpl_vars['examData']['exam_code']; ?>
<?php endif; ?>" method="post" enctype="multipart/form-data">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="form">
           <tr>
            <td>
				<h4 class="error">Name:</h4><br />
				<input type="text" name="exam_name" id="exam_name" value="<?php echo $this->_tpl_vars['examData']['exam_name']; ?>
" size="30"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['exam_name'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['exam_name']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Subject:</h4><br />
				<select id="subject_code" name="subject_code">
					<option value=""> ---- </option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['subjectPairs'],'selected' => $this->_tpl_vars['examData']['subject_code']), $this);?>

				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['subject_code'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['subject_code']; ?>
</span><?php endif; ?>
			</td>
            <td>
				<h4 class="error">Date:</h4><br />
				<input type="text" name="exam_date" id="exam_date" value="<?php echo $this->_tpl_vars['examData']['exam_date']; ?>
" size="10"/>
				<?php if (isset ( $this->_tpl_vars['errorArray']['exam_date'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['exam_date']; ?>
</span><?php endif; ?>
			</td>			
          </tr>	
           <tr>
            <td>
				<h4 class="error">Language:</h4><br />
				<select id="exam_language" name="exam_language">
					<option value=""> ---- </option>
					<option value="XHOSA" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'XHOSA'): ?>selected<?php endif; ?>> Xhosa </option>
					<option value="ZULU" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'ZULU'): ?>selected<?php endif; ?>> Zulu </option>
					<option value="SWATI" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'SWATI'): ?>selected<?php endif; ?>> Swati </option>
					<option value="ENGLISH" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'ENGLISH'): ?>selected<?php endif; ?>> English </option>
					<option value="AFRIKAANS" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'AFRIKAANS'): ?>selected<?php endif; ?>> Afrikaans </option>
					<option value="TSONGA" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'TSONGA'): ?>selected<?php endif; ?>> Tsonga </option>
					<option value="SOTHO" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'SOTHO'): ?>selected<?php endif; ?>> Sotho (Southern seSotho) </option>
					<option value="TSWANA" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'TSWANA'): ?>selected<?php endif; ?>> Tswana </option>
					<option value="VENDA" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'VENDA'): ?>selected<?php endif; ?>> Venda </option>
					<option value="NDEBELE" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'NDEBELE'): ?>selected<?php endif; ?>> Ndebele </option>
					<option value="PEDI" <?php if ($this->_tpl_vars['examData']['exam_language'] == 'PEDI'): ?>selected<?php endif; ?>> Pedi (Northern Sotho) </option>
				</select>
				<?php if (isset ( $this->_tpl_vars['errorArray']['exam_language'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['exam_language']; ?>
</span><?php endif; ?>
			</td>
            <td colspan="2">
				<h4 class="error">Upload Document:</h4><br />
				<input type="file" name="examfile" id="examfile" />
				<?php if (isset ( $this->_tpl_vars['errorArray']['examfile'] )): ?><br /><span class="error"><?php echo $this->_tpl_vars['errorArray']['examfile']; ?>
</span><?php else: ?><br /><em>Only .pdf, .doc, .docx allowed</em><?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['examData'] )): ?><p class="success"><a href="/download/exam/<?php echo $this->_tpl_vars['examData']['exam_code']; ?>
" target="_blank">Download</a></p><?php endif; ?>
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
	document.forms.detailsForm.submit();					 
}

$(document).ready(function(){
	$( "#exam_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true
	});	
});
</script>
'; ?>

</body>
</html>