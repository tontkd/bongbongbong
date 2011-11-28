<?php /* Smarty version 2.6.18, created on 2011-11-28 12:20:58
         compiled from views/sales_reports/reports.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/sales_reports/reports.tpl', 2, false),array('function', 'cycle', 'views/sales_reports/reports.tpl', 92, false),array('function', 'math', 'views/sales_reports/reports.tpl', 180, false),array('modifier', 'fn_check_view_permissions', 'views/sales_reports/reports.tpl', 35, false),array('modifier', 'default', 'views/sales_reports/reports.tpl', 38, false),array('modifier', 'unescape', 'views/sales_reports/reports.tpl', 100, false),array('modifier', 'format_price', 'views/sales_reports/reports.tpl', 124, false),array('modifier', 'sizeof', 'views/sales_reports/reports.tpl', 165, false),array('modifier', 'escape', 'views/sales_reports/reports.tpl', 252, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('edit_report','remove_this_item','remove_this_item','no_data','table_conditions','upgrade_flash_player','upgrade_flash_player','upgrade_flash_player','no_data','no_data','reports'));
?>
<?php echo smarty_function_script(array('src' => "lib/amcharts/swfobject.js"), $this);?>


<div id="content_<?php echo $__tpl_vars['report']['report_id']; ?>
">

<?php ob_start(); ?>

<?php ob_start(); ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('edit_report', $this->getLanguage()), 'but_href' => ($__tpl_vars['index_script'])."?dispatch=sales_reports.table.edit&report_id=".($__tpl_vars['report_id'])."&table_id=".($__tpl_vars['table']['table_id']), 'but_role' => 'tool', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/sales_reports/components/sales_reports_search_form.tpl", 'smarty_include_vars' => array('period' => $__tpl_vars['report']['period'],'search' => $__tpl_vars['report'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<?php if ($__tpl_vars['report']): ?>

<?php ob_start(); ?>
<?php if ($__tpl_vars['report']['tables']): ?>
<?php $this->assign('table_id', $__tpl_vars['table']['table_id'], false); ?>
<?php $this->assign('table_prefix', "table_".($__tpl_vars['table_id']), false); ?>
<div id="content_table_<?php echo $__tpl_vars['table_id']; ?>
">

<?php if (! $__tpl_vars['table']['elements'] || $__tpl_vars['table']['empty_values'] == 'Y'): ?>

<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php elseif ($__tpl_vars['table']['type'] == 'T'): ?>

<?php if ($__tpl_vars['table_conditions'][$__tpl_vars['table_id']]): ?>
<p>
	<a id="sw_box_table_conditions_<?php echo $__tpl_vars['table_id']; ?>
" class="text-link text-button cm-combination"><?php echo fn_get_lang_var('table_conditions', $this->getLanguage()); ?>
</a>
</p>
<div id="box_table_conditions_<?php echo $__tpl_vars['table_id']; ?>
" class="hidden">
	<?php $_from_527757938 = & $__tpl_vars['table_conditions'][$__tpl_vars['table_id']]; if (!is_array($_from_527757938) && !is_object($_from_527757938)) { settype($_from_527757938, 'array'); }if (count($_from_527757938)):
    foreach ($_from_527757938 as $__tpl_vars['i']):
?>
	<div class="form-field">
	<label><?php echo $__tpl_vars['i']['name']; ?>
:</label>
	<?php $_from_1230185454 = & $__tpl_vars['i']['objects']; if (!is_array($_from_1230185454) && !is_object($_from_1230185454)) { settype($_from_1230185454, 'array'); }$this->_foreach['feco'] = array('total' => count($_from_1230185454), 'iteration' => 0);
if ($this->_foreach['feco']['total'] > 0):
    foreach ($_from_1230185454 as $__tpl_vars['o']):
        $this->_foreach['feco']['iteration']++;
?>
	<?php if ($__tpl_vars['o']['href']): ?><a href="<?php echo $__tpl_vars['o']['href']; ?>
"><?php endif; ?><?php echo $__tpl_vars['o']['name']; ?>
<?php if ($__tpl_vars['o']['href']): ?></a><?php endif; ?><?php if (! ($this->_foreach['feco']['iteration'] == $this->_foreach['feco']['total'])): ?>, <?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>

<?php if ($__tpl_vars['table']['interval_id'] != 1): ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<td width="300">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="100%"><?php echo $__tpl_vars['table']['parameter']; ?>
</th>
		</tr>
		<?php $_from_222484737 = & $__tpl_vars['table']['elements']; if (!is_array($_from_222484737) && !is_object($_from_222484737)) { settype($_from_222484737, 'array'); }if (count($_from_222484737)):
    foreach ($_from_222484737 as $__tpl_vars['element']):
?>
		<tr>
			<td><?php echo smarty_modifier_unescape($__tpl_vars['element']['description']); ?>
&nbsp;</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</td>
	<td>
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<div id="div_scroll_<?php echo $__tpl_vars['table_id']; ?>
" class="scroll-x">
		<table cellpadding="0" cellspacing="0" border="0" class="table no-left-border">
		<tr>
				<?php $_from_2239812971 = & $__tpl_vars['table']['intervals']; if (!is_array($_from_2239812971) && !is_object($_from_2239812971)) { settype($_from_2239812971, 'array'); }if (count($_from_2239812971)):
    foreach ($_from_2239812971 as $__tpl_vars['row']):
?>
				<th>&nbsp;<?php echo $__tpl_vars['row']['description']; ?>
&nbsp;</th>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php $_from_222484737 = & $__tpl_vars['table']['elements']; if (!is_array($_from_222484737) && !is_object($_from_222484737)) { settype($_from_222484737, 'array'); }if (count($_from_222484737)):
    foreach ($_from_222484737 as $__tpl_vars['element']):
?>
		<tr>
		<?php $this->assign('element_hash', $__tpl_vars['element']['element_hash'], false); ?>
				<?php $_from_2239812971 = & $__tpl_vars['table']['intervals']; if (!is_array($_from_2239812971) && !is_object($_from_2239812971)) { settype($_from_2239812971, 'array'); }if (count($_from_2239812971)):
    foreach ($_from_2239812971 as $__tpl_vars['row']):
?>
				<?php $this->assign('interval_id', $__tpl_vars['row']['interval_id'], false); ?>
				<td  class="center">
				<?php if ($__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']]): ?>
				<?php if ($__tpl_vars['table']['display'] != 'product_number' && $__tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']], )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']]; ?>
<?php endif; ?>
				<?php else: ?>-<?php endif; ?></td>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</div>
	</td>
</tr>
</table>

<?php else: ?>

<table cellpadding="0" cellspacing="0" border="0" width="500" class="table-fixed">
<tr>
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<td width="403" valign="top">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-bottom-border">
		<tr>
			<th><?php echo $__tpl_vars['table']['parameter']; ?>
</th>
		</tr>
		</table>
	</td>
	<td width="100">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-left-border no-bottom-border">
		<tr>
			<?php $_from_2239812971 = & $__tpl_vars['table']['intervals']; if (!is_array($_from_2239812971) && !is_object($_from_2239812971)) { settype($_from_2239812971, 'array'); }if (count($_from_2239812971)):
    foreach ($_from_2239812971 as $__tpl_vars['row']):
?>
			<?php $this->assign('interval_id', $__tpl_vars['row']['interval_id'], false); ?>
			<?php $this->assign('interval_name', "reports_interval_".($__tpl_vars['interval_id']), false); ?>
			<th class="center">&nbsp;<?php echo fn_get_lang_var($__tpl_vars['interval_name'], $this->getLanguage()); ?>
&nbsp;</th>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		</table>
	</td>
</tr>
</table>

<?php $this->assign('elements_count', sizeof($__tpl_vars['table']['elements']), false); ?>

<?php if ($__tpl_vars['elements_count'] > 14): ?>
<div id="div_scroll_<?php echo $__tpl_vars['table_id']; ?>
" class="reports-table-scroll">
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" class="table-fixed" width="500">
<tr valign="top">
	<td width="403" class="max-height no-padding">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-top-border">
		<?php $_from_222484737 = & $__tpl_vars['table']['elements']; if (!is_array($_from_222484737) && !is_object($_from_222484737)) { settype($_from_222484737, 'array'); }if (count($_from_222484737)):
    foreach ($_from_222484737 as $__tpl_vars['element']):
?>
		<?php $this->assign('element_hash', $__tpl_vars['element']['element_hash'], false); ?>
		<tr>
			<?php $_from_2239812971 = & $__tpl_vars['table']['intervals']; if (!is_array($_from_2239812971) && !is_object($_from_2239812971)) { settype($_from_2239812971, 'array'); }if (count($_from_2239812971)):
    foreach ($_from_2239812971 as $__tpl_vars['row']):
?>
			<?php $this->assign('interval_id', $__tpl_vars['row']['interval_id'], false); ?>
			<?php echo smarty_function_math(array('equation' => "round(value_/max_value*100)",'value_' => smarty_modifier_default(@$__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']], '0'),'max_value' => $__tpl_vars['table']['max_value'],'assign' => 'percent_value'), $this);?>

						<?php endforeach; endif; unset($_from); ?>
			<td class="no-padding">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="nowrap"><?php echo smarty_modifier_unescape($__tpl_vars['element']['description']); ?>
&nbsp;</td>
				<td align="right"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('bar_width' => '100px', 'value_width' => $__tpl_vars['percent_value'], )); ?>

<?php echo smarty_function_math(array('equation' => "floor(width / 20) + 1",'assign' => 'color','width' => $__tpl_vars['value_width']), $this);?>

<?php if ($__tpl_vars['color'] > 5): ?>
	<?php $this->assign('color', '5', false); ?>
<?php endif; ?>
<div class="graph-bar-border"<?php if ($__tpl_vars['bar_width']): ?> style="width: <?php echo $__tpl_vars['bar_width']; ?>;"<?php endif; ?> align="left"><div <?php if ($__tpl_vars['value_width'] > 0): ?>class="graph-bar-<?php echo $__tpl_vars['color']; ?>" style="width: <?php echo $__tpl_vars['value_width']; ?>%;"<?php endif; ?>>&nbsp;</div></div>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
			</table>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</td>
	<td width="100">
		<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-top-border no-left-border">
		<?php $_from_222484737 = & $__tpl_vars['table']['elements']; if (!is_array($_from_222484737) && !is_object($_from_222484737)) { settype($_from_222484737, 'array'); }if (count($_from_222484737)):
    foreach ($_from_222484737 as $__tpl_vars['element']):
?>
		<tr>
		<?php $this->assign('element_hash', $__tpl_vars['element']['element_hash'], false); ?>
				<?php $_from_2239812971 = & $__tpl_vars['table']['intervals']; if (!is_array($_from_2239812971) && !is_object($_from_2239812971)) { settype($_from_2239812971, 'array'); }if (count($_from_2239812971)):
    foreach ($_from_2239812971 as $__tpl_vars['row']):
?>
				<?php $this->assign('interval_id', $__tpl_vars['row']['interval_id'], false); ?>
				<td  class="center">
				<?php if ($__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']]): ?>
				<?php if ($__tpl_vars['table']['display'] != 'product_number' && $__tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']], )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $__tpl_vars['table']['values'][$__tpl_vars['element_hash']][$__tpl_vars['interval_id']]; ?>
<?php endif; ?>
				<?php else: ?>-<?php endif; ?></td>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</td>
</tr>
</table>

<?php if ($__tpl_vars['elements_count'] > 14): ?>
</div>
<?php endif; ?>

<?php endif; ?>

<?php elseif ($__tpl_vars['table']['type'] == 'P'): ?>
	<div id="<?php echo $__tpl_vars['table_prefix']; ?>
pie"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'pie', 'chart_data' => $__tpl_vars['new_array']['pie_data'], 'chart_id' => $__tpl_vars['table_prefix'], 'chart_title' => $__tpl_vars['table']['description'], 'chart_height' => $__tpl_vars['new_array']['pie_height'], )); ?>
<!-- amchart script-->
	<div id="flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
" align="center">
		<strong><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</strong>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$__tpl_vars['set_type'], @$__tpl_vars['type']), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/am<?php echo $__tpl_vars['type']; ?>
.swf", "<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so.addVariable("path", "<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/");
		so.addVariable("settings_file", escape("<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo $__tpl_vars['controller']; ?>
.get_settings&type=<?php echo $__tpl_vars['type']; ?>
&setting_type=<?php echo $__tpl_vars['setting_type']; ?>
&title=" + encodeURI("<?php echo smarty_modifier_escape($__tpl_vars['chart_title'], 'javascript'); ?>
")));
		so.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($__tpl_vars['chart_data'], 'javascript'); ?>
'));
		so.addVariable("preloader_color", "#999999");
		so.write("flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
");
		// ]]>
	</script>
<!-- end of amchart script -->
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $__tpl_vars['table_prefix']; ?>
pie--></div>

<?php elseif ($__tpl_vars['table']['type'] == 'C'): ?>
	<div id="<?php echo $__tpl_vars['table_prefix']; ?>
pie"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'pie', 'set_type' => 'piefl', 'chart_data' => $__tpl_vars['new_array']['pie_data'], 'chart_id' => $__tpl_vars['table_prefix'], 'chart_title' => $__tpl_vars['table']['description'], 'chart_height' => $__tpl_vars['new_array']['pie_height'], )); ?>
<!-- amchart script-->
	<div id="flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
" align="center">
		<strong><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</strong>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$__tpl_vars['set_type'], @$__tpl_vars['type']), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/am<?php echo $__tpl_vars['type']; ?>
.swf", "<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so.addVariable("path", "<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/");
		so.addVariable("settings_file", escape("<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo $__tpl_vars['controller']; ?>
.get_settings&type=<?php echo $__tpl_vars['type']; ?>
&setting_type=<?php echo $__tpl_vars['setting_type']; ?>
&title=" + encodeURI("<?php echo smarty_modifier_escape($__tpl_vars['chart_title'], 'javascript'); ?>
")));
		so.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($__tpl_vars['chart_data'], 'javascript'); ?>
'));
		so.addVariable("preloader_color", "#999999");
		so.write("flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
");
		// ]]>
	</script>
<!-- end of amchart script -->
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $__tpl_vars['table_prefix']; ?>
pie--></div>

<?php elseif ($__tpl_vars['table']['type'] == 'B'): ?>
<center>
	<div id="div_scroll_<?php echo $__tpl_vars['table_id']; ?>
" class="reports-graph-scroll">
		<div id="<?php echo $__tpl_vars['table_prefix']; ?>
bar"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'column', 'chart_data' => $__tpl_vars['new_array']['column_data'], 'chart_id' => $__tpl_vars['table_prefix'], 'chart_title' => $__tpl_vars['table']['description'], 'chart_height' => $__tpl_vars['new_array']['column_height'], 'chart_width' => $__tpl_vars['new_array']['column_width'], )); ?>
<!-- amchart script-->
	<div id="flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
" align="center">
		<strong><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</strong>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$__tpl_vars['set_type'], @$__tpl_vars['type']), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/am<?php echo $__tpl_vars['type']; ?>
.swf", "<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$__tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so.addVariable("path", "<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $__tpl_vars['type']; ?>
/");
		so.addVariable("settings_file", escape("<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo $__tpl_vars['controller']; ?>
.get_settings&type=<?php echo $__tpl_vars['type']; ?>
&setting_type=<?php echo $__tpl_vars['setting_type']; ?>
&title=" + encodeURI("<?php echo smarty_modifier_escape($__tpl_vars['chart_title'], 'javascript'); ?>
")));
		so.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($__tpl_vars['chart_data'], 'javascript'); ?>
'));
		so.addVariable("preloader_color", "#999999");
		so.write("flashcontent_<?php echo $__tpl_vars['chart_id']; ?>
am<?php echo $__tpl_vars['type']; ?>
");
		// ]]>
	</script>
<!-- end of amchart script -->
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $__tpl_vars['table_prefix']; ?>
bar--></div>
	</div>
</center>
<?php endif; ?>

<!--content_table_<?php echo $__tpl_vars['table_id']; ?>
--></div>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $__tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($__tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (! $__tpl_vars['tabs_section'] || $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section']): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
<?php echo $__tpl_vars['id_suffix']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($__tpl_vars['tab']['href']): ?>href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $__tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('reports', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'extra_tools' => $this->_smarty_vars['capture']['extra_tools'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--content_<?php echo $__tpl_vars['report']['report_id']; ?>
--></div>