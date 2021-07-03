<?php /* Smarty version 2.6.20, created on 2015-02-01 14:47:25
         compiled from careers/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'careers/default.tpl', 40, false),array('modifier', 'replace', 'careers/default.tpl', 70, false),array('modifier', 'normal_text', 'careers/default.tpl', 74, false),array('modifier', 'strip_tags', 'careers/default.tpl', 74, false),array('modifier', 'truncate', 'careers/default.tpl', 74, false),array('modifier', 'date_format', 'careers/default.tpl', 78, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Career list</title>
<meta name="keywords" content="list careers, job, career path">
<meta name="description" content="Willowvine has a list of careers to read up on and learn about.">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine has a list of careers to read up on and learn about">
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
			<div class="newsbox eachbox rightdarkborder">
				<div class="titles stitle">
					<h2>Filter</h2>
				</div>
				<div class="bigform bisform">
					<form action="/careers/" method="POST" role="form" name="formCareerFilter" id="formCareerFilter">
					   <label>By Title:</label>
					   <input type="text" class="form-control" id="filter_career_name" name="filter_career_name" value="<?php echo $this->_tpl_vars['filters']['filter_career_name']; ?>
" />
					   <div class="clearboth"></div>
					   <label>By Category:</label>
					   <select class="form-control" id="filter_career_category" name="filter_career_category">
							<option value=""> --- </option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categorypairs'],'selected' => $this->_tpl_vars['filters']['filter_career_category']), $this);?>

					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitCareerFilter();" class="btn" name="btnCareerFilter" id="btnCareerFilter">Filter</button>
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
</span> careers in <span class="redhighlight"><?php echo $this->_tpl_vars['paginator']->pageCount; ?>
</span> pages that have been found. <?php if (isset ( $this->_tpl_vars['filters']['filter_career_name'] )): ?>Searching for <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['filter_career_name']; ?>
"</span></i>.<?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['career_category']['category_name'] )): ?>Category being searched for is the <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['career_category']['category_name']; ?>
</span></i>.<?php endif; ?></p>
				<?php ob_start(); ?>				
				<?php if ($this->_tpl_vars['paginator']->firstPageInRange != $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
						  <li><a href="/careers/<?php echo $this->_tpl_vars['paginator']->previous; ?>
"><span class="fa fa-chevron-left"></span></a></li>
						  <?php endif; ?>
						  <?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
						  <li <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['paginator']->current): ?> class="active" <?php endif; ?>><a href="/careers/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
						  <?php endforeach; endif; unset($_from); ?>
						  <?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
						  <li><a href="/careers/<?php echo $this->_tpl_vars['paginator']->next; ?>
"><span class="fa fa-chevron-right"></span></a></li>
						  <?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>
				<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

				<?php $_from = $this->_tpl_vars['careerItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
				<dl class="cf <?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>dldark<?php else: ?>dllight<?php endif; ?>">
					<dt><a href="/career/<?php echo $this->_tpl_vars['item']['career_url']; ?>
/<?php echo $this->_tpl_vars['item']['career_code']; ?>
"><?php echo $this->_tpl_vars['item']['career_name']; ?>
</a></dt>
					<dd><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['career_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300) : smarty_modifier_truncate($_tmp, 300)); ?>
</dd>
					<dd><span class="bluehighlight"><?php echo $this->_tpl_vars['item']['career_company']; ?>
</span></dd>
					<dd><b><?php echo $this->_tpl_vars['item']['category_name']; ?>
</b></dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Added"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/career/<?php echo $this->_tpl_vars['item']['career_url']; ?>
/<?php echo $this->_tpl_vars['item']['career_code']; ?>
');" title="Share this career on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['item']['career_company']; ?>
">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine career - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['item']['career_company']; ?>
" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share career with a friend" alt="Share career with a friend" href='#' onclick="showCareerShare('<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
', '<?php echo $this->_tpl_vars['item']['career_code']; ?>
'); return false;">
								<span id="share_career">Share with a friend</span>								
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
			<div class="newsbox eachbox no-gutter-left">
				<div class="titles stitle">
					<h2>Register with us</h2>
				</div>
				<div class="bigform bisform" id="registrationform">
					<form action="/" method="POST" role="form" name="bismsg" id="bismsg">
						<label>Name:</label>
						<input type="text" value="" class="form-control" id="participant_name" name="participant_name" />
						<label>Surname:</label>
						<input type="text" value="" class="form-control" id="participant_surname" name="participant_surname" />
						<label>Email:</label>
						<input type="text" value="" class="form-control" id="participant_email" name="participant_email" />
						<label>Your area:</label>
						<input type="text" value="" class="form-control" id="areapost_name" name="areapost_name" />						
						<input id="areapost_code" type="hidden" value="" name="areapost_code" />
						<button class="btn btn-md btn-save" name="submitRegistrationForm" id="submitRegistrationForm">Register</button>
						<div class="clearboth"></div>
						Or you can register using either Facebook, LinkedIn or your gmail account by clicking one of the buttons below.
						<p style="text-align: center;">
							<button class="btn btn-md btn-view bluebox1" onclick="fb_login(); return false;">
								<span style="font-size: 18px;" class="fa fa-facebook-square"></span>&nbsp;&nbsp; Facebook
							</button>&nbsp;&nbsp;
							<button class="btn btn-md btn-view bluebox2" onclick="link('/registration/includes/linkedin/'); return false;">
								<span style="font-size: 18px;" class="fa fa-linkedin-square"></span>&nbsp;&nbsp; LinkedIn
							</button>&nbsp;&nbsp;
							<button class="btn btn-md btn-view bluebox3" onclick="link('/registration/includes/google/'); return false;">
								<span style="font-size: 18px;" class="fa fa-google-plus-square"></span>&nbsp;&nbsp; Google+
							</button>
						</p>						
					</form>
				</div>
			</div>
        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>