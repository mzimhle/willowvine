<?php /* Smarty version 2.6.20, created on 2014-06-24 17:33:39
         compiled from recruiter/jobs/edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'recruiter/jobs/edit.tpl', 145, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WillowVine | Edit Job Post - <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</title>
<meta name="description" content="Job Classified Adverts - Post a free job advert. Edit a job Post here - <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
 with job Reference <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
">
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
$("#areaMap_path").autocomplete(areas);
});
</script>
<style type="text/css">
	.error {font-size: 11px; color: red; width: 16em; float: left; }	
	.comment {font-size: 11px; color: #CA7316; margin-top: 5px;}
</style>
'; ?>

</head>
<body OnLoad="document.jobForm.job_title.focus();">
<div id="home">
	<div id="main">
<!-- Start Header -->
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<!-- End Header -->
<!-- Start Navigation -->
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<!-- End Navigation -->
<!-- Start Navigation -->
<div id="contnav">
	<p>
	<a href="/">Home</a> &nbsp; 
	<span class="dash">|</span> &nbsp; 
	<a href="/recruiter/">Recruiters</a> &nbsp; 	
	<span class="dash">|</span> &nbsp; 
	<a href="/jobs/post/">Post a free job</a>
	<span class="dash">|</span> &nbsp; 	
	<a href="#">Edit job post: <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</a>
	<span class="dash">|</span> &nbsp; 		
	</p>
</div>
<!-- End Navigation -->
		<div id="content">
			<div class="inleft">
				<p class="ptitle">Edit job post: <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</p><br /><br />
			</div><!-- ending of inleft -->
			<div class="clear"></div>
			<div class="adc">
				<img src="/images/adc_top.jpg" alt="" /><div class="clear"></div>
				<div class="adcc">
					<div class="inadc">
<form action="/recruiter/jobs/edit.php?post=<?php echo $this->_tpl_vars['jobReference']; ?>
&job=<?php echo $this->_tpl_vars['jobHashCode']; ?>
" method="post" name="jobForm" id="jobForm">
<p class="title brdr_btm">Complete the form to post your ad</p>
<input type="hidden" name="post" id="post" value="<?php echo $this->_tpl_vars['jobReference']; ?>
" />
<input type="hidden" name="job" id="job" value="<?php echo $this->_tpl_vars['jobHashCode']; ?>
" />

<div style="position:relative;">
<table width="940" border="0" cellspacing="0" cellpadding="0" class="postad">
<tr>
	<td colspan="2"><span><image src="/images/staricon.gif" style="margin: 5px;"/></span> = <span style="font-size: 11px;"><?php if (isset ( $this->_tpl_vars['errorArray']['job_page'] )): ?><span style="color: red; font-weight: bold;">Required but have errors: Please enter correct information.</span><?php else: ?>required fields<?php endif; ?></span></td>
</tr>
	<tr>
		<td valign="top" width="470">
			<table>
  <tr>
	<td valign="top" width="140"><label for="jobTitle" <?php if (isset ( $this->_tpl_vars['errorArray']['job_title'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Job Title</label></td>
	<td valign="top" width="320">
		<input type="text" size="40" value="<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
" name="job_title" id="job_title" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">The job title / position.</span>
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_poster_name" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_name'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Contact Name</label></td>
	<td valign="top">
		<input type="text" size="40" value="<?php echo $this->_tpl_vars['jobData']['job_poster_name']; ?>
" name="job_poster_name" id="job_poster_name" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Your name, company name or agency name.</span>
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_poster_email" <?php if (isset ( $this->_tpl_vars['errorArray']['job_poster_email'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Contact Email</label></td>
		<td valign="top">
		<input type="text" size="40" value="<?php echo $this->_tpl_vars['jobData']['job_poster_email']; ?>
" name="job_poster_email" id="job_poster_email" class="frm" />
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Contact's email</span>
	</td>
  </tr>  
  <tr>
	<td valign="top"><label for="job_poster_number">Contact Number</label></td>
	<td valign="top"><input type="text" size="40" value="<?php echo $this->_tpl_vars['jobData']['job_poster_number']; ?>
" name="job_poster_number" id="job_poster_number" class="frm" />
		<div class="clear"></div>
		<span class="comment">Optional: Contact's number</span>		
	</td>
  </tr>    
  <tr>
	<td valign="top"><label for="areaMap_path" <?php if (isset ( $this->_tpl_vars['errorArray']['areaMap_path'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Town, Suburb or City</label></td>
	<td valign="top"><input type="text" name="areaMap_path" id="areaMap_path" value="<?php echo $this->_tpl_vars['jobData']['areaMap_path']; ?>
" size="60" /> 
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span>
		<div class="clear"></div>
		<span class="comment">Job City, town or suburb (Select from the provided list)</span>		
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_type">Job Type</label></td>
	<td valign="top">
		<select name="job_type" id="job_type" class="frm">
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
		<div class="clear"></div>
		<span class="comment">What type of employment contract</span>		
	</td>
  </tr>
  <tr>
	<td valign="top"><label for="job_AdType">Advert By</label></td>
	<td valign="top">
		<select name="job_AdType" id="job_AdType" class="frm">
			<option value="" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == ''): ?>SELECTED<?php endif; ?>>- Not Specified -</option>
			<option value="company" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'company'): ?>SELECTED<?php endif; ?>>Company</option>
			<option value="agency" <?php if ($this->_tpl_vars['jobData']['job_AdType'] == 'agency'): ?>SELECTED<?php endif; ?>>Agency</option>
		</select>
	</td>
  </tr>  
  <tr>
	<td valign="top"><label for="fk_section_id" <?php if (isset ( $this->_tpl_vars['errorArray']['fk_section_id'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Category</label></td>
	<td valign="top">
		<select name="fk_section_id" id="fk_section_id" class="frm">
			<option value="">- Category Type -</option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sectionOptions'],'selected' => $this->_tpl_vars['jobData']['fk_section_id']), $this);?>

		</select>
		<span><image src="/images/staricon.gif" style="margin: 5px;"/></span></td>
  </tr>      			
			</table>
			
		</td>
			<td valign="top" width="470">
			<span <?php if (isset ( $this->_tpl_vars['errorArray']['job_page'] )): ?>style="color: red; font-weight: bold;"<?php endif; ?>>Description: </span><span><image src="/images/staricon.gif" style="margin: 5px;"/></span><br /><br />
			<textarea name="job_page" id="job_page" style="width: 470px; height: 400px;"><?php echo $this->_tpl_vars['jobData']['job_page']; ?>
</textarea><br /><br />
</td> 
	</tr>
  <tr>
	<td valign="top" colspan="2">
		<table>
			<tr>
				<td>
					<label for="job_address" class="fl">Optional: Address of the job's location, e.g. Street name, suburb, city/town.  (To show on Google Maps for directions)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br><br>
					<input type="text" value="<?php echo $this->_tpl_vars['jobData']['job_address']; ?>
" name="job_address" id="job_address" class="fr required" style="background:url(/images/ininput_long.jpg) no-repeat scroll 0 0 transparent; width:577px;"/>
					<div class="clear"></div>
					<span class="comment fr">Only make selection from the appearing drop-down after typing</span>
					<input type="hidden" name="google_map_reference" id="google_map_reference" value="<?php echo $this->_tpl_vars['jobData']['google_map_reference']; ?>
" />
				</td>
			</tr>
		</table>
	</td>	
  </tr>	
<tr>
	<td colspan="2" align="right">
			<a href="/jobs/post/"><img src="/images/recruiter/create_another_btn.gif" alt="1 - Create Another Ad" width="206" height="39" /></a>
		<a href="JavaScript:preview();" class="mrg_left5"><img src="/images/save.jpg" alt="2 - Preview" /></a>
	</td>
</tr>
  </table>
</table>
</div>

</form>
					</div><!-- ending of inadc -->
				</div><!-- ending of adcc --><div class="clear"></div>
				<img src="/images/adc_bottom.jpg" alt="" />
			</div><!-- ending of adc -->
		</div><!-- content -->
	</div><!-- main -->
</div><!-- home --><div class="clear"></div>
<div id="footerarea">
	<div id="footer">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script language="JavaScript" type="text/javascript">
function preview() {
		nicEditors.findEditor(\'job_page\').saveContent();	
		document.forms.jobForm.submit();
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
			maxHeight : \'500\'
		}).panelInstance(\'job_page\');
});
</script>
'; ?>

	</div><!-- footer -->
</div><!-- footerarea -->
</body>
</html>