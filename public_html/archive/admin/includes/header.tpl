<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div class="client_logo">

        </div>
       
    </div><!-- End Heading -->

    <!-- Start Top Nav -->
   {if $admin.administrator_name neq ''}
    <div id="topnav"> 
            <ul>
                <li><a href="/admin/" title="Home" {if $page eq 'default.php' or $page eq ''} class="active"{/if}>Home</a></li>
				<li><a href="/admin/jobs/" title="Jobs" {if $page eq 'jobs'} class="active"{/if}>Jobs</a></li>
				<li><a href="/admin/users/" title="Users" {if $page eq 'users'} class="active"{/if}>Users</a></li> 
                <li><a href="/admin/sections/" title="Sections" {if $page eq 'sections'} class="active"{/if}>Sections</a></li>
				<li><a href="/admin/enquiries/" title="Users" {if $page eq 'enquiries'} class="active"{/if}>Enquiries</a></li> 
                <li><a href="/admin/resources/" title="Resources" {if $page eq 'resources'} class="active"{/if}>Resources</a></li>                				
            </ul>

    </div><!-- End Top Nav -->
  {/if}
  <div class="clearer"><!-- --></div>
</div><!--header-->