{* $Id: manage.tpl 7236 2009-04-09 09:47:22Z lexa $ *}

{script src="js/picker.js"}

{capture name="mainbox"}

<form action="{$index_script}" method="post" name="memberships_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.membership}</th>
	<th>{$lang.type}</th>
	<th width="100%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$memberships item=membership}
<tr {cycle values="class=\"table-row\", "}>
	<td width="1%">
		<input type="checkbox" name="membership_ids[]" value="{$membership.membership_id}" class="checkbox cm-item" /></td>
	<td>
		<input type="text" name="membership_data[{$membership.membership_id}][membership]" size="35" value="{$membership.membership}" class="input-text" />
	</td>
	<td>
		<select name="membership_data[{$membership.membership_id}][type]">
			<option value="C" {if $membership.type == "C"}selected="selected"{/if}>{$lang.customer}</option>
			<option value="A" {if $membership.type == "A"}selected="selected"{/if}>{$lang.administrator}</option>
		</select></td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$membership.membership_id status=$membership.status hidden="" object_id_name="membership_id" table="memberships"}
	</td>
	<td class="nowrap right">{if $membership.type == "A"}
			{assign var="_href" value="$index_script?dispatch=memberships.assign_privileges&membership_id=`$membership.membership_id`"}
			{assign var="_link_text" value=$lang.privileges}
		{else}
			{assign var="_href" value=""}
			{assign var="_link_text" value=""}
		{/if}
		
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}?dispatch=memberships.delete&amp;membership_id={$membership.membership_id}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$membership.membership_id tools_list=$smarty.capture.tools_items href=$_href link_text=$_link_text}
		</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

<div class="buttons-container buttons-bg">
	{if $memberships}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[memberships.delete]" class="cm-process-items cm-confirm" rev="memberships_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[memberships.update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
	
	<div class="float-right">
	{capture name="tools"}
		{capture name="add_new_picker"}
		<form action="{$index_script}" method="post" name="add_memberships_form" class="cm-form-highlight">
		<div class="object-container">
			<div class="tabs cm-j-tabs">
				<ul>
					<li id="tab_memberships_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
				</ul>
			</div>

			<div class="cm-tabs-content" id="content_tab__memberships_new">
				<div class="form-field">
					<label class="cm-required">{$lang.membership}:</label>
					<input type="text" name="add_membership_data[0][membership]" size="35" value="" class="input-text-large main-input" />
				</div>

				<div class="form-field">
					<label>{$lang.type}:</label>
					<select name="add_membership_data[0][type]">
						<option value="C">{$lang.customer}</option>
						<option value="A">{$lang.administrator}</option>
					</select>
				</div>

				{include file="common_templates/select_status.tpl" input_name="add_membership_data[0][status]" id="add_membership_data"}
			</div>
		</div>

		<div class="buttons-container">
			{include file="buttons/create_cancel.tpl" but_name="dispatch[memberships.add]" cancel_action="close"}
		</div>

		</form>
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_memberships" text=$lang.add_new_memberships content=$smarty.capture.add_new_picker link_text=$lang.add_membership act="general"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_memberships" text=$lang.add_new_memberships link_text=$lang.add_membership act="general"}
	</div>
</div>

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.memberships content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
