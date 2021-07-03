function getDatafinJobs() {
	/* Get  variables */	
	var page = $('#page').val()
	window.open('/admin/jobs/scrape/datafin/datafinHtml.php?page=' + page, 'height=480,width=640,resizable=1', false);
}