{* $Id: manage.tpl 7221 2009-04-08 06:05:21Z angel $ *}

{script src="js/picker.js"}

{literal}
<script type="text/javascript">
	//<![CDATA[
	function fn_disable_cbox(id)
	{
		form = $('form[name=currency_form]');
		$('.cm-item', form).removeAttr('disabled');
		$('#delete_checkbox_' + id).attr('disabled', 'disabled');
		$('.cm-coefficient', form).removeAttr('disabled');
		$('#coeff_' + id).attr('disabled', 'disabled');
		$('.selected-status a', form).addClass('cm-combination');
		$('#sw_select_' + id + '_wrap a', form).removeClass('cm-combination');
		$('.cm-delete-obj a').show();
		$('#del_' + id + ' a').hide();
		$('.cm-delete-obj span').hide();
		$('#del_' + id + ' span').show();
	}
	//]]>
</script>
{/literal}
{capture name="mainbox"}

<form action="{$index_script}" method="post" name="currency_form">

{include file="common_templates/pagination.tpl"}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="10%" class="center">{$lang.base_currency}</th>
	<th width="10%">{$lang.code}</th>
	<th width="55%">{$lang.name}</th>
	<th width="10%">{$lang.currency_rate}</th>
	<th width="10%">{$lang.currency_sign}</th>
	<th width="10%">{$lang.after_sum}</th>
	<th>{$lang.ths_sign}</th>
	<th>{$lang.dec_sign}</th>
	<th>{$lang.decimals}</th>
	<th width="5%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>

{foreach from=$currencies_data item=cur}
<tr {cycle values="class=\"table-row\", "}>
	<td>
		<input id="delete_checkbox_{$cur.currency_code}" type="checkbox" name="currency_codes[]" value="{$cur.currency_code}" {if $cur.is_primary == "Y"}disabled="disabled"{/if} class="checkbox cm-item" /></td>
	<td class="center">
		<input type="radio" name="is_primary_currency" value="{$cur.currency_code}" {if $cur.is_primary == "Y"}checked="checked"{/if} onclick="fn_disable_cbox('{$cur.currency_code}');" class="radio" /></td>
	<td class="center nowrap">
		<input type="text" name="currencies[{$cur.currency_code}][currency_code]" size="8" value="{$cur.currency_code}" class="input-text" onkeyup="var matches = this.value.match(/^(\w*)/gi);  if (matches) this.value = matches;" /></td>
	<td>
		<input type="text" name="currency_description[{$cur.currency_code}][description]" value="{$cur.description}" class="input-text-long" /></td>
	<td class="center">
		<input type="text" id="coeff_{$cur.currency_code}" name="currencies[{$cur.currency_code}][coefficient]" size="7" value="{$cur.coefficient}" class="input-text cm-coefficient" {if $cur.is_primary == "Y"}disabled="disabled"{/if} /></td>
	<td class="center">
		<input type="text" name="currencies[{$cur.currency_code}][symbol]" size="6" value="{$cur.symbol}" class="input-text" /></td>
	<td class="center">
		<input type="hidden" name="currencies[{$cur.currency_code}][after]" value="N" />
		<input type="checkbox" name="currencies[{$cur.currency_code}][after]" value="Y" {if $cur.after == "Y"}checked="checked"{/if} class="checkbox" /></td>
	<td class="center">
		<input type="text" name="currencies[{$cur.currency_code}][thousands_separator]" size="1" maxlength="1" value="{$cur.thousands_separator}" class="input-text" /></td>
	<td class="center">
		<input type="text" name="currencies[{$cur.currency_code}][decimals_separator]" size="1" maxlength="1" value="{$cur.decimals_separator}" class="input-text" /></td>
	<td class="center">
		<input type="text" name="currencies[{$cur.currency_code}][decimals]" size="1" maxlength="2" value="{$cur.decimals}" class="input-text" /></td>
	<td>
		{if $cur.is_primary == "Y"}
			{assign var="cur_state" value=true}
		{else}
			{assign var="cur_state" value=false}
		{/if}
		{include file="common_templates/select_popup.tpl" id=$cur.currency_code status=$cur.status hidden="" object_id_name="currency_code" table="currencies" popup_disabled=$cur_state}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
			<li class="cm-delete-obj" id="del_{$cur.currency_code}"><a class="cm-confirm{if $cur.is_primary == "Y"} hidden{/if}" href="{$index_script}?dispatch=currencies.delete&amp;currency_code={$cur.currency_code}">{$lang.delete}</a><span class="undeleted-element{if $cur.is_primary != "Y"} hidden{/if}">{$lang.delete}</span></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$cur.currency_code tools_list=$smarty.capture.tools_items}
	</td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[currencies.delete]" class="cm-process-items cm-confirm" rev="currency_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[currencies.update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	
	<div class="float-right">
	{capture name="tools"}
		{capture name="add_new_picker"}
		<form action="{$index_script}" method="post" name="add_currency" class="cm-form-highlight">
		<div class="object-container">
			<div class="tabs cm-j-tabs">
				<ul>
					<li id="tab_currency_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
				</ul>
			</div>

			<div class="cm-tabs-content" id="content_tab_currency_new">
			<fieldset>
				<div class="form-field">
					<label class="cm-required" for="description">{$lang.name}:</label>
					<input type="text" name="add_currency_description[0][description]" id="description" value="" onfocus="this.value = ''" class="input-text-large main-input" />
				</div>

				<div class="form-field">
					<label class="cm-required" for="currency_code">{$lang.code}:</label>
					<input type="text" name="add_currency[0][currency_code]" id="currency_code" size="8" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="coefficient">{$lang.currency_rate}:</label>
					<input type="text" name="add_currency[0][coefficient]" id="coefficient" size="7" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="symbol">{$lang.currency_sign}:</label>
					<input type="text" name="add_currency[0][symbol]" id="symbol" size="6" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="after">{$lang.after_sum}:</label>
					<input type="hidden" name="add_currency[0][after]" value="N" />
					<input type="checkbox" name="add_currency[0][after]" id="after" value="Y" class="checkbox" />
				</div>

				{include file="common_templates/select_status.tpl" input_name="add_currency[0][status]" id="add_currency"}

				<div class="form-field">
					<label for="thousands_separator">{$lang.ths_sign}:</label>
					<input type="text" name="add_currency[0][thousands_separator]" id="thousands_separator" size="1" maxlength="1" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="decimal_separator">{$lang.dec_sign}:</label>
					<input type="text" name="add_currency[0][decimal_separator]" id="decimal_separator" size="1" maxlength="1" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label id="decimals">{$lang.decimals}:</label>
					<input type="text" name="add_currency[0][decimals]" id="decimals" size="1" maxlength="1" value="" class="input-text" />
				</div>
			</div>
		</fieldset>
		</div>

		<div class="buttons-container">
			{include file="buttons/create_cancel.tpl" but_name="dispatch[currencies.add_currency]" cancel_action="close"}
		</div>

		</form>
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_currency" text=$lang.add_currency content=$smarty.capture.add_new_picker link_text=$lang.add_currency act="general"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_currency" text=$lang.add_currency link_text=$lang.add_currency act="general"}
	</div>
</div>

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.currencies content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
