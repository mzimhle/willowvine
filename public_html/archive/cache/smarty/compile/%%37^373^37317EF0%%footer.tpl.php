<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:47
         compiled from includes/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'includes/footer.tpl', 46, false),)), $this); ?>
	<div class="clear"></div>
	<div id="footerarea">
		<div id="footer">
			<div class="fl" id="footer_nav">
				<ul class="top-level">
					<li><a href="/advice/"><strong>Career Advice</strong></a></li>
					<li><a href="/advice/career/">Choose a career</a></li>
					<li><a href="/advice/write_a_cover_letter/">Write a Cover Letter</a></li>
					<li><a href="/advice/write_a_cv/">How to write a CV</a></li>
					<li><a href="/advice/interview/">Interview Tips</a></li>
				</ul>
			</div>		
			<div class="fl" id="footer_nav">
				<ul class="top-level">
					<li><a href="#"><strong>Social</strong></a></li>
					<li><a target="_blank" href="http://www.facebook.com/willowvine">Find us on Facebook!</a></li>
					<li><a target="_blank" href="http://twitter.com/willowvine">Follow us on Twitter</a></li>
					<li><a href="/blog/">Blog</a></li>
					<li><a href="/feed/">Jobs Feeds</a></li>
				</ul>
			</div>	
			<div class="fl" id="footer_nav">
				<ul class="top-level">
					<li><a href="#"><strong>Objectives</strong></a></li>
					<li><a href="/jobs/search/">Jobs / Careers</a></li>
					<li><a href="/internships/">Internships / Bursaries</a></li>
					<li><a href="/job_seeker/register/">Register your CV</a></li>
					<li><a href="/jobs/post/">Post free Job Ads</a></li>
				</ul>
			</div>		
			<div class="fl" id="footer_nav">
				<ul class="top-level">
					<li><a href="#"><strong>Legal</strong></a></li>
					<li><a href="/about_us/policy/">Policy</a></li>
				</ul>
			</div>		
			<!--
			<div class="fl" id="footer_nav">
				<a href="/jobs/search/"><img width="175" height="145" alt="willowvine search for jobs" src="/images/footer_logo.png"></a>
			</div>
			-->
	<!-- ending of footnav -->
			<div style="display: none;" class="lightbox" id="lightbox_login">
				<div style="display: block;" id="lightboxLoginFormDiv">
					<div id="side_box" class="myform">
					<form id="lightboxLoginForm" name="lightboxLoginForm" method="post" action="<?php echo ((is_array($_tmp=@$this->_tpl_vars['currentLink'])) ? $this->_run_mod_handler('default', true, $_tmp, "/") : smarty_modifier_default($_tmp, "/")); ?>
" enctype="multipart/form-data" >
					<a class="standard_blue_btn fr" href="JavaScript:$.modal.close();">
						<span id="close">Close</span>								
					</a>					
					<h1>Login in to your account</h1>
					<p>Login to add, remove or update your CV and your details.</p>
					
					<label>Email<span class="small">Add a valid address</span></label>
					<input type="text" name="email" id="email" />
					
					<label>Password<span class="small">Password you used during CV registration</span></label>
					<input type="password" name="password" id="password"/>	
					<div class="spacer"></div><br>
					<span id="login_output" name="login_output" class="error"></span>
					<div class="spacer"></div><br>
					<a class="standard_blue_btn fl" href="Javascript:void(0);" onclick="submitLoginForm($('#email').val(), $('#password').val());">
						<span id="Login">Login me in</span>								
					</a>
					
					<a class="standard_blue_btn fr" href="JavaScript:void(0);" onclick="showForgottenPassword();">
						<span id="Login">Forgot your password?</span>								
					</a>					
					
					<div class="spacer"></div>
					</form>
					</div>						
				</div>
				<div style="display: none;" id="lightboxForgottenPasswordFormDiv">
					<div id="side_box" class="myform">
						<form id="lightboxLoginForgottenPasswordForm" name="lightboxLoginForgottenPasswordForm" method="post" action="<?php echo ((is_array($_tmp=@$this->_tpl_vars['currentLink'])) ? $this->_run_mod_handler('default', true, $_tmp, "/") : smarty_modifier_default($_tmp, "/")); ?>
" enctype="multipart/form-data" >
							<a class="standard_blue_btn fr" href="JavaScript:$.modal.close();">
								<span id="close">Close</span>								
							</a>					
							<h1>Forgot your password?</h1>
							<p>Enter your email address so that we can send you your password.</p>
							
							<label>Email<span class="small">Add a valid address</span></label>
							<input type="text" name="forgot_password_email" id="forgot_password_email" />
							
							<div class="spacer"></div><br>
							<div id="password_output" name="password_output" class="error"></div>
							<div class="spacer"></div><br>
							<a class="standard_blue_btn fl" href="Javascript:void(0);" onclick="submitForgotPasswordForm($('#forgot_password_email').val());">
								<span id="Login">Send me password</span>								
							</a>
							
							<a class="standard_blue_btn fr" href="JavaScript:void(0);" onclick="hideForgottenPassword();">
								<span id="Login">Back to login</span>								
							</a>												
							<div class="spacer"></div>
						</form>
					</div>	
				</div>
				<a class="close" href="JavaScript:$.modal.close();"></a>
			</div>
			<div style="display: none; height: 334px;" class="lightbox" id="lightbox_share">
		<div style="display: block;" id="lightboxShareFormDiv">
			<div id="side_box" class="myform">
				<form id="lightboxShareForm" name="lightboxShareForm" method="post">
					<a class="standard_blue_btn fr" href="JavaScript:$.modal.close();">
						<span id="close">Close</span>								
					</a>					
					<h1>Share with a friend</h1>					
					<p>Send this job, <b><span id="job_details" name="job_details"></span></b>, post it to a friend that you think or know needs to apply for.</p>
					
					<label>Your fullname:<span class="small">Your fullname please</span></label>
					<input type="text" name="your_name" id="your_name" value="" />
					
					<label>Your email:<span class="small">Your valid email please</span></label>
					<input type="text" name="your_email" id="your_email" value=""/>					
					
					<label>Friend's name:<span class="small">Your friend's fullname please</span></label>
					<input type="text" name="friend_name" id="friend_name" value=""/>	

					<label>Friend's email:<span class="small">Your friend's valid email please</span></label>
					<input type="text" name="friend_email" id="friend_email" value=""/>	
					
					<a class="standard_blue_btn fl" href="Javascript:void(0);" onclick="submitShareForm($('#jobReference').val(), $('#your_name').val(), $('#your_email').val(), $('#friend_name').val(),$('#friend_email').val());" value="Share" name="shareFormSubmit" id="shareFormSubmit">
						<span id="Login">Share with my friend</span>								
					</a>
					<br>
					<span id="share_output" name="share_output" class="error"></span>
					<div class="spacer"></div>
					<input type="hidden" value="" name="jobReference" id="jobReference" />
				</form>
			</div>
		</div>
		<a class="close" href="JavaScript:$.modal.close();"></a>
	</div>
			<div style="display: none; height: 334px;" class="lightbox" id="lightbox_InternshipShare">
		<div style="display: block;" id="lightboxShareInternshipFormDiv">
			<div id="side_box" class="myform">
				<form id="lightboxInternshipShareForm" name="lightboxInternshipShareForm" method="post">
					<a class="standard_blue_btn fr" href="JavaScript:$.modal.close();">
						<span id="close">Close</span>								
					</a>					
					<h1>Share internship/bursary with a friend</h1>					
					<p>Send this internship/bursary , <b><span id="internship_details" name="internship_details"></span></b>, to a friend that you think or know needs to apply for.</p>
					
					<label>Your fullname:<span class="small">Your fullname please</span></label>
					<input type="text" name="internship_your_name" id="internship_your_name" value="" />
					
					<label>Your email:<span class="small">Your valid email please</span></label>
					<input type="text" name="internship_your_email" id="internship_your_email" value=""/>					
					
					<label>Friend's name:<span class="small">Your friend's fullname please</span></label>
					<input type="text" name="internship_friend_name" id="internship_friend_name" value=""/>	

					<label>Friend's email:<span class="small">Your friend's valid email please</span></label>
					<input type="text" name="internship_friend_email" id="internship_friend_email" value=""/>	
					
					<a class="standard_blue_btn fl" href="Javascript:void(0);" onclick="submitInternshipShareForm($('#internship_id').val(), $('#internship_your_name').val(), $('#internship_your_email').val(), $('#internship_friend_name').val(),$('#internship_friend_email').val());" value="Share" name="shareFormSubmit" id="shareFormSubmit">
						<span id="Login">Share with my friend</span>								
					</a>
					<br>
					<span id="internship_output" name="internship_output" class="error"></span>
					<div class="spacer"></div>
					<input type="hidden" value="" name="internship_id" id="internship_id" />
				</form>
			</div>
		</div>
		<a class="close" href="JavaScript:$.modal.close();"></a>
	</div>	
		</div><!-- ending of footer -->
	</div>
</div>
<?php echo '
<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-41824202-1\', \'willowvine.co.za\');
  ga(\'send\', \'pageview\');

</script>
'; ?>