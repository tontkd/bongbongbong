{* $Id: sorting.tpl 7840 2009-08-17 08:44:07Z zeke $ *}

<!--dynamic:product_sorting-->
{if $settings.DHTML.customer_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}
{/if}

{assign var="curl" value=$config.current_url|fn_query_remove:"sort_by":"sort_order":"result_ids":"layout"}
{assign var="sorting" value=""|fn_get_products_sorting:"false"}
{assign var="layouts" value=""|fn_get_products_views:false:false}

{if $search.sort_order == "asc"}
	{capture name="sorting_text"}
		{$sorting[$search.sort_by].description}&nbsp;<img src="{$images_dir}/icons/sort_desc.gif" width="7" height="6" border="0" alt="" />
	{/capture}
{else}
	{capture name="sorting_text"}
		{$sorting[$search.sort_by].description}&nbsp;<img src="{$images_dir}/icons/sort_asc.gif" width="7" height="6" border="0" alt="" />
	{/capture}
{/if}

{if !(($category_data.selected_layouts|count == 1) || ($category_data.selected_layouts|count == 0 && ""|fn_get_products_views:true|count <= 1)) }
<div class="float-left">
<strong>{$lang.view_as}:</strong>&nbsp;
{capture name="tools_list"}
	<ul>
	{foreach from=$layouts key="layout" item="item"}
		{if ($category_data.selected_layouts.$layout) || (!$category_data.selected_layouts && $item.active)}
			<li><a class="{$ajax_class} {if $layout == $selected_layout}active{/if}" rev="pagination_contents" href="{$curl}&amp;sort_by={$search.sort_by}&amp;sort_order={if $search.sort_order == "asc"}desc{else}asc{/if}&amp;layout={$layout}" rel="nofollow">{$item.title}</a></li>
		{/if}
	{/foreach}
	</ul>
{/capture}
{include file="common_templates/tools.tpl" tools_list=$smarty.capture.tools_list suffix="view_as" link_text=$layouts.$selected_layout.title}
</div>
{/if}

<div class="right">
<strong>{$lang.sort_by}:</strong>&nbsp;
{capture name="tools_list"}
	<ul>
		{foreach from=$sorting key="option" item="value"}
			<li><a class="{$ajax_class} {if $search.sort_by == $option}active{/if}" rev="pagination_contents" href="{$curl}&amp;sort_by={$option}&amp;sort_order={if $search.sort_by == $option}{$search.sort_order}{else}{if $value.default_order}{$value.default_order}{else}asc{/if}{/if}" rel="nofollow">{$value.description}{if $search.sort_by == $option}&nbsp;{if $search.sort_order == "asc"}<img src="{$images_dir}/icons/sort_desc.gif" width="7" height="6" border="0" alt="" />{else}<img src="{$images_dir}/icons/sort_asc.gif" width="7" height="6" border="0" alt="" />{/if}{/if}</a>
			</li>
		{/foreach}
	</ul>
{/capture}
{include file="common_templates/tools.tpl" tools_list=$smarty.capture.tools_list suffix="sort_by" link_text=$smarty.capture.sorting_text}
</div>

<hr />
<!--/dynamic-->