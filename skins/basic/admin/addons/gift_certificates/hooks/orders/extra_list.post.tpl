{* $Id: extra_list.post.tpl 6628 2008-12-22 09:46:20Z lexa $ *}

{if $order_info.gift_certificates}
{foreach from=$order_info.gift_certificates item="gift" key="gift_key"}
{cycle values="class=\"manage-row\", " assign="_class" name="class_cycle"}
<tr {$_class}>
	<td>
		{$lang.gift_certificate}&nbsp;
		<span align="right"><a href="#print_postal_card" onclick="window.open('{$index_script}?dispatch=gift_certificates.print&amp;order_id={$order_info.order_id}&amp;gift_cert_cart_id={$gift_key}','popupwindow','width=800,height=600,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');">{$lang.print_card}&nbsp;<img src="{$images_dir}/icons/section_icon.gif" align="absmiddle" width="12" height="10" border="0" alt="" /></a></span>
		{if $gift.gift_cert_code}
		<p>{$lang.code}:&nbsp;<a href="{$index_script}?dispatch=gift_certificates.update&amp;gift_cert_id={$gift.gift_cert_id}">{$gift.gift_cert_code}</a></p>
		{/if}
	</td>
	<td>{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</td>
	<td class="center">&nbsp;1</td>
	{if $order_info.use_discount}
	<td>-</td>
	{/if}
	{if $order_info.taxes}
	<td>-</td>
	{/if}
	<td class="right">&nbsp;<strong>{if !$gift.extra.exclude_from_calculate}{include file="common_templates/price.tpl" value=$gift.display_subtotal}{else}{$lang.free}{/if}</strong></td>
</tr>
{assign var="_colspan" value="4"}
<tr {$_class}>
	<td>&nbsp;
		<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_gc_{$gift_key}" class="hand cm-combination" /><img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_gc_{$gift_key}" class="hand cm-combination hidden" />
		<a class="cm-combination" id="sw_gc_{$gift_key}">{$lang.details_upper}</a></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	{if $order_info.use_discount}
		{assign var="_colspan" value=$_colspan+1}
		<td>&nbsp;</td>
	{/if}
	{if $order_info.taxes}
		{assign var="_colspan" value=$_colspan+1}
		<td>&nbsp;</td>
	{/if}
	<td>&nbsp;</td>
</tr>
<tbody id="gc_{$gift_key}" class="hidden">
<tr {$_class}>
	<td colspan="{$_colspan}">
	<div class="box">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="noborder">
		<tr>
			<td class="nowrap"><strong>{$lang.gift_cert_to}</strong>:</td>
			<td>&nbsp;</td>
			<td class="nowrap" width="100%">{$gift.recipient}</td>
		</tr>
		<tr>
			<td class="nowrap"><strong>{$lang.gift_cert_from}</strong>:</td>
			<td>&nbsp;</td>
			<td class="nowrap" width="100%">{$gift.sender}</td>
		</tr>
		<tr>
			<td class="nowrap"><strong>{$lang.amount}</strong>:</td>
			<td>&nbsp;</td>
			<td class="nowrap" width="100%">{include file="common_templates/price.tpl" value=$gift.amount}</td>
		</tr>
		<tr>
			<td class="nowrap"><strong>{$lang.send_via}</strong>:</td>
			<td>&nbsp;</td>
			<td class="nowrap" width="100%">{if $gift.send_via == "E"}{$lang.email}{else}{$lang.postal_mail}{/if}</td>
		</tr>
		</table>
		{if $gift.products && $addons.gift_certificates.free_products_allow == "Y"}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="50%">{$lang.product}</th>
			<th width="10%">{$lang.price}</th>
			<th width="10%" class="center">{$lang.quantity}</th>
			{if $order_info.use_discount}
			<th width="10%">{$lang.discount}</th>
			{/if}
			{if $order_info.taxes}
			<th width="10%">{$lang.tax}</th>
			{/if}
			<th class="right" width="10%">{$lang.subtotal}</th>
		</tr>
		{foreach from=$order_info.items item="oi" key="sub_key"}
		{if $oi.extra.parent.certificate && $oi.extra.parent.certificate == $gift_key}
		<tr valign="top">
			<td>
				{if $oi.product}
					<a href="{$index_script}?dispatch=products.update&amp;product_id={$oi.product_id}">{$oi.product|truncate:50:"...":true}</a>
				{else}
					{$lang.deleted_product}
				{/if}
				{hook name="orders:product_info"}
				{if $oi.product_code}
				<p>{$lang.code}:&nbsp;{$oi.product_code}</p>
				{/if}
				{/hook}
				{if $oi.product_options}<div class="options-info">&nbsp;{include file="common_templates/options_info.tpl" product_options=$oi.product_options}</div>{/if}
			</td>
			<td>
				{include file="common_templates/price.tpl" value=$oi.price}</td>
			<td class="center">
				{$oi.amount}</td>
			{if $order_info.use_discount}
			<td>
				{if $oi.extra.discount|floatval}{include file="common_templates/price.tpl" value=$oi.extra.discount}{else}-{/if}</td>
			{/if}
			{if $order_info.taxes}
			<td>
				{include file="common_templates/price.tpl" value=$oi.tax_value}</td>
			{/if}
			<td class="nowrap right">
				{include file="common_templates/price.tpl" value=$oi.display_subtotal}</td>
		</tr>
		{/if}
		{/foreach}
		</table>
		{/if}
		</div>
	</td>
</tr>
</tbody>
{/foreach}

{/if}
