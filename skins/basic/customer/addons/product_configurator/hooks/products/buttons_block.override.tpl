{* $Id: buttons_block.override.tpl 6672 2008-12-24 13:53:05Z isergi $ *}

{if $product.product_type == "C" && !$product.configuration_mode}
	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.configure but_role="text" but_href="$index_script?dispatch=products.view&amp;product_id=`$product.product_id`"}
	</div>
{/if}