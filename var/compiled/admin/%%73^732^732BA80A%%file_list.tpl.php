<?php /* Smarty version 2.6.18, created on 2011-12-01 22:48:41
         compiled from views/template_editor/components/file_list.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'in_array', 'views/template_editor/components/file_list.tpl', 19, false),array('modifier', 'escape', 'views/template_editor/components/file_list.tpl', 22, false),array('modifier', 'default', 'views/template_editor/components/file_list.tpl', 23, false),array('modifier', 'fn_check_view_permissions', 'views/template_editor/components/file_list.tpl', 52, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('download','download','remove_this_item','remove_this_item'));
?>
<?php  ob_start();  ?>
<table cellspacing="0" cellpadding="1" border="0" width="100%">
<tr>
	<?php $_from_3424634080 = & $__tpl_vars['columns']; if (!is_array($_from_3424634080) && !is_object($_from_3424634080)) { settype($_from_3424634080, 'array'); }$this->_foreach['it'] = array('total' => count($_from_3424634080), 'iteration' => 0);
if ($this->_foreach['it']['total'] > 0):
    foreach ($_from_3424634080 as $__tpl_vars['col']):
        $this->_foreach['it']['iteration']++;
?>
	<td valign="top" width="50%">
		<table cellspacing="0" cellpadding="2" border="0" width="100%">
		<?php $_from_2608607126 = & $__tpl_vars['col']; if (!is_array($_from_2608607126) && !is_object($_from_2608607126)) { settype($_from_2608607126, 'array'); }$this->_foreach['it'] = array('total' => count($_from_2608607126), 'iteration' => 0);
if ($this->_foreach['it']['total'] > 0):
    foreach ($_from_2608607126 as $__tpl_vars['item']):
        $this->_foreach['it']['iteration']++;
?>
		<?php $this->assign('forbidden', false, false); ?>
		<?php if ($__tpl_vars['item']['type'] == 'F'): ?>
			<?php $this->assign('file_ext', "", false); ?>
			<?php if ($__tpl_vars['item']['ext'] == 'gif'): ?><?php $this->assign('file_ext', 'gif', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'jpg'): ?><?php $this->assign('file_ext', 'jpg', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'html' || $__tpl_vars['item']['ext'] == 'htm'): ?><?php $this->assign('file_ext', 'html', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'tgz' || $__tpl_vars['item']['ext'] == 'zip' || $__tpl_vars['item']['ext'] == 'zip2' || $__tpl_vars['item']['ext'] == 'gz' || $__tpl_vars['item']['ext'] == 'bz' || $__tpl_vars['item']['ext'] == 'rar'): ?><?php $this->assign('file_ext', 'zip', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'php' || $__tpl_vars['item']['ext'] == 'tpl' || $__tpl_vars['item']['ext'] == 'txt'): ?><?php $this->assign('file_ext', 'tpl', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'css'): ?><?php $this->assign('file_ext', 'css', false); ?><?php endif; ?>
			<?php if ($__tpl_vars['item']['ext'] == 'js'): ?><?php $this->assign('file_ext', 'js', false); ?><?php endif; ?>
			<?php if (smarty_modifier_in_array($__tpl_vars['item']['ext'], $__tpl_vars['config']['forbidden_file_extensions'])): ?><?php $this->assign('forbidden', true, false); ?><?php endif; ?>
		<?php endif; ?>
		<tr id="row_<?php echo $__tpl_vars['item']['name']; ?>
" title="<?php echo $__tpl_vars['item']['perms']; ?>
" class="items">
			<td onclick="template_editor.select_file('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
', '<?php echo $__tpl_vars['item']['type']; ?>
')" ondblclick="<?php if ($__tpl_vars['item']['type'] == 'D'): ?>template_editor.chdir('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php elseif (! $__tpl_vars['forbidden']): ?>template_editor.show_content('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php endif; ?>" align="center">
				<a href="javascript:<?php if ($__tpl_vars['item']['type'] == 'D'): ?>template_editor.chdir('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php elseif (! $__tpl_vars['forbidden']): ?>template_editor.show_content('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php endif; ?>"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_<?php if ($__tpl_vars['item']['type'] == 'D'): ?>folder<?php echo $__tpl_vars['item']['skin_type']; ?>
<?php if ($__tpl_vars['item']['name'] == ".."): ?>_up<?php endif; ?><?php else: ?><?php echo smarty_modifier_default(@$__tpl_vars['file_ext'], 'file'); ?>
<?php endif; ?>.gif" alt="" border="0" /></a></td>
			<td onclick="template_editor.select_file('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
', '<?php echo $__tpl_vars['item']['type']; ?>
')" ondblclick="<?php if ($__tpl_vars['item']['type'] == 'D'): ?>template_editor.chdir('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php elseif (! $__tpl_vars['forbidden']): ?>template_editor.show_content('<?php echo smarty_modifier_escape($__tpl_vars['item']['name'], 'javascript'); ?>
');<?php endif; ?>" width="100%">
				<?php if (! $__tpl_vars['forbidden']): ?><div class="float-right hidden cm-download"><a href="javascript: template_editor.get_file();"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_download.gif" width="16" height="16" border="0" alt="<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
" align="middle" /></a></div><?php endif; ?>
				<a href="javascript: void(0);"><?php echo $__tpl_vars['item']['name']; ?>
</a>&nbsp;<?php if (! $__tpl_vars['forbidden']): ?><span class="hidden cm-delete-file"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_href' => "javascript: template_editor.delete_file();", 'but_role' => 'delete_item', )); ?>

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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span><?php endif; ?>
				</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	</td>
	<?php endforeach; endif; unset($_from); ?>
</tr>
</table>
<?php  ob_end_flush();  ?>