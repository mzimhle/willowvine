<?php /* Smarty version 2.6.20, created on 2015-02-01 14:49:01
         compiled from default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'default.tpl', 87, false),array('modifier', 'capitalize', 'default.tpl', 100, false),array('modifier', 'replace', 'default.tpl', 118, false),array('modifier', 'normal_text', 'default.tpl', 122, false),array('modifier', 'strip_tags', 'default.tpl', 122, false),array('modifier', 'truncate', 'default.tpl', 122, false),array('modifier', 'date_format', 'default.tpl', 125, false),array('modifier', 'trim', 'default.tpl', 138, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Jobs, bursaries, careers and previous exam papers all in one place.</title>
<meta name="keywords" content="jobs, careers, exam papers, career advise. south african jobs, part time">
<meta name="description" content="Willowvine offers job opportunities to students, the unemployed as well as those who need a new job or work part time in from South Africa. We also offer advice on career paths, cv writing and previous exam papers.">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - Jobs, bursaries, careers and previous exam papers all in one place.">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/menu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<section class="container">
	<div class="row">
    	<div class="col-xs-12 col-md-3">
        	<!-- /// short list box /// -->
			<div class="tenderbox eachbox rightdarkborder">		
				<div class="titles">
					<h1>Job Short list</h1>
				</div>				
				<div class="infolist cf">
					<p>Make a list of all jobs you are interested in to view/apply for later on. If you are logged in, they will be available event after you log out and back in at a later stage.</p>
					<ul class="remove_pad_style" id="shortlist_ul">
						<?php $_from = $this->_tpl_vars['shortlistdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fooshort'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fooshort']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['fooshort']['iteration']++;
?>
							<li id="short_<?php echo $this->_tpl_vars['item']['job_code']; ?>
">
								<a href="#" onclick="removeShortlistjob('<?php echo $this->_tpl_vars['item']['job_code']; ?>
'); return false;" alt="Remove job" title="Remove job"><span class="fa fa-cog"></span></a>
								<a href="/job/<?php echo $this->_tpl_vars['item']['job_url']; ?>
/<?php echo $this->_tpl_vars['item']['job_code']; ?>
" alt="Shortlisted job - <?php echo $this->_tpl_vars['item']['job_title']; ?>
" title="Shortlisted job - <?php echo $this->_tpl_vars['item']['job_title']; ?>
"><?php echo $this->_tpl_vars['item']['job_title']; ?>
</a>
							</li>
						<?php endforeach; else: ?>
						<span class="redhighlight">There are currently no shortlisted jobs.</span>
						<?php endif; unset($_from); ?>
					</ul>										
				</div>				
			</div>
			<div class="newsbox eachbox rightdarkborder">
				<div class="titles stitle">
					<h2>Filter</h2>
				</div>
				<div class="bigform bisform">
					<form action="/" method="POST" role="form" name="formFilter" id="formFilter">
					   <label>By Title:</label>
					   <input type="text" class="form-control" id="filter_title" name="filter_title" value="<?php echo $this->_tpl_vars['filters']['filters_title']; ?>
" />
					   <label>By Type:</label><br />
					   <input type="checkbox" class="form-control" name="filter_type[]" value="permanent" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'permanent' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Permanent
					   <div class="clearboth"></div>
					   <input type="checkbox" class="form-control" name="filter_type[]" value="contract" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'contract' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Contract
					   <div class="clearboth"></div>
					   <input type="checkbox" class="form-control" name="filter_type[]" value="temp" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'temp' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Temporary
					   <div class="clearboth"></div>					   
					   <input type="checkbox" class="form-control" name="filter_type[]" value="parttime" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'parttime' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Part Time
					   <div class="clearboth"></div>
					   <input type="checkbox" class="form-control" name="filter_type[]" value="graduate" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'graduate' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Graduate
					   <div class="clearboth"></div>
					   <input type="checkbox" class="form-control" name="filter_type[]" value="casual" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'casual' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Casual
					   <div class="clearboth"></div>
					   <input type="checkbox" class="form-control" name="filter_type[]" value="internship" <?php if (isset ( $this->_tpl_vars['filters']['filters_type'] ) && in_array ( 'internship' , $this->_tpl_vars['filters']['filters_type'] )): ?> checked <?php endif; ?> />Internship
					   <div class="clearboth"></div>
					   <label>By Province:</label>
					   <select class="form-control" id="filter_province" name="filter_province">
							<option value=""> --- </option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Eastern Cape'): ?> selected <?php endif; ?> value="Eastern Cape">Eastern Cape</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Free State'): ?> selected <?php endif; ?>  value="Free State">Free State</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Gauteng'): ?> selected <?php endif; ?> value="Gauteng">Gauteng</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'KwaZulu-Natal'): ?> selected <?php endif; ?> value="KwaZulu-Natal">KwaZulu-Natal</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Limpopo'): ?> selected <?php endif; ?> value="Limpopo">Limpopo</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Mpumalanga'): ?> selected <?php endif; ?> value="Mpumalanga">Mpumalanga</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'North West'): ?> selected <?php endif; ?> value="North West">North West</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Northern Cape'): ?> selected <?php endif; ?> value="Northern Cape">Northern Cape</option>
							<option <?php if ($this->_tpl_vars['filters']['filters_province'] == 'Western Cape'): ?> selected <?php endif; ?> value="Western Cape">Western Cape</option>
					   </select>
					   <div class="clearboth"></div>
					   <label>By Category:</label>
					   <select class="form-control" id="filter_category" name="filter_category">
							<option value=""> --- </option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categorypairs'],'selected' => $this->_tpl_vars['filters']['filters_category']), $this);?>

					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitFilter();" class="btn" name="btnFilter" id="btnFilter">Filter</button>
					   <button class="btn btn-md btn-save fr" onclick="clearFilter();" name="btnFilter">Clear</button>
					</form>
				</div>
			</div>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/ad_long_horizontal.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

        </div>	
    	<div class="col-xs-12 col-md-5 db-gutter-right">
			<!-- /// TENDER BOX /// -->
			<div class="tenderbox eachbox">
				<p style="font-size: 14px !important;">There are <span class="redhighlight"><?php echo $this->_tpl_vars['paginator']->totalItemCount; ?>
</span> jobs in <span class="redhighlight"><?php echo $this->_tpl_vars['paginator']->pageCount; ?>
</span> pages that have been found. <?php if (isset ( $this->_tpl_vars['filters']['filters_title'] )): ?>Searching for <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['filters_title']; ?>
"</span></i>.<?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['category']['category_name'] )): ?>Category being searched for is the <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['category']['category_name']; ?>
</span></i>.<?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['type'] )): ?>Types being searched for <i><span class="redhighlight">"<?php echo ((is_array($_tmp=$this->_tpl_vars['filters']['type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
"</span></i>. <?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['filters_province'] )): ?>Province searched in is <i><span class="redhighlight">"<?php echo ((is_array($_tmp=$this->_tpl_vars['filters']['filters_province'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
"</span></i>.<?php endif; ?></p>
				<?php ob_start(); ?>				
				<?php if ($this->_tpl_vars['paginator']->firstPageInRange != $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
						  <li><a href="/jobs/<?php echo $this->_tpl_vars['paginator']->previous; ?>
"><span class="fa fa-chevron-left"></span></a></li>
						  <?php endif; ?>
						  <?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
						  <li <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['paginator']->current): ?> class="active" <?php endif; ?>><a href="/jobs/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
						  <?php endforeach; endif; unset($_from); ?>
						  <?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
						  <li><a href="/jobs/<?php echo $this->_tpl_vars['paginator']->next; ?>
"><span class="fa fa-chevron-right"></span></a></li>
						  <?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>
				<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

				<?php $_from = $this->_tpl_vars['jobItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
				<dl class="cf <?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>dldark<?php else: ?>dllight<?php endif; ?>">
					<dt><a href="/job/<?php echo $this->_tpl_vars['item']['job_url']; ?>
/<?php echo $this->_tpl_vars['item']['job_code']; ?>
"><?php echo $this->_tpl_vars['item']['job_title']; ?>
</a></dt>
					<dd><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['job_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 150) : smarty_modifier_truncate($_tmp, 150)); ?>
 in <?php echo $this->_tpl_vars['item']['job_area']; ?>
</dd>
					<dd><span class="bluehighlight"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span> - <b><?php echo $this->_tpl_vars['item']['category_name']; ?>
</b></dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Added"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/job/<?php echo $this->_tpl_vars['item']['job_url']; ?>
/<?php echo $this->_tpl_vars['item']['job_code']; ?>
');" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine job - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
						<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share job with a friend" alt="Share job with a friend" href='#' onclick="showShare('<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 in <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['areapost_name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
', '<?php echo $this->_tpl_vars['item']['job_code']; ?>
'); return false;">
							<span id="share_job">Share with a friend</span>								
						</a>
						</span>						
						<span class="fl<?php if (in_array ( $this->_tpl_vars['item']['job_code'] , $this->_tpl_vars['shortlist'] )): ?> hide<?php endif; ?>" style="margin-left: 5px;" data-toggle="tooltip" title="Add to my shortlist" id="shortjob_<?php echo $this->_tpl_vars['item']['job_code']; ?>
">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Shortlist job" alt="Shortlist job" href='#' onclick="shortlistJob('<?php echo $this->_tpl_vars['item']['job_code']; ?>
', '<?php echo $this->_tpl_vars['item']['job_title']; ?>
', '/job/<?php echo $this->_tpl_vars['item']['job_url']; ?>
/<?php echo $this->_tpl_vars['item']['job_code']; ?>
'); return false;">
								<span id="share_job">Shortlist</span>								
							</a>
						</span>											
					</dd>					
				</dl>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			<div class="clearboth"></div>
			<?php echo $this->_smarty_vars['capture']['pagination']; ?>

		</div>
        <div class="col-xs-12 col-md-4 no-gutter-left">
			<div class="eachbox visible-md visible-lg">
				<a href="http://www.willow-nettica.com/" target="_blank"><img src="/images/willow_ad.jpg" title="Willow-Nettica" alt="Willow-Nettica"></a>
			</div>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/register.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
			
        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>