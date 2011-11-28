{* $Id: section.tpl 6971 2009-03-05 09:28:18Z zeke $ *}

<div class="clear">
	<div class="section-border">
		{$section_content}
		{if $section_state}
			<p align="right">
				<a href="{$index_script}?{$smarty.server.QUERY_STRING}&amp;close_section={$key}" class="underlined">{$lang.close}</a>
			</p>
		{/if}
	</div>
</div>