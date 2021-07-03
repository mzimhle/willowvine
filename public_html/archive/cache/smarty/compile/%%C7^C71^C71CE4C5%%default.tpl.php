<?php /* Smarty version 2.6.20, created on 2015-01-31 15:00:47
         compiled from blog/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'blog/default.tpl', 36, false),array('modifier', 'trim', 'blog/default.tpl', 38, false),array('modifier', 'strip_tags', 'blog/default.tpl', 43, false),array('modifier', 'truncate', 'blog/default.tpl', 43, false),array('modifier', 'date_format', 'blog/default.tpl', 46, false),array('modifier', 'count', 'blog/default.tpl', 80, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Blog with latest jobs</title>
<meta name="description" content="willowvine blog with latest jobs" />
<meta name="keywords" content="blog, blog posts, south african jobs,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body OnLoad="document.search_for_jobs.searchJob.focus();">
<div id="container">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Blog</span>
		<span>|</span> &nbsp; 
		<span>Latest willowvine jobs</span>			
	</p>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_jobs.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<h1>
	Blog
</h1>
<div class="left_content">
		<span class="descr_text">
			These are the latest jobs that have been added, please feel free to search for your appropriate job and apply for it.
		</span>		
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
/?searchArea=<?php echo $this->_tpl_vars['searchArea']; ?>
&searchJob=<?php echo $this->_tpl_vars['searchJob']; ?>
&sectionId=<?php echo $this->_tpl_vars['sectionId']; ?>
&page=<?php echo $this->_tpl_vars['paginator']->current; ?>
" style="text-decoration: none;">
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
	<div class="clear"></div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>
	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/registration_box.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<br><br>
		<?php if (count($this->_tpl_vars['jobItems']) > 0): ?>	
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/internships_side.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<br><br>		
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/facebook_wall.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
		
		<?php endif; ?>
		
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>