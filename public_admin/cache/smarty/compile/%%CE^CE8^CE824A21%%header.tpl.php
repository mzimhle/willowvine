<?php /* Smarty version 2.6.20, created on 2015-02-01 14:49:01
         compiled from includes/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'includes/header.tpl', 5, false),)), $this); ?>
<header>
	<nav class="topbar">
        <div class="container">
        	<div class="row">
            	<div class="col-xs-4 col-md-6 topdate"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</div>
				<?php if (! isset ( $this->_tpl_vars['participantloginData'] )): ?>
				<div class="col-xs-8 col-md-6">
                    <div class="sublinks">
                        <a href="#" class="login" data-toggle="modal" data-target="#loginbox">Login</a>
                    </div>
                </div>
				<?php else: ?>
				<div class="col-xs-8 col-md-6">
                    <div class="sublinks">
                        <img src="<?php if ($this->_tpl_vars['participantloginData']['participant_image_name'] != ''): ?>/download/profileimage/<?php echo $this->_tpl_vars['participantloginData']['participant_code']; ?>
/tiny<?php else: ?>/images/avatar.jpg<?php endif; ?>" width="34" height="28" alt="<?php echo $this->_tpl_vars['participantloginData']['participantlogin_name']; ?>
" />
                    	<div class="user-in"><?php echo $this->_tpl_vars['participantloginData']['participantlogin_name']; ?>
 <?php echo $this->_tpl_vars['participantloginData']['participantlogin_surname']; ?>
</div>
                        <a href="/account/" id="go" alt="My Account" title="My Account"><i class="fa fa-sliders"></i>&nbsp;&nbsp;My Account</a>
						<a href="/logout" class="user-set user-out" id="go" alt="Log Me Out" title="Log Me Out"><i class="fa fa-lock"></i></a>
                    </div>
                </div>				
				<?php endif; ?>
            </div>
		</div>
	</nav>
	<div class="headbox container">
    	<div class="row">
			<!--
        	<div class="col-xs-4 col-md-2">
				<div class="logobox"><a href="/"><img src="/images/logo.png" alt="Business Lounge" /></a></div>
        	</div>
			-->
        	<div class="col-xs-8 col-md-8 visible-md visible-lg">
				<div class="logobox">
					<?php echo '
						<script type="text/javascript"><!--
							google_ad_client = "ca-pub-3167387384914043";
							/* header_banner */
							google_ad_slot = "6851860397";
							google_ad_width = 728;
							google_ad_height = 90;
							//-->
						</script>
						<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>	
					'; ?>
	
				</div>			
        	</div>			
            <div class="col-xs-8 col-md-4">
                <div class="searchbox">
                    <div class="socbtn">
                        <a href="https://plus.google.com/101717487189362485831" rel="publisher" target="_blank" class="g">Google+</a>
                        <a href="http://www.linkedin.com/company/business-lounge-sa" target="_blank" class="in">LinkedIn</a>
                        <a href="https://twitter.com/bizloungesa" target="_blank" class="tw">Twitter</a>
                        <a href="https://www.facebook.com/bizlounge" target="_blank" class="fb">Facebook</a>
                    </div>
					<!--
                    <form class="mainsearch" action="" id="searchform">
                        <input type="text" name="msearch" class="msearch" value="Search Site" /><input type="submit" name="search" value="search" id="search" />
                    </form>
					-->
                </div>
			</div>
        </div>
    </div>
</header>