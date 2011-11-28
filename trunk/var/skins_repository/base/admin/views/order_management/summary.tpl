{* $Id: summary.tpl 7790 2009-08-05 10:16:39Z zeke $ *}

{capture name="mainbox"}

{include file="views/order_management/components/orders_header.tpl"}
{include file="views/profiles/components/profiles_info.tpl" user_data=$cart.user_data shipping_method=$cart.shipping mode="order_management" location="I"}

{if $payment_method.template}
	{include file="common_templates/subheader.tpl" title=$lang.payment_details}
{/if}

<form action="{$index_script}" method="post" name="om_summary" class="cm-form-highlight">

{* Payment methods form *}

{if $payment_method.template}
	{script src="js/cc_validator.js"}
	{include file="views/orders/components/payments/`$payment_method.template`" payment_id=$payment_method.payment_id skin_area="customer"}
{/if}

<div class="form-field">
	<label for="customer_notes">{$lang.text_customer_notes}:</label>
	<textarea class="input-textarea-long" name="customer_notes" id="customer_notes" cols="45" rows="8">{$cart.notes}</textarea>
</div>

<div class="select-field notify-customer">
	<input type="checkbox" name="notify_user" id="notify_user" value="Y" class="checkbox" />
	<label for="notify_user">{$lang.notify_customer}</label>
</div>

<div class="buttons-container buttons-bg center">
	{if $cart.order_id == ""}
		{assign var="_but_text" value=$lang.create}
		{assign var="but_text_" value=$lang.create_process_payment}
		{assign var="_title" value=$lang.create_new_order}
	{else}
		{assign var="_but_text" value=$lang.save}
		{assign var="but_text_" value=$lang.save_process_payment}
		{assign var="_title" value="`$lang.editing_order`:&nbsp;#`$cart.order_id`"}
	{/if}
	
	{include file="buttons/button.tpl" but_text=$_but_text but_name="dispatch[order_management.place_order.save]" but_role="big" but_meta="no-margin cm-skip-validation"}
	{include file="buttons/button.tpl" but_text=$but_text_ but_name="dispatch[order_management.place_order]" but_rev="om_summary" but_role="big" but_meta="button-left-margin"}
</div>

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools}
