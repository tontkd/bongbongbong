{* $Id: index.tpl 7688 2009-07-10 05:58:05Z zeke $ *}

{capture name="mainbox"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
<td width="64%">

<div class="statistics-box orders">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.latest_orders}
	{assign var="order_status_descr" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true}
	<div class="statistics-body">
		{if $latest_orders}
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			{foreach from=$latest_orders item="order"}
			<tr valign="top">
				<td width="15%">
				{assign var="status_descr" value=$order.status}
				<span class="order-status order-{$order.status|lower}"><em>{$order_status_descr.$status_descr}</em></span>
				</td>
				<td width="85%">
				<a href="{$index_script}?dispatch=orders.details&amp;order_id={$order.order_id}">{$lang.order}&nbsp;#{$order.order_id}</a> {$lang.by} {if $order.user_id}<a href="{$index_script}?dispatch=profiles.update&amp;user_id={$order.user_id}">{/if}{$order.firstname} {$order.lastname}{if $order.user_id}</a>{/if} {$lang.for} <strong>{include file="common_templates/price.tpl" value=$order.total}</strong>
				<p class="not-approved-text">{$order.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</p>
				</td>
			</tr>
			{/foreach}
		</table>
		{else}
			<p class="no-items">{$lang.no_items}</p>
		{/if}
	</div>
</div>

<div class="statistics-box statistic">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.orders_statistics}
	
	<div class="statistics-body">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th>{$lang.status}</th>
		<th class="center">{$lang.this_day}</th>
		<th class="center">{$lang.this_week}</th>
		<th class="center">{$lang.this_month}</th>
		<th class="center">{$lang.this_year}</th>
	</tr>
	{foreach from=$order_statuses item="status" key="_status"}
	<tr {cycle values="class=\"table-row\", "}>
		<td>{include file="common_templates/status.tpl" status=$_status display="view"}</td>
		<td class="center">{if $orders_stats.daily_orders.$_status.amount}<a href="{$index_script}?dispatch=orders.manage&amp;status%5B%5D={$_status}&amp;period=D">{$orders_stats.daily_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.weekly_orders.$_status.amount}<a href="{$index_script}?dispatch=orders.manage&amp;status%5B%5D={$_status}&amp;period=W">{$orders_stats.weekly_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.monthly_orders.$_status.amount}<a href="{$index_script}?dispatch=orders.manage&amp;status%5B%5D={$_status}&amp;period=M">{$orders_stats.monthly_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.year_orders.$_status.amount}<a href="{$index_script}?dispatch=orders.manage&amp;status%5B%5D={$_status}&amp;period=Y">{$orders_stats.year_orders.$_status.amount}</a>{else}0{/if}</td>
	</tr>
	{/foreach}
	<tr {cycle values="class=\"table-row\", "}>
		<td><strong>{$lang.total_orders}</strong></td>
		<td class="center">{if $orders_stats.daily_orders.totals.amount}<a href="{$index_script}?dispatch=orders.manage&amp;period=D">{$orders_stats.daily_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.weekly_orders.totals.amount}<a href="{$index_script}?dispatch=orders.manage&amp;period=W">{$orders_stats.weekly_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.monthly_orders.totals.amount}<a href="{$index_script}?dispatch=orders.manage&amp;period=M">{$orders_stats.monthly_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.year_orders.totals.amount}<a href="{$index_script}?dispatch=orders.manage&amp;period=Y">{$orders_stats.year_orders.totals.amount}</a>{else}0{/if}</td>
	</tr>
	<tr class="strong">
		<td>{$lang.gross_total}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.daily_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.year_orders.totals.total|default:"0"}</td>
	</tr>
	<tr class="strong">
		<td>{$lang.totally_paid}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.daily_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.year_orders.totals.total_paid|default:"0"}</td>
	</tr>

	</table>
	</div>
</div>

{hook name="index:extra"}
{/hook}

</td>

<td class="spacer">&nbsp;</td>

<td width="34%">
<div class="statistics-box inventory">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.inventory}
	
	<div class="statistics-body">
		<p class="strong">{$lang.category_inventory}:</p>
		<div class="clear">
			<ul class="float-left">
				<li>{$lang.total}:&nbsp;{if $category_stats.total}<strong>{$category_stats.total}</strong>{else}0{/if}</li>
				<li>{$lang.active}:&nbsp;{if $category_stats.status.A}<strong>{$category_stats.status.A}</strong>{else}0{/if}</li>
			</ul>
			<ul>
				<li>{$lang.hidden}:&nbsp;{if $category_stats.status.H}<strong>{$category_stats.status.H}</strong>{else}0{/if}</li>
				<li>{$lang.disabled}:&nbsp;{if $category_stats.status.D}<strong>{$category_stats.status.D}</strong>{else}0{/if}</li>
			</ul>
		</div>
		
		<p class="strong">{$lang.product_inventory}:</p>
		<div class="clear">
			<ul class="float-left">
				<li>{$lang.total}:&nbsp;{if $product_stats.total}<a href="{$index_script}?dispatch=products.manage">{$product_stats.total}</a>{else}0{/if}</li>
				{hook name="index:inventory"}
				{/hook}
				<li>{$lang.in_stock}:&nbsp;{if $product_stats.in_stock}<a href="{$index_script}?dispatch=products.manage&amp;amount_from=1&amp;amount_to=&amp;tracking[]=B&amp;tracking[]=O">{$product_stats.in_stock}</a>{else}0{/if}</li>
				<li>{$lang.active}:&nbsp;{if $product_stats.status.A}<a href="{$index_script}?dispatch=products.manage&amp;status=A">{$product_stats.status.A}</a>{else}0{/if}</li>
			</ul>
			<ul>
				<li>{$lang.downloadable}:&nbsp;{if $product_stats.downloadable}<a href="{$index_script}?dispatch=products.manage&amp;downloadable=Y">{$product_stats.downloadable}</a>{else}0{/if}</li>
				<li>{$lang.text_out_of_stock}:&nbsp;{if $product_stats.out_of_stock}<a href="{$index_script}?dispatch=products.manage&amp;amount_from=&amp;amount_to=0&amp;tracking[]=B&amp;tracking[]=O">{$product_stats.out_of_stock}</a>{else}0{/if}</li>
				<li>{$lang.hidden}:&nbsp;{if $product_stats.status.H}<a href="{$index_script}?dispatch=products.manage&amp;status=H">{$product_stats.status.H}</a>{else}0{/if}</li>
				<li>{$lang.free_shipping}:&nbsp;{if $product_stats.free_shipping}<a href="{$index_script}?dispatch=products.manage&amp;type=extended&amp;match=any&amp;free_shipping=Y">{$product_stats.free_shipping}</a>{else}0{/if}</li>
			</ul>
		</div>
	</div>
</div>

<div class="statistics-box users">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.users}
	
	<div class="statistics-body clear">
	<ul>
		<li>
			<span><strong>{$lang.customers}:</strong></span>
			<em>{if $users_stats.total.C}<a href="{$index_script}?dispatch=profiles.manage&amp;user_type=C">{$users_stats.total.C}</a>{else}0{/if}</em>
		</li>

		{if $memberships_type.C}
		<li>
			<span>{$lang.not_a_member}:</span>
			<em>{if $users_stats.not_members.C}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=C">{$users_stats.not_members.C}</a>{else}0{/if}</em>
		</li>
		{/if}

		{foreach from=$memberships key="mem_id" item="mem_name"}
		{if $mem_name.type == "C"}
			<li>
				<span>{$mem_name.membership}:</span>
				<em>{if $users_stats.membership.C.$mem_id}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id={$mem_id}">{$users_stats.membership.C.$mem_id}</a>{else}0{/if}</em>
			</li>
		{/if}
		{/foreach}

		<li>
			<span><strong>{$lang.administrators}:</strong></span>
			<em>{if $users_stats.total.A}<a href="{$index_script}?dispatch=profiles.manage&amp;user_type=A">{$users_stats.total.A}</a>{else}0{/if}</em>
		</li>

		{if $memberships_type.A}
		<li>
			<span>{$lang.root_administrators}:</span>
			<em>{if $users_stats.not_members.A}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=A">{$users_stats.not_members.A}</a>{else}0{/if}</em>
		</li>
		{/if}

		{foreach from=$memberships key="mem_id" item="mem_name"}
		{if $mem_name.type == "A"}
			<li>
				<span>{$mem_name.membership}:</span>
				<em>{if $users_stats.membership.A.$mem_id}<a href="{$index_script}?dispatch=profiles.manage&amp;membership_id={$mem_id}">{$users_stats.membership.A.$mem_id}</a>{else}0{/if}</em>
			</li>
		{/if}
		{/foreach}

		{hook name="index:users"}
		{/hook}
		
		<li><hr /></li>
		
		<li>
			<span><strong>{$lang.total}:</strong></span>
			<em>{if $users_stats.total_all}<a href="{$index_script}?dispatch=profiles.manage">{$users_stats.total_all}</a>{else}0{/if}</em>
		</li>

		<li>
			<span>{$lang.disabled}:</span>
			<em>{if $users_stats.not_approved}<a href="{$index_script}?dispatch=profiles.manage&amp;status=D">{$users_stats.not_approved}</a>{else}0{/if}</em>
		</li>
	</ul>
	</div>
</div>

<div class="statistics-box">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.shortcuts}
	
	<div class="statistics-body clear">
		<ul class="arrow-list float-left">
			<li><a href="{$index_script}?dispatch=settings.manage">{$lang.general_settings}</a></li>
			<li><a href="{$index_script}?dispatch=database.manage">{$lang.db_backup_restore}</a></li>
			<li><a href="{$index_script}?dispatch=pages.add&amp;parent_id=0">{$lang.add_inf_page}</a></li>
			<li><a href="{$index_script}?dispatch=site_layout.manage">{$lang.site_layout}</a></li>
		</ul>
	
		<ul class="arrow-list float-left">
			<li><a href="{$index_script}?dispatch=shippings.manage">{$lang.shipping_methods}</a></li>
			<li><a href="{$index_script}?dispatch=payments.manage">{$lang.payment_methods}</a></li>
			<li><a href="{$index_script}?dispatch=products.manage">{$lang.manage_products}</a></li>
			<li><a href="{$index_script}?dispatch=categories.manage">{$lang.manage_categories}</a></li>
		</ul>
	</div>
</div>
</td>
</tr>
</table>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.dashboard content=$smarty.capture.mainbox}
