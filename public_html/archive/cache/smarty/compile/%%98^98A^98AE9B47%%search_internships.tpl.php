<?php /* Smarty version 2.6.20, created on 2015-02-01 12:29:37
         compiled from includes/search_internships.tpl */ ?>
	<div class="clear"></div>
	<div id="internship_search_box" class="fr">	
		<form name="search_for_internships" id="search_for_internships" method="GET" action="/internships/">
			<div id="search_box_name"><b>Internship/Bursary: </b></div>
			<div id="search_box_field">
				<input type="text" name="searchInternship" id="searchInternship" class="form-login" title="Job Title" value="<?php echo $this->_tpl_vars['searchInternship']; ?>
" size="30" />
			</div>
			<span>
				<a class="btn_job_search" title="search for internships by title" href="Javascript:document.forms.search_for_internships.submit();">
					<button>Search</button>								
				</a>
			</span>
		</form>
	</div>
	<div class="clear"></div>