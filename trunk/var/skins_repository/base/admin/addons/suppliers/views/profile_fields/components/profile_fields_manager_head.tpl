{* $Id: profile_fields_manager_head.tpl 6138 2008-10-09 13:38:32Z lexa $ *}

{if $mode == "add"}
	<div class="form-field">
		<label>{$lang.supplier}&nbsp;({$lang.show}&nbsp;/&nbsp;{$lang.required}):</label>
		<input type="hidden" name="add_fields_data[0][supplier_show]" value="N" />
		<input type="checkbox" name="add_fields_data[0][supplier_show]" value="Y" checked="checked" />&nbsp;
		<input type="hidden" name="add_fields_data[0][supplier_required]" value="N" />
		<input type="checkbox" name="add_fields_data[0][supplier_required]" value="Y" checked="checked" />
	</div>
{else}
	<th class="center">
		<ul>
			<li>{$lang.supplier}</li>
			<li>{$lang.show}&nbsp;/&nbsp;{$lang.required}</li>
		</ul>
	</th>
{/if}
