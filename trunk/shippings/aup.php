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
// $Id: aup.php 7774 2009-07-31 09:47:01Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

function fn_get_aup_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination)
{
	if ($shipping_settings['aup_enabled'] != 'Y') {
		return false;
	}

	$request = array (
		'Pickup_Postcode' => $origination['zipcode'],
		'Destination_Postcode' => $location['zipcode'],
		'Country' => $location['country'],
		'Weight' => ($weight_data['full_pounds'] * 453.6),
		'Length' => ($shipping_settings['aup']['length'] * 10),
		'Width' => ($shipping_settings['aup']['width'] * 10),
		'Height' => ($shipping_settings['aup']['height'] * 10),
		'Service_type' => $code,
		'Quantity' => 1,
	);
	list ($header, $result) = fn_http_request('GET', 'http://drc.edeliver.com.au/ratecalc.asp', $request);

	if (!empty($result)) {
		$result = explode("\n", $result);
		if (preg_match("/charge=([\d\.]+)/i", $result[0], $matches)) {
			if (!empty($matches[1])) {
				return array('cost' => trim($matches[1]));
			} else {
				if (defined('SHIPPING_DEBUG') && preg_match("/err_msg=([\w ]*)/i", $result[2], $matches)) {
					return array('error' => $matches[1]);
				}
			}
		}
	}

	return false;
}

?>