{* $Id: sections.tpl 6830 2009-01-26 15:05:14Z angel $ *}
{if $section_cols}
<table cellpadding="5" cellspacing="1" border="0" width="90%" align="center" class="notification-border-n" id="notification_{$key}">
<tr>
	<td class="notification-body-n">
   		<table cellpadding="5" cellspacing="0" border="0" width="90%" align="center">
   		<tr valign="top">
   			{foreach from=$section_cols item="column"}
   			<td width="33%" class="nowrap">
   			{foreach from=$column item="s"}
   			<p><span class="bull">&bull;</span>
   			{if $s.section_id == $section_id}
				{if $mode == "translate"}
		   			<input class="input-text" type="text" name="translate_sections[{$s.section_id}]" value="{$s.description}" />
					<strong>{$lang.open}</strong>&nbsp;&nbsp;
				{else}
		   			<strong>{$s.description}</strong>
				{/if}
   			{else}
				{if $mode == "translate"}
		   			<input class="input-text" type="text" name="translate_sections[{$s.section_id}]" value="{$s.description}" />
					<a href="{$index_script}?dispatch={$controller}.translate&amp;section_id={$s.section_id}" class="underlined">{$lang.view}</a>&nbsp;&nbsp;
				{else}
		   			<a href="{$index_script}?dispatch={$controller}.manage&amp;section_id={$s.section_id}">{$s.description}</a>
				{/if}
   			{/if}</p>
   			{/foreach}
   			</td>
   			{/foreach}
   		</tr>
   		</table>
	</td>
</tr>
</table>
{/if}
