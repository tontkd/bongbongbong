{* $Id: search_form.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $suppliers}
<div class="search-field">
	<label for="sid">{$lang.search_by_supplier}:</label>
	<select	name="sid" id="sid">
		<option	value="0">- {$lang.all_suppliers} -</option>
		{foreach from=$suppliers item="supplier"}
			<option	value="{$supplier.user_id}" {if $search.sid == $supplier.user_id}selected="selected"{/if}>{$supplier.company}</option>
		{/foreach}
	</select>
</div>
{/if}