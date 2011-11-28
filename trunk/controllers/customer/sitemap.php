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
// $Id: sitemap.php 7577 2009-06-11 09:14:58Z lexa $
//

if ( !defined('AREA') )	{ die('Access denied');	}

if ($mode == 'view') {

	fn_add_breadcrumb(fn_get_lang_var('sitemap'));
	$sitemap_settings = fn_get_settings('Sitemap');
	$view->assign('sitemap_settings', $sitemap_settings);

	if ($sitemap_settings['show_cats'] == 'Y') {
		if ($sitemap_settings['show_rootcats_only'] == 'Y') {
			$categories = fn_get_plain_categories_tree(0, true);
			$sitemap['categories'] = array();

			foreach ($categories as $c) {
				if ($c['level'] == 0) {
					$sitemap['categories'][] = $c;
				}
			}
		} else {
			$sitemap['categories_tree'] = fn_get_plain_categories_tree(0, true);
		}
	}

	if ($sitemap_settings['show_site_info'] == 'Y') {
		$_params = array(
			'get_tree' => 'plain',
			'status' => 'A'
		);
		list($sitemap['pages_tree']) = fn_get_pages($_params);
	}


	$custom_sections = db_get_array("SELECT *, ?:common_descriptions.object as section FROM ?:sitemap_sections LEFT JOIN ?:common_descriptions ON ?:sitemap_sections.section_id = ?:common_descriptions.object_id AND ?:common_descriptions.object_table = 'sitemap_sections' AND ?:common_descriptions.lang_code = ?s WHERE status = 'A' ORDER BY position, section", CART_LANGUAGE);

	foreach ($custom_sections as $k => $section) {
		$links = db_get_array("SELECT link_id, link_href, section_id, status, position, link_type, description, object as link FROM ?:sitemap_links LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:sitemap_links.link_id AND ?:common_descriptions.object_table = 'sitemap_links' AND ?:common_descriptions.lang_code = ?s WHERE section_id = ?i ORDER BY position, link", CART_LANGUAGE, $section['section_id']);

		if (!empty($links)) {
			foreach($links as $key => $link) {
				$sitemap['custom'][$section['section']][$key]['link'] = $link['link'];
				$sitemap['custom'][$section['section']][$key]['link_href'] = $link['link_href'];
				$sitemap['custom'][$section['section']][$key]['description'] = $link['description'];
			}
		}
	}

	$view->assign('sitemap', $sitemap);
}

?>
