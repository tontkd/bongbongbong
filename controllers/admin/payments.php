<?php
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/


//
// $Id: payments.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

fn_trusted_vars("processor_params");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//
	// Update payment method
	//
	if ($mode == 'update') {

		fn_update_payment($_REQUEST['payment_data'], $_REQUEST['payment_id']);
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=payments.manage");
}

// If any method is selected - show it's settings
if ($mode == 'processor') {
	$processor_data = fn_get_processor_data($_REQUEST['payment_id']);

	// We're selecting new processor
	if (!empty($_REQUEST['processor_id']) && $processor_data['processor_id'] != $_REQUEST['processor_id']) {
		$processor_data = db_get_row("SELECT * FROM ?:payment_processors WHERE processor_id = ?i", $_REQUEST['processor_id']);
		$processor_data['params'] = array();
		$processor_data['currencies'] = (!empty($processor_data['currencies'])) ? explode(',', $processor_data['currencies']) : array();
	}

	$view->assign('processor_template', $processor_data['admin_template']);
	$view->assign('processor_params', $processor_data['params']);
	$view->assign('processor_name', $processor_data['processor']);
	$view->assign('callback', $processor_data['callback']);
	$view->assign('payment_id', $_REQUEST['payment_id']);

// Show methods list
} elseif ($mode == 'manage') {

	$payments = db_get_array("SELECT ?:payments.*, ?:payment_descriptions.* FROM ?:payments LEFT JOIN ?:payment_descriptions ON ?:payment_descriptions.payment_id = ?:payments.payment_id AND ?:payment_descriptions.lang_code = ?s ORDER BY ?:payments.position", DESCR_SL);

	$view->assign('memberships', fn_get_memberships('C', DESCR_SL));
	$view->assign('payments', $payments);
	$view->assign('templates', fn_get_payment_templates());

} elseif ($mode == 'update') {
	$payment = fn_get_payment_method_data($_REQUEST['payment_id'], DESCR_SL);
	$payment['icon'] = fn_get_image_pairs($payment['payment_id'], 'payment', 'M');

	$view->assign('memberships', fn_get_memberships('C', DESCR_SL));
	$view->assign('payment', $payment);
	$view->assign('templates', fn_get_payment_templates());

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['payment_id'])) {
		db_query("DELETE FROM ?:payments WHERE payment_id = ?i", $_REQUEST['payment_id']);
		db_query("DELETE FROM ?:payment_descriptions WHERE payment_id = ?i", $_REQUEST['payment_id']);
		$count = db_get_field("SELECT COUNT(*) FROM ?:payments");
		if (empty($count)) {
			$view->display('views/payments/manage.tpl');
		}
	}
	exit;
}

$payment_processors = db_get_array("SELECT processor_id, processor, type FROM ?:payment_processors ORDER BY processor");
$view->assign('payment_processors', $payment_processors);

function fn_get_payment_templates()
{
	$templates = fn_get_dir_contents(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/customer/views/orders/components/payments/', false, true, '.tpl');

	if (is_array($templates)) {
		foreach ($templates as $k => $v) {
			$templates[$k] = $v;
		}
	}

	return $templates;
}

function fn_update_payment($payment_data, $payment_id, $lang_code = DESCR_SL)
{
	if (!empty($payment_data['processor_id'])) {
		$payment_data['template'] = db_get_field("SELECT processor_template FROM ?:payment_processors WHERE processor_id = ?i", $payment_data['processor_id']);
	}

	$payment_data['localization'] = !empty($payment_data['localization']) ? fn_implode_localizations($payment_data['localization']) : '';

	if (!empty($payment_id)) {
		db_query("UPDATE ?:payments SET ?u WHERE payment_id = ?i", $payment_data, $payment_id);
		db_query("UPDATE ?:payment_descriptions SET ?u WHERE payment_id = ?i AND lang_code = ?s", $payment_data, $payment_id, $lang_code);
	} else {
		$payment_data['payment_id'] = $payment_id = db_query("INSERT INTO ?:payments ?e", $payment_data);
		foreach ((array)Registry::get('languages') as $payment_data['lang_code'] => $_v) {
			db_query("INSERT INTO ?:payment_descriptions ?e", $payment_data);
		}
	}

	fn_attach_image_pairs('payment_image', 'payment', $payment_id);

	// Update payment processor settings
	if (!empty($payment_data['processor_params'])) {
		db_query("UPDATE ?:payments SET params = ?s WHERE payment_id = ?i", serialize($payment_data['processor_params']), $payment_id);
	}

	return $payment_id;
}

?>
