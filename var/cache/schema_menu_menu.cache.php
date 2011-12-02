<?php
 if ( !defined('AREA') )	{ die('Access denied');	}
 $_cache_data = '<orders>
	<item title="view_orders" dispatch="orders.manage" alt="order_management"/>
	<item title="sales_reports" dispatch="sales_reports.reports" />
	<item title="order_statuses" dispatch="statuses.manage" extra="type=O" />

	<side>
		<item group="sales_reports.reports" title="manage_reports" href="%INDEX_SCRIPT?dispatch=sales_reports.reports_list" />
	</side>
</orders>

<catalog>
	<item title="categories" dispatch="categories.manage" />
	<item title="products" dispatch="products.manage" />
	<item title="product_features" dispatch="product_features.manage" />
	<item title="product_filters" dispatch="product_filters.manage" />
	<item title="global_options" dispatch="product_options.manage" />
	<item title="promotions" dispatch="promotions.manage" />

	<side>
		<item group="products.manage" title="global_update" href="%INDEX_SCRIPT?dispatch=products.global_update" />
		<item group="products.manage" title="bulk_product_addition" href="%INDEX_SCRIPT?dispatch=products.m_add" />
		
		<item group="categories.manage" title="bulk_category_addition" href="%INDEX_SCRIPT?dispatch=categories.m_add" />

		<item group="categories.update" title="add_subcategory" href="%INDEX_SCRIPT?dispatch=categories.add&amp;parent_id=%CATEGORY_ID" />
		<item group="categories.update" title="add_product" href="%INDEX_SCRIPT?dispatch=products.add&amp;category_id=%CATEGORY_ID" />
		<item group="categories.update" title="view_products" href="%INDEX_SCRIPT?dispatch=products.manage&amp;cid=%CATEGORY_ID" />
		<item group="categories.update" title="delete_this_category" href="%INDEX_SCRIPT?dispatch=categories.delete&amp;category_id=%CATEGORY_ID" meta="cm-confirm" />

		<item group="products.update" title="add_product" href="%INDEX_SCRIPT?dispatch=products.add" />
		<item group="products.update" title="clone_this_product" href="%INDEX_SCRIPT?dispatch=products.clone&amp;product_id=%PRODUCT_ID" />
		<item group="products.update" title="delete_this_product" href="%INDEX_SCRIPT?dispatch=products.delete&amp;product_id=%PRODUCT_ID" meta="cm-confirm" />
		
		<item group="product_options.global" title="apply_to_products" href="%INDEX_SCRIPT?dispatch=product_options.global.apply" />
	</side>
</catalog>

<users>
	<item title="users" links_group="users" dispatch="profiles.manage" />
	<item title="administrators" links_group="users" dispatch="profiles.manage" extra="user_type=A" />
	<item title="customers" links_group="users" dispatch="profiles.manage" extra="user_type=C" />
	<item title="profile_fields" dispatch="profile_fields.manage" />
	<item title="users_carts" dispatch="cart.cart_list" />
	<item title="memberships" dispatch="memberships.manage" />
</users>

<shippings_taxes>
	<item title="shipping_methods" dispatch="shippings.manage" />
	<item title="taxes" dispatch="taxes.manage" />
	<item title="states" dispatch="states.manage" />
	<item title="countries" dispatch="countries.manage" />
	<item title="locations" dispatch="destinations.manage" />
	<item title="localizations" dispatch="localizations.manage" />

	<side>
		<item group="shippings.manage" title="realtime_shippings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Shippings" />
		<item group="shippings.update" title="shipping_methods" href="%INDEX_SCRIPT?dispatch=shippings.manage" />
		<item group="shippings.update" title="realtime_shippings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Shippings" />
	</side>
</shippings_taxes>

<administration>
	<item title="settings" dispatch="settings.manage" />
	<item title="addons" dispatch="addons.manage" />
	<item title="payment_methods" dispatch="payments.manage" />
	<item title="database" dispatch="database.manage" />
	<item title="credit_cards" dispatch="static_data.manage" extra="section=C" />
	<item title="titles" dispatch="static_data.manage" extra="section=T" />
	<item title="currencies" dispatch="currencies.manage" />
	<item title="import_data" dispatch="exim.import" />
	<item title="export_data" dispatch="exim.export" />
	<item title="revisions" dispatch="revisions.manage" active_option="settings.General.active_revisions_objects" />
	<item title="workflow" dispatch="revisions_workflow.manage" active_option="settings.General.active_revisions_objects" />
	<item title="logs" dispatch="logs.manage" />
	<item title="upgrade_center" dispatch="upgrade_center.manage" />
	<side>
		<item group="upgrade_center.manage" title="settings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Upgrade_center" />
		<item group="upgrade_center.check" title="settings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Upgrade_center" />
		
		<item group="database.manage" title="logs" href="%INDEX_SCRIPT?dispatch=logs.manage" />
		<item group="database.manage" title="phpinfo" href="%INDEX_SCRIPT?dispatch=tools.phpinfo" target="_blank" />

		<item group="logs.manage" title="db_backup_restore" href="%INDEX_SCRIPT?dispatch=database.manage" />
		<item group="logs.manage" title="phpinfo" href="%INDEX_SCRIPT?dispatch=tools.phpinfo" target="_blank" />
		<item group="logs.manage" title="clean_logs" href="%INDEX_SCRIPT?dispatch=logs.clean" meta="cm-confirm" />
		<item group="logs.manage" title="settings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Logging" />

		<item group="exim.import" title="export" href="%INDEX_SCRIPT?dispatch=exim.export&amp;section=products" />

		<item group="exim.export" title="import" href="%INDEX_SCRIPT?dispatch=exim.import&amp;section=products" />
	</side>
</administration>

<design>
	<item title="site_layout" dispatch="site_layout.manage" />
	<item title="logos" dispatch="site_layout.logos" />
	<item title="design_mode" dispatch="site_layout.design_mode" />
	<item title="blocks" dispatch="block_manager.manage" />
	<item title="appearance_settings" dispatch="settings.manage" extra="section_id=Appearance" />
	<item title="quick_links" dispatch="static_data.manage" extra="section=N" />
	<item title="top_menu" dispatch="static_data.manage" extra="section=A" />
	<item title="sitemap" dispatch="sitemap.manage" />
	<item title="template_editor" dispatch="template_editor.manage" />
	<item title="skin_selector" dispatch="skin_selector.manage" />

	<side>
		<item group="sitemap" title="sitemap_settings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Sitemap" />

		<item group="languages.manage" title="translate_privileges" href="%INDEX_SCRIPT?dispatch=memberships.privileges" />
		<item group="sitemap.manage" title="sitemap_settings" href="%INDEX_SCRIPT?dispatch=settings.manage&amp;section_id=Sitemap" />
	</side>
</design>

<content>
	<item title="pages" links_group="pages" dispatch="pages.manage" extra="get_tree=multi_level"/>
	<item title="languages" dispatch="languages.manage" />

	<side>
		<item group="pages.update" title="delete_this_page" href="%INDEX_SCRIPT?dispatch=pages.delete&amp;page_id=%PAGE_ID" meta="cm-confirm" />
		<item group="pages.update" title="clone_this_page" href="%INDEX_SCRIPT?dispatch=pages.clone&amp;page_id=%PAGE_ID" />
		<item group="pages.update" title="add_page" href="%INDEX_SCRIPT?dispatch=pages.add&amp;page_type=T&amp;parent_id=%PAGE_ID" />
		<item group="pages.update" title="add_link" href="%INDEX_SCRIPT?dispatch=pages.add&amp;page_type=L&amp;parent_id=%PAGE_ID" />
	</side>
</content>
<content>
	<item title="tags" dispatch="tags.manage" />
</content>
<content>
	<item title="site_news" dispatch="news.manage" />
	<item title="newsletters" dispatch="newsletters.manage" />
	<item title="mailing_lists" dispatch="mailing_lists.manage" />
	<item title="subscribers" dispatch="subscribers.manage" />
</content>
<users>
	<item title="events" dispatch="events.search" />

	<side>
		<item group="events.search" title="custom_event_fields" href="%INDEX_SCRIPT?dispatch=events.field_editor" />

		<item group="events.add" title="search_for_events" href="%INDEX_SCRIPT?dispatch=events.search" />
		<item group="events.add" title="custom_event_fields" href="%INDEX_SCRIPT?dispatch=events.field_editor" />

		<item group="events.update" title="add_event" href="%INDEX_SCRIPT?dispatch=events.add" />
		<item group="events.update" title="search_for_events" href="%INDEX_SCRIPT?dispatch=events.search" />
		<item group="events.update" title="custom_event_fields" href="%INDEX_SCRIPT?dispatch=events.field_editor" />
	</side>
</users>
<orders>
	<item title="gift_certificates" dispatch="gift_certificates.manage" />

	<side>
		<item group="gift_certificates.add" title="gift_certificates" href="%INDEX_SCRIPT?dispatch=gift_certificates.manage" />

		<item group="gift_certificates.update" title="add_gift_certificate" href="%INDEX_SCRIPT?dispatch=gift_certificates.add" />
		<item group="gift_certificates.update" title="delete_this_certificate" href="%INDEX_SCRIPT?dispatch=gift_certificates.delete&amp;gift_cert_id=%GIFT_CERT_ID" meta="cm-confirm" />

		<item group="statuses.manage" extra="type=G" title="add_gift_certificate" href="%INDEX_SCRIPT?dispatch=gift_certificates.add" />

		<item group="profiles.update" extra="user_type=C" title="create_gift_certificate_for_customer" href="%INDEX_SCRIPT?dispatch=gift_certificates.add&amp;user_id=%USER_ID" />
	</side>
</orders>
<content>
	<item title="store_locator" privilege="" dispatch="store_locator.manage" />
</content>
<administration>
	<item title="statistics" dispatch="statistics.reports" />

	<side>		
		<item group="statistics" title="users_online" href="%INDEX_SCRIPT?dispatch=statistics.visitors&amp;section=general&amp;report=online" />
		<item group="statistics" title="remove_statistics" href="%INDEX_SCRIPT?dispatch=statistics.delete" meta="cm-confirm" />
	</side>

</administration>
<content>
	<side>
		<item group="pages.update" title="add_form" href="%INDEX_SCRIPT?dispatch=pages.add&amp;page_type=F&amp;parent_id=%PAGE_ID" />
	</side>
</content>
<content>
	<side>
		<item group="pages.update" title="add_poll" href="%INDEX_SCRIPT?dispatch=pages.add&amp;page_type=P&amp;parent_id=%PAGE_ID" />
	</side>
</content><administration>
	<item title="store_access" dispatch="access_restrictions.manage" />
</administration>
<content>
	<item title="banners" dispatch="banners.manage" />

	<side>
		<item group="banners.manage" title="banners_statistics" href="%INDEX_SCRIPT?dispatch=statistics.banners" />
	</side>
</content>
<content>
	<item title="comments_and_reviews" dispatch="discussion_manager.manage" />
</content>
'
?>