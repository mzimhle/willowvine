	<div class="clear"></div>
	<div id="career_search_box" class="fr">	
		<form name="search_for_careers" id="search_for_careers" method="GET" action="/careers/">
			<div id="search_box_name"><b>Career:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchCareer" id="searchCareer" class="form-login" title="Job Title" value="{$searchCareer}" size="30" />
			</div>
			<span>
				<a class="btn_job_search" title="search for careers by title" href="Javascript:document.forms.search_for_careers.submit();">
					<button>Search</button>								
				</a>
			</span>
		</form>
	</div>
	<div class="clear"></div>