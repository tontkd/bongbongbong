{* $Id: profile_fields_manager_body.tpl 5626 2008-07-21 07:47:04Z brook $ *}

<td align="center">
	<input type="hidden" name="fields_data[{$field.field_id}][supplier_show]" value="{if $field.field_name == "email" || $field.field_name == "company"}Y{else}N{/if}" />
	<input type="checkbox" name="fields_data[{$field.field_id}][supplier_show]" value="Y" {if $field.supplier_show == "Y"}checked="checked"{/if} {if $field.field_name == "email" || $field.field_name == "company"}disabled="disabled"{/if} onclick="document.getElementById('sreq_{$field.field_id}').disabled = !this.checked;" />
	<input type="hidden" name="fields_data[{$field.field_id}][supplier_required]" value="{if $field.field_name == "email" || $field.field_name == "company"}Y{else}N{/if}" />
	<input id="sreq_{$field.field_id}" type="checkbox" name="fields_data[{$field.field_id}][supplier_required]" value="Y" {if $field.supplier_required == "Y"}checked="checked"{/if} {if $field.supplier_show == "N" || $field.field_name == "email" || $field.field_name == "company"}disabled="disabled"{/if} />
</td>
