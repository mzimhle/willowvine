
function goToLink() {
	var sectionId = $('#sectionId').val();
	
	top.location='/jobs/search/?sectionId='+sectionId;
}

function openWindow_fb_share(url) {
	//window.open(url,"","scrollbars")
	window.open(url, "", "scrollbars,height=450,width=450", false);
}

/* Login lightbox. */
function showLogin(){$('#lightboxLoginFormDiv').show();$('#lightbox_login').modal({overlayClose:true,onClose:function (dialog){$.modal.close();}});}
/* Share lightbox. */
function showShare(jobDetails, reference){
	$('#lightboxShareFormDiv').show();
	$('#job_details').html(jobDetails);
	$('#jobReference').val(reference);
	$('#lightbox_share').modal({overlayClose:true,onClose:function (dialog){$.modal.close();}});}

/* Send share details. */
function submitShareForm(job, name, email, friend_name ,friend_email) {
	$.ajax({
			type: "GET",
			url: "/includes/share_with_friend.php",
			data: "name="+name+"&email="+email+"&friend_email="+friend_email+"&job="+job+"&friend_name="+friend_name,
			dataType: "html",
			timeout: 10000,
			success: function(data){
				$('#share_output').html(data);
			},
			error: function(){
				$('#share_output').html('Share Error: Please try again.');
			}
	});
}

/* Short list jobs. */
function shortList(reference) {
	$.ajax({
			type: "GET",
			url: "/includes/shortlist.php",
			data: "job="+reference,
			dataType: "html",
			timeout: 10000,
			success: function(data){
				window.location.href=window.location.href
			},
			error: function(){
			
			}
	});
}

function shortListRemove(reference) {
	$.ajax({
			type: "GET",
			url: "/includes/shortlist.php",
			data: "action=remove&job="+reference,
			dataType: "html",
			timeout: 10000,
			success: function(data){
				window.location.href=window.location.href
			},
			error: function(){
			
			}
	});
}
/* Login send details. */
function submitLoginForm(email, password) {
	$('#login_output').html('<span style="color: green;">Please wait...</span>');
	$.ajax({
			type: "GET",
			url: "/includes/send_login_all.php",
			data: "email="+email+"&password="+password,
			dataType: "html",
			timeout: 10000,
			success: function(data){
				if (data.indexOf('success') >= 0) {
					/* Success. redirect to jobSeeker account.*/
					document.location.href = '/job_seeker/account/';
				} else {
					if (data !== null && data !== '') {
						$('#login_output').html(data);
					}
				}
			},
			error: function(){
				$('#login_output').html('Login Error: Please try again.');
			}
	});
}

function submitForgotPasswordForm(email) {
	$('#password_output').html('<span style="color: green;">Please wait...</span>');
	if(email == '') {
		$('#password_output').html('Please enter email.');
	} else {
		$.ajax({
				type: "GET",
				url: "/includes/send_login_all.php",
				data: "forgot_password_email="+email,
				dataType: "html",
				timeout: 10000,
				success: function(data){
					if (data.indexOf('success') >= 0) {
						/* Success. redirect to jobSeeker account.*/
						document.location.href = '/job_seeker/account/';
					} else {
						if (data !== null && data !== '') {
							$('#password_output').html(data);
						}
					}
				},
				error: function(){
					$('#password_output').html('Forgot Password Error: Please enter email again.');
				}
		});
	}
}
function showForgottenPassword() {
	$('#lightboxLoginForgottenPasswordFormEmail').val($('#lightboxLoginFormEmail').val());
	$('#lightboxLoginFormDiv').hide();
	$('#lightboxForgottenPasswordFormDiv').show();
}

function hideForgottenPassword() {
	$('#lightboxLoginFormEmail').val($('#lightboxLoginForgottenPasswordFormEmail').val());
	$('#lightboxForgottenPasswordFormDiv').hide();
	$('#lightboxLoginFormDiv').show();
}

