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

function changestatus(code, status) {	
	if(confirm('Are you sure you want to change this status?')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code="+code+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Status has been changed!');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});								
	}
	return false;
}	
function deleteitem(code) {	
	if(confirm('Are you sure you want to delete this item?')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code_delete="+code,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Item has been deleted!');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});								
	}
	return false;
}	