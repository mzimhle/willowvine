{if !isset($userData)}
{literal}
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
  FB.init({
	appId      : '{/literal}{$APP_ID}{literal}',
	status     : true, 
	cookie     : true,
	xfbml      : true,
	oauth      : true,
  });
	FB.Event.subscribe('auth.login', function () {
          window.location = '{/literal}{$fb_currentPage}{literal}';
      });  
};
(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));
</script>
{/literal}
<div id="side_box" class="myform">
<h1>Social Networks</h1>
<p>Login using a social network, choose one you are registered with below.</p>
<div class="fb-login-button fr" perms="email,user_location">Login with Facebook</div>

<!--
<a class="twitter_btn fl" href="/includes/twitter_login.php">
	<span id="Login">Login with Twitter</span>								
</a>
-->
<div class="clear"></div>
</div>	
<div class="clear"></div>
<br>
{/if}