<?php
/***************************************************************************
*                                                                          *
*    Copyright (c) 2009 Simbirsk Technologies Ltd. All rights reserved.    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


//
// $Id: secpay.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$error_message = array(
	"N" => "Transaction not authorised. Failure message text available to merchant",
	"C" => "Communication problem. Trying again later may well work",
	"P:A" => "Pre-bank checks. Amount not supplied or invalid",
	"P:X" => "Pre-bank checks. Not all mandatory parameters supplied",
	"P:P" => "Pre-bank checks. Same payment presented twice",
	"P:S" => "Pre-bank checks. Start date invalid",
	"P:E" => "Pre-bank checks. Expiry date invalid",
	"P:I" => "Pre-bank checks. Issue number invalid",
	"P:C" => "Pre-bank checks. Card number fails LUHN check",
	"P:T" => "Pre-bank checks. Card type invalid - i.e. does not match card number prefix",
	"P:N" => "Pre-bank checks. Customer name not supplied",
	"P:M" => "Pre-bank checks. Merchant does not exist or not registered yet",
	"P:B" => "Pre-bank checks. Merchant account for card type does not exist",
	"P:D" => "Pre-bank checks. Merchant account for this currency does not exist",
	"P:V" => "Pre-bank checks. CV2 security code mandatory and not supplied / invalid",
	"P:R" => "Pre-bank checks. Transaction timed out awaiting a virtual circuit. Merchant may not have enough virtual circuits for the volume of business.",
	"P:#" => "Pre-bank checks. No MD5 hash / token key set up against account"
);

$current_location = Registry::get('config.current_location');

if (defined('PAYMENT_NOTIFICATION')) {
	if ($mode == 'process') {

		$payment_id = db_get_field("SELECT payment_id FROM ?:orders WHERE order_id = ?i", $_REQUEST['order_id']);
		$processor_data = fn_get_payment_method_data($payment_id);
		$order_info = fn_get_order_info($_REQUEST['order_id']);

		if (!empty($processor_data["params"]["password"])) {
			$md5_hash = md5("trans_id=" . $_REQUEST['trans_id'] . "&amount=" . $order_info['total'] . "&callback=". "$current_location/$index_script?dispatch=payment_notification&payment=secpay.notify&order_id=$_REQUEST[order_id]" . "&" . $processor_data["params"]["password"]."&csid=" . Session::get_id());
		} else {
			$md5_hash = $_REQUEST['hash'];
		}

		$pp_response = array();
		if ($code == "A" && $md5_hash == $_REQUEST['hash']) {
			$pp_response['order_status'] = 'P';
			$pp_response['reason_text'] ="AuthCode: " . $_REQUEST['auth_code'];
			$pp_response['transaction_id'] = $_REQUEST['trans_id'];
		} else {
			$text = '';
			if ($md5_hash != $_REQUEST['hash']) {
				$text = "MD5 hash is wrong; ";

			} elseif (isset($error_message[$_REQUEST['code']])) {
				$text = $error_message[$_REQUEST['code']];

				if (!empty($_REQUEST['message'])) {
					$text .= " ($_REQUEST[message])";
				}

				if (!empty($_REQUEST['resp_code'])) {
					$text .= "; RespCode: $_REQUEST[resp_code]";
				}
			}
			$pp_response['order_status'] = 'F';
			$pp_response['reason_text'] = "Declined: " . $text;
			$pp_response['transaction_id'] = $_REQUEST['trans_id'];
		}

		if (!empty($_REQUEST['test_status']) && $_REQUEST['test_status'] != 'live') {
			$pp_response['reason_text'] .= "; Test status: ". $_REQUEST['test_status'];
		}

		fn_finish_payment($_REQUEST['order_id'], $pp_response, false);

		echo "<html><body onLoad=\"javascript: self.location='"."$current_location/$index_script?dispatch=payment_notification.notify&payment=secpay&order_id=$_REQUEST[order_id]"."'\"></body></html>";
		exit;

	} elseif ($mode == 'notify') {
		fn_order_placement_routines($_REQUEST['order_id']);
	}

} else {
	$_order_id = ($order_info['repaid']) ? ($order_id .'_'. $order_info['repaid']) : $order_id;
	$md5_hash = (!empty($processor_data["params"]["password"])) ? md5($processor_data['params']['order_prefix'] . $_order_id . $order_info['total'] . $processor_data["params"]["password"]) : '';
	$msg = fn_get_lang_var('text_cc_processor_connection');
	$msg = str_replace('[processor]', 'SECPay Server', $msg);
	$s_id = Session::get_id();

echo <<<EOT
<html>
 <body onLoad="document.process.submit();">
  <form action="https://www.secpay.com/java-bin/ValCard" method="POST" name="process">
	<input type="hidden" name="merchant" value="{$processor_data['params']['merchant_id']}">
	<input type="hidden" name="trans_id" value="{$processor_data['params']['order_prefix']}{$_order_id}">
	<input type="hidden" name="amount" value="{$order_info['total']}">
	<input type="hidden" name="callback" value="{$current_location}/{$index_script}?dispatch=payment_notification.process&payment=secpay&order_id={$order_id}&csid=$s_id">
	<input type="hidden" name="currency" value="{$processor_data['params']['currency']}">
	<input type="hidden" name="options" value="test_status={$processor_data['params']['mode']},cb_post=true,dups=false,md_flds=trans_id:amount:callback">
	<input type="hidden" name="deferred" value="{$processor_data['params']['deferred']}">
	<input type="hidden" name="mail_subject" value="{$processor_data['params']['mail_subject']}">
	<input type="hidden" name="mail_message" value="{$processor_data['params']['mail_message']}">

EOT;
if ($md5_hash) {
	echo "<input type=\"hidden\" name=\"digest\" value=\"$md5_hash\">";
}
echo <<<EOT
	<input type="hidden" name="bill_name" value="{$order_info['firstname']} {$order_info['lastname']}">
	<input type="hidden" name="bill_company" value="{$order_info['company']}">
	<input type="hidden" name="bill_addr_1" value="{$order_info['b_address']}">
	<input type="hidden" name="bill_addr_2" value="{$order_info['b_address_2']}">
	<input type="hidden" name="bill_city" value="{$order_info['b_city']}">
	<input type="hidden" name="bill_state" value="{$order_info['b_state_descr']}">
	<input type="hidden" name="bill_country" value="{$order_info['b_country_descr']}">
	<input type="hidden" name="bill_post_code" value="{$order_info['b_zipcode']}">
	<input type="hidden" name="bill_tel" value="{$order_info['phone']}">
	<input type="hidden" name="bill_email" value="{$order_info['email']}">
	<input type="hidden" name="bill_url" value="{$order_info['url']}">

	<input type="hidden" name="ship_name" value="{$order_info['firstname']} {$order_info['lastname']}">
	<input type="hidden" name="ship_company" value="{$order_info['company']}">
	<input type="hidden" name="ship_addr_1" value="{$order_info['s_address']}">
	<input type="hidden" name="ship_addr_2" value="{$order_info['s_address_2']}">
	<input type="hidden" name="ship_city" value="{$order_info['s_city']}">
	<input type="hidden" name="ship_state" value="{$order_info['s_state_descr']}">
	<input type="hidden" name="ship_country" value="{$order_info['s_country_descr']}">
	<input type="hidden" name="ship_post_code" value="{$order_info['s_zipcode']}">
	<input type="hidden" name="ship_tel" value="{$order_info['phone']}">
	<input type="hidden" name="ship_email" value="{$order_info['email']}">
	<input type="hidden" name="ship_url" value="{$order_info['url']}">
  </form>
  <p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
exit;
}
?>
