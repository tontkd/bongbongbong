<?php /* Smarty version 2.6.18, created on 2011-11-28 12:06:42
         compiled from views/currencies/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/currencies/manage.tpl', 3, false),array('function', 'cycle', 'views/currencies/manage.tpl', 48, false),array('modifier', 'default', 'views/currencies/manage.tpl', 78, false),array('modifier', 'lower', 'views/currencies/manage.tpl', 80, false),array('modifier', 'is_array', 'views/currencies/manage.tpl', 83, false),array('modifier', 'yaml_unserialize', 'views/currencies/manage.tpl', 84, false),array('modifier', 'substr_count', 'views/currencies/manage.tpl', 194, false),array('modifier', 'replace', 'views/currencies/manage.tpl', 195, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','base_currency','code','name','currency_rate','currency_sign','after_sum','ths_sign','dec_sign','decimals','status','active','disabled','hidden','pending','active','disabled','hidden','notify_customer','delete','delete','delete_selected','choose_action','or','tools','add','general','name','code','currency_rate','currency_sign','after_sum','active','hidden','disabled','status','active','hidden','disabled','ths_sign','dec_sign','decimals','add_currency','add_currency','add_currency','add_currency','currencies'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php echo '
<script type="text/javascript">
	//<![CDATA[
	function fn_disable_cbox(id)
	{
		form = $(\'form[name=currency_form]\');
		$(\'.cm-item\', form).removeAttr(\'disabled\');
		$(\'#delete_checkbox_\' + id).attr(\'disabled\', \'disabled\');
		$(\'.cm-coefficient\', form).removeAttr(\'disabled\');
		$(\'#coeff_\' + id).attr(\'disabled\', \'disabled\');
		$(\'.selected-status a\', form).addClass(\'cm-combination\');
		$(\'#sw_select_\' + id + \'_wrap a\', form).removeClass(\'cm-combination\');
		$(\'.cm-delete-obj a\').show();
		$(\'#del_\' + id + \' a\').hide();
		$(\'.cm-delete-obj span\').hide();
		$(\'#del_\' + id + \' span\').show();
	}
	//]]>
</script>
'; ?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="currency_form">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="10%" class="center"><?php echo fn_get_lang_var('base_currency', $this->getLanguage()); ?>
</th>
	<th width="10%"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
</th>
	<th width="55%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
	<th width="10%"><?php echo fn_get_lang_var('currency_rate', $this->getLanguage()); ?>
</th>
	<th width="10%"><?php echo fn_get_lang_var('currency_sign', $this->getLanguage()); ?>
</th>
	<th width="10%"><?php echo fn_get_lang_var('after_sum', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('ths_sign', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('dec_sign', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('decimals', $this->getLanguage()); ?>
</th>
	<th width="5%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>

<?php $_from_2646608479 = & $__tpl_vars['currencies_data']; if (!is_array($_from_2646608479) && !is_object($_from_2646608479)) { settype($_from_2646608479, 'array'); }if (count($_from_2646608479)):
    foreach ($_from_2646608479 as $__tpl_vars['cur']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td>
		<input id="delete_checkbox_<?php echo $__tpl_vars['cur']['currency_code']; ?>
" type="checkbox" name="currency_codes[]" value="<?php echo $__tpl_vars['cur']['currency_code']; ?>
" <?php if ($__tpl_vars['cur']['is_primary'] == 'Y'): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item" /></td>
	<td class="center">
		<input type="radio" name="is_primary_currency" value="<?php echo $__tpl_vars['cur']['currency_code']; ?>
" <?php if ($__tpl_vars['cur']['is_primary'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="fn_disable_cbox('<?php echo $__tpl_vars['cur']['currency_code']; ?>
');" class="radio" /></td>
	<td class="center nowrap">
		<input type="text" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][currency_code]" size="8" value="<?php echo $__tpl_vars['cur']['currency_code']; ?>
" class="input-text" onkeyup="var matches = this.value.match(/^(\w*)/gi);  if (matches) this.value = matches;" /></td>
	<td>
		<input type="text" name="currency_description[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][description]" value="<?php echo $__tpl_vars['cur']['description']; ?>
" class="input-text-long" /></td>
	<td class="center">
		<input type="text" id="coeff_<?php echo $__tpl_vars['cur']['currency_code']; ?>
" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][coefficient]" size="7" value="<?php echo $__tpl_vars['cur']['coefficient']; ?>
" class="input-text cm-coefficient" <?php if ($__tpl_vars['cur']['is_primary'] == 'Y'): ?>disabled="disabled"<?php endif; ?> /></td>
	<td class="center">
		<input type="text" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][symbol]" size="6" value="<?php echo $__tpl_vars['cur']['symbol']; ?>
" class="input-text" /></td>
	<td class="center">
		<input type="hidden" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][after]" value="N" />
		<input type="checkbox" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][after]" value="Y" <?php if ($__tpl_vars['cur']['after'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" /></td>
	<td class="center">
		<input type="text" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][thousands_separator]" size="1" maxlength="1" value="<?php echo $__tpl_vars['cur']['thousands_separator']; ?>
" class="input-text" /></td>
	<td class="center">
		<input type="text" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][decimals_separator]" size="1" maxlength="1" value="<?php echo $__tpl_vars['cur']['decimals_separator']; ?>
" class="input-text" /></td>
	<td class="center">
		<input type="text" name="currencies[<?php echo $__tpl_vars['cur']['currency_code']; ?>
][decimals]" size="1" maxlength="2" value="<?php echo $__tpl_vars['cur']['decimals']; ?>
" class="input-text" /></td>
	<td>
		<?php if ($__tpl_vars['cur']['is_primary'] == 'Y'): ?>
			<?php $this->assign('cur_state', true, false); ?>
		<?php else: ?>
			<?php $this->assign('cur_state', false, false); ?>
		<?php endif; ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['cur']['currency_code'], 'status' => $__tpl_vars['cur']['status'], 'hidden' => "", 'object_id_name' => 'currency_code', 'table' => 'currencies', 'popup_disabled' => $__tpl_vars['cur_state'], )); ?>

<?php $this->assign('prefix', smarty_modifier_default(@$__tpl_vars['prefix'], 'select'), false); ?>
<div class="select-popup-container">
	<div <?php if ($__tpl_vars['id']): ?>id="sw_<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($__tpl_vars['status']); ?>
<?php if ($__tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
		<a <?php if ($__tpl_vars['id']): ?>class="cm-combo-on<?php if (! $__tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php echo $__tpl_vars['items_status'][$__tpl_vars['status']]; ?>

		<?php else: ?>
			<?php if ($__tpl_vars['status'] == 'A'): ?>
				<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'D'): ?>
				<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'H'): ?>
				<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'P'): ?>
				<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

			<?php endif; ?>
		<?php endif; ?>
		</a>
	</div>
	<?php if ($__tpl_vars['id']): ?>
		<div id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box hidden">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
			<ul class="cm-select-list">
			<?php if ($__tpl_vars['items_status']): ?>
				<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }if (count($_from_3342526419)):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
?>
				<li><a class="status-link-<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
 <?php if ($__tpl_vars['status'] == $__tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;status=<?php echo $__tpl_vars['st']; ?>
<?php if ($__tpl_vars['table'] && $__tpl_vars['object_id_name']): ?>&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
<?php endif; ?><?php echo $__tpl_vars['extra']; ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
');" name="update_object_status_callback"><?php echo $__tpl_vars['val']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<li><a class="status-link-a <?php if ($__tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=A" onclick="return fn_check_object_status(this, 'a');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
				<li><a class="status-link-d <?php if ($__tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=D" onclick="return fn_check_object_status(this, 'd');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
				<?php if ($__tpl_vars['hidden']): ?>
				<li><a class="status-link-h <?php if ($__tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=H" onclick="return fn_check_object_status(this, 'h');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($__tpl_vars['notify']): ?>
				<li class="select-field">
					<input type="checkbox" name="__notify_user" id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
					<label for="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$__tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
				</li>
			<?php endif; ?>
			</ul>
		</div>
		<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
		<script type="text/javascript">
		//<![CDATA[
		<?php echo '
		function fn_check_object_status(obj, status) 
		{
			if ($(obj).hasClass(\'cm-active\')) {
				$(obj).removeClass(\'cm-ajax\');
				return false;
			}
			fn_update_object_status(obj, status);
			return true;
		}
		function fn_update_object_status_callback(data, params) 
		{
			if (data.return_status && params.preload_obj) {
				fn_update_object_status(params.preload_obj, data.return_status.toLowerCase());
			}
		}
		function fn_update_object_status(obj, status)
		{
			var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
			var upd_elm = $(\'#\' + upd_elm_id);
			upd_elm.hide();
			if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
				$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
			} else {
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), \'notify_user\'));
			}
			$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
			$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
			$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
			'; ?>

			$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
			<?php echo '
		}
		'; ?>

		//]]>
		</script>
		<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
			<li class="cm-delete-obj" id="del_<?php echo $__tpl_vars['cur']['currency_code']; ?>
"><a class="cm-confirm<?php if ($__tpl_vars['cur']['is_primary'] == 'Y'): ?> hidden<?php endif; ?>" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=currencies.delete&amp;currency_code=<?php echo $__tpl_vars['cur']['currency_code']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a><span class="undeleted-element<?php if ($__tpl_vars['cur']['is_primary'] != 'Y'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['cur']['currency_code'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="buttons-container buttons-bg">
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[currencies.delete]" class="cm-process-items cm-confirm" rev="currency_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[currencies.update]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?>


<?php if ($__tpl_vars['tools_list'] && $__tpl_vars['prefix'] == 'main' && ! $__tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($__tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($__tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $__tpl_vars['hide_tools'] && $__tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($__tpl_vars['override_meta']): ?><?php echo $__tpl_vars['override_meta']; ?>
<?php else: ?>select-link<?php endif; ?><?php if ($__tpl_vars['link_meta']): ?> <?php echo $__tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $__tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $__tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box">
				<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
					<?php echo $__tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $__tpl_vars['hide_actions']): ?>
		<span class="action-add">
			<a<?php if ($__tpl_vars['tool_id']): ?> id="<?php echo $__tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_href']): ?> href="<?php echo $__tpl_vars['tool_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_onclick']): ?> onclick="<?php echo $__tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
		</span>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	
	<div class="float-right">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
		<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_currency" class="cm-form-highlight">
		<div class="object-container">
			<div class="tabs cm-j-tabs">
				<ul>
					<li id="tab_currency_new" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
				</ul>
			</div>

			<div class="cm-tabs-content" id="content_tab_currency_new">
			<fieldset>
				<div class="form-field">
					<label class="cm-required" for="description"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency_description[0][description]" id="description" value="" onfocus="this.value = ''" class="input-text-large main-input" />
				</div>

				<div class="form-field">
					<label class="cm-required" for="currency_code"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][currency_code]" id="currency_code" size="8" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="coefficient"><?php echo fn_get_lang_var('currency_rate', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][coefficient]" id="coefficient" size="7" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="symbol"><?php echo fn_get_lang_var('currency_sign', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][symbol]" id="symbol" size="6" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="after"><?php echo fn_get_lang_var('after_sum', $this->getLanguage()); ?>
:</label>
					<input type="hidden" name="add_currency[0][after]" value="N" />
					<input type="checkbox" name="add_currency[0][after]" id="after" value="Y" class="checkbox" />
				</div>

				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('input_name' => "add_currency[0][status]", 'id' => 'add_currency', )); ?>

<?php if ($__tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $__tpl_vars['input_name']; ?>
" <?php if ($__tpl_vars['input_id']): ?>id="<?php echo $__tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($__tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($__tpl_vars['hidden']): ?>
	<option value="H" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from_3342526419), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
" <?php if ($__tpl_vars['obj']['status'] == $__tpl_vars['st'] || ( ! $__tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
"><?php echo $__tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a" <?php if ($__tpl_vars['obj']['status'] == 'A' || ! $__tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($__tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

				<div class="form-field">
					<label for="thousands_separator"><?php echo fn_get_lang_var('ths_sign', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][thousands_separator]" id="thousands_separator" size="1" maxlength="1" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label for="decimal_separator"><?php echo fn_get_lang_var('dec_sign', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][decimal_separator]" id="decimal_separator" size="1" maxlength="1" value="" class="input-text" />
				</div>

				<div class="form-field">
					<label id="decimals"><?php echo fn_get_lang_var('decimals', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_currency[0][decimals]" id="decimals" size="1" maxlength="1" value="" class="input-text" />
				</div>
			</div>
		</fieldset>
		</div>

		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[currencies.add_currency]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		</form>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_currency','text' => fn_get_lang_var('add_currency', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_currency', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_currency','text' => fn_get_lang_var('add_currency', $this->getLanguage()),'link_text' => fn_get_lang_var('add_currency', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('currencies', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>