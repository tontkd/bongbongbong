{* $Id: tags.tpl 7132 2009-03-25 13:28:50Z angel $ *}
<div id="content_tags">
{script src="lib/autocomplete/autocomplete.js"}
<style type="text/css">
	@import url("{$config.current_path}/lib/autocomplete/autocomplete.css");
</style>
<script type="text/javascript">
//<![CDATA[
{literal}
$(document).ready(function(){
	$('#tag_input input').autocomplete(index_script, { extraParams: { dispatch: 'tags.list' } });
});

function removeTag(tag) {
	if (!$(tag).is('.cm-first-sibling')) {
		tag.parentNode.removeChild(tag);
	}

	// prevent default
	return false;
}

function addTag() {
	var t = $('#tag_input').clone().appendTo('#tags_container').removeClass('cm-first-sibling');
	t.find('input').val('');
	t.find('input').autocomplete(index_script, { extraParams: { dispatch: 'tags.list' } }).get(0).focus();

	//prevent default
	return false;
}
{/literal}
//]]>
</script>

    <form action="{$index_script}" method="post" name="add_tags_form">
		<input type="hidden" name="redirect_url" value="{$config.current_url}" />
		<input type="hidden" name="tags_data[object_type]" value="{$object_type}" />
		<input type="hidden" name="tags_data[object_id]" value="{$object_id}" />
		<input type="hidden" name="selected_section" value="tags" />
		<div class="form-field">
			<label>{$lang.popular_tags}:</label>
			{if $object.tags.popular}
				{foreach from=$object.tags.popular item="tag" name="tags"}
					<a href="{$index_script}?dispatch=tags.view&amp;tag={$tag.tag|escape:url}">{$tag.tag}</a> ({$tag.popularity}) {if !$smarty.foreach.tags.last},{/if}
				{/foreach}
			{else}
				{$lang.none}
			{/if}
		</div>
		<!--dynamic:manage_user_tags-->
		<div class="form-field">
			<label>{$lang.my_tags}:</label>
			{if $auth.user_id}
				{foreach from=$object.tags.user item="tag" name="tags"}
					<span>
						<input type="hidden" name="tags_data[values][]" value="{$tag.tag}" />
						<a href="{$index_script}?dispatch=tags.view&amp;tag={$tag.tag|escape:url}">{$tag.tag}</a>
						&nbsp;<img src="{$images_dir}/icons/delete_icon.gif" width="12" height="11" border="0" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" onclick="return removeTag(this.parentNode);" class="hand" align="top" />{if !$smarty.foreach.tags.last}, {/if}
					</span>
				{/foreach}
			
				<div id="tags_container">
					<p id="tag_input" class="cm-first-sibling">
						<input type="text" name="tags_data[values][]" class="input-text" />
						<img src="{$images_dir}/icons/remove_item.gif" width="14" height="15" border="0" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" onclick="return removeTag(this.parentNode);" class="valign hand" />
					</p>
				</div>

				<div class="tags-buttons">
					<img src="{$images_dir}/icons/add_empty_item.gif" width="14" height="15" border="0" name="add" alt="{$lang.add_empty_item}" title="{$lang.add_empty_item}" onclick="return addTag();" class="valign hand" />
					{include file="buttons/button.tpl" but_text=$lang.save_tags but_name="dispatch[tags.update]"}
				</div>

			{else}
				<a class="text-button" href="{$index_script}?dispatch=auth.login_form&amp;return_url={$config.current_url|escape:url}">{$lang.sign_in_to_enter_tags}</a>
			{/if}
		</div>
		<!--/dynamic-->
	</form>
</div>
