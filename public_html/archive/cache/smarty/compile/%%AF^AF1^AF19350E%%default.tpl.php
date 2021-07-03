<?php /* Smarty version 2.6.20, created on 2015-01-31 21:26:20
         compiled from careers/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'careers/default.tpl', 5, false),array('modifier', 'trim', 'careers/default.tpl', 6, false),array('modifier', 'escape', 'careers/default.tpl', 6, false),array('modifier', 'count', 'careers/default.tpl', 34, false),array('modifier', 'replace', 'careers/default.tpl', 56, false),array('modifier', 'normal_text', 'careers/default.tpl', 89, false),array('modifier', 'strip_tags', 'careers/default.tpl', 96, false),array('modifier', 'truncate', 'careers/default.tpl', 96, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WillowVine | Careers <?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?>in <?php echo $this->_tpl_vars['sectionCareerData']['section_name']; ?>
<?php endif; ?> returned <?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 results</title>
<meta name="description" content="Willowvine career search for <?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?><?php echo $this->_tpl_vars['sectionCareerData']['section_name']; ?>
, <?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['searchCareer'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'any careers') : smarty_modifier_default($_tmp, 'any careers')))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 on willowvine and <?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 career results" />
<meta name="keywords" content="south african jobs, careers,south africa careers,jobs south africa,willowvine,willowvine,jobs,careers, Cape Town, East London, Port Elizabeth, Johannesburg, Durban, Polokwane, Bloemfontein, Pretoria" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/css.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/javascript.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body OnLoad="document.search_for_careers.searchCareer.focus();">
<div id="container">
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/navigation.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div id="contnav" class="fl">
	<p class="fl">
		<a href="/">Home</a> &nbsp; 	
		<span>|</span> &nbsp; 
		<span>Careers</span>
		<span>|</span> &nbsp; 
		<span>Searching for <span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['searchCareer'])) ? $this->_run_mod_handler('default', true, $_tmp, 'all careers') : smarty_modifier_default($_tmp, 'all careers')); ?>
"</span>			
	</p>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/search_careers.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<h1>
	Careers
</h1>
<div class="left_content width760">
		<span class="descr_text">
			Searching for <span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['searchCareer'])) ? $this->_run_mod_handler('default', true, $_tmp, 'all careers') : smarty_modifier_default($_tmp, 'all careers')); ?>
"</span> which brought back
			<span class="green_text">"<?php echo ((is_array($_tmp=@$this->_tpl_vars['paginator']->totalItemCount)) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
"</span> different career results you can choose to learn about. 
			<?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?>Jobs for the <span class="green_text"><?php echo $this->_tpl_vars['sectionCareerData']['section_name']; ?>
</span> category<?php endif; ?>
		</span>
<?php if (count($this->_tpl_vars['careerItems']) > 0): ?>		
	<!-- Pagination -->
	<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['paginator']->totalItemCount > 10): ?>
	<div class="clear"></div>
	<p class="pagination fr">
		<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
			<a class="prev-page" href="/careers/<?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?><?php echo $this->_tpl_vars['sectionCareerData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->previous; ?>
&searchCareer=<?php echo $this->_tpl_vars['searchCareer']; ?>
">Previous</a>
		<?php endif; ?>	
			<?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
			<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['paginator']->current): ?>		
			<a class="page-num" href="/careers/<?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?><?php echo $this->_tpl_vars['sectionCareerData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['page']; ?>
&searchCareer=<?php echo $this->_tpl_vars['searchCareer']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a>
			<?php else: ?>
			<strong class="current-page"><?php echo $this->_tpl_vars['page']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
			<a class="next-page" href="/careers/<?php if (isset ( $this->_tpl_vars['sectionCareerData'] )): ?><?php echo $this->_tpl_vars['sectionCareerData']['section_urlName']; ?>
/<?php endif; ?>?page=<?php echo $this->_tpl_vars['paginator']->next; ?>
&searchCareer=<?php echo $this->_tpl_vars['searchCareer']; ?>
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
	<?php $_from = $this->_tpl_vars['careerItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
	<div class="search_item search_odd_<?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>blue<?php else: ?>dark<?php endif; ?>">
		<div class="title_box">		
			<a style="color: #063166;" title="View this intnership, <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
's details" href="/careers/<?php echo $this->_tpl_vars['item']['section_urlName']; ?>
/details/<?php echo $this->_tpl_vars['item']['career_link']; ?>
/<?php echo $this->_tpl_vars['item']['pk_career_id']; ?>
/?searchCareer=<?php echo $this->_tpl_vars['searchCareer']; ?>
&sectionId=<?php echo $this->_tpl_vars['sectionId']; ?>
&page=<?php echo $this->_tpl_vars['paginator']->current; ?>
" style="text-decoration: none;">			
				<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
</h2>					
				<span class="blue_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['section_name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
</span>
			</a>
		</div>
		<div class="clear"></div>
		<div class="search_desc">
			<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['career_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300) : smarty_modifier_truncate($_tmp, 300)); ?>

			<div class="clear"></div>
		</div>		
		<div class="clear"></div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	</div>
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
	
		<br>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/facebook_wall.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
		<?php if (count($this->_tpl_vars['careerItems']) > 0): ?>			
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/side_ad_container.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php endif; ?>		
	</div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "includes/footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>

</body>
</html>