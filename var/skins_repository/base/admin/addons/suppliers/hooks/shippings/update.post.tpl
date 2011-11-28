{* $Id: update.post.tpl 7774 2009-07-31 09:47:01Z zeke $ *}

{if $suppliers}
<div class="form-field">
	<label for="ship_suppliers_supplier_id">{$lang.suppliers}:</label>
	<select	name="shipping_data[supplier_ids][]" id="ship_suppliers_supplier_id" multiple="multiple" size="3">
		{foreach from=$suppliers item="supplier"}
			<option	value="{$supplier.user_id}" {if $shipping.supplier_ids && $supplier.user_id|in_array:$shipping.supplier_ids}selected="selected"{/if}>{$supplier.company}</option>
		{/foreach}
	</select>
	{$lang.multiple_selectbox_notice}
</div>
{/if}