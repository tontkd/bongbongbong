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
// $Id: newsletters.php 7823 2009-08-14 07:06:25Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

// dynamic pieces of content that admin can use in newsletters
$placeholders = array();
$placeholders = array(
	NEWSLETTER_TYPE_NEWSLETTER => array(
		'%UNSUBSCRIBE_LINK' => 'unsubscribe_link',
		'%SUBSCRIBER_EMAIL' => 'subscriber_email',
		'%COMPANY_NAME' => 'company_name',
		'%COMPANY_ADDRESS' => 'company_address',
		'%COMPANY_PHONE' => 'company_phone'
 	),

 	NEWSLETTER_TYPE_AUTORESPONDER => array(
 		'%ACTIVATION_LINK' => 'activation_link',
		'%SUBSCRIBER_EMAIL' => 'subscriber_email',
		'%COMPANY_NAME' => 'company_name',
		'%COMPANY_ADDRESS' => 'company_address',
		'%COMPANY_PHONE' => 'company_phone'
 	),

 	NEWSLETTER_TYPE_TEMPLATE => array(
 		'%UNSUBSCRIBE_LINK' => 'unsubscribe_link',
 		'%ACTIVATION_LINK' => 'activation_link',
		'%SUBSCRIBER_EMAIL' => 'subscriber_email',
		'%COMPANY_NAME' => 'company_name',
		'%COMPANY_ADDRESS' => 'company_address',
		'%COMPANY_PHONE' => 'company_phone'
 	),
 );


if ($_SERVER['REQUEST_METHOD']	== 'POST') {

	fn_trusted_vars('newsletter_data');

	$suffix = '.manage';

	//
	// Delete newsletters
	//
	if ($mode == 'delete') {
		if (!empty($_REQUEST['newsletter_ids'])) {
			foreach ($_REQUEST['newsletter_ids'] as $v) {
				fn_delete_newsletter($v);
			}
		}
	}

	//
	// Update newsletters
	//
	if ($mode == 'update') {
		fn_update_newsletter($_REQUEST['newsletter_data'], $_REQUEST['newsletter_id'], DESCR_SL);

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.update&newsletter_id=" . $_REQUEST['newsletter_id']);
	}


	//
	// Add newsletters
	//
	if ($mode == 'add') {
		$newsletter_id = fn_update_newsletter($_REQUEST['newsletter_data'], 0, DESCR_SL);
		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.update&newsletter_id=" . $newsletter_id);

	}


	if ($mode == 'm_update') {
		foreach ($_REQUEST['newsletters'] as $newsletter_id => $newsletter_data) {
			db_query("UPDATE ?:newsletter_descriptions SET newsletter = ?s WHERE newsletter_id = ?i AND lang_code=?s", $newsletter_data['newsletter'], $newsletter_id, DESCR_SL);
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.manage&type={$_REQUEST['newsletter_type']}");
	}

	//
	// Send newsletter
	//
	if ($mode == 'send') {
		$newsletter_id = fn_update_newsletter($_REQUEST['newsletter_data'], $_REQUEST['newsletter_id'], DESCR_SL);

		if (!empty($_REQUEST['newsletter_data']['mailing_lists']) || !empty($_REQUEST['newsletter_data']['users'])) {
			$list_recipients = array();
			if (!empty($_REQUEST['newsletter_data']['mailing_lists'])) {
				$list_recipients = db_get_array("SELECT * FROM ?:subscribers s LEFT JOIN ?:user_mailing_lists u ON s.subscriber_id=u.subscriber_id LEFT JOIN ?:mailing_lists m ON u.list_id = m.list_id WHERE u.list_id IN(?n) AND u.confirmed='1' GROUP BY s.subscriber_id", $_REQUEST['newsletter_data']['mailing_lists']);
			}

			$user_recipients = array();
			if (!empty($_REQUEST['newsletter_data']['users'])) {
				$users = split(',', $_REQUEST['newsletter_data']['users']);
				$user_recipients = db_get_array("SELECT email, lang_code FROM ?:users WHERE user_id IN (?n)", $users);
				foreach ($user_recipients as $k => $v) {
					// populate user array with sensible defaults
					$user_recipients[$k]['format'] = NEWSLETTER_FORMAT_HTML;
					$user_recipients[$k]['from_name'] = '';
					$user_recipients[$k]['reply_to'] = '';
				}
			}

			$recipients = $list_recipients + $user_recipients;

			if (!empty($recipients)) {
				// Set status to 'sent'
				$send_ids = isset($_REQUEST['send_ids']) ? $_REQUEST['send_ids'] : array($newsletter_id);
				foreach ($send_ids as $n_id) {
					db_query("UPDATE ?:newsletters SET status = 'S', sent_date = ?i WHERE newsletter_id = ?i", TIME, $n_id);
				}

				$data = array (
					'send_ids' => $send_ids,
					'recipients' => $recipients,
				);

				$cache_file = 'batch_send_' . md5(uniqid(rand()));
				if (file_put_contents(DIR_COMPILED . $cache_file, serialize($data))) {
					return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.batch_send&cache_file=$cache_file");
				} else {
					$msg = fn_get_lang_var('cannot_write_file');
					$msg = str_replace('[file]', DIR_COMPILED . $cache_file, $msg);
					fn_set_notification('E', fn_get_lang_var('error'), $msg);
				}
			} else {
				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_newsletter_no_recipients'));
			}
		} else {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_newsletter_no_recipients'));
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.update&newsletter_id=$newsletter_id");

	}

	// send newsletter to test email
	if ($mode == 'test_send') {

		//fn_update_newsletter($_REQUEST['newsletter_data'], $_REQUEST['newsletter_id'], DESCR_SL);
		$test_email = $_REQUEST['test_email'];
		if (fn_validate_email($test_email)) {

			$user['list_id'] = 0;
			$user['subscriber_id'] = 0;
			$user['email'] = $test_email;
			//$newsletter = fn_get_newsletter_data($_REQUEST['newsletter_id']);
			$newsletter = $_REQUEST['newsletter_data'];


			list($newsletter['body_txt'], $newsletter['body_html']) = fn_rewrite_links($newsletter['body_txt'], $newsletter['body_html'],  $_REQUEST['newsletter_id'], $newsletter['campaign_id']);
			$first_newsletter = fn_render_newsletter($newsletter['body_txt'], $user);
			$second_newsletter = fn_render_newsletter($newsletter['body_html'], $user);
		
			fn_override_mailer();			
			fn_send_newsletter($test_email, array(), $newsletter['newsletter'], $first_newsletter, array(), DESCR_SL, '', false);
			fn_send_newsletter($test_email, array(), $newsletter['newsletter'], $second_newsletter, array(), DESCR_SL, '', true);
			fn_restore_mailer();
	
			
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_newsletter_sent'));
		} else {
			$msg = fn_get_lang_var('error_invalid_emails');
			fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[emails]', $test_email));
		}

		if (defined('AJAX_REQUEST')) {
			exit;
		}

		return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.update&newsletter_id=$newsletter[newsletter_id]");
	}


	// preview txt version of newsletter
	if ($mode == 'preview_txt') {
		$user['list_id'] = 0;
		$user['subscriber_id'] = 0;
		$user['email'] = 'sample@sample.com';
		$body = fn_render_newsletter($_REQUEST['newsletter_data']['body_txt'], $user);
		$body = nl2br(htmlspecialchars($body));
		$view->assign('body', $body);
		$view->display('addons/news_and_emails/views/newsletters/components/preview_popup.tpl');
		exit();
	}


	// preview html version of newsletter
	if ($mode == 'preview_html') {
		$user['list_id'] = 0;
		$user['subscriber_id'] = 0;
		$user['email'] = 'sample@sample.com';
		$body = fn_render_newsletter($_REQUEST['newsletter_data']['body_html'], $user);
		$view->assign('body', $body);
		$view->display('addons/news_and_emails/views/newsletters/components/preview_popup.tpl');
		exit();
	}

	if ($mode == 'm_update_campaigns') {

		if (!empty($_REQUEST['campaigns'])) {
			$c_ids = array();
			foreach ($_REQUEST['campaigns'] as $k => $data) {
				db_query("UPDATE ?:newsletter_campaigns SET ?u WHERE campaign_id = ?i", $data, $k);

				$data['object'] = $data['name'];
				$_where = array(
					'object_id' => $k,
					'object_table' => 'newsletter_campaigns',
					'lang_code' => DESCR_SL
				);

				db_query("UPDATE ?:common_descriptions SET ?u WHERE ?w", $data, $_where);
			}
		}

		$suffix = '.campaigns';
	}

	if ($mode == 'add_campaign') {
		$data = $_REQUEST['campaign_data'];
		if (!empty($data['name'])) {
			$data['campaign_id'] = $data['object_id'] = db_query("INSERT INTO ?:newsletter_campaigns ?e", $data);
			$data['object'] = $data['name'];
			$data['object_table'] = 'newsletter_campaigns';

			foreach ((array)Registry::get('languages') as $data['lang_code'] => $_v) {
				db_query("INSERT INTO ?:common_descriptions ?e", $data);
			}
		}

		$suffix = '.campaigns';
	}

	if ($mode == 'm_delete_campaigns') {
		if (!empty($_REQUEST['campaign_ids'])) {
			fn_delete_campaigns($_REQUEST['campaign_ids']);
		}

		$suffix = '.campaigns';
	}

	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters" . $suffix);
}




if ($mode == 'batch_send' && !empty($_REQUEST['cache_file'])) {
	$data = fn_get_contents(DIR_COMPILED . $_REQUEST['cache_file']);
	if (!empty($data)) {
		$data = @unserialize($data);
	}

	if (is_array($data)) {
		// Ger newsletter data
		$newsletter_data = array();
		foreach ($data['send_ids'] as $newsletter_id) {
			$n = array();
			foreach ((array)Registry::get('languages') as $lang_code => $v) {
				 $n[$lang_code] = fn_get_newsletter_data($newsletter_id, $lang_code);
				 list($n[$lang_code]['body_txt'], $n[$lang_code]['body_html']) = fn_rewrite_links($n[$lang_code]['body_txt'], $n[$lang_code]['body_html'], $newsletter_id, $n[$lang_code]['campaign_id']);
			}

			$newsletter_data[] = $n;
		}

		foreach (array_splice($data['recipients'], 0, Registry::get('addons.news_and_emails.newsletters_per_pass')) as $subscriber) {
			foreach ($newsletter_data as $newsletter) {
                if ($subscriber['format'] == NEWSLETTER_FORMAT_TXT) {
                    $body = fn_render_newsletter($newsletter[$subscriber['lang_code']]['body_txt'], $subscriber);
                } else {
                    $body = fn_render_newsletter($newsletter[$subscriber['lang_code']]['body_html'], $subscriber);
                }

				fn_echo(str_replace('[email]', $subscriber['email'], fn_get_lang_var('sending_email_to')) . '<br />');
				
				fn_override_mailer();			
				if (!empty($newsletter[$subscriber['lang_code']]['newsletter_multiple'])) {					
					$subjects = explode("\n", $newsletter[$subscriber['lang_code']]['newsletter_multiple']);				
					$newsletter[$subscriber['lang_code']]['newsletter'] = trim($subjects[rand(0, count($subjects) - 1)]);					
				}
				fn_send_newsletter($subscriber['email'], $subscriber, $newsletter[$subscriber['lang_code']]['newsletter'], $body, array(), $subscriber['lang_code'], $subscriber['reply_to'], ($subscriber['format'] == NEWSLETTER_FORMAT_HTML));
				fn_restore_mailer();				
			}
		}

		if (!empty($data['recipients'])) {
			file_put_contents(DIR_COMPILED . $_REQUEST['cache_file'], serialize($data));
			return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.batch_send&cache_file=" . $_REQUEST['cache_file']);
		} else {
			fn_rm(DIR_COMPILED . $_REQUEST['cache_file']);
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_newsletter_sent'));
			$suffix = sizeof($data['send_ids']) == 1 ? ".update&newsletter_id=" . array_pop($data['send_ids']) : '.manage';
			return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters$suffix");
		}
	}

	fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_newsletter_no_recipients'));
	return array(CONTROLLER_STATUS_OK, "$index_script?dispatch=newsletters.manage");


// return template body
} elseif ($mode == 'render') {
	if (defined('AJAX_REQUEST')) {
		$template_id = !empty($_REQUEST['template_id']) ? intval($_REQUEST['template_id']) : 0;
		if ($template_id) {
			$template = fn_get_newsletter_data($template_id);
			Registry::get('ajax')->assign('template', array('txt' => $template['body_txt'], 'html' => $template['body_html']));
		}

		exit();
	}


// newsletter update page
} elseif ($mode == 'update') {
	$newsletter_id = !empty($_REQUEST['newsletter_id']) ? intval($_REQUEST['newsletter_id']) : 0;

	$newsletter_data = fn_get_newsletter_data($newsletter_id, DESCR_SL);

	if (empty($newsletter_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	fn_newsletters_breadcrumb($newsletter_data['type']);

	$campaigns = db_get_hash_array("SELECT * FROM ?:newsletter_campaigns n LEFT JOIN ?:common_descriptions d ON n.campaign_id = d.object_id AND d.lang_code = ?s WHERE d.object_table = 'newsletter_campaigns' AND n.status = 'A'", 'campaign_id', DESCR_SL);

	$view->assign('newsletter_campaigns', $campaigns);

	$links = db_get_array("SELECT * FROM ?:newsletter_links WHERE newsletter_id=?i", $newsletter_id);
	$view->assign('newsletter_links', $links);

	$view->assign('newsletter', $newsletter_data);

	$view->assign('newsletter_templates', fn_get_newsletters(array('type' => NEWSLETTER_TYPE_TEMPLATE, 'only_available' => false), DESCR_SL));
	$view->assign('newsletter_type', $newsletter_data['type']);
	$view->assign('placeholders', $placeholders[$newsletter_data['type']]);

	$view->assign('mailing_lists', db_get_hash_array("SELECT * FROM ?:mailing_lists m INNER JOIN ?:common_descriptions d ON m.list_id = d.object_id WHERE d.object_table = 'mailing_lists' AND d.lang_code = ?s", 'list_id', DESCR_SL));

	$view->assign('newsletter_users', db_get_fields("SELECT user_id FROM ?:users WHERE user_id IN(?n) ", explode(',', $newsletter_data['users'])));

// newsletter creation page
} elseif ($mode == 'add') {

	$newsletter_type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : NEWSLETTER_TYPE_NEWSLETTER;

	fn_newsletters_breadcrumb($newsletter_type);

	$campaigns = db_get_array("SELECT * FROM ?:newsletter_campaigns n INNER JOIN ?:common_descriptions d ON n.campaign_id = d.object_id AND d.lang_code = ?s WHERE d.object_table='newsletter_campaigns'", DESCR_SL);
	$view->assign('newsletter_campaigns', $campaigns);

	$view->assign('newsletter_templates', fn_get_newsletters(array('type' => NEWSLETTER_TYPE_TEMPLATE, 'only_available' => false), DESCR_SL));
	$view->assign('newsletter_type', $newsletter_type);
	$view->assign('placeholders', $placeholders[$newsletter_type]);

	$view->assign('mailing_lists', fn_get_mailing_lists(array('only_available' => false)));

// newsletter creation page
} elseif ($mode == 'preview_popup') {
	$view->display('addons/news_and_emails/views/newsletters/components/preview_popup.tpl');
	exit();


// newsletter manage page
} elseif ($mode == 'manage') {
	// do we list newsletters or templates or autoresponders?
	$newsletter_type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : NEWSLETTER_TYPE_NEWSLETTER;

	$view->assign('newsletter_type', $newsletter_type);
	$view->assign('newsletters', fn_get_newsletters(array('type' => $newsletter_type, 'only_available' => false), DESCR_SL));
	
	fn_newsletters_generate_sections($newsletter_type);

} elseif ($mode == 'campaigns') {

	list($campaigns, $search) = fn_get_campaigns($_REQUEST);
	$view->assign('campaigns', $campaigns);
	$view->assign('search', $search);
	
	fn_newsletters_generate_sections('C');

} elseif ($mode == 'campaign_stats') {

	$campaign = db_get_row("SELECT c.*, d.* FROM ?:newsletter_campaigns c INNER JOIN ?:common_descriptions d ON c.campaign_id=d.object_id LEFT JOIN ?:newsletters ON c.campaign_id=?:newsletters.campaign_id WHERE d.object_table='newsletter_campaigns' AND c.campaign_id = ?i", $_REQUEST['campaign_id']);
	$stats = db_get_array("SELECT n.*, d.*, SUM(e.clicks) as clicks FROM ?:newsletters n INNER JOIN ?:newsletter_descriptions d ON n.newsletter_id=d.newsletter_id LEFT JOIN ?:newsletter_links e ON n.newsletter_id = e.newsletter_id WHERE n.campaign_id=?i GROUP BY e.newsletter_id", $_REQUEST['campaign_id']);
	$view->assign('campaign', $campaign);
	$view->assign('campaign_stats', $stats);

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['newsletter_id'])) {
		fn_delete_newsletter($_REQUEST['newsletter_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=newsletters.manage");

} elseif ($mode == 'delete_campaign') {
	if (!empty($_REQUEST['campaign_id'])) {
		fn_delete_campaigns((array)$_REQUEST['campaign_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "$index_script?dispatch=newsletters.campaigns");
}

function fn_delete_campaigns($campaign_ids)
{
	db_query("DELETE FROM ?:common_descriptions WHERE object_id IN (?n) AND object_table = 'newsletter_campaigns'", $campaign_ids);
	db_query("DELETE FROM ?:newsletter_campaigns WHERE campaign_id IN (?n)", $campaign_ids);
	db_query("DELETE FROM ?:newsletter_links WHERE campaign_id IN (?n)", $campaign_ids);
	db_query("UPDATE ?:newsletters SET campaign_id = 0 WHERE campaign_id IN (?n)", $campaign_ids);
}

function fn_delete_newsletter($newsletter_id)
{
	db_query("DELETE FROM ?:newsletters WHERE newsletter_id = ?i", $newsletter_id);
	db_query("DELETE FROM ?:newsletter_descriptions WHERE newsletter_id = ?i", $newsletter_id);
}

function fn_newsletters_breadcrumb($newsletter_type)
{
	if ($newsletter_type == NEWSLETTER_TYPE_AUTORESPONDER) {
		$object_name = fn_get_lang_var('autoresponders');
	} elseif ($newsletter_type == NEWSLETTER_TYPE_TEMPLATE) {
		$object_name = fn_get_lang_var('templates');
	} else {
		$object_name = fn_get_lang_var('newsletters');
	}

	fn_add_breadcrumb($object_name, INDEX_SCRIPT . "?dispatch=newsletters.manage&type=$newsletter_type");
}

function fn_get_campaigns($params, $lang_code = DESCR_SL)
{
	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	$total_pages = db_get_field("SELECT COUNT(*) FROM ?:newsletter_campaigns");
	$limit = fn_paginate($params['page'], $total_pages, Registry::get('settings.Appearance.admin_elements_per_page'));

	$campaigns = db_get_array("SELECT c.*, d.* FROM ?:newsletter_campaigns c INNER JOIN ?:common_descriptions d ON c.campaign_id = d.object_id AND lang_code = ?s LEFT JOIN ?:newsletters ON c.campaign_id=?:newsletters.campaign_id WHERE d.object_table = 'newsletter_campaigns'", $lang_code);

	return array($campaigns, $params);
}

?>
