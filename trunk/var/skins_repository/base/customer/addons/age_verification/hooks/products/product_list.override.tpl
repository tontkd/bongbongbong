{* $Id: product_list.override.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if !$smarty.session.auth.age && $product.age_verification == "Y"}
<div class="product-description">
	{if $js_product_var}
		<input type="hidden" id="product_{$product.product_id}" value="{$product.product}" />
	{/if}
	<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product}</a>
	<div class="box margin-top">
		{$lang.product_need_age_verification}
		<div class="buttons-container">
			{include file="buttons/button.tpl" but_text=$lang.verify but_href="`$index_script`?dispatch=products.view&product_id=`$product.product_id`" but_role="text"}
		</div>
	</div>
</div>
{/if}
