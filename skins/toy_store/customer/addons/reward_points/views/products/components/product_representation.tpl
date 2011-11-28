{* $Id: product_representation.tpl 6285 2008-11-09 15:55:49Z zeke $ *}

{if $product.points_info.price}
	<div class="form-field product-list-field">
		<label>{$lang.price_in_points}:</label>
		<span id="price_in_points_{$product.product_id}">{$product.points_info.price}</span>&nbsp;{$lang.points_lower}
	</div>
{/if}
{if $product.points_info.reward.amount}
	<div class="form-field product-list-field">
		<label>{$lang.reward_points}:</label>
		<span id="reward_points_{$product.product_id}" >{$product.points_info.reward.amount}</span>&nbsp;{$lang.points_lower}
	</div>
{/if}
