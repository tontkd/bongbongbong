<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:41
         compiled from addons/wishlist/hooks/cart/search_form.override.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('cart','wishlist'));
?>
<?php  ob_start();  ?>
<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['product_type_c'] == 'Y'): ?>checked="checked"<?php endif; ?> name="product_type_c" id="cb_product_type_c" onclick="if (!this.checked) document.getElementById('cb_product_type_w').checked = true;" class="checkbox" />
<label for="cb_product_type_c"><?php echo fn_get_lang_var('cart', $this->getLanguage()); ?>
</label>

<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['product_type_w'] == 'Y'): ?>checked="checked"<?php endif; ?> name="product_type_w" id="cb_product_type_w" onclick="if (!this.checked) document.getElementById('cb_product_type_c').checked = true;" class="checkbox" />
<label for="cb_product_type_w"><?php echo fn_get_lang_var('wishlist', $this->getLanguage()); ?>
</label><?php  ob_end_flush();  ?>