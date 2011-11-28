DROP TABLE IF EXISTS cscart_access_restriction;
CREATE TABLE `cscart_access_restriction` (
  `item_id` mediumint(8) unsigned NOT NULL auto_increment,
  `value` varchar(66) NOT NULL default '',
  `ip_from` int(11) unsigned NOT NULL default '0',
  `ip_to` int(11) unsigned NOT NULL default '0',
  `type` varchar(3) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `expires` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`item_id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_access_restriction_block;
CREATE TABLE `cscart_access_restriction_block` (
  `ip` int(11) unsigned NOT NULL default '0',
  `tries` smallint(5) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `expires` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_access_restriction_reason_descriptions;
CREATE TABLE `cscart_access_restriction_reason_descriptions` (
  `item_id` mediumint(8) unsigned NOT NULL auto_increment,
  `type` varchar(3) NOT NULL default '',
  `reason` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`item_id`,`type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_addon_descriptions;
CREATE TABLE `cscart_addon_descriptions` (
  `addon` varchar(32) NOT NULL default '',
  `object_id` varchar(64) NOT NULL default '',
  `object_type` char(1) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default '',
  PRIMARY KEY  (`addon`,`object_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_addons;
CREATE TABLE `cscart_addons` (
  `addon` varchar(32) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `options` text NOT NULL,
  `priority` tinyint(4) NOT NULL default '0',
  `dependencies` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`addon`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_action_links;
CREATE TABLE `cscart_aff_action_links` (
  `action_id` mediumint(8) unsigned NOT NULL default '0',
  `object_data` varchar(255) NOT NULL default '',
  `object_type` char(1) NOT NULL default '',
  PRIMARY KEY  (`action_id`,`object_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_banner_descriptions;
CREATE TABLE `cscart_aff_banner_descriptions` (
  `banner_id` mediumint(8) unsigned NOT NULL default '0',
  `title` varchar(64) NOT NULL default '',
  `content` varchar(255) NOT NULL default '',
  `alt` varchar(64) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`banner_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_banners;
CREATE TABLE `cscart_aff_banners` (
  `banner_id` mediumint(8) unsigned NOT NULL auto_increment,
  `width` int(4) unsigned NOT NULL default '120',
  `height` int(4) unsigned NOT NULL default '60',
  `type` char(1) NOT NULL default 'T',
  `link_to` char(1) NOT NULL default 'U',
  `data` varchar(255) NOT NULL default '',
  `show_title` char(1) NOT NULL default 'Y',
  `text_location` char(1) NOT NULL default 'B',
  `new_window` char(1) NOT NULL default 'N',
  `to_cart` char(1) NOT NULL default 'N',
  `show_url` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`banner_id`),
  KEY `type_linkto` (`type`,`link_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_group_descriptions;
CREATE TABLE `cscart_aff_group_descriptions` (
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `name` char(64) NOT NULL default '',
  `lang_code` char(2) NOT NULL default 'EN',
  PRIMARY KEY  (`group_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_groups;
CREATE TABLE `cscart_aff_groups` (
  `group_id` mediumint(8) unsigned NOT NULL auto_increment,
  `link_to` char(1) NOT NULL default 'U',
  `data` char(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`group_id`),
  KEY `link_to` (`link_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_partner_actions;
CREATE TABLE `cscart_aff_partner_actions` (
  `action_id` mediumint(8) unsigned NOT NULL auto_increment,
  `banner_id` mediumint(8) unsigned NOT NULL default '0',
  `partner_id` mediumint(8) unsigned NOT NULL default '0',
  `plan_id` mediumint(8) unsigned NOT NULL default '0',
  `customer_id` mediumint(8) unsigned NOT NULL default '0',
  `date` int(11) unsigned NOT NULL default '0',
  `ip` varchar(255) NOT NULL default '',
  `action` varchar(32) NOT NULL default '',
  `amount` decimal(9,2) NOT NULL default '0.00',
  `approved` char(1) NOT NULL default 'N',
  `payout_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`action_id`),
  KEY `parnerid_approved_date_payoutid` (`partner_id`,`approved`,`date`,`payout_id`,`amount`),
  KEY `action_date_amount_approved_payoutid` (`action`,`date`,`amount`,`approved`,`payout_id`),
  KEY `data_approved_payoutid` (`approved`,`payout_id`),
  KEY `amount` (`amount`),
  KEY `partnerid_date` (`partner_id`,`date`),
  KEY `payout_id` (`payout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_aff_partner_profiles;
CREATE TABLE `cscart_aff_partner_profiles` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `approved` char(1) NOT NULL default 'N',
  `plan_id` mediumint(8) unsigned NOT NULL default '0',
  `balance` decimal(9,2) NOT NULL default '0.00',
  `referrer_partner_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_affiliate_payouts;
CREATE TABLE `cscart_affiliate_payouts` (
  `payout_id` mediumint(8) unsigned NOT NULL auto_increment,
  `partner_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` decimal(9,2) NOT NULL default '0.00',
  `date` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'O',
  PRIMARY KEY  (`payout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_affiliate_plans;
CREATE TABLE `cscart_affiliate_plans` (
  `plan_id` mediumint(8) unsigned NOT NULL auto_increment,
  `payout_types` text NOT NULL,
  `commissions` varchar(255) NOT NULL default '',
  `min_payment` decimal(9,2) NOT NULL default '0.00',
  `product_ids` text NOT NULL,
  `category_ids` text NOT NULL,
  `promotion_ids` text NOT NULL,
  `cookie_expiration` int(11) unsigned NOT NULL default '0',
  `method_based_selling_price` char(1) NOT NULL default 'N',
  `show_orders` char(1) NOT NULL default 'N',
  `use_coupon_commission` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_also_bought_products;
CREATE TABLE `cscart_also_bought_products` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `related_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`product_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_attachment_descriptions;
CREATE TABLE `cscart_attachment_descriptions` (
  `attachment_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`attachment_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_attachments;
CREATE TABLE `cscart_attachments` (
  `attachment_id` mediumint(8) unsigned NOT NULL auto_increment,
  `object_type` varchar(30) NOT NULL default '',
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default '',
  `position` int(11) NOT NULL default '0',
  `filename` varchar(100) NOT NULL default '',
  `filesize` int(11) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`attachment_id`),
  KEY `object_type` (`object_type`,`object_id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_banner_descriptions;
CREATE TABLE `cscart_banner_descriptions` (
  `banner_id` mediumint(8) unsigned NOT NULL default '0',
  `banner` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`banner_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_banners;
CREATE TABLE `cscart_banners` (
  `banner_id` mediumint(8) unsigned NOT NULL auto_increment,
  `url` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `type` char(1) NOT NULL default 'G',
  `target` char(1) NOT NULL default 'B',
  `localization` varchar(255) NOT NULL default '',
  `timestamp` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`banner_id`),
  KEY `localization` (`localization`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_block_descriptions;
CREATE TABLE `cscart_block_descriptions` (
  `block_id` mediumint(8) unsigned NOT NULL default '0',
  `block` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`block_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_block_links;
CREATE TABLE `cscart_block_links` (
  `link_id` mediumint(8) unsigned NOT NULL auto_increment,
  `block_id` mediumint(8) unsigned NOT NULL default '0',
  `location` varchar(16) NOT NULL default '',
  `object_id` int(11) unsigned NOT NULL default '0',
  `item_ids` text NOT NULL,
  `enable` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`link_id`),
  UNIQUE KEY `block_id` (`block_id`,`object_id`),
  KEY `block_id_2` (`block_id`,`enable`),
  KEY `loc` (`location`,`enable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_block_properties;
CREATE TABLE `cscart_block_properties` (
  `block_id` mediumint(8) unsigned NOT NULL default '0',
  `property` varchar(32) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`block_id`,`property`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_blocks;
CREATE TABLE `cscart_blocks` (
  `block_id` mediumint(8) unsigned NOT NULL auto_increment,
  `location` varchar(32) NOT NULL default '',
  `disabled_locations` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`block_id`),
  KEY `position` (`position`),
  KEY `disabled_locations` (`disabled_locations`),
  KEY `sloc` (`status`,`location`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_categories;
CREATE TABLE `cscart_categories` (
  `category_id` mediumint(8) unsigned NOT NULL auto_increment,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `id_path` varchar(255) NOT NULL default '',
  `owner_id` mediumint(8) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `product_count` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `is_op` char(1) NOT NULL default 'N',
  `localization` varchar(255) NOT NULL default '',
  `age_verification` char(1) NOT NULL default 'N',
  `age_limit` tinyint(4) NOT NULL default '0',
  `parent_age_verification` char(1) NOT NULL default 'N',
  `parent_age_limit` tinyint(4) NOT NULL default '0',
  `selected_layouts` text NOT NULL,
  `default_layout` varchar(50) NOT NULL default '',
  `product_columns` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`),
  KEY `c_status` (`membership_id`,`status`,`parent_id`),
  KEY `position` (`position`),
  KEY `parent` (`parent_id`),
  KEY `id_path` (`id_path`),
  KEY `localization` (`localization`),
  KEY `age_verification` (`age_verification`,`age_limit`),
  KEY `parent_age_verification` (`parent_age_verification`,`parent_age_limit`),
  KEY `p_category_id` (`category_id`,`membership_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_category_descriptions;
CREATE TABLE `cscart_category_descriptions` (
  `category_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `category` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` varchar(255) NOT NULL default '',
  `page_title` varchar(255) NOT NULL default '',
  `age_warning_message` text NOT NULL,
  PRIMARY KEY  (`category_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_common_descriptions;
CREATE TABLE `cscart_common_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `object_type` varchar(32) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `object` varchar(128) NOT NULL default '',
  `object_table` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`object_id`,`lang_code`,`object_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_class_descriptions;
CREATE TABLE `cscart_conf_class_descriptions` (
  `class_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `class_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`class_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_class_products;
CREATE TABLE `cscart_conf_class_products` (
  `class_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `class_id` (`class_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_classes;
CREATE TABLE `cscart_conf_classes` (
  `class_id` mediumint(8) unsigned NOT NULL auto_increment,
  `status` char(1) NOT NULL default 'A',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`class_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_compatible_classes;
CREATE TABLE `cscart_conf_compatible_classes` (
  `master_class_id` mediumint(8) unsigned NOT NULL default '0',
  `slave_class_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `master_class_id` (`master_class_id`,`slave_class_id`),
  KEY `slave_class_id` (`slave_class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_group_descriptions;
CREATE TABLE `cscart_conf_group_descriptions` (
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `configurator_group_name` varchar(255) NOT NULL default '',
  `full_description` text NOT NULL,
  PRIMARY KEY  (`group_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_group_products;
CREATE TABLE `cscart_conf_group_products` (
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `group_id` (`group_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_groups;
CREATE TABLE `cscart_conf_groups` (
  `group_id` mediumint(8) unsigned NOT NULL auto_increment,
  `configurator_group_type` char(1) NOT NULL default 'S',
  `status` char(1) NOT NULL default 'A',
  `step_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`group_id`),
  KEY `step_id` (`step_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_product_groups;
CREATE TABLE `cscart_conf_product_groups` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `default_product_ids` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `required` char(1) NOT NULL default 'N',
  KEY `group_id` (`group_id`,`product_id`,`required`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_step_descriptions;
CREATE TABLE `cscart_conf_step_descriptions` (
  `step_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `step_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`step_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_conf_steps;
CREATE TABLE `cscart_conf_steps` (
  `step_id` mediumint(8) unsigned NOT NULL auto_increment,
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`step_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_countries;
CREATE TABLE `cscart_countries` (
  `code` char(2) NOT NULL default '',
  `code_A3` char(3) NOT NULL default '',
  `code_N3` int(4) NOT NULL default '0',
  `region` char(2) NOT NULL default '',
  `lat` float NOT NULL default '0',
  `lon` float NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`code`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_country_descriptions;
CREATE TABLE `cscart_country_descriptions` (
  `code` varchar(2) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `country` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`code`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_currencies;
CREATE TABLE `cscart_currencies` (
  `currency_code` varchar(10) NOT NULL default '',
  `after` char(1) NOT NULL default 'N',
  `symbol` varchar(30) NOT NULL default '',
  `coefficient` float(12,5) NOT NULL default '1.00000',
  `is_primary` char(1) NOT NULL default 'N',
  `decimals_separator` char(1) NOT NULL default '.',
  `thousands_separator` char(1) NOT NULL default ',',
  `decimals` smallint(5) NOT NULL default '2',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_currency_descriptions;
CREATE TABLE `cscart_currency_descriptions` (
  `currency_code` varchar(10) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`currency_code`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destination_descriptions;
CREATE TABLE `cscart_destination_descriptions` (
  `destination_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `destination` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`destination_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destination_elements;
CREATE TABLE `cscart_destination_elements` (
  `element_id` mediumint(8) unsigned NOT NULL auto_increment,
  `destination_id` mediumint(8) unsigned NOT NULL default '0',
  `element` varchar(36) NOT NULL default '',
  `element_type` char(1) NOT NULL default 'S',
  PRIMARY KEY  (`element_id`),
  KEY `c_status` (`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destinations;
CREATE TABLE `cscart_destinations` (
  `destination_id` mediumint(8) unsigned NOT NULL auto_increment,
  `localization` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`destination_id`),
  KEY `localization` (`localization`),
  KEY `c_status` (`destination_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_discussion;
CREATE TABLE `cscart_discussion` (
  `thread_id` mediumint(8) unsigned NOT NULL auto_increment,
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `object_type` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'D',
  PRIMARY KEY  (`thread_id`),
  UNIQUE KEY `object_id` (`object_id`,`object_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_discussion_messages;
CREATE TABLE `cscart_discussion_messages` (
  `message` text NOT NULL,
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `thread_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`post_id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_discussion_posts;
CREATE TABLE `cscart_discussion_posts` (
  `post_id` mediumint(8) unsigned NOT NULL auto_increment,
  `thread_id` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(128) NOT NULL default '',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `ip_address` varchar(15) NOT NULL default '',
  `status` char(1) NOT NULL default 'D',
  PRIMARY KEY  (`post_id`),
  KEY `thread_id` (`thread_id`,`ip_address`),
  KEY `thread_id_2` (`thread_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_discussion_rating;
CREATE TABLE `cscart_discussion_rating` (
  `rating_value` tinyint(4) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `thread_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`post_id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_ekeys;
CREATE TABLE `cscart_ekeys` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `object_string` varchar(128) NOT NULL default '',
  `object_type` char(1) NOT NULL default 'R',
  `ekey` varchar(32) NOT NULL default '',
  `ttl` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`object_type`,`ekey`),
  UNIQUE KEY `object_string` (`object_string`,`object_type`,`ekey`),
  KEY `c_status` (`ekey`,`object_type`,`ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_exim_layouts;
CREATE TABLE `cscart_exim_layouts` (
  `layout_id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(128) NOT NULL default '',
  `cols` text NOT NULL,
  `pattern_id` varchar(128) NOT NULL default '',
  `active` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`layout_id`),
  KEY `pattern_id` (`pattern_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_form_descriptions;
CREATE TABLE `cscart_form_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`object_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_form_options;
CREATE TABLE `cscart_form_options` (
  `element_id` mediumint(8) unsigned NOT NULL auto_increment,
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `element_type` char(1) NOT NULL default 'I',
  `value` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `required` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`element_id`),
  KEY `page_id` (`page_id`,`status`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_gift_certificates;
CREATE TABLE `cscart_gift_certificates` (
  `gift_cert_id` mediumint(8) unsigned NOT NULL auto_increment,
  `gift_cert_code` varchar(255) NOT NULL default '',
  `sender` varchar(64) NOT NULL default '',
  `recipient` varchar(64) NOT NULL default '',
  `send_via` char(1) NOT NULL default 'E',
  `amount_type` char(1) NOT NULL default 'I',
  `amount` decimal(9,2) NOT NULL default '0.00',
  `email` varchar(64) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `address_2` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `state` varchar(32) NOT NULL default '',
  `country` varchar(2) NOT NULL default '',
  `zipcode` varchar(10) NOT NULL default '',
  `status` char(1) NOT NULL default 'P',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `phone` varchar(32) NOT NULL default '',
  `order_ids` varchar(255) NOT NULL default '',
  `template` varchar(128) NOT NULL default '',
  `message` text NOT NULL,
  `products` text NOT NULL,
  PRIMARY KEY  (`gift_cert_id`),
  KEY `status` (`status`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_gift_certificates_log;
CREATE TABLE `cscart_gift_certificates_log` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `gift_cert_id` mediumint(8) unsigned NOT NULL default '0',
  `area` char(1) NOT NULL default 'C',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `amount` decimal(9,2) NOT NULL default '0.00',
  `debit` decimal(9,2) NOT NULL default '0.00',
  `products` text NOT NULL,
  `debit_products` text NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `area` (`area`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_descriptions;
CREATE TABLE `cscart_giftreg_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `object_type` char(1) NOT NULL default 'F',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`object_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_event_fields;
CREATE TABLE `cscart_giftreg_event_fields` (
  `event_id` mediumint(8) unsigned NOT NULL default '0',
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `value` text NOT NULL,
  PRIMARY KEY  (`event_id`,`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_event_products;
CREATE TABLE `cscart_giftreg_event_products` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `event_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` smallint(5) unsigned NOT NULL default '0',
  `ordered_amount` smallint(5) unsigned NOT NULL default '0',
  `extra` text,
  PRIMARY KEY  (`item_id`,`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_event_subscribers;
CREATE TABLE `cscart_giftreg_event_subscribers` (
  `event_id` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(128) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`event_id`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_events;
CREATE TABLE `cscart_giftreg_events` (
  `event_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `start_date` int(11) unsigned NOT NULL default '0',
  `end_date` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `type` char(1) NOT NULL default 'P',
  `title` varchar(255) NOT NULL default '',
  `owner` varchar(128) NOT NULL default '',
  `email` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`event_id`),
  KEY `start_date` (`start_date`,`end_date`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_field_variants;
CREATE TABLE `cscart_giftreg_field_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`variant_id`),
  KEY `field_id` (`field_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_giftreg_fields;
CREATE TABLE `cscart_giftreg_fields` (
  `field_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_type` char(1) NOT NULL default 'I',
  `position` smallint(5) unsigned NOT NULL default '0',
  `required` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`field_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_images;
CREATE TABLE `cscart_images` (
  `image_id` mediumint(8) NOT NULL auto_increment,
  `image_path` varchar(255) NOT NULL default '',
  `image_x` int(5) NOT NULL default '0',
  `image_y` int(5) NOT NULL default '0',
  `alt` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_images_links;
CREATE TABLE `cscart_images_links` (
  `pair_id` mediumint(8) unsigned NOT NULL auto_increment,
  `object_id` int(11) unsigned NOT NULL default '0',
  `object_type` varchar(24) NOT NULL default '',
  `image_id` mediumint(8) unsigned NOT NULL default '0',
  `detailed_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default 'M',
  PRIMARY KEY  (`pair_id`),
  KEY `object_id` (`object_id`,`object_type`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_language_values;
CREATE TABLE `cscart_language_values` (
  `lang_code` varchar(2) NOT NULL default 'EN',
  `name` varchar(64) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`lang_code`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_languages;
CREATE TABLE `cscart_languages` (
  `lang_code` varchar(2) NOT NULL default 'EN',
  `name` varchar(64) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localization_descriptions;
CREATE TABLE `cscart_localization_descriptions` (
  `localization_id` mediumint(8) unsigned NOT NULL default '0',
  `localization` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  KEY `localisation_id` (`localization_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localization_elements;
CREATE TABLE `cscart_localization_elements` (
  `element_id` mediumint(8) unsigned NOT NULL auto_increment,
  `localization_id` mediumint(8) unsigned NOT NULL default '0',
  `element` varchar(36) NOT NULL default '',
  `element_type` char(1) NOT NULL default 'S',
  `position` smallint(5) NOT NULL default '0',
  PRIMARY KEY  (`element_id`),
  KEY `c_avail` (`localization_id`),
  KEY `element` (`element`,`element_type`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localizations;
CREATE TABLE `cscart_localizations` (
  `localization_id` mediumint(8) unsigned NOT NULL auto_increment,
  `custom_weight_settings` char(1) NOT NULL default 'Y',
  `weight_symbol` varchar(255) NOT NULL default '',
  `weight_unit` decimal(12,2) NOT NULL default '0.00',
  `is_default` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`localization_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_logs;
CREATE TABLE `cscart_logs` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `type` varchar(16) NOT NULL default '',
  `event_type` char(1) NOT NULL default 'N',
  `action` varchar(16) NOT NULL default '',
  `object` char(1) NOT NULL default '',
  `content` text NOT NULL,
  `backtrace` text NOT NULL,
  PRIMARY KEY  (`log_id`),
  KEY `object` (`object`),
  KEY `type` (`type`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_mailing_lists;
CREATE TABLE `cscart_mailing_lists` (
  `list_id` mediumint(8) unsigned NOT NULL auto_increment,
  `timestamp` int(11) unsigned NOT NULL default '0',
  `from_email` varchar(64) NOT NULL default '',
  `from_name` varchar(128) NOT NULL default '',
  `reply_to` varchar(64) NOT NULL default '',
  `show_on_checkout` tinyint(3) unsigned NOT NULL default '0',
  `show_on_registration` tinyint(3) unsigned NOT NULL default '0',
  `show_on_sidebar` tinyint(3) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'D',
  `register_autoresponder` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_membership_descriptions;
CREATE TABLE `cscart_membership_descriptions` (
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `membership` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`membership_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_membership_privileges;
CREATE TABLE `cscart_membership_privileges` (
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `privilege` varchar(24) NOT NULL default '',
  PRIMARY KEY  (`membership_id`,`privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_memberships;
CREATE TABLE `cscart_memberships` (
  `membership_id` mediumint(8) unsigned NOT NULL auto_increment,
  `status` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'C',
  PRIMARY KEY  (`membership_id`),
  KEY `c_status` (`membership_id`,`status`),
  KEY `status` (`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_new_orders;
CREATE TABLE `cscart_new_orders` (
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`order_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_news;
CREATE TABLE `cscart_news` (
  `news_id` mediumint(8) unsigned NOT NULL auto_increment,
  `date` int(11) unsigned NOT NULL default '0',
  `separate` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'D',
  `localization` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`news_id`),
  KEY `localization` (`localization`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_news_descriptions;
CREATE TABLE `cscart_news_descriptions` (
  `news_id` mediumint(8) unsigned NOT NULL default '0',
  `news` varchar(128) NOT NULL default '',
  `description` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`news_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_newsletter_campaigns;
CREATE TABLE `cscart_newsletter_campaigns` (
  `campaign_id` mediumint(8) unsigned NOT NULL auto_increment,
  `timestamp` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'D',
  PRIMARY KEY  (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_newsletter_descriptions;
CREATE TABLE `cscart_newsletter_descriptions` (
  `newsletter_id` mediumint(8) unsigned NOT NULL default '0',
  `newsletter` varchar(255) NOT NULL default '',
  `newsletter_multiple` text NOT NULL,
  `body_html` text NOT NULL,
  `body_txt` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`newsletter_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_newsletter_links;
CREATE TABLE `cscart_newsletter_links` (
  `link_id` mediumint(8) unsigned NOT NULL auto_increment,
  `campaign_id` mediumint(8) unsigned NOT NULL default '0',
  `newsletter_id` mediumint(8) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `clicks` mediumint(8) unsigned default NULL,
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_newsletters;
CREATE TABLE `cscart_newsletters` (
  `newsletter_id` mediumint(8) unsigned NOT NULL auto_increment,
  `campaign_id` mediumint(8) unsigned NOT NULL default '0',
  `sent_date` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `type` char(1) NOT NULL default 'N',
  `mailing_lists` varchar(255) NOT NULL default '',
  `users` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`newsletter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_data;
CREATE TABLE `cscart_order_data` (
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default '',
  `data` text NOT NULL,
  PRIMARY KEY  (`order_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_details;
CREATE TABLE `cscart_order_details` (
  `item_id` int(11) unsigned NOT NULL default '0',
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `product_code` varchar(32) NOT NULL default '',
  `price` decimal(9,2) NOT NULL default '0.00',
  `amount` smallint(5) unsigned NOT NULL default '0',
  `extra` text NOT NULL,
  PRIMARY KEY  (`item_id`,`order_id`),
  KEY `o_k` (`order_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_orders;
CREATE TABLE `cscart_orders` (
  `order_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `total` decimal(9,2) NOT NULL default '0.00',
  `subtotal` decimal(9,2) NOT NULL default '0.00',
  `discount` decimal(9,2) NOT NULL default '0.00',
  `subtotal_discount` decimal(9,2) NOT NULL default '0.00',
  `payment_surcharge` decimal(9,2) NOT NULL default '0.00',
  `shipping_ids` varchar(255) NOT NULL default '',
  `shipping_cost` decimal(9,2) NOT NULL default '0.00',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'O',
  `notes` text NOT NULL,
  `details` text NOT NULL,
  `promotions` text NOT NULL,
  `promotion_ids` varchar(255) NOT NULL default '',
  `title` varchar(32) NOT NULL default '',
  `firstname` varchar(32) NOT NULL default '',
  `lastname` varchar(32) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `b_title` varchar(32) NOT NULL default '',
  `b_firstname` varchar(128) NOT NULL default '',
  `b_lastname` varchar(128) NOT NULL default '',
  `b_address` varchar(255) NOT NULL default '',
  `b_address_2` varchar(255) NOT NULL default '',
  `b_city` varchar(64) NOT NULL default '',
  `b_county` varchar(32) NOT NULL default '',
  `b_state` varchar(32) NOT NULL default '',
  `b_country` varchar(2) NOT NULL default '',
  `b_zipcode` varchar(32) NOT NULL default '',
  `s_title` varchar(32) NOT NULL default '',
  `s_firstname` varchar(128) NOT NULL default '',
  `s_lastname` varchar(128) NOT NULL default '',
  `s_address` varchar(255) NOT NULL default '',
  `s_address_2` varchar(255) NOT NULL default '',
  `s_city` varchar(64) NOT NULL default '',
  `s_county` varchar(32) NOT NULL default '',
  `s_state` varchar(32) NOT NULL default '',
  `s_country` varchar(2) NOT NULL default '',
  `s_zipcode` varchar(32) NOT NULL default '',
  `phone` varchar(32) NOT NULL default '',
  `fax` varchar(32) NOT NULL default '',
  `url` varchar(32) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `payment_id` mediumint(8) NOT NULL default '0',
  `tax_exempt` char(1) NOT NULL default 'N',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `ip_address` varchar(15) NOT NULL default '',
  `repaid` int(11) NOT NULL default '0',
  `validation_code` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`order_id`),
  KEY `timestamp` (`timestamp`),
  KEY `user_id` (`user_id`),
  KEY `promotion_ids` (`promotion_ids`),
  KEY `status` (`status`),
  KEY `shipping_ids` (`shipping_ids`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_page_descriptions;
CREATE TABLE `cscart_page_descriptions` (
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `page` varchar(255) default '0',
  `description` text,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` varchar(255) NOT NULL default '',
  `page_title` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`page_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_pages;
CREATE TABLE `cscart_pages` (
  `page_id` mediumint(8) unsigned NOT NULL auto_increment,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `id_path` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `registred_only` char(1) NOT NULL default 'N',
  `page_type` char(1) NOT NULL default 'T',
  `position` smallint(5) unsigned NOT NULL default '0',
  `timestamp` int(11) NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `link` varchar(255) NOT NULL default '',
  `localization` varchar(255) NOT NULL default '',
  `new_window` tinyint(3) NOT NULL default '0',
  `related_ids` text,
  `use_avail_period` char(1) NOT NULL default 'N',
  `avail_from_timestamp` int(11) unsigned NOT NULL default '0',
  `avail_till_timestamp` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`page_id`),
  KEY `localization` (`localization`),
  KEY `parent_id` (`parent_id`),
  KEY `registred_only` (`registred_only`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payment_descriptions;
CREATE TABLE `cscart_payment_descriptions` (
  `payment_id` mediumint(8) unsigned NOT NULL default '0',
  `payment` varchar(128) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`payment_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payment_processors;
CREATE TABLE `cscart_payment_processors` (
  `processor_id` mediumint(8) unsigned NOT NULL auto_increment,
  `processor` varchar(255) NOT NULL default '',
  `processor_script` varchar(255) NOT NULL default '',
  `processor_template` varchar(255) NOT NULL default '',
  `admin_template` varchar(255) NOT NULL default '',
  `callback` char(1) NOT NULL default 'N',
  `type` char(1) NOT NULL default 'P',
  PRIMARY KEY  (`processor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payments;
CREATE TABLE `cscart_payments` (
  `payment_id` mediumint(8) unsigned NOT NULL auto_increment,
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `template` varchar(128) NOT NULL default '',
  `processor_id` mediumint(8) unsigned NOT NULL default '0',
  `params` text NOT NULL,
  `a_surcharge` decimal(9,3) NOT NULL default '0.000',
  `p_surcharge` decimal(9,3) NOT NULL default '0.000',
  `localization` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`payment_id`),
  KEY `c_status` (`membership_id`,`status`),
  KEY `position` (`position`),
  KEY `localization` (`localization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_poll_descriptions;
CREATE TABLE `cscart_poll_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `type` char(1) NOT NULL default 'P',
  `description` text NOT NULL,
  PRIMARY KEY  (`object_id`,`lang_code`,`type`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_poll_items;
CREATE TABLE `cscart_poll_items` (
  `item_id` mediumint(8) unsigned NOT NULL auto_increment,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default 'Q',
  `position` smallint(5) NOT NULL default '0',
  `required` char(1) NOT NULL default '',
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`item_id`),
  KEY `parent_id` (`parent_id`),
  KEY `type` (`type`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_polls;
CREATE TABLE `cscart_polls` (
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  `start_date` int(11) unsigned NOT NULL default '0',
  `end_date` int(11) unsigned NOT NULL default '0',
  `show_results` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_polls_answers;
CREATE TABLE `cscart_polls_answers` (
  `answer_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_id` mediumint(8) unsigned NOT NULL default '0',
  `item_id` mediumint(8) unsigned NOT NULL default '0',
  `comment` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`answer_id`,`vote_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_polls_votes;
CREATE TABLE `cscart_polls_votes` (
  `vote_id` mediumint(8) unsigned NOT NULL auto_increment,
  `page_id` mediumint(8) unsigned NOT NULL default '0',
  `ip_address` varchar(15) NOT NULL default '',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  `type` char(1) NOT NULL default '',
  PRIMARY KEY  (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_privilege_descriptions;
CREATE TABLE `cscart_privilege_descriptions` (
  `privilege` varchar(24) NOT NULL default '',
  `description` varchar(128) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `section` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`privilege`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_privileges;
CREATE TABLE `cscart_privileges` (
  `privilege` varchar(24) NOT NULL default '',
  `is_default` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_descriptions;
CREATE TABLE `cscart_product_descriptions` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `product` varchar(255) NOT NULL default '',
  `shortname` varchar(255) NOT NULL default '',
  `short_description` text NOT NULL,
  `full_description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` varchar(255) NOT NULL default '',
  `search_words` text NOT NULL,
  `page_title` varchar(255) NOT NULL default '',
  `age_warning_message` text NOT NULL,
  PRIMARY KEY  (`product_id`,`lang_code`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_feature_variant_descriptions;
CREATE TABLE `cscart_product_feature_variant_descriptions` (
  `variant_id` mediumint(8) unsigned NOT NULL default '0',
  `variant` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `page_title` varchar(255) NOT NULL default '',
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`variant_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_feature_variants;
CREATE TABLE `cscart_product_feature_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL auto_increment,
  `feature_id` mediumint(8) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`variant_id`),
  KEY `feature_id` (`feature_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features;
CREATE TABLE `cscart_product_features` (
  `feature_id` mediumint(8) unsigned NOT NULL auto_increment,
  `feature_type` char(1) NOT NULL default 'T',
  `categories_path` varchar(255) NOT NULL default '',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `display_on_product` tinyint(1) unsigned NOT NULL default '1',
  `display_on_catalog` tinyint(1) unsigned NOT NULL default '1',
  `status` char(1) NOT NULL default 'A',
  `position` smallint(5) unsigned NOT NULL default '0',
  `comparison` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`feature_id`),
  KEY `categories_path` (`categories_path`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features_descriptions;
CREATE TABLE `cscart_product_features_descriptions` (
  `feature_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `full_description` text NOT NULL,
  `prefix` varchar(128) NOT NULL default '',
  `suffix` varchar(128) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`feature_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features_values;
CREATE TABLE `cscart_product_features_values` (
  `feature_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `variant_id` mediumint(8) unsigned default NULL,
  `value` varchar(255) NOT NULL default '',
  `value_int` int(11) unsigned default NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  KEY `fl` (`feature_id`,`lang_code`,`variant_id`,`value`,`value_int`),
  KEY `variant_id` (`variant_id`),
  KEY `lang_code` (`lang_code`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_file_descriptions;
CREATE TABLE `cscart_product_file_descriptions` (
  `file_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `file_name` varchar(255) NOT NULL default '',
  `license` text NOT NULL,
  `readme` text NOT NULL,
  PRIMARY KEY  (`file_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_file_ekeys;
CREATE TABLE `cscart_product_file_ekeys` (
  `ekey` varchar(32) NOT NULL default '',
  `file_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `downloads` mediumint(8) unsigned NOT NULL default '0',
  `active` char(1) NOT NULL default 'N',
  `ttl` int(11) NOT NULL default '0',
  PRIMARY KEY  (`file_id`,`order_id`),
  UNIQUE KEY `ekey` (`ekey`),
  KEY `ttl` (`ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_files;
CREATE TABLE `cscart_product_files` (
  `file_id` mediumint(8) unsigned NOT NULL auto_increment,
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `file_path` varchar(255) NOT NULL default '',
  `preview_path` varchar(255) NOT NULL default '',
  `file_size` int(11) unsigned NOT NULL default '0',
  `preview_size` int(11) unsigned NOT NULL default '0',
  `agreement` char(1) NOT NULL default 'N',
  `max_downloads` smallint(5) unsigned NOT NULL default '0',
  `total_downloads` smallint(5) unsigned NOT NULL default '0',
  `activation_type` char(1) NOT NULL default 'M',
  `position` smallint(5) NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`file_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_descriptions;
CREATE TABLE `cscart_product_filter_descriptions` (
  `filter_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `filter` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`filter_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_ranges;
CREATE TABLE `cscart_product_filter_ranges` (
  `range_id` mediumint(8) unsigned NOT NULL auto_increment,
  `feature_id` mediumint(8) unsigned NOT NULL default '0',
  `filter_id` mediumint(8) unsigned NOT NULL default '0',
  `from` int(11) NOT NULL default '0',
  `to` int(11) NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`range_id`),
  KEY `from` (`from`,`to`),
  KEY `filter_id` (`filter_id`),
  KEY `feature_id` (`feature_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_ranges_descriptions;
CREATE TABLE `cscart_product_filter_ranges_descriptions` (
  `range_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `range_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`range_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filters;
CREATE TABLE `cscart_product_filters` (
  `filter_id` mediumint(8) unsigned NOT NULL auto_increment,
  `categories_path` varchar(255) NOT NULL default '',
  `feature_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  `field_type` char(1) NOT NULL default '',
  `show_on_home_page` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`filter_id`),
  KEY `feature_id` (`feature_id`),
  KEY `categories_path` (`categories_path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_global_option_links;
CREATE TABLE `cscart_product_global_option_links` (
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`option_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_option_variants;
CREATE TABLE `cscart_product_option_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL auto_increment,
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  `modifier` decimal(9,3) NOT NULL default '0.000',
  `modifier_type` char(1) NOT NULL default 'A',
  `weight_modifier` decimal(9,3) NOT NULL default '0.000',
  `weight_modifier_type` char(1) NOT NULL default 'A',
  `point_modifier` decimal(9,3) NOT NULL default '0.000',
  `point_modifier_type` char(1) NOT NULL default 'A',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`variant_id`),
  KEY `position` (`position`),
  KEY `status` (`status`),
  KEY `option_id` (`option_id`,`status`),
  KEY `option_id_2` (`option_id`,`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_option_variants_descriptions;
CREATE TABLE `cscart_product_option_variants_descriptions` (
  `variant_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `variant_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`variant_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options;
CREATE TABLE `cscart_product_options` (
  `option_id` mediumint(8) unsigned NOT NULL auto_increment,
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `option_type` char(1) NOT NULL default 'S',
  `inventory` char(1) NOT NULL default 'Y',
  `regexp` varchar(255) NOT NULL default '',
  `required` char(1) NOT NULL default 'N',
  `status` char(1) NOT NULL default 'A',
  `position` smallint(5) unsigned NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`option_id`),
  KEY `c_status` (`product_id`,`status`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_descriptions;
CREATE TABLE `cscart_product_options_descriptions` (
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `option_name` varchar(64) NOT NULL default '',
  `option_text` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `inner_hint` varchar(255) NOT NULL default '',
  `incorrect_message` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`option_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_exceptions;
CREATE TABLE `cscart_product_options_exceptions` (
  `exception_id` mediumint(8) unsigned NOT NULL auto_increment,
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `combination` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`exception_id`),
  KEY `product` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_inventory;
CREATE TABLE `cscart_product_options_inventory` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `product_code` varchar(32) NOT NULL default '',
  `combination_hash` int(11) unsigned NOT NULL default '0',
  `combination` varchar(255) NOT NULL default '',
  `amount` mediumint(8) NOT NULL default '0',
  `temp` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`combination_hash`),
  KEY `pc` (`product_id`,`combination`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_point_prices;
CREATE TABLE `cscart_product_point_prices` (
  `point_price_id` mediumint(8) unsigned NOT NULL auto_increment,
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `point_price` mediumint(8) unsigned NOT NULL default '0',
  `lower_limit` smallint(5) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`point_price_id`),
  UNIQUE KEY `unique_key` (`lower_limit`,`membership_id`,`product_id`),
  KEY `src_k` (`product_id`,`lower_limit`,`membership_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_popularity;
CREATE TABLE `cscart_product_popularity` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `viewed` int(11) NOT NULL default '0',
  `added` int(11) NOT NULL default '0',
  `deleted` int(11) NOT NULL default '0',
  `bought` int(11) NOT NULL default '0',
  `total` int(11) NOT NULL default '0',
  PRIMARY KEY  (`product_id`),
  KEY `total` (`product_id`,`total`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_prices;
CREATE TABLE `cscart_product_prices` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `price` decimal(12,2) NOT NULL default '0.00',
  `lower_limit` smallint(5) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  UNIQUE KEY `membership` (`product_id`,`membership_id`,`lower_limit`),
  KEY `product_id` (`product_id`),
  KEY `lower_limit` (`lower_limit`),
  KEY `membership_id` (`membership_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_required_products;
CREATE TABLE `cscart_product_required_products` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `required_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`product_id`,`required_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_sales;
CREATE TABLE `cscart_product_sales` (
  `category_id` mediumint(8) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`,`product_id`),
  KEY `pa` (`product_id`,`amount`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_products;
CREATE TABLE `cscart_products` (
  `product_id` mediumint(8) unsigned NOT NULL auto_increment,
  `product_code` varchar(32) NOT NULL default '',
  `product_type` char(1) NOT NULL default 'P',
  `owner_id` mediumint(8) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `list_price` decimal(9,2) NOT NULL default '0.00',
  `amount` mediumint(8) NOT NULL default '0',
  `min_amount` mediumint(8) unsigned NOT NULL default '0',
  `weight` decimal(12,2) NOT NULL default '0.00',
  `length` mediumint(8) unsigned NOT NULL default '0',
  `width` mediumint(8) unsigned NOT NULL default '0',
  `height` mediumint(8) unsigned NOT NULL default '0',
  `shipping_freight` decimal(9,2) NOT NULL default '0.00',
  `low_avail_limit` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `is_edp` char(1) NOT NULL default 'N',
  `edp_shipping` char(1) NOT NULL default 'N',
  `unlimited_download` char(1) NOT NULL default 'N',
  `tracking` char(1) NOT NULL default 'B',
  `free_shipping` char(1) NOT NULL default 'N',
  `feature_comparison` char(1) NOT NULL default 'N',
  `zero_price_action` char(1) NOT NULL default 'R',
  `is_pbp` char(1) NOT NULL default 'N',
  `is_op` char(1) NOT NULL default 'N',
  `is_oper` char(1) NOT NULL default 'N',
  `supplier_id` mediumint(8) unsigned NOT NULL default '0',
  `is_returnable` char(1) NOT NULL default 'Y',
  `return_period` int(11) unsigned NOT NULL default '10',
  `avail_since` int(11) unsigned NOT NULL default '0',
  `buy_in_advance` char(1) NOT NULL default 'N',
  `localization` varchar(255) NOT NULL default '',
  `min_qty` smallint(5) NOT NULL default '0',
  `max_qty` smallint(5) NOT NULL default '0',
  `qty_step` smallint(5) NOT NULL default '0',
  `list_qty_count` smallint(5) NOT NULL default '0',
  `tax_ids` varchar(255) NOT NULL default '',
  `age_verification` char(1) NOT NULL default 'N',
  `age_limit` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`product_id`),
  KEY `age_verification` (`age_verification`,`age_limit`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_products_categories;
CREATE TABLE `cscart_products_categories` (
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `category_id` mediumint(8) unsigned NOT NULL default '0',
  `link_type` char(1) NOT NULL default 'M',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`,`product_id`),
  KEY `link_type` (`link_type`),
  KEY `pt` (`product_id`,`link_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_field_descriptions;
CREATE TABLE `cscart_profile_field_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `object_type` char(1) NOT NULL default 'F',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`object_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_field_values;
CREATE TABLE `cscart_profile_field_values` (
  `value_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_fields;
CREATE TABLE `cscart_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_name` varchar(32) NOT NULL default '',
  `profile_show` char(1) default 'N',
  `profile_required` char(1) default 'N',
  `checkout_show` char(1) default 'N',
  `checkout_required` char(1) default 'N',
  `partner_show` char(1) default 'N',
  `partner_required` char(1) default 'N',
  `supplier_show` char(1) default 'N',
  `supplier_required` char(1) default 'N',
  `field_type` char(1) NOT NULL default 'I',
  `position` smallint(5) unsigned NOT NULL default '0',
  `is_default` char(1) default 'N',
  `section` char(1) default 'C',
  `matching_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`field_id`),
  KEY `field_name` (`field_name`),
  KEY `checkout_show` (`checkout_show`,`field_type`),
  KEY `profile_show` (`profile_show`,`field_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_fields_data;
CREATE TABLE `cscart_profile_fields_data` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `object_type` char(1) NOT NULL default 'U',
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `value` varchar(255) NOT NULL default '0',
  PRIMARY KEY  (`object_id`,`object_type`,`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_promotion_descriptions;
CREATE TABLE `cscart_promotion_descriptions` (
  `promotion_id` mediumint(8) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `short_description` text NOT NULL,
  `detailed_description` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`promotion_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_promotions;
CREATE TABLE `cscart_promotions` (
  `promotion_id` mediumint(8) unsigned NOT NULL auto_increment,
  `conditions` text NOT NULL,
  `bonuses` text NOT NULL,
  `to_date` int(11) unsigned NOT NULL default '0',
  `from_date` int(11) unsigned NOT NULL default '0',
  `priority` mediumint(8) unsigned NOT NULL default '0',
  `stop` char(1) NOT NULL default 'N',
  `zone` enum('cart','catalog') NOT NULL default 'catalog',
  `conditions_hash` text NOT NULL,
  `status` char(1) NOT NULL default 'A',
  `number_of_usages` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`promotion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_quick_menu;
CREATE TABLE `cscart_quick_menu` (
  `menu_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_reward_point_changes;
CREATE TABLE `cscart_reward_point_changes` (
  `change_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` mediumint(8) NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `action` char(1) NOT NULL default 'A',
  `reason` text NOT NULL,
  PRIMARY KEY  (`change_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_reward_points;
CREATE TABLE `cscart_reward_points` (
  `reward_point_id` mediumint(8) unsigned NOT NULL auto_increment,
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` mediumint(8) unsigned NOT NULL default '0',
  `amount_type` char(1) NOT NULL default 'A',
  `object_type` char(1) NOT NULL default 'P',
  PRIMARY KEY  (`reward_point_id`),
  UNIQUE KEY `unique_key` (`object_id`,`membership_id`,`object_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_rma_properties;
CREATE TABLE `cscart_rma_properties` (
  `property_id` mediumint(8) unsigned NOT NULL auto_increment,
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'R',
  `update_totals_and_inventory` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`property_id`),
  KEY `c_status` (`property_id`,`status`),
  KEY `status` (`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_rma_property_descriptions;
CREATE TABLE `cscart_rma_property_descriptions` (
  `property_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `property` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`property_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_rma_return_products;
CREATE TABLE `cscart_rma_return_products` (
  `return_id` mediumint(8) unsigned NOT NULL default '0',
  `item_id` int(11) unsigned NOT NULL default '0',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `reason` mediumint(8) unsigned NOT NULL default '0',
  `amount` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default 'A',
  `price` decimal(9,2) NOT NULL default '0.00',
  `product_options` text,
  PRIMARY KEY  (`return_id`,`item_id`,`type`),
  KEY `reason` (`reason`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_rma_returns;
CREATE TABLE `cscart_rma_returns` (
  `return_id` mediumint(8) unsigned NOT NULL auto_increment,
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `action` mediumint(8) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'O',
  `total_amount` mediumint(8) unsigned NOT NULL default '0',
  `comment` text,
  `extra` text,
  PRIMARY KEY  (`return_id`),
  KEY `order_id` (`order_id`),
  KEY `timestamp` (`timestamp`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports;
CREATE TABLE `cscart_sales_reports` (
  `report_id` mediumint(8) unsigned NOT NULL auto_increment,
  `position` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `type` char(1) NOT NULL default '',
  `period` varchar(2) NOT NULL default 'A',
  `time_from` int(11) NOT NULL default '0',
  `time_to` int(11) NOT NULL default '0',
  PRIMARY KEY  (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_descriptions;
CREATE TABLE `cscart_sales_reports_descriptions` (
  `report_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`report_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_elements;
CREATE TABLE `cscart_sales_reports_elements` (
  `element_id` mediumint(8) unsigned NOT NULL auto_increment,
  `code` varchar(66) NOT NULL default '',
  `type` char(1) NOT NULL default 'O',
  `depend_on_it` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_intervals;
CREATE TABLE `cscart_sales_reports_intervals` (
  `interval_id` mediumint(8) unsigned NOT NULL auto_increment,
  `value` mediumint(8) unsigned NOT NULL default '0',
  `interval_code` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`interval_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_conditions;
CREATE TABLE `cscart_sales_reports_table_conditions` (
  `table_id` mediumint(8) unsigned NOT NULL default '0',
  `code` varchar(64) NOT NULL default '0',
  `sub_element_id` varchar(16) NOT NULL default '0',
  PRIMARY KEY  (`table_id`,`code`,`sub_element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_descriptions;
CREATE TABLE `cscart_sales_reports_table_descriptions` (
  `table_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`table_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_element_conditions;
CREATE TABLE `cscart_sales_reports_table_element_conditions` (
  `table_id` mediumint(8) unsigned NOT NULL default '0',
  `element_hash` varchar(32) NOT NULL default '',
  `element_code` varchar(64) NOT NULL default '',
  `ids` varchar(16) NOT NULL default '',
  PRIMARY KEY  (`table_id`,`element_hash`,`ids`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_elements;
CREATE TABLE `cscart_sales_reports_table_elements` (
  `report_id` mediumint(8) unsigned NOT NULL default '0',
  `table_id` mediumint(8) unsigned NOT NULL default '0',
  `element_id` mediumint(8) unsigned NOT NULL default '0',
  `element_hash` int(11) NOT NULL default '0',
  `color` varchar(64) NOT NULL default 'blueviolet',
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `dependence` varchar(64) NOT NULL default 'max_p',
  `limit_auto` mediumint(8) unsigned NOT NULL default '5',
  PRIMARY KEY  (`report_id`,`table_id`,`element_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_tables;
CREATE TABLE `cscart_sales_reports_tables` (
  `table_id` mediumint(8) unsigned NOT NULL auto_increment,
  `report_id` mediumint(8) unsigned NOT NULL default '0',
  `position` smallint(5) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default 'T',
  `display` varchar(64) NOT NULL default 'order_amount',
  `interval_id` mediumint(8) unsigned NOT NULL default '0',
  `auto` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`table_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_seo_names;
CREATE TABLE `cscart_seo_names` (
  `name` varchar(255) NOT NULL default '',
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default '',
  PRIMARY KEY  (`object_id`,`type`),
  KEY `name` (`name`),
  KEY `type` (`name`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sessions;
CREATE TABLE `cscart_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `expiry` int(11) unsigned NOT NULL default '0',
  `data` text,
  `area` char(1) NOT NULL default 'C',
  PRIMARY KEY  (`session_id`,`area`),
  KEY `src` (`session_id`,`expiry`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings;
CREATE TABLE `cscart_settings` (
  `option_id` mediumint(8) unsigned NOT NULL auto_increment,
  `option_name` varchar(64) NOT NULL default '',
  `section_id` varchar(64) NOT NULL default '',
  `subsection_id` varchar(64) NOT NULL default '',
  `option_type` char(1) NOT NULL default 'I',
  `value` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `is_global` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`option_id`),
  KEY `is_global` (`is_global`),
  KEY `position` (`position`),
  KEY `section_id` (`section_id`,`subsection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_descriptions;
CREATE TABLE `cscart_settings_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `object_type` char(1) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `object_string_id` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`object_id`,`object_string_id`,`lang_code`,`object_type`),
  KEY `object_id` (`object_id`,`object_type`,`lang_code`),
  KEY `object_string_id` (`object_string_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_elements;
CREATE TABLE `cscart_settings_elements` (
  `element_id` mediumint(8) unsigned NOT NULL auto_increment,
  `section_id` varchar(32) NOT NULL default '',
  `subsection_id` varchar(32) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `element_type` char(1) NOT NULL default '',
  `handler` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_sections;
CREATE TABLE `cscart_settings_sections` (
  `section_id` varchar(32) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_subsections;
CREATE TABLE `cscart_settings_subsections` (
  `subsection_id` varchar(32) NOT NULL default '',
  `section_id` varchar(32) NOT NULL default '',
  `position` smallint(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`subsection_id`,`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_variants;
CREATE TABLE `cscart_settings_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL auto_increment,
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `variant_name` varchar(64) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_descriptions;
CREATE TABLE `cscart_shipping_descriptions` (
  `shipping_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `shipping` varchar(255) NOT NULL default '',
  `delivery_time` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`shipping_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_rates;
CREATE TABLE `cscart_shipping_rates` (
  `rate_id` mediumint(8) unsigned NOT NULL auto_increment,
  `shipping_id` mediumint(8) unsigned NOT NULL default '0',
  `destination_id` mediumint(8) unsigned NOT NULL default '0',
  `rate_value` text NOT NULL,
  PRIMARY KEY  (`rate_id`),
  UNIQUE KEY `shipping_rate` (`shipping_id`,`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_service_descriptions;
CREATE TABLE `cscart_shipping_service_descriptions` (
  `service_id` mediumint(8) unsigned NOT NULL auto_increment,
  `description` varchar(255) NOT NULL default '',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`service_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_services;
CREATE TABLE `cscart_shipping_services` (
  `service_id` mediumint(8) unsigned NOT NULL auto_increment,
  `intershipper_code` varchar(3) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `carrier` varchar(10) NOT NULL default '',
  `module` varchar(32) NOT NULL default '',
  `code` varchar(64) NOT NULL default '',
  `sp_file` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`service_id`),
  KEY `sa` (`service_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shippings;
CREATE TABLE `cscart_shippings` (
  `shipping_id` mediumint(8) unsigned NOT NULL auto_increment,
  `destination` char(1) NOT NULL default 'I',
  `min_weight` decimal(12,2) NOT NULL default '0.00',
  `max_weight` decimal(12,2) NOT NULL default '0.00',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `rate_calculation` char(1) NOT NULL default 'M',
  `service_id` mediumint(8) unsigned NOT NULL default '0',
  `localization` varchar(255) NOT NULL default '',
  `tax_ids` varchar(255) NOT NULL default '',
  `supplier_ids` varchar(255) NOT NULL default '',
  `position` smallint(5) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'D',
  UNIQUE KEY `shipping_id` (`shipping_id`),
  KEY `position` (`position`),
  KEY `localization` (`localization`),
  KEY `c_status` (`membership_id`,`min_weight`,`max_weight`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sitemap_descriptions;
CREATE TABLE `cscart_sitemap_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `object_name` varchar(255) NOT NULL default '',
  `object_description` text NOT NULL,
  `object_type` char(1) NOT NULL default 'S',
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`object_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sitemap_links;
CREATE TABLE `cscart_sitemap_links` (
  `link_id` mediumint(8) unsigned NOT NULL auto_increment,
  `link_href` varchar(255) NOT NULL default '',
  `section_id` mediumint(8) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'A',
  `position` smallint(5) unsigned NOT NULL default '0',
  `link_type` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sitemap_sections;
CREATE TABLE `cscart_sitemap_sections` (
  `section_id` mediumint(8) unsigned NOT NULL auto_increment,
  `status` char(1) NOT NULL default 'A',
  `section_type` varchar(255) NOT NULL default '1',
  `position` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_banners_log;
CREATE TABLE `cscart_stat_banners_log` (
  `banner_id` mediumint(8) NOT NULL default '0',
  `type` char(1) NOT NULL default 'C',
  `timestamp` int(11) NOT NULL default '0',
  KEY `banner_id` (`banner_id`,`type`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_browsers;
CREATE TABLE `cscart_stat_browsers` (
  `browser_id` mediumint(8) unsigned NOT NULL auto_increment,
  `browser` varchar(50) NOT NULL default '',
  `version` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`browser_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_ips;
CREATE TABLE `cscart_stat_ips` (
  `ip_id` mediumint(8) unsigned NOT NULL auto_increment,
  `ip` int(11) unsigned NOT NULL default '0',
  `country_code` varchar(2) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`ip_id`),
  KEY `country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_languages;
CREATE TABLE `cscart_stat_languages` (
  `lang_code` varchar(5) NOT NULL default '',
  `language` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_product_search;
CREATE TABLE `cscart_stat_product_search` (
  `sess_id` mediumint(8) unsigned NOT NULL default '0',
  `search_string` text NOT NULL,
  `md5` varchar(32) NOT NULL default '',
  `quantity` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sess_id`,`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_requests;
CREATE TABLE `cscart_stat_requests` (
  `req_id` mediumint(8) unsigned NOT NULL auto_increment,
  `timestamp` int(11) unsigned NOT NULL default '0',
  `url` text NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `https` char(1) NOT NULL default 'N',
  `loadtime` int(11) unsigned NOT NULL default '0',
  `sess_id` mediumint(8) unsigned NOT NULL default '0',
  `request_type` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`req_id`),
  KEY `sess_id` (`sess_id`),
  KEY `request_type` (`request_type`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_search_engines;
CREATE TABLE `cscart_stat_search_engines` (
  `engine_id` mediumint(8) unsigned NOT NULL auto_increment,
  `engine` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`engine_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_search_phrases;
CREATE TABLE `cscart_stat_search_phrases` (
  `phrase_id` mediumint(8) unsigned NOT NULL auto_increment,
  `phrase` text NOT NULL,
  PRIMARY KEY  (`phrase_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_search_robots;
CREATE TABLE `cscart_stat_search_robots` (
  `robot_id` mediumint(8) unsigned NOT NULL auto_increment,
  `id` varchar(64) NOT NULL default '',
  `name` varchar(128) NOT NULL default '',
  `cover_url` varchar(255) NOT NULL default '',
  `details_url` varchar(255) NOT NULL default '',
  `owner_name` varchar(128) NOT NULL default '',
  `owner_url` varchar(255) NOT NULL default '',
  `owner_email` varchar(64) NOT NULL default '',
  `status` varchar(64) NOT NULL default '',
  `purpose` varchar(64) NOT NULL default '',
  `type` varchar(64) NOT NULL default '',
  `platform` varchar(64) NOT NULL default '',
  `availability` varchar(64) NOT NULL default '',
  `exclusion` varchar(64) NOT NULL default '',
  `exclusion_useragent` varchar(255) NOT NULL default '',
  `noindex` varchar(64) NOT NULL default '',
  `host` varchar(32) NOT NULL default '',
  `robot_from` varchar(64) NOT NULL default '',
  `useragent` varchar(255) NOT NULL default '',
  `language` varchar(32) NOT NULL default '',
  `description` text NOT NULL,
  `history` text NOT NULL,
  `environment` varchar(64) NOT NULL default '',
  `modified_date` int(11) unsigned NOT NULL default '0',
  `modified_by` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`robot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stat_sessions;
CREATE TABLE `cscart_stat_sessions` (
  `sess_id` mediumint(8) unsigned NOT NULL auto_increment,
  `os` varchar(30) NOT NULL default '',
  `client_type` char(1) NOT NULL default 'U',
  `browser_id` mediumint(8) unsigned NOT NULL default '0',
  `robot_id` mediumint(8) unsigned NOT NULL default '0',
  `user_agent` varchar(255) NOT NULL default '',
  `screen_x` smallint(5) unsigned NOT NULL default '0',
  `screen_y` smallint(5) unsigned NOT NULL default '0',
  `color` tinyint(3) unsigned NOT NULL default '0',
  `client_language` varchar(5) NOT NULL default '',
  `session` varchar(32) NOT NULL default '',
  `host_ip` int(11) unsigned NOT NULL default '0',
  `proxy_ip` int(11) unsigned NOT NULL default '0',
  `ip_id` mediumint(8) unsigned NOT NULL default '0',
  `uniq_code` int(11) unsigned NOT NULL default '0',
  `referrer` text NOT NULL,
  `referrer_scheme` varchar(32) NOT NULL default '',
  `referrer_host` varchar(128) NOT NULL default '',
  `engine_id` mediumint(8) unsigned NOT NULL default '0',
  `phrase_id` mediumint(8) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `expiry` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sess_id`),
  KEY `session` (`session`,`expiry`),
  KEY `browser_id` (`browser_id`),
  KEY `ip_id` (`ip_id`),
  KEY `engine_id` (`engine_id`),
  KEY `phrase_id` (`phrase_id`),
  KEY `robot_id` (`robot_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_state_descriptions;
CREATE TABLE `cscart_state_descriptions` (
  `state_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `state` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`state_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_states;
CREATE TABLE `cscart_states` (
  `state_id` mediumint(8) unsigned NOT NULL auto_increment,
  `country_code` varchar(2) NOT NULL default '',
  `code` varchar(32) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`state_id`),
  UNIQUE KEY `cs` (`country_code`,`code`),
  KEY `code` (`code`),
  KEY `country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_static_data;
CREATE TABLE `cscart_static_data` (
  `param_id` mediumint(8) unsigned NOT NULL auto_increment,
  `param` varchar(255) NOT NULL default '',
  `param_2` varchar(255) NOT NULL default '',
  `param_3` varchar(255) NOT NULL default '',
  `param_4` varchar(255) NOT NULL default '',
  `param_5` varchar(255) NOT NULL default '',
  `section` char(1) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `position` smallint(5) NOT NULL default '0',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `id_path` varchar(255) NOT NULL default '',
  `localization` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`param_id`),
  KEY `section` (`section`,`status`,`localization`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_static_data_descriptions;
CREATE TABLE `cscart_static_data_descriptions` (
  `param_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `descr` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`param_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_status_data;
CREATE TABLE `cscart_status_data` (
  `status` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'O',
  `param` char(255) NOT NULL default '',
  `value` char(255) NOT NULL default 'Y',
  PRIMARY KEY  (`status`,`type`,`param`),
  KEY `inventory` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_status_descriptions;
CREATE TABLE `cscart_status_descriptions` (
  `status` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'O',
  `description` varchar(255) NOT NULL default '',
  `email_subj` varchar(255) NOT NULL default '',
  `email_header` text NOT NULL,
  `lang_code` varchar(2) NOT NULL default 'EN',
  PRIMARY KEY  (`status`,`type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_statuses;
CREATE TABLE `cscart_statuses` (
  `status` char(1) NOT NULL default '',
  `type` char(1) NOT NULL default 'O',
  `is_default` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_store_location_descriptions;
CREATE TABLE `cscart_store_location_descriptions` (
  `store_location_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default '',
  `name` varchar(80) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `city` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`store_location_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_store_locations;
CREATE TABLE `cscart_store_locations` (
  `store_location_id` mediumint(8) unsigned NOT NULL auto_increment,
  `position` smallint(5) NOT NULL default '0',
  `country` varchar(2) NOT NULL default '',
  `latitude` double NOT NULL default '0',
  `longitude` double NOT NULL default '0',
  `localization` varchar(255) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  PRIMARY KEY  (`store_location_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stored_sessions;
CREATE TABLE `cscart_stored_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `expiry` int(11) unsigned NOT NULL default '0',
  `data` text NOT NULL,
  `area` char(1) NOT NULL default 'C',
  PRIMARY KEY  (`session_id`,`area`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_subscribers;
CREATE TABLE `cscart_subscribers` (
  `subscriber_id` mediumint(8) unsigned NOT NULL auto_increment,
  `email` varchar(128) NOT NULL default '',
  `timestamp` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`subscriber_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tag_links;
CREATE TABLE `cscart_tag_links` (
  `tag_id` mediumint(8) unsigned NOT NULL default '0',
  `object_type` char(1) NOT NULL default 'P',
  `object_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`object_type`,`object_id`,`user_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  KEY `user_id` (`user_id`),
  KEY `ids` (`tag_id`,`user_id`,`object_type`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tags;
CREATE TABLE `cscart_tags` (
  `tag_id` mediumint(8) unsigned NOT NULL auto_increment,
  `tag` varchar(255) NOT NULL default '',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default 'P',
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tax_descriptions;
CREATE TABLE `cscart_tax_descriptions` (
  `tax_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `tax` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`tax_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tax_rates;
CREATE TABLE `cscart_tax_rates` (
  `rate_id` mediumint(8) unsigned NOT NULL auto_increment,
  `tax_id` mediumint(8) unsigned NOT NULL default '0',
  `destination_id` mediumint(8) unsigned NOT NULL default '0',
  `apply_to` varchar(64) NOT NULL default '',
  `rate_value` decimal(9,3) NOT NULL default '0.000',
  `rate_type` char(1) NOT NULL default '',
  `owner_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`rate_id`),
  UNIQUE KEY `tax_rate` (`tax_id`,`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_taxes;
CREATE TABLE `cscart_taxes` (
  `tax_id` mediumint(8) unsigned NOT NULL auto_increment,
  `address_type` char(1) NOT NULL default 'S',
  `status` char(1) NOT NULL default 'D',
  `price_includes_tax` char(1) NOT NULL default 'N',
  `display_including_tax` char(1) NOT NULL default 'N',
  `display_info` char(1) NOT NULL default '',
  `regnumber` varchar(255) NOT NULL default '',
  `priority` mediumint(8) unsigned NOT NULL default '0',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`tax_id`),
  KEY `c_status` (`membership_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_data;
CREATE TABLE `cscart_user_data` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default '',
  `data` text NOT NULL,
  PRIMARY KEY  (`user_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_mailing_lists;
CREATE TABLE `cscart_user_mailing_lists` (
  `subscriber_id` mediumint(8) unsigned NOT NULL default '0',
  `list_id` mediumint(8) unsigned NOT NULL default '0',
  `activation_key` varchar(32) NOT NULL default '',
  `unsubscribe_key` varchar(32) NOT NULL default '',
  `confirmed` tinyint(3) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `format` tinyint(3) unsigned NOT NULL default '0',
  UNIQUE KEY `subscriber_list` (`list_id`,`subscriber_id`),
  KEY `subscriber_id` (`subscriber_id`),
  KEY `list_id` (`list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_profiles;
CREATE TABLE `cscart_user_profiles` (
  `profile_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `profile_type` char(1) NOT NULL default 'P',
  `b_title` varchar(32) NOT NULL default '',
  `b_firstname` varchar(128) NOT NULL default '',
  `b_lastname` varchar(128) NOT NULL default '',
  `b_address` varchar(255) NOT NULL default '',
  `b_address_2` varchar(255) NOT NULL default '',
  `b_city` varchar(64) NOT NULL default '',
  `b_county` varchar(32) NOT NULL default '',
  `b_state` varchar(32) NOT NULL default '',
  `b_country` varchar(2) NOT NULL default '',
  `b_zipcode` varchar(16) NOT NULL default '',
  `s_title` varchar(32) NOT NULL default '',
  `s_firstname` varchar(128) NOT NULL default '',
  `s_lastname` varchar(128) NOT NULL default '',
  `s_address` varchar(255) NOT NULL default '',
  `s_address_2` varchar(255) NOT NULL default '',
  `s_city` varchar(255) NOT NULL default '',
  `s_county` varchar(32) NOT NULL default '',
  `s_state` varchar(32) NOT NULL default '',
  `s_country` varchar(2) NOT NULL default '',
  `s_zipcode` varchar(16) NOT NULL default '',
  `profile_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`profile_id`),
  KEY `uid_p` (`user_id`,`profile_type`),
  KEY `profile_type` (`profile_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_session_products;
CREATE TABLE `cscart_user_session_products` (
  `user_id` int(11) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `type` char(1) NOT NULL default 'C',
  `user_type` char(1) NOT NULL default 'R',
  `item_id` int(11) unsigned NOT NULL default '0',
  `item_type` char(1) NOT NULL default 'P',
  `product_id` mediumint(8) unsigned NOT NULL default '0',
  `amount` mediumint(8) unsigned NOT NULL default '1',
  `price` decimal(9,2) NOT NULL default '0.00',
  `extra` text NOT NULL,
  `session_id` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`user_id`,`type`,`item_id`,`user_type`),
  KEY `timestamp` (`timestamp`,`user_type`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_users;
CREATE TABLE `cscart_users` (
  `user_id` mediumint(8) unsigned NOT NULL auto_increment,
  `status` char(1) NOT NULL default 'A',
  `user_type` char(1) NOT NULL default 'Y',
  `user_login` varchar(255) NOT NULL default '',
  `membership_status` char(1) NOT NULL default 'P',
  `membership_id` mediumint(8) unsigned NOT NULL default '0',
  `referer` varchar(255) NOT NULL default '',
  `last_login` int(11) unsigned NOT NULL default '0',
  `timestamp` int(11) unsigned NOT NULL default '0',
  `password` varchar(32) NOT NULL default '',
  `card_name` varchar(255) NOT NULL default '',
  `card_type` varchar(16) NOT NULL default '',
  `card_number` varchar(42) NOT NULL default '',
  `card_expire` varchar(4) NOT NULL default '',
  `card_cvv2` varchar(3) NOT NULL default '',
  `title` varchar(24) NOT NULL default '',
  `firstname` varchar(128) NOT NULL default '',
  `lastname` varchar(128) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `phone` varchar(32) NOT NULL default '',
  `fax` varchar(32) NOT NULL default '',
  `url` varchar(128) NOT NULL default '',
  `tax_exempt` char(1) NOT NULL default 'N',
  `lang_code` varchar(2) NOT NULL default 'EN',
  `birthday` int(11) NOT NULL default '0',
  `purchase_timestamp_from` int(11) NOT NULL default '0',
  `purchase_timestamp_to` int(11) NOT NULL default '0',
  `credit_value` decimal(12,2) NOT NULL default '0.00',
  `responsible_email` varchar(80) NOT NULL default '',
  `credit_used` decimal(12,2) NOT NULL default '0.00',
  PRIMARY KEY  (`user_id`),
  KEY `user_login` (`user_login`),
  KEY `uname` (`title`,`firstname`,`lastname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_views;
CREATE TABLE `cscart_views` (
  `view_id` mediumint(8) unsigned NOT NULL auto_increment,
  `object` varchar(16) NOT NULL default '',
  `name` varchar(32) NOT NULL default '',
  `params` text NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `active` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`view_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

