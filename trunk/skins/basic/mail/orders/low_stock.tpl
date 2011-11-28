{* $Id: low_stock.tpl 5807 2008-08-26 09:27:03Z zeke $ *}
                                                   
{include file="letter_header.tpl"}
<table>
<tr>
	<td>{$lang.product}:</td>
	<td>{$product}</td>
</tr>
<tr>
	<td>{$lang.id}:</td>
	<td>{$product_id}</td>
</tr>
<tr>
	<td>{$lang.amount}:</td>
	<td><b>{$new_amount}</b></td>
</tr>
{if $product_options}
<tr>
	<td colspan="2">{$lang.product_options}:<br><hr></td>
</tr>
{foreach from=$product_options item=o}
<tr>
	<td>{$o.option_name}:</td>
	<td>{$o.variant_name}</td>
</tr>
{/foreach}
{/if}
</table>
{include file="letter_footer.tpl"}