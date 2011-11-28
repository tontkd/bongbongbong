{* $Id: manage.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{** include fileuploader **}
{include file="common_templates/file_browser.tpl"}
{** /include fileuploader **}

{script src="js/tabs.js"}
{script src="js/picker.js"}

{if $mainbox_title}
{include file="common_templates/subheader.tpl" title=$mainbox_title}
{else}
{capture name="mainbox"}
{/if}

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_check_product_feature_type(value, tab_id)
{
	var t = $('#content_' + tab_id);
	$('#' + tab_id).toggleBy(!(value == 'S' || value == 'M' || value == 'N' || value == 'E'));
	// display/hide images
	$('.cm-extended-feature', t).toggleBy(value != 'E');
	if (value != 'E') {
		$('tr[id^=extra_feature_]', t).hide();
		$('img[id^=off_extra_feature_]', t).hide();
		$('img[id^=on_extra_feature_]', t).show();
		$('img[id^=off_st_]', t).hide();
		$('img[id^=on_st_]', t).show();
	}

	if (value == 'N') {
		$('.cm-feature-value', t).addClass('cm-value-integer');
	} else {
		$('.cm-feature-value', t).removeClass('cm-value-integer');
	}
}
//]]>
</script>
{/literal}

<div class="items-container" id="update_features_list">
{if $features}
	<div class="object-group clear">
		<div class="float-left object-name">
			{$lang.ungroupped_features}
		</div>
	</div>
	
	{foreach from=$features item="p_feature"}
		{if $p_feature.feature_type != "G"}
			{include file="common_templates/object_group.tpl" id=$p_feature.feature_id text=$p_feature.description status=$p_feature.status hidden=true href="`$index_script`?dispatch=product_features.update&feature_id=`$p_feature.feature_id`$extra_href" object_id_name="feature_id" table="product_features" href_delete="`$index_script`?dispatch=product_features.delete&feature_id=`$p_feature.feature_id`" rev_delete="update_features_list" header_text="`$lang.editing_product_feature`:&nbsp;`$p_feature.description`" element="-elements"}
		{/if}
	{/foreach}
	
	{foreach from=$features item="gr_feature"}
		{if $gr_feature.feature_type == "G"}
			{include file="common_templates/object_group.tpl" id=$gr_feature.feature_id text=$gr_feature.description status=$gr_feature.status hidden=true href="`$index_script`?dispatch=product_features.update&feature_id=`$gr_feature.feature_id`$extra_href" object_id_name="feature_id" table="product_features" href_delete="`$index_script`?dispatch=product_features.delete&feature_id=`$gr_feature.feature_id`" rev_delete="update_features_list" header_text="`$lang.editing_group`:&nbsp;`$gr_feature.description`"}
	
			{if $gr_feature.subfeatures}
				{foreach from=$gr_feature.subfeatures item="subfeature"}
					{include file="common_templates/object_group.tpl" id=$subfeature.feature_id text=$subfeature.description status=$subfeature.status hidden=true href="`$index_script`?dispatch=product_features.update&feature_id=`$subfeature.feature_id`$extra_href" object_id_name="feature_id" table="product_features" href_delete="`$index_script`?dispatch=product_features.delete&feature_id=`$subfeature.feature_id`" rev_delete="update_features_list" header_text="`$lang.editing_product_feature`:&nbsp;`$subfeature.description`" element="-elements"}
				{/foreach}
			{/if}
	
		{/if}
	{/foreach}
{else}
	<p class="no-items">{$lang.no_data}</p>
{/if}
<!--update_features_list--></div>

<div class="buttons-container">
	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/product_features/update.tpl" feature="" mode="add" is_group=true}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_group" text=$lang.add_new_group content=$smarty.capture.add_new_picker link_text=$lang.add_group act="general"}

		{capture name="add_new_picker_2"}
			{include file="views/product_features/update.tpl" feature="" mode="add"}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_feature" text=$lang.add_new_feature content=$smarty.capture.add_new_picker_2 link_text=$lang.add_feature act="general"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_group" text=$lang.add_new_group link_text=$lang.add_group act="general"}
	{include file="common_templates/popupbox.tpl" id="add_new_feature" text=$lang.add_new_feature link_text=$lang.add_feature act="general"}
</div>

{if !$mainbox_title}
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.product_features content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
{/if}
