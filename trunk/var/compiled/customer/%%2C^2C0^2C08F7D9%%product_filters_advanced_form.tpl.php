<?php /* Smarty version 2.6.18, created on 2011-11-30 23:28:04
         compiled from views/products/components/product_filters_advanced_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/products/components/product_filters_advanced_form.tpl', 5, false),array('function', 'script', 'views/products/components/product_filters_advanced_form.tpl', 69, false),array('function', 'math', 'views/products/components/product_filters_advanced_form.tpl', 71, false),array('modifier', 'default', 'views/products/components/product_filters_advanced_form.tpl', 22, false),array('modifier', 'sizeof', 'views/products/components/product_filters_advanced_form.tpl', 25, false),array('modifier', 'in_array', 'views/products/components/product_filters_advanced_form.tpl', 31, false),array('modifier', 'fn_text_placeholders', 'views/products/components/product_filters_advanced_form.tpl', 44, false),array('modifier', 'date_format', 'views/products/components/product_filters_advanced_form.tpl', 66, false),array('modifier', 'range', 'views/products/components/product_filters_advanced_form.tpl', 73, false),array('modifier', 'implode', 'views/products/components/product_filters_advanced_form.tpl', 77, false),array('modifier', 'replace', 'views/products/components/product_filters_advanced_form.tpl', 196, false),array('modifier', 'md5', 'views/products/components/product_filters_advanced_form.tpl', 221, false),array('modifier', 'string_format', 'views/products/components/product_filters_advanced_form.tpl', 221, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','your_range','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','none','yes','no','any','submit','delete','delete','or','reset_filter','advanced_filter','advanced_filter'));
?>

<?php if ($__tpl_vars['filter_features']): ?>

<?php echo smarty_function_split(array('data' => $__tpl_vars['filter_features'],'size' => '3','assign' => 'splitted_filter','preverse_keys' => true), $this);?>


<?php ob_start(); ?>
<input type="hidden" name="advanced_filter" value="Y" />
<?php if ($__tpl_vars['_REQUEST']['category_id']): ?>
<input type="hidden" name="category_id" value="<?php echo $__tpl_vars['_REQUEST']['category_id']; ?>
" />
<input type="hidden" name="subcats" value="Y" />
<?php endif; ?>

<?php if ($__tpl_vars['_REQUEST']['variant_id']): ?>
<input type="hidden" name="variant_id" value="<?php echo $__tpl_vars['_REQUEST']['variant_id']; ?>
" />
<?php endif; ?>

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
			<?php $_from_3049802886 = & $__tpl_vars['filter']['ranges']; if (!is_array($_from_3049802886) && !is_object($_from_3049802886)) { settype($_from_3049802886, 'array'); }if (count($_from_3049802886)):
    foreach ($_from_3049802886 as $__tpl_vars['range']):
?>
				<div class="select-field"><input type="checkbox" class="checkbox" name="<?php if ($__tpl_vars['filter']['feature_type'] == 'M'): ?>multiple_<?php endif; ?>variants[]" id="variants_<?php echo $__tpl_vars['range']['range_id']; ?>
" value="<?php if ($__tpl_vars['filter']['feature_type'] == 'M'): ?><?php echo $__tpl_vars['range']['range_id']; ?>
<?php else: ?>[V<?php echo $__tpl_vars['range']['range_id']; ?>
]<?php endif; ?>" <?php if (smarty_modifier_in_array("[V".($__tpl_vars['range']['range_id'])."]", $__tpl_vars['search']['variants']) || smarty_modifier_in_array($__tpl_vars['range']['range_id'], $__tpl_vars['search']['multiple_variants'])): ?>checked="checked"<?php endif; ?> /><label for="variants_<?php echo $__tpl_vars['range']['range_id']; ?>
"><?php echo $__tpl_vars['filter']['prefix']; ?>
<?php echo $__tpl_vars['range']['range_name']; ?>
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
]" id="no_ranges_<?php echo $__tpl_vars['el_id']; ?>
" value="" checked="checked" class="radio" /><label for="no_ranges_<?php echo $__tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label></div>
				<?php $_from_3049802886 = & $__tpl_vars['filter']['ranges']; if (!is_array($_from_3049802886) && !is_object($_from_3049802886)) { settype($_from_3049802886, 'array'); }if (count($_from_3049802886)):
    foreach ($_from_3049802886 as $__tpl_vars['range']):
?>
					<?php $this->assign('_type', smarty_modifier_default(@$__tpl_vars['filter']['field_type'], 'R'), false); ?>
					<div class="select-field"><input type="radio" class="radio" name="variants[<?php echo $__tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $__tpl_vars['el_id']; ?>
<?php echo $__tpl_vars['range']['range_id']; ?>
" value="<?php echo $__tpl_vars['_type']; ?>
<?php echo $__tpl_vars['range']['range_id']; ?>
" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] == ($__tpl_vars['_type']).($__tpl_vars['range']['range_id'])): ?>checked="checked"<?php endif; ?> /><label for="ranges_<?php echo $__tpl_vars['el_id']; ?>
<?php echo $__tpl_vars['range']['range_id']; ?>
"><?php echo fn_text_placeholders($__tpl_vars['range']['range_name']); ?>
</label></div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
			
			<?php if ($__tpl_vars['filter']['condition_type'] != 'F'): ?>
			<p><input type="radio" name="variants[<?php echo $__tpl_vars['el_id']; ?>
]" id="select_custom_<?php echo $__tpl_vars['el_id']; ?>
" value="O" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] == 'O'): ?>checked="checked"<?php endif; ?> class="radio" /><label for="select_custom_<?php echo $__tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('your_range', $this->getLanguage()); ?>
</label></p>
			
			<div class="select-field">
				<?php if ($__tpl_vars['filter']['feature_type'] == 'D'): ?>
				<?php if ($__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'] || $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to']): ?>
					<?php $this->assign('date_extra', "", false); ?>
				<?php else: ?>
					<?php $this->assign('date_extra', "\"disabled=\"\\disabled\\\"\"", false); ?>
				<?php endif; ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => "range_".($__tpl_vars['el_id'])."_from", 'date_name' => "custom_range[".($__tpl_vars['filter']['feature_id'])."][from]", 'date_val' => $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'], 'extra' => $__tpl_vars['date_extra'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text-medium" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but hand" id="sw_<?php echo $__tpl_vars['date_id']; ?>
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
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => "range_".($__tpl_vars['el_id'])."_to", 'date_name' => "custom_range[".($__tpl_vars['filter']['feature_id'])."][to]", 'date_val' => $__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to'], 'extra' => $__tpl_vars['date_extra'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text-medium" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but hand" id="sw_<?php echo $__tpl_vars['date_id']; ?>
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
]<?php endif; ?>[from]" id="range_<?php echo $__tpl_vars['el_id']; ?>
_from" size="3" class="input-text-short" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['from'], @$__tpl_vars['search']['field_range'][$__tpl_vars['filter']['field_type']]['from']); ?>
" <?php if ($__tpl_vars['search']['variants'][$__tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
				&nbsp;-&nbsp;
				<input type="text" name="<?php if ($__tpl_vars['filter']['field_type']): ?>field_range[<?php echo $__tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $__tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[to]" size="3" class="input-text-short" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['custom_range'][$__tpl_vars['filter']['feature_id']]['to'], @$__tpl_vars['search']['field_range'][$__tpl_vars['filter']['field_type']]['to']); ?>
" id="range_<?php echo $__tpl_vars['el_id']; ?>
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
				$('#range_' + el_id + '_from').attr('disabled', this.value !== 'O');
				$('#range_' + el_id + '_to').attr('disabled', this.value !== 'O');
				<?php if ($__tpl_vars['filter']['feature_type'] == 'D'): ?>
				$('#range_' + el_id + '_from_but').attr('disabled', this.value !== 'O');
				$('#range_' + el_id + '_to_but').attr('disabled', this.value !== 'O');
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
]" id="ranges_<?php echo $__tpl_vars['el_id']; ?>
_none" value="" <?php if (! $__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']]): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $__tpl_vars['el_id']; ?>
_none"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $__tpl_vars['el_id']; ?>
_yes" value="Y" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'Y'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $__tpl_vars['el_id']; ?>
_yes"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $__tpl_vars['el_id']; ?>
_no" value="N" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'N'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $__tpl_vars['el_id']; ?>
_no"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
			</div>
			
			<?php if (! $__tpl_vars['filter']['condition_type']): ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $__tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $__tpl_vars['el_id']; ?>
_any" value="A" <?php if ($__tpl_vars['search']['ch_filters'][$__tpl_vars['el_id']] == 'A'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $__tpl_vars['el_id']; ?>
_any"><?php echo fn_get_lang_var('any', $this->getLanguage()); ?>
</label>
			</div>
			<?php endif; ?>
			
		<?php elseif ($__tpl_vars['filter']['feature_type'] == 'T'): ?>
			<div class="select-field nowrap">
			<?php echo $__tpl_vars['filter']['prefix']; ?>
<input type="text" name="tx_features[<?php echo $__tpl_vars['filter']['feature_id']; ?>
]" class="input-text<?php if ($__tpl_vars['filter']['prefix'] || $__tpl_vars['filter']['suffix']): ?>-medium<?php endif; ?>" value="<?php echo $__tpl_vars['search']['tx_features'][$__tpl_vars['filter']['feature_id']]; ?>
" /><?php echo $__tpl_vars['filter']['suffix']; ?>

			</div>
		<?php endif; ?>
	</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php $this->_smarty_vars['capture']['filtering'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($__tpl_vars['separate_form']): ?>

<?php ob_start(); ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="get" name="advanced_filter_form">

<?php echo $this->_smarty_vars['capture']['filtering']; ?>


<div class="buttons-container">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "dispatch[".($__tpl_vars['_REQUEST']['dispatch'])."]", 'but_text' => fn_get_lang_var('submit', $this->getLanguage()), )); ?>

<?php if ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name'] && $__tpl_vars['but_role'] != 'text' && $__tpl_vars['but_role'] != 'act' && $__tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($__tpl_vars['but_id']): ?>id="wrap_<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $__tpl_vars['suffix']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $__tpl_vars['but_name']; ?>
" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" /></span>

<?php elseif ($__tpl_vars['but_role'] == 'text' || $__tpl_vars['but_role'] == 'act' || $__tpl_vars['but_role'] == 'edit' || ( $__tpl_vars['but_role'] == 'text' && $__tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> cm-submit-link<?php endif; ?> text-button<?php echo $__tpl_vars['suffix']; ?>
"<?php if ($__tpl_vars['but_id']): ?> id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a>

<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_meta']): ?> class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete_small.gif" width="10" height="9" border="0" alt="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" /></a>

<?php else: ?> 

	<span class="button<?php echo $__tpl_vars['suffix']; ?>
" <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?>><a <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($__tpl_vars['but_rev']): ?>rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;<a class="tool-link cm-reset-link"><?php echo fn_get_lang_var('reset_filter', $this->getLanguage()); ?>
</a>
</div>

</form>
<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($__tpl_vars['search']['variants']): ?>
	<?php $this->assign('_collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('_collapse', false, false); ?>
<?php endif; ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('section_title' => fn_get_lang_var('advanced_filter', $this->getLanguage()), 'section_content' => $this->_smarty_vars['capture']['section'], 'collapse' => $__tpl_vars['_collapse'], )); ?>

<?php $this->assign('id', smarty_modifier_string_format(md5($__tpl_vars['section_title']), "s_%s"), false); ?>
<?php if ($_COOKIE[$__tpl_vars['id']] || $__tpl_vars['collapse']): ?>
	<?php $this->assign('collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('collapse', false, false); ?>
<?php endif; ?>

<div class="section-border<?php if ($__tpl_vars['class']): ?> <?php echo $__tpl_vars['class']; ?>
<?php endif; ?>">
	<h3 class="section-title">
		<a class="cm-combo-<?php if (! $__tpl_vars['collapse']): ?>off<?php else: ?>on<?php endif; ?> cm-combination cm-save-state cm-ss-reverse" id="sw_<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['section_title']; ?>
</a>
	</h3>
	<div id="<?php echo $__tpl_vars['id']; ?>
" class="<?php echo smarty_modifier_default(@$__tpl_vars['section_body_class'], "section-body"); ?>
 <?php if ($__tpl_vars['collapse']): ?>hidden<?php endif; ?>"><?php echo $__tpl_vars['section_content']; ?>
</div>
</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php else: ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('advanced_filter', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_smarty_vars['capture']['filtering']; ?>


<?php endif; ?>

<?php elseif ($__tpl_vars['search']['features_hash']): ?>
	<input type="hidden" name="features_hash" value="<?php echo $__tpl_vars['search']['features_hash']; ?>
" />
<?php endif; ?>

