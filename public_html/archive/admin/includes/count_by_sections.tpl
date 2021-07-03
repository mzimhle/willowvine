                <div class="flie6">
                <img alt="" src="/images/leftbox_top.jpg" />
                <div class="leftbox">
                    <div class="leftinbox2" style="min-height: 1px;">
                    <h2 style="color:#705B35;">Jobs By Category</h2>
                        {foreach from=$jobSectionCount item=section}
                        <div class="benefitwrap2" style="padding: 5px 0;">                            
                           <a href="/jobs/search/sectionId={$section.pk_section_id}" class="orange_text">{$section.section_name} ({$section.job_count})</a>
                        	<div class="clear"></div>
                        </div><!-- ending of benefitwrap -->
                        {/foreach}
                    </div><!-- ending of leftbox2 -->
                </div><!-- ending of leftbox -->
                <img alt="" src="/images/leftbox_bottom.jpg" />
                <div class="clear"></div>
                </div>