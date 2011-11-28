{* $Id: summary.tpl 7286 2009-04-16 13:13:14Z angel $ *}

{foreach from=$tags_summary item="tag"}

{capture name="title_text"}
	{$tag.tag} ({$tag.total}) 
	<a href="{$index_script}?dispatch=tags.delete&amp;tag_id={$tag.tag_id}&amp;redirect_url={$config.current_url|escape:url}" class="cm-confirm"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" /></a>
{/capture}

{include file="common_templates/subheader.tpl" title=$smarty.capture.title_text}
	{if $tag.products}
	<div class="clear">
		<div class="tags-group">{$lang.products}:</div>
		<div class="tags-list-container">
		<ul>
		{foreach from=$tag.products item="tag_product" key="tag_product_id"}
			<li><a href="{$index_script}?dispatch=products.view&amp;product_id={$tag_product_id}">{$tag_product}</a>&nbsp;<a href="{$index_script}?dispatch=tags.delete&amp;tag_id={$tag.tag_id}&amp;object_type=P&amp;object_id={$tag_product_id}&amp;redirect_url={$config.current_url|escape:url}" class="cm-confirm"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" /></a></li>
		{/foreach}
		</ul>
		</div>
	</div>
	{/if}

	{if $tag.pages}
	<div class="clear">
		<div class="tags-group">{$lang.pages}:</div>
		<div class="tags-list-container">
		<ul>
		{foreach from=$tag.pages item="tag_page" key="tag_page_id"}
			<li><a href="{$index_script}?dispatch=pages.view&amp;page_id={$tag_page_id}">{$tag_page}</a>&nbsp;<a href="{$index_script}?dispatch=tags.delete&amp;tag_id={$tag.tag_id}&amp;object_type=A&amp;object_id={$tag_page_id}&amp;redirect_url={$config.current_url|escape:url}" class="cm-confirm"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" /></a></li>
		{/foreach}
		</ul>
		</div>
	</div>
	{/if}

	{hook name="tags:summary"}{/hook}

{foreachelse}
	{$lang.no_items}
{/foreach}

{capture name="mainbox_title"}{$lang.my_tags_summary}{/capture}
