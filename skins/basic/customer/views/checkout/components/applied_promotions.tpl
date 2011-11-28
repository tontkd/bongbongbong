{* $Id: applied_promotions.tpl 6791 2009-01-16 14:12:47Z angel $ *}

<div class="buttons-container clear-both">
	{include file="buttons/button.tpl" but_role="text" but_text=$lang.active_promotions but_id="sw_applied_promotions" but_meta="cm-combination"}
</div>
<div id="applied_promotions" class="right">
	<p>{$lang.text_applied_promotions}</p>
	<ul>
	{foreach from=$applied_promotions item="promotion"}
		<li>
			<a id="sw_promo_description_{$promotion.promotion_id}"class="cm-combination">{$promotion.name}</a>
			<div id="promo_description_{$promotion.promotion_id}" class="hidden">{$promotion.short_description|unescape}</div>
		</li>
	{/foreach}
	</ul>
<!--applied_promotions--></div>