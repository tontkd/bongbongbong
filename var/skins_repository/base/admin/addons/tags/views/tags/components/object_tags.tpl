{* $Id: object_tags.tpl 7083 2009-03-19 09:52:10Z zeke $ *}
<div id="content_tags">
{script src="lib/autocomplete/autocomplete.js"}

<style>
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
//]]>
{/literal}
</script>

<fieldset>
	<div class="form-field">
		<label>{$lang.popular_tags}:</label>
		{if $object.tags.popular}
			{foreach from=$object.tags.popular item="tag" name="tags"}
				{$tag.tag}({$tag.popularity}) {if !$smarty.foreach.tags.last},{/if}
			{/foreach}
		{else}
			{$lang.none}
		{/if}
	</div>

	<div class="form-field">
		<label>{$lang.my_tags}:</label>
		{if $auth.user_id}
			{foreach from=$object.tags.user item="tag" name="tags"}
				<span>
					<input type="hidden" name="{$input_name}[tags][]" value="{$tag.tag}" />
					{$tag.tag}
					<img src="{$images_dir}/icons/icon_delete.gif" border="0" alt="{$lang.remove_this_item|escape:html}" title="{$lang.remove_this_item|escape:html}" onclick="return removeTag(this.parentNode);" class="hand" align="top" style="padding-top:3px;" /> ,
				</span>
			{/foreach}
			<span id="tags_container">
				<span id="tag_input" class="cm-first-sibling">
					<input type="text" name="{$input_name}[tags][]">
					<img src="{$images_dir}/icons/icon_delete.gif" border="0" alt="{$lang.remove_this_item|escape:html}" title="{$lang.remove_this_item|escape:html}" onclick="return removeTag(this.parentNode);" class="hand" align="top" style="padding-top:3px;" />
				</span>
			</span>

			<img src="{$images_dir}/icons/icon_add.gif" border="0" name="add" id="{$item_id}" alt="{$lang.add_empty_item|escape:html}" title="{$lang.add_empty_item|escape:html}" onclick="return addTag();" class="hand" align="top" style="padding-top:3px" />

		{else}
			<a href="{$index_script}?dispatch=auth.login_form&amp;return_url={$config.current_url|escape:url}">{$lang.sign_in_to_enter_tags}</a>
		{/if}
	</div>
</fieldset>

</div>
