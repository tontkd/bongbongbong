{* $Id: detailed_content.post.tpl 6713 2009-01-06 15:38:06Z zeke $ *}

{if $suppliers}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.suppliers}
	
	<div class="form-field">
		<label for="product_supplier_id">{$lang.supplier}:</label>
		<select	name="product_data[supplier_id]" id="product_supplier_id">
			<option	value="0" {if $product_data.supplier_id == "0"}selected="selected"{/if}>- {$lang.none} -</option>
			{foreach from=$suppliers item="supplier"}
				<option	value="{$supplier.user_id}" {if $supplier.user_id == $product_data.supplier_id}selected="selected"{/if}>{$supplier.company}</option>
			{/foreach}
		</select>
	</div>
</fieldset>
{/if}
