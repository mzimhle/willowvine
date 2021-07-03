<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:47
         compiled from jobs/search/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'jobs/search/details.tpl', 34, false),array('modifier', 'trim', 'jobs/search/details.tpl', 43, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ref. <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
, <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
, jobs in <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php if ($this->_tpl_vars['page'] != ''): ?>, on page <?php echo $this->_tpl_vars['page']; ?>
<?php endif; ?></title>
<meta name="description" content="Ref. <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
, <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
, jobs in <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
<?php if ($this->_tpl_vars['page'] != ''): ?>, "" <?php echo $this->_tpl_vars['page']; ?>
<?php endif; ?>">
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
, <?php echo $this->_tpl_vars['jobData']['section_name']; ?>
,  <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div class="clear"></div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<br />
	<a class="standard_blue_btn fr" title="Go back to your search results" href="/jobs/search/<?php if (isset ( $this->_tpl_vars['sectionData'] )): ?><?php echo $this->_tpl_vars['sectionData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['page']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>">
		<span id="Login">Back to your search</span>								
	</a>
	<h1>
		<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
	
	</h1>

	<span class="blue_text"><?php echo $this->_tpl_vars['jobData']['section_name']; ?>
</span><br>
	<span><?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</span>

	<div class="clear"></div>
	<div class="left_content width760">
			<br>
			<div class="share_btn border_top">
				<ul>
					<li>
					<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/');" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
">
						<img src="/images/facebook_share_up.png" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
					</a>
					</li>
					<li><a href="https://twitter.com/share" class="twitter-share-button" data-text="Job available - <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 at " data-related="willowvine" data-count="none">Share job</a>
					<?php echo '
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					'; ?>

					</li>
					<li><a class="small_blue_bg_dark_btn fl" title="Share job or career with a friend" alt="Share job or career with a friend" href='Javascript: showShare("<?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 in  <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
", <?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
);'><span id="share_job">Share this job</span></a></li>
					<li><a class="small_blue_bg_dark_btn fr" title="Add this job to short list" alt="Add this job to short list" href="<?php if ($this->_tpl_vars['jobData']['shortlist'] == 0): ?>Javascript:shortList(<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
);<?php else: ?>/jobs/shortlist/<?php endif; ?>"><span id="share_job"><?php if ($this->_tpl_vars['jobData']['shortlist'] == 0): ?>Shortlist this job<?php else: ?>View my shortlist<?php endif; ?> (<?php echo $this->_tpl_vars['jobShareCount']; ?>
)</span></a></li>			
				</ul>
			</div>
			<div class="clear"></div>
			<span class="default_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_page'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			<br><br>
			<div class="map_image_container">
				<a href="/jobs/search/<?php echo $this->_tpl_vars['jobData']['section_urlName']; ?>
/directions/<?php echo $this->_tpl_vars['jobData']['job_link']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_reference']; ?>
/?page=<?php echo $this->_tpl_vars['page']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if (isset ( $this->_tpl_vars['sectionData'] )): ?>&sectionId=<?php echo $this->_tpl_vars['sectionData']['pk_section_id']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>">
					<span class="blue_text">View directions on a map</span><br><br>				
					<img class="map_image" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
&zoom=14&size=540x200&sensor=false" alt="jobs in <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
" title="jobs in <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
" width="730" height="250" />
				</a>
			</div>			
			<div class="clear"></div>			
	</div>			
	<div class="right_content">
			<?php if ($this->_tpl_vars['jobData']['job_poster_email'] != ''): ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/job_application_box.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
			<?php endif; ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>