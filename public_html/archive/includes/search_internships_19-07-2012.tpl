	<div class="clear"></div>
	<div id="search_box">	
		<form name="search_for_internships" id="search_for_internships" method="GET" action="/internships/">
			<div id="search_box_name"><b>Internship Title / Company offering:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchInternship" id="searchInternship" class="form-login" title="Job Title" value="{$searchInternship}" size="30" />
			</div>
			<!--
			<div id="search_box_name"><b>Area / Town:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchArea" id="searchArea" class="form-login" title="Search in this Area" value="{$searchArea}" size="30" />
			</div>
			-->
			<span>
				<a class="search_btn" title="search for internships by title" href="Javascript:document.forms.search_for_internships.submit();">
					<span id="share">Search Internships</span>								
				</a>
			</span>
		</form>
	</div>
	<div class="clear"></div>