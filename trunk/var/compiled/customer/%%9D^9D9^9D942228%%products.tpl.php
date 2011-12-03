<?php /* Smarty version 2.6.18, created on 2011-12-03 10:03:58
         compiled from views/categories/custom_templates/products.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/categories/custom_templates/products.tpl', 6, false),array('function', 'math', 'views/categories/custom_templates/products.tpl', 83, false),array('modifier', 'default', 'views/categories/custom_templates/products.tpl', 11, false),array('modifier', 'fn_query_remove', 'views/categories/custom_templates/products.tpl', 29, false),array('modifier', 'escape', 'views/categories/custom_templates/products.tpl', 29, false),array('modifier', 'trim', 'views/categories/custom_templates/products.tpl', 66, false),array('modifier', 'fn_generate_thumbnail', 'views/categories/custom_templates/products.tpl', 90, false),array('modifier', 'unescape', 'views/categories/custom_templates/products.tpl', 133, false),array('modifier', 'strip_tags', 'views/categories/custom_templates/products.tpl', 142, false),array('modifier', 'truncate', 'views/categories/custom_templates/products.tpl', 142, false),array('modifier', 'strlen', 'views/categories/custom_templates/products.tpl', 142, false),array('block', 'hook', 'views/categories/custom_templates/products.tpl', 66, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('navi_pages','view_larger_image','view_details','more_link','navi_pages'));
?>

<?php if ($__tpl_vars['products']): ?>

<?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>


<?php if (! $__tpl_vars['no_pagination']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "js/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $__tpl_vars['id']; ?>
">
	
	<?php if ($__tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['page'], @$__tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>
	
	<?php if ($__tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if ($__tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php $this->assign('qstring', smarty_modifier_escape(fn_query_remove($_SERVER['QUERY_STRING'], 'page', 'result_ids')), false); ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
		<?php $this->assign('ajax_class', "cm-ajax", false); ?>
	<?php endif; ?>
	
	<div class="pagination cm-pagination-wraper center">
		<?php echo fn_get_lang_var('navi_pages', $this->getLanguage()); ?>
:&nbsp;&nbsp;
	
		<?php if ($__tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	
		<?php $_from_3143212386 = & $__tpl_vars['pagination']['navi_pages']; if (!is_array($_from_3143212386) && !is_object($_from_3143212386)) { settype($_from_3143212386, 'array'); }if (count($_from_3143212386)):
    foreach ($_from_3143212386 as $__tpl_vars['pg']):
?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pg']; ?>
" rel="<?php echo $__tpl_vars['pg']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<strong class="pagination-selected-page"><?php echo $__tpl_vars['pg']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	
		<?php if ($__tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $__tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>
<?php if (! $__tpl_vars['no_sorting']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/sorting.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php $_from_2374589378 = & $__tpl_vars['products']; if (!is_array($_from_2374589378) && !is_object($_from_2374589378)) { settype($_from_2374589378, 'array'); }$this->_foreach['products'] = array('total' => count($_from_2374589378), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from_2374589378 as $__tpl_vars['key'] => $__tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
<?php if ($__tpl_vars['addons']['age_verification']['status'] == 'A'): ?><?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/age_verification/hooks/products/product_block.override.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean();
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($__tpl_vars['addon_content'])): ?><?php echo $__tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:product_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $this->assign('obj_id', ($__tpl_vars['obj_prefix']).($__tpl_vars['product']['product_id']), false); ?>
<div class="product-container clear">
	<div class="product-image">
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('image_width' => $__tpl_vars['settings']['Appearance']['thumbnail_width'], 'obj_id' => $__tpl_vars['obj_id'], 'images' => $__tpl_vars['product']['main_pair'], 'object_type' => 'product', )); ?>
<?php if ($__tpl_vars['show_thumbnail'] != 'Y'): ?><?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['images']['icon']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['images']['icon']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['images']['icon']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['images']['icon']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['images']['icon']['image_x'] && $__tpl_vars['images']['icon']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['images']['icon']['image_x'],'y' => $__tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php endif; ?><?php if ($__tpl_vars['show_thumbnail'] == 'Y' && ( $__tpl_vars['image_width'] || $__tpl_vars['image_height'] ) && $__tpl_vars['images']['image_id']): ?><?php $this->assign('object_type', smarty_modifier_default(@$__tpl_vars['object_type'], 'product'), false); ?><?php $this->assign('icon_image_path', fn_generate_thumbnail($__tpl_vars['images']['icon']['image_path'], $__tpl_vars['image_width'], $__tpl_vars['image_height'], $__tpl_vars['make_box']), false); ?><?php if ($__tpl_vars['make_box'] == true): ?><?php $this->assign('image_height', $__tpl_vars['image_width'], false); ?><?php endif; ?><?php else: ?><?php $this->assign('icon_image_path', $__tpl_vars['images']['icon']['image_path'], false); ?><?php endif; ?><?php if (! $__tpl_vars['images']['icon']['is_flash']): ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?><a<?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?> id="detailed_href1_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?><?php if ($__tpl_vars['rel']): ?> rel="<?php echo $__tpl_vars['rel']; ?>"<?php endif; ?><?php if ($__tpl_vars['link_class']): ?> class="<?php echo $__tpl_vars['link_class']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" rev="<?php echo $__tpl_vars['images']['detailed']['alt']; ?>"><?php endif; ?><?php if (! ( $__tpl_vars['object_type'] == 'category' && ! $__tpl_vars['icon_image_path'] )): ?><img class="<?php echo $__tpl_vars['valign']; ?> <?php echo $__tpl_vars['class']; ?>" <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="det_img_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['icon_image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['images']['icon']['alt']; ?>" <?php if ($__tpl_vars['image_onclick']): ?>onclick="<?php echo $__tpl_vars['image_onclick']; ?>"<?php endif; ?> border="0" /><?php endif; ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['valign']): ?>class="valign"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><?php if ($__tpl_vars['flash_vars']): ?><param name="FlashVars" value="<?php echo $__tpl_vars['flash_vars']; ?>"><?php endif; ?><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" <?php if ($__tpl_vars['flash_vars']): ?>FlashVars="<?php echo $__tpl_vars['flash_vars']; ?>"<?php endif; ?> /></object><?php endif; ?><?php if ($__tpl_vars['show_detailed_link']): ?><p class="<?php if (! $__tpl_vars['images']['detailed_id']): ?>hidden<?php endif; ?> <?php echo $__tpl_vars['detailed_link_class']; ?> center" id="detailed_box_<?php echo $__tpl_vars['obj_id']; ?>"><a <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="detailed_href2_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" class="cm-thumbnails-opener view-large-image-link"><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?></a></p><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></a>
		<div class="more-info"><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
" class="underlined"><?php echo fn_get_lang_var('view_details', $this->getLanguage()); ?>
&nbsp;<strong>&#8250;&#8250;</strong></a></div>
	</div>
	<div class="product-description">
		<?php if ($__tpl_vars['item_number'] == 'Y'): ?><strong><?php echo $this->_foreach['products']['iteration']; ?>
.&nbsp;</strong><?php endif; ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
" class="product-title"><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
</a>

		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/buy_now.tpl", 'smarty_include_vars' => array('product' => $__tpl_vars['product'],'but_role' => 'action','show_features' => true,'show_sku' => true,'hide_add_to_cart_button' => $__tpl_vars['hide_add_to_cart_button'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($__tpl_vars['product']['short_description'] || $__tpl_vars['product']['full_description']): ?>
		<div class="box margin-top">
		<?php if ($__tpl_vars['product']['short_description']): ?>
			<?php echo smarty_modifier_unescape($__tpl_vars['product']['short_description']); ?>

		<?php else: ?>
			<?php echo smarty_modifier_truncate(smarty_modifier_strip_tags(smarty_modifier_unescape($__tpl_vars['product']['full_description'])), 280, "..."); ?>
<?php if (strlen($__tpl_vars['product']['full_description']) > 280): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product']['product_id']; ?>
" class="underlined"><?php echo fn_get_lang_var('more_link', $this->getLanguage()); ?>
</a><?php endif; ?>
		<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>

<?php if (! ($this->_foreach['products']['iteration'] == $this->_foreach['products']['total'])): ?>
<hr />
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>

<?php if (! $__tpl_vars['no_pagination']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "js/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $__tpl_vars['id']; ?>
">
	
	<?php if ($__tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['page'], @$__tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>
	
	<?php if ($__tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if ($__tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php $this->assign('qstring', smarty_modifier_escape(fn_query_remove($_SERVER['QUERY_STRING'], 'page', 'result_ids')), false); ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
		<?php $this->assign('ajax_class', "cm-ajax", false); ?>
	<?php endif; ?>
	
	<div class="pagination cm-pagination-wraper center">
		<?php echo fn_get_lang_var('navi_pages', $this->getLanguage()); ?>
:&nbsp;&nbsp;
	
		<?php if ($__tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	
		<?php $_from_3143212386 = & $__tpl_vars['pagination']['navi_pages']; if (!is_array($_from_3143212386) && !is_object($_from_3143212386)) { settype($_from_3143212386, 'array'); }if (count($_from_3143212386)):
    foreach ($_from_3143212386 as $__tpl_vars['pg']):
?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pg']; ?>
" rel="<?php echo $__tpl_vars['pg']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<strong class="pagination-selected-page"><?php echo $__tpl_vars['pg']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	
		<?php if ($__tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $__tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php endif; ?>

<?php ob_start(); ?><?php echo $__tpl_vars['title']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>