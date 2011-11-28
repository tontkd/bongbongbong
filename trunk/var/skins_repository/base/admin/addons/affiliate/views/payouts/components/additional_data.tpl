{* $Id: additional_data.tpl 6850 2009-01-30 13:32:06Z lexa $ *}
{if $data}
	{foreach from=$data key="key_name" item="item_id" name="for_add_data"}
		{if $key_name == "O"}
			<p>{$lang.order}: <a href="{$index_script}?dispatch=orders.details&amp;order_id={$item_id}">#{$item_id}</a> {include file="common_templates/status.tpl" display="view" status=$data.order_status}</p>
		{elseif $key_name == "P" && $data.product_name}
			<p>{$lang.product}: <a href="{$index_script}?dispatch=products.update&amp;product_id={$item_id}">{$data.product_name}</a></p>
		{elseif $key_name == "D" && $data.coupon.coupon_code}
			<p>{$lang.coupon_code}: <a href="{$index_script}?dispatch=discounts.{if $data.coupon.type == "G"}globals{elseif $data.coupon.type == "C"}categories{elseif $data.coupon.type == "P"}products{elseif $data.coupon.type == "U"}users{/if}&amp;discount_id={$item_id}">{$data.coupon.coupon_code}</a></p>
		{elseif $key_name == "R" && $item_id}
			 <p>{$lang.url}: <a href="{$item_id}" target="_blank">{$item_id}</a></p>
		{/if}
	{/foreach}
{/if}
