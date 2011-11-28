{* $Id: products_update_qty_discounts.tpl 7194 2009-04-03 14:21:51Z lexa $ *}

{script src="js/picker.js"}

{assign var="memberships" value="C"|fn_get_memberships}

<div id="content_qty_discounts" class="hidden">
	<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
	<tbody class="cm-first-sibling">
	<tr>
		<th>{$lang.quantity}</th>
		<th>{$lang.price}&nbsp;({$currencies.$primary_currency.symbol})</th>
		<th width="100%">{$lang.membership}</th>
		<th>&nbsp;</th>
	</tr>
	</tbody>
	<tbody>
	{foreach from=$product_data.prices item="price" key="_key" name="prod_prices"}
	<tr class="cm-row-item">
		<td>
			{if $price.lower_limit == "1" && $price.membership_id == "0"}
				&nbsp;{$price.lower_limit}
			{else}
			<input type="text" name="product_data[prices][{$_key}][lower_limit]" value="{$price.lower_limit}" class="input-text-short" />
			{/if}</td>
		<td>
			{if $price.lower_limit == "1" && $price.membership_id == "0"}
				&nbsp;{$price.price|default:"0.00"}
			{else}
			<input type="text" name="product_data[prices][{$_key}][price]" value="{$price.price|default:"0.00"}" size="10" class="input-text-medium" />
			{/if}</td>
		<td>
			{if $price.lower_limit == "1" && $price.membership_id == "0"}
				&nbsp;{$lang.all}
			{else}
			<select id="membership_id" name="product_data[prices][{$_key}][membership_id]">
				<option value="0">- {$lang.all} -</option>
				{foreach from=$memberships item="membership"}
					<option {if $price.membership_id == $membership.membership_id}selected="selected"{/if} value="{$membership.membership_id}">{$membership.membership}</option>
				{/foreach}
			</select>
			{/if}</td>
		<td class="nowrap">
			{if $price.lower_limit == "1" && $price.membership_id == "0"}
			&nbsp;{else}
			{include file="buttons/clone_delete.tpl" microformats="cm-delete-row" no_confirm=true}
			{/if}
		</td>
	</tr>
	{/foreach}
	{math equation="x+1" x=$_key|default:0 assign="new_key"}
	<tr {cycle values="class=\"table-row\", " reset=1} id="box_add_qty_discount">
		<td>
			<input type="text" name="product_data[prices][{$new_key}][lower_limit]" value="" class="input-text-short" /></td>
		<td>
			<input type="text" name="product_data[prices][{$new_key}][price]" value="0.00" size="10" class="input-text-medium" /></td>
		<td>
			<select id="membership_id" name="product_data[prices][{$new_key}][membership_id]">
				<option value="0">- {$lang.all} -</option>
				{foreach from=$memberships item="membership"}
					<option value="{$membership.membership_id}">{$membership.membership}</option>
				{/foreach}
			</select>
		</td>
		<td class="right">
			{include file="buttons/multiple_buttons.tpl" item_id="add_qty_discount"}
		</td>
	</tr>
	</tbody>
	</table>

</div>
