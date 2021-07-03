<?php /* Smarty version 2.6.20, created on 2015-07-27 11:40:17
         compiled from internships/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'internships/default.tpl', 59, false),array('modifier', 'replace', 'internships/default.tpl', 89, false),array('modifier', 'normal_text', 'internships/default.tpl', 93, false),array('modifier', 'strip_tags', 'internships/default.tpl', 93, false),array('modifier', 'truncate', 'internships/default.tpl', 93, false),array('modifier', 'date_format', 'internships/default.tpl', 97, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Willowvine - Internships and bursaries</title>
<meta name="keywords" content="bursaries and internships, scholarships south africa">
<meta name="description" content="Willowvine has a range of internships and bursaries that students can apply for, we also have internships.">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - Internships and bursaries">
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
					<h1>Bursary Short list</h1>
				</div>
				<div class="infolist cf">
					<p>Make a list of all busaries you are interested in to view later on. If you are logged in, they will be available event after you log out and back in at a later stage.</p>
					<ul class="remove_pad_style" id="shortlist_ul">
						<?php $_from = $this->_tpl_vars['shortlistinternshipsdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fooshort'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fooshort']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['fooshort']['iteration']++;
?>
							<li id="short_<?php echo $this->_tpl_vars['item']['internship_code']; ?>
">
								<a href="#" onclick="removeShortlistinternship('<?php echo $this->_tpl_vars['item']['internship_code']; ?>
'); return false;" alt="Remove job" title="Remove job"><span class="fa fa-cog"></span></a>
								<a href="/job/<?php echo $this->_tpl_vars['item']['internship_url']; ?>
/<?php echo $this->_tpl_vars['item']['internship_code']; ?>
" alt="Shortlisted Bursary - <?php echo $this->_tpl_vars['item']['internship_name']; ?>
" title="Shortlisted Bursary - <?php echo $this->_tpl_vars['item']['internship_name']; ?>
"><?php echo $this->_tpl_vars['item']['internship_name']; ?>
</a>
							</li>
						<?php endforeach; else: ?>
						<span class="redhighlight">There are currently no shortlisted bursaries.</span>
						<?php endif; unset($_from); ?>
					</ul>										
				</div>				
			</div>		
			<div class="newsbox eachbox rightdarkborder">
				<div class="titles stitle">
					<h2>Filter</h2>
				</div>
				<div class="bigform bisform">
					<form action="/internships/" method="POST" role="form" name="formInternFilter" id="formInternFilter">
					   <label>By Title:</label>
					   <input type="text" class="form-control" id="filter_intern_name" name="filter_intern_name" value="<?php echo $this->_tpl_vars['filters']['filter_intern_name']; ?>
" />
					   <div class="clearboth"></div>
					   <label>By Category:</label>
					   <select class="form-control" id="filter_intern_category" name="filter_intern_category">
							<option value=""> --- </option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categorypairs'],'selected' => $this->_tpl_vars['filters']['filter_intern_category']), $this);?>

					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitInternFilter();" class="btn" name="btnInternFilter" id="btnInternFilter">Filter</button>
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
</span> internships in <span class="redhighlight"><?php echo $this->_tpl_vars['paginator']->pageCount; ?>
</span> pages that have been found. <?php if (isset ( $this->_tpl_vars['filters']['filter_intern_name'] )): ?>Searching for <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['filter_intern_name']; ?>
"</span></i>.<?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['intern_category']['category_name'] )): ?>Category being searched for is the <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['intern_category']['category_name']; ?>
</span></i>.<?php endif; ?></p>
				<?php ob_start(); ?>				
				<?php if ($this->_tpl_vars['paginator']->firstPageInRange != $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
						  <li><a href="/internships/<?php echo $this->_tpl_vars['paginator']->previous; ?>
"><span class="fa fa-chevron-left"></span></a></li>
						  <?php endif; ?>
						  <?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
						  <li <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['paginator']->current): ?> class="active" <?php endif; ?>><a href="/internships/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
						  <?php endforeach; endif; unset($_from); ?>
						  <?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
						  <li><a href="/internships/<?php echo $this->_tpl_vars['paginator']->next; ?>
"><span class="fa fa-chevron-right"></span></a></li>
						  <?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>
				<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

				<?php $_from = $this->_tpl_vars['internshipItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
				<dl class="cf <?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>dldark<?php else: ?>dllight<?php endif; ?>">
					<dt><a href="/internship/<?php echo $this->_tpl_vars['item']['internship_url']; ?>
/<?php echo $this->_tpl_vars['item']['internship_code']; ?>
"><?php echo $this->_tpl_vars['item']['internship_name']; ?>
</a></dt>
					<dd><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['internship_page'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300) : smarty_modifier_truncate($_tmp, 300)); ?>
</dd>
					<dd><span class="bluehighlight"><?php echo $this->_tpl_vars['item']['internship_company']; ?>
</span></dd>
					<dd><b><?php echo $this->_tpl_vars['item']['category_name']; ?>
</b></dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Added"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/internship/<?php echo $this->_tpl_vars['item']['internship_url']; ?>
/<?php echo $this->_tpl_vars['item']['internship_code']; ?>
');" title="Share this internship on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['item']['internship_company']; ?>
">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine internship - <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['item']['internship_company']; ?>
" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share internship with a friend" alt="Share internship with a friend" href='#' onclick="showInternShare('<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['internship_name'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 by <?php echo $this->_tpl_vars['item']['internship_company']; ?>
', '<?php echo $this->_tpl_vars['item']['internship_code']; ?>
'); return false;">
								<span id="share_internship">Share with a friend</span>								
							</a>
						</span>	
						<span class="fl<?php if (in_array ( $this->_tpl_vars['item']['internship_code'] , $this->_tpl_vars['shortlistinternships'] )): ?> hide<?php endif; ?>" style="margin-left: 5px;" data-toggle="tooltip" title="Add to my shortlist" id="shortinternship_<?php echo $this->_tpl_vars['item']['internship_code']; ?>
">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Shortlist job" alt="Shortlist job" href='#' onclick="shortlistInternship('<?php echo $this->_tpl_vars['item']['internship_code']; ?>
', '<?php echo $this->_tpl_vars['item']['internship_name']; ?>
', '/internship/<?php echo $this->_tpl_vars['item']['internship_url']; ?>
/<?php echo $this->_tpl_vars['item']['internship_code']; ?>
'); return false;">
								<span id="share_internship">Shortlist</span>								
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
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/register.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
	
        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>