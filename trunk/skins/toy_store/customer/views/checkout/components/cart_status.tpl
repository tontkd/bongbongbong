{* $Id: cart_status.tpl 7346 2009-04-22 14:03:51Z angel $ *}

<div id="cart_status">
<!--dynamic:cart_status-->
<div class="float-left">
	{if $smarty.session.cart.amount}
		<img id="sw_cart_box" class="cm-combination cm-combo-on valign hand" src="{$images_dir}/icons/filled_cart_icon.gif" border="0" alt="{$lang.cart}" title="{$lang.cart}" />
		<span class="lowercase">
			<a href="{$index_script}?dispatch=checkout.cart"><strong>{$smarty.session.cart.amount}</strong>&nbsp;{$lang.items}</a>,
			{$lang.subtotal}:&nbsp;<strong>{include file="common_templates/price.tpl" value=$smarty.session.cart.display_subtotal}</strong>
		</span>
	{else}
		<img id="sw_cart_box" class="cm-combination cm-combo-on valign hand" src="{$images_dir}/icons/empty_cart_icon.gif" alt="{$lang.cart_is_empty}" title="{$lang.cart_is_empty}" /><strong>&nbsp;&nbsp;&nbsp;{$lang.cart_is_empty}</strong>
	{/if}
	
	<div id="cart_box" class="cart-list hidden cm-popup-box cm-smart-position">
		<img src="{$images_dir}/icons/{if $smarty.session.cart.amount}filled{else}empty{/if}_cart_list_icon.gif" alt="{$lang.cart}" class="cm-popup-switch hand cart-list-icon" />
		<div class="list-container">
			<div class="list">
			{if $smarty.session.cart.amount}
				<ul>
					{hook name="index:cart_status"}
					{foreach from=$smarty.session.cart.products key="key" item="p" name="cart_products"}
					{if !$p.extra.parent}
					<li class="clear">
						<a href="{$index_script}?dispatch=products.view&amp;product_id={$p.product_id}" class="underlined">{$p.product_id|fn_get_product_name}</a>{if !"CHECKOUT"|defined || $force_items_deletion}{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.delete.from_status&amp;cart_id=`$key`" but_meta="cm-ajax" but_rev="cart_status" but_role="delete" but_name="delete_cart_item"}{/if}
						<p>
							<strong class="valign">{$p.amount}</strong>&nbsp;x&nbsp;{include file="common_templates/price.tpl" value=$p.display_price span_id="price_`$key`" class="none"}
						</p>
					</li>
					{if !$smarty.foreach.cart_products.last}
						<li class="delim">&nbsp;</li>
					{/if}
					{/if}
					{/foreach}
					{/hook}
				</ul>
			{else}
				<p class="center">{$lang.cart_is_empty}</p>
			{/if}
			</div>
			<div class="buttons-container{if $smarty.session.cart.amount} full-cart{/if}">
				<a href="{$index_script}?dispatch=checkout.cart" class="view-cart">{$lang.view_cart}</a>
				<a href="{$index_script}?dispatch=checkout.{if $settings.General.one_page_checkout != "Y"}customer_info{else}checkout{/if}">{$lang.checkout}</a>
			</div>
		</div>
	</div>
</div><!--/dynamic-->

<div class="checkout-link{if $smarty.session.cart.amount} full-cart{/if}">

<a href="{$index_script}?dispatch=checkout.{if $settings.General.one_page_checkout != "Y"}customer_info{else}checkout{/if}">{$lang.checkout}</a>

</div>
<!--cart_status--></div>
