{* $Id: payment_options.post.tpl 7096 2009-03-19 17:30:24Z zeke $ *}

{if $cart_products && $cart.points_info.total_price && $user_info.points > 0}
	<div class="buttons-container clear-both">
		{include file="buttons/button.tpl" but_role="text" but_text=$lang.point_payment but_id="sw_point_payment" but_meta="cm-combination"}
	</div>
	<div id="point_payment" class="right">
		<form class="cm-ajax" name="point_payment_form" action="{$index_script}" method="post">
		<input type="hidden" name="redirect_mode" value="{$location}" />
		<input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" />
	
		<p>{$lang.text_point_in_account}&nbsp;<strong>{$user_info.points}</strong>.</p>
		<p>{$lang.text_points_in_order}&nbsp;<strong>{$cart.points_info.total_price}</strong>.</p>
		
		<p>
			<strong class="valign">{$lang.points_to_use}:</strong>
			<input type="text" class="input-text valign" name="points_to_use" size="40" value="" />
			{include file="buttons/button.tpl" but_role="text" but_name="dispatch[checkout.point_payment]" but_text=$lang.apply}
			<input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
		</p>
		</form>
	<!--point_payment--></div>
{/if}