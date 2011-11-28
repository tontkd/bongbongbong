<?php /* Smarty version 2.6.18, created on 2011-11-28 13:16:53
         compiled from views/products/components/product_assign_features.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/components/product_assign_features.tpl', 1, false),array('modifier', 'date_format', 'views/products/components/product_assign_features.tpl', 43, false),array('modifier', 'range', 'views/products/components/product_assign_features.tpl', 50, false),array('modifier', 'implode', 'views/products/components/product_assign_features.tpl', 54, false),array('function', 'script', 'views/products/components/product_assign_features.tpl', 46, false),array('function', 'math', 'views/products/components/product_assign_features.tpl', 48, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','enter_other','enter_other','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12'));
?>

<?php $_from_761673165 = & $__tpl_vars['product_features']; if (!is_array($_from_761673165) && !is_object($_from_761673165)) { settype($_from_761673165, 'array'); }if (count($_from_761673165)):
    foreach ($_from_761673165 as $__tpl_vars['feature_id'] => $__tpl_vars['feature']):
?>
	<?php if ($__tpl_vars['feature']['feature_type'] != 'G'): ?>
		<div class="form-field">
			<label for="feature_<?php echo $__tpl_vars['feature_id']; ?>
"><?php echo $__tpl_vars['feature']['description']; ?>
:</label>
			<div class="select-field">
			<label><strong><?php echo $__tpl_vars['feature']['prefix']; ?>
</strong></label>
			<?php if ($__tpl_vars['feature']['feature_type'] == 'S' || $__tpl_vars['feature']['feature_type'] == 'N' || $__tpl_vars['feature']['feature_type'] == 'E'): ?>
				<?php $this->assign('value_selected', false, false); ?>
				<select name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
]" id="feature_<?php echo $__tpl_vars['feature_id']; ?>
" onchange="$('#input_<?php echo $__tpl_vars['feature_id']; ?>
').toggleBy((this.value != 'disable_select'));">
					<option value="">-<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
-</option>
					<?php $_from_1156591881 = & $__tpl_vars['feature']['variants']; if (!is_array($_from_1156591881) && !is_object($_from_1156591881)) { settype($_from_1156591881, 'array'); }if (count($_from_1156591881)):
    foreach ($_from_1156591881 as $__tpl_vars['var']):
?>
					<option value="<?php echo $__tpl_vars['var']['variant_id']; ?>
" <?php if ($__tpl_vars['var']['variant_id'] == $__tpl_vars['feature']['variant_id']): ?><?php $this->assign('value_selected', true, false); ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['var']['variant']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					<option value="disable_select">-<?php echo fn_get_lang_var('enter_other', $this->getLanguage()); ?>
-</option>
				</select>
				<input type="text" class="input-text input-empty hidden" name="product_data[add_new_variant][<?php echo $__tpl_vars['feature']['feature_id']; ?>
][variant]" id="input_<?php echo $__tpl_vars['feature_id']; ?>
" />

			<?php elseif ($__tpl_vars['feature']['feature_type'] == 'M'): ?>
				<div class="select-field">
					<input type="hidden" name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
]" value="" />
					<?php $_from_1156591881 = & $__tpl_vars['feature']['variants']; if (!is_array($_from_1156591881) && !is_object($_from_1156591881)) { settype($_from_1156591881, 'array'); }if (count($_from_1156591881)):
    foreach ($_from_1156591881 as $__tpl_vars['var']):
?>
						<p><label class="label-html-checkboxes" for="variant_<?php echo $__tpl_vars['var']['variant_id']; ?>
"><input type="checkbox" class="html-checkboxes" id="variant_<?php echo $__tpl_vars['var']['variant_id']; ?>
" name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
][<?php echo $__tpl_vars['var']['variant_id']; ?>
]" <?php if ($__tpl_vars['var']['selected']): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['var']['variant_id']; ?>
" /><?php echo $__tpl_vars['var']['variant']; ?>
</label></p>
					<?php endforeach; endif; unset($_from); ?>
					<p><label for="input_<?php echo $__tpl_vars['feature_id']; ?>
"><?php echo fn_get_lang_var('enter_other', $this->getLanguage()); ?>
:</label>&nbsp;
					<input type="text" class="input-text" name="product_data[add_new_variant][<?php echo $__tpl_vars['feature']['feature_id']; ?>
][variant]" id="feature_<?php echo $__tpl_vars['feature_id']; ?>
" />
					</p>
				</div>
			<?php elseif ($__tpl_vars['feature']['feature_type'] == 'C'): ?>
				<input type="hidden" name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
]" value="N" />
				<input type="checkbox" name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
]" value="Y" id="feature_<?php echo $__tpl_vars['feature_id']; ?>
" class="checkbox" <?php if ($__tpl_vars['feature']['value'] == 'Y'): ?>checked="checked"<?php endif; ?> />

			<?php elseif ($__tpl_vars['feature']['feature_type'] == 'D'): ?>
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => "date_".($__tpl_vars['feature_id']), 'date_name' => "product_data[product_features][".($__tpl_vars['feature_id'])."]", 'date_val' => smarty_modifier_default(@$__tpl_vars['feature']['value_int'], @TIME), 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

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

			<?php else: ?>
				<input type="text" name="product_data[product_features][<?php echo $__tpl_vars['feature_id']; ?>
]" value="<?php if ($__tpl_vars['feature']['feature_type'] == 'O'): ?><?php echo $__tpl_vars['feature']['value_int']; ?>
<?php else: ?><?php echo $__tpl_vars['feature']['value']; ?>
<?php endif; ?>" id="feature_<?php echo $__tpl_vars['feature_id']; ?>
" class="input-text" <?php if ($__tpl_vars['feature']['feature_type'] == 'O'): ?>onkeyup="javascript: this.value = this.value.replace(/\D+/g, '');"<?php endif; ?> />
			<?php endif; ?>
			<label><strong><?php echo $__tpl_vars['feature']['suffix']; ?>
</strong></label>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from_761673165 = & $__tpl_vars['product_features']; if (!is_array($_from_761673165) && !is_object($_from_761673165)) { settype($_from_761673165, 'array'); }if (count($_from_761673165)):
    foreach ($_from_761673165 as $__tpl_vars['feature_id'] => $__tpl_vars['feature']):
?>
	<?php if ($__tpl_vars['feature']['feature_type'] == 'G' && $__tpl_vars['feature']['subfeatures']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['feature']['description'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_assign_features.tpl", 'smarty_include_vars' => array('product_features' => $__tpl_vars['feature']['subfeatures'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>