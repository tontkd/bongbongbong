<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:44
         compiled from addons/statistics/views/statistics/components/select_charts.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_query_remove', 'addons/statistics/views/statistics/components/select_charts.tpl', 23, false),array('modifier', 'strpos', 'addons/statistics/views/statistics/components/select_charts.tpl', 25, false),array('modifier', 'default', 'addons/statistics/views/statistics/components/select_charts.tpl', 46, false),array('modifier', 'escape', 'addons/statistics/views/statistics/components/select_charts.tpl', 51, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('type','table','graphic','bar','graphic','pie','graphic','line','upgrade_flash_player','upgrade_flash_player','upgrade_flash_player'));
?>
<?php  ob_start();  ?>
<?php if (! $this->_smarty_vars['capture']['chart_js']): ?>

<script type="text/javascript">
//<![CDATA[
	<?php echo '
	function fn_switch_stat_graphics(url, rep)
	{
		jQuery.ajaxRequest(
			url,
			{result_ids: \'chart_contents_\' + rep}
		);
	}
	'; ?>

//]]>
</script>
<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['chart_js'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<div class="form-field" align="right">
	<strong><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</strong>&nbsp;
	<select onchange="fn_switch_stat_graphics('<?php echo fn_query_remove($__tpl_vars['config']['current_url'], 'chart_type'); ?>
&chart_type=' + this.value, '<?php echo $__tpl_vars['report_data']['report']; ?>
');">
		<option value="table" <?php if ($__tpl_vars['chart_type'] == 'table'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('table', $this->getLanguage()); ?>
</option>
		<?php if (strpos($__tpl_vars['applicable_charts'], 'bar') !== false): ?>
		<option value="bar" <?php if ($__tpl_vars['chart_type'] == 'bar'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('graphic', $this->getLanguage()); ?>
 [<?php echo fn_get_lang_var('bar', $this->getLanguage()); ?>
]</option>
		<?php endif; ?>
		<?php if (strpos($__tpl_vars['applicable_charts'], 'pie') !== false): ?>
		<option value="pie" <?php if ($__tpl_vars['chart_type'] == 'pie'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('graphic', $this->getLanguage()); ?>
 [<?php echo fn_get_lang_var('pie', $this->getLanguage()); ?>
]</option>
		<?php endif; ?>
		<?php if (strpos($__tpl_vars['applicable_charts'], 'line') !== false): ?>
		<option value="line" <?php if ($__tpl_vars['chart_type'] == 'line'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('graphic', $this->getLanguage()); ?>
 [<?php echo fn_get_lang_var('line', $this->getLanguage()); ?>
]</option>
		<?php endif; ?>
	</select>
</div>

<div id="chart_contents_<?php echo $__tpl_vars['report_data']['report']; ?>
">
	<?php if ($__tpl_vars['chart_type'] == 'table'): ?>
		<?php echo $__tpl_vars['chart_table']; ?>

	<?php elseif ($__tpl_vars['chart_type'] == 'bar'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'column', 'set_type' => 'bar', 'chart_data' => $__tpl_vars['chart_data'], 'chart_id' => $__tpl_vars['chart_type'], 'chart_title' => $__tpl_vars['chart_title'], 'chart_height' => $__tpl_vars['column_height'], )); ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php elseif ($__tpl_vars['chart_type'] == 'pie'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'pie', 'chart_data' => $__tpl_vars['chart_data'], 'chart_id' => $__tpl_vars['chart_type'], 'chart_title' => $__tpl_vars['chart_title'], 'chart_height' => $__tpl_vars['pie_height'], )); ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php elseif ($__tpl_vars['chart_type'] == 'line'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('type' => 'line', 'chart_data' => $__tpl_vars['chart_data'], 'chart_id' => $__tpl_vars['chart_type'], 'chart_title' => $__tpl_vars['chart_title'], 'chart_height' => $__tpl_vars['line_height'], )); ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
<!--chart_contents_<?php echo $__tpl_vars['report_data']['report']; ?>
--></div>
<?php  ob_end_flush();  ?>