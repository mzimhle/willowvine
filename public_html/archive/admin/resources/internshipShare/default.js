$(document).ready(function(){
	send_filter(1);						
});

var retries = 0;

function fetchGrid(newPage,queryString) {
	// Make sure that we do not attach a NULL to a string
	if (queryString == null) queryString = '';
	
	$('#tableContent').html('<img align="middle" src="/admin/images/ajax-loader.gif" alt="loading" />');
	
	retries++;
	if (retries < 4){
		
		$.ajax({
				type: "GET",
				url: "/admin/resources/internshipShare/internshipShareHtml.php",
				data: "page="+newPage+queryString,
				dataType: "html",
				success: function(jobItems){
						//show table
						$('#tableContent').html(jobItems);
						$('#tableContent').fadeIn('slow');
				},
				error: function(){
					$('#tableContent').html("Try "+retries+" failed, trying "+(retries+1)+" of 3 retries.");
					fetchGrid(newPage);
				}
		});
	}else{
		retries = 0;
	}	
}

function send_filter(page) 
{
	fetchGrid(page,'&search_text~t=' + $('#search_text').val());
}