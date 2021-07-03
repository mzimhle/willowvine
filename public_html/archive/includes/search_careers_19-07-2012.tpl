	<div class="clear"></div>
	<div id="search_box">	
		<form name="search_for_careers" id="search_for_careers" method="GET" action="/careers/">
			<div id="search_box_name"><b>Career title:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchCareer" id="searchCareer" class="form-login" title="Job Title" value="{$searchCareer}" size="30" />
			</div>
			<!--
			<div id="search_box_name"><b>Area / Town:</b></div>
			<div id="search_box_field">
				<input type="text" name="searchArea" id="searchArea" class="form-login" title="Search in this Area" value="{$searchArea}" size="30" />
			</div>
			-->
			<span>
				<a class="search_btn" title="search for careers by title" href="Javascript:document.forms.search_for_careers.submit();">
					<span id="share">Search Careers</span>								
				</a>
			</span>
		</form>
	</div>
	<div class="clear"></div>