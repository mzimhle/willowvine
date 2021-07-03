function getJobs() {
	/* Get  variables */	
	var page = $('#page').val();
	var cat = $('#cat').val();
	window.open('/admin/jobs/scrape/networkrecruitment/Html.php?page=' + page + '&cat=' + cat, 'height=380,width=340,resizable=1', false);
}