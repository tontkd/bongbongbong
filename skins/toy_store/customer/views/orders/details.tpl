{* $Id: details.tpl 7760 2009-07-29 11:53:02Z zeke $ *}

{if $view_only != "Y"}
<div align="right" class="clear">
<ul class="action-bullets">
{hook name="orders:details_bullets"}
{/hook}
</ul>
</div>
{/if}

{if $order_info}
	{if $view_only != "Y"}
		<div class="right">
			{include file="buttons/button.tpl" but_text=$lang.re_order but_href="`$index_script`?dispatch=orders.reorder&amp;order_id=`$order_info.order_id`"}{include file="buttons/button_popup.tpl" but_text=$lang.print_invoice but_href="`$index_script`?dispatch=orders.print_invoice&amp;order_id=`$order_info.order_id`" width="900" height="600"}
			
			{include file="buttons/button.tpl" but_text=$lang.print_pdf_invoice but_href="`$index_script`?dispatch=orders.print_invoice&amp;order_id=`$order_info.order_id`&amp;format=pdf"}
		</div>
	{/if}
	<div class="clear order-info">
	{hook name="orders:info"}
	<table cellpadding="2" cellspacing="0" border="0" class="float-left">
	<tr>
		<td><strong>{$lang.order}</strong>:&nbsp;</td><td>#{$order_info.order_id}</td>
	</tr>
	<tr>
		<td><strong>{$lang.date}</strong>:&nbsp;</td><td>{$order_info.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	</tr>
	<tr>
		<td><strong>{$lang.status}</strong>:&nbsp;</td><td>{include file="common_templates/status.tpl" status=$order_info.status display="view" name="update_order[status]"}</td>
	</tr>
	</table>
	{/hook}
	</div>

{capture name="group"}

{include file="common_templates/subheader.tpl" title=$lang.products_information}

<table cellpadding="0" cellspacing="0" border="0" class="table product-list" width="100%">
<tr>
	<th>{$lang.product}</th>
	<th>{$lang.price}</th>
	<th>{$lang.quantity}</th>
	{if $order_info.use_discount}
	<th>{$lang.discount}</th>
	{/if}
	{if $order_info.taxes}
	<th>{$lang.tax}</th>
	{/if}

	<th>{$lang.subtotal}</th>
</tr>
{foreach from=$order_info.items item="product" key="key"}
{hook name="orders:items_list_row"}
{if !$product.extra.parent}
{cycle values=",class=\"table-row\"" name="class_cycle" assign="_class"}
<tr {$_class} valign="top">
	<td>{if $product.deleted_product}{$lang.deleted_product}{else}<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>{/if}
		{if $product.extra.is_edp}
		<div class="right"><a href="{$index_script}?dispatch=orders.order_downloads&amp;order_id={$order_info.order_id}"><strong>[{$lang.download}]</strong></a></div>
		{/if}
		{if $product.product_code}
		<p>{$lang.code}:&nbsp;{$product.product_code}</p>
		{/if}
		{hook name="orders:product_info"}
		{if $product.product_options}{include file="common_templates/options_info.tpl" product_options=$product.product_options}{/if}
		{/hook}
	</td>
	<td class="right nowrap">
		{if $product.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$product.price}{/if}</td>
	<td class="center">&nbsp;{$product.amount}</td>
	{if $order_info.use_discount}
	<td class="right nowrap">
		{if $product.extra.discount|floatval}{include file="common_templates/price.tpl" value=$product.extra.discount}{else}-{/if}</td>
	{/if}
	{if $order_info.taxes}
	<td class="center nowrap">
		{if $product.tax_value|floatval}{include file="common_templates/price.tpl" value=$product.tax_value}{else}-{/if}</td>
	{/if}
	<td class="right">
         &nbsp;<strong>{if $product.extra.exclude_from_calculate}{$lang.free}{else}{include file="common_templates/price.tpl" value=$product.display_subtotal}{/if}</strong></td>
</tr>
{/if}
{/hook}
{/foreach}
{hook name="orders:extra_list"}
<tr class="table-footer">
	{assign var="colsp" value=5}
	{if $order_info.use_discount}{assign var="colsp" value=$colsp+1}{/if}
	{if $order_info.taxes}{assign var="colsp" value=$colsp+1}{/if}
	<td colspan="{$colsp}">&nbsp;</td>
</tr>
{/hook}
</table>

{include file="common_templates/subheader.tpl" title=$lang.order_info}

<table width="100%" class="table-fixed">
{hook name="orders:totals"}
	{if $order_info.payment_id}
	<tr>
		<td><strong>{$lang.payment_method}:&nbsp;</strong></td>
		<td>{$order_info.payment_method.payment}&nbsp;{if $order_info.payment_method.description}({$order_info.payment_method.description}){/if}</td>
	</tr>
	{/if}
	{if $order_info.shipping}
	<tr valign="top">
		<td><strong>{$lang.shipping}:&nbsp;</strong></td>
		<td>
			{foreach from=$order_info.shipping item="shipping" key="shipping_id" name="f_shipp"}
					{if !$smarty.foreach.f_shipp.first}<p>{/if}

					{if $shipping.carrier && $shipping.tracking_number}
						{if $shipping.carrier == "USP"}
							{assign var="url" value="http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?strOrigTrackNum=`$shipping.tracking_number`"}
						{elseif $shipping.carrier == "UPS"}
							{assign var="url" value="http://wwwapps.ups.com/WebTracking/processInputRequest?AgreeToTermsAndConditions=yes&amp;tracknum=`$shipping.tracking_number`"}
						{elseif $shipping.carrier == "FDX"}
							{assign var="url" value="http://fedex.com/Tracking?action=track&amp;tracknumbers=`$shipping.tracking_number`"}
						{elseif $shipping.carrier == "AUP"}
							<form name="tracking_form{$shipping_id}" target="_blank" action="http://ice.auspost.com.au/display.asp?ShowFirstScreenOnly=FALSE&ShowFirstRecOnly=TRUE" method="post">
							<input type="hidden"  name="txtItemNumber" maxlength="13" value="{$shipping.tracking_number}" />
							</form>
							{assign var="url" value="javascript: document.tracking_form`$shipping_id`.submit();"}
						{elseif $shipping.carrier == "DHL" || $shipping.carrier == "ARB"}
							<form name="tracking_form{$shipping_id}" target="_blank" method="post" action="http://track.dhl-usa.com/TrackByNbr.asp?nav=Tracknbr">
							<input type="hidden" name="txtTrackNbrs" value="{$shipping.tracking_number}" />
							</form>
							{assign var="url" value="javascript: document.tracking_form`$shipping_id`.submit();"}
						{elseif $shipping.carrier == "CHP"}
							{assign var="url" value="http://www.post.ch/swisspost-tracking?formattedParcelCodes=`$shipping.tracking_number`"}
						{/if}
						{$shipping.shipping}&nbsp;({$lang.tracking_num}<a class="underlined" {if $url|strpos:"://"}target="_blank"{/if} href="{$url}">{$shipping.tracking_number}</a>)
					{else}
						{$shipping.shipping}
					{/if}
					{if !$smarty.foreach.f_shipp.first}</p>{/if}
			{/foreach}
		</td>
	</tr>
	{/if}
	<tr>
		<td><strong>{$lang.subtotal}:&nbsp;</strong></td>
		<td>{include file="common_templates/price.tpl" value=$order_info.display_subtotal}</td>
	</tr>
	{if $order_info.display_shipping_cost|floatval}
	<tr>
		<td><strong>{$lang.shipping_cost}:&nbsp;</strong></td>
		<td>{include file="common_templates/price.tpl" value=$order_info.display_shipping_cost}</td>
	</tr>
	{/if}
	{if $order_info.discount|floatval}
	<tr>
		<td class="nowrap strong">{$lang.including_discount}:</td>
		<td class="nowrap">
			{include file="common_templates/price.tpl" value=$order_info.discount}</td>
	</tr>
	{/if}

	{if $order_info.subtotal_discount|floatval}
	<tr>
		<td class="nowrap strong">{$lang.order_discount}:</td>
		<td class="nowrap">
			{include file="common_templates/price.tpl" value=$order_info.subtotal_discount}</td>
	</tr>
	{/if}

	{if $order_info.coupons}
	{foreach from=$order_info.coupons item="coupon" key="key"}
	<tr>
		<td class="nowrap"><strong>{$lang.coupon}:</strong></td>
		<td>{$key}</td>
	</tr>
	{/foreach}
	{/if}

	{if $order_info.taxes}
	<tr>
		<td><strong>{$lang.taxes}:</strong></td>
		<td>&nbsp;</td>
	</tr>
	{foreach from=$order_info.taxes item=tax_data}
	<tr>
		<td>{$tax_data.description}&nbsp;{include file="common_templates/modifier.tpl" mod_value=$tax_data.rate_value mod_type=$tax_data.rate_type}{if $tax_data.price_includes_tax == "Y" && $settings.Appearance.cart_prices_w_taxes != "Y"}&nbsp;{$lang.included}{/if}{if $tax_data.regnumber}&nbsp;({$tax_data.regnumber}){/if}&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$tax_data.tax_subtotal}</td>
	</tr>
	{/foreach}
	{/if}
	{if $order_info.tax_exempt == "Y"}
	<tr>
		<td><strong>{$lang.tax_exempt}</strong></td>
		<td>&nbsp;</td>
	<tr>
	{/if}

	{if $order_info.payment_surcharge|floatval}
	<tr>
		<td>{$lang.payment_surcharge}:&nbsp;</td>
		<td>{include file="common_templates/price.tpl" value=$order_info.payment_surcharge}</td>
	</tr>
	{/if}
	<tr>
		<td><strong>{$lang.total}:&nbsp;</strong></td>
		<td><strong>{include file="common_templates/price.tpl" value=$order_info.total}</strong></td>
	</tr>
	<tr>
		<td valign="top"><strong>{$lang.customer_notes}:&nbsp;</strong></td>
		<td><div class="scroll-x">{$order_info.notes|replace:"\n":"<br />"|default:"-"}</div></td>
	</tr>
{/hook}
</table>

{if $without_customer != "Y"}
{* Customer info *}
{include file="views/profiles/components/profiles_info.tpl" user_data=$order_info location="I" details="Y"}
{* /Customer info *}
{/if}

{if $order_info.promotions}
	{include file="views/orders/components/promotions.tpl" promotions=$order_info.promotions}
{/if}

{/capture}
{include file="common_templates/group.tpl"  content=$smarty.capture.group}

{/if}


{hook name="orders:details"}
{/hook}

{if $view_only != "Y"}
	{if $settings.General.repay == "Y" && $payment_methods}
		{include file="views/orders/components/order_repay.tpl"}
	{/if}

	{if $smarty.request.confirmation == "Y"} {* place any code you wish to display on this page right after the order has been placed *}
	{hook name="orders:confirmation"}
	{/hook}
	{/if}
{/if}

{capture name="mainbox_title"}{$lang.order_info}{/capture}