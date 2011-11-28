{* $Id: visitors.tpl 7836 2009-08-14 14:30:50Z alexey $ *}

{capture name="tabsbox"}

<div id="content_visitors_log">
{capture name="mainbox"}

{capture name="extra"}
<input type="hidden" name="client_type" value="{$search.client_type}" />
<input type="hidden" name="section" value="{$smarty.request.section}" />
{/capture}
{include file="addons/statistics/views/statistics/components/search_form.tpl" key="visitors" extra=$smarty.capture.extra report_data=$statistics_data dispatch="statistics.visitors"}

{if $text_conditions}
	{include file="common_templates/subheader.tpl" title=$lang.conditions}
	{foreach from=$text_conditions key="lang_var" item="cond"}
		<div class="form-field">
			<label>{$lang.$lang_var}</label>
			{$cond|unescape}
		</div>
	{/foreach}
{/if}

{include file="addons/statistics/views/statistics/components/visitors.tpl" visitors_log=$statistics_data.visitors_log}

{/capture}
{capture name="title"}{if $search.client_type == "B"}{$lang.robots_log}{else}{$lang.visitors_log}{/if}{/capture}
{include file="common_templates/mainbox.tpl" title=$smarty.capture.title content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra}
<!--content_visitors_log--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox}