{* $Id: assign_privileges.tpl 7165 2009-03-31 12:38:30Z angel $ *}

{capture name="mainbox"}

<form action="{$index_script}" method="post" name="memberships_form">
<input type="hidden" name="membership_id" value="{$smarty.request.membership_id}" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table privelegies">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="100%">{$lang.privilege}</th>
</tr>

{foreach from=$privileges item=privilege key=section}
<tr>
	<td colspan="2" class="privileges-header">{$section}</td>
</tr>
{foreach from=$privilege item=p}
{assign var="pr_id" value=$p.privilege}
<tr class="object-group-elements">
	<td>
		<input type="checkbox" name="set_privileges[{$pr_id}]" value="Y" {if $membership_privileges.$pr_id}checked="checked"{/if} class="checkbox cm-item" /></td>
	<td>{$p.description}</td>
</tr>
{/foreach}
{/foreach}
</table>

<div class="buttons-container buttons-bg">
	{include file="buttons/save.tpl" but_name="dispatch[memberships.assign_privileges]" but_role="button_main"}
</div>

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.privileges content=$smarty.capture.mainbox}

