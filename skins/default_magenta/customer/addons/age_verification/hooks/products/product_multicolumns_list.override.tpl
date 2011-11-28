{* $Id: product_multicolumns_list.override.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if !$smarty.session.auth.age && $product.age_verification == "Y"}
{assign var="obj_id" value="`$obj_prefix``$product.product_id`"}
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="product-title">{$product.product|unescape}</a>
		
		{if $product.product_code || !$no_ids}
		<p class="sku{if !$product.product_code} hidden{/if}" {if !$no_ids}id="sku_{$obj_id}"{/if}>{$lang.sku}: {if !$no_ids}<span class="sku" id="product_code_{$obj_id}">{/if}{$product.product_code}{if !$no_ids}</span>{/if}</p>
		{/if}
		<div class="box margin-top">
			{$lang.product_need_age_verification}
			<div class="buttons-container">
				{include file="buttons/button.tpl" but_text=$lang.verify but_href="`$index_script`?dispatch=products.view&product_id=`$product.product_id`" but_role="text"}
			</div>
		</div>
	</td>
</tr>
</table>
{/if}
