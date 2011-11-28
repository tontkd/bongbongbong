{* $Id: checkout_totals.pre.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{if $cart.points_info.in_use}
	<li>
		{assign var="_redirect_url" value=$config.current_url|escape:url}
			{if $use_ajax}{assign var="_class" value="cm-ajax"}{/if}
		<span>{$lang.points_in_use}&nbsp;({$cart.points_info.in_use.points}&nbsp;{$lang.points}):</span>
		<strong>{include file="common_templates/price.tpl" value=$cart.points_info.in_use.cost}&nbsp;{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.delete_points_in_use&redirect_url=`$_redirect_url`" but_meta=$_class but_role="delete" but_rev="checkout_totals,subtotal_price_in_points,checkout_steps"}</strong>
	</li>
{/if}

{if $cart.points_info.reward}
	<li>
		<span>{$lang.points}:</span>
		<strong>{$cart.points_info.reward}</strong>
	</li>
{/if}