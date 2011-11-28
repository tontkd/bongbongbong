{* $Id: options_js.post.tpl 6646 2008-12-22 21:00:51Z zeke $ *}

<script type="text/javascript">
//<![CDATA[

points[{$id}] = {$ldelim}
	'pure_amount': '{$product.points_info.reward.pure_amount}'
{$rdelim};

{if $product.points_info.reward}
points[{$id}]['reward'] = '{$product.points_info.reward.amount}';
{/if}

{if $product.points_info.per}
points[{$id}]['per'] = '{$product.points_info.per}';
{/if}

{if $product.points_info.reward.amount_type}
points[{$id}]['amount_type'] = '{$product.points_info.reward.amount_type}';
{/if}

{foreach from=$product_options item="po" name="ii"}	
pr_o[{$id}][{$po.option_id}]['pm'] = {$ldelim}{$rdelim};
{foreach from=$po.variants item="var" name="jj"}
	pr_o[{$id}][{$po.option_id}]['pm'][{$var.variant_id}] = {if $var.point_modifier|floatval}'{$var.point_modifier_type}{$var.point_modifier}'{else}'0'{/if};
{/foreach}
{/foreach}

//]]>
</script>