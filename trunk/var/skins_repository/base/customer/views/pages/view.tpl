{* $Id: view.tpl 7698 2009-07-13 07:03:17Z zeke $ *}

{hook name="pages:page_content"}
{$page.description|unescape}
{/hook}

{if $page_children}
<ul class="subpages-list">
	{foreach from=$page_children item=child_page}
		<li><span class="main-info">{$child_page.timestamp|date_format:$settings.Appearance.date_format}&nbsp;<a href="{if $child_page.page_type == $smarty.const.PAGE_TYPE_LINK}{$child_page.link}{else}{$index_script}?dispatch=pages.view&amp;page_id={$child_page.page_id}{/if}">{$child_page.page}</a></span></li>
	{/foreach}
</ul>
{/if}

{capture name="mainbox_title"}{$page.page}{/capture}

{hook name="pages:page_extra"}
{/hook}