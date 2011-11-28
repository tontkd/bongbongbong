{* $Id: extra_list.post.tpl 7576 2009-06-11 08:20:03Z angel $ *}

{if $order_info.gift_certificates}

{foreach from=$order_info.gift_certificates item="gift" key="gift_key" name="gift_cycle"}
<tr>
	<td style="padding: 5px 10px; background-color: #ffffff;">
		{$lang.gift_certificate}
		{if $gift.gift_cert_code}
		<p>{$lang.code}:&nbsp;{$gift.gift_cert_code}</p>
		{/if}
	</td>
	<td style="padding: 5px 10px; background-color: #ffffff; text-align: center;">&nbsp;1</td>
	<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</td>	
	{if $order_info.use_discount}
	<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">-</td>
	{/if}
	{if $order_info.taxes}
	<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;">-</td>
	{/if}

	<td style="padding: 5px 10px; background-color: #ffffff; text-align: right;"><b>{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</b>&nbsp;</td>
</tr>
{if $gift.products && $addons.gift_certificates.free_products_allow == 'Y'}
<tr>
	{assign var="_colspan" value="4"}
	{if $order_info.use_discount}{assign var="_colspan" value=$_colspan+1}{/if}
	{if $order_info.taxes}{assign var="_colspan" value=$_colspan+1}{/if}
	<td style="padding: 5px 10px; background-color: #ffffff;" colspan="{$_colspan}">
		<p>{$lang.free_products} ({$gift.gift_cert_code|default:"&nbsp;"}):</p>

		<table width="100%" cellpadding="0" cellspacing="1" style="background-color: #dddddd;">
		<tr>
			<th width="70%" style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.product}</th>
			<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap;">{$lang.quantity}</th>
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
		{if $oi.extra.parent.certificate && $oi.extra.parent.certificate == $gift_key}
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
	</td>
</tr>
{/if}
{/foreach}
{/if}