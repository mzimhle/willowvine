<?php /* Smarty version 2.6.20, created on 2015-02-01 12:49:47
         compiled from includes/navigation.tpl */ ?>
	<div id="header">
		<div id="header-wrap">
			<ul>
			<li><a title="Home" href="/">Home</a></li>
			<li class="navseparate"><!-- --></li>
			<li><a title="Find a job" href="/jobs/search/">Find a job</a></li>
			<?php if (! isset ( $this->_tpl_vars['userData'] )): ?>
			<li class="navseparate"><!-- --></li>
			<li><a title="Post a free job post" href="/jobs/post/">Post a free job Ad</a></li>
			<?php endif; ?>
			<li class="navseparate"><!-- --></li>
			<li><a title="View internships for your career or job path" href="/internships/">Internships / Bursaries</a></li>
			<li class="navseparate"><!-- --></li>
			<li><a title="Learn more about other careers" href="/careers/">Careers</a></li>
			<li class="navseparate"><!-- --></li>
			<li><a title="Contact us for any information" href="/contact_us/">Contact Us</a></li>		
			</ul>
			<div id="header-account">
				<?php if (isset ( $this->_tpl_vars['userData'] )): ?>
				<a class="fl" href="/job_seeker/account/" title="View My Account"><b>My Account&nbsp;&nbsp; | &nbsp;&nbsp; </b></a>
				<a class="fr" href="/logout.php" title="Log me out"><b>Logout</b></a>
				<?php else: ?>
				<a class="fr" href="Javascript:showLogin();" title="Login to willowvine">Login</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="logo_container">
		<div id="logo" class="fl">
			<a href="/" title="Search for jobs at willowvine">
					<b><h1>WILLOWVINE</h1></b>
			</a>
		</div><!--ending of logo-->
		<div id="logo_line" class="fr">
			<?php echo '
				<script type="text/javascript"><!--
					google_ad_client = "ca-pub-3167387384914043";
					/* header_banner */
					google_ad_slot = "6851860397";
					google_ad_width = 728;
					google_ad_height = 90;
					//-->
				</script>
				<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>	
			'; ?>

		</div><!--ending of logo_line-->
	</div>