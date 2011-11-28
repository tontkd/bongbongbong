{* $Id: inventory.post.tpl 6780 2009-01-16 13:16:57Z zeke $ *}

<li>{$lang.configurable}:&nbsp;{if $product_stats.configurable}<a href="{$index_script}?dispatch=products.manage&amp;type=extended&amp;match=any&amp;configurable=C">{$product_stats.configurable}</a>{else}0{/if}</li>