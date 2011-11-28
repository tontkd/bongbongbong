{* $Id: checkout_steps.tpl 7831 2009-08-14 11:00:27Z alexey $ *}

{include file="views/profiles/components/profiles_scripts.tpl"}
<div class="checkout-steps" id="checkout_steps">

{if $completed_steps.step_one == true}{assign var="complete" value=true}{assign var="_title" value=$lang.save}{else}{assign var="complete" value=false}{assign var="_title" value=$lang.next_step}{/if}
{if $edit_step == "step_one"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}

<div class="step-container{if $edit}-active{/if}" id="step_one">
	<h2 class="step-title{if $edit}-active{/if}">
		<span class="float-left">1.</span>

		{if $complete || $edit}
			<img src="{$images_dir}/icons/icon_step_{if $edit}open{else}close{/if}.gif" width="14" height="14" border="0" alt="" class="float-right" />
		{/if}

		{if !$edit}
			{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.checkout&amp;edit_step=step_one&amp;from_step=$edit_step" but_rev="checkout_steps,cart_items,checkout_totals" but_meta="float-right cm-ajax" but_text=$lang.edit but_role="tool"}
		{/if}

		<a class="title{if $contact_info_population && !$edit} cm-ajax{/if}" {if $contact_info_population && !$edit}href="{$index_script}?dispatch=checkout.checkout&amp;edit_step=step_one&amp;from_step={$edit_step}" rev="checkout_steps,cart_items,checkout_totals"{/if}>{$lang.contact_information}</a>
	</h2>
	{assign var="curl" value=$config.current_url|fn_query_remove:"login_type"}
	<div id="step_one_body" class="step-body{if $edit}-active{/if}">
		{if ($settings.General.disable_anonymous_checkout == "Y" && !$auth.user_id) || ($settings.General.disable_anonymous_checkout != "Y" && !$auth.user_id && !$contact_info_population) || $smarty.session.failed_registration == true}
			<div id="step_one_login" {if $login_type != "login"}class="hidden"{/if}>
				<div class="clear">
					{include file="views/checkout/components/checkout_login.tpl" checkout_type="one_page"}
				</div>
			</div>
			<div id="step_one_register" {if $login_type != "register"}class="hidden"{/if}>
				<form name="step_one_register_form" class="cm-ajax" action="{$index_script}" method="post">
				<input type="hidden" name="result_ids" value="checkout_steps,checkout_totals{if !$edit},cart_items{/if},sign_io" />
				<input type="hidden" name="return_to" value="checkout" />

				{include file="views/profiles/components/profiles_account.tpl" nothing_extra="Y" location="checkout"}
				{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y"}

				{hook name="checkout:checkout_steps"}{/hook}

				{if $settings.Image_verification.use_for_register == "Y"}
					{include file="common_templates/image_verification.tpl" id="register" align="center"}
				{/if}

				<div class="buttons-container">
				{include file="buttons/button.tpl" but_name="dispatch[checkout.add_profile]" but_text=$_title}
				&nbsp;{$lang.or}&nbsp;
				{include file="buttons/button.tpl" but_href=$curl but_onclick="$('#step_one_register').hide(); $('#step_one_login').show();" but_text=$lang.cancel but_role="tool"}
				</div>
				</form>
			</div>

			{if $settings.General.disable_anonymous_checkout != "Y"}
			<div id="step_one_anonymous_checkout" {if $login_type != "guest"}class="hidden"{/if}>
				<form name="step_one_anonymous_checkout_form" class="cm-ajax" action="{$index_script}" method="post">
				<input type="hidden" name="result_ids" value="checkout_steps,checkout_totals{if !$edit},cart_items{/if}" />

				{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y" id_prefix="soacf_"}

				{hook name="checkout:checkout_steps"}{/hook}

				{if $settings.Image_verification.use_for_checkout == "Y"}
					{include file="common_templates/image_verification.tpl" id="checkout" align="center"}
				{/if}

				<div class="buttons-container">
				{include file="buttons/button.tpl" but_name="dispatch[checkout.customer_info]" but_text=$_title}
				&nbsp;{$lang.or}&nbsp;
				{include file="buttons/button.tpl" but_href=$curl but_onclick="$('#step_one_anonymous_checkout').hide(); $('#step_one_login').show();" but_text=$lang.cancel but_role="tool"}
				</div>

				</form>
			</div>
			{/if}
		{else}
			<div>
				<form name="step_one_contact_information_form" class="cm-ajax cm-ajax-force" action="{$index_script}" method="{if !$edit}get{else}post{/if}">
				<input type="hidden" name="update_step" value="step_one" />
				<input type="hidden" name="next_step" value="{if $smarty.request.from_step && $smarty.request.from_step != "step_one"}{$smarty.request.from_step}{else}step_two{/if}" />
				<input type="hidden" name="result_ids" value="checkout_steps,checkout_totals{if !$edit},cart_items{/if}" />
				{if !$edit}
					{include file="views/profiles/components/step_profile_fields.tpl" section="C"}
				{else}
					{include file="views/profiles/components/profile_fields.tpl" section="C" nothing_extra="Y"}

					{hook name="checkout:checkout_steps"}
					<div class="buttons-container">
					{include file="buttons/button.tpl" but_name="dispatch[checkout.update_steps]" but_text=$_title}
					{if $smarty.request.from_step}
						&nbsp;{$lang.or}&nbsp;
						{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.checkout&amp;edit_step=`$smarty.request.from_step`" but_meta="cm-ajax cm-ajax-force" but_rev="checkout_steps,cart_items,checkout_totals" but_text=$lang.cancel but_role="tool"}
					{/if}
					</div>
					{/hook}
				{/if}
				</form>
			</div>
		{/if}
	</div>
<!--step_one--></div>

{if $profile_fields.B || $profile_fields.S}

{if $completed_steps.step_two == true}{assign var="complete" value=true}{assign var="_title" value=$lang.save}{else}{assign var="complete" value=false}{assign var="_title" value=$lang.next_step}{/if}
{if $edit_step == "step_two"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}

<div class="step-container{if $edit}-active{/if}" id="step_two">
	<h2 class="step-title{if $edit}-active{/if}">
		<span class="float-left">2.</span>

		{if $complete || $edit}
			<img src="{$images_dir}/icons/icon_step_{if $edit}open{else}close{/if}.gif" width="14" height="14" border="0" alt="" class="float-right" />
		{/if}

		{if !$edit && $complete}
			{include file="buttons/button.tpl" but_meta="float-right cm-ajax" but_href="$index_script?dispatch=checkout.checkout&amp;edit_step=step_two&amp;from_step=$edit_step" but_rev="checkout_steps" but_text=$lang.edit but_role="tool"}
		{/if}
		
		<a class="title{if !$edit} cm-ajax{/if}" {if !$edit}href="{$index_script}?dispatch=checkout.checkout&amp;edit_step=step_two&amp;from_step={$edit_step}" rev="checkout_steps,cart_items,checkout_totals"{/if}>{$lang.address}</a>
	</h2>

	<div id="step_two_body" class="step-body{if $edit}-active{/if} {if !$edit && !$complete}hidden{/if}">
		<div>
			<form name="step_two_billing_address" class="cm-ajax cm-ajax-force" action="{$index_script}" method="{if !$edit}get{else}post{/if}">
			<input type="hidden" name="update_step" value="step_two" />
			<input type="hidden" name="next_step" value="{if $smarty.request.from_step && $smarty.request.from_step != "step_two"}{$smarty.request.from_step}{else}step_three{/if}" />
			<input type="hidden" name="result_ids" value="checkout_steps,checkout_totals{if !$edit},cart_items{/if}" />
			<input type="hidden" name="dispatch" value="checkout.checkout" />

			{if $smarty.request.profile == "new"}
				{assign var="hide_profile_name" value=false}
			{else}
				{assign var="hide_profile_name" value=true}
			{/if}

			{if !$edit}
			<div class="step-complete-wrapper multiple-profiles">
				{include file="views/profiles/components/multiple_profiles.tpl" hide_profile_name=$hide_profile_name hide_profile_delete=true profile_id=$cart.profile_id create_href="$index_script?dispatch=checkout.checkout&amp;edit_step=step_two&amp;from_step=$edit_step&amp;profile=new"}
			</div>
			{else}
				{include file="views/profiles/components/multiple_profiles.tpl" show_title=true hide_profile_name=$hide_profile_name hide_profile_delete=true profile_id=$cart.profile_id create_href="$index_script?dispatch=checkout.checkout&amp;edit_step=step_two&amp;from_step=$edit_step&amp;profile=new"}
			{/if}

			{if !$edit}

				{if $profile_fields.B}
				{include file="views/profiles/components/step_profile_fields.tpl" section="B" text=$lang.billing_address}
				{/if}

				{if $profile_fields.S}
				{if $cart.ship_to_another}
					{include file="views/profiles/components/step_profile_fields.tpl" section="S" text=$lang.shipping_address}
				{else}
					<p class="step-complete-wrapper">
						<span class="strong">{$lang.shipping_address}:&nbsp;</span>
						{$lang.text_ship_to_billing}
					</p>
				{/if}
				{/if}
			{else}

				{if $profile_fields.B}
				{include file="common_templates/subheader.tpl" title=$lang.billing_address}
				{include file="views/profiles/components/profile_fields.tpl" section="B" nothing_extra="Y"}
				{/if}

				{if $profile_fields.S}
				{include file="common_templates/subheader.tpl" title=$lang.shipping_address}
				{include file="views/profiles/components/profile_fields.tpl" section="S" nothing_extra="Y" body_id="sa" shipping_flag=$profile_fields.B|sizeof|default:false ship_to_another=$cart.ship_to_another}
				{/if}

				<div class="buttons-container">
				{include file="buttons/button.tpl" but_name="dispatch[checkout.update_steps]" but_text=$_title}
				{if ($billing_population || $smarty.request.profile == "new") && $smarty.request.from_step}
					&nbsp;{$lang.or}&nbsp;
					{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.checkout&amp;edit_step=`$smarty.request.from_step`" but_meta="cm-ajax cm-ajax-force" but_rev="checkout_steps,cart_items,checkout_totals" but_text=$lang.cancel but_role="tool"}
				{/if}
				</div>
			{/if}
			</form>
		</div>
	</div>
<!--step_two--></div>
{/if}

{if $cart.shipping_required == true}

{if $completed_steps.step_three == true}{assign var="complete" value=true}{assign var="_title" value=$lang.save}{else}{assign var="complete" value=false}{assign var="_title" value=$lang.next_step}{/if}
{if $edit_step == "step_three"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}

<div class="step-container{if $edit}-active{/if}" id="step_three">
	<h2 class="step-title{if $edit}-active{/if}">
		<span class="float-left">{if $profile_fields.B || $profile_fields.S}3{else}2{/if}.</span>

		{if $complete || $edit}
			<img src="{$images_dir}/icons/icon_step_{if $edit}open{else}close{/if}.gif" width="14" height="14" border="0" alt="" class="float-right" />
		{/if}

		{if $complete && !$edit}
			{include file="buttons/button.tpl" but_meta="cm-ajax float-right" but_href="`$index_script`?dispatch=checkout.checkout&amp;edit_step=step_three&amp;from_step=$edit_step" but_rev="checkout_steps" but_text=$lang.edit but_role="tool"}
		{/if}
		
		<a class="title{if !$edit} cm-ajax{/if}" {if !$edit}href="{$index_script}?dispatch=checkout.checkout&amp;edit_step=step_three&amp;from_step={$edit_step}" rev="checkout_steps,cart_items,checkout_totals"{/if}>{$lang.shipping_method}</a>
	</h2>

	<div id="step_three_body" class="step-body{if $edit}-active{/if} {if !$complete}hidden{/if}">
		<div>
			{if !$cart.shipping_failed}
				<form name="step_three_shipping_address" class="cm-ajax cm-ajax-force" action="{$index_script}" method="{if !$edit}get{else}post{/if}">
				<input type="hidden" name="update_step" value="step_three" />
				<input type="hidden" name="next_step" value="{if $smarty.request.from_step && $smarty.request.from_step != "step_three"}{$smarty.request.from_step}{else}step_four{/if}" />
				<input type="hidden" name="result_ids" value="checkout_steps,checkout_totals{if !$edit},cart_items{/if}" />

				{if $edit == true}
					{include file="views/checkout/components/shipping_rates.tpl" no_form=true display="radio"}	
				{else}
					{include file="views/checkout/components/shipping_rates.tpl" no_form=true display="show"}
				{/if}
				
				{if $edit}
					<div class="buttons-container">
					{include file="buttons/button.tpl" but_name="dispatch[checkout.update_steps]" but_text=$_title}
					{if $shipping_population && $smarty.request.from_step}
						&nbsp;{$lang.or}&nbsp;
						{include file="buttons/button.tpl" but_href="$index_script?dispatch=checkout.checkout&amp;edit_step=`$smarty.request.from_step`" but_meta="cm-ajax cm-ajax-force" but_rev="checkout_steps,cart_items,checkout_totals" but_text=$lang.cancel but_role="tool"}
					{/if}
					</div>
				{/if}
				</form>
			{else}
				<p class="error-text center">{$lang.text_no_shipping_methods}</p>
			{/if}
		</div>
	</div>
<!--step_three--></div>
{/if}

{if $completed_steps.step_four == true}{assign var="complete" value=true}{else}{assign var="complete" value=false}{/if}
{if $edit_step == "step_four"}{assign var="edit" value=true}{else}{assign var="edit" value=false}{/if}

<div class="step-container{if $edit}-active{/if}" id="step_four">
	<h2 class="step-title{if $edit}-active{/if}">
		<span class="float-left">{if $cart.shipping_required == true}{if $profile_fields.B || $profile_fields.S}4{else}3{/if}{elseif $profile_fields.B || $profile_fields.S}3{else}2{/if}.</span>
		{if $complete || $edit}
			<img src="{$images_dir}/icons/icon_step_{if $edit}open{else}close{/if}.gif" width="14" height="14" border="0" alt="" class="float-right" />
		{/if}
		
		<a class="title">{$lang.payment_method}</a>
	</h2>

	<div id="step_four_body" class="step-body{if $edit}-active{/if}{if !$edit} hidden{/if}">
		{* Payment methods form *}
			{include file="views/checkout/components/payment_methods.tpl" no_mainbox="Y"}
		{* /Payment methods form *}

		{if $cart|fn_allow_place_order}
			{include file="views/checkout/summary.tpl"}
		{/if}
	</div>
<!--step_four--></div>

<!--checkout_steps--></div>
