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
// $Id: products.post.php 7815 2009-08-13 11:15:35Z zeke $

if ( !defined('AREA') ) { die('Access denied'); }

if  ($mode == 'configuration_group') {

	$product_configurator_group = db_get_row("SELECT ?:conf_groups.group_id, ?:conf_group_descriptions.configurator_group_name, ?:conf_group_descriptions.full_description, ?:conf_groups.configurator_group_type, ?:conf_product_groups.position, ?:conf_product_groups.default_product_ids, ?:conf_product_groups.required FROM ?:conf_groups LEFT JOIN ?:conf_group_descriptions ON ?:conf_group_descriptions.group_id = ?:conf_groups.group_id LEFT JOIN ?:conf_product_groups ON ?:conf_product_groups.group_id = ?:conf_groups.group_id  WHERE ?:conf_groups.status = 'A' AND ?:conf_group_descriptions.lang_code = ?s AND ?:conf_groups.step_id = ?i AND ?:conf_groups.group_id = ?i", CART_LANGUAGE, $_REQUEST['step_id'], $_REQUEST['group_id']);

	$product_configurator_group['main_pair'] = fn_get_image_pairs($_REQUEST['group_id'], 'conf_group', 'M');

	$view->assign('product_configurator_group', $product_configurator_group);
	$view->assign('group_id', $_REQUEST['group_id']);
	$view->display('addons/product_configurator/views/products/components/group_info.tpl');
	exit;

} elseif  ($mode == 'configuration_product') {
	if (!empty($_REQUEST['product_id'])) {
		$product = fn_get_product_data($_REQUEST['product_id'], $auth, CART_LANGUAGE);
		$view->assign('group_id', $_REQUEST['group_id']);
		$view->assign('product', $product);
		$view->display('addons/product_configurator/views/products/components/configuration_product.tpl');
		exit;
	}
} elseif ($mode == 'view') {

	$product = $view->get_var('product');
	$product['configuration_mode'] = true;

	if (!empty($product) && $product['product_type'] == 'C') {
		if (!empty($_REQUEST['edit_configuration'])) {
			$cart = & $_SESSION['cart'];
			$view->assign('edit_configuration' , $_REQUEST['edit_configuration']);
			$view->assign('cart_item', $cart['products'][$_REQUEST['edit_configuration']]);
			$selected_configuration = $cart['products'][$_REQUEST['edit_configuration']]['extra']['configuration'];

			// If product has options, select the appropriate
			// FIXME: duplicate selection, first was in gather_additional_product_data
			if (!empty($cart['products'][$_REQUEST['edit_configuration']]['product_options'])) {
				$product['product_options'] = fn_get_selected_product_options($product['product_id'], $cart['products'][$_REQUEST['edit_configuration']]['product_options'], CART_LANGUAGE);
			}
		}

		$product_configurator_steps = db_get_hash_array("SELECT ?:conf_steps.step_id, ?:conf_step_descriptions.step_name FROM ?:conf_steps LEFT JOIN ?:conf_step_descriptions ON ?:conf_steps.step_id = ?:conf_step_descriptions.step_id WHERE ?:conf_steps.status = 'A' AND ?:conf_step_descriptions.lang_code = ?s ORDER BY ?:conf_steps.position", 'step_id', CART_LANGUAGE);

		$current_step_id = 0;
		foreach ($product_configurator_steps as $step_id => $step_value) {
			if (empty($current_step_id)) {
				$current_step_id = $step_id;
			}

			$product_configurator_groups = db_get_array("SELECT ?:conf_groups.group_id, ?:conf_group_descriptions.configurator_group_name, ?:conf_group_descriptions.full_description, ?:conf_groups.configurator_group_type, ?:conf_product_groups.position, ?:conf_product_groups.default_product_ids, ?:conf_product_groups.required FROM ?:conf_groups LEFT JOIN ?:conf_group_descriptions ON ?:conf_group_descriptions.group_id = ?:conf_groups.group_id LEFT JOIN ?:conf_product_groups ON ?:conf_product_groups.group_id = ?:conf_groups.group_id  WHERE ?:conf_groups.status = 'A' AND ?:conf_group_descriptions.lang_code = ?s AND ?:conf_product_groups.product_id = ?i AND ?:conf_groups.step_id = ?i ORDER BY ?:conf_product_groups.position", CART_LANGUAGE, $product['product_id'], $step_id);

			$price_membership = db_quote(" AND ?:product_prices.membership_id IN (?n)", array(0, $auth['membership_id']));

			if (!empty($product_configurator_groups)) {
				$c_price = 0;

				foreach ($product_configurator_groups as $k => $v) {

					$class_ids = db_get_fields("SELECT class_id FROM ?:conf_classes WHERE group_id = ?i", $v['group_id']);

					$_products = db_get_array("SELECT ?:product_descriptions.product, ?:product_descriptions.product_id , MIN(?:product_prices.price) as price, ?:conf_class_products.class_id FROM ?:conf_group_products LEFT JOIN ?:products ON ?:products.product_id = ?:conf_group_products.product_id LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:conf_group_products.product_id AND ?:product_descriptions.lang_code = ?s LEFT JOIN ?:product_prices ON ?:product_prices.product_id = ?:product_descriptions.product_id AND ?:product_prices.lower_limit = '1' ?p LEFT JOIN ?:conf_class_products ON ?:conf_class_products.class_id IN (?n) AND ?:conf_class_products.product_id = ?:conf_group_products.product_id WHERE ?:conf_group_products.group_id = ?i AND ?:products.status IN ('A', 'H') GROUP BY ?:product_prices.product_id ORDER BY ?:product_descriptions.product", CART_LANGUAGE, $price_membership, $class_ids, $v['group_id']);

					if (empty($_products)) {
						unset($product_configurator_groups[$k]);
						continue;
					}

					$default_ids = explode(':',$v['default_product_ids']);
					$selected_ids = empty($selected_configuration[$v['group_id']]) ? $default_ids : (!is_array($selected_configuration[$v['group_id']]) ? array($selected_configuration[$v['group_id']]) : $selected_configuration[$v['group_id']]);

					foreach ($_products as $_k => $_v) {
						// Selected products
						if (in_array($_v['product_id'], $selected_ids)) {
							$_products[$_k]['selected']	= 'Y';
							$c_price += $_products[$_k]['price'];
						} else {
							$_products[$_k]['selected']	= 'N';
						}

						// Recommended products
						if (in_array($_v['product_id'], $default_ids)) {
							$_products[$_k]['recommended']	= 'Y';
						}


						$_products[$_k]['compatible_classes'] = db_get_hash_array("SELECT ?:conf_compatible_classes.slave_class_id, ?:conf_classes.group_id FROM ?:conf_compatible_classes LEFT JOIN ?:conf_classes ON ?:conf_classes.class_id = ?:conf_compatible_classes.slave_class_id WHERE ?:conf_compatible_classes.master_class_id = ?i AND ?:conf_classes.status = 'A'", 'slave_class_id', $_v['class_id']);
					}

					$product_configurator_groups[$k]['products_count'] = count($_products);
					$product_configurator_groups[$k]['products'] = $_products;
					$product_configurator_groups[$k]['main_pair'] = fn_get_image_pairs($v['group_id'], 'conf_group', 'M');
				}
			}

			if (empty($product_configurator_groups)) {
				unset($product_configurator_steps[$step_id]);
				continue;
			}

			Registry::set('navigation.tabs.pc_' . $step_id, array (
				'title' => $step_value['step_name'],
				'section' => 'configurator',
				'js' => true
			));

			// Substitute configuration price instead of product price
			if (!empty($c_price)) {
				$product['price'] = $c_price;
			}

			// Define list of incompatible products
			$tmp = $product_configurator_groups;
			foreach ($product_configurator_groups as $k => $v ) {
				foreach ($v['products'] as $_k => $_v) {
					if ($_v['selected'] == 'Y' && !empty($_v['compatible_classes'])) {
						foreach ($tmp as $t_key => $t_val) {
							if ($v['group_id'] !=  $t_val['group_id']) {
								foreach ($t_val['products'] as $t_kk => $t_vv) {
									$compatible = false;
									foreach ($_v['compatible_classes'] as $c_class_id => $c_class_val) {
										if ($t_vv['class_id'] == $c_class_id) {
											$compatible = true;
											break;
										}
									}
									$t_val['products'][$t_kk]['disabled'] = !$compatible;
								}
							}
						}
					}
				}
			}

			$product_configurator_groups = $tmp;
			$product_configurator_steps[$step_id]['product_configurator_groups'] = $product_configurator_groups;
		}

		$view->assign('current_step_id', $current_step_id);
		$view->assign('product_configurator_steps', $product_configurator_steps);
	}

	$view->assign('product', $product);
}
/** /Body **/
?>
