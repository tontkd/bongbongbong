<?php /* Smarty version 2.6.18, created on 2011-11-28 13:16:53
         compiled from views/product_options/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/product_options/manage.tpl', 7, false),array('modifier', 'fn_check_view_permissions', 'views/product_options/manage.tpl', 98, false),array('modifier', 'default', 'views/product_options/manage.tpl', 101, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('global','editing_option','no_items','new_option','add_option','new_option','add_option','apply_to_products','remove_this_item','remove_this_item','global_options'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
function fn_check_option_type(value, tag_id)
{
	var id = tag_id.replace(\'option_type_\', \'\');
	$(\'#tab_option_variants_\' + id).toggleBy(!(value == \'S\' || value == \'R\' || value == \'C\'));
	$(\'#extra_options_\' + id).toggleBy(!(value == \'I\' || value == \'T\'));
	
	if (value == \'C\') {
		var t = $(\'table\', \'#content_tab_option_variants_\' + id);
		$(\'.cm-non-cb\', t).switchAvailability(true); // hide obsolete columns
		$(\'tbody:gt(1)\', t).switchAvailability(true); // hide obsolete rows

	} else if (value == \'S\' || value == \'R\') {
		var t = $(\'table\', \'#content_tab_option_variants_\' + id);
		$(\'.cm-non-cb\', t).switchAvailability(false); // show all columns
		$(\'tbody\', t).switchAvailability(false); // show all rows
		$(\'#box_add_variant_\' + id).show(); // show "add new variants" box
		
	} else if (value == \'I\' || value == \'T\') {
		$(\'#extra_options_\' + id).show(); // show "add new variants" box
	}
}
//]]>
</script>
'; ?>


<?php ob_start(); ?>

<?php if ($__tpl_vars['object'] == 'global'): ?>
	<?php $this->assign('select_languages', true, false); ?>
<?php endif; ?>

<div class="items-container" id="product_options_list">
<?php $_from_1070965512 = & $__tpl_vars['product_options']; if (!is_array($_from_1070965512) && !is_object($_from_1070965512)) { settype($_from_1070965512, 'array'); }if (count($_from_1070965512)):
    foreach ($_from_1070965512 as $__tpl_vars['po']):
?>
	<?php if ($__tpl_vars['object'] == 'product' && ! $__tpl_vars['po']['product_id']): ?>
		<?php $this->assign('details', "(".(fn_get_lang_var('global', $this->getLanguage())).")", false); ?>
	<?php else: ?>
		<?php $this->assign('details', "", false); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['po']['option_id'],'id_prefix' => '_product_option_','details' => $__tpl_vars['details'],'text' => $__tpl_vars['po']['option_name'],'status' => $__tpl_vars['po']['status'],'table' => 'product_options','object_id_name' => 'option_id','href' => ($__tpl_vars['index_script'])."?dispatch=product_options.update&option_id=".($__tpl_vars['po']['option_id'])."&product_id=".($__tpl_vars['product_id']),'href_delete' => ($__tpl_vars['index_script'])."?dispatch=product_options.delete&option_id=".($__tpl_vars['po']['option_id'])."&product_id=".($__tpl_vars['product_id']),'rev_delete' => 'product_options_list','header_text' => (fn_get_lang_var('editing_option', $this->getLanguage())).":&nbsp;".($__tpl_vars['po']['option_name']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--product_options_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/product_options/update.tpl", 'smarty_include_vars' => array('mode' => 'add','option_id' => '0')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_option','text' => fn_get_lang_var('new_option', $this->getLanguage()),'link_text' => fn_get_lang_var('add_option', $this->getLanguage()),'act' => 'general','content' => $this->_smarty_vars['capture']['add_new_picker'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	<?php if ($__tpl_vars['object'] == 'global'): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_option','text' => fn_get_lang_var('new_option', $this->getLanguage()),'link_text' => fn_get_lang_var('add_option', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php echo $this->_smarty_vars['capture']['tools']; ?>

	<?php endif; ?>

	<?php if ($__tpl_vars['product_options'] && $__tpl_vars['object'] == 'global'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('apply_to_products', $this->getLanguage()), 'but_role' => 'text', 'but_href' => ($__tpl_vars['index_script'])."?dispatch=product_options.apply", )); ?>

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
	<?php endif; ?>

	<?php echo $__tpl_vars['extra']; ?>

</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($__tpl_vars['object'] == 'product'): ?>
	<?php echo $this->_smarty_vars['capture']['mainbox']; ?>

<?php else: ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('global_options', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_language' => $__tpl_vars['select_language'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
