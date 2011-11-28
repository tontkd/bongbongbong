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
// $Id: westpac.php 7760 2009-07-29 11:53:02Z zeke $
//
if (!defined('AREA') ) { die('Access denied'); }

if (defined('PAYMENT_NOTIFICATION')) {

	if ($mode == 'process') {
		fn_order_placement_routines($_REQUEST['order_id']);

	} elseif ($mode == 'result') {

		if (!empty($_REQUEST['bank_reference'])) {
			$pp_response["order_status"] = 'P';
			$pp_response["reason_text"] = "Authorization code: " . $_REQUEST['bank_reference'];
		} else {
			$pp_response["order_status"] = 'F';
		}

		$pp_response['transaction_id'] = $_REQUEST['payment_number'];

		if (fn_check_payment_script('westpac.php', $_REQUEST['order_id'])) {
			fn_finish_payment($_REQUEST['order_id'], $pp_response); // Force user notification
		}
		exit;
	}

} else {

	$post_address = ($processor_data['params']['mode'] == 'test') ? "https://verifytransact.webadvantage.com.au/host/cgi-bin/test_payment.pl" : "https://transact.webadvantage.com.au/host/cgi-bin/make_payment.pl";
	$pp_merchant = ($processor_data['params']['mode'] == 'test') ? "demonstration" : $processor_data['params']['merchant_id'];
	$pp_return = Registry::get('config.current_location') . "/$index_script?dispatch=payment_notification.process&payment=westpac&order_id=$order_id";
	$pp_reply = Registry::get('config.current_location')  . "$index_script?dispatch=payment_notification.result&payment=westpac&order_id=$order_id&bank_reference=&payment_number=";
	$_order_id = ($order_info['repaid']) ? ($order_id . '_' . $order_info['repaid']) : $order_id;

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="$post_address" name="process">
	<input type="hidden" name="vendor_name" value="{$pp_merchant}">
	<input type="hidden" name="payment_alert" value="{$processor_data['params']['merchant_email']}">

EOT;
// Products
if (!empty($order_info['items'])) {
	foreach ($order_info['items'] as $k => $v) {
		if (!empty($v['product_options'])) {
			$opts = '';
			foreach ($v['product_options'] as $key => $val) {
				$opts .= "$val[option_name]:$val[variant_name]; ";
			}
			$v['product'] .= ' ('.$opts.')';
		}
		$v['one_product_price'] = fn_format_price(($v['subtotal'] - fn_external_discounts($v)) / $v['amount']);
echo <<<EOT
	<input type="hidden" name="{$v['product']} " value="{$v['amount']},{$v['one_product_price']}">

EOT;
	}
}
// Gift Certificates
if (!empty($order_info['gift_certificates'])) {
	foreach ($order_info['gift_certificates'] as $v) {
		$v['amount'] = (!empty($v['extra']['exclude_from_calculate'])) ? 0 : $v['amount'];
echo <<<EOT
	<input type="hidden" name="{$v['gift_cert_code']} " value="1,{$v['amount']}">

EOT;
	}
}
// Payment surcharge
if (floatval($order_info['payment_surcharge'])) {
echo <<<EOT
	<input type="hidden" name="Payment surcharge" value="{$order_info['payment_surcharge']}">
EOT;
}


if (floatval($order_info['subtotal_discount'])) {
	$desc = fn_get_lang_var('order_discount');
	$pr = fn_format_price($order_info['subtotal_discount']);
echo <<<EOT
	<input type="hidden" name="{$desc}" value="-{$pr}">

EOT;
}

// Shipping
if ($sh = fn_order_shipping_cost($order_info)) {
echo <<<EOT
	<input type="hidden" name="Shipping cost" value="{$sh}">

EOT;
}
echo <<<EOT
	<input type="hidden" name="payment_reference" value="{$_order_id}">
	<input type="hidden" name="receipt_address" value="<<{$order_info['email']}>>">
	<input type="hidden" name="return_link_url" value="{$pp_return}">
	<input type="hidden" name="reply_link_url" value="{$pp_reply}">
	<input type=hidden name="return_link_text" value="Return to Home Page">

EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'Westpac server', $msg);
echo <<<EOT
	</form>
   <p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
exit;
}
?>
