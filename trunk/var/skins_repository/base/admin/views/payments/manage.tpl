{* $Id: manage.tpl 7533 2009-05-26 16:28:25Z zeke $ *}

{script src="js/tabs.js"}
{script src="js/picker.js"}

{capture name="mainbox"}

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_switch_processor(payment_id, processor_id)
{
	$('#tab_conf_' + payment_id).toggleBy(processor_id == 0);
	if (processor_id != 0) {
		$('#tab_conf_' + payment_id + ' a').attr('href', index_script + '?dispatch=payments.processor&payment_id=' + payment_id + '&processor_id=' + processor_id);
		$('#content_tab_conf_' + payment_id).remove();
		$('#elm_payment_tpl_' + payment_id).attr('disabled', 'disabled');
	} else {
		$('#elm_payment_tpl_' + payment_id).removeAttr('disabled');
	}
}
//]]>
</script>
{/literal}

<div class="items-container" id="payments_list">
{foreach from=$payments item=payment name="pf"}

	{include file="common_templates/object_group.tpl" id=$payment.payment_id text=$payment.payment status=$payment.status href="`$index_script`?dispatch=payments.update&amp;payment_id=`$payment.payment_id`" object_id_name="payment_id" table="payments" href_delete="`$index_script`?dispatch=payments.delete&amp;payment_id=`$payment.payment_id`" rev_delete="payments_list"  header_text="`$lang.editing_payment`: `$payment.payment`"}
	
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--payments_list--></div>

<div class="buttons-container">
	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/payments/update.tpl" mode="add" payment=""}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_payments" text=$lang.add_new_payments content=$smarty.capture.add_new_picker link_text=$lang.add_payment act="general"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_payments" text=$lang.add_new_payments link_text=$lang.add_payment act="general"}
</div>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.payment_methods content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
