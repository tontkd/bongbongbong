{* $Id: additional_data.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if $data}
	{foreach from=$data key="key_name" item="item_id" name="for_add_data"}
	<p>
		{if $key_name=="O"}{assign var="order_status_data" value=$data.order_status|fn_get_status_data}
			{$lang.order}: {if $affiliate_plan.show_orders == "Y"}<a href="{$index_script}?dispatch=orders.search&amp;order_id={$item_id}" target="_blank">{/if}#{$item_id}{if $affiliate_plan.show_orders == "Y"}</a>{/if} {$lang.status}: {$order_status_data.description}
		{elseif $key_name=="P" && $data.product_name}
			{$lang.product}: <a onclick="window.open('{$index_script}?dispatch=products.view&product_id={$item_id}','product_popup_window','width=450,height=350,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');">{$data.product_name}</a>
		{elseif $key_name=="D" && $data.coupon.coupon_code}
			{$lang.coupon_code}: {$data.coupon.coupon_code}{*</a>*}
		{elseif $key_name=="R" && $item_id}
			 {$lang.url}: <a href="{$item_id}" target="_blank">{$item_id}</a>
		{/if}
	</p>
	{/foreach}
{/if}
