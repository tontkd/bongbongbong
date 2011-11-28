{* $Id: affiliate.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:affiliate **}

{if $auth.is_affiliate}
<ul class="arrows-list">
	<li><a href="{$index_script}?dispatch=banners_manager.manage&amp;banner_type=T" class="underlined">{$lang.text_banners}</a></li>
	<li><a href="{$index_script}?dispatch=banners_manager.manage&amp;banner_type=G" class="underlined">{$lang.graphic_banners}</a></li>
	<li><a href="{$index_script}?dispatch=banners_manager.manage&amp;banner_type=P" class="underlined">{$lang.product_banners}</a></li>
	<li class="delim"></li>
	<li><a href="{$index_script}?dispatch=affiliate_plans.list" class="underlined">{$lang.affiliate_plan}</a></li>
	<li><a href="{$index_script}?dispatch=partners.list" class="underlined">{$lang.balance_account}</a></li>
	<li class="delim"></li>
	<li><a href="{$index_script}?dispatch=aff_statistics.commissions" class="underlined">{$lang.commissions}</a></li>
	<li><a href="{$index_script}?dispatch=payouts.list" class="underlined">{$lang.payouts}</a></li>
</ul>
{/if}
