<?php /* Smarty version 2.6.18, created on 2011-12-01 22:50:35
         compiled from pickers/users_picker.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'pickers/users_picker.tpl', 3, false),array('function', 'script', 'pickers/users_picker.tpl', 7, false),array('modifier', 'default', 'pickers/users_picker.tpl', 5, false),array('modifier', 'is_array', 'pickers/users_picker.tpl', 9, false),array('modifier', 'explode', 'pickers/users_picker.tpl', 10, false),array('modifier', 'implode', 'pickers/users_picker.tpl', 17, false),array('modifier', 'fn_get_user_short_info', 'pickers/users_picker.tpl', 28, false),array('modifier', 'fn_check_view_permissions', 'pickers/users_picker.tpl', 71, false),array('modifier', 'escape', 'pickers/users_picker.tpl', 93, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name','no_items','add_users','remove_this_item','remove_this_item','add_users','choose','add_users_and_close','choose','add_users','remove_this_item','remove_this_item','close','close'));
?>

<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php $this->assign('data_id', ($__tpl_vars['data_id'])."_".($__tpl_vars['rnd']), false); ?>
<?php $this->assign('view_mode', smarty_modifier_default(@$__tpl_vars['view_mode'], 'mixed'), false); ?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php if ($__tpl_vars['item_ids'] && ! is_array($__tpl_vars['item_ids'])): ?>
	<?php $this->assign('item_ids', explode(",", $__tpl_vars['item_ids']), false); ?>
<?php endif; ?>

<?php $this->assign('display', smarty_modifier_default(@$__tpl_vars['display'], 'checkbox'), false); ?>

<?php if ($__tpl_vars['view_mode'] != 'button'): ?>
<?php if ($__tpl_vars['display'] != 'radio'): ?>
	<input id="u<?php echo $__tpl_vars['data_id']; ?>
_ids" type="hidden" name="<?php echo $__tpl_vars['input_name']; ?>
" value="<?php if ($__tpl_vars['item_ids']): ?><?php echo implode(",", $__tpl_vars['item_ids']); ?>
<?php endif; ?>" />

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th width="100%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
"<?php if (! $__tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_user.tpl", 'smarty_include_vars' => array('user_id' => ($__tpl_vars['ldelim'])."user_id".($__tpl_vars['rdelim']),'email' => ($__tpl_vars['ldelim'])."email".($__tpl_vars['rdelim']),'user_name' => ($__tpl_vars['ldelim'])."user_name".($__tpl_vars['rdelim']),'holder' => $__tpl_vars['data_id'],'clone' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($__tpl_vars['item_ids']): ?>
	<?php $_from_2649667615 = & $__tpl_vars['item_ids']; if (!is_array($_from_2649667615) && !is_object($_from_2649667615)) { settype($_from_2649667615, 'array'); }$this->_foreach['items'] = array('total' => count($_from_2649667615), 'iteration' => 0);
if ($this->_foreach['items']['total'] > 0):
    foreach ($_from_2649667615 as $__tpl_vars['user']):
        $this->_foreach['items']['iteration']++;
?>
		<?php $this->assign('user_info', fn_get_user_short_info($__tpl_vars['user']), false); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_user.tpl", 'smarty_include_vars' => array('user_id' => $__tpl_vars['user'],'email' => $__tpl_vars['user_info']['email'],'user_name' => ($__tpl_vars['user_info']['firstname'])." ".($__tpl_vars['user_info']['lastname']),'holder' => $__tpl_vars['data_id'],'first_item' => ($this->_foreach['items']['iteration'] <= 1))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	</tbody>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
_no_item"<?php if ($__tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<tr class="no-items">
		<td colspan="2"><p><?php echo smarty_modifier_default(@$__tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
	</tr>
	</tbody>
	</table>
<?php endif; ?>
<?php endif; ?>

<?php if ($__tpl_vars['view_mode'] != 'list'): ?>
	<?php $this->assign('but_text', smarty_modifier_default(@$__tpl_vars['but_text'], fn_get_lang_var('add_users', $this->getLanguage())), false); ?>
	<?php if (! $__tpl_vars['no_container']): ?><div class="buttons-container"><?php endif; ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_id' => "opener_picker_".($__tpl_vars['data_id']), 'but_text' => $__tpl_vars['but_text'], 'but_onclick' => "jQuery.show_picker('picker_".($__tpl_vars['data_id'])."', this.id);", 'but_role' => 'add', 'but_meta' => "text-button", )); ?>

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
	<?php if (! $__tpl_vars['no_container']): ?></div><?php endif; ?>

	<?php ob_start(); ?>
		<?php ob_start(); ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.picker<?php if ($__tpl_vars['display']): ?>&amp;display=<?php echo $__tpl_vars['display']; ?>
<?php endif; ?><?php if ($__tpl_vars['extra_var']): ?>&amp;extra=<?php echo smarty_modifier_escape($__tpl_vars['extra_var'], 'url'); ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['iframe_url'] = ob_get_contents(); ob_end_clean(); ?>
		<div class="cm-picker-data-container" id="iframe_container_<?php echo $__tpl_vars['data_id']; ?>
"></div>

		<?php if ($__tpl_vars['opts_file']): ?>
			<div id="users_picker_form_inject" class="cm-picker-options-container">
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $__tpl_vars['opts_file'], 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<?php $this->assign('_mode', "#users_picker_form_inject", false); ?>
		<?php else: ?>
			<?php $this->assign('_mode', "", false); ?>
		<?php endif; ?>

		<div class="buttons-container">
			<?php if ($__tpl_vars['extra_var']): ?>
				<?php $this->assign('_act', "#add_item", false); ?>
				<?php if ($__tpl_vars['display'] == 'checkbox'): ?>
					<?php $this->assign('_but_text', fn_get_lang_var('add_users', $this->getLanguage()), false); ?>
				<?php elseif ($__tpl_vars['display'] == 'radio'): ?>
					<?php $this->assign('_but_text', fn_get_lang_var('choose', $this->getLanguage()), false); ?>
				<?php endif; ?>
			<?php else: ?>
				<?php if ($__tpl_vars['display'] == 'checkbox'): ?>
					<?php $this->assign('_but_text', fn_get_lang_var('add_users_and_close', $this->getLanguage()), false); ?>
					<?php $this->assign('_act', "#add_item_close", false); ?>
				<?php elseif ($__tpl_vars['display'] == 'radio'): ?>
					<?php $this->assign('_but_text', fn_get_lang_var('choose', $this->getLanguage()), false); ?>
					<?php $this->assign('_act', "#add_item", false); ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if (! $__tpl_vars['extra_var']): ?>
				<?php ob_start(); ?>
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('add_users', $this->getLanguage()), 'but_type' => 'button', 'but_onclick' => "jQuery.submit_picker('#iframe_".($__tpl_vars['data_id'])."', '#add_item', '#users_picker_form_inject')", )); ?>

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
				<?php $this->_smarty_vars['capture']['extra_buttons'] = ob_get_contents(); ob_end_clean(); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_type' => 'button','but_onclick' => "jQuery.submit_picker('#iframe_".($__tpl_vars['data_id'])."', '".($__tpl_vars['_act'])."', '".($__tpl_vars['_mode'])."')",'but_text' => $__tpl_vars['_but_text'],'cancel_action' => 'close','extra' => $this->_smarty_vars['capture']['extra_buttons'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php $this->_smarty_vars['capture']['picker_content'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('picker_content' => $this->_smarty_vars['capture']['picker_content'], 'data_id' => $__tpl_vars['data_id'], 'but_text' => $__tpl_vars['but_text'], )); ?>

<div class="popup-content cm-popup-box cm-picker hidden" id="picker_<?php echo $__tpl_vars['data_id']; ?>
">
	<div class="cm-popup-hor-resizer cm-left-resizer"></div>
	<div class="cm-popup-hor-resizer cm-right-resizer"></div>
	<div class="cm-popup-corner-resizer cm-nw-resizer"></div>
	<div class="cm-popup-corner-resizer cm-ne-resizer"></div>
	<div class="cm-popup-corner-resizer cm-sw-resizer"></div>
	<div class="cm-popup-corner-resizer cm-se-resizer"></div>
	<div class="cm-popup-vert-resizer cm-top-resizer"></div>
	<div class="cm-popup-content-header">
		<div class="float-right">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" class="hand cm-popup-switch" />
		</div>
		<h3><?php echo $__tpl_vars['but_text']; ?>
:</h3>
	</div>
	<div class="cm-popup-content-footer">
		<?php echo $__tpl_vars['picker_content']; ?>

	</div>
	<div class="cm-popup-vert-resizer cm-bottom-resizer"></div>
</div>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<script type="text/javascript">
	//<![CDATA[
		iframe_urls['<?php echo $__tpl_vars['data_id']; ?>
'] = '<?php echo smarty_modifier_escape($this->_smarty_vars['capture']['iframe_url'], 'javascript'); ?>
';
		<?php if ($__tpl_vars['extra_var']): ?>
		iframe_extra['<?php echo $__tpl_vars['data_id']; ?>
'] = '<?php echo smarty_modifier_escape($__tpl_vars['extra_var'], 'javascript'); ?>
';
		<?php endif; ?>
	//]]>
	</script>
<?php endif; ?>