<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:23
         compiled from views/products/components/products_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/components/products_search_form.tpl', 6, false),array('modifier', 'fn_show_picker', 'views/products/components/products_search_form.tpl', 42, false),array('modifier', 'fn_get_plain_categories_tree', 'views/products/components/products_search_form.tpl', 52, false),array('modifier', 'indent', 'views/products/components/products_search_form.tpl', 53, false),array('block', 'hook', 'views/products/components/products_search_form.tpl', 109, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('find_results_with','search','search','any_words','all_words','exact_phrase','price','search_in_category','all_categories','all_categories','search_in','product_name','short_description','subcategories','full_description','keywords','search_by_product_filters','search_by_product_features','search_by_sku','tag','configurable','yes','no','search_by_supplier','all_suppliers','sales_amount','shipping_freight','weight','quantity','free_shipping','yes','no','status','active','hidden','disabled','popularity','close'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
<?php if ($__tpl_vars['page_part']): ?>#<?php echo $__tpl_vars['page_part']; ?>
<?php endif; ?>" name="<?php echo $__tpl_vars['product_search_form_prefix']; ?>
search_form" method="get">
<input type="hidden" name="type" value="<?php echo smarty_modifier_default(@$__tpl_vars['search_type'], 'simple'); ?>
" />
<?php if ($__tpl_vars['_REQUEST']['redirect_url']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['_REQUEST']['redirect_url']; ?>
" />
<?php endif; ?>
<?php if ($__tpl_vars['selected_section'] != ""): ?>
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $__tpl_vars['selected_section']; ?>
" />
<?php endif; ?>

<?php echo $__tpl_vars['extra']; ?>


<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('find_results_with', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="<?php echo $__tpl_vars['search']['q']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('search' => 'Y', 'but_name' => ($__tpl_vars['dispatch']), )); ?>

<input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
			<select name="match">
				<option value="any" <?php if ($__tpl_vars['search']['match'] == 'any'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('any_words', $this->getLanguage()); ?>
</option>
				<option value="all" <?php if ($__tpl_vars['search']['match'] == 'all'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all_words', $this->getLanguage()); ?>
</option>
				<option value="exact" <?php if ($__tpl_vars['search']['match'] == 'exact'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('exact_phrase', $this->getLanguage()); ?>
</option>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
&nbsp;(<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
):</label>
		<div class="break">
			<input type="text" name="price_from" size="1" value="<?php echo $__tpl_vars['search']['price_from']; ?>
" onfocus="this.select();" class="input-text-price" />&nbsp;&ndash;&nbsp;<input type="text" size="1" name="price_to" value="<?php echo $__tpl_vars['search']['price_to']; ?>
" onfocus="this.select();" class="input-text-price" />
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('search_in_category', $this->getLanguage()); ?>
:</label>
		<div class="break clear correct-picker-but">
		<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
			<?php if ($__tpl_vars['search']['cid']): ?>
				<?php $this->assign('s_cid', $__tpl_vars['search']['cid'], false); ?>
			<?php else: ?>
				<?php $this->assign('s_cid', '0', false); ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_category','input_name' => 'cid','item_ids' => $__tpl_vars['s_cid'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_categories', $this->getLanguage()),'extra' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<select	name="cid">
				<option	value="0" <?php if ($__tpl_vars['category_data']['parent_id'] == '0'): ?>selected="selected"<?php endif; ?>>- <?php echo fn_get_lang_var('all_categories', $this->getLanguage()); ?>
 -</option>
				<?php $_from_1987358827 = & fn_get_plain_categories_tree(0, false); if (!is_array($_from_1987358827) && !is_object($_from_1987358827)) { settype($_from_1987358827, 'array'); }if (count($_from_1987358827)):
    foreach ($_from_1987358827 as $__tpl_vars['search_cat']):
?>
					<option	value="<?php echo $__tpl_vars['search_cat']['category_id']; ?>
" <?php if ($__tpl_vars['search']['cid'] == $__tpl_vars['search_cat']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($__tpl_vars['search_cat']['category'], $__tpl_vars['search_cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php endif; ?>
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($__tpl_vars['dispatch'])."]",'but_role' => 'submit')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('search_in', $this->getLanguage()); ?>
:</label>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="select-field">
			<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pname'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pname" id="pname" class="checkbox" /><label for="pname"><?php echo fn_get_lang_var('product_name', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pshort'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pshort" id="pshort" class="checkbox" /><label for="pshort"><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['subcats'] == 'Y'): ?>checked="checked"<?php endif; ?> name="subcats" class="checkbox" id="subcats" /><label for="subcats"><?php echo fn_get_lang_var('subcategories', $this->getLanguage()); ?>
</label></td>
	</tr>
	<tr>
		<td class="select-field"><input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pfull'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pfull" id="pfull" class="checkbox" /><label for="pfull"><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td class="select-field"><input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pkeywords'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pkeywords" id="pkeywords" class="checkbox" /><label for="pkeywords"><?php echo fn_get_lang_var('keywords', $this->getLanguage()); ?>
</label></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	</table>
</div>
<hr />

<?php if ($__tpl_vars['filter_items']): ?>
<div class="search-field">
	<label><?php echo fn_get_lang_var('search_by_product_filters', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/advanced_search_form.tpl", 'smarty_include_vars' => array('filter_features' => $__tpl_vars['filter_items'],'prefix' => 'filter_')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>
<?php if ($__tpl_vars['feature_items']): ?>
<div class="search-field">
	<label><?php echo fn_get_lang_var('search_by_product_features', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/advanced_search_form.tpl", 'smarty_include_vars' => array('filter_features' => $__tpl_vars['feature_items'],'prefix' => 'feature_')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<div class="search-field">
	<label for="pcode"><?php echo fn_get_lang_var('search_by_sku', $this->getLanguage()); ?>
:</label>
	<input type="text" name="pcode" id="pcode" value="<?php echo $__tpl_vars['search']['pcode']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<hr />
<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="search-field">
	<label for="elm_tag"><?php echo fn_get_lang_var('tag', $this->getLanguage()); ?>
:</label>
	<input id="elm_tag" type="text" name="tag" value="<?php echo $__tpl_vars['search']['tag']; ?>
" onfocus="this.select();" class="input-text" />
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="search-field">
	<label for="configurable"><?php echo fn_get_lang_var('configurable', $this->getLanguage()); ?>
:</label>
	<select name="configurable" id="configurable">
		<option value="">--</option>
		<option value="C" <?php if ($__tpl_vars['search']['configurable'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
		<option value="N" <?php if ($__tpl_vars['search']['configurable'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['suppliers']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['suppliers']): ?>
<div class="search-field">
	<label for="sid"><?php echo fn_get_lang_var('search_by_supplier', $this->getLanguage()); ?>
:</label>
	<select	name="sid" id="sid">
		<option	value="0">- <?php echo fn_get_lang_var('all_suppliers', $this->getLanguage()); ?>
 -</option>
		<?php $_from_1242370870 = & $__tpl_vars['suppliers']; if (!is_array($_from_1242370870) && !is_object($_from_1242370870)) { settype($_from_1242370870, 'array'); }if (count($_from_1242370870)):
    foreach ($_from_1242370870 as $__tpl_vars['supplier']):
?>
			<option	value="<?php echo $__tpl_vars['supplier']['user_id']; ?>
" <?php if ($__tpl_vars['search']['sid'] == $__tpl_vars['supplier']['user_id']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['supplier']['company']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="search-field">
	<label for="sales_amount_from"><?php echo fn_get_lang_var('sales_amount', $this->getLanguage()); ?>
:</label>
	<input type="text" name="sales_amount_from" id="sales_amount_from" value="<?php echo $__tpl_vars['search']['sales_amount_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="sales_amount_to" value="<?php echo $__tpl_vars['search']['sales_amount_to']; ?>
" onfocus="this.select();" class="input-text" />
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<div class="search-field">
	<label for="shipping_freight_from"><?php echo fn_get_lang_var('shipping_freight', $this->getLanguage()); ?>
&nbsp;(<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
):</label>
	<input type="text" name="shipping_freight_from" id="shipping_freight_from" value="<?php echo $__tpl_vars['search']['shipping_freight_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="shipping_freight_to" value="<?php echo $__tpl_vars['search']['shipping_freight_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<div class="search-field">
	<label for="weight_from"><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
&nbsp;(<?php echo $__tpl_vars['settings']['General']['weight_symbol']; ?>
):</label>
	<input type="text" name="weight_from" id="weight_from" value="<?php echo $__tpl_vars['search']['weight_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="weight_to" value="<?php echo $__tpl_vars['search']['weight_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<div class="search-field">
	<label for="amount_from"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
:</label>
	<input type="text" name="amount_from" id="amount_from" value="<?php echo $__tpl_vars['search']['amount_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="amount_to" value="<?php echo $__tpl_vars['search']['amount_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<hr />

<div class="search-field">
	<label for="free_shipping"><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:</label>
	<select name="free_shipping" id="free_shipping">
		<option value="">--</option>
		<option value="Y" <?php if ($__tpl_vars['search']['free_shipping'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
		<option value="N" <?php if ($__tpl_vars['search']['free_shipping'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="search-field">
	<label for="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<select name="status" id="status">
		<option value="">--</option>
		<option value="A" <?php if ($__tpl_vars['search']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
		<option value="H" <?php if ($__tpl_vars['search']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
		<option value="D" <?php if ($__tpl_vars['search']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
	</select>
</div>

<hr />

<div class="search-field">
	<label for="popularity_from"><?php echo fn_get_lang_var('popularity', $this->getLanguage()); ?>
:</label>
	<input type="text" name="popularity_from" id="popularity_from" value="<?php echo $__tpl_vars['search']['popularity_from']; ?>
" onfocus="this.select();" class="input-text" />&nbsp;&ndash;&nbsp;<input type="text" name="popularity_to" value="<?php echo $__tpl_vars['search']['popularity_to']; ?>
" onfocus="this.select();" class="input-text" />
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $__tpl_vars['dispatch'],'view_type' => 'products')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

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