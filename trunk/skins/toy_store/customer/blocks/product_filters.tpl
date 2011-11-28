{* $Id: product_filters.tpl 7866 2009-08-20 08:27:15Z alexey $ *}
{** block-description:original **}

<!--dynamic:filters-->
{if $items && !$smarty.request.advanced_filter}

{if $smarty.server.QUERY_STRING|strpos:"dispatch=" !== false}
	{assign var="filter_qstring" value=$config.current_url|fn_query_remove:"result_ids":"filter_id":"view_all":"req_range_id":"advanced_filter":"features_hash":"subcats"}
{else}
	{assign var="filter_qstring" value="$index_script?dispatch=products.search"}
{/if}

{assign var="reset_qstring" value=$filter_qstring}

{if $smarty.request.category_id}
	{assign var="filter_qstring" value="`$filter_qstring`&amp;subcats=Y"}
	{assign var="reset_qstring" value="`$reset_qstring`&amp;subcats=Y"}
	{assign var="extra_query" value="&amp;subcats=Y"}
{/if}

{assign var="has_selected" value=false}
{foreach from=$items item="filter" name="filters"}

<h4>{$filter.filter}</h4>
<ul class="product-filters" id="content_product_more_filters_{$filter.filter_id}">
{foreach from=$filter.ranges name="ranges" item="range"}
	<li {if $smarty.foreach.ranges.iteration > $smarty.const.FILTERS_RANGES_COUNT}class="hidden"{/if}>
		{strip}
		{if $range.selected == true}
			{assign var="fh" value=$smarty.request.features_hash|fn_delete_range_from_url:$range:$filter.field_type}
			{assign var="has_selected" value=true}
			<a class="extra-link filter-delete" href="{if $filter.feature_type == "E" && $range.range_id == $smarty.request.variant_id}{$index_script}?dispatch=products.search{if $fh}&amp;features_hash={$fh}{/if}{$extra_query}{else}{$reset_qstring}{if $fh}&amp;features_hash={$fh}{/if}{$extra_query}{/if}" title="{$lang.remove}"><img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove}" align="bottom" /></a>{$filter.prefix}{$range.range_name|fn_text_placeholders}{$filter.suffix}

			{if $filter.other_variants}
			<ul id="other_variants_{$filter.filter_id}" class="hidden">
			{foreach from=$filter.other_variants item="r"}
			<li>
				<a href="{if $r.feature_type == "E" && !$r.simple_link}{$index_script}?dispatch=product_features.view&amp;variant_id={$r.range_id}{if $fh}&amp;features_hash={$fh}{/if}{else}{$filter_qstring}&features_hash={$fh|fn_add_range_to_url_hash:$r:$filter.field_type}{/if}">{$filter.prefix}{$r.range_name|fn_text_placeholders}{$filter.suffix}</a>&nbsp;<span class="details">&nbsp;({$r.products})</span>
			</li>
			{/foreach}
			</ul>
			<p><a id="sw_other_variants_{$filter.filter_id}" class="extra-link cm-combination">{$lang.choose_other}</a></p>
			{/if}
		{else}
			<a href="{if $filter.feature_type == "E" && !$filter.simple_link}{$index_script}?dispatch=product_features.view&amp;variant_id={$range.range_id}{if $smarty.request.features_hash}&amp;features_hash={$smarty.request.features_hash}{/if}{else}{$filter_qstring}&amp;features_hash={$smarty.request.features_hash|fn_add_range_to_url_hash:$range:$filter.field_type}{/if}">{$filter.prefix}{$range.range_name|fn_text_placeholders}{$filter.suffix}</a>&nbsp;<span class="details">&nbsp;({$range.products})</span>
		{/if}
		{/strip}
	</li>
{/foreach}

{if $smarty.foreach.ranges.iteration > $smarty.const.FILTERS_RANGES_COUNT}
	<li class="right">
		<a href="{$filter_qstring}&amp;filter_id={$filter.filter_id}&amp;more_filters=Y" onclick="$('#content_product_more_filters_{$filter.filter_id} li').show(); $('#view_all_{$filter.filter_id}').show(); $(this).hide(); return false;" class="extra-link">{$lang.more}</a>
	</li>
{/if}

{if $filter.more_cut}
	{capture name="q"}{$filter_qstring|unescape}&filter_id={$filter.filter_id}&{if $smarty.request.features_hash}&features_hash={$smarty.request.features_hash|fn_delete_range_from_url:$range:$filter.field_type}{/if}{/capture}
	<li id="view_all_{$filter.filter_id}" class="right hidden">
		<a href="{$index_script}?dispatch=product_features.view_all&amp;q={$smarty.capture.q|escape:url}" class="extra-link">{$lang.view_all}</a>
	</li>
{/if}

<li class="delim">&nbsp;</li>

</ul>

{/foreach}

<div class="clear filters-tools">
	<div class="float-right"><a href="{if !"FILTER_CUSTOM_ADVANCED"|defined}{$index_script}?dispatch=products.search&amp;advanced_filter=Y{else}{$reset_qstring}&amp;advanced_filter=Y{/if}">{$lang.advanced}</a></div>
	{if $has_selected}
	<a href="{if $smarty.request.category_id}{$index_script}?dispatch=categories.view&amp;category_id={$smarty.request.category_id}{else}{$index_script}{/if}" class="reset-filters">{$lang.reset}</a>
	{/if}
</div>
{/if}
<!--/dynamic-->