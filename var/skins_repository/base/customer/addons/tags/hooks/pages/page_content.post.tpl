{* $Id: page_content.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $addons.tags.tags_for_pages == "Y"}
	{include file="common_templates/subheader.tpl" title=$lang.tags}
	{include file="addons/tags/views/tags/components/tags.tpl" object_type="A" object_id=$page.page_id object=$page}
{/if}
