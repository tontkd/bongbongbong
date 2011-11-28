{* $Id: banners_picker.tpl 7027 2009-03-13 07:49:33Z zeke $ *}

{math equation="rand()" assign="rnd"}
{assign var="data_id" value="`$data_id`_`$rnd`"}
{assign var="view_mode" value=$view_mode|default:"mixed"}

{script src="js/picker.js"}

{if $view_mode != "button"}
	{if !$positions}
	<input id="b{$data_id}_ids" type="hidden" name="{$input_name}" value="{if $item_ids}{","|implode:$item_ids}{/if}" />
	{/if}
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		{if $positions}<th>{$lang.position_short}</th>{/if}
		<th width="100%">{$lang.name}</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="{$data_id}"{if !$item_ids} class="hidden"{/if}>
	{include file="addons/banners/pickers/js_banner.tpl" banner_id="`$ldelim`banner_id`$rdelim`" holder=$data_id input_name=$input_name clone=true hide_link=$hide_link hide_delete_button=$hide_delete_button position_field=$positions position="0"}
	{if $item_ids}
	{foreach name="items" from=$item_ids item="p_id"}
		{include file="addons/banners/pickers/js_banner.tpl" banner_id=$p_id holder=$data_id input_name=$input_name hide_link=$hide_link hide_delete_button=$hide_delete_button first_item=$smarty.foreach.items.first position_field=$positions position=$smarty.foreach.items.iteration}
	{/foreach}
	{/if}
	</tbody>
	<tbody id="{$data_id}_no_item"{if $item_ids} class="hidden"{/if}>
	<tr class="no-items">
		<td colspan="{if $positions}3{else}2{/if}"><p>{$no_item_text|default:$lang.no_items}</p></td>
	</tr>
	</tbody>
	</table>
{/if}

{if $view_mode != "list"}

	{if !$no_container}<div class="buttons-container">{/if}
		{include file="buttons/button.tpl" but_id="opener_picker_`$data_id`" but_text=$lang.add but_onclick="jQuery.show_picker('picker_`$data_id`', this.id);" but_role="add" but_meta="text-button"}
	{if !$no_container}</div>{/if}

	{capture name="picker_content"}
		{capture name="iframe_url"}{$index_script}?dispatch=banners.picker{if $extra_var}&amp;extra={$extra_var|escape:url}{/if}{if $checkbox_name}&amp;checkbox_name={$checkbox_name}{/if}{/capture}
		<div class="cm-picker-data-container" id="iframe_container_{$data_id}"></div>
		<div class="buttons-container">
			{if !$extra_var}
				{assign var="_but_text" value=$lang.add_banners_and_close}
				{assign var="_act" value="#add_item_close"}
				{capture name="extra_buttons"}
					{include file="buttons/save_cancel.tpl" but_type="button" but_onclick="jQuery.submit_picker('#iframe_`$data_id`', '#add_item')" but_text=$lang.add_banners breadcrumbs=""}
				{/capture}
			{else}
				{assign var="_but_text" value=$lang.add_banners}
				{assign var="_act" value="#add_item"}
			{/if}
			{include file="buttons/save_cancel.tpl" but_type="button" but_onclick="jQuery.submit_picker('#iframe_`$data_id`', '`$_act`');" but_text=$_but_text cancel_action="close" extra=$smarty.capture.extra_buttons}
		</div>
	{/capture}
	{include file="pickers/picker_skin.tpl" picker_content=$smarty.capture.picker_content data_id=$data_id but_text=$lang.add_banners}
	<script type="text/javascript">
	//<![CDATA[
		iframe_urls['{$data_id}'] = '{$smarty.capture.iframe_url|escape:"javascript"}';
		{if $extra_var}
		iframe_extra['{$data_id}'] = '{$extra_var|escape:"javascript"}';
		{/if}
	//]]>
	</script>
{/if}