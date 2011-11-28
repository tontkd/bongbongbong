{* $Id: search.tpl 7200 2009-04-07 06:59:18Z zeke $ *}

<form action="{$index_script}" name="search_form" method="get">
<input type="hidden" name="subcats" value="Y" />
<input type="hidden" name="type" value="extended" />
<input type="hidden" name="status" value="A" />
<input type="hidden" name="pshort" value="Y" />
<input type="hidden" name="pfull" value="Y" />
<input type="hidden" name="pname" value="Y" />
<input type="hidden" name="pkeywords" value="Y" />
{hook name="search:additional_fields"}{/hook} 

<span class="search-products-text">{$lang.search}:</span>

{if !$settings.General.search_objects}
<select	name="cid" class="search-selectbox">
	<option	value="0">- {$lang.all_categories} -</option>
	{foreach from=0|fn_get_subcategories item="cat"}
	<option	value="{$cat.category_id}" {if $mode == "search" && $smarty.request.cid == $cat.category_id}selected="selected"{elseif $smarty.request.category_id == $cat.category_id}selected="selected"{/if}>{$cat.category|escape:html}</option>
	{/foreach}
</select>
{/if}

{strip}
<input type="text" name="q" value="{$search.q}" onfocus="this.select();" class="search-input" />

{if $settings.General.search_objects}
	{include file="buttons/go.tpl" but_name="search.results" alt=$lang.search}
{else}
	{include file="buttons/go.tpl" but_name="products.search" alt=$lang.search}
{/if}
{if !$hide_advanced_search}
<a href="{$index_script}?dispatch=products.search" class="search-advanced">{$lang.advanced_search}</a>
{/if}
{/strip}

</form>
