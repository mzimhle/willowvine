<?php /* Smarty version 2.6.20, created on 2015-07-27 19:43:20
         compiled from details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'details.tpl', 35, false),array('modifier', 'trim', 'details.tpl', 46, false),array('modifier', 'capitalize', 'details.tpl', 60, false),array('modifier', 'date_format', 'details.tpl', 62, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</title>
<meta name="keywords" content="jobs, careers, exam papers, career advise. south african jobs, part time">
<meta name="description" content="Willowvine offers job opportunities to students like <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
.">       
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Willowvine"> 
<meta property="og:image" content="http://www.willowvine.co.za/images/logo.jpg"> 
<meta property="og:url" content="http://www.willowvine.co.za">
<meta property="og:site_name" content="Willowvine">
<meta property="og:type" content="website">
<meta property="og:description" content="Willowvine - <?php echo $this->_tpl_vars['jobData']['job_title']; ?>
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
					<h1><?php echo $this->_tpl_vars['jobData']['job_title']; ?>
</h1>
				</div>
				<div class="clearboth"></div>	
					<dd class="iconbox">				
						<span class="fl" data-toggle="tooltip" title="Facebook Share">
							<a href='javascript:void(0);' onclick="openWindow_fb_share('http://www.facebook.com/share.php?u=http://www.willowvine.co.za/job/<?php echo $this->_tpl_vars['jobData']['job_url']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
');" title="Share this job on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
">
							<img src="/images/facebook_share_up.png" title="Share this tender on facebook: <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" />
							</a>							
						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Twitter Share">
							<a href="https://twitter.com/share" class="twitter-share-button" data-text="@willowvine job - <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
" data-related="willowvine" data-count="none">Twitter Share</a>
							<?php echo '
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							'; ?>

						</span>
						<span class="fl" style="margin-left: 5px;" data-toggle="tooltip" title="Email to my friend">
						<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Share job with a friend" alt="Share job with a friend" href='#' onclick="showShare('<?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_title'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)); ?>
 in <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['areapost_name'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
', '<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
'); return false;">
							<span id="share_job">Share with a friend</span>								
						</a>
						</span>						
						<span class="fl<?php if (in_array ( $this->_tpl_vars['jobData']['job_code'] , $this->_tpl_vars['shortlist'] )): ?> hide<?php endif; ?>" style="margin-left: 5px;" data-toggle="tooltip" title="Add to my shortlist" id="shortjob_<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
">
							<a data-related="willowvine" data-count="none" class="small_blue_bg_dark_btn fl" title="Shortlist job" alt="Shortlist job" href='#' onclick="shortlistJob('<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
', '<?php echo $this->_tpl_vars['jobData']['job_title']; ?>
', '/job/<?php echo $this->_tpl_vars['jobData']['job_url']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
'); return false;">
								<span id="share_job">Shortlist</span>								
							</a>
						</span>											
					</dd>												
					<div class="clearboth"></div>				
				<div class="catlist infolist cf">
					<ul>
						<li><em>Industry:</em> <?php echo $this->_tpl_vars['jobData']['category_name']; ?>
</li>
						<li><em>Position Type:</em> <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</li>
						<li><em>City:</em> <?php echo $this->_tpl_vars['jobData']['job_area']; ?>
</li>
						<li><em>Date Posted:</em> <?php echo ((is_array($_tmp=$this->_tpl_vars['jobData']['job_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</li>
					</ul>
				</div>
			</div>		
        	<!-- /// LISTINGS BOX /// -->
			<div class="tenderboxe eachbox">			
				<?php echo $this->_tpl_vars['jobData']['job_page']; ?>

				<?php if ($this->_tpl_vars['jobData']['job_latitude'] != ''): ?>
				<p class="bissubhead">Job Location</p><!-- //// FOR FEATURED BUSINESS LISTINGS ONLY /// -->					
				<div class="bismap eachbox">
					<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $this->_tpl_vars['jobData']['job_latitude']; ?>
,<?php echo $this->_tpl_vars['jobData']['job_longitude']; ?>
&zoom=11&size=745x250" width="745" height="250" alt="<?php echo $this->_tpl_vars['jobData']['areapost_name']; ?>
" />
				</div>
				<?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 no-gutter-left">		
			<div class="tenderbox eachbox rightdarkborder">
				<div class="titles">
					<h1>Job Short list</h1>
				</div>
				<div class="infolist cf">
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
            <div class="newsbox eachbox no-gutter-left">
                <div class="titles stitle">
                    <h2>Send Application</h2>
                </div>
                <div class="bigform bisform">
					<?php if (isset ( $this->_tpl_vars['success'] )): ?>
						<p><b>Your enquiry has been successfully sent</b></p>
						<p>You will receive an email confirmation for it as well as your reference code for this enquiry</p>
					<?php else: ?>				
                    <form id="bismsg" name="bismsg" role="form" method="POST" action="/job/<?php echo $this->_tpl_vars['jobData']['job_url']; ?>
/<?php echo $this->_tpl_vars['jobData']['job_code']; ?>
" enctype="multipart/form-data">
                       <label>Full Name:</label>
                       <input type="text" name="enquiry_name" id="enquiry_name" class="form-control" value="" />
                       <label>Your Email:</label>
                       <input type="text" name="enquiry_email" id="enquiry_email" class="form-control" value="" />			   
                       <label>Your Message:</label>
                       <textarea cols="5" name="enquiry_message" id="enquiry_message" class="form-control"></textarea>
                       <label>Your CV:</label>
                       <input type="file" name="cvdocument" id="cvdocument" /><br />		   
                       <button class="btn" onclick="submitApplicationForm();">Send Application</button>
					   <?php if (isset ( $this->_tpl_vars['errorArray'] )): ?><br /><?php echo $this->_tpl_vars['errorArray']; ?>
<?php endif; ?>
                    </form>
					<?php endif; ?>
                </div><br /><br />
                <div>
                <?php echo '
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- vine-right-bar-01 -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-3167387384914043"
                         data-ad-slot="7295705524"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                '; ?>

                </div>
            </div>
        </div>	
    </div>
</section>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php echo '
<script type="text/javascript">
function submitApplicationForm() {
	document.forms.bismsg.submit();
}
</script>
'; ?>

</body>
</html>