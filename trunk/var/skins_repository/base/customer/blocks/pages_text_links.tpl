{* $Id: pages_text_links.tpl 7736 2009-07-17 13:53:32Z lexa $ *}
{** block-description:text_links **}

{if $items}
<ul>
	{foreach from=$items item="page"}
	<li><a href="{if $page.page_type == $smarty.const.PAGE_TYPE_LINK}{$page.link}{else}{$index_script}?dispatch=pages.view&amp;page_id={$page.page_id}{/if}"{if $page.new_window} target="_blank"{/if}{if $block.properties.positions == "left" || $block.properties.positions == "right"} title="{$page.page}">{$page.page|unescape|strip_tags|truncate:40:"...":true}{else}>{$page.page|unescape}{/if}</a></li>
	{/foreach}
</ul>
{/if}