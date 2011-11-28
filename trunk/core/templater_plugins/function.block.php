<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_function_block($params, &$smarty)
{
	static $blocks;

	$display = true;
	if (!isset($blocks)) {
		$blocks = $smarty->get_var('blocks');
	}

	$_tpl_vars = $smarty->_tpl_vars; // save state of original variables

	if (!empty($params['wrapper'])) { // if block is wrapped, display wrapper
		$display_tpl = $params['wrapper'];
	}

	if (!empty($params['content'])) {
		if (!empty($display_tpl)) {
			$block_content = $smarty->display($smarty->get_var('content_tpl'), false);
			if (!empty($smarty->_smarty_vars['capture']['hide_wrapper'])) {
				$smarty->assign('hide_wrapper', true);
				unset($smarty->_smarty_vars['capture']['hide_wrapper']); // remove this flag
			}
			$smarty->assign('title', !empty($smarty->_smarty_vars['capture']['mainbox_title']) ? $smarty->_smarty_vars['capture']['mainbox_title'] : '', false);
			$smarty->assign('content', $block_content, false);
			unset($block_content);

		} else {
			$display_tpl = $smarty->get_var('content_tpl');
		}

	} elseif (!empty($params['id']) && !empty($params['template'])) {
		if (!empty($blocks[$params['id']])) {

			$_block = $blocks[$params['id']];

			// This block is not static, so it is necessary to find its items
			if (strpos($_block['properties']['list_object'], '.tpl') === false) {
				$_block['properties']['appearances'] = $params['template'];
				$items = fn_get_block_items($_block);
				//if (empty($items) && $_block['properties']['hide_empty_block'] != 'no') {
				if (empty($items)) {
					$display = false;
				} else {
					$smarty->assign('items', $items);
				}
			}

			if ($display == true) {

				if ($smarty->template_exists($params['template'])) {
					$tpl = $params['template'];
					if (strpos($tpl, 'addons/') !== false) {
						$a = explode('/', $tpl);
						if (fn_load_addon($a[1]) == false) { // do not display template of disabled addon
							$display = false;
						}
					}
				} else {
					$display = false;
				}

				if ($display == true) {
					unset($blocks[$params['id']], $params['id'], $params['template']);

					$smarty->assign('block', $_block, false);
					// Pass extra parameters to smarty
					if (!empty($params)) {
						foreach ($params as $k => $v) {
							$smarty->assign($k, $v);
						}
					}

					if (!empty($display_tpl)) { // if wrapper exists, get block content
						$block_content = $smarty->display($tpl, false);
						if (trim($block_content)) {
							if (!empty($smarty->_smarty_vars['capture']['hide_wrapper'])) {
								$smarty->assign('hide_wrapper', true);
								unset($smarty->_smarty_vars['capture']['hide_wrapper']); // remove this flag
							}
							$smarty->assign('title', $_block['block']);
							$smarty->assign('content', $block_content, false);
							unset($block_content);
						} else {
							$display = false;
						}
					} else {
						$display_tpl = $tpl;
					}
				}

			}
		} else {
			$display = false;
		}
	}

	if ($display == true) {
		$block_content = !empty($block_content) ? $block_content : $smarty->display($display_tpl, false);
		$smarty->_tpl_vars = $_tpl_vars; // restore original vars again
		return $block_content;
	} else {
		return false;
	}
}

?>