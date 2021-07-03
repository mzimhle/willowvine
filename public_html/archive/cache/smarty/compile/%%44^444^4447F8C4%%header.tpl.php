<?php /* Smarty version 2.6.20, created on 2015-02-01 12:28:06
         compiled from admin/includes/header.tpl */ ?>
<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div class="client_logo">

        </div>
       
    </div><!-- End Heading -->

    <!-- Start Top Nav -->
   <?php if ($this->_tpl_vars['admin']['administrator_name'] != ''): ?>
    <div id="topnav"> 
            <ul>
                <li><a href="/admin/" title="Home" <?php if ($this->_tpl_vars['page'] == 'default.php' || $this->_tpl_vars['page'] == ''): ?> class="active"<?php endif; ?>>Home</a></li>
				<li><a href="/admin/jobs/" title="Jobs" <?php if ($this->_tpl_vars['page'] == 'jobs'): ?> class="active"<?php endif; ?>>Jobs</a></li>
				<li><a href="/admin/users/" title="Users" <?php if ($this->_tpl_vars['page'] == 'users'): ?> class="active"<?php endif; ?>>Users</a></li> 
                <li><a href="/admin/sections/" title="Sections" <?php if ($this->_tpl_vars['page'] == 'sections'): ?> class="active"<?php endif; ?>>Sections</a></li>
				<li><a href="/admin/enquiries/" title="Users" <?php if ($this->_tpl_vars['page'] == 'enquiries'): ?> class="active"<?php endif; ?>>Enquiries</a></li> 
                <li><a href="/admin/resources/" title="Resources" <?php if ($this->_tpl_vars['page'] == 'resources'): ?> class="active"<?php endif; ?>>Resources</a></li>                				
            </ul>

    </div><!-- End Top Nav -->
  <?php endif; ?>
  <div class="clearer"><!-- --></div>
</div><!--header-->