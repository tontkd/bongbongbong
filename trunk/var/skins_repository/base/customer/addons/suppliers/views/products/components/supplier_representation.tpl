{* $Id: supplier_representation.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{if $product.supplier && $addons.suppliers.display_supplier == "Y"}
	<div class="form-field product-list-field">
		<label>{$lang.supplier}:</label>
		{$product.supplier}
	</div>
{/if}
