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
// $Id: epassporte.php 7812 2009-08-13 08:27:59Z zeke $
//
if (!defined('AREA') ) { die('Access denied'); }

$tvp_responsess = array(
	'YMYOK' => 'All fields checked were the identical, transaction verified',
	'NMYMISSINGCREDITID' => ' Missing credit index',
	'NMYMISSINGDEBITID' => 'Missing debit index',
	'NMYINVALIDDEBITID' => 'Invalid debit index',
	'NMYINVALIDAMOUNT' => 'Invalid total amount',
	'NMYALREADYVERIFIED' => 'Transaction already verified',
	'NMYALREADYREJECTED' => 'Transaction already rejected',
	'NMYINVALIDMSG' => 'Optional message too long or invalid',
	'NMYINPROGRESS' => 'Transaction is in progress',
	'NMYSYSNOTAVAIL' => 'System not available, try again later',
	'NMYINITERROR' => 'Internal error'
);

if (defined('PAYMENT_NOTIFICATION')) {

	if ($mode == 'notify') {

		$order_info = fn_get_order_info($_REQUEST['order_id']);
		if ($order_info['status'] == 'O') {
			$pp_response = array();
			$pp_response['order_status'] = 'F';
			$pp_response['reason_text'] = 'No response recieved';
			fn_finish_payment($_REQUEST['order_id'], $pp_response, false);
		}

		fn_order_placement_routines($_REQUEST['order_id']);

	} elseif ($mode == 'tvp') {
		$msg = fn_get_lang_var('epassporte_msg');

		$pp_response = array();
		$pp_response['order_status'] = (substr($_REQUEST['ans'], 0, 1) == 'Y') ? 'P' : 'F';
		$pp_response['reason_text'] = fn_get_lang_var('order_id') . '-' . $_REQUEST['order_id'];
		$pp_response['transaction_id'] = $_REQUEST['credit_trans_idx'];

		if (fn_check_payment_script('epassporte.php', $_REQUEST['order_id'])) {
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
		}

		echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="https://www.epassporte.com/secure/eppurchaseverify.cgi" name="process">
<input type="hidden" name="credit_trans_idx" value="{$credit_trans_idx}">
<input type="hidden" name="debit_trans_idx" value="{$debit_trans_idx}">
<input type="hidden" name="total_amount" value="{$total_amount}">
<input type="hidden" name="action" value="verify">
<input type="hidden" name="msg" value="{$msg}">
</form>
</body>
</html>
EOT;
exit;
	}

} else {

	$product_name = '';
	// Products
	if (!empty($order_info['items'])) {
		foreach ($order_info['items'] as $v) {
			$product_name = $product_name . $v['product'] . ";  ";
		}
	}
	// Gift Certificates
	if (!empty($order_info['gift_certificates'])) {
		foreach ($order_info['gift_certificates'] as $v) {
			$product_name = $product_name . $v['gift_cert_code'] . ";  ";
		}
	}
	$product_name = substr($product_name, 0, 128);

	$tax_amount = (!empty($order_info['tax_subtotal'])) ? fn_format_price($order_info['tax_subtotal']) : 0;
	$shipping_amount = fn_order_shipping_cost($order_info);

	$current_location = Registry::get('config.current_location');

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="https://www.epassporte.com/secure/eppurchase.cgi" name="process">
<input type="hidden" name="acct_num" value="{$processor_data['params']['acct_num']}">
<input type="hidden" name="pi_code" value="{$processor_data['params']['pi_code']}">
<input type="hidden" name="amount" value="{$order_info['subtotal']}">

<input type="hidden" name="return_url" value="$current_location/$index_script?dispatch=payment_notification.notify&payment=epassporte&order_id=$order_id">
<input type="hidden" name="response_post" value="$current_location/$index_script?dispatch=payment_notification.tvp&payment=epassporte&order_id=$order_id">
<input type="hidden" name="product_name" value="{$product_name}">
<input type="hidden" name="tax_amount" value="{$tax_amount}">
<input type="hidden" name="shipping_amount" value="{$shipping_amount}">
EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'ePpayment server', $msg);
echo <<<EOT
	</form>
	<p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
}
exit;
?>
