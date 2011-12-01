<?php /* Smarty version 2.6.18, created on 2011-11-30 23:41:17
         compiled from addons/news_and_emails/views/subscribers/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/news_and_emails/views/subscribers/manage.tpl', 3, false),array('function', 'html_checkboxes', 'addons/news_and_emails/views/subscribers/manage.tpl', 164, false),array('modifier', 'date_format', 'addons/news_and_emails/views/subscribers/manage.tpl', 31, false),array('modifier', 'count', 'addons/news_and_emails/views/subscribers/manage.tpl', 31, false),array('modifier', 'replace', 'addons/news_and_emails/views/subscribers/manage.tpl', 31, false),array('modifier', 'substr_count', 'addons/news_and_emails/views/subscribers/manage.tpl', 111, false),array('modifier', 'default', 'addons/news_and_emails/views/subscribers/manage.tpl', 117, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','email','registered','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','subscribed_to','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','extra','delete','mailing_list','format','language','subscribed','confirmed','txt_format','html_format','no_data','no_data','add_subscribers_from_users','delete_selected','choose_action','or','tools','add','add_new_subscribers','add_subscriber','general','email','mailing_lists','format','txt_format','html_format','language','confirmed','notify_user','add_new_subscribers','add_subscriber','subscribers'));
?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/news_and_emails/views/subscribers/components/subscribers_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "subscribers.manage")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="subscribers_form">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="50%"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</th>
	<th width="50%"><?php echo fn_get_lang_var('registered', $this->getLanguage()); ?>
</th>
	<th width="1%">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_st" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combinations-subscribers" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_st" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combinations-subscribers" /></th>
	<th>&nbsp;</th>
</tr>
<?php $_from_2239212903 = & $__tpl_vars['subscribers']; if (!is_array($_from_2239212903) && !is_object($_from_2239212903)) { settype($_from_2239212903, 'array'); }if (count($_from_2239212903)):
    foreach ($_from_2239212903 as $__tpl_vars['s']):
?>
<tbody class="hover">
<tr>
	<td class="center">
   		<input type="checkbox" name="subscriber_ids[]" value="<?php echo $__tpl_vars['s']['subscriber_id']; ?>
" class="checkbox cm-item" /></td>
	<td><input type="hidden" name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][email]" value="<?php echo $__tpl_vars['s']['email']; ?>
" />
		<a href="mailto:<?php echo $__tpl_vars['s']['email']; ?>
"><?php echo $__tpl_vars['s']['email']; ?>
</a></td>
	<td>
		<?php echo smarty_modifier_date_format($__tpl_vars['s']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
,&nbsp;<?php $this->assign('count', count($__tpl_vars['s']['mailing_lists']), false); ?><?php echo smarty_modifier_replace(fn_get_lang_var('subscribed_to', $this->getLanguage()), "[num]", $__tpl_vars['count']); ?>

	</td>
	<td class="center nowrap">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_subscribers_<?php echo $__tpl_vars['s']['subscriber_id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combination-subscribers" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_subscribers_<?php echo $__tpl_vars['s']['subscriber_id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combination-subscribers" /><a id="sw_subscribers_<?php echo $__tpl_vars['s']['subscriber_id']; ?>
" class="cm-combination-subscribers"><?php echo fn_get_lang_var('extra', $this->getLanguage()); ?>
</a>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=subscribers.delete&amp;subscriber_id=<?php echo $__tpl_vars['s']['subscriber_id']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['s']['subscriber_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<tr id="subscribers_<?php echo $__tpl_vars['s']['subscriber_id']; ?>
" class="hidden">
	<td>&nbsp;</td>
	<td colspan="6">
		<table cellpadding="5" cellspacing="0" border="0" class="table">
		<tr>
			<th><?php echo fn_get_lang_var('mailing_list', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('format', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('subscribed', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('confirmed', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from_1568803587 = & $__tpl_vars['mailing_lists']; if (!is_array($_from_1568803587) && !is_object($_from_1568803587)) { settype($_from_1568803587, 'array'); }if (count($_from_1568803587)):
    foreach ($_from_1568803587 as $__tpl_vars['list_id'] => $__tpl_vars['list']):
?>
			<tr>
				<td><?php echo $__tpl_vars['list']; ?>
</td>
				<td>
					<select name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][mailing_lists][<?php echo $__tpl_vars['list_id']; ?>
][format]">
					<option value="<?php echo @NEWSLETTER_FORMAT_TXT; ?>
"  <?php if ($__tpl_vars['s']['mailing_lists'][$__tpl_vars['list_id']]['format'] == @NEWSLETTER_FORMAT_TXT): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('txt_format', $this->getLanguage()); ?>
</option>
					<option value="<?php echo @NEWSLETTER_FORMAT_HTML; ?>
" <?php if ($__tpl_vars['s']['mailing_lists'][$__tpl_vars['list_id']]['format'] == @NEWSLETTER_FORMAT_HTML): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('html_format', $this->getLanguage()); ?>
</option>
					</select>
				</td>
				<td>
					<select name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][mailing_lists][<?php echo $__tpl_vars['list_id']; ?>
][lang_code]">
					<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['lng']):
?>
					<option value="<?php echo $__tpl_vars['lng']['lang_code']; ?>
" <?php if ($__tpl_vars['s']['mailing_lists'][$__tpl_vars['list_id']]['lang_code'] == $__tpl_vars['lng']['lang_code']): ?>selected="selected"<?php endif; ?> ><?php echo $__tpl_vars['lng']['name']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
				<td class="center">
					<input type="checkbox" name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][list_ids][]" value="<?php echo $__tpl_vars['list_id']; ?>
" <?php if ($__tpl_vars['s']['mailing_lists'][$__tpl_vars['list_id']]): ?>checked="checked"<?php endif; ?> class="checkbox cm-item-<?php echo $__tpl_vars['id']; ?>
"></td>
				<td>
					<input type="hidden" name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][mailing_lists][<?php echo $__tpl_vars['list_id']; ?>
][confirmed]" value="0" />
					<input type="checkbox" name="subscribers[<?php echo $__tpl_vars['s']['subscriber_id']; ?>
][mailing_lists][<?php echo $__tpl_vars['list_id']; ?>
][confirmed]" value="1" <?php if ($__tpl_vars['s']['mailing_lists'][$__tpl_vars['list_id']]['confirmed']): ?>checked="checked"<?php endif; ?> class="checkbox" />
				</td>
			</tr>
		<?php endforeach; else: ?>
			<tr class="no-items">
				<td colspan="5"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
			</tr>
		<?php endif; unset($_from); ?>
		</table>
		
	</td>
</tr>
</tbody>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="5"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/users_picker.tpl", 'smarty_include_vars' => array('data_id' => 'subscr_user','opts_file' => "addons/news_and_emails/views/subscribers/components/picker_opts.tpl",'extra_var' => "dispatch=subscribers.add_users&list_id=".($__tpl_vars['_REQUEST']['list_id']),'but_text' => fn_get_lang_var('add_subscribers_from_users', $this->getLanguage()),'view_mode' => 'button')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="buttons-container buttons-bg">
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[subscribers.delete]" class="cm-process-items cm-confirm" rev="subscribers_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[subscribers.m_update]",'but_role' => 'button_main')));
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
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_subscribers','text' => fn_get_lang_var('add_new_subscribers', $this->getLanguage()),'link_text' => fn_get_lang_var('add_subscriber', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>


<?php ob_start(); ?>
<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="subscribers_form_0" class="cm-form-highlight">

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_mailing_list_details_0" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content" id="content_tab_mailing_list_details_0">
	<fieldset>
		<div class="form-field">
			<label for="subscribers_email_0" class="cm-required cm-email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
			<input type="text" name="add_subscribers[0][email]" id="subscribers_email_0" value="" class="input-text-large main-input" />
		</div>

		<?php if ($__tpl_vars['mailing_lists']): ?>
		<div class="form-field">
			<label class="cm-required"><?php echo fn_get_lang_var('mailing_lists', $this->getLanguage()); ?>
:</label>
			<?php echo smarty_function_html_checkboxes(array('name' => "add_subscribers[0][list_ids]",'options' => $__tpl_vars['mailing_lists'],'columns' => 3), $this);?>

		</div>
		<?php endif; ?>

		<div class="form-field">
			<label for="elm_format_0" class="cm-required"><?php echo fn_get_lang_var('format', $this->getLanguage()); ?>
:</label>
			<select id="elm_format_0" name="add_subscribers[0][format]">
				<option value="<?php echo @NEWSLETTER_FORMAT_TXT; ?>
"><?php echo fn_get_lang_var('txt_format', $this->getLanguage()); ?>
</option>
				<option value="<?php echo @NEWSLETTER_FORMAT_HTML; ?>
" selected="selected"><?php echo fn_get_lang_var('html_format', $this->getLanguage()); ?>
</option>
			</select>
		</div>

		<div class="form-field">
			<label for="elm_lang_0" class="cm-required"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
:</label>
			<select id="elm_lang_0" name="add_subscribers[0][lang_code]">
				<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['lng']):
?>
					<option value="<?php echo $__tpl_vars['lng']['lang_code']; ?>
"><?php echo $__tpl_vars['lng']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="form-field">
			<label for="elm_conf_0"><?php echo fn_get_lang_var('confirmed', $this->getLanguage()); ?>
:</label>
			<input type="hidden" name="add_subscribers[0][confirmed]" value="0" />
			<input id="elm_conf_0" type="checkbox" name="add_subscribers[0][confirmed]" value="1" class="checkbox" />
		</div>

		<div class="form-field">
			<label for="elm_notify_0"><?php echo fn_get_lang_var('notify_user', $this->getLanguage()); ?>
:</label>
			<input type="hidden" name="add_subscribers[0][notify_user]" value="0" />
			<input id="elm_notify_0" type="checkbox" name="add_subscribers[0][notify_user]" value="1" class="checkbox" />
		</div>

	</fieldset>
	</div>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[subscribers.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_subscribers','text' => fn_get_lang_var('add_new_subscribers', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_subscriber', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('subscribers', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>