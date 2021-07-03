	<div class="clear"></div>
	<div id="search_box">	
		<form name="search_for_jobs" id="search_for_jobs" method="GET" action="/jobs/search/">
			<div id="search_box_name"><b>Job Title:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchJob" id="searchJob" class="form-login" title="Job Title" value="{$searchJob}" size="30" />
			</div>
			<div id="search_box_name"><b>Area / Town:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchArea" id="searchArea" class="form-login" title="Search in this Area" value="{$searchArea}" size="30" />
			</div>
			<span>
				<a class="search_btn" title="search for jobs by title or area" href="Javascript:document.forms.search_for_jobs.submit();">
					<span id="share">Search for Jobs</span>								
				</a>
			</span>
		</form>
	</div>
	<div class="clear"></div>