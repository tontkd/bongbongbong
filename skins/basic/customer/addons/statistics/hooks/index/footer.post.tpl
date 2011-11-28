{* $Id: footer.post.tpl 6730 2009-01-09 10:02:44Z zeke $ *}

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){$ldelim}
	jQuery.ajaxRequest('{$index_script}?dispatch=statistics.collect', {$ldelim}
		method: 'post',
		data: {$ldelim}
			've[url]': location.href,
			've[title]': document.title,
			've[browser_version]': jQuery.ua.version,
			've[browser]': jQuery.ua.browser,
			've[os]': jQuery.ua.os,
			've[client_language]': jQuery.ua.language,
			've[referrer]': document.referrer,
			've[screen_x]': (screen.width || null),
			've[screen_y]': (screen.height || null),
			've[color]': (screen.colorDepth || screen.pixelDepth || null),
			've[time_begin]': {$smarty.const.MICROTIME}
		{$rdelim},
		hidden: true
	{$rdelim});
{$rdelim});
//]]>
</script>

<noscript>
<object data="{$index_script}?dispatch=statistics.collect&amp;ve[url]={$config.current_location}/{$config.current_url|escape:url}&amp;ve[title]={if $page_title}{$page_title|escape:url}{else}{$lang.page_title_text|escape:url}{foreach from=$breadcrumbs item=i name="bkt"}{if $smarty.foreach.bkt.index == 1} - {/if}{if !$smarty.foreach.bkt.first}{$i.title|escape:url}{if !$smarty.foreach.bkt.last} :: {/if}{/if}{/foreach}{/if}&amp;ve[referrer]={$smarty.server.HTTP_REFERER|escape:url}&amp;ve[time_begin]={$smarty.const.MICROTIME}" width="0" height="0"></object>
</noscript>