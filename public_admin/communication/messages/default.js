$(document).ready(function(){
	odataTable = $('#dataTable').dataTable({					
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",							
		"bSort": true,
		"bFilter": true,
		"bInfo": false,
		"iDisplayLength": 20,
		"bLengthChange": false							
	});		

	odataTable.fnFilter('');
	
});

function deleteitem(id) {					
	if(confirm('Are you sure you want to delete this item?')) {
		$.ajax({ 
				type: "GET",
				url: "default.php",
				data: "delete_code="+id,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Item deleted!');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});							
	}
	return false;
}

function changestatus(id, status) {	
	if(confirm('Are you sure you want to change this status?')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "status_code="+id+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});								
	}
	return false;
}
