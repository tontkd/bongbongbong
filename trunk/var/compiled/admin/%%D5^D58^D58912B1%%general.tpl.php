<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:44
         compiled from addons/statistics/views/statistics/components/reports/general.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'addons/statistics/views/statistics/components/reports/general.tpl', 16, false),array('modifier', 'date_format', 'addons/statistics/views/statistics/components/reports/general.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('date','total','robots','visitors','visitor_hosts','no_data'));
?>

<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('div_id' => 'general_pagination_content')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</th>
	<th class="right"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
</th>
	<th class="right"><?php echo fn_get_lang_var('robots', $this->getLanguage()); ?>
</th>
	<th class="right"><?php echo fn_get_lang_var('visitors', $this->getLanguage()); ?>
</th>
	<th class="right"><?php echo fn_get_lang_var('visitor_hosts', $this->getLanguage()); ?>
</th>
</tr>
<?php $_from_2268115804 = & $__tpl_vars['report_data']['data']; if (!is_array($_from_2268115804) && !is_object($_from_2268115804)) { settype($_from_2268115804, 'array'); }if (count($_from_2268115804)):
    foreach ($_from_2268115804 as $__tpl_vars['date'] => $__tpl_vars['stat']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
>
	<td>
		<?php if ($__tpl_vars['statistic_period'] == @STAT_PERIOD_DAY): ?>
			<?php echo smarty_modifier_date_format($__tpl_vars['stat']['time_from'], $__tpl_vars['settings']['Appearance']['date_format']); ?>

		<?php elseif ($__tpl_vars['statistic_period'] == @STAT_PERIOD_HOUR): ?>
			<?php echo smarty_modifier_date_format($__tpl_vars['stat']['time_from'], ($__tpl_vars['settings']['Appearance']['time_format']).", ".($__tpl_vars['settings']['Appearance']['date_format'])); ?>

		<?php endif; ?>
	</td>
	<td class="right"><?php echo $__tpl_vars['stat']['total']; ?>
</td>
	<td class="right"><?php if ($__tpl_vars['stat']['robots']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=statistics.visitors&amp;section=general&amp;report=general&amp;time_from=<?php echo $__tpl_vars['stat']['time_from']; ?>
&amp;period=<?php echo $__tpl_vars['statistic_period']; ?>
&amp;client_type=B"><?php endif; ?><?php echo $__tpl_vars['stat']['robots']; ?>
<?php if ($__tpl_vars['stat']['robots']): ?></a><?php endif; ?></td>
	<td class="right"><?php if ($__tpl_vars['stat']['visitors']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=statistics.visitors&amp;section=general&amp;report=general&amp;time_from=<?php echo $__tpl_vars['stat']['time_from']; ?>
&amp;period=<?php echo $__tpl_vars['statistic_period']; ?>
&amp;client_type=U"><?php endif; ?><?php echo $__tpl_vars['stat']['visitors']; ?>
<?php if ($__tpl_vars['stat']['visitors']): ?></a><?php endif; ?></td>
	<td class="right"><?php echo $__tpl_vars['stat']['hosts']; ?>
</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="5"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('div_id' => 'general_pagination_content')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_smarty_vars['capture']['table_chart'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/statistics/views/statistics/components/select_charts.tpl", 'smarty_include_vars' => array('chart_table' => $this->_smarty_vars['capture']['table_chart'],'chart_type' => $__tpl_vars['chart_type'],'applicable_charts' => 'line')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>