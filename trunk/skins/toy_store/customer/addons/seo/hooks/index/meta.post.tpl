{* $Id: meta.post.tpl 7200 2009-04-07 06:59:18Z zeke $ *}

<base href="{$smarty.const.REAL_LOCATION}/" />
{if $languages|sizeof > 1}
{foreach from=$languages item="language"}
<link title="{$language.name}" dir="rtl" type="text/html" rel="alternate" charset="{$smarty.const.CHARSET}" hreflang="{$language.lang_code|lower}" href="{capture name="t_url"}{$config.current_url}&amp;sl={$language.lang_code}{/capture}{$smarty.capture.t_url|fn_convert_php_urls}" />
{/foreach}
{/if}
