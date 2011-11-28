{* $Id: price.tpl 5974 2008-09-23 13:57:11Z brook $ *}
{strip}
{if $settings.General.alternative_currency == "Y"}
	{$value|format_price:$currencies.$primary_currency:$span_id:$class:false|unescape}{if $secondary_currency != $primary_currency}&nbsp;({$value|format_price:$currencies.$secondary_currency:$span_id:$class:true|unescape}){/if}
{else}
	{$value|format_price:$currencies.$secondary_currency:$span_id:$class:true|unescape}
{/if}
{/strip}