{* $Id: view_all.tpl 6962 2009-03-02 14:40:38Z angel $ *}

{if $view_all_filter}
{assign var="filter_qstring" value=$smarty.request.q|fn_query_remove:"result_ids":"filter_id":"features_hash"}
{split data=$view_all_filter size="4" assign="splitted_filter" preverse_keys=true}
<table cellpadding="5" cellspacing="0" border="0" width="100%" class="view-all">
{foreach from=$splitted_filter item="group"}
<tr valign="top">
	{foreach from=$group item="ranges" key="index"}
	<td class="center">
		<div>
			{if $ranges}
				{include file="common_templates/subheader.tpl" title=$index}
				<ul class="arrows-list">
				{foreach from=$ranges item="range"}
					<li><a href="{$filter_qstring}&amp;features_hash={$params.features_hash|fn_add_range_to_url_hash:$range}">{$range.range_name|fn_text_placeholders}</a></li>
				{/foreach}
			</ul>
			{else}&nbsp;{/if}
		</div>
	</td>
	{/foreach}
</tr>
{/foreach}
</table>
{/if}
