function getmergeJobs() {
	/* Get  variables */	
	var page = $('#page').val();
	var cat = $('#category').val();
	window.open('/admin/jobs/scrape/merge/emergeHtml.php?page=' + page + '&cat=' + cat, 'height=380,width=340,resizable=1', false);
}