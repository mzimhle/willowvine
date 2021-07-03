<div id="side_box" class="myform">
	<h1><strong>Internships / Bursaries</strong></h1>
	{foreach from=$topinternships item=item name=foo}
	<div class="internships">
		<div class="right_internships" style="font-size: 13px;margin-top: 20px;">
			<strong><a style="text-decoration: none; color: #063166;" href="/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/" title="View this internship, {$item.internship_title}'s details">{$item.internship_title}</a></strong>
			<p style="margin: 0px">{$item.internship_page|normal_text|strip_tags|truncate:100}<br>			
			<span><strong>Posted: {$item.internship_added|date_format:"%d %b %Y"}</strong> - <a href="/internships/{$item.section_urlName}/details/{$item.internship_link}/{$item.pk_internship_id}/" title="click to view this internship.">View</a></span>
			</p>
		</div>
	</div>
	{/foreach}
	<br>
	<div class="internships">
		<h1>
			<a href="/internships/" style="color: #0D2C52"><strong>Search for more internships and bursaries</strong></a>
		</h1>
	</div>
</div>