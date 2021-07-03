<?php /* Smarty version 2.6.20, created on 2015-02-01 13:59:16
         compiled from exams/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'exams/default.tpl', 40, false),array('modifier', 'replace', 'exams/default.tpl', 70, false),array('modifier', 'lower', 'exams/default.tpl', 73, false),array('modifier', 'ucfirst', 'exams/default.tpl', 73, false),array('modifier', 'date_format', 'exams/default.tpl', 74, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Business Lounge - Tenders, Trade Leads, Business Listings and Jobs</title>
<meta name="keywords" content="business, tenders, business listings, entrepreneurs, exams">
<meta name="description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, exams and more prospects to grow your business...">          
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Business Lounge"> 
<meta property="og:image" content="http://www.bizlounge.co.za/images/logo.png"> 
<meta property="og:url" content="http://www.bizlounge.co.za">
<meta property="og:site_name" content="Business Lounge">
<meta property="og:type" content="website">
<meta property="og:description" content="Business Lounge offers business opportunities to corporates, entrepreneurs and SME’s from South Africa. Covering tenders, trade leads, business listings, exams and more prospects to grow your business.">
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
					<form action="/exams/" method="POST" role="form" name="formExamFilter" id="formExamFilter">
					   <label>By Name:</label>
					   <input type="text" class="form-control" id="filter_exam_name" name="filter_exam_name" value="<?php echo $this->_tpl_vars['filters']['filter_exam_name']; ?>
" />
					   <div class="clearboth"></div>
					   <label>By Subject:</label>
					   <select class="form-control" id="filter_exam_subject" name="filter_exam_subject">
							<option value=""> --- </option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['subjectpairs'],'selected' => $this->_tpl_vars['filters']['filter_exam_subject']), $this);?>

					   </select>					   
					   <div class="clearboth"></div>
					   <button onclick="submitExamFilter();" class="btn" name="btnExamFilter" id="btnExamFilter">Filter</button>
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
</span> exams in <span class="redhighlight"><?php echo $this->_tpl_vars['paginator']->pageCount; ?>
</span> pages that have been found. <?php if (isset ( $this->_tpl_vars['filters']['filter_exam_name'] )): ?>Searching for <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['filter_exam_name']; ?>
"</span></i>.<?php endif; ?><?php if (isset ( $this->_tpl_vars['filters']['exam_subject']['subject_name'] )): ?>Category being searched for is the <i><span class="redhighlight">"<?php echo $this->_tpl_vars['filters']['exam_subject']['subject_name']; ?>
</span></i>.<?php endif; ?></p>
				<?php ob_start(); ?>				
				<?php if ($this->_tpl_vars['paginator']->firstPageInRange != $this->_tpl_vars['paginator']->lastPageInRange): ?>
				<div class="pagibox">
					<ul class="pagination pagination-sm">
						<?php if ($this->_tpl_vars['paginator']->current > 1): ?>
						  <li><a href="/exams/<?php echo $this->_tpl_vars['paginator']->previous; ?>
"><span class="fa fa-chevron-left"></span></a></li>
						  <?php endif; ?>
						  <?php $_from = $this->_tpl_vars['paginator']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
						  <li <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['paginator']->current): ?> class="active" <?php endif; ?>><a href="/exams/<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
						  <?php endforeach; endif; unset($_from); ?>
						  <?php if ($this->_tpl_vars['paginator']->current < $this->_tpl_vars['paginator']->lastPageInRange): ?>
						  <li><a href="/exams/<?php echo $this->_tpl_vars['paginator']->next; ?>
"><span class="fa fa-chevron-right"></span></a></li>
						  <?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php $this->_smarty_vars['capture']['pagination'] = ob_get_contents(); ob_end_clean(); ?>
				<?php echo ((is_array($_tmp=$this->_smarty_vars['capture']['pagination'])) ? $this->_run_mod_handler('replace', true, $_tmp, '?&amp;', '?') : smarty_modifier_replace($_tmp, '?&amp;', '?')); ?>

				<?php $_from = $this->_tpl_vars['examItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
				<dl class="cf <?php if (!(1 & ($this->_foreach['foo']['iteration']-1))): ?>dldark<?php else: ?>dllight<?php endif; ?>">
					<dt><?php if (isset ( $this->_tpl_vars['participantloginData'] )): ?><a href="/download/exam/<?php echo $this->_tpl_vars['item']['exam_code']; ?>
" target="blank"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )</a><?php else: ?><a data-target="#loginbox" data-toggle="modal" href="#"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )</a><?php endif; ?></dt>
					<dd><span class="bluehighlight"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
</span> exam in <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['exam_language'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
. Exam date was in <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['exam_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B, %Y") : smarty_modifier_date_format($_tmp, "%B, %Y")); ?>
.</dd>
					<dd class="iconbox">
						<span class="minicons pdate" data-toggle="tooltip" title="Date Exam"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['exam_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B, %Y") : smarty_modifier_date_format($_tmp, "%B, %Y")); ?>
</span>						
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/exams/');" title="Share this exam on facebook: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )">
							<img src="/images/facebook_share_up.png" title="Share this exam on facebook: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine exam - <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share exam with a friend" alt="Share exam with a friend" href='#' onclick="showExamShare('<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['subject_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 - <?php echo $this->_tpl_vars['item']['exam_name']; ?>
 - ( download )', '<?php echo $this->_tpl_vars['item']['exam_code']; ?>
'); return false;">
								<span id="share_exam">Share with a friend</span>								
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