<?php /* Smarty version 2.6.20, created on 2015-02-01 12:45:38
         compiled from jobs/search/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'jobs/search/default.tpl', 5, false),array('modifier', 'default', 'jobs/search/default.tpl', 5, false),array('modifier', 'count', 'jobs/search/default.tpl', 39, false),array('modifier', 'replace', 'jobs/search/default.tpl', 61, false),array('modifier', 'normal_text', 'jobs/search/default.tpl', 66, false),array('modifier', 'strip_tags', 'jobs/search/default.tpl', 73, false),array('modifier', 'truncate', 'jobs/search/default.tpl', 73, false),array('modifier', 'date_format', 'jobs/search/default.tpl', 76, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine jobs in <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['location'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'South Africa') : smarty_modifier_default($_tmp, 'South Africa')); ?>
 | <?php if (isset ( $this->_tpl_vars['sectionData'] )): ?> Search for <?php echo $this->_tpl_vars['sectionData']['section_name']; ?>
 jobs <?php endif; ?><?php if ($this->_tpl_vars['searchJob'] != ''): ?> "<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['searchJob'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'escape') : smarty_modifier_default($_tmp, 'escape')); ?>
" jobs and <?php endif; ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 results are shown in page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
</title>
<meta name="description" content="WillowVine jobs in <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['location'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'South Africa') : smarty_modifier_default($_tmp, 'South Africa')); ?>
 |<?php if (isset ( $this->_tpl_vars['sectionData'] )): ?> Search for <?php echo $this->_tpl_vars['sectionData']['section_name']; ?>
 jobs <?php endif; ?><?php if ($this->_tpl_vars['searchJob'] != ''): ?> '<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['searchJob'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'escape') : smarty_modifier_default($_tmp, 'escape')); ?>
' jobs and <?php endif; ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 results are shown in page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" />
<meta name="keywords" content="south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/auto_complete.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script type="text/javascript">
$().ready(function() {
$("#areaName").autocomplete(areas);
$("#searchJob").autocomplete(jobs);
});
</script>
'; ?>

<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div class="clear"></div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php if ($this->_tpl_vars['jobShareCount'] > 0): ?>	
<a class="standard_blue_btn fr" style="margin-top: 5px;" title="View my shortlisted jobs" href="/jobs/shortlist/">
	<span id="Login">View my Shortlist (<?php echo $this->_tpl_vars['jobShareCount']; ?>
)</span>								
</a>	
<?php endif; ?>
<div class="clear"></div>
<div class="sub_container_left">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/filter_jobs_right.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<div class="sub_container_right"><br />
<div class="clear"></div>
<div class="left_content">
<?php if (count($this->_tpl_vars['jobItems']) > 0): ?>		
	<!-- Pagination -->
	<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['paginator']->totalItemCount > 10): ?>
	<div class="clear"></div>
	<p class="pagination fr">
		<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
			<a class="prev-page" href="/jobs/search/<?php if (isset ( $this->_tpl_vars['sectionData'] )): ?><?php echo $this->_tpl_vars['sectionData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->previous; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>">Previous</a>
		<?php endif; ?>	
			<?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
			<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['paginator']->current): ?>		
			<a class="page-num" href="/jobs/search/<?php if (isset ( $this->_tpl_vars['sectionData'] )): ?><?php echo $this->_tpl_vars['sectionData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['page']; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['page']; ?>
</a>
			<?php else: ?>
			<strong class="current-page"><?php echo $this->_tpl_vars['page']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
			<a class="next-page" href="/jobs/search/<?php if (isset ( $this->_tpl_vars['sectionData'] )): ?><?php echo $this->_tpl_vars['sectionData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->next; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?>">Next</a>
		<?php endif; ?>	
	</p>
	<?php endif; ?>
	<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>	
	<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

	<div class="clear"></div>	
	<?php $_from = $this->_tpl_vars['jobItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
	<div class="search_item search_odd_<?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>blue<?php else: ?>dark<?php endif; ?>">
		<div class="title_box">
			<a style="color: #063166;" title="View this job, <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
's details" href="/jobs/search/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['job_link']; ?>
/<?php echo $this->_tpl_vars['item']['job_reference']; ?>
/?page=<?php echo $this->_tpl_vars['paginator']->current; ?>
<?php if ($this->_tpl_vars['searchJob'] != ''): ?>&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['type'] != ''): ?>&type=<?php echo $this->_tpl_vars['type']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['area'] != ''): ?>&area=<?php echo $this->_tpl_vars['area']; ?>
<?php endif; ?><?php if (isset ( $this->_tpl_vars['sectionData'] )): ?>&sectionId=<?php echo $this->_tpl_vars['sectionData']['pk_section_id']; ?>
<?php endif; ?>" style="text-decoration: none;">
				<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
</h2>	
				<span class="blue_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['section_name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="search_desc">
			<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['job_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300) : smarty_modifier_truncate($_tmp, 300)); ?>

			<div class="clear"></div>
			<br>
			<span class="fr"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</b> in <b><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</b></span>
			<div class="clear"></div>
		</div>		
		<div class="share_btn">
		<ul>
			<li>
				<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/jobs/search/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['job_link']; ?>
/<?php echo $this->_tpl_vars['item']['job_reference']; ?>
/');" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
">
					<img src="/images/facebook_share_up.png" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
				</a>
			</li>
			<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="Job available - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 at " data-related="willowvine" data-count="none">Share job</a>
				<?php echo '
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				'; ?>

			</li>
			<li>
				<a class="small_blue_bg_dark_btn fl" title="Share job or career with a friend" alt="Share job or career with a friend" href='Javascript: showShare("<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 in  <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
", <?php echo $this->_tpl_vars['item']['job_reference']; ?>
);'>
					<span id="share_job">Share this job</span>								
				</a>
			</li>
			<?php if ($this->_tpl_vars['item']['shortlist'] == 0): ?>
			<li>
				<a class="small_blue_bg_dark_btn fr" title="Share job or career with a friend" alt="Share job or career with a friend" href="<?php if ($this->_tpl_vars['item']['shortlist'] == 0): ?>Javascript:shortList(<?php echo $this->_tpl_vars['item']['job_reference']; ?>
);<?php else: ?>/jobs/shortlist/<?php endif; ?>">
					<span id="share_job">Add to shortlist (<?php echo $this->_tpl_vars['jobShareCount']; ?>
)</span>								
				</a>				
			</li>
			<?php endif; ?>			
		</ul>
		</div>
		<div class="clear"></div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	<?php echo $this->_smarty_vars['capture']['pagination']; ?>
		
	<!-- End Pagination -->
	<?php else: ?>
	<div class="clear"></div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php endif; ?>
	</div>
	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/registration_box.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<br><br>
		<?php if (count($this->_tpl_vars['jobItems']) > 0): ?>	
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/internships_side.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php endif; ?>
		
	</div>
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>