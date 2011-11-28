{* $Id: promotions.tpl 7092 2009-03-19 15:05:49Z lexa $ *}

{foreach from=$promotions item="promotion" key="promotion_id" name="pfe"}

{if $promotion.name}
	{include file="common_templates/subheader.tpl" title=$promotion.name}

	{foreach from=$order_info.promotions.$promotion_id.bonuses item="bonus" key="bonus_name"}
	{if $bonus_name == "give_coupon"}
	<div class="form-field">
		<label>{$lang.coupon_code}:</label>
		<a href="{$index_script}?dispatch=promotions.update&amp;promotion_id={$bonus.value}&amp;selected_section=conditions">{$bonus.coupon_code}</a>
	</div>
	{/if}
	{/foreach}

	{$promotion.short_description|unescape}
	<p>
	<a href="{$index_script}?dispatch=promotions.update&amp;promotion_id={$promotion_id}">{$lang.details}</a>
	</p>
{else}
	<p>{foreach from=$promotion.bonuses item="bonus" key="bonus_name"}
		{assign var="lvar" value="promotion_bonus_`$bonus_name`"}<strong>{$lang.$lvar}</strong>
	{/foreach} ({$lang.deleted})</p>
{/if}

{/foreach}
