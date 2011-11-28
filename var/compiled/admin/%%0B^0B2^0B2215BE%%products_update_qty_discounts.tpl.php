<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from views/products/components/products_update_qty_discounts.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/products/components/products_update_qty_discounts.tpl', 3, false),array('function', 'math', 'views/products/components/products_update_qty_discounts.tpl', 56, false),array('function', 'cycle', 'views/products/components/products_update_qty_discounts.tpl', 57, false),array('modifier', 'fn_get_memberships', 'views/products/components/products_update_qty_discounts.tpl', 5, false),array('modifier', 'default', 'views/products/components/products_update_qty_discounts.tpl', 28, false),array('modifier', 'escape', 'views/products/components/products_update_qty_discounts.tpl', 49, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('quantity','price','membership','all','all','clone_this_item','clone_this_item','delete','delete','all'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php $this->assign('memberships', fn_get_memberships('C'), false); ?>

<div id="content_qty_discounts" class="hidden">
	<table cellpadding="0" cellspacing="0" border="0" class="table" width="100%">
	<tbody class="cm-first-sibling">
	<tr>
		<th><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
&nbsp;(<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
)</th>
		<th width="100%"><?php echo fn_get_lang_var('membership', $this->getLanguage()); ?>
</th>
		<th>&nbsp;</th>
	</tr>
	</tbody>
	<tbody>
	<?php $_from_2210878041 = & $__tpl_vars['product_data']['prices']; if (!is_array($_from_2210878041) && !is_object($_from_2210878041)) { settype($_from_2210878041, 'array'); }$this->_foreach['prod_prices'] = array('total' => count($_from_2210878041), 'iteration' => 0);
if ($this->_foreach['prod_prices']['total'] > 0):
    foreach ($_from_2210878041 as $__tpl_vars['_key'] => $__tpl_vars['price']):
        $this->_foreach['prod_prices']['iteration']++;
?>
	<tr class="cm-row-item">
		<td>
			<?php if ($__tpl_vars['price']['lower_limit'] == '1' && $__tpl_vars['price']['membership_id'] == '0'): ?>
				&nbsp;<?php echo $__tpl_vars['price']['lower_limit']; ?>

			<?php else: ?>
			<input type="text" name="product_data[prices][<?php echo $__tpl_vars['_key']; ?>
][lower_limit]" value="<?php echo $__tpl_vars['price']['lower_limit']; ?>
" class="input-text-short" />
			<?php endif; ?></td>
		<td>
			<?php if ($__tpl_vars['price']['lower_limit'] == '1' && $__tpl_vars['price']['membership_id'] == '0'): ?>
				&nbsp;<?php echo smarty_modifier_default(@$__tpl_vars['price']['price'], "0.00"); ?>

			<?php else: ?>
			<input type="text" name="product_data[prices][<?php echo $__tpl_vars['_key']; ?>
][price]" value="<?php echo smarty_modifier_default(@$__tpl_vars['price']['price'], "0.00"); ?>
" size="10" class="input-text-medium" />
			<?php endif; ?></td>
		<td>
			<?php if ($__tpl_vars['price']['lower_limit'] == '1' && $__tpl_vars['price']['membership_id'] == '0'): ?>
				&nbsp;<?php echo fn_get_lang_var('all', $this->getLanguage()); ?>

			<?php else: ?>
			<select id="membership_id" name="product_data[prices][<?php echo $__tpl_vars['_key']; ?>
][membership_id]">
				<option value="0">- <?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
 -</option>
				<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['membership']):
?>
					<option <?php if ($__tpl_vars['price']['membership_id'] == $__tpl_vars['membership']['membership_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $__tpl_vars['membership']['membership_id']; ?>
"><?php echo $__tpl_vars['membership']['membership']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<?php endif; ?></td>
		<td class="nowrap">
			<?php if ($__tpl_vars['price']['lower_limit'] == '1' && $__tpl_vars['price']['membership_id'] == '0'): ?>
			&nbsp;<?php else: ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('microformats' => "cm-delete-row", 'no_confirm' => true, )); ?>

<?php if ($__tpl_vars['href_clone']): ?>
<a class="clone-item" href="<?php echo $__tpl_vars['href_clone']; ?>
"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_clone.gif" width="13" height="18" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('clone_this_item', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('clone_this_item', $this->getLanguage()), 'html'); ?>
" /></a>
<?php endif; ?>
<a class="delete-item <?php if (! $__tpl_vars['no_confirm']): ?>cm-confirm<?php endif; ?><?php if ($__tpl_vars['microformats']): ?> <?php echo $__tpl_vars['microformats']; ?>
<?php endif; ?>" <?php if ($__tpl_vars['href_delete']): ?>href="<?php echo $__tpl_vars['href_delete']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['rev_delete']): ?>rev="<?php echo $__tpl_vars['rev_delete']; ?>
"<?php endif; ?>><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('delete', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('delete', $this->getLanguage()), 'html'); ?>
" /></a><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php echo smarty_function_math(array('equation' => "x+1",'x' => smarty_modifier_default(@$__tpl_vars['_key'], 0),'assign' => 'new_key'), $this);?>

	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'reset' => 1), $this);?>
 id="box_add_qty_discount">
		<td>
			<input type="text" name="product_data[prices][<?php echo $__tpl_vars['new_key']; ?>
][lower_limit]" value="" class="input-text-short" /></td>
		<td>
			<input type="text" name="product_data[prices][<?php echo $__tpl_vars['new_key']; ?>
][price]" value="0.00" size="10" class="input-text-medium" /></td>
		<td>
			<select id="membership_id" name="product_data[prices][<?php echo $__tpl_vars['new_key']; ?>
][membership_id]">
				<option value="0">- <?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
 -</option>
				<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['membership']):
?>
					<option value="<?php echo $__tpl_vars['membership']['membership_id']; ?>
"><?php echo $__tpl_vars['membership']['membership']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</td>
		<td class="right">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'add_qty_discount')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
	</tbody>
	</table>

</div>