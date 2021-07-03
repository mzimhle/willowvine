var retries = 0;

function fetchGrid(newPage,queryString) {
	// Make sure that we do not attach a NULL to a string
	if (queryString == null) queryString = '';

	retries++;
	if (retries < 4){
		
		$.ajax({
				type: "GET",
				url: "/admin/resources/areas/areasHtml.php",
				data: "page="+newPage+queryString,
				dataType: "html",
				timeout: 10000,
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

function getParentArea() {
	var temp = $('#fkAreaTypeId').val();
	var fkAreaParentId = $('#fkAreaParentId').val();
	
	var fkAreaTypeId = temp - 1;
	
	$.ajax({
		type: "GET",
		url: "/admin/resources/areas/areasHtml.php",
		data: "fkAreaTypeId="+fkAreaTypeId +"&fkAreaParentId="+fkAreaParentId,
		dataType: "html",
		timeout: 10000,
		success: function(data){
			/* show table */
			$('#parentArea').html(data);				
		},
		error: function(){}
	});	
}