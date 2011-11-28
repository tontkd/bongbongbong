<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:32
         compiled from views/profiles/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/profiles/manage.tpl', 9, false),array('modifier', 'replace', 'views/profiles/manage.tpl', 45, false),array('modifier', 'fn_query_remove', 'views/profiles/manage.tpl', 56, false),array('modifier', 'date_format', 'views/profiles/manage.tpl', 88, false),array('modifier', 'default', 'views/profiles/manage.tpl', 94, false),array('modifier', 'lower', 'views/profiles/manage.tpl', 96, false),array('modifier', 'is_array', 'views/profiles/manage.tpl', 99, false),array('modifier', 'yaml_unserialize', 'views/profiles/manage.tpl', 100, false),array('modifier', 'trim', 'views/profiles/manage.tpl', 187, false),array('modifier', 'unserialize', 'views/profiles/manage.tpl', 201, false),array('modifier', 'fn_check_view_permissions', 'views/profiles/manage.tpl', 267, false),array('modifier', 'substr_count', 'views/profiles/manage.tpl', 291, false),array('function', 'script', 'views/profiles/manage.tpl', 37, false),array('function', 'cycle', 'views/profiles/manage.tpl', 79, false),array('block', 'hook', 'views/profiles/manage.tpl', 187, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_list_of_user_accounts','text_list_of_all_accounts','check_uncheck_all','id','username','name','email','registered','type','status','administrator','customer','affiliate','supplier','notify_user','active','disabled','hidden','pending','active','disabled','hidden','notify_customer','view_all_orders','act_on_behalf','delete','view_all_orders','act_on_behalf','points','no_data','select_all','unselect_all','export_selected','delete_selected','remove_this_item','remove_this_item','choose_action','or','tools','add','add_user','or','tools','add','add_user','or','tools','add','add_user','or','tools','add','add_user','or','tools','add','users'));
?>

<?php $__parent_tpl_vars = $__tpl_vars; ?>

<script type="text/javascript">
//<![CDATA[

// Message that will show if at least one of required fields isn't filled
var default_country = '<?php echo smarty_modifier_escape($__tpl_vars['settings']['General']['default_country'], 'javascript'); ?>
';
var default_state = [];

<?php echo '
var zip_validators = {
	US: {
		regex: /^(\\d{5})$/,
		format: \'01342\'
	},
	CA: {
		regex: /^(\\w{3} \\w{3})$/,
		format: \'K1A OB1\'
	}
}
'; ?>


var states = new Array();
<?php if ($__tpl_vars['states']): ?>
<?php $_from_990436864 = & $__tpl_vars['states']; if (!is_array($_from_990436864) && !is_object($_from_990436864)) { settype($_from_990436864, 'array'); }if (count($_from_990436864)):
    foreach ($_from_990436864 as $__tpl_vars['country_code'] => $__tpl_vars['country_states']):
?>
states['<?php echo $__tpl_vars['country_code']; ?>
'] = new Array();
<?php $_from_2529267374 = & $__tpl_vars['country_states']; if (!is_array($_from_2529267374) && !is_object($_from_2529267374)) { settype($_from_2529267374, 'array'); }$this->_foreach['fs'] = array('total' => count($_from_2529267374), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from_2529267374 as $__tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
states['<?php echo $__tpl_vars['country_code']; ?>
']['<?php echo smarty_modifier_escape($__tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($__tpl_vars['state']['state'], 'javascript'); ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

//]]>
</script>
<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/users_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "profiles.manage")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['user_type_description']): ?>
<?php echo smarty_modifier_replace(fn_get_lang_var('text_list_of_user_accounts', $this->getLanguage()), "[account]", $__tpl_vars['user_type_description']); ?>

<?php else: ?>
<?php echo fn_get_lang_var('text_list_of_all_accounts', $this->getLanguage()); ?>

<?php endif; ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="userlist_form" id="userlist_form">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="user_type" value="<?php echo $__tpl_vars['_REQUEST']['user_type']; ?>
" />

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'save_current_url' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('c_url', fn_query_remove($__tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>

<?php if ($__tpl_vars['settings']['DHTML']['admin_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>

<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'id'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=id&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('id', $this->getLanguage()); ?>
</a></th>
	<?php if ($__tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
	<th width="25%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'username'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=username&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
</a></th>
	<?php endif; ?>
	<th width="25%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'name'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=name&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</a></th>
	<th width="25%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'email'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=email&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</a></th>
	<th width="20%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'date'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=date&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('registered', $this->getLanguage()); ?>
</a></th>
	<th><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'type'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=type&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</a></th>
	<th width="5%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'status'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=status&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</a></th>
	<th>&nbsp;</th>
</tr>
<?php $_from_2970000245 = & $__tpl_vars['users']; if (!is_array($_from_2970000245) && !is_object($_from_2970000245)) { settype($_from_2970000245, 'array'); }if (count($_from_2970000245)):
    foreach ($_from_2970000245 as $__tpl_vars['user']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td class="center">
		<input type="checkbox" name="user_ids[]" value="<?php echo $__tpl_vars['user']['user_id']; ?>
" class="checkbox cm-item" /></td>
	<td><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
">&nbsp;<strong><?php echo $__tpl_vars['user']['user_id']; ?>
</strong>&nbsp;</a></td>
	<?php if ($__tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
	<td><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
"><?php echo $__tpl_vars['user']['user_login']; ?>
</a></td>
	<?php endif; ?>
	<td><?php if ($__tpl_vars['user']['firstname'] || $__tpl_vars['user']['lastname']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
"><?php echo $__tpl_vars['user']['firstname']; ?>
 <?php echo $__tpl_vars['user']['lastname']; ?>
</a><?php else: ?>-<?php endif; ?></td>
	<td width="25%"><a href="mailto:<?php echo $__tpl_vars['user']['email']; ?>
"><?php echo $__tpl_vars['user']['email']; ?>
</a></td>
	<td><?php echo smarty_modifier_date_format($__tpl_vars['user']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
</td>
	<td><?php if ($__tpl_vars['user']['user_type'] == 'A'): ?><?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>
<?php elseif ($__tpl_vars['user']['user_type'] == 'C'): ?><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
<?php elseif ($__tpl_vars['user']['user_type'] == 'P'): ?><?php echo fn_get_lang_var('affiliate', $this->getLanguage()); ?>
<?php elseif ($__tpl_vars['user']['user_type'] == 'S'): ?><?php echo fn_get_lang_var('supplier', $this->getLanguage()); ?>
<?php endif; ?></td>
	<td>
		<input type="hidden" name="user_types[<?php echo $__tpl_vars['user']['user_id']; ?>
]" value="<?php echo $__tpl_vars['user']['user_type']; ?>
" />
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['user']['user_id'], 'status' => $__tpl_vars['user']['status'], 'hidden' => "", 'update_controller' => 'profiles', 'notify' => true, 'notify_text' => fn_get_lang_var('notify_user', $this->getLanguage()), )); ?>

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
		<?php if ($__tpl_vars['addons']['suppliers']['status'] == 'A'): ?><?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/suppliers/hooks/profiles/list_extra_links.override.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean();
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($__tpl_vars['addon_content'])): ?><?php echo $__tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "profiles:list_extra_links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($__tpl_vars['user']['user_type'] == 'C'): ?>
				<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
"><?php echo fn_get_lang_var('view_all_orders', $this->getLanguage()); ?>
</a></li>
				<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.act_as_user&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
" target="_blank" ><?php echo fn_get_lang_var('act_on_behalf', $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
			<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.delete&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
&amp;redirect_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php if ($__tpl_vars['addons']['affiliate']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['user']['user_type'] == 'P'): ?>
	<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.manage&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
"><?php echo fn_get_lang_var('view_all_orders', $this->getLanguage()); ?>
</a></li>
	<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.act_as_user&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
" target="_blank" ><?php echo fn_get_lang_var('act_on_behalf', $this->getLanguage()); ?>
</a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['user']['user_type'] == 'C'): ?>
	<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=reward_points.userlog&amp;user_id=<?php echo $__tpl_vars['user']['user_id']; ?>
"><?php echo fn_get_lang_var('points', $this->getLanguage()); ?>
 (<?php if ($__tpl_vars['user']['points']): ?><?php echo unserialize($__tpl_vars['user']['points']); ?>
<?php else: ?>0<?php endif; ?>)</a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['user']['user_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => ($__tpl_vars['index_script'])."?dispatch=profiles.update&user_id=".($__tpl_vars['user']['user_id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="9"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php if ($__tpl_vars['users']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('href' => "#users", )); ?>

<div class="table-tools">
	<a href="<?php echo $__tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-on underlined"><?php echo fn_get_lang_var('select_all', $this->getLanguage()); ?>
</a>|
	<a href="<?php echo $__tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-off underlined"><?php echo fn_get_lang_var('unselect_all', $this->getLanguage()); ?>
</a>
	</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="buttons-container buttons-bg">
	<?php if ($__tpl_vars['users']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a class="cm-process-items" name="dispatch[profiles.export_range]" rev="userlist_form"><?php echo fn_get_lang_var('export_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('delete_selected', $this->getLanguage()), 'but_name' => "dispatch[profiles.m_delete]", 'but_meta' => "cm-confirm cm-process-items", 'but_role' => 'button_main', )); ?>

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
	<?php if ($__tpl_vars['_REQUEST']['user_type']): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=profiles.add&user_type=".($__tpl_vars['_REQUEST']['user_type']), 'prefix' => 'bottom', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_user', $this->getLanguage()), )); ?>


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
	<?php else: ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=profiles.add", 'prefix' => 'bottom', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_user', $this->getLanguage()), )); ?>


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
	<?php endif; ?>
	</div>
</div>

<?php ob_start(); ?>
	<?php if ($__tpl_vars['_REQUEST']['user_type']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=profiles.add&user_type=".($__tpl_vars['_REQUEST']['user_type']), 'prefix' => 'top', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_user', $this->getLanguage()), )); ?>


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
	<?php else: ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=profiles.add", 'prefix' => 'top', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_user', $this->getLanguage()), )); ?>


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
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('users', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>