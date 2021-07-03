<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:47
         compiled from includes/search_jobs.tpl */ ?>
	<div class="clear"></div>
	<div id="search_box" class="fr">	
		<form name="search_for_jobs" id="search_for_jobs" method="GET" action="/jobs/search/">
			<div id="search_box_field">
				<input type="text" name="searchJob" id="searchJob" class="form-login" title="Job Title" value="<?php echo $this->_tpl_vars['searchJob']; ?>
" size="30" />
			</div>
			<div id="search_job_select_field">
				<select id="searchArea" name="searchArea">
					<option value="South Africa" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'South Africa'): ?> SELECTED <?php endif; ?>>South Africa</option>
					<option value="Western Cape" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Western Cape'): ?> SELECTED <?php endif; ?>>Cape Town and Western Cape</option>
					<option value="Gauteng" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Gauteng'): ?> SELECTED <?php endif; ?>>Johannesburg and Gauteng</option>
					<option value="Kwazulu Natal" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Kwazulu Natal'): ?> SELECTED <?php endif; ?>>Durban and Kwazulu Natal</option>					
					<option value="Limpopo" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Limpopo'): ?> SELECTED <?php endif; ?>>Limpopo</option>					
					<option value="Free State" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Free State'): ?> SELECTED <?php endif; ?>>Bloemfontein and Free State</option>
					<option value="Mpumalanga" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Mpumalanga'): ?> SELECTED <?php endif; ?>>Mpumalanga</option>
					<option value="North West Province" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'North West Province'): ?> SELECTED <?php endif; ?>>North West Province</option>
					<option value="Eastern Cape" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Eastern Cape'): ?> SELECTED <?php endif; ?>>Eastern Cape</option>
					<option value="Northern Cape" <?php if (isset ( $this->_tpl_vars['location'] ) && $this->_tpl_vars['location'] == 'Northern Cape'): ?> SELECTED <?php endif; ?>>Northern Cape</option>
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