$(document).ready(function(){
	fetchApplied(1);
	fetchShortList(1)	
});

var retries = 0;

function fetchApplied(newPage) {
	
	$('#applied_container').html('<span style="color: green; font-weight: bold;">Please wait... <a href="javascript:fetchApplied(1);">(refresh)</a></span>');
	
	retries++;
	if (retries < 4){		
		$.ajax({
				type: "GET",
				url: "/job_seeker/account/applied.php",
				data: "page="+newPage,
				dataType: "html",
				success: function(items){
						//show table
						$('#applied_container').html(items);
						$('#applied_container').fadeIn('slow');
				},
				error: function(){
					$('#applied_container').html("Try "+retries+" failed, trying "+(retries+1)+" of 3 retries.");
					fetchApplied(newPage);
				}
		});
	}else{
		retries = 0;
	}	
}

function fetchShortList(newPage) {
	
	$('#shortlist_container').html('<span style="color: green; font-weight: bold;">Please wait... <a href="javascript:fetchShortList(1);">(refresh)</a></span>');
	
	retries++;
	if (retries < 4){		
		$.ajax({
				type: "GET",
				url: "/job_seeker/account/shortlist.php",
				data: "page="+newPage,
				dataType: "html",
				success: function(items){
						//show table
						$('#shortlist_container').html(items);
						$('#shortlist_container').fadeIn('slow');
				},
				error: function(){
					$('#shortlist_container').html("Try "+retries+" failed, trying "+(retries+1)+" of 3 retries.");
					fetchApplied(newPage);
				}
		});
	}else{
		retries = 0;
	}	
}