<?php /* Smarty version 2.6.20, created on 2015-07-27 14:41:40
         compiled from careers/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'careers/details.tpl', 38, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - <?php echo $this->_tpl_vars['careerData']['career_name']; ?>
</title>
<meta name="keywords" content="list careers, job, career path">
<meta name="description" content="Willowvine has a list of careers to read up on and learn about like <?php echo $this->_tpl_vars['careerData']['career_name']; ?>
">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - <?php echo $this->_tpl_vars['careerData']['career_name']; ?>
">
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
    	<div class="col-xs-12 col-md-8 db-gutter-right">
			<div class="newsbox eachbox no-gutter-left">
				<div class="titles htitle">
					<h1><?php echo $this->_tpl_vars['careerData']['career_name']; ?>
</h1>
				</div>				
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">
					<dd class="iconbox">
						<span class="fl redhighlight " style="margin-right: 5px;"  data-toggle="tooltip" title="Career Category"><?php echo $this->_tpl_vars['careerData']['category_name']; ?>
</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/career/<?php echo $this->_tpl_vars['careerData']['career_url']; ?>
/<?php echo $this->_tpl_vars['careerData']['career_code']; ?>
');" title="Share this career on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['careerData']['career_company']; ?>
">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine career - <?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['careerData']['career_company']; ?>
" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share career with a friend" alt="Share career with a friend" href='#' onclick="showCareerShare('<?php echo ((is_array($_tmp=$this->_tpl_vars['careerData']['career_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
', '<?php echo $this->_tpl_vars['careerData']['career_code']; ?>
'); return false;">
								<span id="share_career">Share with a friend</span>								
							</a>
						</span>										
					</dd>												
					<div class="clearboth"></div>		
				<?php echo $this->_tpl_vars['careerData']['career_page']; ?>

				<div class="clearboth"></div>
				<p class="bissubhead">Education</p>
				<?php echo $this->_tpl_vars['careerData']['career_education']; ?>
				
				<div class="clearboth"></div>
				<p class="bissubhead">Contact for assistance</p>
				<?php echo $this->_tpl_vars['careerData']['career_contact']; ?>
						
            </div>

        </div>
        <div class="col-xs-12 col-md-4 no-gutter-left">		
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/register.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>