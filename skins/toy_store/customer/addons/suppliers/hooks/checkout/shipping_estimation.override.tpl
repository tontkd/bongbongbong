{* $Id: shipping_estimation.override.tpl 7774 2009-07-31 09:47:01Z zeke $ *}

{if $cart.use_suppliers}
	{include file="addons/suppliers/views/checkout/components/shipping_rates.tpl" display="radio"}
{/if}