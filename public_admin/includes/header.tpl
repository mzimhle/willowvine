<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div class="client_logo">

        </div>
       
    </div><!-- End Heading -->

    <!-- Start Top Nav -->
   {if isset($administratorData)}
    <div id="topnav"> 
            <ul>
                <li><a href="/" title="Home" {if $page or $page eq ''} class="active"{/if}>Home</a></li>
				<li><a href="/participants/" title="Participants" {if $page eq 'participants'} class="active"{/if}>Participants</a></li> 
				<li><a href="/jobs/" title="Jobs" {if $page eq 'jobs'} class="active"{/if}>Jobs</a></li>				
                <li><a href="/careers/" title="Careers" {if $page eq 'careers'} class="active"{/if}>Careers</a></li>
				<li><a href="/internships/" title="Internships" {if $page eq 'internships'} class="active"{/if}>Internships</a></li>  
				<li><a href="/exams/" title="Exams" {if $page eq 'exams'} class="active"{/if}>Exams</a></li>  
				<li><a href="/resources/" title="Resources" {if $page eq 'resources'} class="active"{/if}>Resources</a></li>
            </ul>
    </div><!-- End Top Nav -->
  {/if}
  <div class="clearer"><!-- --></div>
</div><!--header-->
   {if isset($administratorData)}
<div class="logged_in">
	<ul>
		<li><a href="/logout.php" title="Logout">Logout</a></li>
	</ul>
</div><!--logged_in-->
<br />
  {/if}