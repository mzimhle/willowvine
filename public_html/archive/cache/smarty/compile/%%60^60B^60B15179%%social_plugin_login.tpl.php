<?php /* Smarty version 2.6.20, created on 2013-11-21 09:54:04
         compiled from includes/social_plugin_login.tpl */ ?>
<?php if (! isset ( $this->_tpl_vars['userData'] )): ?>
<?php echo '
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
  FB.init({
	appId      : \''; ?>
<?php echo $this->_tpl_vars['APP_ID']; ?>
<?php echo '\',
	status     : true, 
	cookie     : true,
	xfbml      : true,
	oauth      : true,
  });
	FB.Event.subscribe(\'auth.login\', function () {
          window.location = \''; ?>
<?php echo $this->_tpl_vars['fb_currentPage']; ?>
<?php echo '\';
      });  
};
(function(d){
   var js, id = \'facebook-jssdk\'; if (d.getElementById(id)) {return;}
   js = d.createElement(\'script\'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName(\'head\')[0].appendChild(js);
 }(document));
</script>
'; ?>

<div id="side_box" class="myform">
<h1>Social Networks</h1>
<p>Login using a social network, choose one you are registered with below.</p>
<div class="fb-login-button fr" perms="email,user_location">Login with Facebook</div>

<a class="twitter_btn fl" href="/job_seeker/register/twitter/">
	<span id="Login">Login with Twitter</span>								
</a>
<div class="clear"></div>
<br />
<a href="/includes/gmail_login.php" class="gmail-login fl">
	<img src="images/gmail.png" width="135" height="43" class="" alt="Log into Willowvine with your Google Account" title="Log into Willowvine with your Google Account" />
</a>
<div class="clear"></div>
</div>	
<div class="clear"></div>
<br>
<?php endif; ?>