<?php /* Smarty version 2.6.18, created on 2011-11-28 13:18:26
         compiled from addons/wishlist/views/wishlist/components/add_to_wishlist.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'addons/wishlist/views/wishlist/components/add_to_wishlist.tpl', 29, false),array('modifier', 'escape', 'addons/wishlist/views/wishlist/components/add_to_wishlist.tpl', 42, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_to_wishlist','delete','delete','add_to_wishlist','delete','delete'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['auth']['user_id']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_id' => $__tpl_vars['but_id'], 'but_name' => $__tpl_vars['but_name'], 'but_text' => fn_get_lang_var('add_to_wishlist', $this->getLanguage()), 'but_role' => 'text', 'but_onclick' => $__tpl_vars['but_onclick'], 'but_href' => $__tpl_vars['but_href'], )); ?>

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
<?php else: ?>
	<?php $this->assign('c_url', smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'), false); ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "", 'but_text' => fn_get_lang_var('add_to_wishlist', $this->getLanguage()), 'but_role' => 'text', 'but_href' => ($__tpl_vars['index_script'])."?dispatch=auth.login_form&amp;return_url=".($__tpl_vars['c_url']), 'but_onclick' => "", )); ?>

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
<?php endif; ?>
<?php  ob_end_flush();  ?>