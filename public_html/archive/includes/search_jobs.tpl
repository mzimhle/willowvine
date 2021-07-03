	<div class="clear"></div>
	<div id="search_box" class="fr">	
		<form name="search_for_jobs" id="search_for_jobs" method="GET" action="/jobs/search/">
			<div id="search_box_field">
				<input type="text" name="searchJob" id="searchJob" class="form-login" title="Job Title" value="{$searchJob}" size="30" />
			</div>
			<div id="search_job_select_field">
				<select id="searchArea" name="searchArea">
					<option value="South Africa" {if isset($location) and $location eq 'South Africa'} SELECTED {/if}>South Africa</option>
					<option value="Western Cape" {if isset($location) and $location eq 'Western Cape'} SELECTED {/if}>Cape Town and Western Cape</option>
					<option value="Gauteng" {if isset($location) and $location eq 'Gauteng'} SELECTED {/if}>Johannesburg and Gauteng</option>
					<option value="Kwazulu Natal" {if isset($location) and $location eq 'Kwazulu Natal'} SELECTED {/if}>Durban and Kwazulu Natal</option>					
					<option value="Limpopo" {if isset($location) and $location eq 'Limpopo'} SELECTED {/if}>Limpopo</option>					
					<option value="Free State" {if isset($location) and $location eq 'Free State'} SELECTED {/if}>Bloemfontein and Free State</option>
					<option value="Mpumalanga" {if isset($location) and $location eq 'Mpumalanga'} SELECTED {/if}>Mpumalanga</option>
					<option value="North West Province" {if isset($location) and $location eq 'North West Province'} SELECTED {/if}>North West Province</option>
					<option value="Eastern Cape" {if isset($location) and $location eq 'Eastern Cape'} SELECTED {/if}>Eastern Cape</option>
					<option value="Northern Cape" {if isset($location) and $location eq 'Northern Cape'} SELECTED {/if}>Northern Cape</option>
				</select>
			</div>
			<span>
				<a class="btn_job_search" id="search_job_select_field" title="search for jobs by title or area" href="Javascript:document.forms.search_for_jobs.submit();">
					<button>Search</button>							
				</a>
			</span>

		</form>
	</div>
	<div class="clear"></div>