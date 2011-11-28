{* $Id: progressbar.tpl 6962 2009-03-02 14:40:38Z angel $ *}

<div class="pb-container">

<span class="{if $mode == "customer_info"}active{elseif $mode != "customer_info"}complete{/if}">
	<em>1</em>
	{if $mode != "customer_info"}<a href="{$index_script}?dispatch=checkout.customer_info">{/if}{$lang.customer_details}{if $mode != "customer_info"}</a>{/if}
</span>

<img src="{$images_dir}/icons/pb_arrow.gif" width="25" height="7" border="0" alt="&rarr;" />

<span class="{if $mode == "checkout"}active{elseif $mode == "summary"}complete{/if}">
	<em>2</em>
	{if $mode == "summary"}<a href="{$index_script}?dispatch=checkout.checkout">{/if}{$lang.shipping} / {$lang.payment}{if $mode == "summary"}</a>{/if}
</span>

<img src="{$images_dir}/icons/pb_arrow.gif" width="25" height="7" border="0" alt="&rarr;" />

<span class="{if $mode == "summary"}active{/if}">
	<em>3</em>
	{$lang.place_order}
</span>

</div>
