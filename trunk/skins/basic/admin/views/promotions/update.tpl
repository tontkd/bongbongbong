{* $Id: update.tpl 7263 2009-04-14 12:07:43Z zeke $ *}

{script src="js/node_cloning.js"}
{literal}
<script type="text/javascript">
//<![CDATA[
function fn_promotion_add(id, skip_select, type)
{
	var skip_select = skip_select | false;
	var new_group = false;

	var new_id = $('#container_' + id).cloneNode(0, true, true).str_replace('container_', '');

	// Get data array index and increment it
	var e = $('input[name^=promotion_data]:first', $('#container_' + new_id).prev()).clone();

	// We added new group, so we need to get input from parent element or this is the new condition
	if (!e.get(0)) {
		e = $('input[name^=promotion_data]:first', $('#container_' + new_id).parents('li:first')).clone(); // for group

		$('.no-node.no-items', $('#container_' + new_id).parents('ul:first')).hide(); // hide conainer with "no items" text

		// new condition
		if (!e.get(0)) {
			var n = (type == 'condition') ? "promotion_data[conditions][conditions][0][condition]" : "promotion_data[bonuses][0][bonus]";
			e = jQuery('<input type="hidden" name="'+ n +'" value="" />');
		} else {
			new_group = true;
		}
	}

	var val = parseInt(e.attr('name').match(/(.*)\[(\d+)\]/)[2]);

	var name = new_group? e.attr('name') : e.attr('name').replace(/(.*)\[(\d+)\]/, '$1[' + (val + 1) +']');

	e.attr('name', name);
	$('#container_' + new_id).append(e);
	name = name.replace(/\[(\w+)\]$/, '');

	if (new_group) {
		name += '[conditions][1]';
	}

	$('#container_' + new_id).prev().removeClass('cm-last-item'); // remove tree node closure from previous element
	$('#container_' + new_id).addClass('cm-last-item').show(); // add tree node closure to new element
	// Update selector with name with new index
	if (skip_select == false) {
		$('#container_' + new_id + ' select').attr('id', new_id).attr('name', name);

	// Or just return id and name (for group)
	} else {
		$('#container_' + new_id).empty(); // clear node contents
		return {new_id: new_id, name: name};
	}
}

function fn_promotion_add_group(id, zone)
{
	var res = fn_promotion_add(id, true, 'condition');

	jQuery.ajaxRequest(index_script + '?dispatch=promotions.dynamic&zone=' + zone + '&prefix=' + escape(res.name) + '&group=new&elm_id=' + res.new_id, {result_ids: 'container_' + res.new_id});
}

function fn_promotion_rebuild_mixed_data(value, id, condition_value)
{
	var items = window['mixed_data_' + id];
	var opts = '';

	for (var k in items) {
		if (items[k]['is_group']) {
			for (var l in items[k]['items']) {
				if (l == value) {
					if (items[k]['items'][l]['variants']) {
						for (var m in items[k]['items'][l]['variants']) {
							opts += '<option value="' + m + '"' + (m == condition_value ? ' selected="selected"' : '') + '>' + items[k]['items'][l]['variants'][m] + '</option>';
						}
						$('#mixed_select_' + id).html(opts).show().attr('disabled', '');
						$('#mixed_input_' + id).hide().attr('disabled', true);
					} else {
						$('#mixed_input_' + id).val(condition_value).show().attr('disabled', '');
						$('#mixed_select_' + id).hide().attr('disabled', true);
					}
				}
			}
		} else {
			if (k == value) {
				if (items[k]['variants']) {
					for (var m in items[k]['variants']) {
						opts += '<option value="' + m + '"' + (m == condition_value ? ' selected="selected"' : '') + '>' + items[k]['variants'][m] + '</option>';
					}
					$('#mixed_select_' + id).html(opts).show().attr('disabled', '');
					$('#mixed_input_' + id).hide().attr('disabled', true);
				} else {
					$('#mixed_input_' + id).val(condition_value).show().attr('disabled', '');
					$('#mixed_select_' + id).hide().attr('disabled', true);
				}
			}
		}
	}
}

//]]>
</script>
{/literal}

{capture name="mainbox"}

<form action="{$index_script}" method="post" name="promotion_form" class="cm-form-highlight">
<input type="hidden" name="promotion_id" value="{$smarty.request.promotion_id}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" name="promotion_data[zone]" value="{$promotion_data.zone|default:$zone}" />

{capture name="tabsbox"}
<div id="content_details">
<fieldset>
	<div class="form-field">
		<label for="promotion_name" class="cm-required">{$lang.name}:</label>
		<input type="text" name="promotion_data[name]" id="promotion_name" size="25" value="{$promotion_data.name}" class="input-text-large main-input" />
	</div>
	
	<div class="form-field">
		<label for="promotion_det_descr">{$lang.detailed_description}:</label>
		<textarea id="promotion_det_descr" name="promotion_data[detailed_description]" cols="55" rows="8" class="input-textarea-long wysiwyg">{$promotion_data.detailed_description}</textarea>
		<p>{include file="common_templates/wysiwyg.tpl" id="promotion_det_descr"}</p>
	</div>
	
	<div class="form-field">
		<label for="promotion_sht_descr">{$lang.short_description}:</label>
		<textarea id="promotion_sht_descr" name="promotion_data[short_description]" cols="55" rows="8" class="input-textarea-long wysiwyg">{$promotion_data.short_description}</textarea>
		<p>{include file="common_templates/wysiwyg.tpl" id="promotion_sht_descr"}</p>
	</div>
	
	
	<div class="form-field">
		<label>{$lang.from_date}:</label>
		{include file="common_templates/calendar.tpl" date_id="date_holder_from" date_name="promotion_data[from_date]" date_val=$promotion_data.from_date|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
	</div>
	
	<div class="form-field">
		<label>{$lang.to_date}:</label>
		{include file="common_templates/calendar.tpl" date_id="date_holder_to" date_name="promotion_data[to_date]" date_val=$promotion_data.to_date|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
	</div>
	
	<div class="form-field">
		<label for="promotion_priority">{$lang.priority}:</label>
		<input type="text" name="promotion_data[priority]" id="promotion_priority" size="25" value="{$promotion_data.priority}" class="input-text-short" />
	</div>
	
	<div class="form-field">
		<label for="promotion_stop">{$lang.stop_other_rules}:</label>
		<input type="checkbox" name="promotion_data[stop]" id="promotion_stop" value="Y" {if $promotion_data.stop == "Y"}checked="checked"{/if} class="checkbox" />
	</div>
	
	{include file="common_templates/select_status.tpl" input_name="promotion_data[status]" id="promotion_data" obj=$promotion_data hidden=true}

</fieldset>
<!--content_details--></div>

<div id="content_conditions">

{include file="views/promotions/components/group.tpl" prefix="promotion_data[conditions]" group=$promotion_data.conditions root=true no_ids=true zone=$promotion_data.zone|default:$zone}

<!--content_conditions--></div>

<div id="content_bonuses">

{include file="views/promotions/components/bonuses_group.tpl" prefix="promotion_data[bonuses]" group=$promotion_data.bonuses zone=$promotion_data.zone|default:$zone}

<!--content_bonuses--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

<div class="buttons-container buttons-bg">
	{if $mode == "add"}
		{include file="buttons/create_cancel.tpl" but_name="dispatch[promotions.update]"}
	{else}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[promotions.update]"}
	{/if}
</div>
</form>
{/capture}

{if $mode == "add"}
	{assign var="title" value=$lang.new_promotion}
{else}
	{assign var="title" value="`$lang.editing_promotion`:&nbsp;`$promotion_data.name`"}
{/if}
{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox select_languages=true}
