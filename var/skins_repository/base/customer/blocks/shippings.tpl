{* $Id: shippings.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:shipping_methods **}
{assign var="shippings_images" value=""|fn_get_shipping_images}
{if $shippings_images}
<p class="center">
	{foreach from=$shippings_images item=image}
		<img src="{$image.image_path}" width="{$image.image_x}" height="{$image.image_y}" alt="{$image.alt}" />
	{/foreach}
</p>
{/if}