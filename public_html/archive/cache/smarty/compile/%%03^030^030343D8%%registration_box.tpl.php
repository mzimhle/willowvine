<?php /* Smarty version 2.6.20, created on 2015-02-01 12:45:40
         compiled from includes/registration_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'includes/registration_box.tpl', 3, false),)), $this); ?>
<div id="side_box" class="myform">
<?php if (! isset ( $this->_tpl_vars['userData'] )): ?>
<form id="jobSeekerForm" name="jobSeekerForm" method="post" action="<?php echo ((is_array($_tmp=@$this->_tpl_vars['currentLink'])) ? $this->_run_mod_handler('default', true, $_tmp, "/") : smarty_modifier_default($_tmp, "/")); ?>
" enctype="multipart/form-data" >
<a class="standard_blue_btn fr" title="Login into your willowvine account to edit your CV" href="Javascript:showLogin();">
	<span id="Login">LOGIN</span>								
</a>
<h1>Register your CV</h1>
<p>Register your CV so that we can send it to recruiters who are interested or have job/career openings on your behalf.</p>
<?php if (isset ( $this->_tpl_vars['jobSeekerRegister_success'] )): ?>
<span style="color: green;">
	<b>Thank you, "<?php echo $this->_tpl_vars['registerData']['jobSeeker_name']; ?>
" for registering your CV, please check your email ("<?php echo $this->_tpl_vars['registerData']['jobSeeker_email']; ?>
") for confirmation.</b>
</span>
<?php else: ?>
<label>Name<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_name'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "Please tell us your name.") : smarty_modifier_default($_tmp, "Please tell us your name.")); ?>
</span></label>
<input type="text" name="jobSeeker_name" id="jobSeeker_name" value="<?php echo $this->_tpl_vars['registerData']['jobSeeker_name']; ?>
"/>

<label>Email<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_email'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeeker_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "Add a valid address.") : smarty_modifier_default($_tmp, "Add a valid address.")); ?>
</span></label>
<input type="text" name="jobSeeker_email" id="jobSeeker_email" value="<?php echo $this->_tpl_vars['registerData']['jobSeeker_email']; ?>
" />

<label>Password<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_password'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>>So you can login.</span></label>
<input type="password" name="jobSeeker_password" id="jobSeeker_password" value="<?php echo $this->_tpl_vars['registerData']['jobSeeker_password']; ?>
" />

<label>Confirm Password<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeeker_password'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?> >Make sure you remember it.</span></label>
<input type="password" name="jobSeeker_password_2" id="jobSeeker_password_2" value="<?php echo $this->_tpl_vars['registerData']['jobSeeker_password_2']; ?>
" />

<label>Your Area/Town<span class="small" <?php if (isset ( $this->_tpl_vars['errorMessages']['areaName'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['areaName'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Where you live') : smarty_modifier_default($_tmp, 'Where you live')); ?>
</span></label>
<input type="text" id="areaName" name="areaName" class="ininput" value="<?php echo $this->_tpl_vars['registerData']['areaName']; ?>
"/>

<label <?php if (isset ( $this->_tpl_vars['errorMessages']['jobSeekerCV'] )): ?>class="error"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorMessages']['jobSeekerCV'])) ? $this->_run_mod_handler('default', true, $_tmp, 'CV Upload') : smarty_modifier_default($_tmp, 'CV Upload')); ?>

	<span class="small">
		<img src="/images/doc_small.png" alt="Upload your microsoft word CV." title="Upload your microsoft word CV." />
		<img src="/images/pdf_small.png" alt="Upload PDF CV." title="Upload PDF CV." />
		<img src="/images/txt_small.png" alt="Upload Text document CV." title="Upload Text document CV." />
	</span>
</label>
<input type="file" name="jobSeekerCV" id="jobSeekerCV" />
<a class="standard_blue_btn fl" title="Register my CV on willowvine" href="Javascript:document.forms.jobSeekerForm.submit();">
	<span id="Login">Add my CV please</span>								
</a>
<?php endif; ?>
<div class="spacer"></div>
</form>
<?php else: ?>
	<h1><?php echo $this->_tpl_vars['userData']['jobSeeker_name']; ?>
 <?php echo $this->_tpl_vars['userData']['jobSeeker_surname']; ?>
</h1>
	<p><?php echo $this->_tpl_vars['userData']['areaMap_shortPath']; ?>
</p>
	<span><?php echo $this->_tpl_vars['userData']['jobSeeker_email']; ?>
</span><br><br>
	<span><?php echo $this->_tpl_vars['userData']['jobSeeker_description']; ?>
</span>
<?php endif; ?>
</div>	
<div class="clear"></div>