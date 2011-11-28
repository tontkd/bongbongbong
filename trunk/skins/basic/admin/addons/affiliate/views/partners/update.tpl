{* $Id: update.tpl 7867 2009-08-20 11:09:56Z angel $ *}

{capture name="mainbox"}

{capture name="extra_tools"}
<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$partner.user_id}" class="tool-link">{$lang.edit_affiliate}</a>
{/capture}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td width="50%">
	{include file="common_templates/subheader.tpl" title=$lang.personal_information}
	
	<div class="details-block">
		<div class="form-field">
			<label>{$lang.active}:</label>
			<strong>{if $partner.active == "Y"}{$lang.yes}{else}{$lang.no}{/if}</strong>
		</div>
		
		<div class="form-field">
			<label>{$lang.username}:</label>
			<strong>{$partner.user_login}</strong>
		</div>
		
		{if $partner.title_descr}
		<div class="form-field">
			<label>{$lang.title}:</label>
			<strong>{$partner.title_descr}</strong>
		</div>
		{/if}

		<div class="form-field">
			<label>{$lang.first_name}:</label>
			<strong>{$partner.firstname}</strong>
		</div>
		
		<div class="form-field">
			<label>{$lang.last_name}:</label>
			<strong>{$partner.lastname}</strong>
		</div>
		
		{if $partner.company}
		<div class="form-field">
			<label>{$lang.company}:</label>
			<strong>{$partner.company}</strong>
		</div>
		{/if}
		
		{if $partner.email}
		<div class="form-field">
			<label>{$lang.email}:</label>
			<a href="mailto:{$partner.email}" class="strong">{$partner.email}</a>
		</div>
		{/if}
		
		{if $partner.phone}
		<div class="form-field">
			<label>{$lang.phone}:</label>
			<strong>{$partner.phone}</strong>
		</div>
		{/if}
		
		{if $partner.fax}
		<div class="form-field">
			<label>{$lang.fax}:</label>
			<strong>{$partner.fax}</strong>
		</div>
		{/if}
	</div>
	
	{include file="common_templates/subheader.tpl" title=$lang.affiliate_information}
	
	<div class="details-block">
		<div class="form-field">
			<label>{$lang.status}:</label>
			<strong>{if $partner.approved == "A"}{$lang.approved}{elseif $partner.approved == "D"}{$lang.declined}{else}{$lang.awaiting_approval}{/if}</strong> (<a href="{$index_script}?dispatch=partners.manage&amp;user_type=P&amp;name={$partner.firstname}&amp;user_login={$partner.user_login}&amp;email={$partner.email}">{$lang.change}</a>)
		</div>

		{if $addons.affiliate.show_affiliate_code == "Y"}
		<div class="form-field">
			<label>{$lang.affiliate_code}:</label>
			<strong>{$partner.user_id|fn_dec2any}</strong>
		</div>
		{/if}
		
		{if $partner.plan}
		<div class="form-field">
			<label>{$lang.plan}:</label>
			<a href="{$index_script}?dispatch=affiliate_plans.update&amp;plan_id={$partner.plan_id}" class="strong">{$partner.plan}</a> (<a href="{$index_script}?dispatch=partners.manage.reset_search&amp;user_type=P&amp;name={$partner.firstname}&amp;user_login={$partner.user_login}&email={$partner.email}">{$lang.change}</a>)
		</div>
		{/if}
		
		<div class="form-field">
			<label>{$lang.balance_account}:</label>
			<strong>{include file="common_templates/price.tpl" value=$partner.balance}</strong>
		</div>
		
		<div class="form-field">
			<label>{$lang.total_payouts}:</label>
			<form action="{$index_script}" method="POST" name="partner_payouts_form">
				<input type="hidden" name="payout_search[partner_id]" value="{$partner.user_id}" />
				<strong>{include file="common_templates/price.tpl" value=$partner.total_payouts}{if $partner.total_payouts}</strong> (<a href="{$index_script}?dispatch=payouts.manage&amp;partner_id={$partner.user_id}&amp;period=A">{$lang.view}</a>){/if}
			</form>
		</div>
	</div>
	</td>
	<td class="details-block-container" width="50%">
	
	{include file="common_templates/subheader.tpl" title=$lang.commissions_of_last_periods}
	
	<table cellpadding="2" cellspacing="1" border="0">
		{foreach from=$last_payouts item=period}
		<tr>
			<td>
			{if $period.amount > 0}<a href="{$index_script}?dispatch=aff_statistics.approve&amp;partner_id={$partner.user_id}&amp;plan_id={$partner.plan_id}&amp;period=C&amp;time_from={$period.range.start|date_format:"`$settings.Appearance.date_format`"|escape:url}&amp;time_to={$period.range.end|date_format:"`$settings.Appearance.date_format`"|escape:url}">{/if}{$period.range.start|date_format:$settings.Appearance.date_format}{if $period.amount > 0}</a>{/if}</td>
			<td>{include file="views/sales_reports/components/graph_bar.tpl" bar_width="300px" value_width=$period.amount/$max_amount*100|round}</td>
			<td align="right">{include file="common_templates/price.tpl" value=$period.amount}</td>
		</tr>
		{/foreach}
		<tr>
			<td colspan="3" align="right"><p>{$lang.total_commissions}:&nbsp;<strong>{include file="common_templates/price.tpl" value=$total_commissions}</strong></p></td>
		</tr>
	</table>
	</td>
</tr>
</table>

{include file="common_templates/subheader.tpl" title=$lang.affiliate_tree}
<div class="items-container multi-level">
{include file="addons/affiliate/views/partners/components/partner_tree.tpl" partners=$partners header=1 level=0}
</div>
{/capture}
{include file="common_templates/mainbox.tpl" title="`$lang.viewing_affiliate`: `$partner.firstname` `$partner.lastname`" content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools}

</form>
