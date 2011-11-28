{* $Id: group_info.tpl 7069 2009-03-18 11:01:17Z zeke $ *}

<div id="content_description_{$group_id}">
{script src="js/exceptions.js"}
<div class="object-container">
<table cellpadding="10" cellspacing="0" border="0" width="100%" >
<tr>
	<td>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td valign="top" class="center">
			{include file="common_templates/image.tpl" show_detailed_link=true obj_id=$product_configurator_group.group_id images=$product_configurator_group.main_pair object_type="conf_group" class="cm-thumbnails cm-single"}</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td valign="top" width="100%">
			<div class="product-details-title">{$product_configurator_group.configurator_group_name}</div>
			<p>{$product_configurator_group.full_description|unescape}</p>
		</td>
	</tr>
    </table>
    </td>
</tr>
</table>
</div>
<script type="text/javascript">
//<![CDATA[
	fn_check_exceptions({$product.product_id});
//]]>
</script>
<!--content_description_{$group_id}--></div>
