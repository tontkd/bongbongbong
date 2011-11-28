<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:43
         compiled from views/memberships/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/memberships/manage.tpl', 3, false),array('function', 'cycle', 'views/memberships/manage.tpl', 19, false),array('modifier', 'default', 'views/memberships/manage.tpl', 33, false),array('modifier', 'lower', 'views/memberships/manage.tpl', 35, false),array('modifier', 'is_array', 'views/memberships/manage.tpl', 38, false),array('modifier', 'yaml_unserialize', 'views/memberships/manage.tpl', 39, false),array('modifier', 'substr_count', 'views/memberships/manage.tpl', 159, false),array('modifier', 'replace', 'views/memberships/manage.tpl', 160, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','membership','type','status','customer','administrator','active','disabled','hidden','pending','active','disabled','hidden','notify_customer','privileges','delete','no_items','delete_selected','choose_action','or','tools','add','general','membership','type','customer','administrator','active','hidden','disabled','status','active','hidden','disabled','add_new_memberships','add_membership','add_new_memberships','add_membership','memberships'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="memberships_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('membership', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['membership']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td width="1%">
		<input type="checkbox" name="membership_ids[]" value="<?php echo $__tpl_vars['membership']['membership_id']; ?>
" class="checkbox cm-item" /></td>
	<td>
		<input type="text" name="membership_data[<?php echo $__tpl_vars['membership']['membership_id']; ?>
][membership]" size="35" value="<?php echo $__tpl_vars['membership']['membership']; ?>
" class="input-text" />
	</td>
	<td>
		<select name="membership_data[<?php echo $__tpl_vars['membership']['membership_id']; ?>
][type]">
			<option value="C" <?php if ($__tpl_vars['membership']['type'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
</option>
			<option value="A" <?php if ($__tpl_vars['membership']['type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>
</option>
		</select></td>
	<td>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['membership']['membership_id'], 'status' => $__tpl_vars['membership']['status'], 'hidden' => "", 'object_id_name' => 'membership_id', 'table' => 'memberships', )); ?>

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
	<td class="nowrap right"><?php if ($__tpl_vars['membership']['type'] == 'A'): ?>
			<?php $this->assign('_href', ($__tpl_vars['index_script'])."?dispatch=memberships.assign_privileges&membership_id=".($__tpl_vars['membership']['membership_id']), false); ?>
			<?php $this->assign('_link_text', fn_get_lang_var('privileges', $this->getLanguage()), false); ?>
		<?php else: ?>
			<?php $this->assign('_href', "", false); ?>
			<?php $this->assign('_link_text', "", false); ?>
		<?php endif; ?>
		
		<?php ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=memberships.delete&amp;membership_id=<?php echo $__tpl_vars['membership']['membership_id']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['membership']['membership_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => $__tpl_vars['_href'],'link_text' => $__tpl_vars['_link_text'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="5"><p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<div class="buttons-container buttons-bg">
	<?php if ($__tpl_vars['memberships']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[memberships.delete]" class="cm-process-items cm-confirm" rev="memberships_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[memberships.update]",'but_role' => 'button_main')));
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
	<?php endif; ?>
	
	<div class="float-right">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
		<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_memberships_form" class="cm-form-highlight">
		<div class="object-container">
			<div class="tabs cm-j-tabs">
				<ul>
					<li id="tab_memberships_new" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
				</ul>
			</div>

			<div class="cm-tabs-content" id="content_tab__memberships_new">
				<div class="form-field">
					<label class="cm-required"><?php echo fn_get_lang_var('membership', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_membership_data[0][membership]" size="35" value="" class="input-text-large main-input" />
				</div>

				<div class="form-field">
					<label><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
					<select name="add_membership_data[0][type]">
						<option value="C"><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
</option>
						<option value="A"><?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>
</option>
					</select>
				</div>

				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('input_name' => "add_membership_data[0][status]", 'id' => 'add_membership_data', )); ?>

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
			</div>
		</div>

		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[memberships.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		</form>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_memberships','text' => fn_get_lang_var('add_new_memberships', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_membership', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_memberships','text' => fn_get_lang_var('add_new_memberships', $this->getLanguage()),'link_text' => fn_get_lang_var('add_membership', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('memberships', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>