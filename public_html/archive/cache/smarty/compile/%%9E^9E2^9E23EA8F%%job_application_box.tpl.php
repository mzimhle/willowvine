<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:47
         compiled from includes/job_application_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'includes/job_application_box.tpl', 2, false),array('modifier', 'count', 'includes/job_application_box.tpl', 19, false),)), $this); ?>
<div id="side_box" class="myform">
<form id="jobApplicationForm" name="jobApplicationForm" method="post" action="<?php echo ((is_array($_tmp=@$this->_tpl_vars['currentLink'])) ? $this->_run_mod_handler('default', true, $_tmp, "/") : smarty_modifier_default($_tmp, "/")); ?>
" enctype="multipart/form-data" >
<h1>Apply below</h1>
<p>Fill in the below details to apply for this post, please remember to add your CV.</p>
<?php if (isset ( $this->_tpl_vars['jobApplication_success'] )): ?>
<span style="color: green;">
	<b>Thank you, "<?php echo $this->_tpl_vars['applicationData']['jobApplication_name']; ?>
" applying for this post, please check your email ("<?php echo $this->_tpl_vars['applicationData']['jobApplication_email']; ?>
") for confirmation of application.</b>
</span>
<?php else: ?>
<label>Fullname<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobApplication_name'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobApplication_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "Your name and surname.") : smarty_modifier_default($_tmp, "Your name and surname.")); ?>
</span></label>
<input type="text" name="jobApplication_name" id="jobApplication_name" value="<?php if (isset ( $this->_tpl_vars['userData']['jobSeeker_name'] )): ?><?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>
<?php else: ?><?php echo $this->_tpl_vars['application']['jobApplication_name']; ?>
<?php endif; ?>"/>

<label>Email<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobApplication_email'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobApplication_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "Add a valid address.") : smarty_modifier_default($_tmp, "Add a valid address.")); ?>
</span></label>
<input type="text" name="jobApplication_email" id="jobApplication_email" value="<?php if (isset ( $this->_tpl_vars['userData']['jobSeeker_email'] )): ?><?php echo $this->_tpl_vars['userData']['jobSeeker_email']; ?>
<?php else: ?><?php echo $this->_tpl_vars['application']['jobApplication_email']; ?>
<?php endif; ?>" />

<label>Message<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobApplication_comments'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?> ><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobApplication_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Add motivation message') : smarty_modifier_default($_tmp, 'Add motivation message')); ?>
</span></label>
<textarea name="jobApplication_comments" id="jobApplication_comments"><?php echo $this->_tpl_vars['application']['jobApplication_comments']; ?>
</textarea>

<?php if (! isset ( $this->_tpl_vars['userData']['cv'] ) && count($this->_tpl_vars['userData']['cv']) == 0): ?>
<label <?php if (isset ( $this->_tpl_vars['errorMessages']['applicationCV1'] )): ?>class="error"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['applicationCV1'])) ? $this->_run_mod_handler('default', true, $_tmp, 'CV Upload') : smarty_modifier_default($_tmp, 'CV Upload')); ?>

	<span class="small">
		<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
		<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
		<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
	</span>
</label>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['userData']['cv'] ) && count($this->_tpl_vars['userData']['cv']) > 0): ?>
<label <?php if (isset ( $this->_tpl_vars['errorMessages']['userCV'] )): ?>class="error"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['userCV'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Select your CV') : smarty_modifier_default($_tmp, 'Select your CV')); ?>

</label>	
	<div class="fl">
	<?php $_from = $this->_tpl_vars['userData']['cv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cvs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cvs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cvs']['iteration']++;
?>										
			<input type="radio" style="float: none; margin: 5px; width: 16px;" name="userCV" id="userCV" value="<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
"><?php echo $this->_tpl_vars['item']['jobSeekerCV_userName']; ?>

			<a href="/job_seeker/account/download.php?cv=<?php echo $this->_tpl_vars['item']['jobSeekerCV_filename']; ?>
" alt="Download CV to view" class="orange_text" style="text-decoration: none;">(View)</a>
			<br>
	<?php endforeach; endif; unset($_from); ?>
	</div>
<?php else: ?>
<input type="file" name="applicationCV1" id="applicationCV1" />
<?php endif; ?>
<div class="clear"></div>	
<a class="standard_blue_btn fl" title="Apply for this job" href="Javascript:document.forms.jobApplicationForm.submit();">
	<span id="Login">Apply for this job</span>								
</a>
<?php endif; ?>
<div class="spacer"></div>
</form>
</div>	
<div class="clear"></div>