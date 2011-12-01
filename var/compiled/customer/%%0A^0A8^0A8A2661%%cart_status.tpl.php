<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from views/checkout/components/cart_status.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'format_price', 'views/checkout/components/cart_status.tpl', 13, false),array('modifier', 'fn_get_product_name', 'views/checkout/components/cart_status.tpl', 33, false),array('modifier', 'defined', 'views/checkout/components/cart_status.tpl', 33, false),array('modifier', 'replace', 'views/checkout/components/cart_status.tpl', 58, false),array('block', 'hook', 'views/checkout/components/cart_status.tpl', 29, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('cart','cart','items','subtotal','cart_is_empty','cart_is_empty','cart_is_empty','cart','delete','delete','cart_is_empty','view_cart','checkout','checkout'));
?>

<div id="cart_status">
<!--dynamic:cart_status-->
<div class="float-left">
	<?php if ($_SESSION['cart']['amount']): ?>
		<img id="sw_cart_box" class="cm-combination cm-combo-on valign hand" src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/filled_cart_icon.gif" border="0" alt="<?php echo fn_get_lang_var('cart', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('cart', $this->getLanguage()); ?>
" />
		<span class="lowercase">
			<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=checkout.cart"><strong><?php echo $_SESSION['cart']['amount']; ?>
</strong>&nbsp;<?php echo fn_get_lang_var('items', $this->getLanguage()); ?>
</a>,
			<?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
:&nbsp;<strong><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $_SESSION['cart']['display_subtotal'], )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong>
		</span>
	<?php else: ?>
		<img id="sw_cart_box" class="cm-combination cm-combo-on valign hand" src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/empty_cart_icon.gif" alt="<?php echo fn_get_lang_var('cart_is_empty', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('cart_is_empty', $this->getLanguage()); ?>
" /><strong>&nbsp;&nbsp;&nbsp;<?php echo fn_get_lang_var('cart_is_empty', $this->getLanguage()); ?>
</strong>
	<?php endif; ?>
	
	<div id="cart_box" class="cart-list hidden cm-popup-box cm-smart-position">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/<?php if ($_SESSION['cart']['amount']): ?>filled<?php else: ?>empty<?php endif; ?>_cart_list_icon.gif" alt="<?php echo fn_get_lang_var('cart', $this->getLanguage()); ?>
" class="cm-popup-switch hand cart-list-icon" />
		<div class="list-container">
			<div class="list">
			<?php if ($_SESSION['cart']['amount']): ?>
				<ul>
					<?php $this->_tag_stack[] = array('hook', array('name' => "index:cart_status")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<?php $_from_3476150186 = & $_SESSION['cart']['products']; if (!is_array($_from_3476150186) && !is_object($_from_3476150186)) { settype($_from_3476150186, 'array'); }$this->_foreach['cart_products'] = array('total' => count($_from_3476150186), 'iteration' => 0);
if ($this->_foreach['cart_products']['total'] > 0):
    foreach ($_from_3476150186 as $__tpl_vars['key'] => $__tpl_vars['p']):
        $this->_foreach['cart_products']['iteration']++;
?>
					<?php if (! $__tpl_vars['p']['extra']['parent']): ?>
					<li class="clear">
						<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['p']['product_id']; ?>
" class="underlined"><?php echo fn_get_product_name($__tpl_vars['p']['product_id']); ?>
</a><?php if (! defined('CHECKOUT') || $__tpl_vars['force_items_deletion']): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_href' => ($__tpl_vars['index_script'])."?dispatch=checkout.delete.from_status&amp;cart_id=".($__tpl_vars['key']), 'but_meta' => "cm-ajax", 'but_rev' => 'cart_status', 'but_role' => 'delete', 'but_name' => 'delete_cart_item', )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
						<p>
							<strong class="valign"><?php echo $__tpl_vars['p']['amount']; ?>
</strong>&nbsp;x&nbsp;<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['p']['display_price'], 'span_id' => "price_".($__tpl_vars['key']), 'class' => 'none', )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
						</p>
					</li>
					<?php if (! ($this->_foreach['cart_products']['iteration'] == $this->_foreach['cart_products']['total'])): ?>
						<li class="delim">&nbsp;</li>
					<?php endif; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php if ($__tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/index/cart_status.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</ul>
			<?php else: ?>
				<p class="center"><?php echo fn_get_lang_var('cart_is_empty', $this->getLanguage()); ?>
</p>
			<?php endif; ?>
			</div>
			<div class="buttons-container<?php if ($_SESSION['cart']['amount']): ?> full-cart<?php endif; ?>">
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=checkout.cart" class="view-cart"><?php echo fn_get_lang_var('view_cart', $this->getLanguage()); ?>
</a>
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=checkout.<?php if ($__tpl_vars['settings']['General']['one_page_checkout'] != 'Y'): ?>customer_info<?php else: ?>checkout<?php endif; ?>"><?php echo fn_get_lang_var('checkout', $this->getLanguage()); ?>
</a>
			</div>
		</div>
	</div>
</div><!--/dynamic-->

<div class="checkout-link<?php if ($_SESSION['cart']['amount']): ?> full-cart<?php endif; ?>">

<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=checkout.<?php if ($__tpl_vars['settings']['General']['one_page_checkout'] != 'Y'): ?>customer_info<?php else: ?>checkout<?php endif; ?>"><?php echo fn_get_lang_var('checkout', $this->getLanguage()); ?>
</a>

</div>
<!--cart_status--></div>