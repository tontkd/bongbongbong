{* $Id: manage.tpl 7695 2009-07-13 06:26:40Z alexions $ *}

{capture name="mainbox"}
{if $mode == "new"}
	<p>{$lang.text_admin_new_orders}</p>
{/if}

{include file="views/orders/components/orders_search_form.tpl" dispatch="orders.manage"}

<form action="{$index_script}" method="post" target="_self" name="orders_list_form">

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{if $settings.DHTML.admin_ajax_based_pagination == "Y"}
	{assign var="ajax_class" value="cm-ajax"}
{/if}

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="5%"><a class="{$ajax_class}{if $search.sort_by == "order_id"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=order_id&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.id}</a></th>
	<th width="5%"><a class="{$ajax_class}{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=status&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.status}</a></th>
	<th width="30%"><a class="{$ajax_class}{if $search.sort_by == "customer"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=customer&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.customer}</a></th>
	<th width="30%"><a class="{$ajax_class}{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=email&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.email}</a></th>
	<th><a class="{$ajax_class}{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=date&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.date}</a>
	</th>
	<th class="right" width="20%"><a class="{$ajax_class}{if $search.sort_by == "total"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=total&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.total}</a></th>
	<th>&nbsp;</th>
</tr>
{assign var="order_status_descr" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true}
{foreach from=$orders item="o"}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
		<input type="checkbox" name="order_ids[]" value="{$o.order_id}" class="checkbox cm-item" /></td>
	<td>
		<a href="{$index_script}?dispatch=orders.details&amp;order_id={$o.order_id}" class="underlined">&nbsp;<strong>#{$o.order_id}</strong>&nbsp;</a></td>
	<td>
		{include file="common_templates/select_popup.tpl" suffix="o" id=$o.order_id status=$o.status items_status=$order_status_descr update_controller="orders" notify=true status_rev="orders_total"}
	</td>
	<td>{if $o.user_id}<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$o.user_id}">{/if}{$o.firstname} {$o.lastname}{if $o.user_id}</a>{/if}</td>
	<td><a href="mailto:{$o.email}">{$o.email}</a></td>
	<td class="nowrap">
		{$o.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td class="right">
		{include file="common_templates/price.tpl" value=$o.total}</td>
	<td class="nowrap">
		<a class="tool-link" href="{$index_script}?dispatch=orders.details&amp;order_id={$o.order_id}">{$lang.view}</a>
		{capture name="tools_items"}
		<ul>
			{hook name="orders:list_extra_links"}
			<li><a href="{$index_script}?dispatch=order_management.edit&amp;order_id={$o.order_id}">{$lang.edit}</a></li>
			<li><a class="cm-confirm" href="{$index_script}?dispatch=orders.delete&amp;order_id={$o.order_id}&amp;redirect_url={$config.current_url|escape:url}">{$lang.delete}</a></li>
			{/hook}
		</ul>
		{/capture}

		{if $smarty.capture.tools_items|strpos:"<li>"}&nbsp;&nbsp;|
			{include file="common_templates/tools.tpl" prefix=$o.order_id hide_actions=true tools_list=$smarty.capture.tools_items display="inline" link_text=$lang.more link_meta="lowercase"}
		{/if}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="9"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $orders}
	{include file="common_templates/table_tools.tpl" href="#orders"}
{/if}

{include file="common_templates/pagination.tpl"}
	
{if $orders}
	<div align="right" class="clear" id="orders_total">
		<ul class="statistic-list">
			{if $total_pages > 1 && $search.page != "full_list"}
			<li><strong>{$lang.for_this_page_orders}:</strong></li>
			<li>
				<em>{$lang.gross_total}:</em>
				<strong>{include file="common_templates/price.tpl" value=$display_totals.gross_total}</strong>
			</li>
			<li>
				<em>{$lang.totally_paid}:</em>
				<strong>{include file="common_templates/price.tpl" value=$display_totals.totally_paid}</strong>
			</li>
			<hr />
			{/if}
			{if $total_pages > 1 && $search.page != "full_list"}
			<li><strong>{$lang.for_all_found_orders}:</strong></li>
			{/if}
			<li>
				<em>{$lang.gross_total}:</em>
				<strong>{include file="common_templates/price.tpl" value=$totals.gross_total}</strong>
			</li>
			{hook name="orders:totals_stats"}
			<li class="total">
				<em>{$lang.totally_paid}:</em>
				<strong>{include file="common_templates/price.tpl" value=$totals.totally_paid}</strong>
			</li>
			{/hook}
		</ul>
	<!--orders_total--></div>
{/if}
	
<div class="buttons-container buttons-bg">
	{if $orders}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a class="cm-process-items" name="dispatch[orders.remove_cc_info]" rev="orders_list_form">{$lang.remove_cc_info}</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.export_range]" rev="orders_list_form">{$lang.export_selected}</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.packing_slip]" rev="orders_list_form">{$lang.bulk_print} ({$lang.packing_slip})</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.bulk_print..pdf]" rev="orders_list_form">{$lang.bulk_print} (PDF)</a></li>
			{hook name="orders:list_tools"}
			{/hook}
			<li><a class="cm-confirm cm-process-items" name="dispatch[orders.delete_orders]" rev="orders_list_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/button.tpl" but_text=$lang.bulk_print but_name="dispatch[orders.bulk_print]" but_meta="cm-process-items cm-new-window" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
	
	<div class="float-right">
		{include file="common_templates/tools.tpl" tool_href="$index_script?dispatch=order_management.new" prefix="bottom" hide_tools="true" link_text=$lang.add_order}
	</div>
</div>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="$index_script?dispatch=order_management.new" prefix="top" hide_tools="true" link_text=$lang.add_order}
{/capture}

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.orders content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}
