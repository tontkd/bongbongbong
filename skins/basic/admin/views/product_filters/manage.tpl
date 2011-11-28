{* $Id: manage.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{script src="js/picker.js"}
{script src="js/tabs.js"}

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_check_product_filter_type(value, tab_id)
{
	$('#' + tab_id).toggleBy(!(value.indexOf('R') == 0));
}
//]]>
</script>
{/literal}

{capture name="mainbox"}


<div class="items-container" id="manage_filters_list">
{foreach from=$filters item="filter"}

	{include file="common_templates/object_group.tpl" id=$filter.filter_id text=$filter.filter href="`$index_script`?dispatch=product_filters.update&amp;filter_id=`$filter.filter_id`" href_delete="`$index_script`?dispatch=product_filters.delete&amp;filter_id=`$filter.filter_id`" rev_delete="manage_filters_list" header_text="`$lang.editing_filter`:&nbsp;`$filter.filter`" table="product_filters" object_id_name="filter_id" status=$filter.status}
	
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--manage_filters_list--></div>

<div class="buttons-container">
	{include file="common_templates/popupbox.tpl" id="add_product_filter" text=$lang.new_filter link_text=$lang.add_filter act="general"}
</div>

{capture name="tools"}
	{capture name="add_new_picker"}
		{include file="views/product_filters/update.tpl" mode="add" filter=""}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_product_filter" text=$lang.new_filter content=$smarty.capture.add_new_picker link_text=$lang.add_filter act="general"}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.product_filters content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}