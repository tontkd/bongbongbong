{* $Id: product_block.override.tpl 7126 2009-03-24 13:55:09Z angel $ *}

{if !$smarty.session.auth.age && $product.age_verification == "Y"}
<div class="product-container clear">
	<div class="product-description">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>
	</div>
	<div class="box margin-top">
		{$lang.product_need_age_verification}
		<div class="buttons-container">
			{include file="buttons/button.tpl" but_text=$lang.verify but_href="`$index_script`?dispatch=products.view&product_id=`$product.product_id`" but_role="text"}
		</div>
	</div>
</div>
{/if}
