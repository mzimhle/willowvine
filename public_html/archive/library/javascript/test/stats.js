/* All Properties Stats. */
function statsActions(category, action, webreference, agentId, branchId, areaId) {
	/* Get the parameters. */
	if(category == null || action == null || webreference == null) {
			return;
	} else {				
		/* Everything is there, lets send to the server. */
		if(agentId	== null) agentId	= '';
		if(branchId	== null) branchId	= '';
		if(areaId		== null) areaId	= '';
		var random = Math.floor(Math.random()*10000000000);
		
		$.ajax({
						type: "GET",
						url: "/analytics/statsActions.php",
						data: "s_r="+random+"&category="+category+"&action="+action+"&webreference="+webreference+"&agentId="+agentId+"&branchId="+branchId+"&areaId="+areaId,
						dataType: "html",
						timeout: 10000,
						success: function(data){},
						error: function(){}
				});
	}
}

/* Articles Stats. */
function statsArticles(category, action, articleId) {
	/* Get the parameters. */
	if(articleId == null || category == null || action == null) {
			return;
	} else {				
		/* Everything is there, lets send to the server. */
		if(category	== null) category	= '';
		if(action		== null) action	= '';
		if(articleId	== null) articleId	= '';
	
		$.ajax({
						type: "GET",
						url: "/analytics/statsArticles.php",
						data: "category="+category+"&action="+action+"&articleId="+articleId,
						dataType: "html",
						timeout: 10000,
						success: function(data){},
						error: function(){}
				});
	}
}