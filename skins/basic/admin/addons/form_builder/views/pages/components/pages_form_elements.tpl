{* $Id: pages_form_elements.tpl 6991 2009-03-11 10:02:02Z zeke $ *}
{literal}
<script type="text/javascript">
	//<![CDATA[
	function fn_check_element_type(elm, id, type_id)
	{
		var noopts = 'ITCHDVWXYZFP';
		$('#' + id).toggleBy(noopts.indexOf(elm) != -1);

		// Hide description box for separator
		$('#descr_' + type_id).toggleBy((elm == 'D'));
		$('#hr_' + type_id).toggleBy((elm != 'D'));
	}
	//]]>
</script>
{/literal}

<hr width="100%" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>{$lang.position_short}</th>
	<th width="100%">{$lang.name}</th>
	<th>{$lang.type}</th>
	<th>{$lang.required}</th>
	<th>{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$elements item="element" name="fe_e"}
{assign var="num" value=$smarty.foreach.fe_e.iteration}
<tbody class="cm-row-item">
<tr>
	<td>
		<input type="hidden" name="page_data[form][elements_data][{$num}][element_id]" value="{$element.element_id}" />
		<input class="input-text-short" type="text" size="3" name="page_data[form][elements_data][{$num}][position]" value="{$element.position}" /></td>
	<td>
		<input id="descr_elm_{$element.element_id}" class="input-text-long {if $element.element_type == "D"}hidden{/if}" type="text" name="page_data[form][elements_data][{$num}][description]" value="{$element.description}" />
		<hr id="hr_elm_{$element.element_id}" width="100%" {if $element.element_type!="D"}class="hidden"{/if} /></td>
	<td>
		<select id="elm_{$element.element_id}" name="page_data[form][elements_data][{$num}][element_type]" onchange="fn_check_element_type(this.value, 'box_element_variants_{$element.element_id}', this.id);">
			<optgroup label="{$lang.base}">
			<option value="S" {if $element.element_type == "S"}selected="selected"{/if}>{$lang.selectbox}</option>
			<option value="R" {if $element.element_type == "R"}selected="selected"{/if}>{$lang.radiogroup}</option>
			<option value="N" {if $element.element_type == "N"}selected="selected"{/if}>{$lang.multiple_checkboxes}</option>
			<option value="M" {if $element.element_type == "M"}selected="selected"{/if}>{$lang.multiple_selectbox}</option>
			<option value="C" {if $element.element_type == "C"}selected="selected"{/if}>{$lang.checkbox}</option>
			<option value="I" {if $element.element_type == "I"}selected="selected"{/if}>{$lang.input_field}</option>
			<option value="T" {if $element.element_type == "T"}selected="selected"{/if}>{$lang.textarea}</option>
			<option value="H" {if $element.element_type == "H"}selected="selected"{/if}>{$lang.header}</option>
			<option value="D" {if $element.element_type == "D"}selected="selected"{/if}>{$lang.separator}</option>
			</optgroup>
			<optgroup label="{$lang.special}">
			<option value="V" {if $element.element_type == "V"}selected="selected"{/if}>{$lang.date}</option>
			<option value="Y" {if $element.element_type == "Y"}selected="selected"{/if}>{$lang.email}</option>
			<option value="Z" {if $element.element_type == "Z"}selected="selected"{/if}>{$lang.number}</option>
			<option value="P" {if $element.element_type == "P"}selected="selected"{/if}>{$lang.phone}</option>
			<option value="X" {if $element.element_type == "X"}selected="selected"{/if}>{$lang.countries_list}</option>
			<option value="W" {if $element.element_type == "W"}selected="selected"{/if}>{$lang.states_list}</option>
			<option value="F" {if $element.element_type == "F"}selected="selected"{/if}>{$lang.file}</option>
			</optgroup>
		</select></td>
	<td class="center">
		<input type="hidden" name="page_data[form][elements_data][{$num}][required]" value="N" />
		<input type="checkbox" {if "HD"|strstr:$element.element_type}disabled="disabled"{/if} name="page_data[form][elements_data][{$num}][required]" value="Y" {if $element.required == "Y"}checked="checked"{/if} class="checkbox" /></td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$element.element_id prefix="elm" status=$element.status hidden="" object_id_name="element_id" table="form_options"}</td>
	<td>
		{include file="buttons/multiple_buttons.tpl" only_delete="Y"}</td>
</tr>
<tr id="box_element_variants_{$element.element_id}" {if "ITHDCVWXYZFP"|substr_count:$element.element_type}class="hidden"{/if}>
	<td>&nbsp;</td>
	<td colspan="5">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr class="cm-first-sibling">
			<th>{$lang.position_short}</th>
			<th>{$lang.name}</th>
			<th>&nbsp;</th>
		</tr>
		{foreach from=$element.variants item=var key="vnum"}
		<tr class="cm-first-sibling cm-row-item">
			<td>
				<input type="hidden" name="page_data[form][elements_data][{$num}][variants][{$vnum}][element_id]" value="{$var.element_id}" />
				<input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][{$num}][variants][{$vnum}][position]" value="{$var.position}" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][{$num}][variants][{$vnum}][description]" value="{$var.description}" /></td>
			<td>{include file="buttons/multiple_buttons.tpl" only_delete="Y"}</td>
		</tr>
		{/foreach}
		{math equation="x + 1" assign="vnum" x=$vnum|default:0}
		<tr id="box_elm_variants_{$element.element_id}" class="cm-row-item">
			<td><input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][{$num}][variants][{$vnum}][position]" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][{$num}][variants][{$vnum}][description]" /></td>
			<td>{include file="buttons/multiple_buttons.tpl" item_id="elm_variants_`$element.element_id`" tag_level="5"}</td>
		</tr>
		</table>
	</td>
</tr>
</tbody>
{/foreach}

{math equation="x + 1" assign="num" x=$num|default:0}
<tbody class="cm-row-item" id="box_add_elements">
<tr class="no-border">
	<td>
		<input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][{$num}][position]" value="" /></td>
	<td>
		<input id="descr_add_element_variants" class="input-text-long" type="text" name="page_data[form][elements_data][{$num}][description]" value="" />
		<hr id="hr_add_element_variants" class="hidden" /></td>
	<td>
		<select id="add_element_variants" name="page_data[form][elements_data][{$num}][element_type]" onchange="fn_check_element_type(this.value, 'box_' + this.id, this.id);">
			<optgroup label="{$lang.base}">
			<option value="S">{$lang.selectbox}</option>
			<option value="R">{$lang.radiogroup}</option>
			<option value="N">{$lang.multiple_checkboxes}</option>
			<option value="M">{$lang.multiple_selectbox}</option>
			<option value="C">{$lang.checkbox}</option>
			<option value="I">{$lang.input_field}</option>
			<option value="T">{$lang.textarea}</option>
			<option value="H">{$lang.header}</option>
			<option value="D">{$lang.separator}</option>
			</optgroup>
			<optgroup label="{$lang.special}">
			<option value="V">{$lang.date}</option>
			<option value="Y">{$lang.email}</option>
			<option value="Z">{$lang.number}</option>
			<option value="P">{$lang.phone}</option>
			<option value="X">{$lang.countries_list}</option>
			<option value="W">{$lang.states_list}</option>
			<option value="F">{$lang.file}</option>
			</optgroup>
		</select></td>
	<td class="center">
		<input type="hidden" name="page_data[form][elements_data][{$num}][required]" value="N" />
		<input type="checkbox" name="page_data[form][elements_data][{$num}][required]" value="Y" checked="checked" class="checkbox" /></td>
	<td class="center">
		{include file="common_templates/select_status.tpl" input_name="page_data[form][elements_data][`$num`][status]" display="select"}</td>
	<td>
		{include file="buttons/multiple_buttons.tpl" item_id="add_elements"}</td>
</tr>
<tr id="box_add_element_variants">
	<td>&nbsp;</td>
	<td colspan="5">
		<table cellpadding="0" cellspacing="0" border="0" width="1" class="table">
		<tr class="cm-first-sibling">
			<th>{$lang.position_short}</th>
			<th>{$lang.description}</th>
			<th>&nbsp;</th>
		</tr>
		<tr id="box_add_elm_variants" class="cm-row-item">
			<td><input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][{$num}][variants][0][position]" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][{$num}][variants][0][description]" /></td>
			<td>{include file="buttons/multiple_buttons.tpl" item_id="add_elm_variants" tag_level="5"}</td>
		</tr>
		</table>
	</td>
</tr>
</tbody>


</table>
