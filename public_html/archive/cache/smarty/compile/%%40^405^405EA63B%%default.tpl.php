<?php /* Smarty version 2.6.20, created on 2015-01-01 14:58:37
         compiled from job_seeker/account/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'job_seeker/account/default.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Willowvine | Job Seeker Account | <?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>
</title>
<meta name="description" content="Register for jobs, search find, Only jobs and careers in your area, city or town." />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="default.js"></script>
</head>
<body>
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Account</span>	
			<span>|</span> &nbsp; 
			<span>Job Seeker</span>				
			<span>|</span> &nbsp; 
			<span class="green_text"><?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>
</span>							
		</p>
	</div>
	<div class="clear"></div>	
	<h1>
		<?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>

	</h1>
	<span class="blue_text"><?php echo $this->_tpl_vars['userData']['areaMap_path']; ?>
</span>
	<br><br>
	<div class="clear"></div>
	<div class="left_content" style="width: 545px;">
		<?php if (isset ( $this->_tpl_vars['updateSuccess'] )): ?>
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px; width: 500px;" class="myform" id="side_box">
			Your details have been updated successfully.
		</div>		
		<?php endif; ?>
		<div id="side_box" class="myform" style="margin: 0; width: 500px;" >
		<form id="jobSeekerForm" name="jobSeekerForm" method="post" action="/job_seeker/account/" >
		<h1>Personal Details</h1>
		<p>Update your personal and contact details below</p>
		<label>Name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_name'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'First name') : smarty_modifier_default($_tmp, 'First name')); ?>
</span></label>
		<input type="text" name="jobSeeker_name" id="jobSeeker_name" class="width_280" value="<?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
"/>

		<label>Surname<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_surname'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_surname'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Contact number please') : smarty_modifier_default($_tmp, 'Contact number please')); ?>
</span></label>
		<input type="text" name="jobSeeker_surname" id="jobSeeker_surname" class="width_280" value="<?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>
" />
		
		<label>Email<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_email'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "Valid email address.") : smarty_modifier_default($_tmp, "Valid email address.")); ?>
</span></label>
		<input type="text" name="jobSeeker_email" id="jobSeeker_email" class="width_280" value="<?php echo $this->_tpl_vars['userData']['jobSeeker_email']; ?>
" />
		<?php if ($this->_tpl_vars['userData']['fb_user_id'] == '' && $this->_tpl_vars['userData']['twitter_uid'] == ''): ?>
		<label>Password<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_password'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_password'])) ? $this->_run_mod_handler('default', true, $_tmp, "Your password please.") : smarty_modifier_default($_tmp, "Your password please.")); ?>
</span></label>
		<input type="text" name="jobSeeker_password" id="jobSeeker_password" class="width_280" value="<?php echo $this->_tpl_vars['userData']['jobSeeker_password']; ?>
" />
		<?php endif; ?>
		<label>Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['areaMap_path'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['areaMap_path'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Where do you live') : smarty_modifier_default($_tmp, 'Where do you live')); ?>
</span></label>
		<input type="text" id="areaMap_path" name="areaMap_path" class="width_280" value="<?php echo $this->_tpl_vars['userData']['areaMap_path']; ?>
"/>
		
		<label>Describe yourself<span class="small" >Market yourself to recruiters</span></label>
		<textarea id="jobSeeker_description" name="jobSeeker_description" cols="80" rows="10" class="width_280"><?php echo $this->_tpl_vars['userData']['jobSeeker_description']; ?>
</textarea>
		<div class="clear"></div>
		<label>Job Alerts<span class="small"><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['areaMap_path'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Where do you live') : smarty_modifier_default($_tmp, 'Where do you live')); ?>
</span></label>
		<select name="jobSeeker_alerts" id="jobSeeker_alerts" class="small" style="width: 50px;">
			<option value="1" <?php if ($this->_tpl_vars['userData']['jobSeeker_alerts'] == 1): ?>SELECTED<?php endif; ?>>Yes</option>
			<option value="0" <?php if ($this->_tpl_vars['userData']['jobSeeker_alerts'] == 0): ?>SELECTED<?php endif; ?>>No</option>
		</select>
		<div class="clear"></div>
		<a class="standard_blue_btn fr" title="Add job advert" href="javascript:document.forms.jobSeekerForm.submit()">
			<span id="Login">Update My Details</span>								
		</a>	
		</form>
		<div class="spacer"></div>		
		</div>
		<div class="clear"></div>
		<br>		
		<div id="side_box" class="myform" style="margin: 0; width: 500px;" >
		<h1>Jobs You Applied For</h1><p></p>
		<div class="applied_container" id="applied_container"></div>
		</div>		
	</div>			
	<div class="right_content" style="width: 455px;">		
		<div id="side_box" class="myform" style="margin: 0; width: 422px;" >
			<h1>My CV's</h1>
			<p>Add or delete your CV's below</p>
			<table width="422px" border="0" cellspacing="0" cellpadding="0">
			  <?php $_from = $this->_tpl_vars['userData']['cv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cvs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cvs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cvs']['iteration']++;
?>
				<tr>			  
					<td width="auto" style="border-bottom: 1px solid #E9E6E0;">	
						<br>
						<?php echo $this->_foreach['cvs']['iteration']; ?>
. <?php echo $this->_tpl_vars['item']['jobSeekerCV_userName']; ?>
&nbsp;&nbsp;&nbsp;
						<a href="/job_seeker/account/download.php?cv=<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
">(download)</a>&nbsp;&nbsp;<a href="/job_seeker/account/delete.php?cv=<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
">(delete)</a>																			
						<br>	
						<input type="hidden" name="cvName" id="cvName" value="<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
" />
						<input type="hidden" name="cvId" id="cvId" value="<?php echo $this->_tpl_vars['item']['pk_jobSeekerCV_id']; ?>
" />	
						<div class="clear"></div>
						<br>
					</td>
				 </tr>
				<?php endforeach; else: ?>
				<tr>
					<td width="auto" style="color: red; border-bottom: 1px solid #E9E6E0;">	
						You have not uploaded a any CV.
					</td>
				</tr>
				<?php endif; unset($_from); ?>									
			</table>
			<br>
			<p>Upload another CV, remember maximun is 3 CV's and each should be less than 1Mb</p>
			<form action="/job_seeker/account/" method="post" name="upload" id="upload" enctype="multipart/form-data">
			<label>Upload CV
				<span class="small">
					<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
					<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
					<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
				</span>
			</label>
			<input type="file" name="jobSeekerCV" id="jobSeekerCV" />	
			<br>
			<span class="fr error"><?php echo $this->_tpl_vars['uploadErrorMessages']['jobSeekerCV']; ?>
</span>
			<a class="standard_blue_btn fl" title="Update CV sections" href="JavaScript:document.forms.upload.submit();">
				<span id="UpdateCV">Upload CV</span>								
			</a>	
			</form>
			<div class="spacer"></div>
		</div>
		<div class="clear"></div>
		<br>		
		<div id="side_box" class="myform" style="margin: 0; width: 422px;" >
			<h1>Your Shortlisted jobs</h1><p></p>
			<div id="shortlist_container" name="shortlist_container"></div>
		</div>
	</div>	
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
</div>

<?php echo '
<script language="JavaScript" type="text/javascript">
function enquiryFormSubmit() {
	document.forms.enquiryForm.submit();
}

$().ready(function() { $("#areaMap_path").focus().autocomplete(areas); });
</script>
'; ?>

</body>
</html>