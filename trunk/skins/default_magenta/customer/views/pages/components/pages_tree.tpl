{* $Id: pages_tree.tpl 6535 2008-12-12 06:29:50Z angel $ *}
{if !$root}
{* to make $smarty.foreach.fe.last work only for root level elements (to show delimiter) *}
{assign var="not_root" value="_"}
{/if}

{foreach from=$tree item="page" key="key" name="fe`$not_root`"}
	{if $page.page_id == $smarty.request.page_id}{assign var="path" value=$page.id_path}{/if}
{/foreach}

{foreach from=$tree item="page" key="key" name="fe`$not_root`"}
	{math equation="x*7" x=$page.level assign="shift"}
	
	<li class="{if $page.has_children && $path|substr_count:$page.page_id}cm-expanded{elseif $page.has_children}cm-collapsed{/if}"><a href="{if $page.page_type == $smarty.const.PAGE_TYPE_LINK}{$page.link}{else}{$index_script}?dispatch=pages.view&amp;page_id={$page.page_id}{/if}"{if $page.new_window} target="_blank"{/if}{if $page.level != "0"} style="padding-left: {$shift}px;"{/if}>{$page.page}</a>
</li>
{if $root && !$smarty.foreach.fe.last && !$no_delim}<li class="delim"></li>{/if}
{/foreach}

