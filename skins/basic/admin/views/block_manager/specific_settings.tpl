{* $Id: specific_settings.tpl 7293 2009-04-17 07:41:52Z zeke $ *}

{if $spec_settings}
<div id="toggle_{$s_set_id}">
<div class="specific-settings float-left" id="container_{$s_set_id}">
<a id="sw_additional_{$s_set_id}" class="cm-combo-on|off cm-combination">{$lang.specific_settings}</a>
<img src="{$images_dir}/icons/section_collapsed.gif" width="7" height="9" border="0" alt="" id="on_additional_{$s_set_id}" class="cm-combination" />
<img src="{$images_dir}/icons/section_expanded.gif" width="7" height="9" border="0" alt="" id="off_additional_{$s_set_id}" class="cm-combination hidden" />
</div>

<div class="hidden" id="additional_{$s_set_id}">
{foreach from=$spec_settings key="set_name" item="_option"}
<div class="form-field">
<label for="spec_{$set_name}_{$s_set_id}">{if $_option.option_name}{$lang[$_option.option_name]}{else}{$lang.$set_name}{/if}:</label>
{** Checkbox **}
{if $_option.type == "checkbox"}
	<input type="hidden" name="block[{$set_name}]" value="N" />
	<input type="checkbox" class="checkbox" name="block[{$set_name}]" value="Y" id="spec_{$set_name}_{$s_set_id}" {if $block.properties.$set_name && $block.properties.$set_name == "Y" || !$block.properties.$set_name && $_option.default_value == "Y"}checked="checked"{/if} />
{** Selectbox **}
{elseif $_option.type == "selectbox"}
	<select id="spec_{$set_name}_{$s_set_id}" name="block[{$set_name}]">
	{foreach from=$_option.values key="k" item="v"}
		<option value="{$k}" {if $block.properties.$set_name && $block.properties.$set_name == $k || !$block.properties.$set_name && $_option.default_value == $k}selected="selected"{/if}>{if $_option.no_lang}{$v}{else}{$lang.$v}{/if}</option>
	{/foreach}
	</select>
{elseif $_option.type == "input"}
	<input id="spec_{$set_name}_{$s_set_id}" class="input-text" name="block[{$set_name}]" value="{if $block.properties.$set_name}{$block.properties.$set_name}{else}{$_option.default_value}{/if}" />

{elseif $_option.type == "multiple_checkboxes"}

	{html_checkboxes name="block[`$set_name`]" options=$_option.values columns=4 selected=$block.properties.$set_name}
{/if}
</div>
{/foreach}
</div>
<!--toggle_{$s_set_id}--></div>
{else}
<div id="toggle_{$s_set_id}"><!--toggle_{$s_set_id}--></div>
{/if}
