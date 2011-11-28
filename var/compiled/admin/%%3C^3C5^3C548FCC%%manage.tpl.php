<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/attachments/views/attachments/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('editing_attachment','no_data','new_attachment','add_attachment'));
?>

<div class="items-container" id="attachments_list">
<?php $_from_4179360321 = & $__tpl_vars['attachments']; if (!is_array($_from_4179360321) && !is_object($_from_4179360321)) { settype($_from_4179360321, 'array'); }if (count($_from_4179360321)):
    foreach ($_from_4179360321 as $__tpl_vars['a']):
?>

	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/attachments/views/attachments/update.tpl", 'smarty_include_vars' => array('mode' => 'update','attachment' => $__tpl_vars['a'],'object_id' => $__tpl_vars['object_id'],'object_type' => $__tpl_vars['object_type'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['object_group'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['object_group'],'id' => $__tpl_vars['a']['attachment_id'],'text' => $__tpl_vars['a']['description'],'status' => $__tpl_vars['a']['status'],'object_id_name' => 'attachment_id','table' => 'attachments','href_delete' => ($__tpl_vars['index_script'])."?dispatch=attachments.delete&attachment_id=".($__tpl_vars['a']['attachment_id'])."&object_id=".($__tpl_vars['object_id'])."&object_type=".($__tpl_vars['object_type']),'rev_delete' => 'attachments_list','header_text' => (fn_get_lang_var('editing_attachment', $this->getLanguage())).": ".($__tpl_vars['a']['description']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--attachments_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/attachments/views/attachments/update.tpl", 'smarty_include_vars' => array('mode' => 'add','attachment' => "",'object_id' => $__tpl_vars['object_id'],'object_type' => $__tpl_vars['object_type'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_attachments_files','text' => fn_get_lang_var('new_attachment', $this->getLanguage()),'link_text' => fn_get_lang_var('add_attachment', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>