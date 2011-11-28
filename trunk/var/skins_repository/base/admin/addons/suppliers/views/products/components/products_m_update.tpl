{* $Id: products_m_update.tpl 5626 2008-07-21 07:47:04Z brook $ *}

	<select	id="field_{$field}__" name="{if $override_box}override_products_data[{$field}]{else}products_data[{$product.product_id}][{$field}]{/if}" {if $override_box}disabled="disabled"{/if}>
		<option	value="0" {if $product.$field == 0} selected="selected"{/if}>-{$lang.none}-</option>
		{foreach from=$suppliers item="supplier" }
		<option	value="{$supplier.user_id}" {if $product.$field == $supplier.user_id} selected="selected"{/if}>{$supplier.company}</option>
		{/foreach}
	</select>
