{* $Id: view.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

{if $news}

{capture name="tabsbox"}
<div id="content_news">
<table cellpadding="4" cellspacing="0" border="0" width="100%">
<tr class="table-row">
	<td colspan="2">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td class="nowrap strong">{$news.news}</td>
			<td width="100%">&nbsp;&nbsp;&nbsp;</td>
			<td class="right nowrap"><strong>{$lang.date_added}:</strong> {$news.date|date_format:"`$settings.Appearance.date_format`"}</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td width="100%">
		{$news.description|unescape}
	</td>
</tr>
</table>
</div>
{hook name="news:view"}
{/hook}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}

{capture name="mainbox_title"}{$lang.site_news}{/capture}

{/if}
