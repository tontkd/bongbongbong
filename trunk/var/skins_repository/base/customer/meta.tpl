{* $Id: meta.tpl 7497 2009-05-19 10:41:21Z zeke $ *}

{hook name="index:meta"}
<meta http-equiv="Content-Type" content="text/html; charset={$smarty.const.CHARSET}" />
<meta http-equiv="Content-Language" content="{$smarty.const.CART_LANGUAGE|lower}" />
<meta name="description" content="{$meta_description|default:$lang.home_meta_description}" />
<meta name="keywords" content="{$meta_keywords|default:$lang.home_meta_keywords}" />
<meta name="author" content="Simbirsk Technologies LTD." />
<meta name="robots" content="index, all" />
{/hook}