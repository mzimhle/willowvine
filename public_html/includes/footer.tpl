<footer>
	<div class="container">
    	<div class="row">
            <div class="mainfoot cf">
                <div class="col-xs-12 col-md-8">
                    <div class="footlinks">
                        <a href="/">Home</a> | <!--
						<a href="/internships/">Internships and Bursaries</a> | 
						<a href="/exams/">Exams</a> | -->
						<a href="/careers/">Careers</a> | 
						<a href="/advice/">Advice</a> | 
						<a href="/contact/">Contact Us</a>
                    </div>
                    <div class="infobox">
                        <a href="/"><img src="/images/foot_logo.png" alt="Willow Vine" /></a>
                        <p>Willowvine offers job opportunities to students, the unemployed as well as those who need a new job or work part time in from South Africa. We also offer advice on career paths, cv writing and previous exam papers.</p>
                    </div>
                    <div class="footdis">
                        <p>All rights reserved. &copy; {$smarty.now|date_format:"%Y"}. Willowvine.co.za, its sponsors, contributors and advertisers disclaim all liability for any loss, damage, injury or expense that might arise from the use of, or reliance upon, the services contained herein.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 no-gutter-left visible-md visible-lg">
					<div class="footicons">
						<a href="https://www.facebook.com/willowvine" target="_blank"><img src="/images/fb_icon.png" alt="Willowvine Facebook" title="Willowvine Facebook" /></a>&nbsp; 
						<a href="https://twitter.com/willowvine" target="_blank"><img src="/images/tw_icon.png" alt="Willowvine Twitter" title="Willowvine Twitter" /></a> 
					</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="preloads">
    <img src="/images/fb_over_btn.gif" alt="Facebook" />
    <img src="/images/g_over_btn.gif" alt="Google" />
    <img src="/images/in_over_btn.gif" alt="LinkedIn" />
    <img src="/images/tw_over_btn.gif" alt="Twitter" />
</div>
{include_php file='includes/javascript.php'}
{literal}
<script>
	var navigation = responsiveNav(".mainnav");
	
  	$(function () {
    	$('#intabs a:first').tab('show')
  })
// Tab-Pane change function
var tabChange = function(){
    var tabs = $('#intabs ul > li');
    var active = tabs.filter('.active');
    var next = active.next('li').length? active.next('li').find('a') : tabs.filter(':first-child').find('a');
    // Use the Bootsrap tab show method
    next.tab('show')
}
// Tab Cycle function
var tabCycle = setInterval(tabChange, 5000)
// Tab click event handler
$(this).find('#intabs a').click(function(e) {
    e.preventDefault();
    // Stop the cycle
    clearInterval(tabCycle);
    // Show the clicked tabs associated tab-pane
    $(this).tab('show')
    // Start the cycle again in a predefined amount of time
    setTimeout(function(){
        tabCycle = setInterval(tabChange, 25000);
    }, 25000);
});
$('.iconbox span').tooltip();
</script>
{/literal}
<!-- /// LOGIN MODAL BOX -->
<div class="modal fade" id="loginbox" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Login">Login to Willowvine</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" role="form">
					<label>Username <span class="lowtxt">or</span> Email:</label><input type="text" name="log_username" id="log_username" value="" />
					<label>Password:</label><input type="password"  name="log_password" id="log_password" value="" />
					<div class="row">
						<div class="col-sm-4">
							<button name="submitLoginForm" id="submitLoginForm" class="btn btn-md btn-view">Login</button>
						</div>
						<div class="col-sm-8">
							<a href="#passbox" class="btn-link" style="font-size: 14px; padding-top: 10px; display: block;" data-dismiss="modal" data-toggle="modal">Forgot password?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// LOGIN MODAL BOX END -->
<!-- /// PASSWORD MODAL BOX -->
<div class="modal fade" id="passbox" tabindex="-2" role="dialog" aria-labelledby="Password" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Password">Reset your password</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" role="form" name="footerForgotPasswordForm" id="footerForgotPasswordForm" method="POST" action="{$smarty.server.REQUEST_URI}">
					<span class="lowtxt">Please enter your email address associated with your Willowvine account.</span><br /><br />
					<label>Email Address:</label><input type="text" name="pass_email" id="pass_email" value="" />
					<button id="submitPasswordForm" name="submitPasswordForm" class="btn btn-md btn-view">Resend Password</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// PASSWORD MODAL BOX END -->
<!-- /// SHARE MODAL BOX -->
<div class="modal fade" id="jobshare" tabindex="-3" role="dialog" aria-labelledby="JobShare" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Account">Share a job</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" name="footerJobShareForm" id="footerJobShareForm" role="form" method="POST" action="{$smarty.server.REQUEST_URI}">
                    <span class="uptxt" id="sharejobtitle"></span><br /><br />
					<span class="lowtxt">Below is a form where you can share the selected job to your friend, please fill it in.</span>
                    <p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">My Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>My Fullname:</label><input type="text" name="share_participant_name" id="share_participant_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>My Email Address:</label><input type="text" name="share_participant_email" id="share_participant_email" value=""  />
						</div>
					</div>
					<p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">Your Friends Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>Friend's Fullname:</label><input type="text" name="share_friend_name" id="share_friend_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>Friend's Email Address:</label><input type="text" name="share_friend_email" id="share_friend_email" value=""  />
						</div>
					</div>
					<button id="submitJobShareForm" name="submitJobShareForm" class="btn btn-md btn-save">Submit / Share</button>
					<input type="hidden" id="jobshare_code" name="jobshare_code" value="" />
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// SHARE MODAL MODAL BOX END -->
<!-- /// INTERNSHIP SHARE MODAL BOX -->
<div class="modal fade" id="internshare" tabindex="-3" role="dialog" aria-labelledby="InternShare" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Account">Share an Internship / Bursary / Scholarship</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" name="footerInternShareForm" id="footerInternShareForm" role="form" method="POST" action="{$smarty.server.REQUEST_URI}">
                    <span class="uptxt redhighlight" id="shareinternname"></span><br /><br />
					<span class="lowtxt">Below is a form where you can share the selected internship / bursary / scholarship to your friend, please fill it in.</span>
                    <p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">My Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>My Fullname:</label><input type="text" name="intern_participant_name" id="intern_participant_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>My Email Address:</label><input type="text" name="intern_participant_email" id="intern_participant_email" value=""  />
						</div>
					</div>
					<p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">Your Friends Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>Friend's Fullname:</label><input type="text" name="intern_friend_name" id="intern_friend_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>Friend's Email Address:</label><input type="text" name="intern_friend_email" id="intern_friend_email" value=""  />
						</div>
					</div>
					<button id="submitInternShareForm" name="submitInternShareForm" class="btn btn-md btn-save">Submit / Share</button>
					<input type="hidden" id="internshare_code" name="internshare_code" value="" />
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// INTERNSHIP SHARE MODAL MODAL BOX END -->
<!-- /// CAREER SHARE MODAL BOX -->
<div class="modal fade" id="careershare" tabindex="-3" role="dialog" aria-labelledby="CareerShare" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Account">Share a Career</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" name="footerCareerShareForm" id="footerCareerShareForm" role="form" method="POST" action="{$smarty.server.REQUEST_URI}">
                    <span class="uptxt redhighlight" id="sharecareername"></span><br /><br />
					<span class="lowtxt">Below is a form where you can share the selected career to your friend, please fill it in.</span>
                    <p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">My Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>My Fullname:</label><input type="text" name="career_participant_name" id="career_participant_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>My Email Address:</label><input type="text" name="career_participant_email" id="career_participant_email" value=""  />
						</div>
					</div>
					<p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">Your Friends Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>Friend's Fullname:</label><input type="text" name="career_friend_name" id="career_friend_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>Friend's Email Address:</label><input type="text" name="career_friend_email" id="career_friend_email" value=""  />
						</div>
					</div>
					<button id="submitCareerShareForm" name="submitCareerShareForm" class="btn btn-md btn-save">Submit / Share</button>
					<input type="hidden" id="careershare_code" name="careershare_code" value="" />
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// EXAM SHARE MODAL BOX -->
<div class="modal fade" id="examshare" tabindex="-3" role="dialog" aria-labelledby="ExamShare" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="Account">Share an Exam</h1>
			</div>
			<div class="modal-body">
				<form class="login-form" name="footerExamShareForm" id="footerExamShareForm" role="form" method="POST" action="{$smarty.server.REQUEST_URI}">
                    <span class="uptxt redhighlight" id="shareexamname"></span><br /><br />
					<span class="lowtxt">Below is a form where you can share the selected exam to your friend, please fill it in.</span>
                    <p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">My Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>My Fullname:</label><input type="text" name="exam_participant_name" id="exam_participant_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>My Email Address:</label><input type="text" name="exam_participant_email" id="exam_participant_email" value=""  />
						</div>
					</div>
					<p style="text-align: center;"><em class="uptxt" style="background: #f8f8f8; padding: 5px;">Your Friends Details</em><hr style="margin-top: -21px;" /></p>
					<div class="row">
						<div class="col-sm-6">
							<label>Friend's Fullname:</label><input type="text" name="exam_friend_name" id="exam_friend_name" value="" />
						</div>
						<div class="col-sm-6">
							<label>Friend's Email Address:</label><input type="text" name="exam_friend_email" id="exam_friend_email" value=""  />
						</div>
					</div>
					<button id="submitExamShareForm" name="submitExamShareForm" class="btn btn-md btn-save">Submit / Share</button>
					<input type="hidden" id="examshare_code" name="examshare_code" value="" />
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /// CONFIRM MODAL BOX -->
<div class="modal fade" id="confirmbox" tabindex="-3" role="dialog" aria-labelledby="ConfirmBox" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bluebox1">
				<div class="btn-close">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" class="fa fa-times"></span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<h1 class="modal-title" id="confirm_title"></h1>
			</div>
			<div class="modal-body">
				<p id="confirm_body"></p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" id="confirm_cancel">No</a>
				<a href="#" id="okButton" class="btn btn-primary" id="confirm_yes">Yes</a>
			</div>			
		</div>
	</div>
</div>
<!-- /// INTERNSHIP SHARE MODAL MODAL BOX END -->
{if !isset($participantloginData)}
{literal}
<div id="fb-root"></div>
<script type="text/javascript">

(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));
 
window.fbAsyncInit = function() {
  FB.init({
	appId      : '{/literal}{$APP_ID}{literal}',
	status     : true, 
	cookie     : true,
	xfbml      : true,
	oauth      : true,
  });
	FB.Event.subscribe('auth.login', function () {
		  window.location = window.location.href;
	  });
};

function fb_login(){
	FB.login(function(response) {

		if (response.authResponse) {
		
			access_token = response.authResponse.accessToken; //get access token
			user_id = response.authResponse.userID; //get FB UID

			FB.api('/me?fileds=id,first_name,last_name,gender,link,email', function(response) {
			
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: {
						action: 'registrationFacebookForm',
						id: response.id,
						email: response.email,
						first_name: response.first_name,
						last_name: response.last_name,
						gender: response.gender,
						link: response.link
					},
					dataType: "json",
					success: function(data){						
							
						if(data.result == 1) {
							alert('Thank you for registering with us using your facebook account, you will receive an email confirmation soon');
							window.location.href = window.location.href;
						} else {							
							showMessage(data.message);
						}						
					}
				});
			});

		}
	}, {
		scope: 'email,user_location'
	});
}
</script>
{/literal}
{/if}
{literal}
<script type="text/javascript" language="javascript">

function link(link) {
	window.location.href = link;
	return false;
}

function deleteCVModal(code) {
	confirm('Delete CV', 'Are you sure you want to delete this CV?', 'No', 'Yes', deleteCV, [code]);
	return false;
}

function deleteCV(code) {
	$.ajax({
			type: "GET",
			url: "/modal/ajax/",
			data: "action=deleteCV&code_delete="+code,
			dataType: "json",
			success: function(data){
					if(data.result == 1) {
						actionNotify('CV Deleted', 'The CV has been successfully deleted.');
						$('#cv_'+code).remove();
					} else {
						actionNotify('Career Share Error', displayMessage(data.message));	
					}
			}
	});
	return false;
}

function confirm(heading, question, cancelButtonTxt, okButtonTxt, callback, code) {

	$('#confirm_title').html(heading);
	$('#confirm_body').html(question);
	$('#confirm_cancel').html(cancelButtonTxt);
	$('#confirm_yes').html(okButtonTxt);

	$('#okButton').click(function() {
		callback(code.toString());
		$('#confirmbox').modal('hide');
	});

	$('#confirmbox').modal('show');
	return false;
};
	  
$( document ).ready(function() {
		
		$('#submitPasswordForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=passwordForm&email="+$('#pass_email').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {							
							actionNotify('Password Reset Error', displayMessage(data.message));
						} else {
							actionNotify('Password Reset Message', 'Your password has been sent to the email <b>'+$('#pass_email').val()+'</b>');
							$('#passbox').modal('hide');
						}
					}
				});	
			$(this).show();
			return false;
		});
		
		$('#submitLoginForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=loginForm&username="+$('#log_username').val()+"&password="+$('#log_password').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {							
							actionNotify('Login Error', displayMessage(data.message));					
						} else {
							window.location.href = window.location.href;
						}						
					}
				});	
			$(this).show();
			return false;
		});
		
		$('#submitRegistrationForm').click(function() {
			$('#submitRegistrationForm').hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=registrationEmailForm&participant_name="+$('#participant_name').val()+"&participant_surname="+$('#participant_surname').val()+"&participant_email="+$('#participant_email').val()+"&areapost_code="+$('#areapost_code').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {							
							actionNotify('Registration Error', displayMessage(data.message));
							$('#submitRegistrationForm').show();
						} else {													
							actionNotify('Registration Successful', 'Thank you for registering with us, you will get an email message to verify your email address.');
							$('#registrationform').html('<label>Registration Successful</label><p>Thank you for registering with us, you will get an email message to verify your email address.</p>');
						}
					}
				});
			return false;
		});

		$('#submitJobShareForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=shareJobForm&share_participant_name="+$('#share_participant_name').val()+"&share_participant_email="+$('#share_participant_email').val()+"&share_friend_name="+$('#share_friend_name').val()+"&share_friend_email="+$('#share_friend_email').val()+"&jobshare_code="+$('#jobshare_code').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {
							actionNotify('Job Share Error', displayMessage(data.message));				
						} else {
							actionNotify('Job Share Success', 'Selected job was shared successfully');	
							$('#jobshare').modal('hide');							
						}						
					}
				});	
			$(this).show();
			return false;
		});		
		
		$('#submitInternShareForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=shareInternForm&share_participant_name="+$('#intern_participant_name').val()+"&share_participant_email="+$('#intern_participant_email').val()+"&share_friend_name="+$('#intern_friend_name').val()+"&share_friend_email="+$('#intern_friend_email').val()+"&internshare_code="+$('#internshare_code').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {
							actionNotify('Internship Share Error', displayMessage(data.message));				
						} else {
							actionNotify('Internship Share Success', 'Selected internship was shared successfully');
							$('#internshare').modal('hide');
						}						
					}
				});	
			$(this).show();
			return false;
		});
		
		$('#submitCareerShareForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=shareCareerForm&share_participant_name="+$('#career_participant_name').val()+"&share_participant_email="+$('#career_participant_email').val()+"&share_friend_name="+$('#career_friend_name').val()+"&share_friend_email="+$('#career_friend_email').val()+"&careershare_code="+$('#careershare_code').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {
							actionNotify('Career Share Error', displayMessage(data.message));				
						} else {
							actionNotify('Career Share Success', 'Selected career was shared successfully');
							$('#careershare').modal('hide');
						}						
					}
				});	
			$(this).show();
			return false;
		});
		
		$('#submitExamShareForm').click(function() {
			$(this).hide();
				$.ajax({
					type: "POST",
					url: "/modal/ajax/",
					data: "action=shareExamForm&share_participant_name="+$('#exam_participant_name').val()+"&share_participant_email="+$('#exam_participant_email').val()+"&share_friend_name="+$('#exam_friend_name').val()+"&share_friend_email="+$('#exam_friend_email').val()+"&examshare_code="+$('#examshare_code').val(),
					dataType: "json",
					success: function(data){
						if(!data.result) {
							actionNotify('Exam Share Error', displayMessage(data.message));				
						} else {
							actionNotify('Exam Share Success', 'Selected exam was shared successfully');
							$('#examshare').modal('hide');
						}						
					}
				});	
			$(this).show();
			return false;
		});
		
		$( "#areapost_name" ).autocomplete({
			source: "/feeds/area.php",
			minLength: 2,
			select: function( event, ui ) {
			
				if(ui.item.id == '') {
					$('#areapost_name').val('');
					$('#areapost_code').val('');					
				} else {
					$('#areapost_name').val(ui.item.value);
					$('#areapost_code').val(ui.item.id);	
				}
				$('#areapost_name').val('');										
			}
		});		
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41824202-1', 'willowvine.co.za');
  ga('send', 'pageview');

</script>
{/literal}