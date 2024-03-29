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
// $Id: verus.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

$post_address = "https://va.eftsecure.net/cgi-bin/eftBankcard.dll?transaction";

$post = array();
$post[] = "M_id=" . $processor_data["params"]["merchant_id"];
$post[] = "M_key=" . $processor_data["params"]["merchant_key"];
$post[] = "T_code=01";
$post[] = "T_ordernum=" . (($order_info['repaid']) ? ($order_id . $order_info['repaid']) : $order_id);
$post[] = "T_amt=" . $order_info["total"];

$post[] = "C_name=" . $order_info['payment_info']['cardholder_name'];
$post[] = "C_cardnumber=" . $order_info['payment_info']['card_number'];
$post[] = "C_exp=" . $order_info['payment_info']['expiry_month'] . '/' . $order_info['payment_info']['expiry_year'];
$post[] = "C_address=" . $order_info["b_address"];
$post[] = "C_city=" . $order_info["b_city"];
if (!empty($order_info["b_state"])) {
	$post[] = "C_state=" . $order_info['b_state_descr'];
}
$post[] = "C_country=" . $order_info['b_country_descr'];
$post[] = "C_zip=" . $order_info["b_zipcode"];
$post[] = "C_cvv=" . $order_info['payment_info']['cvv2'];

// Post a request and analyse the response
list($a, $return) = fn_https_request("POST", $post_address, $post);

$pp_response["order_status"] = (substr($return, 1, 1) == 'A') ? 'P' : 'F';
$pp_response["reason_text"] = substr($return, 8, 32);
$pp_response["reason_text"] .= "<br>CVV Indicator=" . substr($return, 42, 1);
$pp_response["reason_text"] .= "<br>AVS Indicator=" . substr($return, 43, 1);
$pp_response["reason_text"] .= "<br>Risk Indicator=" . substr($return, 44, 2);
$pp_response["transaction_id"] = substr($return, 46, 10);

?>
