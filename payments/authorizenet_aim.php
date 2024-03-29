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
// $Id: authorizenet_aim.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$transaction_types = array(
	"P" => "AUTH_CAPTURE",
	"A" => "AUTH_ONLY",
	"C" => "CAPTURE_ONLY",
	"R" => "CREDIT",
	"I" => "PRIOR_AUTH_CAPTURE"
);

$trans_type = $processor_data['params']['transaction_type'];
$__version = '3.1';
$pp_data = array();


if ($trans_type == 'R') {
	$pp_data[] = "x_trans_id=" . $order_info['payment_info']['transaction_id'];
}


$processor_error = array(); // !!!FIXME: should be international descriptions

$processor_error['avs'] = array(
	"A" => "Address (Street) matches, ZIP does not",
	"E" => "AVS error",
	"N" => "No Match on Address (Street) or ZIP",
	"P" => "AVS not applicable for this transaction",
	"R" => "Retry. System unavailable or timed out",
	"S" => "Service not supported by issuer",
	"U" => "Address information is unavailable",
	"W" => "9 digit ZIP matches, Address (Street) does not",
	"X" => "Exact AVS Match",
	"Y" => "Address (Street) and 5 digit ZIP match",
	"Z" => "5 digit ZIP matches, Address (Street) does not"
);

$processor_error['cvv'] = array(
	"M" => "Match",
	"N" => "No Match",
	"P" => "Not Processed",
	"S" => "Should have been present",
	"U" => "Issuer unable to process request"
);

$processor_error['cavv'] = array(
	"0" => "CAVV not validated because erroneous data was submitted",
	"1" => "CAVV failed validation",
	"2" => "CAVV passed validation",
	"3" => "CAVV validation could not be performed; issuer attempt incomplete",
	"4" => "CAVV validation could not be performed; issuer system error",
	"7" => "CAVV attempt - failed validation - issuer available (US issued card/non-US acquirer)",
	"8" => "CAVV attempt - passed validation - issuer available (US issued card/non-US acquirer)",
	"9" => "CAVV attempt - failed validation - issuer unavailable (US issued card/non-US acquirer)",
	"A" => "CAVV attempt - passed validation - issuer unavailable (US issued card/non-US acquirer)",
	"B" => "CAVV passed validation, information only, no liability shift"
);

$processor_error['order_status'] = array(
	"1" => "P",
	"2" => "D",
	"3" => "F",
	"4" => "O" // Transaction is held for review... I think open order status is good for such situation
);

// Gateway parameters
$pp_data[] = "x_login=" . $processor_data['params']['login'];
$pp_data[] = "x_tran_key=" . $processor_data['params']['transaction_key'];
$pp_data[] = "x_version=$__version";
$pp_data[] = "x_test_request=" . (($processor_data['params']['mode'] == 'test' || $processor_data['params']['mode'] == 'developer') ? 'TRUE' : 'FALSE');

$pp_data[] = "x_delim_data=TRUE";
$pp_data[] = "x_delim_char=,";
$pp_data[] = "x_encap_char=|";

// Billing address
$pp_data[] = "x_first_name=" . $order_info['b_firstname']; // !!!FIXME: Shoud have separate first/lastnames for shipping/billing
$pp_data[] = "x_last_name=" . $order_info['b_lastname'];
$pp_data[] = "x_address=" . $order_info['b_address'];
$pp_data[] = "x_city=" . $order_info['b_city'];
$pp_data[] = "x_zip=" . $order_info['b_zipcode'];
$pp_data[] = "x_state=" . $order_info['b_state'];
$pp_data[] = "x_country=" . $order_info['b_country'];
$pp_data[] = "x_company=" . $order_info['company'];

// Shipping address
$pp_data[] = "x_ship_to_first_name=" . $order_info['firstname']; // !!!FIXME: Shoud have separate first/lastnames for shipping/billing
$pp_data[] = "x_ship_to_last_name=" . $order_info['lastname'];
$pp_data[] = "x_ship_to_address=" . $order_info['s_address'];
$pp_data[] = "x_ship_to_company=" . $order_info['company'];
$pp_data[] = "x_ship_to_city=" . $order_info['s_city'];
$pp_data[] = "x_ship_to_state=" . $order_info['s_state'];
$pp_data[] = "x_ship_to_zip=" . $order_info['s_zipcode'];
$pp_data[] = "x_ship_to_country=" . $order_info['s_country'];


// Customer information
$pp_data[] = "x_phone=" . $order_info['phone'];
$pp_data[] = "x_fax=" . $order_info['fax'];
$pp_data[] = "x_cust_id=" . $_SESSION['auth']['user_id']; // !!!FIXME (what about not registered?)
$pp_data[] = "x_customer_ip=" . $_SERVER['REMOTE_ADDR'];
$pp_data[] = "x_email=" . $order_info['email'];
$pp_data[] = "x_email_customer=FALSE";

// Merchant information
$pp_data[] = "x_merchant_email=" .Registry::get('settings.Company.company_orders_department');
$pp_data[] = "x_invoice_num=" . $processor_data['params']['order_prefix'].$order_id. (($order_info['repaid']) ? "_$order_info[repaid]" : '');
$pp_data[] = "x_amount=" .fn_format_price($order_info['total']);
$pp_data[] = "x_currency_code=" . $processor_data['params']['currency'];
$pp_data[] = "x_method=CC";
$pp_data[] = "x_recurring_billing=NO";
$pp_data[] = "x_type=" . $transaction_types[$trans_type];

// CC information
$pp_data[] = "x_card_num=" . $order_info['payment_info']['card_number'];
$pp_data[] = "x_exp_date=" . $order_info['payment_info']['expiry_month'] . '/' . $order_info['payment_info']['expiry_year'];
$pp_data[] = "x_card_code=" . $order_info['payment_info']['cvv2'];

// Cart totals
$pp_data[] = "x_relay_response=FALSE";
$pp_data[] = "x_tax=" . fn_format_price($order_info['tax_subtotal']);
$pp_data[] = "x_freight=" . fn_format_price($order_info['shipping_cost']);


$payment_url = ($processor_data['params']['mode'] == 'developer') ? "https://test.authorize.net/gateway/transact.dll" : "https://secure.authorize.net:443/gateway/transact.dll";

$__response = fn_https_request('POST', $payment_url, $pp_data);

// TESTING: failed response
//$__response[1] = "|3|,|2|,|33|,|(TESTMODE) A valid referenced transaction ID is required.|,|000000|,|P|,|0|,|TO-40|,||,|78.00|,|CC|,|prior_auth_capture|,|1|,|admin|,|admin|,|Company|,|admin|,|admin|,|MI|,|admin|,|US|,|admin|,||,|customer@192.168.0.33|,|admin|,|admin|,|Company|,|admin|,|admin|,|MI|,|admin|,|US|,|0.0000|,||,||,||,||,|BBF4A22888BA05DD5B5E738F451680E5|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||";

// TESTING: approved response
//$__response[1] = "|1|,|1|,|1|,|(TESTMODE) This transaction has been approved.|,|000000|,|P|,|0|,|TO-69|,||,|999.00|,|CC|,|auth_capture|,|1|,|admin|,|admin|,|Company|,|admin|,|admin|,|MI|,|admin|,|US|,|admin|,||,|aa@bb.cc|,|admin|,|admin|,|Company|,|admin|,|admin|,|MI|,|admin|,|US|,|0.0000|,||,|0.0000|,||,||,|6C4073133067D5176BE6F9F389CCE229|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||";

// Gateway answered
if (is_array($__response) && !empty($__response[1])) {
	$response_data = explode('|,|', '|,' . $__response[1] . ',|');

// Gateway didn't answer - set some kind of error ;)
} else {
	$response_data = array();
	$response_data[1] = 3; // Transaction failed
	$response_data[4] = '';
}

$pp_response = array();
if (!empty($processor_error['order_status'][$response_data[1]])) {
	$pp_response['order_status'] = $processor_error['order_status'][$response_data[1]];
} else {
	$pp_response['order_status'] = 'F';
	$response_data[4] = 'Processor does not reponse';
}

$pp_response['reason_text'] = $response_data[4];
$pp_response['transaction_id'] = (!empty($response_data[7])) ? $response_data[7] : '';

$pp_response['descr_avs'] = (!empty($response_data[6])) ? $processor_error['avs'][$response_data[6]] : '';
$pp_response['descr_cvv']  = (!empty($response_data[39])) ? $processor_error['cvv'][$response_data[39]] : '';
$pp_response['descr_cavv'] = (!empty($response_data[40])) ? $processor_error['cavv'][$response_data[40]] : '';

?>
