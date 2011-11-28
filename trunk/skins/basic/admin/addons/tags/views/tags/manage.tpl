{* $Id: manage.tpl 7194 2009-04-03 14:21:51Z lexa $ *}
{capture name="mainbox"}

{script src="js/picker.js"}

{include file="addons/tags/views/tags/components/tags_search_form.tpl" dispatch="tags.manage"}


{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{if $settings.DHTML.admin_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}
{/if}

<form action="{$index_script}" method="post" name="tags_form">

{include file="common_templates/pagination.tpl"}

<table class="table sortable"  width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<th class="center"><input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="100%"><a class="{$ajax_class}{if $search.sort_by == "tag"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=tag&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.tag}</a></th>
	<th><a class="{$ajax_class}{if $search.sort_by == "popularity"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=popularity&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.popularity}</a></th>
	<th><a class="{$ajax_class}{if $search.sort_by == "users"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=users&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.users}</a></th>
	{foreach from=$tag_objects item="o"}
	<th>&nbsp;&nbsp;{$lang[$o.name]}&nbsp;&nbsp;</th>
	{/foreach}
	<th><a class="{$ajax_class}{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=status&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{foreach from=$tags item="tag"}
	<tr>
		<td><input type="checkbox" class="checkbox cm-item" value="{$tag.tag_id}" name="tag_ids[]"/></td>
		<td width="100%">
			<input type="text" name="tags_data[{$tag.tag_id}]" value="{$tag.tag}" size="20" class="input-text" />
		</td>
		<td>{$tag.popularity}</td>
		<td>{if $tag.users}<a href="{$index_script}?dispatch=profiles.manage&amp;tag={$tag.tag}">{$tag.users}{else}0{/if}</td>
		{foreach from=$tag_objects key="k" item="o"}
		<td>
			{if $tag.objects_count.$k}<a href="{$o.url}&amp;tag={$tag.tag}">{$tag.objects_count.$k}</a>{else}0{/if}
		</td>
		{/foreach}
		<td>
			{include file="common_templates/select_popup.tpl" id=$tag.tag_id status=$tag.status items_status="A: `$lang.approved`, D: `$lang.disapproved`, P: `$lang.pending`" object_id_name="tag_id" table="tags"}
		</td>
		<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{$index_script}?dispatch=tags.delete&amp;tag_id={$tag.tag_id}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$tag.tag_id tools_list=$smarty.capture.tools_items}
		</td>
	</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="{math equation="6 + x" x=$tag_objects|count}"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

<div class="buttons-container buttons-bg">
	<div class="float-left">

		{capture name="tools_list"}
		<ul>
			<li><a class="cm-process-items" name="dispatch[tags.disapprove]" rev="tags_form">{$lang.disapprove_selected}</a></li>
			<li><a class="cm-process-items" name="dispatch[tags.approve]" rev="tags_form">{$lang.approve_selected}</a></li>
			<li><a class="cm-confirm cm-process-items" name="dispatch[tags.delete]" rev="tags_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}

		{include file="buttons/save.tpl" but_name="dispatch[tags.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>

	<div class="float-right">
	{include file="common_templates/popupbox.tpl" id="add_new_section" text=$lang.new_tag link_text=$lang.add_tag act="general"}
	</div>
</div>
</form>


{capture name="tools"}
{capture name="add_new_picker"}
<form action="{$index_script}" method="post" name="add_tag_form" class="cm-form-highlight">
<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_static_data_new" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content" id="content_tab_static_data_new">
		<div class="form-field">
			<label class="cm-required" for="add_tag_data">{$lang.tag}:</label>
			<input type="text" size="40" name="add_tag_data[0][tag]" id="add_tag_data" value="" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="add_tag_status" class="cm-required">{$lang.status}:</label>
			<select name="add_tag_data[0][status]" id="add_tag_status">
				<option value="A">{$lang.approved}</option>
				<option value="D">{$lang.disapproved}</option>
				<option value="P">{$lang.pending}</option>
			</select>
		</div>
	</div>
</div>

<div class="buttons-container">
	{include file="buttons/create_cancel.tpl" but_name="dispatch[tags.add]" cancel_action="close"}
</div>

</form>
{/capture}
{include file="common_templates/popupbox.tpl" id="add_new_section" text=$lang.new_tag content=$smarty.capture.add_new_picker link_text=$lang.add_tag act="general"}
{/capture}

{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.tags content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}
