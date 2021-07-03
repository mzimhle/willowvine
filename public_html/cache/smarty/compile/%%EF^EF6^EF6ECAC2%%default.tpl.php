<?php /* Smarty version 2.6.20, created on 2015-01-30 14:41:50
         compiled from administration/jobs/view/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobs | View Jobs</title>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<!-- Start Main Container -->
<div id="container">
    <!-- Start Content Section -->
  <div id="content">
    <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<div id="breadcrumb">
        <ul>
            <li><a href="/administration/" title="Home">Home</a></li>
            <li><a href="/administration/jobs/" title="Jobs">Jobs</a></li>
			<li><a href="/administration/jobs/view/" title="View Jobs">View Jobs</a></li>
        </ul>
	</div><!--breadcrumb-->  
	<div class="inner">     
    <h2>Manage Jobs</h2>		
	<a href="/administration/jobs/view/details.php" title="Click to Add a new Job" class="blue_button fr mrg_bot_10"><span style="float:right;">Add a new Job</span></a> <br />
    <div class="clearer"><!-- --></div>
     <!-- Start Search Form -->
     <!-- Start Search Form -->
    <div class="filter_double">
		<div id="searchBar" class="left">    				  
			<strong class="line fl">Search:</strong>
			<input type="text" class="small_field"  id="search" name="search" size="60" value="" />		
			<a  href="javascript:void(0);" onClick="getAllJobs();" class="button next fr"><span>Search</span></a>					
		 </div>
		<div class="clearer"><!-- --></div>	
    </div>	 
    <div class="clearer"><!-- --></div>
    <div id="tableContent" align="center">
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="display" id="dataTable"><thead><tr><th>Added</th><th>Title</th><th>Area</th><th>Affiliate</th><th></th><th></th><th></th></tr></thead><tbody id="jobbody"><tr><td colspan="11"><img src="/images/ajax_loader.gif" /></td></tr></tbody></table>	
	</div>
    <div class="clearer"><!-- --></div>
    </div><!--inner-->
  </div><!-- End Content Section -->
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'administration/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
<?php echo '
<script type="text/javascript">

var oJobsTable	= null;

$(document).ready(function() {
	getAllJobs();
});

function getAllJobs() {						
	var html		= \'\';
	
	var asInitVals 	= new Array();
	
	/* Clear table contants first. */			
	$(\'#tableContent\').html(\'\');
	
	$(\'#tableContent\').html(\'<table cellpadding="0" cellspacing="0" width="100%" border="0" class="display" id="dataTable"><thead><tr><th>Added</th><th>Title</th><th>Category</th><th>Area</th><th></th><th></th></tr></thead><tbody id="jobbody"><tr><td colspan="11"><img src="/images/ajax_loader.gif" /></td></tr></tbody></table>\');	
		
	oJobsTable = $(\'#dataTable\').dataTable({					
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",							
		"bSort": false,
		"bFilter": false,
		"bInfo": false,
		"iDisplayStart": 0,
		"iDisplayLength": 20,				
		"bLengthChange": false,									
		"bProcessing": true,
		"bServerSide": true,		
		"sAjaxSource": "?action=jobsearch&search="+$(\'#search\').val(),
		"fnServerData": function ( sSource, aoData, fnCallback ) {
			$.getJSON( sSource, aoData, function (json) {
					if (json.result === false) {
							$(\'#jobbody\').html(\'<tr><td colspan="8" align="center">No results</td></tr>\');											
					}
					fnCallback(json)
			});
		},
		"fnDrawCallback": function(){
		}
	});	
	return false;
}
		
function changestatus(id, status) {	
	if(confirm(\'Are you sure you want to change this status?\')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code="+id+"&status="+status,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							oJobsTable.fnDraw();
						} else {
							alert(data.error);
						}
				}
		});								
	}
}	
function deleteitem(id) {	
	if(confirm(\'Are you sure you want to delete this item?\')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code_delete="+id,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							oJobsTable.fnDraw();
						} else {
							alert(data.error);
						}
				}
		});								
	}
}					
</script>
'; ?>

<!-- End Main Container -->
</body>
</html>