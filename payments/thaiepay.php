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
// $Id: thaiepay.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

if (defined('PAYMENT_NOTIFICATION')) {

	$pp_response = array();
	$pp_response['order_status'] = ($_REQUEST['completed'] == 'yes') ? 'P' : 'O';
	$pp_response['reason_text'] = fn_get_lang_var('order_id') . '-' . $_REQUEST['refno'];
	$pp_response['transaction_id'] = '';
	$order_id = $_REQUEST['refno'];

	if (fn_check_payment_script('thaiepay.php', $order_id)) {
		fn_finish_payment($order_id, $pp_response, false);
		fn_order_placement_routines($order_id);
	}
} else {
	$http_location = Registry::get('config.http_location');
	$lang_code = CART_LANGUAGE;
echo <<<EOT
<html>
<body onLoad="document.process.submit();">
<form method="post" action="http://www.thaiepay.com/epaylink/payment.aspx" name="process">
	<input type="hidden" name="refno" value="{$order_id}">
	<input type="hidden" name="merchantid" value="{$processor_data['params']['merchantid']}">
	<input type="hidden" name="customeremail" value="{$order_info['email']}">
	<input type="hidden" name="productdetail" value="{$processor_data['params']['details']}">
	<input type="hidden" name="total" value="{$order_info['total']}">
	<input type="hidden" name="cc" value="{$processor_data['params']['currency']}">
	<input type="hidden" name="lang" value="{$lang_code}">
	<input type="hidden" name="postbackurl" value="{$http_location}/{$index_script}?dispatch=payment_notification.notify&payment=thaiepay&order_id={$order_id}">
EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'thaiepay.com', $msg);
echo <<<EOT
	</form>
	<div align=center>{$msg}</div>
 </body>
</html>
EOT;

}
exit;
?>
