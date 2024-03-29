{* $Id: items_list_row.override.tpl 7576 2009-06-11 08:20:03Z angel $ *}

{if $oi.extra.configuration}
	{assign var="conf_oi" value=$oi}
	{foreach from=$order_info.items item="sub_oi"}
	{if $sub_oi.extra.parent.configuration && $sub_oi.extra.parent.configuration==$oi.cart_id}
	{math equation="item_price + conf_price" item_price=$sub_oi.price|default:"0" conf_price=$conf_price|default:$oi.price assign="conf_price"}	
	{math equation="discount + conf_discount" discount=$sub_oi.extra.discount|default:"0" conf_discount=$conf_discount|default:"0" assign="conf_discount"}
	{math equation="tax + conf_tax" tax=$sub_oi.tax_value|default:"0" conf_tax=$conf_tax|default:"0" assign="conf_tax"}
	{math equation="subtotal + conf_subtotal" subtotal=$sub_oi.display_subtotal|default:"0" conf_subtotal=$conf_subtotal|default:$oi.display_subtotal assign="conf_subtotal"}
	{/if}
	{/foreach}
	<tr>
		<td style="padding: 5px 10px; background-color: #ffffff;">{$oi.product}
			{hook name="orders:product_info"}
			{if $oi.product_code}<p>{$lang.code}:&nbsp;{$oi.product_code}</p>{/if}
			{/hook}
			{if $oi.product_options}<div style="padding-top: 1px; padding-bottom: 2px;">{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}</td>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;">{$oi.amount}</td>
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{include file="common_templates/price.tpl" value=$conf_price|default:0}</td>
		{if $order_info.use_discount}
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $conf_discount|floatval}{include file="common_templates/price.tpl" value=$conf_discount}{else}&nbsp;-&nbsp;{/if}</td>
		{/if}
		{if $order_info.taxes}
		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $conf_tax}{include file="common_templates/price.tpl" value=$conf_tax}{else}&nbsp;-&nbsp;{/if}</td>
		{/if}

		<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><b>{include file="common_templates/price.tpl" value=$conf_subtotal}</b>&nbsp;</td>
	</tr>
	<tr>
		{assign var="_colspan" value="4"}
		{if $order_info.use_discount}{assign var="_colspan" value=$_colspan+1}{/if}
		{if $order_info.taxes}{assign var="_colspan" value=$_colspan+1}{/if}
		<td style="padding: 5px 10px; background-color: #ffffff;" colspan="{$_colspan}">
			<p>{$lang.configuration}:</p>


		<table width="100%" cellpadding="0" cellspacing="1" style="background-color: #dddddd;">
		<tr>
			<th width="70%" style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.product}</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.amount}</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.unit_price}</th>
			{if $order_info.use_discount}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.discount}</th>
			{/if}
			{if $order_info.taxes}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.tax}</th>
			{/if}
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.subtotal}</th>
		</tr>
		{foreach from=$order_info.items item="oi" key="sub_key"}
		{if $oi.extra.parent.configuration && $oi.extra.parent.configuration == $conf_oi.cart_id}
		<tr>
			<td style="padding: 5px 10px; background-color: #ffffff;">{$oi.product|default:$lang.deleted_product}
				{hook name="orders:product_info"}
				{if $oi.product_code}<p>{$lang.code}:&nbsp;{$oi.product_code}</p>{/if}
				{/hook}
				{if $oi.product_options}<div style="padding-top: 1px; padding-bottom: 2px;">{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
			</td>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;">{$oi.amount}</td>
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{include file="common_templates/price.tpl" value=$oi.price}</td>
			{if $order_info.use_discount}
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $oi.extra.discount|floatval}{include file="common_templates/price.tpl" value=$oi.extra.discount}{else}&nbsp;-&nbsp;{/if}</td>
			{/if}
			{if $order_info.taxes}
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if $oi.tax_value}{include file="common_templates/price.tpl" value=$oi.tax_value}{else}&nbsp;-&nbsp;{/if}</td>
			{/if}
			<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{include file="common_templates/price.tpl" value=$oi.display_subtotal}&nbsp;</td>
		</tr>
		{/if}
		{/foreach}
		</table>
	</tr>
{/if}