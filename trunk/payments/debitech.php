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
// $Id: debitech.php 7760 2009-07-29 11:53:02Z zeke $
//

if (!defined('AREA') ) { die('Access denied'); }

if (defined('PAYMENT_NOTIFICATION')) {
	if ($mode == 'notify') {
		fn_order_placement_routines($_REQUEST['order_id']);

	} elseif ($mode == 'post') {
		$pp_response = array();
		$pp_response['order_status'] = ($_REQUEST['reply'] == 'A') ? 'P' : 'F';
		$pp_response['reason_text'] = $_REQUEST['error_text'];
		$pp_response['transaction_id'] = $_REQUEST['transaction_id'];

		if (fn_check_payment_script('debitech.php', $_REQUEST['order_id'])) {
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
		}
		echo "VerifyEasy_response:_OK";
		exit;
	}
} else {
	$testmode = (empty($processor_data['params']['test'])) ? "" : "<input type=\"hidden\" name =\"Test\" value=\"".$processor_data['params']['test']."\" />";
	$method = (!empty($processor_data['params']['test'])) ? "<input type=\"hidden\" name=\"method\" value=\"cc.nw\" />" : "<input type=\"hidden\" name=\"method\" value=\"cc.cekab\" />";
	$products_data = '';
	// Products
	if (!empty($order_info['items'])) {
		foreach ($order_info['items'] as $v) {
			$products_data .= $v['product_id'] . "||" . $v['product'] . "||" . $v['amount'] . "||" . (fn_format_price($v['subtotal'] - fn_external_discounts($v)) * 100) . "||";
		}
	}
	// Gift Certificates
	if (!empty($order_info['gift_certificates'])) {
		foreach ($order_info['gift_certificates'] as $v) {
			$v['amount'] = (!empty($v['extra']['exclude_from_calculate'])) ? 0 : $v['amount'];
			$products_data .= $v['gift_cert_id'] . "||" . $v['gift_cert_code'] . "||1||" . (($v['amount']) * 100) . "||";
		}
	}

	if (floatval($order_info['subtotal_discount'])) {
		$pr = fn_format_price($order_info['subtotal_discount']);
		$products_data .= "1||ORDER_DISCOUNT||1||-" . ($pr * 100) . "||";
	}

	$shipment = fn_order_shipping_cost($order_info) * 100;

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="https://secure.incab.se/verify/bin/{$processor_data['params']['shopname']}/index" name="process">
	<input type="hidden" name ="pageSet" value="{$processor_data['params']['pageset']}" />
	{$method}
	<input type="hidden" name ="uses3dsecure" value="{$processor_data['params']['3dsecure']}" />
	{$testmode}
	<input type="hidden" name ="data" value="$products_data" />
	<input type="hidden" name ="separator" value="||" />
	<input type="hidden" name ="currency" value="{$processor_data['params']['currency']}" />
	<input type="hidden" name ="shipment" value="{$shipment}" />
	<input type="hidden" name ="referenceNo" value="{$order_id}" />
	<input type="hidden" name ="orderNo" value="{$order_id}" />
	<input type="hidden" name ="billingFirstName" value="{$order_info['b_firstname']}" />
	<input type="hidden" name ="billingLastName" value="{$order_info['b_lastname']}" />
	<input type="hidden" name ="billingAddress" value="{$order_info['b_address']}" />
	<input type="hidden" name ="billingZipCode" value="{$order_info['b_zipcode']}">
	<input type="hidden" name ="billingCity" value="{$order_info['b_city']}">
	<input type="hidden" name ="billingCountry" value="{$order_info['b_country']}">
	<input type="hidden" name ="eMail" value="{$order_info['email']}">
EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'DebiTech server', $msg);
echo <<<EOT
	</form>
   <p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
exit;
}
?>
