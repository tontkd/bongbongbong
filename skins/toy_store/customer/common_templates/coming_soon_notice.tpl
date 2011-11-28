{* $Id: coming_soon_notice.tpl 6967 2009-03-04 09:26:06Z angel $ *}

<div class="product-coming-soon">
	{assign var="date" value=$avail_date|date_format:$settings.Appearance.date_format}
	{if $add_to_cart == "N"}{$lang.product_coming_soon|replace:"[avail_date]":$date}{else}{$lang.product_coming_soon_add|replace:"[avail_date]":$date}{/if}
</div>
