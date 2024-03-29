{* $Id: form_body.tpl 7703 2009-07-13 10:36:45Z angel $ *}

{include file="letter_header.tpl"}

<table>
{foreach from=$elements key=element_id item=element}
{if $element.element_type == $smarty.const.FORM_SEPARATOR}
<tr>
	<td colspan="2"><hr width="100%" /></td>
</tr>
{elseif $element.element_type == $smarty.const.FORM_HEADER}
<tr>
	<td colspan="2"><b>{$element.description}</b></td>
</tr>
{elseif $element.element_type != 'F'}
<tr>
	<td>{$element.description}:&nbsp;</td>
	<td>
		{assign var="value" value=$form_values.$element_id}
		{if $element.element_type == $smarty.const.FORM_SELECT || $element.element_type == $smarty.const.FORM_RADIO}
			{$element.variants.$value.description}
		{elseif $element.element_type == $smarty.const.FORM_CHECKBOX}
			{if $value == 'Y'}{$lang.yes}{else}{$lang.no}{/if}
		{elseif $element.element_type == $smarty.const.FORM_MULTIPLE_SB || $element.element_type == $smarty.const.FORM_MULTIPLE_CB}
			{foreach from=$value item=v name="fe"}{$element.variants.$v.description}{if !$smarty.foreach.fe.last},&nbsp;{/if}{/foreach}
		{elseif $element.element_type == $smarty.const.FORM_TEXTAREA}
			{$value|nl2br}
		{elseif $element.element_type == $smarty.const.FORM_INPUT || $element.element_type == $smarty.const.FORM_EMAIL || $element.element_type == $smarty.const.FORM_NUMBER || $element.element_type == $smarty.const.FORM_PHONE}
			{$value}
		{elseif $element.element_type == $smarty.const.FORM_DATE}
			{$value|date_format:$settings.Appearance.date_format}
		{elseif $element.element_type == $smarty.const.FORM_EMAIL || $element.element_type == $smarty.const.FORM_NUMBER || $element.element_type == $smarty.const.FORM_PHONE}
			<input id="elm_{$element.element_id}"  class="input-text" size="50" type="text" name="elements[{$element.element_id}]" value="">
		{elseif $element.element_type == $smarty.const.FORM_COUNTRIES}
			{$value|fn_get_country_name}
			{assign var="c_code" value=$value}
		{elseif $element.element_type == $smarty.const.FORM_STATES}
			{assign var="c_code" value=$c_code|default:$settings.General.default_country}
			{assign var="state" value=$value|fn_get_state_name:$c_code}
			{$state|default:$value}
		{/if}
	</td>
</tr>
{/if}
{/foreach}
</table>

{include file="letter_footer.tpl"}