<?php /* Smarty version 2.6.18, created on 2011-11-28 12:07:47
         compiled from views/static_data/components/single_list.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'views/static_data/components/single_list.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('no_data'));
?>

<div class="items-container">
<?php $_from_2456869420 = & $__tpl_vars['static_data']; if (!is_array($_from_2456869420) && !is_object($_from_2456869420)) { settype($_from_2456869420, 'array'); }if (count($_from_2456869420)):
    foreach ($_from_2456869420 as $__tpl_vars['s']):
?>

	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['s']['param_id'],'text' => $__tpl_vars['s']['descr'],'status' => $__tpl_vars['s']['status'],'hidden' => false,'href' => ($__tpl_vars['index_script'])."?dispatch=static_data.update&amp;param_id=".($__tpl_vars['s']['param_id'])."&amp;section=".($__tpl_vars['section']),'object_id_name' => 'param_id','table' => 'static_data','href_delete' => ($__tpl_vars['index_script'])."?dispatch=static_data.delete&amp;param_id=".($__tpl_vars['s']['param_id'])."&amp;section=".($__tpl_vars['section']),'rev_delete' => 'static_data_list','header_text' => smarty_modifier_cat(fn_get_lang_var($__tpl_vars['section_data']['edit_title'], $this->getLanguage()), ": ".($__tpl_vars['s']['descr'])),'link_text' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; unset($_from); ?>
</div>