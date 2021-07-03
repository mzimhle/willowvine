<header>
	<nav class="topbar">
        <div class="container">
        	<div class="row">
            	<div class="col-xs-4 col-md-4 topdate">{$smarty.now|date_format:"%A, %B %e, %Y"}</div>			
				<div class="col-xs-8 col-md-8">
                    <div class="sublinks">
						<a href="/" id="go" alt="Find a job" title="Find a job"><i class="fa fa-search"></i>&nbsp;&nbsp;Find a job</a>
						<a href="/careers/" id="go" alt="Careers" title="Careers"><i class="fa fa-plus"></i>&nbsp;&nbsp;Careers</a>
						<a href="/advice/" id="go" alt="Advice" title="Advice"><i class="fa fa-legal"></i>&nbsp;&nbsp;Advice</a>
						<a href="/contact/" id="go" alt="Contact Us" title="Contact Us"><i class="fa fa-laptop"></i>&nbsp;&nbsp;Contact Us</a>
						{if !isset($participantloginData)}
							<a href="#" class="login" data-toggle="modal" data-target="#loginbox">Login</a>
						{else}
                        <img src="{if $participantloginData.participant_image_name neq ''}/download/profileimage/{$participantloginData.participant_code}/tiny{else}/images/avatar.jpg{/if}" width="34" height="28" alt="{$participantloginData.participantlogin_name}" />
                    	<div class="user-in">{$participantloginData.participantlogin_name} {$participantloginData.participantlogin_surname}</div>
                        <a href="/account/" id="go" alt="My Account" title="My Account"><i class="fa fa-sliders"></i>&nbsp;&nbsp;My Account</a>
						<a href="/logout" class="user-set user-out" id="go" alt="Log Me Out" title="Log Me Out"><i class="fa fa-lock"></i></a>
                    </div>
                </div>				
				{/if}
            </div>
		</div>
	</nav>
	<div class="headbox container">
    	<div class="row">
        	<div class="col-xs-12 col-md-2">
				<div class="logobox">
                    <a href="/"><img src="/images/logo.png" alt="Willow Vine" /></a>
				</div>			
        	</div>			
            <div class="col-xs-8 col-md-10 visible-md visible-lg">
			<!--
                <div class="top-adbox">
                {literal}
				    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-3167387384914043"
                         data-ad-slot="4342239121"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
					{/literal}
                </div>
				-->
                <div class="searchbox">
                    <div class="socbtn">
                        <a href="https://twitter.com/willowvine" target="_blank" class="tw">Twitter</a>
                        <a href="https://www.facebook.com/willowvine" target="_blank" class="fb">Facebook</a>
                    </div>
                </div>
			</div>
        </div>
    </div>
</header>