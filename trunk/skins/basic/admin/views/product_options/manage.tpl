{* $Id: manage.tpl 7806 2009-08-12 10:22:35Z alexions $ *}

{** include fileuploader **}
{include file="common_templates/file_browser.tpl"}
{** /include fileuploader **}

{script src="js/tabs.js"}
{literal}
<script type="text/javascript">
//<![CDATA[
function fn_check_option_type(value, tag_id)
{
	var id = tag_id.replace('option_type_', '');
	$('#tab_option_variants_' + id).toggleBy(!(value == 'S' || value == 'R' || value == 'C'));
	$('#extra_options_' + id).toggleBy(!(value == 'I' || value == 'T'));
	
	if (value == 'C') {
		var t = $('table', '#content_tab_option_variants_' + id);
		$('.cm-non-cb', t).switchAvailability(true); // hide obsolete columns
		$('tbody:gt(1)', t).switchAvailability(true); // hide obsolete rows

	} else if (value == 'S' || value == 'R') {
		var t = $('table', '#content_tab_option_variants_' + id);
		$('.cm-non-cb', t).switchAvailability(false); // show all columns
		$('tbody', t).switchAvailability(false); // show all rows
		$('#box_add_variant_' + id).show(); // show "add new variants" box
		
	} else if (value == 'I' || value == 'T') {
		$('#extra_options_' + id).show(); // show "add new variants" box
	}
}
//]]>
</script>
{/literal}

{capture name="mainbox"}

{if $object == "global"}
	{assign var="select_languages" value=true}
{/if}

<div class="items-container" id="product_options_list">
{foreach from=$product_options item="po"}
	{if $object == "product" && !$po.product_id}
		{assign var="details" value="(`$lang.global`)"}
	{else}
		{assign var="details" value=""}
	{/if}
	{include file="common_templates/object_group.tpl" id=$po.option_id id_prefix="_product_option_" details=$details text=$po.option_name status=$po.status table="product_options" object_id_name="option_id" href="`$index_script`?dispatch=product_options.update&option_id=`$po.option_id`&product_id=`$product_id`" href_delete="`$index_script`?dispatch=product_options.delete&option_id=`$po.option_id`&product_id=`$product_id`" rev_delete="product_options_list" header_text="`$lang.editing_option`:&nbsp;`$po.option_name`"}

{foreachelse}

	<p class="no-items">{$lang.no_items}</p>

{/foreach}
<!--product_options_list--></div>

<div class="buttons-container">
	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/product_options/update.tpl" mode="add" option_id="0"}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_option" text=$lang.new_option link_text=$lang.add_option act="general" content=$smarty.capture.add_new_picker}
	{/capture}
	{if $object == "global"}
	{include file="common_templates/popupbox.tpl" id="add_new_option" text=$lang.new_option link_text=$lang.add_option act="general"}
	{else}
		{$smarty.capture.tools}
	{/if}

	{if $product_options && $object == "global"}
		{include file="buttons/button.tpl" but_text=$lang.apply_to_products but_role="text" but_href="$index_script?dispatch=product_options.apply"}
	{/if}

	{$extra}
</div>

{/capture}

{if $object == "product"}
	{$smarty.capture.mainbox}
{else}
	{include file="common_templates/mainbox.tpl" title=$lang.global_options content=$smarty.capture.mainbox tools=$smarty.capture.tools select_language=$select_language}
{/if}

