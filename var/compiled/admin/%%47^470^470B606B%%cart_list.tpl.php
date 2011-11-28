<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:41
         compiled from views/cart/cart_list.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_query_remove', 'views/cart/cart_list.tpl', 25, false),array('modifier', 'default', 'views/cart/cart_list.tpl', 49, false),array('modifier', 'unescape', 'views/cart/cart_list.tpl', 73, false),array('modifier', 'format_price', 'views/cart/cart_list.tpl', 92, false),array('block', 'hook', 'views/cart/cart_list.tpl', 37, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('close','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','customer','cart_content','wishlist_content','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','unregistered_customer','product_s','product_s','product','quantity','price','deleted_product','gift_certificate','total','product','deleted_product','gift_certificate','no_data','users_carts'));
?>

<?php ob_start(); ?>

<?php ob_start(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/cart/components/carts_search_form.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?>

<div class="clear">
	<div class="section-border">
		<?php echo $__tpl_vars['section_content']; ?>

		<?php if ($__tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $_SERVER['QUERY_STRING']; ?>
&amp;close_section=<?php echo $__tpl_vars['key']; ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" target="" name="carts_list_form">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_url' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('c_url', fn_query_remove($__tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>

<?php if ($__tpl_vars['settings']['DHTML']['admin_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_carts" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combinations-carts" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_carts" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combinations-carts" /></th>
	<th width="50%"><a class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == 'customer'): ?> sort-link-<?php echo $__tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo $__tpl_vars['c_url']; ?>
&amp;sort_by=customer&amp;sort_order=<?php echo $__tpl_vars['search']['sort_order']; ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
</a></th>
	<th width="25%" class="center"><?php echo fn_get_lang_var('cart_content', $this->getLanguage()); ?>
</th>
	<?php $this->_tag_stack[] = array('hook', array('name' => "cart:items_list_header")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($__tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<th width="25%" class="center"><?php echo fn_get_lang_var('wishlist_content', $this->getLanguage()); ?>
</th><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</tr>
<?php $_from_3511116430 = & $__tpl_vars['cart_list']; if (!is_array($_from_3511116430) && !is_object($_from_3511116430)) { settype($_from_3511116430, 'array'); }if (count($_from_3511116430)):
    foreach ($_from_3511116430 as $__tpl_vars['customer']):
?>
<tr class="table-row">
	<td>
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?>
" id="on_user_<?php echo $__tpl_vars['customer']['user_id']; ?>
" class="hand cm-combination-carts" onclick="jQuery.ajaxRequest('<?php echo $__tpl_vars['index_script']; ?>
?dispatch=cart.cart_list&user_id=<?php echo $__tpl_vars['customer']['user_id']; ?>
', <?php echo $__tpl_vars['ldelim']; ?>
result_ids: 'cart_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
, wishlist_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
', caching: true<?php echo $__tpl_vars['rdelim']; ?>
);" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" alt="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?>
" id="off_user_<?php echo $__tpl_vars['customer']['user_id']; ?>
" class="hand hidden cm-combination-carts" /></td>
	<td>
	<?php if ($__tpl_vars['customer']['firstname'] || $__tpl_vars['customer']['lastname']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['customer']['user_id']; ?>
" class="underlined"><?php echo $__tpl_vars['customer']['firstname']; ?>
 <?php echo $__tpl_vars['customer']['lastname']; ?>
</a><?php else: ?><?php echo fn_get_lang_var('unregistered_customer', $this->getLanguage()); ?>
<?php endif; ?></td>
	<td class="center"><?php echo smarty_modifier_default(@$__tpl_vars['customer']['cart_products'], '0'); ?>
 <?php echo fn_get_lang_var('product_s', $this->getLanguage()); ?>
</td>
	<?php $this->_tag_stack[] = array('hook', array('name' => "cart:items_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($__tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<td class="center"><?php echo smarty_modifier_default(@$__tpl_vars['customer']['wishlist_products'], '0'); ?>
 <?php echo fn_get_lang_var('product_s', $this->getLanguage()); ?>
</td><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</tr>
<tbody id="user_<?php echo $__tpl_vars['customer']['user_id']; ?>
" class="hidden">
<tr>
	<td>&nbsp;</td>
	<td valign="top" colspan="2">
		<div id="cart_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
">
		<?php if ($__tpl_vars['customer']['user_id'] == $__tpl_vars['sl_user_id']): ?>
			<?php if ($__tpl_vars['cart_products']): ?>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
			<tr>
				<th width="100%"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
				<th class="center"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
				<th class="right"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
			</tr>
			<?php $_from_1410526799 = & $__tpl_vars['cart_products']; if (!is_array($_from_1410526799) && !is_object($_from_1410526799)) { settype($_from_1410526799, 'array'); }$this->_foreach['products'] = array('total' => count($_from_1410526799), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from_1410526799 as $__tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
			<tr>
				<td>
				<?php if ($__tpl_vars['product']['item_type'] == 'P'): ?>
					<?php if ($__tpl_vars['product']['product']): ?>
					<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a>
					<?php else: ?>
					<?php echo fn_get_lang_var('deleted_product', $this->getLanguage()); ?>

					<?php endif; ?>
				<?php endif; ?>
				<?php $this->_tag_stack[] = array('hook', array('name' => "cart:products_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($__tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['product']['item_type'] == 'G'): ?>
	<?php echo fn_get_lang_var('gift_certificate', $this->getLanguage()); ?>

<?php endif; ?>
<?php if ($__tpl_vars['product']['item_type'] == 'C'): ?>
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</td>
				<td class="center"><?php echo $__tpl_vars['product']['amount']; ?>
</td>
				<td class="right"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['price'], 'span_id' => "c_".($__tpl_vars['customer']['user_id'])."_".($__tpl_vars['product']).".item_id", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
			<tr>
				<td class="right"><strong><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</strong></td>
				<td class="center"><strong><?php echo $__tpl_vars['customer']['cart_all_products']; ?>
</strong></td>
				<td class="right"><strong><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['customer']['total'], 'span_id' => "u_".($__tpl_vars['customer']).".user_id", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false)); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;(<?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?>)<?php endif; ?><?php else: ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true)); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong></td>
			</tr>
			</table>
			<?php else: ?>
			&nbsp;
			<?php endif; ?>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		<!--cart_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
--></div>
	</td>
	<?php $this->_tag_stack[] = array('hook', array('name' => "cart:items_list_row")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($__tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<td valign="top">
	<div id="wishlist_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
">
	<?php if ($__tpl_vars['customer']['user_id'] == $__tpl_vars['sl_user_id']): ?>
		<?php if ($__tpl_vars['wishlist_products']): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from_1016374791 = & $__tpl_vars['wishlist_products']; if (!is_array($_from_1016374791) && !is_object($_from_1016374791)) { settype($_from_1016374791, 'array'); }$this->_foreach['products'] = array('total' => count($_from_1016374791), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from_1016374791 as $__tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
		<tr>
			<td>
			<?php if ($__tpl_vars['product']['item_type'] == 'P'): ?>
				<?php if ($__tpl_vars['product']['product']): ?>
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a>
				<?php else: ?>
				<?php echo fn_get_lang_var('deleted_product', $this->getLanguage()); ?>

				<?php endif; ?>
			<?php endif; ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "cart:products_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($__tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['product']['item_type'] == 'G'): ?>
	<?php echo fn_get_lang_var('gift_certificate', $this->getLanguage()); ?>

<?php endif; ?>
<?php if ($__tpl_vars['product']['item_type'] == 'C'): ?>
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.update&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
		<?php else: ?>
		&nbsp;
		<?php endif; ?>
	<?php else: ?>
		&nbsp;
	<?php endif; ?>
	<!--wishlist_products_<?php echo $__tpl_vars['customer']['user_id']; ?>
--></div>
</td><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</tr>
</tbody>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="4"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('users_carts', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>