{* $Id: results.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

<div>{$lang.total_results}:&nbsp;<strong>{$search_results_total}</strong></div>
<hr />

{if $search_results}

{include file="common_templates/pagination.tpl"}

{foreach from=$search_results item="result"}
{if !$result.first}
<hr />
{/if}

{hook name="search::search_results"}
{if $result.object == "products"}
	{include file="views/products/components/one_product.tpl" product=$result key=$result.id}

{elseif $result.object == "pages"}
	{include file="views/pages/components/one_page.tpl" page=$result}
{/if}
{/hook}

{/foreach}

{include file="common_templates/pagination.tpl"}

<div>
	{$lang.total_results}:&nbsp;<strong>{$search_results_total}</strong>
</div>

{else}
<p class="no-items">{$lang.text_no_matching_results_found}</p>

{/if}

{capture name="mainbox_title"}{$lang.search_results}{/capture}