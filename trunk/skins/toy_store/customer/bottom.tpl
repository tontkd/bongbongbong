{* $Id: bottom.tpl 7890 2009-08-24 12:05:08Z zeke $ *}

<div class="bottom-search center">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	{include file="common_templates/search.tpl" hide_advanced_search=true}
</div>
<div>
<center><img src="{$images_dir}/customer_area_logo.png" /></center>
</div>
<p class="quick-links">
	{foreach from=$quick_links item="link"}
		<a href="{$link.param}">{$link.descr}</a>
	{/foreach}
</p>
{hook name="index:bottom"}
<p class="bottom-copyright class">{$lang.copyright} &copy; {if $smarty.const.TIME|date_format:"%Y" != $settings.Company.company_start_year}{$settings.Company.company_start_year}-{/if}{$smarty.const.TIME|date_format:"%Y"} {$settings.Company.company_name}. &nbsp;{$lang.powered_by} <a href="http://www.cs-cart.com" target="_blank" class="underlined">{$lang.copyright_shopping_cart}</a>
</p>
{/hook}

{if $manifest.copyright}
<p class="bottom-copyright mini">{$lang.skin_by}&nbsp;<a href="{$manifest.copyright_url}">{$manifest.copyright}</a></p>
{/if}

{if "DEBUG_MODE"|defined}
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
{/if}