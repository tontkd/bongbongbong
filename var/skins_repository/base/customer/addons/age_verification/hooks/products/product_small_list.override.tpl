{* $Id: product_small_list.override.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if !$smarty.session.auth.age && $product.age_verification == "Y"}
<table border="0" cellpadding="3" cellspacing="3" width="100%">
<tr>
	<td width="{$cell_width}%" valign="top">
		<a href="{$index_script}?dispatch=products.view&amp;product_id={$product.product_id}" class="underlined">{$product.product|unescape}</a>
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
