<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:32
         compiled from pickers/products_picker.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_product_name', 'pickers/products_picker.tpl', 1, false),array('modifier', 'default', 'pickers/products_picker.tpl', 1, false),array('modifier', 'count', 'pickers/products_picker.tpl', 1, false),array('modifier', 'fn_get_selected_product_options_info', 'pickers/products_picker.tpl', 1, false),array('modifier', 'is_array', 'pickers/products_picker.tpl', 10, false),array('modifier', 'explode', 'pickers/products_picker.tpl', 11, false),array('modifier', 'implode', 'pickers/products_picker.tpl', 16, false),array('modifier', 'fn_get_product_options', 'pickers/products_picker.tpl', 60, false),array('modifier', 'fn_check_view_permissions', 'pickers/products_picker.tpl', 115, false),array('modifier', 'escape', 'pickers/products_picker.tpl', 138, false),array('function', 'math', 'pickers/products_picker.tpl', 3, false),array('function', 'script', 'pickers/products_picker.tpl', 8, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('position_short','name','deleted_product','no_items','editing_defined_products','defined_items','name','quantity','options','any_option_combinations','deleted_product','no_items','add_products','remove_this_item','remove_this_item','add_products_and_close','add_products','remove_this_item','remove_this_item','add_products','close','close'));
?>

<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php $this->assign('data_id', ($__tpl_vars['data_id'])."_".($__tpl_vars['rnd']), false); ?>
<?php $this->assign('view_mode', smarty_modifier_default(@$__tpl_vars['view_mode'], 'mixed'), false); ?>
<?php $this->assign('start_pos', smarty_modifier_default(@$__tpl_vars['start_pos'], 0), false); ?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php if ($__tpl_vars['item_ids'] && ! is_array($__tpl_vars['item_ids']) && $__tpl_vars['type'] != 'table'): ?>
	<?php $this->assign('item_ids', explode(",", $__tpl_vars['item_ids']), false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['view_mode'] != 'button'): ?>
<?php if ($__tpl_vars['type'] == 'links'): ?>
	<input type="hidden" id="p<?php echo $__tpl_vars['data_id']; ?>
_ids" name="<?php echo $__tpl_vars['input_name']; ?>
" value="<?php if ($__tpl_vars['item_ids']): ?><?php echo implode(",", $__tpl_vars['item_ids']); ?>
<?php endif; ?>" />
	<?php ob_start(); ?>
	<?php if ($__tpl_vars['picker_view']): ?><div class="object-container"><?php endif; ?>
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<?php if ($__tpl_vars['positions']): ?><th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th><?php endif; ?>
		<th width="100%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
"<?php if (! $__tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('clone' => true,'product' => ($__tpl_vars['ldelim'])."product".($__tpl_vars['rdelim']),'root_id' => $__tpl_vars['data_id'],'delete_id' => ($__tpl_vars['ldelim'])."delete_id".($__tpl_vars['rdelim']),'type' => 'product','position_field' => $__tpl_vars['positions'],'position' => '0')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($__tpl_vars['item_ids']): ?>
	<?php $_from_2649667615 = & $__tpl_vars['item_ids']; if (!is_array($_from_2649667615) && !is_object($_from_2649667615)) { settype($_from_2649667615, 'array'); }$this->_foreach['items'] = array('total' => count($_from_2649667615), 'iteration' => 0);
if ($this->_foreach['items']['total'] > 0):
    foreach ($_from_2649667615 as $__tpl_vars['product']):
        $this->_foreach['items']['iteration']++;
?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('product' => smarty_modifier_default(fn_get_product_name($__tpl_vars['product']), fn_get_lang_var('deleted_product', $this->getLanguage())),'root_id' => $__tpl_vars['data_id'],'delete_id' => $__tpl_vars['product'],'type' => 'product','first_item' => ($this->_foreach['items']['iteration'] <= 1),'position_field' => $__tpl_vars['positions'],'position' => $this->_foreach['items']['iteration']+$__tpl_vars['start_pos'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	</tbody>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
_no_item"<?php if ($__tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<tr class="no-items">
		<td colspan="<?php if ($__tpl_vars['positions']): ?>4<?php else: ?>3<?php endif; ?>"><p><?php echo smarty_modifier_default(@$__tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
	</tr>
	</tbody>
	</table>
	<?php if ($__tpl_vars['picker_view']): ?></div><?php endif; ?>
	<?php $this->_smarty_vars['capture']['products_list'] = ob_get_contents(); ob_end_clean(); ?>
	<?php if ($__tpl_vars['picker_view']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => "inner_".($__tpl_vars['data_id']),'link_text' => count($__tpl_vars['item_ids']),'act' => 'edit','content' => $this->_smarty_vars['capture']['products_list'],'text' => (fn_get_lang_var('editing_defined_products', $this->getLanguage())).":",'link_class' => "text-button-edit")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo fn_get_lang_var('defined_items', $this->getLanguage()); ?>

	<?php else: ?>
		<?php echo $this->_smarty_vars['capture']['products_list']; ?>

	<?php endif; ?>

<?php elseif ($__tpl_vars['type'] == 'table'): ?>

	<table class="table" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th width="80%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
" class="<?php if (! $__tpl_vars['item_ids']): ?>hidden<?php endif; ?> cm-picker-options">
	<?php if ($__tpl_vars['item_ids']): ?>
	<?php $_from_2649667615 = & $__tpl_vars['item_ids']; if (!is_array($_from_2649667615) && !is_object($_from_2649667615)) { settype($_from_2649667615, 'array'); }if (count($_from_2649667615)):
    foreach ($_from_2649667615 as $__tpl_vars['product_id'] => $__tpl_vars['product']):
?>
		<?php ob_start(); ?>
			<?php $this->assign('prod_opts', fn_get_product_options($__tpl_vars['product']['product_id']), false); ?>
			<?php if ($__tpl_vars['prod_opts'] && ! $__tpl_vars['product']['product_options']): ?>
				<strong><?php echo fn_get_lang_var('options', $this->getLanguage()); ?>
: </strong>&nbsp;<?php echo fn_get_lang_var('any_option_combinations', $this->getLanguage()); ?>

			<?php else: ?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => fn_get_selected_product_options_info($__tpl_vars['product']['product_options']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php $this->_smarty_vars['capture']['product_options'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('product' => smarty_modifier_default(fn_get_product_name($__tpl_vars['product']['product_id']), fn_get_lang_var('deleted_product', $this->getLanguage())),'root_id' => $__tpl_vars['data_id'],'delete_id' => ($__tpl_vars['product_id'])."_".($__tpl_vars['data_id']),'input_name' => ($__tpl_vars['input_name'])."[".($__tpl_vars['product_id'])."]",'amount' => $__tpl_vars['product']['amount'],'amount_input' => 'text','type' => 'options','options' => $this->_smarty_vars['capture']['product_options'],'options_array' => $__tpl_vars['product']['product_options'],'product_id' => $__tpl_vars['product']['product_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_product.tpl", 'smarty_include_vars' => array('clone' => true,'product' => ($__tpl_vars['ldelim'])."product".($__tpl_vars['rdelim']),'root_id' => $__tpl_vars['data_id'],'delete_id' => ($__tpl_vars['ldelim'])."delete_id".($__tpl_vars['rdelim']),'input_name' => ($__tpl_vars['input_name'])."[".($__tpl_vars['ldelim'])."product_id".($__tpl_vars['rdelim'])."]",'amount' => '1','amount_input' => 'text','type' => 'options','options' => ($__tpl_vars['ldelim'])."options".($__tpl_vars['rdelim']),'product_id' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</tbody>
	<tbody id="<?php echo $__tpl_vars['data_id']; ?>
_no_item"<?php if ($__tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<tr class="no-items">
		<td colspan="3"><p><?php echo smarty_modifier_default(@$__tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
	</tr>
	</tbody>
	</table>
	<?php if (! $__tpl_vars['display']): ?>
		<?php $this->assign('display', 'options', false); ?>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if ($__tpl_vars['view_mode'] != 'list'): ?>

	<?php $this->assign('but_text', smarty_modifier_default(@$__tpl_vars['but_text'], fn_get_lang_var('add_products', $this->getLanguage())), false); ?>
	<?php if (! $__tpl_vars['no_container']): ?><div class="buttons-container"><?php endif; ?>
		<?php if ($__tpl_vars['picker_view']): ?>[<?php endif; ?>
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
		<?php if ($__tpl_vars['picker_view']): ?>]<?php endif; ?>
	<?php if (! $__tpl_vars['no_container']): ?></div><?php endif; ?>

	<?php ob_start(); ?>
		<?php ob_start(); ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.picker<?php if ($__tpl_vars['display']): ?>&amp;display=<?php echo $__tpl_vars['display']; ?>
<?php endif; ?><?php if ($__tpl_vars['extra_var']): ?>&amp;extra=<?php echo smarty_modifier_escape($__tpl_vars['extra_var'], 'url'); ?>
<?php endif; ?><?php if ($__tpl_vars['checkbox_name']): ?>&amp;checkbox_name=<?php echo $__tpl_vars['checkbox_name']; ?>
<?php endif; ?><?php if ($__tpl_vars['aoc']): ?>&amp;aoc=1<?php endif; ?><?php $this->_smarty_vars['capture']['iframe_url'] = ob_get_contents(); ob_end_clean(); ?>
		<div class="cm-picker-data-container" id="iframe_container_<?php echo $__tpl_vars['data_id']; ?>
"></div>
		<div class="buttons-container">
			<?php if (! $__tpl_vars['extra_var']): ?>
				<?php $this->assign('_but_text', fn_get_lang_var('add_products_and_close', $this->getLanguage()), false); ?>
				<?php $this->assign('_act', "#add_item_close", false); ?>
				<?php ob_start(); ?>
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_type' => 'button', 'but_onclick' => "jQuery.submit_picker('#iframe_".($__tpl_vars['data_id'])."', '#add_item')", 'but_text' => fn_get_lang_var('add_products', $this->getLanguage()), )); ?>

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
			<?php else: ?>
				<?php $this->assign('_but_text', fn_get_lang_var('add_products', $this->getLanguage()), false); ?>
				<?php $this->assign('_act', "#add_item", false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_type' => 'button','but_onclick' => "jQuery.submit_picker('#iframe_".($__tpl_vars['data_id'])."', '".($__tpl_vars['_act'])."')",'but_text' => $__tpl_vars['_but_text'],'cancel_action' => 'close','extra' => $this->_smarty_vars['capture']['extra_buttons'])));
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