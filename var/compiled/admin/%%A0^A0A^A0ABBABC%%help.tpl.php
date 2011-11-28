<?php /* Smarty version 2.6.18, created on 2011-11-28 12:01:18
         compiled from common_templates/help.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('note'));
?>

<?php if ($__tpl_vars['content']): ?>
<div class="float-right">
	<?php ob_start(); ?>
		<div class="object-container">
			<?php echo $__tpl_vars['content']; ?>

		</div>
	<?php $this->_smarty_vars['capture']['notes_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('act' => 'notes','id' => "content_".($__tpl_vars['id'])."_notes",'text' => fn_get_lang_var('note', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['notes_picker'],'link_text' => "?")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>