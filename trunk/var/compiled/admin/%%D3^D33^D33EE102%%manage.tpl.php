<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:23
         compiled from views/products/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/products/manage.tpl', 3, false),array('function', 'cycle', 'views/products/manage.tpl', 37, false),array('function', 'math', 'views/products/manage.tpl', 244, false),array('function', 'split', 'views/products/manage.tpl', 246, false),array('modifier', 'fn_query_remove', 'views/products/manage.tpl', 14, false),array('modifier', 'unescape', 'views/products/manage.tpl', 49, false),array('modifier', 'fn_check_view_permissions', 'views/products/manage.tpl', 85, false),array('modifier', 'default', 'views/products/manage.tpl', 88, false),array('modifier', 'lower', 'views/products/manage.tpl', 114, false),array('modifier', 'is_array', 'views/products/manage.tpl', 117, false),array('modifier', 'yaml_unserialize', 'views/products/manage.tpl', 118, false),array('modifier', 'count', 'views/products/manage.tpl', 244, false),array('modifier', 'sort_by', 'views/products/manage.tpl', 246, false),array('modifier', 'md5', 'views/products/manage.tpl', 257, false),array('modifier', 'substr_count', 'views/products/manage.tpl', 295, false),array('modifier', 'replace', 'views/products/manage.tpl', 296, false),array('block', 'hook', 'views/products/manage.tpl', 32, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','position_short','code','name','price','list_price','quantity','status','edit','remove_this_item','remove_this_item','active','disabled','hidden','pending','active','disabled','hidden','notify_customer','delete','no_data','select_all','unselect_all','text_select_fields2edit_note','select_all','unselect_all','modify_selected','clone_selected','export_selected','delete_selected','edit_selected','choose_action','or','tools','add','select_fields_to_edit','add_product','or','tools','add','add_product','or','tools','add','products'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "products.manage")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="manage_products_form">
<input type="hidden" name="category_id" value="<?php echo $__tpl_vars['search']['cid']; ?>
" />

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'save_current_url' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('c_url', fn_query_remove($__tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>

<?php if ($__tpl_vars['settings']['DHTML']['admin_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th class="center">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<?php if ($__tpl_vars['search']['cid'] && $__tpl_vars['search']['subcats'] != 'Y'): ?>
	<th><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'position'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=position&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</a></th>
	<?php endif; ?>
	<th width="10%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'code'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=code&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
</a></th>
	<th width="50%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'product'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=product&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</a></th>
	<th width="10%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'price'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=price&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
)</a></th>
	<th width="10%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'list_price'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=list_price&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
)</a></th>
	<th width="10%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'amount'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=amount&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</a></th>
	<th><?php $this->_tag_stack[] = array('hook', array('name' => "products:manage_head")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	<th width="10%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'status'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=status&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</a></th>
	<th>&nbsp;</th>
</tr>
<?php $_from_2374589378 = & $__tpl_vars['products']; if (!is_array($_from_2374589378) && !is_object($_from_2374589378)) { settype($_from_2374589378, 'array'); }if (count($_from_2374589378)):
    foreach ($_from_2374589378 as $__tpl_vars['product']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td class="center">
   		<input type="checkbox" name="product_ids[]" value="<?php echo $__tpl_vars['product']['product_id']; ?>
" class="checkbox cm-item" /></td>
	<?php if ($__tpl_vars['search']['cid'] && $__tpl_vars['search']['subcats'] != 'Y'): ?>
	<td>
		<input type="text" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][position]" size="3" value="<?php echo $__tpl_vars['product']['position']; ?>
" class="input-text-short" /></td>
	<?php endif; ?>
	<td>
		<input type="text" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][product_code]" size="6" value="<?php echo $__tpl_vars['product']['product_code']; ?>
" class="input-text" /></td>
	<td width="100%">
		<div class="float-left">
				<input type="hidden" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][product]" value="<?php echo $__tpl_vars['product']['product']; ?>
" />
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
" <?php if ($__tpl_vars['product']['status'] == 'N'): ?>class="manage-root-item-disabled"<?php endif; ?>><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a></div>
		<div class="float-right">
		</div>
	</td>
	<td class="center">
		<input type="text" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][price]" size="6" value="<?php echo $__tpl_vars['product']['price']; ?>
" class="input-text-medium" /></td>
	<td class="center">
		<input type="text" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][list_price]" size="6" value="<?php echo $__tpl_vars['product']['list_price']; ?>
" class="input-text-medium" /></td>
	<td class="center">
		<?php if ($__tpl_vars['product']['tracking'] == 'O'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('edit', $this->getLanguage()), 'but_href' => ($__tpl_vars['index_script'])."?dispatch=product_options.inventory&product_id=".($__tpl_vars['product']['product_id']), 'but_role' => 'edit', )); ?>

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
		<?php else: ?>
		<input type="text" name="products_data[<?php echo $__tpl_vars['product']['product_id']; ?>
][amount]" size="6" value="<?php echo $__tpl_vars['product']['amount']; ?>
" class="input-text-short" />
		<?php endif; ?>
	</td>
	<td><?php $this->_tag_stack[] = array('hook', array('name' => "products:manage_body")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	<td>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['product']['product_id'], 'status' => $__tpl_vars['product']['status'], 'hidden' => true, 'object_id_name' => 'product_id', 'table' => 'products', )); ?>

<?php $this->assign('prefix', smarty_modifier_default(@$__tpl_vars['prefix'], 'select'), false); ?>
<div class="select-popup-container">
	<div <?php if ($__tpl_vars['id']): ?>id="sw_<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($__tpl_vars['status']); ?>
<?php if ($__tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
		<a <?php if ($__tpl_vars['id']): ?>class="cm-combo-on<?php if (! $__tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php echo $__tpl_vars['items_status'][$__tpl_vars['status']]; ?>

		<?php else: ?>
			<?php if ($__tpl_vars['status'] == 'A'): ?>
				<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'D'): ?>
				<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'H'): ?>
				<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

			<?php elseif ($__tpl_vars['status'] == 'P'): ?>
				<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

			<?php endif; ?>
		<?php endif; ?>
		</a>
	</div>
	<?php if ($__tpl_vars['id']): ?>
		<div id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box hidden">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
			<ul class="cm-select-list">
			<?php if ($__tpl_vars['items_status']): ?>
				<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }if (count($_from_3342526419)):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
?>
				<li><a class="status-link-<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
 <?php if ($__tpl_vars['status'] == $__tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;status=<?php echo $__tpl_vars['st']; ?>
<?php if ($__tpl_vars['table'] && $__tpl_vars['object_id_name']): ?>&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
<?php endif; ?><?php echo $__tpl_vars['extra']; ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
');" name="update_object_status_callback"><?php echo $__tpl_vars['val']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<li><a class="status-link-a <?php if ($__tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=A" onclick="return fn_check_object_status(this, 'a');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
				<li><a class="status-link-d <?php if ($__tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=D" onclick="return fn_check_object_status(this, 'd');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
				<?php if ($__tpl_vars['hidden']): ?>
				<li><a class="status-link-h <?php if ($__tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($__tpl_vars['status_rev']): ?> rev="<?php echo $__tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo smarty_modifier_default(@$__tpl_vars['update_controller'], 'tools'); ?>
.update_status&amp;id=<?php echo $__tpl_vars['id']; ?>
&amp;table=<?php echo $__tpl_vars['table']; ?>
&amp;id_name=<?php echo $__tpl_vars['object_id_name']; ?>
&amp;status=H" onclick="return fn_check_object_status(this, 'h');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($__tpl_vars['notify']): ?>
				<li class="select-field">
					<input type="checkbox" name="__notify_user" id="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
					<label for="<?php echo $__tpl_vars['prefix']; ?>
_<?php echo $__tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$__tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
				</li>
			<?php endif; ?>
			</ul>
		</div>
		<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
		<script type="text/javascript">
		//<![CDATA[
		<?php echo '
		function fn_check_object_status(obj, status) 
		{
			if ($(obj).hasClass(\'cm-active\')) {
				$(obj).removeClass(\'cm-ajax\');
				return false;
			}
			fn_update_object_status(obj, status);
			return true;
		}
		function fn_update_object_status_callback(data, params) 
		{
			if (data.return_status && params.preload_obj) {
				fn_update_object_status(params.preload_obj, data.return_status.toLowerCase());
			}
		}
		function fn_update_object_status(obj, status)
		{
			var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
			var upd_elm = $(\'#\' + upd_elm_id);
			upd_elm.hide();
			if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
				$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
			} else {
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), \'notify_user\'));
			}
			$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
			$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
			$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
			'; ?>

			$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($__tpl_vars['suffix']): ?><?php echo $__tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
			<?php echo '
		}
		'; ?>

		//]]>
		</script>
		<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "products:list_extra_links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.delete&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $__tpl_vars['product']['product_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => ($__tpl_vars['index_script'])."?dispatch=products.update&product_id=".($__tpl_vars['product']['product_id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="<?php if ($__tpl_vars['search']['cid'] && $__tpl_vars['search']['subcats'] != 'Y'): ?>12<?php else: ?>11<?php endif; ?>"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php if ($__tpl_vars['products']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('href' => "#products", 'visibility' => 'Y', )); ?>

<div class="table-tools">
	<a href="<?php echo $__tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-on underlined"><?php echo fn_get_lang_var('select_all', $this->getLanguage()); ?>
</a>|
	<a href="<?php echo $__tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-off underlined"><?php echo fn_get_lang_var('unselect_all', $this->getLanguage()); ?>
</a>
	</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>
<div class="object-container">
	<p><?php echo fn_get_lang_var('text_select_fields2edit_note', $this->getLanguage()); ?>
</p>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<input type="hidden" name="selected_fields[object]" value="product" />
<?php echo smarty_function_math(array('equation' => "ceil(n/c)",'assign' => 'rows','n' => count($__tpl_vars['selected_fields']),'c' => smarty_modifier_default(@$__tpl_vars['columns'], '5')), $this);?>


<?php echo smarty_function_split(array('data' => smarty_modifier_sort_by($__tpl_vars['selected_fields'], 'text'),'size' => $__tpl_vars['rows'],'assign' => 'splitted_selected_fields','vertical_delimition' => false,'size_is_horizontal' => true), $this);?>


<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<?php $_from_3613844589 = & $__tpl_vars['splitted_selected_fields']; if (!is_array($_from_3613844589) && !is_object($_from_3613844589)) { settype($_from_3613844589, 'array'); }if (count($_from_3613844589)):
    foreach ($_from_3613844589 as $__tpl_vars['sfs']):
?>
		<td>
		<ul>
			<?php $_from_2448298963 = & $__tpl_vars['sfs']; if (!is_array($_from_2448298963) && !is_object($_from_2448298963)) { settype($_from_2448298963, 'array'); }$this->_foreach['foreach_sfs'] = array('total' => count($_from_2448298963), 'iteration' => 0);
if ($this->_foreach['foreach_sfs']['total'] > 0):
    foreach ($_from_2448298963 as $__tpl_vars['sf']):
        $this->_foreach['foreach_sfs']['iteration']++;
?>
				<li class="select-field">
					<?php if ($__tpl_vars['sf']): ?>
						<?php if ($__tpl_vars['sf']['disabled'] == 'Y'): ?><input type="hidden" value="Y" name="selected_fields<?php echo $__tpl_vars['sf']['name']; ?>
" /><?php endif; ?>
						<input type="checkbox" value="Y" name="selected_fields<?php echo $__tpl_vars['sf']['name']; ?>
" id="elm_<?php echo md5($__tpl_vars['sf']['name']); ?>
" checked="checked" <?php if ($__tpl_vars['sf']['disabled'] == 'Y'): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item-s" />
						<label for="elm_<?php echo md5($__tpl_vars['sf']['name']); ?>
"><?php echo $__tpl_vars['sf']['text']; ?>
&nbsp;</label>
					<?php endif; ?>
				</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
		</td>
	<?php endforeach; endif; unset($_from); ?>
</tr></table>
<p>
<a name="check_all" class="cm-check-items-s cm-on underlined"><?php echo fn_get_lang_var('select_all', $this->getLanguage()); ?>
</a>&nbsp;/&nbsp;<a href="#sfields" name="check_all" class="cm-check-items-s cm-off underlined"><?php echo fn_get_lang_var('unselect_all', $this->getLanguage()); ?>
</a>
</p>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('modify_selected', $this->getLanguage()),'but_name' => "dispatch[products.store_selection]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php $this->_smarty_vars['capture']['select_fields_to_edit'] = ob_get_contents(); ob_end_clean(); ?>

<div class="buttons-container buttons-bg">
	<?php if ($__tpl_vars['products']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a class="cm-process-items" name="dispatch[products.m_clone]" rev="manage_products_form"><?php echo fn_get_lang_var('clone_selected', $this->getLanguage()); ?>
</a></li>
			<li><a class="cm-process-items" name="dispatch[products.export_range]" rev="manage_products_form"><?php echo fn_get_lang_var('export_selected', $this->getLanguage()); ?>
</a></li>
			<li><a class="cm-confirm cm-process-items" name="dispatch[products.m_delete]" rev="manage_products_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
			<li><a onclick="if ($('input.cm-item[type=checkbox]:checked', $(this).parents('form:first')).length > 0) <?php echo $__tpl_vars['ldelim']; ?>
jQuery.show_picker('select_fields_to_edit', '', '.object-container');<?php echo $__tpl_vars['rdelim']; ?>
 else <?php echo $__tpl_vars['ldelim']; ?>
alert(window['lang'].error_no_items_selected);<?php echo $__tpl_vars['rdelim']; ?>
"><?php echo fn_get_lang_var('edit_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>

		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.m_update]",'but_role' => 'button_main')));
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

		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'select_fields_to_edit','text' => fn_get_lang_var('select_fields_to_edit', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['select_fields_to_edit'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php endif; ?>
	
	<div class="float-right">
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=products.add", 'prefix' => 'bottom', 'link_text' => fn_get_lang_var('add_product', $this->getLanguage()), 'hide_tools' => true, )); ?>


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
</div>

<?php ob_start(); ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tool_href' => ($__tpl_vars['index_script'])."?dispatch=products.add", 'prefix' => 'top', 'link_text' => fn_get_lang_var('add_product', $this->getLanguage()), 'hide_tools' => true, )); ?>


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
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('products', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>