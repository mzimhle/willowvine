function getJobSpaceJobs() {
	/* Get  variables */	
	var page = $('#page').val()
	var link = $('#link').val()
	var sectionId = $('#sectionId').val()
	window.open('/admin/jobs/scrape/jobspace/jobspaceHtml.php?page=' + page + '&sectionId=' + sectionId + '&link=' + link, 'height=480,width=640,resizable=1,scrollable=1', false);
}