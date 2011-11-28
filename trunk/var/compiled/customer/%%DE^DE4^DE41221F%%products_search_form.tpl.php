<?php /* Smarty version 2.6.18, created on 2011-11-28 13:18:25
         compiled from views/products/components/products_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/products/components/products_search_form.tpl', 40, false),array('modifier', 'fn_show_picker', 'views/products/components/products_search_form.tpl', 46, false),array('modifier', 'fn_get_plain_categories_tree', 'views/products/components/products_search_form.tpl', 55, false),array('modifier', 'indent', 'views/products/components/products_search_form.tpl', 59, false),array('modifier', 'md5', 'views/products/components/products_search_form.tpl', 102, false),array('modifier', 'string_format', 'views/products/components/products_search_form.tpl', 102, false),array('modifier', 'default', 'views/products/components/products_search_form.tpl', 113, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('find_results_with','any_words','all_words','exact_phrase','search_in','product_name','short_description','full_description','keywords','search_in_category','all_categories','all_categories','search_in_subcategories','advanced_search_options','search_by_sku','search_by_price','search_by_weight','or','reset','search_options'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="advanced_search_form" method="get">
<input type="hidden" name="type" value="extended" />

<?php echo $__tpl_vars['search_extra']; ?>


<div class="form-field">
	<label for="match"><?php echo fn_get_lang_var('find_results_with', $this->getLanguage()); ?>
:</label>
	<select name="match" id="match" class="valign">
		<option <?php if ($__tpl_vars['search']['match'] == 'any'): ?>selected="selected"<?php endif; ?> value="any"><?php echo fn_get_lang_var('any_words', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['search']['match'] == 'all'): ?>selected="selected"<?php endif; ?> value="all"><?php echo fn_get_lang_var('all_words', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['search']['match'] == 'exact'): ?>selected="selected"<?php endif; ?> value="exact"><?php echo fn_get_lang_var('exact_phrase', $this->getLanguage()); ?>
</option>
	</select>&nbsp;&nbsp;
	<input type="text" name="q" size="38" value="<?php echo $__tpl_vars['search']['q']; ?>
" class="input-text-large valign" />
</div>

<div class="form-field">
	<label><?php echo fn_get_lang_var('search_in', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<label for="pname">
			<input type="hidden" name="pname" value="N" />
			<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pname'] == 'Y' || ! $__tpl_vars['search']['pname']): ?>checked="checked"<?php endif; ?> name="pname" id="pname" class="checkbox" /><?php echo fn_get_lang_var('product_name', $this->getLanguage()); ?>

		</label>

		<label for="pshort">
			<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pshort'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pshort" id="pshort" class="checkbox" /><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>

		</label>

		<label for="pfull">
			<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pfull'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pfull" id="pfull" class="checkbox" /><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>

		</label>

		<label for="pkeywords">
			<input type="checkbox" value="Y" <?php if ($__tpl_vars['search']['pkeywords'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pkeywords" id="pkeywords" class="checkbox" /><?php echo fn_get_lang_var('keywords', $this->getLanguage()); ?>

		</label>

		<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_in")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
</div>

<div class="form-field">
	<label><?php echo fn_get_lang_var('search_in_category', $this->getLanguage()); ?>
:</label>
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
	<div class="float-left">		<?php $this->assign('all_categories', fn_get_plain_categories_tree(0, false), false); ?>
		<select	name="cid" class="valign">
			<option	value="0" <?php if ($__tpl_vars['category_data']['parent_id'] == '0'): ?>selected<?php endif; ?>>- <?php echo fn_get_lang_var('all_categories', $this->getLanguage()); ?>
 -</option>
			<?php $_from_2474149268 = & $__tpl_vars['all_categories']; if (!is_array($_from_2474149268) && !is_object($_from_2474149268)) { settype($_from_2474149268, 'array'); }if (count($_from_2474149268)):
    foreach ($_from_2474149268 as $__tpl_vars['cat']):
?>
			<option	value="<?php echo $__tpl_vars['cat']['category_id']; ?>
"<?php if ($__tpl_vars['search']['cid'] == $__tpl_vars['cat']['category_id']): ?> selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($__tpl_vars['cat']['category'], $__tpl_vars['cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	<?php endif; ?>
	<div class="select-field subcategories">
		<label for="subcats">
			<input type="checkbox" value="Y"<?php if ($__tpl_vars['search']['subcats'] == 'Y'): ?> checked="checked"<?php endif; ?> name="subcats" id="subcats" class="checkbox" />
			<?php echo fn_get_lang_var('search_in_subcategories', $this->getLanguage()); ?>

		</label>
	</div>
</div>

<?php if (! $__tpl_vars['simple_search_form']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('advanced_search_options', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="form-field">
		<label for="pcode"><?php echo fn_get_lang_var('search_by_sku', $this->getLanguage()); ?>
:</label>
		<input type="text" name="pcode" id="pcode" value="<?php echo $__tpl_vars['search']['pcode']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>

	<div class="form-field">
		<label for="price_from"><?php echo fn_get_lang_var('search_by_price', $this->getLanguage()); ?>
&nbsp;(<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
):</label>
		<input type="text" name="price_from" id="price_from" value="<?php echo $__tpl_vars['search']['price_from']; ?>
" onfocus="this.select();" class="input-text" size="30" />&nbsp;-&nbsp;<input type="text" name="price_to" value="<?php echo $__tpl_vars['search']['price_to']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>

	<div class="form-field">
		<label for="weight_from"><?php echo fn_get_lang_var('search_by_weight', $this->getLanguage()); ?>
&nbsp;(<?php if ($__tpl_vars['config']['localization']['weight_symbol']): ?><?php echo $__tpl_vars['config']['localization']['weight_symbol']; ?>
<?php else: ?><?php echo $__tpl_vars['settings']['General']['weight_symbol']; ?>
<?php endif; ?>):</label>
		<input type="text" name="weight_from" id="weight_from" value="<?php echo $__tpl_vars['search']['weight_from']; ?>
" onfocus="this.select();" class="input-text" size="30" />&nbsp;-&nbsp;<input type="text" name="weight_to" value="<?php echo $__tpl_vars['search']['weight_to']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>

	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_filters_advanced_form.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($__tpl_vars['dispatch'])."]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;<a class="tool-link cm-reset-link"><?php echo fn_get_lang_var('reset', $this->getLanguage()); ?>
</a>
</div>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('section_title' => fn_get_lang_var('search_options', $this->getLanguage()), 'section_content' => $this->_smarty_vars['capture']['section'], 'class' => "search-form", )); ?>

<?php $this->assign('id', smarty_modifier_string_format(md5($__tpl_vars['section_title']), "s_%s"), false); ?>
<?php if ($_COOKIE[$__tpl_vars['id']] || $__tpl_vars['collapse']): ?>
	<?php $this->assign('collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('collapse', false, false); ?>
<?php endif; ?>

<div class="section-border<?php if ($__tpl_vars['class']): ?> <?php echo $__tpl_vars['class']; ?>
<?php endif; ?>">
	<h3 class="section-title">
		<a class="cm-combo-<?php if (! $__tpl_vars['collapse']): ?>off<?php else: ?>on<?php endif; ?> cm-combination cm-save-state cm-ss-reverse" id="sw_<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['section_title']; ?>
</a>
	</h3>
	<div id="<?php echo $__tpl_vars['id']; ?>
" class="<?php echo smarty_modifier_default(@$__tpl_vars['section_body_class'], "section-body"); ?>
 <?php if ($__tpl_vars['collapse']): ?>hidden<?php endif; ?>"><?php echo $__tpl_vars['section_content']; ?>
</div>
</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>