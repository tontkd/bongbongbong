{* $Id: products_m_viewupdated.tpl 6740 2009-01-12 11:55:02Z isergi $ *}
{strip}
<p>{$lang.text_products_updated}</p>
{foreach from=$updated_products item=product}
<p>&nbsp;-&nbsp;<a href="{$index_script}?dispatch=products.update&amp;product_id={$product.product_id}">{$product.product|unescape}</a></p>
{/foreach}
{/strip}
