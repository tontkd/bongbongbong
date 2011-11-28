{* $Id: original.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

{** block-description:original **}
{foreach from=$items item="banner" key="key"}
	{if $banner.main_pair.image_id && $banner.type == "G"}
	<div class="ad-container center">
		{if $banner.url != ""}<a href="{$banner.url}" {if $banner.target == "B"}target="_blank"{/if}>{/if}
		{include file="common_templates/image.tpl" images=$banner.main_pair object_type="common"}
		{if $banner.url != ""}</a>{/if}
	</div>
	{else}
		{$banner.description|unescape}
	{/if}
{/foreach}