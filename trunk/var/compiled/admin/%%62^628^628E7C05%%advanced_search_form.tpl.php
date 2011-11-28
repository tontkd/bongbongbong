<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:23
         compiled from views/products/components/advanced_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/products/components/advanced_search_form.tpl', 3, false),array('function', 'script', 'views/products/components/advanced_search_form.tpl', 61, false),array('function', 'math', 'views/products/components/advanced_search_form.tpl', 63, false),array('modifier', 'default', 'views/products/components/advanced_search_form.tpl', 9, false),array('modifier', 'sizeof', 'views/products/components/advanced_search_form.tpl', 12, false),array('modifier', 'in_array', 'views/products/components/advanced_search_form.tpl', 20, false),array('modifier', 'fn_text_placeholders', 'views/products/components/advanced_search_form.tpl', 36, false),array('modifier', 'date_format', 'views/products/components/advanced_search_form.tpl', 58, false),array('modifier', 'range', 'views/products/components/advanced_search_form.tpl', 65, false),array('modifier', 'implode', 'views/products/components/advanced_search_form.tpl', 69, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','your_range','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','none','yes','no','any'));
?>
<?php  ob_start();  ?>
<?php echo smarty_function_split(array('data' => $__tpl_vars['filter_features'],'size' => '3','assign' => 'splitted_filter','preverse_keys' => true), $this);?>

<input type="hidden" name="advanced_filter" value="Y" />
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-filters">
<?php $_from_348628889 = & $__tpl_vars['splitted_filter']; if (!is_array($_from_348628889) && !is_object($_from_348628889)) { settype($_from_348628889, 'array'); }$this->_foreach['filters_row'] = array('total' => count($_from_348628889), 'iteration' => 0);
if ($this->_foreach['filters_row']['total'] > 0):
    foreach ($_from_348628889 as $__tpl_vars['filters_row']):
        $this->_foreach['filters_row']['iteration']++;
?>
<tr>
<?php $_from_3926780633 = & $__tpl_vars['filters_row']; if (!is_array($_from_3926780633) && !is_object($_from_3926780633)) { settype($_from_3926780633, 'array'); }if (count($_from_3926780633)):
    foreach ($_from_3926780633 as $__tpl_vars['filter']):
?>
	<th><?php echo smarty_modifier_default(@$__tpl_vars['filter']['filter'], @$__tpl_vars['filter']['description']); ?>
</th>
<?php endforeach; endif; unset($_from); ?>
</tr>
<tr valign="top"<?php if (( sizeof($__tpl_vars['splitted_filter']) > 1 ) && ($this->_foreach['filters_row']['iteration'] <= 1)): ?> class="delim"<?php endif; ?>>
<?php $_from_3926780633 = & $__tpl_vars['filters_row']; if (!is_array($_from_3926780633) && !is_object($_from_3926780633)) { settype($_from_3926780633, 'array'); }if (count($_from_3926780633)):
    foreach ($_from_3926780633 as $__tpl_vars['filter']):
?>
	<td width="33%">
		<?php if ($__tpl_vars['filter']['feature_type'] == 'S' || $__tpl_vars['filter']['feature_type'] == 'E' || $__tpl_vars['filter']['feature_type'] == 'M'): ?>
		<div class="scroll-y">
			<?php $this->assign('filter_ranges', smarty_modifier_default(@$__tpl_vars['filter']['ranges'], @$__tpl_vars['filter']['variants']), false); ?>
			<?php $_from_1712401910 = & $__tpl_vars['filter_ranges']; if (!is_array($_from_1712401910) && !is_object($_from_1712401910)) { settype($_from_1712401910, 'array'); }if (count($_from_1712401910)):
    foreach ($_from_1712401910 as $__tpl_vars['range']):
?>
				<?php $this->assign('range_id', smarty_modifier_default(@$__tpl_vars['range']['range_id'], @$__tpl_vars['range']['variant_id']), false); ?>
				<div class="select-field"><input type="checkbox" class="checkbox" name="<?php if ($__tpl_vars['filter']['feature_type'] == 'M'): ?>multiple_<?php endif; ?>variants[]" id="<?php echo $__tpl_vars['prefix']; ?>
variants_<?php echo $__tpl_vars['range_id']; ?>
" value="<?php if ($__tpl_vars['filter']['feature_type'] == 'M'): ?><?php echo $__tpl_vars['range_id']; ?>
<?php else: ?>[V<?php echo $__tpl_vars['range_id']; ?>
]<?php endif; ?>" <?php if (smarty_modifier_in_array("[V".($__tpl_vars['range_id'])."]", $__tpl_vars['search']['variants']) || smarty_modifier_in_array($__tpl_vars['range_id'], $__tpl_vars['search']['multiple_variants'])): ?>checked="checked"<?php endif; ?> /><label for="variants_<?php echo $__tpl_vars['range_id']; ?>
"><?php echo $__tpl_vars['filter']['prefix']; ?>
<?php echo $__tpl_vars['range']['variant']; ?>
<?php echo $__tpl_vars['filter']['suffix']; ?>
</label></div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php elseif ($__tpl_vars['filter']['feature_type'] == 'O' || $__tpl_vars['filter']['feature_type'] == 'N' || $__tpl_vars['filter']['feature_type'] == 'D' || $__tpl_vars['filter']['condition_type'] == 'D' || $__tpl_vars['filter']['condition_type'] == 'F'): ?>
			<div class="scroll-y">
				<?php if ($__tpl_vars['filter']['condition_type']): ?>
					<?php $this->assign('el_id', "field_".($__tpl_vars['filter']['filter_id']), false); ?>
				<?php else: ?>
					<?php $this->assign('el_id', "feature_".($__tpl_vars['filter']['feature_id']), false); ?>
				<?php endif; ?>

				<div class="select-field"><input type="radio" name="variants[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
no_ranges_<?php echo $__tpl_vars['el_id']; ?>
" value="" checked="checked" class="radio" /><label for="<?php echo $__tpl_vars['prefix']; ?>
no_ranges_<?php echo $__tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label></div>
				<?php $this->assign('filter_ranges', smarty_modifier_default(@$__tpl_vars['filter']['ranges'], @$__tpl_vars['filter']['variants']), false); ?>
				<?php $_from_1712401910 = & $__tpl_vars['filter_ranges']; if (!is_array($_from_1712401910) && !is_object($_from_1712401910)) { settype($_from_1712401910, 'array'); }if (count($_from_1712401910)):
    foreach ($_from_1712401910 as $__tpl_vars['range']):
?>
					<?php $this->assign('_type', smarty_modifier_default(@$__tpl_vars['filter']['field_type'], 'R'), false); ?>
					<?php $this->assign('range_id', smarty_modifier_default(@$__tpl_vars['range']['range_id'], @$__tpl_vars['range']['variant_id']), false); ?>
					<div class="select-field"><input type="radio" class="radio" name="variants[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
<?php echo $__tpl_vars['range_id']; ?>
" value="<?php echo $__tpl_vars['_type']; ?>
<?php echo $__tpl_vars['range_id']; ?>
" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] == ($__tpl_vars['_type']).($__tpl_vars['range_id'])): ?>checked="checked"<?php endif; ?> /><label for="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
<?php echo $__tpl_vars['range_id']; ?>
"><?php echo fn_text_placeholders($__tpl_vars['range']['range_name']); ?>
</label></div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			
			<?php if ($__tpl_vars['filter']['condition_type'] != 'F'): ?>
			<p><input type="radio" name="variants[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
select_custom_<?php echo $__tpl_vars['el_id']; ?>
" value="O" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] == 'O'): ?>checked="checked"<?php endif; ?> class="radio" /><label for="<?php echo $__tpl_vars['prefix']; ?>
select_custom_<?php echo $__tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('your_range', $this->getLanguage()); ?>
</label></p>
			
			<div class="select-field">
				<?php if ($__tpl_vars['filter']['feature_type'] == 'D'): ?>
				<?php if ($__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'] || $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to']): ?>
					<?php $this->assign('date_extra', "", false); ?>
				<?php else: ?>
					<?php $this->assign('date_extra', "\"disabled=\"\\disabled\\\"\"", false); ?>
				<?php endif; ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => ($__tpl_vars['prefix'])."range_".($__tpl_vars['el_id'])."_from", 'date_name' => "custom_range[".($__tpl_vars['filter']['feature_id'])."][from]", 'date_val' => $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'], 'extra' => $__tpl_vars['date_extra'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text<?php if ($__tpl_vars['date_meta']): ?> <?php echo $__tpl_vars['date_meta']; ?>
<?php endif; ?>" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but" id="sw_<?php echo $__tpl_vars['date_id']; ?>
_picker" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />
<div id="<?php echo $__tpl_vars['date_id']; ?>
_picker" class="calendar-box cm-smart-position cm-popup-box hidden"></div>

<?php echo smarty_function_script(array('src' => "js/calendar.js"), $this);?>


<?php echo smarty_function_math(array('equation' => "x+y",'assign' => 'end_year','x' => smarty_modifier_default(@$__tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>

<?php $this->assign('start_year', smarty_modifier_default(@$__tpl_vars['start_year'], @$__tpl_vars['settings']['Company']['company_start_year']), false); ?>
<?php $this->assign('years_list', range($__tpl_vars['start_year'], $__tpl_vars['end_year']), false); ?>

<script type="text/javascript">
//<![CDATA[
new ccal(<?php echo $__tpl_vars['ldelim']; ?>
id: '<?php echo $__tpl_vars['date_id']; ?>
_picker', date_id: '<?php echo $__tpl_vars['date_id']; ?>
', button_id: 'sw_<?php echo $__tpl_vars['date_id']; ?>
_picker', month_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>true<?php else: ?>false<?php endif; ?>, sunday_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>true<?php else: ?>false<?php endif; ?>, week_days_name: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'], months: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'], years: [<?php echo implode(", ", $__tpl_vars['years_list']); ?>
]<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => ($__tpl_vars['prefix'])."range_".($__tpl_vars['el_id'])."_to", 'date_name' => "custom_range[".($__tpl_vars['filter']['feature_id'])."][to]", 'date_val' => $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to'], 'extra' => $__tpl_vars['date_extra'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text<?php if ($__tpl_vars['date_meta']): ?> <?php echo $__tpl_vars['date_meta']; ?>
<?php endif; ?>" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but" id="sw_<?php echo $__tpl_vars['date_id']; ?>
_picker" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />
<div id="<?php echo $__tpl_vars['date_id']; ?>
_picker" class="calendar-box cm-smart-position cm-popup-box hidden"></div>

<?php echo smarty_function_script(array('src' => "js/calendar.js"), $this);?>


<?php echo smarty_function_math(array('equation' => "x+y",'assign' => 'end_year','x' => smarty_modifier_default(@$__tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>

<?php $this->assign('start_year', smarty_modifier_default(@$__tpl_vars['start_year'], @$__tpl_vars['settings']['Company']['company_start_year']), false); ?>
<?php $this->assign('years_list', range($__tpl_vars['start_year'], $__tpl_vars['end_year']), false); ?>

<script type="text/javascript">
//<![CDATA[
new ccal(<?php echo $__tpl_vars['ldelim']; ?>
id: '<?php echo $__tpl_vars['date_id']; ?>
_picker', date_id: '<?php echo $__tpl_vars['date_id']; ?>
', button_id: 'sw_<?php echo $__tpl_vars['date_id']; ?>
_picker', month_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>true<?php else: ?>false<?php endif; ?>, sunday_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>true<?php else: ?>false<?php endif; ?>, week_days_name: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'], months: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'], years: [<?php echo implode(", ", $__tpl_vars['years_list']); ?>
]<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<input type="hidden" name="custom_range[<?php echo $__tpl_vars['filter']['feature_id']; ?>
][type]" value="D" />
				<?php else: ?>
				<input type="text" name="<?php if ($__tpl_vars['filter']['field_type']): ?>field_range[<?php echo $__tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $__tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[from]" id="<?php echo $__tpl_vars['prefix']; ?>
range_<?php echo $__tpl_vars['el_id']; ?>
_from" size="3" class="input-text-short" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'], @$__tpl_vars['search']['field_range'][$__tpl_vars['filter']['field_type']]['from']); ?>
" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
				&nbsp;-&nbsp;
				<input type="text" name="<?php if ($__tpl_vars['filter']['field_type']): ?>field_range[<?php echo $__tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $__tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[to]" size="3" class="input-text-short" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to'], @$__tpl_vars['search']['field_range'][$__tpl_vars['filter']['field_type']]['to']); ?>
" id="<?php echo $__tpl_vars['prefix']; ?>
range_<?php echo $__tpl_vars['el_id']; ?>
_to" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<script type="text/javascript">
			//<![CDATA[
			$(":radio[name='variants[<?php echo $__tpl_vars['el_id']; ?>
]']").change(function() {
				var el_id = '<?php echo $__tpl_vars['el_id']; ?>
';
				$('#<?php echo $__tpl_vars['prefix']; ?>
range_' + el_id + '_from').attr('disabled', this.value !== 'O');
				$('#<?php echo $__tpl_vars['prefix']; ?>
range_' + el_id + '_to').attr('disabled', this.value !== 'O');
				<?php if ($__tpl_vars['filter']['feature_type'] == 'D'): ?>
				$('#<?php echo $__tpl_vars['prefix']; ?>
range_' + el_id + '_from_but').attr('disabled', this.value !== 'O');
				$('#<?php echo $__tpl_vars['prefix']; ?>
range_' + el_id + '_to_but').attr('disabled', this.value !== 'O');
				<?php endif; ?>
			});
			//]]>
			</script>
		<?php elseif ($__tpl_vars['filter']['feature_type'] == 'C' || $__tpl_vars['filter']['condition_type'] == 'C'): ?>
			<?php if ($__tpl_vars['filter']['condition_type']): ?>
				<?php $this->assign('el_id', $__tpl_vars['filter']['field_type'], false); ?>
			<?php else: ?>
				<?php $this->assign('el_id', $__tpl_vars['filter']['feature_id'], false); ?>
			<?php endif; ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_none" value="" <?php if (! $__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']]): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_none"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_yes" value="Y" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'Y'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_yes"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_no" value="N" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'N'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_no"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
			</div>
			
			<?php if (! $__tpl_vars['filter']['condition_type']): ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_any" value="A" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'A'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $__tpl_vars['prefix']; ?>
ranges_<?php echo $__tpl_vars['el_id']; ?>
_any"><?php echo fn_get_lang_var('any', $this->getLanguage()); ?>
</label>
			</div>
			<?php endif; ?>
			
		<?php elseif ($__tpl_vars['filter']['feature_type'] == 'T'): ?>
			<div class="select-field nowrap">
				<?php echo $__tpl_vars['filter']['prefix']; ?>
<input type="text" name="tx_features[<?php echo $__tpl_vars['filter']['feature_id']; ?>
]" class="input-text" value="<?php echo $__tpl_vars['search']['tx_features'][$__tpl_vars['filter']['feature_id']]; ?>
" /><?php echo $__tpl_vars['filter']['suffix']; ?>

			</div>
		<?php endif; ?>
	</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table><?php  ob_end_flush();  ?>