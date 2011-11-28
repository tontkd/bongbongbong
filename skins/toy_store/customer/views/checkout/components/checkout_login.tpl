{* $Id: checkout_login.tpl 7858 2009-08-18 09:05:51Z zeke $ *}

<script type="text/javascript">
//<![CDATA[

function fn_switch_checkout_type(status)
{$ldelim}
	{if $checkout_type == 'classic'}
		{literal}
		$('#profiles_auth').switchAvailability(true);
		$('#profiles_box').switchAvailability(false);
		$('#account_box').switchAvailability(!status);
		$('#sa').switchAvailability(!$('elm_ship_to_another').attr('checked'));
		{/literal}
	{else}
		{literal}
		if (status == true) {
			$('#step_one_register').show();
		} else {
			$('#step_one_anonymous_checkout').show();
		}
		$('#step_one_login').hide();
		{/literal}
	{/if}
{$rdelim}
//]]>
</script>

<table cellpadding="0" cellspacing="0" border="0" class="login-table">
<tr valign="top">
	<td width="50%" class="login">
		{include file="common_templates/subheader.tpl" title=$lang.returning_customer}
		{include file="views/auth/login_form.tpl" form_name="step_one_login_form" result_ids="sign_io,cart_items,checkout_totals,checkout_steps,cart_status" id="checkout"}
	</td>
	<td width="50%">
		{include file="common_templates/subheader.tpl" title=$lang.new_customer}
		{assign var="curl" value=$config.current_url|fn_query_remove:"login_type"}
		
		{if $settings.General.approve_user_profiles != "Y"}
			{$lang.text_dont_have_an_account_full}
			<div class="buttons-container right">{include file="buttons/button.tpl" but_href="$curl&amp;login_type=register" but_onclick="fn_switch_checkout_type(true);" but_text=$lang.register}</div>
			<div class="delim">&nbsp;</div>
		{/if}
		
		{if $settings.General.disable_anonymous_checkout != "Y"}
			{$lang.text_dont_want_to_register_an_account}
			<div class="buttons-container right">{include file="buttons/button.tpl" but_href="$curl&amp;login_type=guest" but_onclick="fn_switch_checkout_type(false);" but_text=$lang.checkout_as_guest}</div>
		{/if}
	</td>
</tr>
</table>
