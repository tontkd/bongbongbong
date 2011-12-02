<?php /* Smarty version 2.6.18, created on 2011-12-01 22:50:59
         compiled from common_templates/period_selector.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'common_templates/period_selector.tpl', 107, false),array('modifier', 'date_format', 'common_templates/period_selector.tpl', 137, false),array('modifier', 'default', 'common_templates/period_selector.tpl', 142, false),array('modifier', 'range', 'common_templates/period_selector.tpl', 144, false),array('modifier', 'implode', 'common_templates/period_selector.tpl', 148, false),array('modifier', 'fn_check_view_permissions', 'common_templates/period_selector.tpl', 205, false),array('function', 'script', 'common_templates/period_selector.tpl', 140, false),array('function', 'math', 'common_templates/period_selector.tpl', 142, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('period','all','this_day','this_week','this_month','this_year','yesterday','previous_week','previous_month','previous_year','last_24hours','last_n_days','last_n_days','custom','select_dates','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','search','remove_this_item','remove_this_item'));
?>
<?php  ob_start();  ?>
<div class="nowrap">
<script type="text/javascript">
//<![CDATA[
function fn_change_calendar_dates(value)
{
	var date_obj = new Date();
	var cal_date = new ccal();

	cal_date.month_first = <?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format']): ?>true<?php else: ?>false<?php endif; ?>;

	var current_date = cal_date.get_date(date_obj);
	var previous_date = cal_date.get_date(date_obj);

	<?php echo '
	if (value == \'A\') {
		$(\'#f_date\').val(\'\');
		$(\'#t_date\').val(\'\');
		return true;
	} else if (value == \'D\') {
		current_date.day = date_obj.getUTCDate();
	} else if (value == \'W\') {
		current_date.day = date_obj.getUTCDate() - date_obj.getDay() + 1;
	} else if (value == \'M\') {
		current_date.day = 1;
	} else if (value == \'Y\') {
		current_date.year = date_obj.getFullYear();
		current_date.month = 0;
		current_date.day = 1;
	} else if (value == \'LD\') {
		current_date.day = date_obj.getUTCDate() - 1;
		previous_date.day = date_obj.getUTCDate() - 1;
	} else if (value == \'HH\') {
		current_date.day = date_obj.getUTCDate() - 1;
		previous_date.day = date_obj.getUTCDate();
	} else if (value == \'LW\') {
		current_date.day = date_obj.getUTCDate() - (date_obj.getDay() + 6);
		previous_date.day = date_obj.getUTCDate() - date_obj.getDay();
	} else if (value == \'LM\') {
		current_date.month = date_obj.getMonth() - 1;
		current_date.day = 1;
		var m_date = current_date.month < 0 ? current_date.month + 12 : current_date.month;
		var y_date = current_date.month < 0 ? current_date.year - 1 : current_date.year;
		previous_date.day = cal_date.get_days(m_date, y_date);
		previous_date.month = m_date;
		previous_date.year = y_date;
	} else if (value == \'LY\') {
		current_date.year = date_obj.getFullYear() - 1;
		current_date.month = 0;
		current_date.day = 1;
		previous_date.year = current_date.year;
		previous_date.month = 11;
		previous_date.day = cal_date.get_days(previous_date.month, previous_date.year);
	} else if (value == \'HM\') {
		current_date.day -= 30;
	} else if  (value == \'HW\') {
		current_date.day -= 7;
	}

	if (current_date.day <= 0) {
		current_date.month -= 1;
		if (current_date.month < 0) {
			current_date.year -= 1;
			current_date.month += 12;
		}
		current_date.day += cal_date.get_days(current_date.month, current_date.year);
	}

	if (current_date.month < 0) {
		current_date.year -= 1;
		current_date.month += 12;
	}

	$(\'#f_date\').val(cal_date.generate_date(current_date));
	$(\'#t_date\').val(cal_date.generate_date(previous_date));

	'; ?>

}
//]]>
</script>

<?php if ($__tpl_vars['display'] == 'form'): ?>
<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field">
	<label><?php echo fn_get_lang_var('period', $this->getLanguage()); ?>
:</label>
	<div class="break">
<?php endif; ?>

	<select name="period" id="period_selects" onchange="fn_change_calendar_dates(this.value)">
		<option value="A" <?php if ($__tpl_vars['period'] == 'A' || ! $__tpl_vars['period']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
</option>
		<optgroup label="=============">
			<option value="D" <?php if ($__tpl_vars['period'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_day', $this->getLanguage()); ?>
</option>
			<option value="W" <?php if ($__tpl_vars['period'] == 'W'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_week', $this->getLanguage()); ?>
</option>
			<option value="M" <?php if ($__tpl_vars['period'] == 'M'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_month', $this->getLanguage()); ?>
</option>
			<option value="Y" <?php if ($__tpl_vars['period'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_year', $this->getLanguage()); ?>
</option>
		</optgroup>
		<optgroup label="=============">
			<option value="LD" <?php if ($__tpl_vars['period'] == 'LD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yesterday', $this->getLanguage()); ?>
</option>
			<option value="LW" <?php if ($__tpl_vars['period'] == 'LW'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_week', $this->getLanguage()); ?>
</option>
			<option value="LM" <?php if ($__tpl_vars['period'] == 'LM'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_month', $this->getLanguage()); ?>
</option>
			<option value="LY" <?php if ($__tpl_vars['period'] == 'LY'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_year', $this->getLanguage()); ?>
</option>
		</optgroup>
		<optgroup label="=============">
			<option value="HH" <?php if ($__tpl_vars['period'] == 'HH'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('last_24hours', $this->getLanguage()); ?>
</option>
			<option value="HW" <?php if ($__tpl_vars['period'] == 'HW'): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_replace(fn_get_lang_var('last_n_days', $this->getLanguage()), "[N]", 7); ?>
</option>
			<option value="HM" <?php if ($__tpl_vars['period'] == 'HM'): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_replace(fn_get_lang_var('last_n_days', $this->getLanguage()), "[N]", 30); ?>
</option>
					</optgroup>
		<optgroup label="=============">
			<option value="C" <?php if ($__tpl_vars['period'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('custom', $this->getLanguage()); ?>
</option>
		</optgroup>
	</select>

<?php if ($__tpl_vars['display'] == 'form'): ?>
	</div>
	</td>
	<td class="search-field">
<?php endif; ?>

	<?php if ($__tpl_vars['display'] != 'form'): ?>&nbsp;&nbsp;<?php endif; ?>
	<label<?php if ($__tpl_vars['display'] != 'form'): ?> class="label-html"<?php endif; ?>><?php echo fn_get_lang_var('select_dates', $this->getLanguage()); ?>
:</label>

<?php if ($__tpl_vars['display'] == 'form'): ?>
	<div class="break nowrap">
<?php endif; ?>

	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => 'f_date', 'date_name' => 'time_from', 'date_val' => $__tpl_vars['search']['time_from'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], 'extra' => "onchange=\"$('#period_selects').val('C');\"", )); ?>

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
	&nbsp;&nbsp;-&nbsp;&nbsp;
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => 't_date', 'date_name' => 'time_to', 'date_val' => $__tpl_vars['search']['time_to'], 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], 'extra' => "onchange=\"$('#period_selects').val('C');\"", )); ?>

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

<?php if ($__tpl_vars['display'] == 'form'): ?>
	</div>
	</td>
	<td class="buttons-container">
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('search', $this->getLanguage()), 'but_name' => $__tpl_vars['but_name'], 'but_role' => 'submit', )); ?>

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
	</td>
</tr>
</table>
<?php endif; ?>

</div>
<?php  ob_end_flush();  ?>