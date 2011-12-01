<?php /* Smarty version 2.6.18, created on 2011-11-30 23:29:35
         compiled from views/index/index.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/index/index.tpl', 1, false),array('modifier', 'fn_get_statuses', 'views/index/index.tpl', 19, false),array('modifier', 'lower', 'views/index/index.tpl', 27, false),array('modifier', 'format_price', 'views/index/index.tpl', 33, false),array('modifier', 'unescape', 'views/index/index.tpl', 33, false),array('modifier', 'date_format', 'views/index/index.tpl', 38, false),array('function', 'cycle', 'views/index/index.tpl', 70, false),array('function', 'html_options', 'views/index/index.tpl', 82, false),array('function', 'html_checkboxes', 'views/index/index.tpl', 85, false),array('block', 'hook', 'views/index/index.tpl', 178, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('latest_orders','hide','hide','close','close','order','by','for','no_items','orders_statistics','hide','hide','close','close','status','this_day','this_week','this_month','this_year','total_orders','gross_total','totally_paid','inventory','hide','hide','close','close','category_inventory','total','active','hidden','disabled','product_inventory','total','configurable','in_stock','active','downloadable','text_out_of_stock','hidden','free_shipping','users','hide','hide','close','close','customers','not_a_member','administrators','root_administrators','affiliates','not_a_member','total','disabled','shortcuts','hide','hide','close','close','general_settings','db_backup_restore','add_inf_page','site_layout','shipping_methods','payment_methods','manage_products','manage_categories','dashboard'));
?>

<?php ob_start(); ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
<td width="64%">

<div class="statistics-box orders">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('latest_orders', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php $this->assign('order_status_descr', fn_get_statuses(@STATUSES_ORDER, true), false); ?>
	<div class="statistics-body">
		<?php if ($__tpl_vars['latest_orders']): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_from_2814269876 = & $__tpl_vars['latest_orders']; if (!is_array($_from_2814269876) && !is_object($_from_2814269876)) { settype($_from_2814269876, 'array'); }if (count($_from_2814269876)):
    foreach ($_from_2814269876 as $__tpl_vars['order']):
?>
			<tr valign="top">
				<td width="15%">
				<?php $this->assign('status_descr', $__tpl_vars['order']['status'], false); ?>
				<span class="order-status order-<?php echo smarty_modifier_lower($__tpl_vars['order']['status']); ?>
"><em><?php echo $__tpl_vars['order_status_descr'][$__tpl_vars['status_descr']]; ?>
</em></span>
				</td>
				<td width="85%">
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.details&amp;order_id=<?php echo $__tpl_vars['order']['order_id']; ?>
"><?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
&nbsp;#<?php echo $__tpl_vars['order']['order_id']; ?>
</a> <?php echo fn_get_lang_var('by', $this->getLanguage()); ?>
 <?php if ($__tpl_vars['order']['user_id']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['order']['user_id']; ?>
"><?php endif; ?><?php echo $__tpl_vars['order']['firstname']; ?>
 <?php echo $__tpl_vars['order']['lastname']; ?>
<?php if ($__tpl_vars['order']['user_id']): ?></a><?php endif; ?> <?php echo fn_get_lang_var('for', $this->getLanguage()); ?>
 <strong><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['order']['total'], )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong>
				<p class="not-approved-text"><?php echo smarty_modifier_date_format($__tpl_vars['order']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
</p>
				</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</table>
		<?php else: ?>
			<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>
		<?php endif; ?>
	</div>
</div>

<div class="statistics-box statistic">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('orders_statistics', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_day', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_week', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_month', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_year', $this->getLanguage()); ?>
</th>
	</tr>
	<?php $_from_884052944 = & $__tpl_vars['order_statuses']; if (!is_array($_from_884052944) && !is_object($_from_884052944)) { settype($_from_884052944, 'array'); }if (count($_from_884052944)):
    foreach ($_from_884052944 as $__tpl_vars['_status'] => $__tpl_vars['status']):
?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
		<td><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('status' => $__tpl_vars['_status'], 'display' => 'view', )); ?>

<?php if (! $__tpl_vars['order_status_descr']): ?>
	<?php if (! $__tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($__tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['display'] == 'view'): ?><?php echo $__tpl_vars['order_status_descr'][$__tpl_vars['status']]; ?><?php elseif ($__tpl_vars['display'] == 'select'): ?><?php echo smarty_function_html_options(array('name' => $__tpl_vars['name'],'options' => $__tpl_vars['order_status_descr'],'selected' => $__tpl_vars['status'],'id' => $__tpl_vars['select_id']), $this);?><?php elseif ($__tpl_vars['display'] == 'checkboxes'): ?><div><?php echo smarty_function_html_checkboxes(array('name' => $__tpl_vars['name'],'options' => $__tpl_vars['order_status_descr'],'selected' => $__tpl_vars['status'],'columns' => 4), $this);?></div><?php endif; ?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['daily_orders'][$__tpl_vars['_status']]['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;status%5B%5D=<?php echo $__tpl_vars['_status']; ?>
&amp;period=D"><?php echo $__tpl_vars['orders_stats']['daily_orders'][$__tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['weekly_orders'][$__tpl_vars['_status']]['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;status%5B%5D=<?php echo $__tpl_vars['_status']; ?>
&amp;period=W"><?php echo $__tpl_vars['orders_stats']['weekly_orders'][$__tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['monthly_orders'][$__tpl_vars['_status']]['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;status%5B%5D=<?php echo $__tpl_vars['_status']; ?>
&amp;period=M"><?php echo $__tpl_vars['orders_stats']['monthly_orders'][$__tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['year_orders'][$__tpl_vars['_status']]['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;status%5B%5D=<?php echo $__tpl_vars['_status']; ?>
&amp;period=Y"><?php echo $__tpl_vars['orders_stats']['year_orders'][$__tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
		<td><strong><?php echo fn_get_lang_var('total_orders', $this->getLanguage()); ?>
</strong></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['daily_orders']['totals']['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;period=D"><?php echo $__tpl_vars['orders_stats']['daily_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['weekly_orders']['totals']['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;period=W"><?php echo $__tpl_vars['orders_stats']['weekly_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['monthly_orders']['totals']['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;period=M"><?php echo $__tpl_vars['orders_stats']['monthly_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($__tpl_vars['orders_stats']['year_orders']['totals']['amount']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;period=Y"><?php echo $__tpl_vars['orders_stats']['year_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
	</tr>
	<tr class="strong">
		<td><?php echo fn_get_lang_var('gross_total', $this->getLanguage()); ?>
</td>
		<td class="center"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['daily_orders']['totals']['total'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['weekly_orders']['totals']['total'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['monthly_orders']['totals']['total'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['year_orders']['totals']['total'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<tr class="strong">
		<td><?php echo fn_get_lang_var('totally_paid', $this->getLanguage()); ?>
</td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['daily_orders']['totals']['total_paid'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['weekly_orders']['totals']['total_paid'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['monthly_orders']['totals']['total_paid'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => smarty_modifier_default(@$__tpl_vars['orders_stats']['year_orders']['totals']['total_paid'], '0'), )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>

	</table>
	</div>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/index/extra.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</td>

<td class="spacer">&nbsp;</td>

<td width="34%">
<div class="statistics-box inventory">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('inventory', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body">
		<p class="strong"><?php echo fn_get_lang_var('category_inventory', $this->getLanguage()); ?>
:</p>
		<div class="clear">
			<ul class="float-left">
				<li><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['category_stats']['total']): ?><strong><?php echo $__tpl_vars['category_stats']['total']; ?>
</strong><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['category_stats']['status']['A']): ?><strong><?php echo $__tpl_vars['category_stats']['status']['A']; ?>
</strong><?php else: ?>0<?php endif; ?></li>
			</ul>
			<ul>
				<li><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['category_stats']['status']['H']): ?><strong><?php echo $__tpl_vars['category_stats']['status']['H']; ?>
</strong><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['category_stats']['status']['D']): ?><strong><?php echo $__tpl_vars['category_stats']['status']['D']; ?>
</strong><?php else: ?>0<?php endif; ?></li>
			</ul>
		</div>
		
		<p class="strong"><?php echo fn_get_lang_var('product_inventory', $this->getLanguage()); ?>
:</p>
		<div class="clear">
			<ul class="float-left">
				<li><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['total']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage"><?php echo $__tpl_vars['product_stats']['total']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<?php $this->_tag_stack[] = array('hook', array('name' => "index:inventory")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<li><?php echo fn_get_lang_var('configurable', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['configurable']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;type=extended&amp;match=any&amp;configurable=C"><?php echo $__tpl_vars['product_stats']['configurable']; ?>
</a><?php else: ?>0<?php endif; ?></li><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<li><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['in_stock']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;amount_from=1&amp;amount_to=&amp;tracking[]=B&amp;tracking[]=O"><?php echo $__tpl_vars['product_stats']['in_stock']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['status']['A']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;status=A"><?php echo $__tpl_vars['product_stats']['status']['A']; ?>
</a><?php else: ?>0<?php endif; ?></li>
			</ul>
			<ul>
				<li><?php echo fn_get_lang_var('downloadable', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['downloadable']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;downloadable=Y"><?php echo $__tpl_vars['product_stats']['downloadable']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['out_of_stock']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;amount_from=&amp;amount_to=0&amp;tracking[]=B&amp;tracking[]=O"><?php echo $__tpl_vars['product_stats']['out_of_stock']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['status']['H']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;status=H"><?php echo $__tpl_vars['product_stats']['status']['H']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:&nbsp;<?php if ($__tpl_vars['product_stats']['free_shipping']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage&amp;type=extended&amp;match=any&amp;free_shipping=Y"><?php echo $__tpl_vars['product_stats']['free_shipping']; ?>
</a><?php else: ?>0<?php endif; ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="statistics-box users">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('users', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body clear">
	<ul>
		<li>
			<span><strong><?php echo fn_get_lang_var('customers', $this->getLanguage()); ?>
:</strong></span>
			<em><?php if ($__tpl_vars['users_stats']['total']['C']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;user_type=C"><?php echo $__tpl_vars['users_stats']['total']['C']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>

		<?php if ($__tpl_vars['memberships_type']['C']): ?>
		<li>
			<span><?php echo fn_get_lang_var('not_a_member', $this->getLanguage()); ?>
:</span>
			<em><?php if ($__tpl_vars['users_stats']['not_members']['C']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=C"><?php echo $__tpl_vars['users_stats']['not_members']['C']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>
		<?php endif; ?>

		<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['mem_id'] => $__tpl_vars['mem_name']):
?>
		<?php if ($__tpl_vars['mem_name']['type'] == 'C'): ?>
			<li>
				<span><?php echo $__tpl_vars['mem_name']['membership']; ?>
:</span>
				<em><?php if ($__tpl_vars['users_stats']['membership']['C'][$__tpl_vars['mem_id']]): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=<?php echo $__tpl_vars['mem_id']; ?>
"><?php echo $__tpl_vars['users_stats']['membership']['C'][$__tpl_vars['mem_id']]; ?>
</a><?php else: ?>0<?php endif; ?></em>
			</li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<li>
			<span><strong><?php echo fn_get_lang_var('administrators', $this->getLanguage()); ?>
:</strong></span>
			<em><?php if ($__tpl_vars['users_stats']['total']['A']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;user_type=A"><?php echo $__tpl_vars['users_stats']['total']['A']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>

		<?php if ($__tpl_vars['memberships_type']['A']): ?>
		<li>
			<span><?php echo fn_get_lang_var('root_administrators', $this->getLanguage()); ?>
:</span>
			<em><?php if ($__tpl_vars['users_stats']['not_members']['A']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=A"><?php echo $__tpl_vars['users_stats']['not_members']['A']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>
		<?php endif; ?>

		<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['mem_id'] => $__tpl_vars['mem_name']):
?>
		<?php if ($__tpl_vars['mem_name']['type'] == 'A'): ?>
			<li>
				<span><?php echo $__tpl_vars['mem_name']['membership']; ?>
:</span>
				<em><?php if ($__tpl_vars['users_stats']['membership']['A'][$__tpl_vars['mem_id']]): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=<?php echo $__tpl_vars['mem_id']; ?>
"><?php echo $__tpl_vars['users_stats']['membership']['A'][$__tpl_vars['mem_id']]; ?>
</a><?php else: ?>0<?php endif; ?></em>
			</li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php $this->_tag_stack[] = array('hook', array('name' => "index:users")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($__tpl_vars['addons']['affiliate']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<li>
	<span><strong><?php echo fn_get_lang_var('affiliates', $this->getLanguage()); ?>
:</strong></span>
	<em><?php if ($__tpl_vars['users_stats']['total']['P']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;user_type=P"><?php echo $__tpl_vars['users_stats']['total']['P']; ?>
</a><?php else: ?>0<?php endif; ?></em>
</li>

<?php if ($__tpl_vars['memberships_type']['P']): ?>
<li>
	<span><?php echo fn_get_lang_var('not_a_member', $this->getLanguage()); ?>
:</span>
	<em><?php if ($__tpl_vars['users_stats']['not_members']['P']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=0&amp;user_type=P"><?php echo $__tpl_vars['users_stats']['not_members']['P']; ?>
</a><?php else: ?>0<?php endif; ?></em>
</li>
<?php endif; ?>

<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['mem_id'] => $__tpl_vars['mem_name']):
?>
<?php if ($__tpl_vars['mem_name']['type'] == 'P'): ?>
<li>
	<span><?php echo $__tpl_vars['mem_name']['membership']; ?>
:</span>
	<em><?php if ($__tpl_vars['users_stats']['membership']['P'][$__tpl_vars['mem_id']]): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;membership_id=<?php echo $__tpl_vars['mem_id']; ?>
"><?php echo $__tpl_vars['users_stats']['membership']['P'][$__tpl_vars['mem_id']]; ?>
</a><?php else: ?>0<?php endif; ?></em>
</li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<li><hr /></li>
		
		<li>
			<span><strong><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</strong></span>
			<em><?php if ($__tpl_vars['users_stats']['total_all']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage"><?php echo $__tpl_vars['users_stats']['total_all']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>

		<li>
			<span><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:</span>
			<em><?php if ($__tpl_vars['users_stats']['not_approved']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.manage&amp;status=D"><?php echo $__tpl_vars['users_stats']['not_approved']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>
	</ul>
	</div>
</div>

<div class="statistics-box">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('shortcuts', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body clear">
		<ul class="arrow-list float-left">
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=settings.manage"><?php echo fn_get_lang_var('general_settings', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=database.manage"><?php echo fn_get_lang_var('db_backup_restore', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=pages.add&amp;parent_id=0"><?php echo fn_get_lang_var('add_inf_page', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=site_layout.manage"><?php echo fn_get_lang_var('site_layout', $this->getLanguage()); ?>
</a></li>
		</ul>
	
		<ul class="arrow-list float-left">
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=shippings.manage"><?php echo fn_get_lang_var('shipping_methods', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=payments.manage"><?php echo fn_get_lang_var('payment_methods', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.manage"><?php echo fn_get_lang_var('manage_products', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.manage"><?php echo fn_get_lang_var('manage_categories', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>
</div>
</td>
</tr>
</table>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('dashboard', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>