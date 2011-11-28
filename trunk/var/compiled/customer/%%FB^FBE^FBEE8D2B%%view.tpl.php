<?php /* Smarty version 2.6.18, created on 2011-11-28 13:22:51
         compiled from views/categories/view.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/categories/view.tpl', 3, false),array('function', 'math', 'views/categories/view.tpl', 5, false),array('function', 'split', 'views/categories/view.tpl', 6, false),array('function', 'script', 'views/categories/view.tpl', 88, false),array('modifier', 'count', 'views/categories/view.tpl', 5, false),array('modifier', 'default', 'views/categories/view.tpl', 5, false),array('modifier', 'unescape', 'views/categories/view.tpl', 9, false),array('modifier', 'fn_generate_thumbnail', 'views/categories/view.tpl', 36, false),array('modifier', 'escape', 'views/categories/view.tpl', 83, false),array('modifier', 'fn_get_products_views', 'views/categories/view.tpl', 124, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_larger_image','close','click_on_images_text','press_esc_to','text_no_products'));
?>

<?php $this->_tag_stack[] = array('hook', array('name' => "categories:view")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['subcategories'] || $__tpl_vars['category_data']['description'] || $__tpl_vars['category_data']['main_pair']): ?>
<?php echo smarty_function_math(array('equation' => "ceil(n/c)",'assign' => 'rows','n' => count($__tpl_vars['subcategories']),'c' => smarty_modifier_default(@$__tpl_vars['columns'], '2')), $this);?>

<?php echo smarty_function_split(array('data' => $__tpl_vars['subcategories'],'size' => $__tpl_vars['rows'],'assign' => 'splitted_subcategories'), $this);?>


<?php if ($__tpl_vars['category_data']['description'] && $__tpl_vars['category_data']['description'] != ""): ?>
	<div class="category-description"><?php echo smarty_modifier_unescape($__tpl_vars['category_data']['description']); ?>
</div>
<?php endif; ?>


<div class="clear">
	<?php if ($__tpl_vars['category_data']['main_pair']): ?>
	<div class="categories-image">
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('show_detailed_link' => true, 'images' => $__tpl_vars['category_data']['main_pair'], 'object_type' => 'category', 'no_ids' => true, 'class' => "cm-thumbnails", )); ?>
<?php if ($__tpl_vars['show_thumbnail'] != 'Y'): ?><?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['images']['icon']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['images']['icon']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['images']['icon']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['images']['icon']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['images']['icon']['image_x'] && $__tpl_vars['images']['icon']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['images']['icon']['image_x'],'y' => $__tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php endif; ?><?php if ($__tpl_vars['show_thumbnail'] == 'Y' && ( $__tpl_vars['image_width'] || $__tpl_vars['image_height'] ) && $__tpl_vars['images']['image_id']): ?><?php $this->assign('object_type', smarty_modifier_default(@$__tpl_vars['object_type'], 'product'), false); ?><?php $this->assign('icon_image_path', fn_generate_thumbnail($__tpl_vars['images']['icon']['image_path'], $__tpl_vars['image_width'], $__tpl_vars['image_height'], $__tpl_vars['make_box']), false); ?><?php if ($__tpl_vars['make_box'] == true): ?><?php $this->assign('image_height', $__tpl_vars['image_width'], false); ?><?php endif; ?><?php else: ?><?php $this->assign('icon_image_path', $__tpl_vars['images']['icon']['image_path'], false); ?><?php endif; ?><?php if (! $__tpl_vars['images']['icon']['is_flash']): ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?><a<?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?> id="detailed_href1_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?><?php if ($__tpl_vars['rel']): ?> rel="<?php echo $__tpl_vars['rel']; ?>"<?php endif; ?><?php if ($__tpl_vars['link_class']): ?> class="<?php echo $__tpl_vars['link_class']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" rev="<?php echo $__tpl_vars['images']['detailed']['alt']; ?>"><?php endif; ?><?php if (! ( $__tpl_vars['object_type'] == 'category' && ! $__tpl_vars['icon_image_path'] )): ?><img class="<?php echo $__tpl_vars['valign']; ?> <?php echo $__tpl_vars['class']; ?>" <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="det_img_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['icon_image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['images']['icon']['alt']; ?>" <?php if ($__tpl_vars['image_onclick']): ?>onclick="<?php echo $__tpl_vars['image_onclick']; ?>"<?php endif; ?> border="0" /><?php endif; ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['valign']): ?>class="valign"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><?php if ($__tpl_vars['flash_vars']): ?><param name="FlashVars" value="<?php echo $__tpl_vars['flash_vars']; ?>"><?php endif; ?><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" <?php if ($__tpl_vars['flash_vars']): ?>FlashVars="<?php echo $__tpl_vars['flash_vars']; ?>"<?php endif; ?> /></object><?php endif; ?><?php if ($__tpl_vars['show_detailed_link']): ?><p class="<?php if (! $__tpl_vars['images']['detailed_id']): ?>hidden<?php endif; ?> <?php echo $__tpl_vars['detailed_link_class']; ?> center" id="detailed_box_<?php echo $__tpl_vars['obj_id']; ?>"><a <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="detailed_href2_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" class="cm-thumbnails-opener view-large-image-link"><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?></a></p><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>

	<?php if ($__tpl_vars['category_data']['main_pair']['detailed_id']): ?>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<script type="text/javascript">
//<![CDATA[
lang.close = '<?php echo smarty_modifier_escape(fn_get_lang_var('close', $this->getLanguage()), 'javascript'); ?>
';
lang.click_on_images_text = '<?php echo smarty_modifier_escape(fn_get_lang_var('click_on_images_text', $this->getLanguage()), 'javascript'); ?>
';
lang.press_esc_to = '<?php echo smarty_modifier_escape(fn_get_lang_var('press_esc_to', $this->getLanguage()), 'javascript'); ?>
';
//]]>
</script>
<?php echo smarty_function_script(array('src' => "js/previewer.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>

	<?php endif; ?>

	<?php if ($__tpl_vars['subcategories']): ?>
	<div class="subcategories">
	<?php if (count($__tpl_vars['subcategories']) < 6): ?>
		<ul>
	<?php endif; ?>
	<?php $_from_3177648541 = & $__tpl_vars['splitted_subcategories']; if (!is_array($_from_3177648541) && !is_object($_from_3177648541)) { settype($_from_3177648541, 'array'); }if (count($_from_3177648541)):
    foreach ($_from_3177648541 as $__tpl_vars['ssubcateg']):
?>
		<?php if (count($__tpl_vars['subcategories']) >= 6): ?>
			<div class="categories-columns">
				<ul>
		<?php endif; ?>
			<?php $_from_2724214868 = & $__tpl_vars['ssubcateg']; if (!is_array($_from_2724214868) && !is_object($_from_2724214868)) { settype($_from_2724214868, 'array'); }$this->_foreach['ssubcateg'] = array('total' => count($_from_2724214868), 'iteration' => 0);
if ($this->_foreach['ssubcateg']['total'] > 0):
    foreach ($_from_2724214868 as $__tpl_vars['category']):
        $this->_foreach['ssubcateg']['iteration']++;
?>
			<?php if ($__tpl_vars['category']['category_id']): ?><li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.view&amp;category_id=<?php echo $__tpl_vars['category']['category_id']; ?>
" class="underlined-bold"><?php echo $__tpl_vars['category']['category']; ?>
</a></li><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php if (count($__tpl_vars['subcategories']) >= 6): ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if (count($__tpl_vars['subcategories']) < 6): ?>
	</ul>
	<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if ($__tpl_vars['_REQUEST']['advanced_filter']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_filters_advanced_form.tpl", 'smarty_include_vars' => array('separate_form' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if ($__tpl_vars['products']): ?>
<?php $this->assign('layouts', fn_get_products_views("", false, 0), false); ?>
<?php if ($__tpl_vars['category_data']['product_columns']): ?>
	<?php $this->assign('product_columns', $__tpl_vars['category_data']['product_columns'], false); ?>
<?php else: ?>
	<?php $this->assign('product_columns', $__tpl_vars['settings']['Appearance']['columns_in_products_list'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['layouts'][$__tpl_vars['selected_layout']]['template']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['layouts'][$__tpl_vars['selected_layout']]['template']), 'smarty_include_vars' => array('columns' => ($__tpl_vars['product_columns']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php elseif (! $__tpl_vars['subcategories']): ?>
<p class="no-items"><?php echo fn_get_lang_var('text_no_products', $this->getLanguage()); ?>
</p>
<?php endif; ?>

<?php ob_start(); ?><?php echo $__tpl_vars['category_data']['category']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/categories/view.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>