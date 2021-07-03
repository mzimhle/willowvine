/* 

$('#myModal').modal('hide');

*/

$(document).ready(function() {
	
	jQuery.extend(jQuery.validator.messages, {
    	required:"This field is required.",
    	rangelength: "Enter more than 3 character.",
    	email:"Please enter a valid email.",
	});
	
	//search input focus change
	$('#subform input, #subform2 input').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
				$(this).css({
					color : '#8c8c8c',
   					'font-family' : 'Helvetica, Arial, Tahoma, Verdana, sans-serif',
   					'text-transform' : 'inherit',
				});
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				$(this).css({
					color : '#e2e2e2',
   					'font-family' : '"Bebas", Helvetica, Arial, Tahoma, Verdana, sans-serif',
   					'text-transform' : 'inherit',
				});
				this.value = default_value;
			}
		});
	});
	
	$('.msearch, .tesearch, .trsearch, .josearch').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
				$(this).css('color', '#8c8c8c');
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				$(this).css('color', '#e2e2e2');
				this.value = default_value;
			}
		});
	});
});

function shortlistJob(code, title, link) {
	$.ajax({
		type: "POST",
		url: "/modal/ajax/",
		data: "action=shortlistjob&jobcode="+code,
		dataType: "json",
		success: function(data){
			if(data.result) {
				
				if($('#shortlist_ul li').length == 0) {
					$("#shortlist_ul").html("<li id='short_"+code+"'><a title='Remove job' alt='Remove job' onclick='removeShortlistjob(\""+code+"\"); return false;' href='#'><span class='fa fa-cog'></span></a><a title='Shortlisted job - "+title+"' alt='Shortlisted job - "+title+"' href='"+link+"'>"+title+"</a></li>");
				} else {
					$("#shortlist_ul").append("<li id='short_"+code+"'><a title='Remove job' alt='Remove job' onclick='removeShortlistjob(\""+code+"\"); return false;' href='#'><span class='fa fa-cog'></span></a><a title='Shortlisted job - "+title+"' alt='Shortlisted job - "+title+"' href='"+link+"'>"+title+"</a></li>");					
				}
				
				actionNotify('Add Shortlist Item', 'Shortlisted job has been successfully added.');
				$('#shortjob_'+code).removeClass('show').addClass('hide');
			} else {													
				actionNotify('Shortlist Error', data.message);		
			}						
		}
	});
}

function shortlistInternship(code, title, link) {
	$.ajax({
		type: "POST",
		url: "/modal/ajax/",
		data: "action=shortlistinternship&internshipcode="+code,
		dataType: "json",
		success: function(data){
			if(data.result) {
				
				if($('#shortlist_ul li').length == 0) {
					$("#shortlist_ul").html("<li id='short_intern_"+code+"'><a title='Remove internship' alt='Remove internship' onclick='removeShortlistjob(\""+code+"\"); return false;' href='#'><span class='fa fa-cog'></span></a><a title='Shortlisted internship - "+title+"' alt='Shortlisted internship - "+title+"' href='"+link+"'>"+title+"</a></li>");
				} else {
					$("#shortlist_ul").append("<li id='short_intern_"+code+"'><a title='Remove internship' alt='Remove job' onclick='removeShortlistjob(\""+code+"\"); return false;' href='#'><span class='fa fa-cog'></span></a><a title='Shortlisted internship - "+title+"' alt='Shortlisted internship - "+title+"' href='"+link+"'>"+title+"</a></li>");					
				}
				
				actionNotify('Add Shortlist Item', 'Shortlisted internship has been successfully added.');
				$('#shortinternship_'+code).removeClass('show').addClass('hide');
			} else {													
				actionNotify('Shortlist Error', data.message);		
			}						
		}
	});
}

function removeShortlistinternship(code) {

	$.ajax({
		type: "POST",
		url: "/modal/ajax/",
		data: "action=removeshortlistinternship&internshipcode="+code,
		dataType: "json",
		success: function(data){
			if(data.result) {
				
				$('#short_'+code).remove();
				
				if($('#shortlist_ul').html().replace(/^\s+|\s+$/g, '') == '') {
					$('#shortlist_ul').html('<span class="redhighlight">There are currently no shortlisted bursaries.</span>');					
				}
				
				actionNotify('Remove Shortlist Item', 'Shortlisted bursary has been successfully removed.');
				$('#shortinternship_'+code).removeClass('hide').addClass('show');		
			} else {
				actionNotify('Shortlist Error', data.message);
			}						
		}
	});	
	
}

function removeShortlistjob(code) {
	$.ajax({
		type: "POST",
		url: "/modal/ajax/",
		data: "action=removeshortlistjob&jobcode="+code,
		dataType: "json",
		success: function(data){
			if(data.result) {
				
				$('#short_'+code).remove();
				
				if($('#shortlist_ul').html().replace(/^\s+|\s+$/g, '') == '') {
					$('#shortlist_ul').html('<span class="redhighlight">There are currently no shortlisted jobs.</span>');					
				}
				
				actionNotify('Remove Shortlist Item', 'Shortlisted job has been successfully removed.');
				$('#shortjob_'+code).removeClass('hide').addClass('show');		
			} else {
				actionNotify('Shortlist Error', data.message);
			}						
		}
	});			
}

function showShare(name, code) {
	
	$('#sharejobtitle').html('<b>'+name+'</b>');
	$('#jobshare_code').val(code);
	$('#jobshare').modal('show'); 
	return false;
	
}

function showInternShare(name, code) {
	
	$('#shareinternname').html('<b>'+name+'</b>');
	$('#internshare_code').val(code);
	$('#internshare').modal('show'); 
	return false;
	
}

function showCareerShare(name, code) {
	
	$('#sharecareername').html('<b>'+name+'</b>');
	$('#careershare_code').val(code);
	$('#careershare').modal('show'); 
	return false;
	
}

function showExamShare(name, code) {
	
	$('#shareexamname').html('<b>'+name+'</b>');
	$('#examshare_code').val(code);
	$('#examshare').modal('show'); 
	return false;
	
}

function submitNewsletterForm() {
	document.forms.newsletterForm.submit();
}

function submitInternFilter() {
	document.forms.formInternFilter.submit();
}

function showMessage(error) {
	var message = '';
	for(var i = 0; i < error.length; i++) {
		message += error[i]+ "\n";
	}
	alert(message);
	return false;
}

function displayMessage(error) {
	var message = '';
	for(var i = 0; i < error.length; i++) {
		message += error[i]+ "<br />";
	}
	return message;
}

function openWindow_fb_share(url) {
	window.open(url, "", "scrollbars,height=450,width=450", false);
}