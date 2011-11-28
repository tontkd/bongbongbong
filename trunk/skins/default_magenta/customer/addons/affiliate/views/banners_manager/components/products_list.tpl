{* $Id: products_list.tpl 7328 2009-04-21 12:49:32Z lexa $ *}

{if $list_data}
{script src="js/picker.js"}
{script src="js/jquery.easydrag.js"}
<ul class="bullets-list">
{foreach from=$list_data key=product_id item=product_name}
	<li>{include file="common_templates/popupbox.tpl" id="product_`$product_id`" link_text=$product_name text=$lang.product href="`$index_script`?dispatch=banner_products.view&product_id=`$product_id`"}</li>
{/foreach}
</ul>
{/if}