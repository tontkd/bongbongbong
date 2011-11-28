{* $Id: privileges.tpl 7165 2009-03-31 12:38:30Z angel $ *}

{capture name="mainbox"}

<form action="{$index_script}" method="post" name="privileges_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.privilege}</th>
	<th width="100%" class="center">{$lang.description}</th>
	{* <th>&nbsp;</th> *}
</tr>			 

{foreach from=$privileges key=section item=privilege}
<tr>
	<td colspan="3"><input size="25" type="text" class="input-text-long" name="section_name[{$section}]" value="{$section}" /></td>
</tr>

{foreach from=$privilege item=p}
<tr {cycle values="class=\"table-row\", "}>
	<td width="1%">
		{if $p.is_default == "Y"}&nbsp;{else}<input type="checkbox" name="delete[{$p.privilege}]" id="delete_checkbox" class="checkbox cm-item" value="Y" />{/if}</td>
	<td>{$p.privilege}</td>
	<td><input type="text" class="input-text" size="35" name="privilege_descr[{$p.privilege}]" value="{$p.description}" /></td>
	{* <td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$p.privilege tools_list=$smarty.capture.tools_items}
	</td> *}
</tr>
{/foreach}
{/foreach}
</table>

<div class="buttons-container buttons-bg">
	{include file="buttons/save.tpl" but_name="dispatch[memberships.privileges.update]" but_role="button_main"}
	{* 
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[memberships.privileges.delete]" class="cm-process-items cm-confirm" rev="privileges_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action} *}
</div>

</form>

{*include file="common_templates/subheader.tpl" title=$lang.add_new_privileges}

<form action="{$index_script}" method="post" name="add_privileges_form">

<table cellpadding="0" cellspacing="0" border="0" class="add-new-table">
<tr class="cm-first-sibling">
	<th>{$lang.privilege}</th>
	<th>{$lang.description}</th>
	<th>{$lang.section}</th>
	<th>&nbsp;</th>
</tr>
<tr id="box_add_membership">
	<td>
		<input type="text" name="add_privilege[0][privilege]" size="35" value="" class="input-text" /></td>
	<td>
		<input type="text" name="add_privilege_descr[0][description]" size="35" value="" class="input-text" /></td>
	<td align="center">
		<select name="add_privilege_descr[0][section]">
		{foreach from=$sections item=section}
		<option value="{$section}">{$section}</option>
		{/foreach}
		</select>
		</td>
	<td>
		{include file="buttons/multiple_buttons.tpl" item_id="add_membership"}</td>
</tr>
</table>

<div class="buttons-container">
	{include file="buttons/create.tpl" but_name="dispatch[memberships.privileges.add]" but_role="button_main"}
</div>

</form>
*}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.translate_privileges content=$smarty.capture.mainbox select_languages=true}
