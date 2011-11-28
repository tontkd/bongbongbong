{* $Id: return_period_representation.tpl 6369 2008-11-20 10:54:05Z zeke $ *}

{if $addons.rma.display_product_return_period == "Y" && $product.return_period && $product.is_returnable == "Y"}
	<div class="form-field product-list-field">
		<label>{$lang.return_period}:</label>
		<span class="valign">{$product.return_period}&nbsp;{$lang.days}</span>
	</div>
{/if}
