<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:17
         compiled from views/products/components/buy_now.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_product_features_list', 'views/products/components/buy_now.tpl', 1, false),array('modifier', 'escape', 'views/products/components/buy_now.tpl', 1, false),array('modifier', 'floatval', 'views/products/components/buy_now.tpl', 3, false),array('modifier', 'default', 'views/products/components/buy_now.tpl', 9, false),array('modifier', 'replace', 'views/products/components/buy_now.tpl', 40, false),array('modifier', 'date_format', 'views/products/components/buy_now.tpl', 61, false),array('modifier', 'format_price', 'views/products/components/buy_now.tpl', 126, false),array('modifier', 'trim', 'views/products/components/buy_now.tpl', 290, false),array('block', 'hook', 'views/products/components/buy_now.tpl', 118, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('select_options','delete','delete','product_coming_soon','product_coming_soon_add','sku','old_price','list_price','price','enter_your_price','contact_us_for_price','inc_tax','including_tax','you_save','you_save','sign_in_to_view_price','text_edp_product','bought','in_stock','text_out_of_stock','items','text_out_of_stock','quantity','text_cart_min_qty'));
?>

<?php if (( floatval($__tpl_vars['product']['price']) || $__tpl_vars['product']['zero_price_action'] == 'P' || $__tpl_vars['product']['zero_price_action'] == 'A' || ( ! floatval($__tpl_vars['product']['price']) && $__tpl_vars['product']['zero_price_action'] == 'R' ) ) && ! ( $__tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'P' && ! $__tpl_vars['auth']['user_id'] )): ?>
	<?php $this->assign('show_price_values', true, false); ?>
<?php else: ?>
	<?php $this->assign('show_price_values', false, false); ?>
<?php endif; ?>

<?php $this->assign('obj_id', smarty_modifier_default(@$__tpl_vars['obj_id'], @$__tpl_vars['product']['product_id']), false); ?>

<?php ob_start(); ?>
<?php if (! ( $__tpl_vars['product']['zero_price_action'] == 'R' && $__tpl_vars['product']['price'] == 0 ) && ! ( $__tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $__tpl_vars['settings']['General']['allow_negative_amount'] != 'Y' && ( $__tpl_vars['product']['amount'] <= 0 || $__tpl_vars['product']['amount'] < $__tpl_vars['product']['min_qty'] ) && $__tpl_vars['product']['is_edp'] != 'Y' && $__tpl_vars['product']['tracking'] == 'B' )): ?>
	<?php if ($__tpl_vars['product']['avail_since'] <= @TIME || ( $__tpl_vars['product']['avail_since'] > @TIME && $__tpl_vars['product']['buy_in_advance'] == 'Y' )): ?>
		<?php if ($__tpl_vars['product']['has_options'] && ( ! $__tpl_vars['product']['product_options'] || $__tpl_vars['simple'] )): ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_id' => "button_cart_".($__tpl_vars['obj_id']), 'but_text' => fn_get_lang_var('select_options', $this->getLanguage()), 'but_href' => ($__tpl_vars['index_script'])."?dispatch=products.view&amp;product_id=".($__tpl_vars['product']['product_id']), 'but_role' => 'text', 'but_name' => "", )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php else: ?>
			<?php if ($__tpl_vars['additional_link']): ?><?php echo $__tpl_vars['additional_link']; ?>
&nbsp;<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_to_cart.tpl", 'smarty_include_vars' => array('but_id' => "button_cart_".($__tpl_vars['obj_id']),'but_name' => "dispatch[checkout.add..".($__tpl_vars['obj_id'])."]",'but_role' => $__tpl_vars['but_role'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($__tpl_vars['product']['avail_since'] > @TIME): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('avail_date' => $__tpl_vars['product']['avail_since'], 'add_to_cart' => $__tpl_vars['product']['buy_in_advance'], )); ?>

<div class="product-coming-soon">
	<?php $this->assign('date', smarty_modifier_date_format($__tpl_vars['avail_date'], $__tpl_vars['settings']['Appearance']['date_format']), false); ?>
	<?php if ($__tpl_vars['add_to_cart'] == 'N'): ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon', $this->getLanguage()), "[avail_date]", $__tpl_vars['date']); ?>
<?php else: ?><?php echo smarty_modifier_replace(fn_get_lang_var('product_coming_soon_add', $this->getLanguage()), "[avail_date]", $__tpl_vars['date']); ?>
<?php endif; ?>
</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['add_to_cart'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($__tpl_vars['show_sku']): ?>
<p class="sku<?php if (! $__tpl_vars['product']['product_code']): ?> hidden<?php endif; ?>" id="sku_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('sku', $this->getLanguage()); ?>
: <span id="product_code_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo $__tpl_vars['product']['product_code']; ?>
</span></p>
<?php endif; ?>

<?php if ($__tpl_vars['show_features']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('features' => smarty_modifier_escape(fn_get_product_features_list($__tpl_vars['product']['product_id'])), )); ?>

<?php if ($__tpl_vars['features']): ?>
<p><label><strong><?php $_from_2833876449 = & $__tpl_vars['features']; if (!is_array($_from_2833876449) && !is_object($_from_2833876449)) { settype($_from_2833876449, 'array'); }$this->_foreach['features_list'] = array('total' => count($_from_2833876449), 'iteration' => 0);
if ($this->_foreach['features_list']['total'] > 0):
    foreach ($_from_2833876449 as $__tpl_vars['feature']):
        $this->_foreach['features_list']['iteration']++;
?><?php if ($__tpl_vars['feature']['prefix']): ?><?php echo $__tpl_vars['feature']['prefix']; ?><?php endif; ?><?php if ($__tpl_vars['feature']['feature_type'] == 'D'): ?><?php echo smarty_modifier_date_format($__tpl_vars['feature']['value_int'], ($__tpl_vars['settings']['Appearance']['date_format'])); ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'M'): ?><?php $_from_1156591881 = & $__tpl_vars['feature']['variants']; if (!is_array($_from_1156591881) && !is_object($_from_1156591881)) { settype($_from_1156591881, 'array'); }$this->_foreach['ffev'] = array('total' => count($_from_1156591881), 'iteration' => 0);
if ($this->_foreach['ffev']['total'] > 0):
    foreach ($_from_1156591881 as $__tpl_vars['v']):
        $this->_foreach['ffev']['iteration']++;
?><?php echo smarty_modifier_default(@$__tpl_vars['v']['variant'], @$__tpl_vars['v']['value']); ?><?php if (! ($this->_foreach['ffev']['iteration'] == $this->_foreach['ffev']['total'])): ?>,&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'S' || $__tpl_vars['feature']['feature_type'] == 'N' || $__tpl_vars['feature']['feature_type'] == 'E'): ?><?php echo smarty_modifier_default(@$__tpl_vars['feature']['variant'], @$__tpl_vars['feature']['value']); ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'C'): ?><?php echo $__tpl_vars['feature']['description']; ?><?php elseif ($__tpl_vars['feature']['feature_type'] == 'O'): ?><?php echo $__tpl_vars['feature']['value_int']; ?><?php else: ?><?php echo $__tpl_vars['feature']['value']; ?><?php endif; ?><?php if ($__tpl_vars['feature']['suffix']): ?><?php echo $__tpl_vars['feature']['suffix']; ?><?php endif; ?><?php if (! ($this->_foreach['features_list']['iteration'] == $this->_foreach['features_list']['total'])): ?> / <?php endif; ?><?php endforeach; endif; unset($_from); ?></strong></label></p>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php if (! $__tpl_vars['hide_form']): ?>
<form <?php if ($__tpl_vars['settings']['DHTML']['ajax_add_to_cart'] == 'Y' && ! $__tpl_vars['no_ajax']): ?>class="cm-ajax"<?php endif; ?> action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="product_form_<?php echo $__tpl_vars['obj_id']; ?>
">
<input type="hidden" name="result_ids" value="cart_status,wish_list" />
<?php if (! $__tpl_vars['stay_in_cart']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
<?php endif; ?>
<input type="hidden" name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][product_id]" value="<?php echo $__tpl_vars['product']['product_id']; ?>
" />
<?php endif; ?>

<?php if (( $__tpl_vars['product']['discount_prc'] || $__tpl_vars['product']['list_discount_prc'] ) && $__tpl_vars['show_price_values'] && ! $__tpl_vars['simple']): ?>
<div class="clear">
	<div class="prices-container">
<?php endif; ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "products:prices_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/prices_block.pre.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
	<?php if ($__tpl_vars['show_price_values']): ?>
	
		<?php if (! $__tpl_vars['simple']): ?>
			<?php if ($__tpl_vars['product']['discount']): ?> 					<span class="list-price" id="line_old_price_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('old_price', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['base_price'], 'span_id' => "old_price_".($__tpl_vars['obj_id']), 'class' => "list-price", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			<?php elseif ($__tpl_vars['product']['list_discount']): ?>
				<span class="list-price" id="line_list_price_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['list_price'], 'span_id' => "list_price_".($__tpl_vars['obj_id']), 'class' => "list-price", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			<?php endif; ?>
		<?php endif; ?>
	
		<?php if ($__tpl_vars['capture_price']): ?>
		<?php ob_start(); ?>
		<?php endif; ?>
			<p class="price"> 				<?php if (floatval($__tpl_vars['product']['price']) || $__tpl_vars['product']['zero_price_action'] == 'P' || ( $__tpl_vars['hide_add_to_cart_button'] == 'Y' && $__tpl_vars['product']['zero_price_action'] == 'A' )): ?>
				<span class="price<?php if (! floatval($__tpl_vars['product']['price'])): ?> hidden<?php endif; ?>" id="line_discounted_price_<?php echo $__tpl_vars['obj_id']; ?>
"><?php if (! $__tpl_vars['hide_price_title']): ?><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
: <?php endif; ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['price'], 'span_id' => "discounted_price_".($__tpl_vars['obj_id']), 'class' => 'price', )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span>
			<?php elseif ($__tpl_vars['product']['zero_price_action'] == 'A'): ?>
				<span class="price"><?php echo fn_get_lang_var('enter_your_price', $this->getLanguage()); ?>
: <input class="input-text-short" type="text" size="3" name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][price]" value="" /></span>
			<?php elseif ($__tpl_vars['product']['zero_price_action'] == 'R'): ?>
				<span class="price"><?php echo fn_get_lang_var('contact_us_for_price', $this->getLanguage()); ?>
</span>
			<?php endif; ?>
	
			<?php if ($__tpl_vars['settings']['Appearance']['show_prices_taxed_clean'] == 'Y' && $__tpl_vars['product']['taxed_price']): ?>
				<?php if ($__tpl_vars['product']['clean_price'] != $__tpl_vars['product']['taxed_price'] && $__tpl_vars['product']['included_tax']): ?>
					<span class="list-price" id="line_product_price_<?php echo $__tpl_vars['obj_id']; ?>
">(<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['taxed_price'], 'span_id' => "product_price_".($__tpl_vars['obj_id']), 'class' => "list-price", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php echo fn_get_lang_var('inc_tax', $this->getLanguage()); ?>
)</span>
				<?php elseif ($__tpl_vars['product']['clean_price'] != $__tpl_vars['product']['taxed_price'] && ! $__tpl_vars['product']['included_tax']): ?>
					<span class="list-price">(<?php echo fn_get_lang_var('including_tax', $this->getLanguage()); ?>
)</span>
				<?php endif; ?>
			<?php endif; ?>
			</p>
		<?php if ($__tpl_vars['capture_price']): ?>
		<?php $this->_smarty_vars['capture']['price'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	
		<?php if (! $__tpl_vars['simple']): ?>
			<?php if ($__tpl_vars['product']['discount']): ?> 					<span class="list-price" id="line_discount_value_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('you_save', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['discount'], 'span_id' => "discount_value_".($__tpl_vars['obj_id']), 'class' => "list-price", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;(<span id="prc_discount_value_<?php echo $__tpl_vars['obj_id']; ?>
" class="list-price"><?php echo $__tpl_vars['product']['discount_prc']; ?>
</span>%)</span>
			<?php elseif ($__tpl_vars['product']['list_discount']): ?>
				<span class="list-price" id="line_discount_value_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('you_save', $this->getLanguage()); ?>
: <?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('value' => $__tpl_vars['product']['list_discount'], 'span_id' => "discount_value_".($__tpl_vars['obj_id']), 'class' => "list-price", )); ?>
<?php if ($__tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['primary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], false); ?><?php if ($__tpl_vars['secondary_currency'] != $__tpl_vars['primary_currency']): ?>&nbsp;<?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>(<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true, $__tpl_vars['is_integer']); ?><?php if ($__tpl_vars['class']): ?><span class="<?php echo $__tpl_vars['class']; ?>"><?php endif; ?>)<?php if ($__tpl_vars['class']): ?></span><?php endif; ?><?php endif; ?><?php else: ?><?php echo smarty_modifier_format_price($__tpl_vars['value'], $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']], $__tpl_vars['span_id'], $__tpl_vars['class'], true); ?><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;(<span id="prc_discount_value_<?php echo $__tpl_vars['obj_id']; ?>
" class="list-price"><?php echo $__tpl_vars['product']['list_discount_prc']; ?>
</span>%)</span>
			<?php endif; ?>
		<?php endif; ?>
	
	<?php elseif ($__tpl_vars['settings']['General']['allow_anonymous_shopping'] == 'P' && ! $__tpl_vars['auth']['user_id']): ?>
		<span class="price"><?php echo fn_get_lang_var('sign_in_to_view_price', $this->getLanguage()); ?>
</span>
	<?php endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
<?php if (( $__tpl_vars['product']['discount_prc'] || $__tpl_vars['product']['list_discount_prc'] ) && $__tpl_vars['show_price_values'] && ! $__tpl_vars['simple']): ?>
	</div>
	
		<div class="discount-label" id="line_prc_discount_value_<?php echo $__tpl_vars['obj_id']; ?>
">
		<em><strong>-</strong><span id="prc_discount_value_label_<?php echo $__tpl_vars['obj_id']; ?>
"><?php if ($__tpl_vars['product']['discount']): ?><?php echo $__tpl_vars['product']['discount_prc']; ?>
<?php else: ?><?php echo $__tpl_vars['product']['list_discount_prc']; ?>
<?php endif; ?></span>%</em>
	</div>
	</div>
<?php endif; ?>

<?php if (! $__tpl_vars['simple'] && $__tpl_vars['product']['is_edp'] == 'Y'): ?>
<p><?php echo fn_get_lang_var('text_edp_product', $this->getLanguage()); ?>
</p>
<input type="hidden" name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][is_edp]" value="Y" />
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:options_advanced")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['required_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['show_product_status'] && $__tpl_vars['product']['bought'] == 'Y'): ?>
<p><strong><?php echo fn_get_lang_var('bought', $this->getLanguage()); ?>
</strong></p>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>
<?php if ($__tpl_vars['product']['is_edp'] !== 'Y' && $__tpl_vars['settings']['General']['inventory_tracking'] == 'Y' && $__tpl_vars['product']['tracking'] != 'D'): ?>
<?php if (! $__tpl_vars['simple']): ?>
<div class="form-field product-list-field">
	<label><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:</label>
	<span id="qty_in_stock_<?php echo $__tpl_vars['obj_id']; ?>
" class="qty-in-stock">
	<?php if (( $__tpl_vars['product']['amount'] <= 0 || $__tpl_vars['product']['amount'] < $__tpl_vars['product']['min_qty'] ) && $__tpl_vars['product']['tracking'] == 'B'): ?>
		<?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>

	<?php else: ?>
		<?php echo $__tpl_vars['product']['amount']; ?>
&nbsp;<?php echo fn_get_lang_var('items', $this->getLanguage()); ?>

	<?php endif; ?>
	</span>
</div>
<?php else: ?>
	<span id="qty_in_stock_<?php echo $__tpl_vars['obj_id']; ?>
" class="qty-in-stock">
	<?php if (( $__tpl_vars['product']['amount'] <= 0 || $__tpl_vars['product']['amount'] < $__tpl_vars['product']['min_qty'] ) && $__tpl_vars['product']['tracking'] == 'B'): ?>
		<?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>

	<?php endif; ?>
	</span>
<?php endif; ?>
<?php endif; ?>
<?php if ($__tpl_vars['addons']['suppliers']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/suppliers/hooks/products/options_advanced.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/products/options_advanced.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_advanced.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($__tpl_vars['hide_add_to_cart_button'] != 'Y'): ?>
	<?php if (! $__tpl_vars['simple'] && $__tpl_vars['product']['product_options']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_options.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['obj_id'],'product_options' => $__tpl_vars['product']['product_options'],'name' => 'product_data')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if (( $__tpl_vars['product']['qty_content'] || $__tpl_vars['show_qty'] ) && $__tpl_vars['product']['is_edp'] !== 'Y'): ?>
	<div class="form-field product-list-field" id="qty_<?php echo $__tpl_vars['obj_id']; ?>
">
		<label for="qty_count_<?php echo $__tpl_vars['obj_id']; ?>
"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
:</label>
		<?php if ($__tpl_vars['product']['qty_content']): ?>
		<select name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][amount]" id="qty_count_<?php echo $__tpl_vars['obj_id']; ?>
">
		<?php $_from_2035493462 = & $__tpl_vars['product']['qty_content']; if (!is_array($_from_2035493462) && !is_object($_from_2035493462)) { settype($_from_2035493462, 'array'); }if (count($_from_2035493462)):
    foreach ($_from_2035493462 as $__tpl_vars['var']):
?>
			<option value="<?php echo $__tpl_vars['var']; ?>
"><?php echo $__tpl_vars['var']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
		<?php else: ?>
			<input type="text" size="5" class="input-text-short" id="qty_count_<?php echo $__tpl_vars['obj_id']; ?>
" name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][amount]" value="1" />
		<?php endif; ?>
	</div>
	<?php if ($__tpl_vars['product']['prices']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_qty_discounts.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php elseif (! $__tpl_vars['bulk_add']): ?>
		<input type="hidden" name="product_data[<?php echo $__tpl_vars['obj_id']; ?>
][amount]" value="1" />
	<?php endif; ?>

	<?php if ($__tpl_vars['product']['min_qty']): ?>
		<p><?php echo smarty_modifier_replace(smarty_modifier_replace(fn_get_lang_var('text_cart_min_qty', $this->getLanguage()), "[product]", $__tpl_vars['product']['product']), "[quantity]", $__tpl_vars['product']['min_qty']); ?>
</p>
	<?php endif; ?>

	<?php if ($__tpl_vars['separate_add_button']): ?>
	<div class="buttons-container <?php echo smarty_modifier_default(@$__tpl_vars['align'], 'center'); ?>
" id="cart_add_block_<?php echo $__tpl_vars['obj_id']; ?>
">
		<?php echo $this->_smarty_vars['capture']['add_to_cart']; ?>

	</div>
	<?php endif; ?>
	
	<?php if ($__tpl_vars['capture_buttons']): ?>
	<?php ob_start(); ?>
	<?php endif; ?>
	<?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/buttons_block.override.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean();
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($__tpl_vars['addon_content'])): ?><?php echo $__tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:buttons_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div id="cart_buttons_block_<?php echo $__tpl_vars['obj_id']; ?>
" class="buttons-container">
		<?php if (! $__tpl_vars['separate_add_button']): ?>
			<?php echo $this->_smarty_vars['capture']['add_to_cart']; ?>

		<?php endif; ?>
	
		<?php $this->_tag_stack[] = array('hook', array('name' => "products:buy_now")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/products/buy_now.pre.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
		<?php if ($__tpl_vars['product']['feature_comparison'] == 'Y'): ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_to_compare_list.tpl", 'smarty_include_vars' => array('product_id' => $__tpl_vars['product']['product_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	</div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
	<?php if ($__tpl_vars['capture_buttons']): ?>
	<?php $this->_smarty_vars['capture']['cart_buttons'] = ob_get_contents(); ob_end_clean(); ?>
	<?php endif; ?>
<?php endif; ?>

<?php if (! $__tpl_vars['hide_form']): ?>
</form>
<?php endif; ?>