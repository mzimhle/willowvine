<?php /* Smarty version 2.6.20, created on 2014-06-24 16:37:06
         compiled from jobs/post/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'jobs/post/default.tpl', 47, false),array('function', 'html_options', 'jobs/post/default.tpl', 65, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Post a an advert | Add a Job Advert for free</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Add a new job and a CV will be sent to you should an applicant apply.">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, post a free job advert.">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script type="text/javascript" language="javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
<?php echo '
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
});
</script>
'; ?>

</head>
<body OnLoad="document.jobPostForm.job_title.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="contnav" class="fl">
		<p class="fl">
			<a href="/">Home</a> &nbsp; 	
			<span>|</span> &nbsp; 
			<span>Post a free Job Ad</span>	
		</p>
	</div>
	<div class="clear"></div>	
	<h1>
		Post a free Job Ad	
	</h1>
	<span>Post a job advert for FREE, applicants will send you a message and an attachment of their cv when the apply.</span>
	<br><br>
	<div class="clear"></div>
	<div class="left_content width_470">
		<?php if (isset ( $this->_tpl_vars['postJob_success'] )): ?>
		<div style="margin: 0px; margin-bottom: 20px; color: green; font-weight: bold; font-size: 14px" class="myform width_430" id="side_box">
			"<?php echo $this->_tpl_vars['postJob_success']['job_title']; ?>
" in "<?php echo $this->_tpl_vars['postJob_success']['job_area']; ?>
" Ad has been saved, check contact email for confirmation.
		</div>		
		<?php endif; ?>
		<div id="side_box" class="myform width_430" style="margin: 0;" >
		<form id="jobPostForm" name="jobPostForm" method="post" action="/jobs/post/" >
		<p>Required<img src="/images/required_dot.png" style="margin-bottom: 7px;" /></p>
		<label>Job Title<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['job_title'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['job_title'])) ? $this->_run_mod_handler('default', true, $_tmp, "Job or position title.") : smarty_modifier_default($_tmp, "Job or position title.")); ?>
</span></label>
		<input type="text" name="job_title" id="job_title" class="width_225" value="<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
"/>

		<label>Contact Name<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_name'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['job_poster_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "Contact, agency or company name") : smarty_modifier_default($_tmp, "Contact, agency or company name")); ?>
</span></label>
		<input type="text" name="job_poster_name" id="job_poster_name" class="width_225" value="<?php echo $this->_tpl_vars['jobData']['job_poster_name']; ?>
" />

		<label>Contact Email<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_email'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['job_poster_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "Valid email address.") : smarty_modifier_default($_tmp, "Valid email address.")); ?>
</span></label>
		<input type="text" name="job_poster_email" id="job_poster_email" class="width_225" value="<?php echo $this->_tpl_vars['jobData']['job_poster_email']; ?>
" />

		<label>Contact Number<span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_number'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?> ><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['job_poster_number'])) ? $this->_run_mod_handler('default', true, $_tmp, "Contact's number") : smarty_modifier_default($_tmp, "Contact's number")); ?>
</span></label>
		<input type="text" name="job_poster_number" id="job_poster_number" class="width_225" value="<?php echo $this->_tpl_vars['jobData']['job_poster_number']; ?>
" />

		<label>Job Area/Town<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['areaName'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['areaName'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Where the job is') : smarty_modifier_default($_tmp, 'Where the job is')); ?>
</span></label>
		<input type="text" id="areaName" name="areaName" class="width_225" value="<?php echo $this->_tpl_vars['jobData']['areaName']; ?>
"/>

		<label>Category<img src="/images/required_dot.png" style="margin-bottom: 7px;" /><span class="small" <?php if (isset ( $this->_tpl_vars['errorArray']['fk_section_id'] )): ?>style="color: red;font-weight: bold;"<?php endif; ?> >Whow posted the this job</span></label>
		<select name="fk_section_id" id="fk_section_id" class="small">
			<option value="">- Category Type -</option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sectionOptions'],'selected' => $this->_tpl_vars['jobData']['fk_section_id']), $this);?>

		</select>
		
		<label>Job Type<span class="small">What type of employment contract</span></label>
		<select name="job_type" id="job_type" class="small">
			<option value="" <?php if ($this->_tpl_vars['jobData']['job_type'] == ''): ?>SELECTED<?php endif; ?>>- Not Specified -</option>
			<option value="casual" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'casual'): ?>SELECTED<?php endif; ?>>Casual</option>
			<option value="temp" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'temp'): ?>SELECTED<?php endif; ?>>Temporary</option>
			<option value="contract" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'contract'): ?>SELECTED<?php endif; ?>>Contract</option>
			<option value="parttime" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'parttime'): ?>SELECTED<?php endif; ?>>Part-Time</option>
			<option value="permanent" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'permanent'): ?>SELECTED<?php endif; ?>>Permanent</option>
			<option value="graduate" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'graduate'): ?>SELECTED<?php endif; ?>>Graduate</option>
			<option value="internship" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'internship'): ?>SELECTED<?php endif; ?>>Internship</option>
			<option value="volunteer" <?php if ($this->_tpl_vars['jobData']['job_type'] == 'volunteer'): ?>SELECTED<?php endif; ?>>Volunteer</option>
		</select>
		
		<label>Advert By<span class="small">Whow posted the this job</span></label>
		<select name="job_AdType" id="job_AdType" class="small">
			<option value="" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == ''): ?>SELECTED<?php endif; ?>>- Not Specified -</option>
			<option value="company" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'company'): ?>SELECTED<?php endif; ?>>Company</option>
			<option value="agency" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'agency'): ?>SELECTED<?php endif; ?>>Agency</option>
		</select>
		
		<a class="standard_blue_btn fl" title="Add job advert" href="javascript:savePost();">
			<span id="Login">Post/Add Job</span>								
		</a>	
		<div class="spacer"></div>		
		</div>	
		<br>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/right_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
			
	</div>			
	<div class="right_content width_550" style="float: left;">
		<div id="side_box" class="myform width_520" style="margin: 0;" >					
		<label style="text-align: left; width: 430px;">Show on Map<span class="small" style="text-align: left; width: 430px;">Show job's town, area or address on google maps for directions, only select from the given list</span></label>
		<div class="clear"></div>	
		<br>		
		<input type="text" style="width: 480px; margin: auto;" id="job_address" name="job_address" class="width_430" value="<?php echo $this->_tpl_vars['jobData']['job_address']; ?>
"/>
		<input type="hidden" name="google_map_reference" id="google_map_reference" value="<?php echo $this->_tpl_vars['jobData']['google_map_reference']; ?>
" />
		<div class="clear"></div>
		<br>		
		<label style="text-align: left;">Description<img src="/images/required_dot.png" style="margin-bottom: 7px;" />
			<span class="small"  style="text-align: left; width: 430px;" <?php if (isset ( $this->_tpl_vars['errorArray']['job_page'] )): ?>style="color: red;font-weight: bold; text-align: left;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['errorArray']['job_page'])) ? $this->_run_mod_handler('default', true, $_tmp, "Job's details") : smarty_modifier_default($_tmp, "Job's details")); ?>
</span></label>
		<div class="clear"></div>
		<br>
		<textarea id="job_page" name="job_page" style="width: 500px; height: 490px;"><?php echo $this->_tpl_vars['jobData']['job_page']; ?>
</textarea> 
		<div class="clear"></div>
		</form>
		</div>			
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script language="JavaScript" type="text/javascript">
function savePost() {
		nicEditors.findEditor(\'job_page\').saveContent();	
		document.forms.jobPostForm.submit();
}

jQuery(document).ready(function() {
	function initialize() {

		var input = document.getElementById(\'job_address\');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.setTypes([]);
		
		/* Get reference of the selected area. */
		google.maps.event.addListener(autocomplete, \'place_changed\', function() {
			var place = autocomplete.getPlace();
			$(\'#google_map_reference\').val(place.reference);
		});
	}
	google.maps.event.addDomListener(window, \'load\', initialize);
	
	
    var input = document.getElementById(\'job_address\');
    var autocomplete = new google.maps.places.Autocomplete(input);
	jQuery(function() {
		jQuery(\'.popUp\').hover(
			function () {
				jQuery(this).find(\'span.pop\').css(\'top\',(jQuery(this).position().top - 80));
				jQuery(this).find(\'span.pop\').css(\'left\',(jQuery(this).position().left - 45));
				jQuery(this).find(\'span.pop\').show();
			},
			function () {
				jQuery(this).find(\'span.pop\').hide();
			}
		);
	});
	
		new nicEditor({
			iconsPath : \'/library/javascript/nicedit/nicEditorIcons.gif\',
			buttonList : [\'bold\',\'italic\',\'underline\',\'ol\',\'indent\',\'outdent\',\'center\', \'right\',\'left\',\'link\',\'unlink\',\'fontFormat\'],
			maxHeight : \'500\',
		}).panelInstance(\'job_page\');
});
</script>
'; ?>

</body>
</html>