<?php /* Smarty version 2.6.20, created on 2015-02-01 05:09:02
         compiled from internships/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'internships/default.tpl', 5, false),array('modifier', 'trim', 'internships/default.tpl', 6, false),array('modifier', 'escape', 'internships/default.tpl', 6, false),array('modifier', 'count', 'internships/default.tpl', 40, false),array('modifier', 'replace', 'internships/default.tpl', 62, false),array('modifier', 'normal_text', 'internships/default.tpl', 98, false),array('modifier', 'strip_tags', 'internships/default.tpl', 105, false),array('modifier', 'truncate', 'internships/default.tpl', 105, false),array('modifier', 'date_format', 'internships/default.tpl', 108, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Internships <?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?>in <?php echo $this->_tpl_vars['sectionInternshipData']['section_name']; ?>
<?php endif; ?> returned <?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 results, page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
 <?php if ($this->_tpl_vars['searchInternship'] != ""): ?> while searching for "<?php echo $this->_tpl_vars['searchInternship']; ?>
"<?php endif; ?></title>
<meta name="description" content="Willowvine internship search for <?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?><?php echo $this->_tpl_vars['sectionInternshipData']['section_name']; ?>
, <?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['searchInternship'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'any internships') : smarty_modifier_default($_tmp, 'any internships')))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 on willowvine and <?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 internship results, page <?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
 <?php if ($this->_tpl_vars['searchInternship'] != ''): ?> while searching for '<?php echo $this->_tpl_vars['searchInternship']; ?>
'<?php endif; ?>" />
<meta name="keywords" content="south african jobs, internships,south africa internships,jobs south africa,willowvine,willowvine,jobs,internships, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body OnLoad="document.search_for_internships.searchInternship.focus();">
<div id="container">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Internships</span>
		<?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?>
			<span>|</span> &nbsp; 
			<span class="green_text"><?php echo $this->_tpl_vars['sectionInternshipData']['section_name']; ?>
</span>
		<?php endif; ?>		
		<span>|</span> &nbsp; 
		<span>Searching for <span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['searchInternship'])) ? $this->_run_mod_handler('default', true, $_tmp, 'all internships') : smarty_modifier_default($_tmp, 'all internships')); ?>
"</span>		

	</p>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_internships.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<h1>
	Internships
</h1>
<div class="left_content width760">
		<span class="descr_text">
			Searching for <span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['searchInternship'])) ? $this->_run_mod_handler('default', true, $_tmp, "all internships / bursaries / scholarships") : smarty_modifier_default($_tmp, "all internships / bursaries / scholarships")); ?>
"</span> which brought back
			<span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
"</span> results you can choose to apply for.
			<?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?>These are internships for <span class="green_text"><?php echo $this->_tpl_vars['sectionInternshipData']['section_name']; ?>
.</span><?php endif; ?>
			Good luck!
		</span>
<?php if (count($this->_tpl_vars['internshipItems']) > 0): ?>		
	<!-- Pagination -->
	<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['paginator']->totalItemCount > 10): ?>
	<div class="clear"></div>
		<p class="pagination fr">
			<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
				<a class="prev-page" href="/internships/<?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?><?php echo $this->_tpl_vars['sectionInternshipData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->previous; ?>
&searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
">Previous</a>
			<?php endif; ?>	
				<?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
				<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['paginator']->current): ?>		
				<a class="page-num" href="/internships/<?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?><?php echo $this->_tpl_vars['sectionInternshipData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['page']; ?>
&searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
&searchArea=<?php echo $this->_tpl_vars['searchArea']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a>
				<?php else: ?>
				<strong class="current-page"><?php echo $this->_tpl_vars['page']; ?>
</strong>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<a class="next-page" href="/internships/<?php if (isset ( $this->_tpl_vars['sectionInternshipData'] )): ?><?php echo $this->_tpl_vars['sectionInternshipData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->next; ?>
&searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
">Next</a>
			<?php endif; ?>	
		</p>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>	
		<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

		<div class="clear"></div>
		<div class="fl">
		<?php echo '
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-3167387384914043";
			/* internship_side_banner */
			google_ad_slot = "8166804044";
			google_ad_width = 160;
			google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>	
			<div class="clear"></div><br /><br />
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-3167387384914043";
			/* internship_banner_2 */
			google_ad_slot = "0037365643";
			google_ad_width = 160;
			google_ad_height = 600;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>			
		'; ?>
		
		</div>
		<div class="internship_container fr">
		<?php $_from = $this->_tpl_vars['internshipItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
		<div class="search_item search_odd_<?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>blue<?php else: ?>dark<?php endif; ?>">
			<div class="title_box">
				<!--<a class="standard_blue_btn fr" title="View this internship - <?php echo $this->_tpl_vars['item']['internship_title']; ?>
" href="/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/?searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
&sectionId=<?php echo $this->_tpl_vars['sectionId']; ?>
&page=<?php echo $this->_tpl_vars['paginator']->current; ?>
">
					<span id="Login">View Internship</span>								
				</a> -->			
				<a style="color: #063166;" title="View this intnership, <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
's details" href="/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/?searchInternship=<?php echo $this->_tpl_vars['searchInternship']; ?>
&sectionId=<?php echo $this->_tpl_vars['sectionId']; ?>
&page=<?php echo $this->_tpl_vars['paginator']->current; ?>
" style="text-decoration: none;">			
					<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
</h2>					
					<span class="blue_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['section_name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
				</a>
			</div>
			<div class="clear"></div>
			<div class="search_desc">
				<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['internship_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300) : smarty_modifier_truncate($_tmp, 300)); ?>

				<div class="clear"></div>
				<br>
				<span class="fr"><b>Posted on the <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</b> <?php if ($this->_tpl_vars['item']['internship_area'] != ''): ?>in <b><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_area'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</b><?php endif; ?></span>
				<div class="clear"></div>
			</div>		
			<div class="share_btn">
			<ul>
				<li>
					<a href="https://twitter.com/share" class="twitter-share-button" data-text="Apply for this internship - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 at " data-related="willowvine" data-count="none">Share job</a>
					<?php echo '
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					'; ?>

				</li>
				<li>
					<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/sharer/sharer.php?u=http://www.willowvine.co.za/internships/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['internship_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
/');" title="Share this internship - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
">
						<img src="/images/facebook_share_up.png" title="Share this internship - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
					</a>			
				</li>	
				<li><a class="small_blue_bg_dark_btn fl" title="Share internship with a friend" alt="Share internship with a friend" href='Javascript:showShareInternship("<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
", <?php echo $this->_tpl_vars['item']['pk_internship_id']; ?>
);'><span id="share_job">Share this internship with a friend</span></a></li>						
			</ul>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		<?php echo $this->_smarty_vars['capture']['pagination']; ?>
		
		<!-- End Pagination -->
	</div>
	<?php else: ?>
	<div class="clear"></div><br>
		<span class="descr_text">
			There are no internships for your search criteria.
		</span>	
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php endif; ?>	
	</div>
	<div class="right_content">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/registration_box.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
		<br>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/facebook_wall.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
		<?php if (count($this->_tpl_vars['internshipItems']) > 0): ?>			
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php endif; ?>		
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>