{* $Id: m_add.tpl 6971 2009-03-05 09:28:18Z zeke $ *}

{capture name="mainbox"}
<form action="{$index_script}" method="post" name="categories_m_addition_form">

<table cellpadding="0" cellspacing="0" width="100%"	border="0" class="table">
<tr class="cm-first-sibling">
	<th>{$lang.category_location}</th>
	<th>{$lang.category_name}</th>
	<th>{$lang.membership}</th>
	<th>{$lang.position}</th>
	<th>{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
<tr id="box_new_cat_tag">
	<td>
		{if "categories"|fn_show_picker:$smarty.const.CATEGORY_THRESHOLD}
			{include file="pickers/categories_picker.tpl" data_id="location_category" input_name="categories_data[0][parent_id]" item_ids=0 hide_link=true hide_delete_button=true show_root=true default_name=$lang.root_level}
		{else}
		<select	name="categories_data[0][parent_id]">
			<option	value="0" selected="selected">- {$lang.root_level} -</option>
			{foreach from=0|fn_get_plain_categories_tree:false item="cat"}
			<option	value="{$cat.category_id}">{$cat.category|indent:$cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
			{/foreach}
		</select>
		{/if}
	</td>
	<td>
		<input class="input-text" type="text" name="categories_data[0][category]" size="40" value="" /></td>
	<td class="center">
		<select name="categories_data[0][membership_id]">
			<option value="0" selected="selected">- {$lang.all} -</option>
			{foreach from="C"|fn_get_memberships:$smarty.const.DESCR_SL item=membership}
			<option value="{$membership.membership_id}">{$membership.membership}</option>
			{/foreach}
		</select>
	</td>
	<td class="center">
		<input class="input-text-short" type="text" name="categories_data[0][position]" size="3" value="" /></td>
	<td class="center">
		<select name="categories_data[0][status]">
			<option value="A">{$lang.active}</option>
			<option value="H">{$lang.hidden}</option>
			<option value="D">{$lang.disabled}</option>
		</select>
	</td>
	<td>
		{include file="buttons/multiple_buttons.tpl" item_id="new_cat_tag"}</td>
</tr>
</table>

<div class="buttons-container buttons-bg">
	{include file="buttons/create.tpl" but_name="dispatch[categories.m_add]" but_role="button_main"}
</div>

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.add_categories content=$smarty.capture.mainbox}
