<?php /* Smarty version 2.6.20, created on 2015-01-30 14:41:50
         compiled from administration/includes/header.tpl */ ?>
<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div class="client_logo">

        </div>
       
    </div><!-- End Heading -->

    <!-- Start Top Nav -->
   <?php if (isset ( $this->_tpl_vars['administratorData'] )): ?>
    <div id="topnav"> 
            <ul>
                <li><a href="/administration/" title="Home" <?php if ($this->_tpl_vars['page'] || $this->_tpl_vars['page'] == ''): ?> class="active"<?php endif; ?>>Home</a></li>
				<li><a href="/administration/participants/" title="Participants" <?php if ($this->_tpl_vars['page'] == 'participants'): ?> class="active"<?php endif; ?>>Participants</a></li> 
				<li><a href="/administration/jobs/" title="Jobs" <?php if ($this->_tpl_vars['page'] == 'jobs'): ?> class="active"<?php endif; ?>>Jobs</a></li>				
                <li><a href="/administration/careers/" title="Careers" <?php if ($this->_tpl_vars['page'] == 'careers'): ?> class="active"<?php endif; ?>>Careers</a></li>
				<li><a href="/administration/internships/" title="Internships" <?php if ($this->_tpl_vars['page'] == 'internships'): ?> class="active"<?php endif; ?>>Internships</a></li>  
				<li><a href="/administration/exams/" title="Exams" <?php if ($this->_tpl_vars['page'] == 'exams'): ?> class="active"<?php endif; ?>>Exams</a></li>  
				<li><a href="/administration/communication/" title="Communication" <?php if ($this->_tpl_vars['page'] == 'communication'): ?> class="active"<?php endif; ?>>Communication</a></li>  
				<li><a href="/administration/resources/" title="Resources" <?php if ($this->_tpl_vars['page'] == 'resources'): ?> class="active"<?php endif; ?>>Resources</a></li>
            </ul>
    </div><!-- End Top Nav -->
  <?php endif; ?>
  <div class="clearer"><!-- --></div>
</div><!--header-->
   <?php if (isset ( $this->_tpl_vars['administratorData'] )): ?>
<div class="logged_in">
	<ul>
		<li><a href="/administration/logout.php" title="Logout">Logout</a></li>
	</ul>
</div><!--logged_in-->
<br />
  <?php endif; ?>