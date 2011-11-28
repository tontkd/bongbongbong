{* $Id: payments.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:payment_methods **}

{assign var="payment_images" value=""|fn_get_payment_methods_images}
{if $payment_images}
<p class="center">
	{foreach from=$payment_images item=image}
		<img src="{$image.image_path}" width="{$image.image_x}" height="{$image.image_y}" alt="{$image.alt}" />
	{/foreach}
</p>
{/if}