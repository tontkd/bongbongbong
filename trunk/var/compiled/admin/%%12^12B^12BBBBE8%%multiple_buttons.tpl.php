<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:59
         compiled from buttons/multiple_buttons.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'buttons/multiple_buttons.tpl', 3, false),array('modifier', 'default', 'buttons/multiple_buttons.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_empty_item','add_empty_item','clone_this_item','clone_this_item','remove_this_item','remove_this_item','remove_this_item','remove_this_item'));
?>
<?php  ob_start();  ?>
<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('tag_level', smarty_modifier_default(@$__tpl_vars['tag_level'], '1'), false); ?>
<?php if ($__tpl_vars['only_delete'] != 'Y'): ?><span class="nowrap"><?php if (! $__tpl_vars['hide_add']): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_onclick' => "$('#box_' + this.id).cloneNode(".($__tpl_vars['tag_level'])."); ".($__tpl_vars['on_add']), 'item_id' => $__tpl_vars['item_id'], )); ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_add.gif" width="13" height="18" border="0" name="add" id="<?php echo $__tpl_vars['item_id']; ?>" alt="<?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?>" onclick="<?php echo $__tpl_vars['but_onclick']; ?>" class="hand" align="top" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;<?php endif; ?><?php if (! $__tpl_vars['hide_clone']): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_onclick' => "$('#box_' + this.id).cloneNode(".($__tpl_vars['tag_level']).", true);", 'item_id' => $__tpl_vars['item_id'], )); ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_clone.gif" width="13" height="18" border="0" name="clone" id="<?php echo $__tpl_vars['item_id']; ?>" title="<?php echo fn_get_lang_var('clone_this_item', $this->getLanguage()); ?>" alt="<?php echo fn_get_lang_var('clone_this_item', $this->getLanguage()); ?>" onclick="<?php echo $__tpl_vars['but_onclick']; ?>" class="hand" align="top" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;<?php endif; ?><?php endif; ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('only_delete' => $__tpl_vars['only_delete'], 'but_class' => "cm-delete-row", )); ?><?php if (! $__tpl_vars['simple']): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete_disabled.gif" width="12" height="18" border="0" name="remove" id="<?php echo $__tpl_vars['item_id']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" class="hand<?php if ($__tpl_vars['only_delete'] == 'Y'): ?> hidden<?php endif; ?>" align="top" /><?php endif; ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/icon_delete.gif" width="12" height="18" border="0" name="remove_hidden" id="<?php echo $__tpl_vars['item_id']; ?>" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>"<?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>"<?php endif; ?> class="hand<?php if (! $__tpl_vars['simple'] && $__tpl_vars['only_delete'] != 'Y'): ?> hidden<?php endif; ?><?php if ($__tpl_vars['but_class']): ?> <?php echo $__tpl_vars['but_class']; ?><?php endif; ?>" align="top" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;</span>
<?php  ob_end_flush();  ?>