{* $Id: product_images.tpl 7068 2009-03-18 10:51:50Z zeke $ *}

{assign var="th_size" value="100"}
{include file="common_templates/previewer.tpl"}

{if $product.main_pair.icon}
	{assign var="image_pair_var" value=$product.main_pair}
{elseif $product.option_image_pairs}
	{assign var="image_pair_var" value=$product.option_image_pairs|reset}
{/if}
{include file="common_templates/image.tpl" obj_id=$product.product_id images=$image_pair_var object_type="product" class="cm-thumbnails"}

{foreach from=$product.image_pairs item="image_pair"}
	{if $image_pair}
		{include file="common_templates/image.tpl" images=$image_pair object_type="product" class="cm-thumbnails hidden" detailed_link_class="hidden" obj_id="`$product.product_id`_`$image_pair.image_id`"}
	{/if}
{/foreach}

{if $image_pair_var && $product.image_pairs}
<div class="center" style="width: {$settings.Thumbnails.product_thumbnail_width}px;">
<a class="cm-thumbnails-mini">{include file="common_templates/image.tpl" images=$image_pair_var object_type="product" link_class="cm-thumbnails-mini cm-cur-item" image_width=$th_size show_thumbnail="Y" show_detailed_link=false}</a>

{foreach from=$product.image_pairs item="image_pair"}
	{if $image_pair}
		<a class="cm-thumbnails-mini">{include file="common_templates/image.tpl" images=$image_pair object_type="product" link_class="cm-thumbnails-mini" image_width=$th_size show_thumbnail="Y" show_detailed_link=false}</a>
	{/if}
{/foreach}
</div>
{/if}
