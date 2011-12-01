<?php /* Smarty version 2.6.18, created on 2011-11-30 23:27:57
         compiled from views/products/components/product_options.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'views/products/components/product_options.tpl', 10, false),array('modifier', 'floatval', 'views/products/components/product_options.tpl', 14, false),array('modifier', 'default', 'views/products/components/product_options.tpl', 37, false),array('modifier', 'fn_generate_thumbnail', 'views/products/components/product_options.tpl', 74, false),array('modifier', 'escape', 'views/products/components/product_options.tpl', 165, false),array('modifier', 'reset', 'views/products/components/product_options.tpl', 209, false),array('modifier', 'to_json', 'views/products/components/product_options.tpl', 234, false),array('block', 'hook', 'views/products/components/product_options.tpl', 14, false),array('function', 'math', 'views/products/components/product_options.tpl', 67, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_larger_image','nocombination'));
?>
<?php if ($__tpl_vars['product_options']): ?>
<div id="opt_<?php echo $__tpl_vars['id']; ?>
">
	<?php $_from_1070965512 = & $__tpl_vars['product_options']; if (!is_array($_from_1070965512) && !is_object($_from_1070965512)) { settype($_from_1070965512, 'array'); }if (count($_from_1070965512)):
    foreach ($_from_1070965512 as $__tpl_vars['po']):
?>
	<?php $this->assign('selected_variant', "", false); ?>
	<div class="form-field product-list-field clear" id="opt_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
">
		<?php if ($__tpl_vars['po']['description']): ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_options_description.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['po']['option_id'],'description' => $__tpl_vars['po']['description'],'text' => "?",'capture_link' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<label for="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" class="<?php if ($__tpl_vars['po']['required'] == 'Y'): ?>cm-required<?php endif; ?> <?php if ($__tpl_vars['po']['regexp']): ?>cm-regexp<?php endif; ?>"><?php echo $__tpl_vars['po']['option_name']; ?>
<?php if ($__tpl_vars['po']['description']): ?>&nbsp;(<?php echo trim($this->_smarty_vars['capture']['link']); ?>
)<?php endif; ?>:</label>
		<?php if ($__tpl_vars['po']['option_type'] == 'S'): ?> 			<select name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" id="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" onchange="fn_check_exceptions(<?php echo $__tpl_vars['id']; ?>
); fn_change_variant_image(<?php echo $__tpl_vars['id']; ?>
, <?php echo $__tpl_vars['po']['option_id']; ?>
, this.value); cart_changed = true;" <?php if ($__tpl_vars['product']['exclude_from_calculate'] && ! $__tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }$this->_foreach['vars'] = array('total' => count($_from_1494924664), 'iteration' => 0);
if ($this->_foreach['vars']['total'] > 0):
    foreach ($_from_1494924664 as $__tpl_vars['vr']):
        $this->_foreach['vars']['iteration']++;
?>
				<option value="<?php echo $__tpl_vars['vr']['variant_id']; ?>
" <?php if ($__tpl_vars['po']['value'] == $__tpl_vars['vr']['variant_id'] || ( $__tpl_vars['location'] != 'cart' && ($this->_foreach['vars']['iteration'] <= 1) )): ?><?php $this->assign('selected_variant', $__tpl_vars['vr']['variant_id'], false); ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['vr']['variant_name']; ?>
 <?php if ($__tpl_vars['settings']['General']['display_options_modifiers'] == 'Y'): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($__tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $__tpl_vars['vr']['modifier_type'],'mod_value' => $__tpl_vars['vr']['modifier'],'display_sign' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($__tpl_vars['po']['option_type'] == 'R'): ?> 			<ul id="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
">
				<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }$this->_foreach['vars'] = array('total' => count($_from_1494924664), 'iteration' => 0);
if ($this->_foreach['vars']['total'] > 0):
    foreach ($_from_1494924664 as $__tpl_vars['vr']):
        $this->_foreach['vars']['iteration']++;
?>
					<li><input type="radio" class="radio" name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" value="<?php echo $__tpl_vars['vr']['variant_id']; ?>
" <?php if ($__tpl_vars['po']['value'] == $__tpl_vars['vr']['variant_id'] || ( $__tpl_vars['location'] != 'cart' && ($this->_foreach['vars']['iteration'] <= 1) )): ?><?php $this->assign('selected_variant', $__tpl_vars['vr']['variant_id'], false); ?>checked="checked"<?php endif; ?> onclick="fn_check_exceptions(<?php echo $__tpl_vars['id']; ?>
); fn_change_variant_image(<?php echo $__tpl_vars['id']; ?>
, <?php echo $__tpl_vars['po']['option_id']; ?>
, this.value); cart_changed = true;" <?php if ($__tpl_vars['product']['exclude_from_calculate'] && ! $__tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?>/>
					<span id="option_description_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
_<?php echo $__tpl_vars['vr']['variant_id']; ?>
"><?php echo $__tpl_vars['vr']['variant_name']; ?>
&nbsp;<?php if ($__tpl_vars['settings']['General']['display_options_modifiers'] == 'Y'): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($__tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $__tpl_vars['vr']['modifier_type'],'mod_value' => $__tpl_vars['vr']['modifier'],'display_sign' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></span></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>

		<?php elseif ($__tpl_vars['po']['option_type'] == 'C'): ?> 
			<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }if (count($_from_1494924664)):
    foreach ($_from_1494924664 as $__tpl_vars['vr']):
?>
			<?php if ($__tpl_vars['vr']['position'] == 0): ?>
				<input id="unchecked_option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" type="hidden" name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" value="<?php echo $__tpl_vars['vr']['variant_id']; ?>
" />
			<?php else: ?>
				<input id="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" type="checkbox" name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" value="<?php echo $__tpl_vars['vr']['variant_id']; ?>
" <?php if ($__tpl_vars['po']['value'] == $__tpl_vars['vr']['variant_id']): ?>checked="checked"<?php endif; ?> onclick="fn_check_exceptions(<?php echo $__tpl_vars['id']; ?>
); cart_changed = true;" <?php if ($__tpl_vars['product']['exclude_from_calculate'] && ! $__tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?>/>
				<?php if ($__tpl_vars['settings']['General']['display_options_modifiers'] == 'Y'): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($__tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $__tpl_vars['vr']['modifier_type'],'mod_value' => $__tpl_vars['vr']['modifier'],'display_sign' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>

		<?php elseif ($__tpl_vars['po']['option_type'] == 'I'): ?> 			<input id="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" type="text" name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" value="<?php echo smarty_modifier_default(@$__tpl_vars['po']['value'], @$__tpl_vars['po']['inner_hint']); ?>
" <?php if ($__tpl_vars['product']['exclude_from_calculate'] && ! $__tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?> onkeypress="cart_changed = true;" class="valign input-text <?php if ($__tpl_vars['po']['inner_hint'] && $__tpl_vars['po']['value'] == ""): ?>cm-hint<?php endif; ?>" />
		<?php elseif ($__tpl_vars['po']['option_type'] == 'T'): ?> 			<textarea id="option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
" class="input-textarea-long <?php if ($__tpl_vars['po']['inner_hint'] && $__tpl_vars['po']['value'] == ""): ?>cm-hint<?php endif; ?>" rows="3" name="<?php echo $__tpl_vars['name']; ?>
[<?php echo $__tpl_vars['id']; ?>
][product_options][<?php echo $__tpl_vars['po']['option_id']; ?>
]" <?php if ($__tpl_vars['product']['exclude_from_calculate'] && ! $__tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?> onkeypress="cart_changed = true;"><?php echo smarty_modifier_default(@$__tpl_vars['po']['value'], @$__tpl_vars['po']['inner_hint']); ?>
</textarea>
		<?php endif; ?>

		<?php if ($__tpl_vars['po']['regexp']): ?>
			<script type="text/javascript">
			//<![CDATA[
				regexp['option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
'] = <?php echo $__tpl_vars['ldelim']; ?>
regexp: "<?php echo $__tpl_vars['po']['regexp']; ?>
", message: "<?php echo $__tpl_vars['po']['incorrect_message']; ?>
"<?php echo $__tpl_vars['rdelim']; ?>
;
			//]]>
			</script>
		<?php endif; ?>

		<?php ob_start(); ?>
			<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }if (count($_from_1494924664)):
    foreach ($_from_1494924664 as $__tpl_vars['var']):
?>
				<?php if ($__tpl_vars['var']['image_pair']['image_id']): ?>
					<?php if ($__tpl_vars['var']['variant_id'] == $__tpl_vars['selected_variant']): ?><?php $this->assign('_class', "product-variant-image-selected", false); ?><?php else: ?><?php $this->assign('_class', "product-variant-image-unselected", false); ?><?php endif; ?>
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('class' => "hand ".($__tpl_vars['_class']), 'show_thumbnail' => 'Y', 'images' => $__tpl_vars['var']['image_pair'], 'object_type' => 'product_option', 'image_width' => '50', 'obj_id' => "variant_image_".($__tpl_vars['id'])."_".($__tpl_vars['var']['variant_id']), 'image_onclick' => "fn_set_option_value(".($__tpl_vars['id']).", '".($__tpl_vars['po']['option_id'])."', ".($__tpl_vars['var']['variant_id'])."); void(0);", )); ?>
<?php if ($__tpl_vars['show_thumbnail'] != 'Y'): ?><?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['images']['icon']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['images']['icon']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['images']['icon']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['images']['icon']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['images']['icon']['image_x'] && $__tpl_vars['images']['icon']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['images']['icon']['image_x'],'y' => $__tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php endif; ?><?php if ($__tpl_vars['show_thumbnail'] == 'Y' && ( $__tpl_vars['image_width'] || $__tpl_vars['image_height'] ) && $__tpl_vars['images']['image_id']): ?><?php $this->assign('object_type', smarty_modifier_default(@$__tpl_vars['object_type'], 'product'), false); ?><?php $this->assign('icon_image_path', fn_generate_thumbnail($__tpl_vars['images']['icon']['image_path'], $__tpl_vars['image_width'], $__tpl_vars['image_height'], $__tpl_vars['make_box']), false); ?><?php if ($__tpl_vars['make_box'] == true): ?><?php $this->assign('image_height', $__tpl_vars['image_width'], false); ?><?php endif; ?><?php else: ?><?php $this->assign('icon_image_path', $__tpl_vars['images']['icon']['image_path'], false); ?><?php endif; ?><?php if (! $__tpl_vars['images']['icon']['is_flash']): ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?><a<?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?> id="detailed_href1_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?><?php if ($__tpl_vars['rel']): ?> rel="<?php echo $__tpl_vars['rel']; ?>"<?php endif; ?><?php if ($__tpl_vars['link_class']): ?> class="<?php echo $__tpl_vars['link_class']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" rev="<?php echo $__tpl_vars['images']['detailed']['alt']; ?>"><?php endif; ?><?php if (! ( $__tpl_vars['object_type'] == 'category' && ! $__tpl_vars['icon_image_path'] )): ?><img class="<?php echo $__tpl_vars['valign']; ?> <?php echo $__tpl_vars['class']; ?>" <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="det_img_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['icon_image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['images']['icon']['alt']; ?>" <?php if ($__tpl_vars['image_onclick']): ?>onclick="<?php echo $__tpl_vars['image_onclick']; ?>"<?php endif; ?> border="0" /><?php endif; ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['valign']): ?>class="valign"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><?php if ($__tpl_vars['flash_vars']): ?><param name="FlashVars" value="<?php echo $__tpl_vars['flash_vars']; ?>"><?php endif; ?><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" <?php if ($__tpl_vars['flash_vars']): ?>FlashVars="<?php echo $__tpl_vars['flash_vars']; ?>"<?php endif; ?> /></object><?php endif; ?><?php if ($__tpl_vars['show_detailed_link']): ?><p class="<?php if (! $__tpl_vars['images']['detailed_id']): ?>hidden<?php endif; ?> <?php echo $__tpl_vars['detailed_link_class']; ?> center" id="detailed_box_<?php echo $__tpl_vars['obj_id']; ?>"><a <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="detailed_href2_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" class="cm-thumbnails-opener view-large-image-link"><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?></a></p><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php $this->_smarty_vars['capture']['variant_images'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if (trim($this->_smarty_vars['capture']['variant_images'])): ?><div class="product-variant-image clear-both"><?php echo $this->_smarty_vars['capture']['variant_images']; ?>
</div><?php endif; ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
</div>
<p id="warning_<?php echo $__tpl_vars['id']; ?>
" class="hidden price"><?php echo fn_get_lang_var('nocombination', $this->getLanguage()); ?>
</p>

<script type="text/javascript">
//<![CDATA[

// Option features
var exception_style = '<?php echo $__tpl_vars['settings']['General']['exception_style']; ?>
';
var image_location = '<?php echo $__tpl_vars['settings']['General']['images_location']; ?>
';
var allow_negative_amount = <?php if ($__tpl_vars['settings']['General']['allow_negative_amount'] == 'Y'): ?>true<?php else: ?>false<?php endif; ?>;
<?php if ($__tpl_vars['product']['exclude_from_calculate']): ?>
exclude_from_calculate[<?php echo $__tpl_vars['id']; ?>
] = '<?php echo $__tpl_vars['product']['exclude_from_calculate']; ?>
';
<?php endif; ?>
<?php if ($__tpl_vars['product']['exception']): ?>
exceptions[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['product']['exception']; ?>
;
function fn_form_pre_<?php echo smarty_modifier_default(@$__tpl_vars['form_name'], "product_form_".($__tpl_vars['id'])); ?>
()
<?php echo $__tpl_vars['ldelim']; ?>

	var res = fn_check_exceptions(<?php echo $__tpl_vars['id']; ?>
);
<?php echo '
	if (!res) {
		jQuery.showNotifications({\'notification\': {\'type\': \'W\', \'title\': lang.warning, \'message\': lang.cannot_buy, \'save_state\': false}});
	}
'; ?>

	return res;
<?php echo $__tpl_vars['rdelim']; ?>
;
<?php endif; ?>
price[<?php echo $__tpl_vars['id']; ?>
] = '<?php echo $__tpl_vars['product']['base_price']; ?>
';
<?php if (floatval($__tpl_vars['product']['list_price'])): ?>
list_price[<?php echo $__tpl_vars['id']; ?>
] = '<?php echo $__tpl_vars['product']['list_price']; ?>
';
<?php endif; ?>
// Define the discounts for the product
pr_d[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>

	'P': <?php if ($__tpl_vars['product']['discounts']['P']): ?><?php echo $__tpl_vars['product']['discounts']['P']; ?>
<?php else: ?>0<?php endif; ?>,
	'A': <?php if ($__tpl_vars['product']['discounts']['A']): ?><?php echo $__tpl_vars['product']['discounts']['A']; ?>
<?php else: ?>0<?php endif; ?>
<?php echo $__tpl_vars['rdelim']; ?>

// Define the array of all options of the product
pr_o[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;
variant_images[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;

<?php $_from_1070965512 = & $__tpl_vars['product_options']; if (!is_array($_from_1070965512) && !is_object($_from_1070965512)) { settype($_from_1070965512, 'array'); }$this->_foreach['ii'] = array('total' => count($_from_1070965512), 'iteration' => 0);
if ($this->_foreach['ii']['total'] > 0):
    foreach ($_from_1070965512 as $__tpl_vars['po']):
        $this->_foreach['ii']['iteration']++;
?>
	pr_o[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>

		'type': '<?php echo $__tpl_vars['po']['option_type']; ?>
',
		'option_id': '<?php echo $__tpl_vars['po']['option_id']; ?>
',
		'id': 'option_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['po']['option_id']; ?>
',
		'inventory': '<?php echo $__tpl_vars['po']['inventory']; ?>
',
		'name': '<?php echo smarty_modifier_escape($__tpl_vars['po']['option_name'], 'javascript'); ?>
',
		'm': <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
,
		'v': <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>

	<?php echo $__tpl_vars['rdelim']; ?>
;

	variant_images[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;
	<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }$this->_foreach['jj'] = array('total' => count($_from_1494924664), 'iteration' => 0);
if ($this->_foreach['jj']['total'] > 0):
    foreach ($_from_1494924664 as $__tpl_vars['var']):
        $this->_foreach['jj']['iteration']++;
?>
        <?php if ($__tpl_vars['var']['image_pair']): ?>
        	variant_images[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
][<?php echo $__tpl_vars['var']['variant_id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>

        	'image_path': '<?php echo smarty_modifier_escape($__tpl_vars['var']['image_pair']['icon']['image_path'], 'javascript'); ?>
'
          	<?php echo $__tpl_vars['rdelim']; ?>

        <?php endif; ?>
		pr_o[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
]['m'][<?php echo $__tpl_vars['var']['variant_id']; ?>
] = <?php if (floatval($__tpl_vars['var']['modifier'])): ?>'<?php echo $__tpl_vars['var']['modifier_type']; ?>
<?php echo $__tpl_vars['var']['modifier']; ?>
'<?php else: ?>'0'<?php endif; ?>;
		pr_o[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
]['v'][<?php echo $__tpl_vars['var']['variant_id']; ?>
] = jQuery.entityDecode('<?php echo smarty_modifier_escape($__tpl_vars['var']['variant_name'], 'javascript'); ?>
'<?php if ($__tpl_vars['settings']['General']['display_options_modifiers'] == 'Y'): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers_js")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($__tpl_vars['var']['modifier'])): ?>+' (<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $__tpl_vars['var']['modifier_type'],'mod_value' => $__tpl_vars['var']['modifier'],'display_sign' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)'<?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers_js.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>);
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>

// images
pr_i[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;
<?php $_from_3164243673 = & $__tpl_vars['product']['option_image_pairs']; if (!is_array($_from_3164243673) && !is_object($_from_3164243673)) { settype($_from_3164243673, 'array'); }$this->_foreach['ii'] = array('total' => count($_from_3164243673), 'iteration' => 0);
if ($this->_foreach['ii']['total'] > 0):
    foreach ($_from_3164243673 as $__tpl_vars['_key'] => $__tpl_vars['imag']):
        $this->_foreach['ii']['iteration']++;
?>
	pr_i[<?php echo $__tpl_vars['id']; ?>
][<?php echo $this->_foreach['ii']['iteration']; ?>
-1] = <?php echo $__tpl_vars['ldelim']; ?>

		'image_id': '<?php echo $__tpl_vars['imag']['image_id']; ?>
',
		'detailed_id': '<?php echo $__tpl_vars['imag']['detailed_id']; ?>
',
		'options': '<?php echo $__tpl_vars['imag']['options']; ?>
'
	<?php echo $__tpl_vars['rdelim']; ?>
;
	<?php if ($__tpl_vars['imag']['image_id']): ?>
	pr_i[<?php echo $__tpl_vars['id']; ?>
][<?php echo $this->_foreach['ii']['iteration']; ?>
-1]['icon'] = <?php echo $__tpl_vars['ldelim']; ?>

		'alt': '<?php echo $__tpl_vars['imag']['icon']['alt']; ?>
',
		'type': '<?php echo $__tpl_vars['imag']['icon']['type']; ?>
',
		'src': '<?php echo $__tpl_vars['imag']['icon']['image_path']; ?>
',
		'src-mini': '<?php echo fn_generate_thumbnail($__tpl_vars['imag']['icon']['image_path'], 34); ?>
'
	<?php echo $__tpl_vars['rdelim']; ?>
;
	<?php endif; ?>
	<?php if ($__tpl_vars['imag']['detailed_id']): ?>
	pr_i[<?php echo $__tpl_vars['id']; ?>
][<?php echo $this->_foreach['ii']['iteration']; ?>
-1]['detailed'] = <?php echo $__tpl_vars['ldelim']; ?>

		'image_path': '<?php echo $__tpl_vars['imag']['detailed']['image_path']; ?>
'
	<?php echo $__tpl_vars['rdelim']; ?>
;
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($__tpl_vars['product']['main_pair']['icon']): ?>
	<?php $this->assign('image_pair_var', $__tpl_vars['product']['main_pair'], false); ?>
<?php elseif ($__tpl_vars['product']['option_image_pairs']): ?>
        image_changed[<?php echo $__tpl_vars['id']; ?>
] = "Y";
	<?php $this->assign('image_pair_var', reset($__tpl_vars['product']['option_image_pairs']), false); ?>
<?php endif; ?>
<?php if ($__tpl_vars['image_pair_var']): ?>
default_image[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>

	'src': '<?php echo $__tpl_vars['config']['no_image_path']; ?>
',
	'src-mini': '<?php echo fn_generate_thumbnail($__tpl_vars['config']['no_image_path'], 34); ?>
',
	'alt': '<?php echo smarty_modifier_escape($__tpl_vars['image_pair_var']['icon']['alt'], 'javascript'); ?>
'
<?php echo $__tpl_vars['rdelim']; ?>
;
default_href[<?php echo $__tpl_vars['id']; ?>
] = '<?php echo $__tpl_vars['image_pair_var']['detailed']['image_path']; ?>
';
<?php endif; ?>

// amount and product code
pr_c[<?php echo $__tpl_vars['id']; ?>
] = '<?php echo smarty_modifier_escape($__tpl_vars['product']['product_code'], 'javascript'); ?>
'; // define default product code
pr_a[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;
<?php $_from_1884766038 = & $__tpl_vars['product']['option_inventory']; if (!is_array($_from_1884766038) && !is_object($_from_1884766038)) { settype($_from_1884766038, 'array'); }$this->_foreach['ii'] = array('total' => count($_from_1884766038), 'iteration' => 0);
if ($this->_foreach['ii']['total'] > 0):
    foreach ($_from_1884766038 as $__tpl_vars['_key'] => $__tpl_vars['amount']):
        $this->_foreach['ii']['iteration']++;
?>
	pr_a[<?php echo $__tpl_vars['id']; ?>
]['<?php echo $__tpl_vars['amount']['options']; ?>
_'] = <?php echo $__tpl_vars['ldelim']; ?>

		'amount': '<?php echo $__tpl_vars['amount']['amount']; ?>
',
		'product_code': '<?php echo smarty_modifier_escape($__tpl_vars['amount']['product_code'], 'javascript'); ?>
'
	<?php echo $__tpl_vars['rdelim']; ?>
;
<?php endforeach; endif; unset($_from); ?>
<?php if ($__tpl_vars['settings']['Appearance']['show_prices_taxed_clean'] == 'Y' || $__tpl_vars['location'] == 'cart'): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => $__tpl_vars['id'], )); ?>

// Product taxes
<?php if ($__tpl_vars['product']['taxes']): ?>
	tax_data[<?php echo $__tpl_vars['id']; ?>
] = <?php echo smarty_modifier_to_json($__tpl_vars['product']['taxes']); ?>
;
<?php endif; ?>
// /Product taxes
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

$(document).ready(function() <?php echo $__tpl_vars['ldelim']; ?>

	fn_check_exceptions(<?php echo $__tpl_vars['id']; ?>
);
<?php echo $__tpl_vars['rdelim']; ?>
);

//]]>
</script>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:options_js")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<script type="text/javascript">
//<![CDATA[

points[<?php echo $__tpl_vars['id']; ?>
] = <?php echo $__tpl_vars['ldelim']; ?>

	'pure_amount': '<?php echo $__tpl_vars['product']['points_info']['reward']['pure_amount']; ?>
'
<?php echo $__tpl_vars['rdelim']; ?>
;

<?php if ($__tpl_vars['product']['points_info']['reward']): ?>
points[<?php echo $__tpl_vars['id']; ?>
]['reward'] = '<?php echo $__tpl_vars['product']['points_info']['reward']['amount']; ?>
';
<?php endif; ?>

<?php if ($__tpl_vars['product']['points_info']['per']): ?>
points[<?php echo $__tpl_vars['id']; ?>
]['per'] = '<?php echo $__tpl_vars['product']['points_info']['per']; ?>
';
<?php endif; ?>

<?php if ($__tpl_vars['product']['points_info']['reward']['amount_type']): ?>
points[<?php echo $__tpl_vars['id']; ?>
]['amount_type'] = '<?php echo $__tpl_vars['product']['points_info']['reward']['amount_type']; ?>
';
<?php endif; ?>

<?php $_from_1070965512 = & $__tpl_vars['product_options']; if (!is_array($_from_1070965512) && !is_object($_from_1070965512)) { settype($_from_1070965512, 'array'); }$this->_foreach['ii'] = array('total' => count($_from_1070965512), 'iteration' => 0);
if ($this->_foreach['ii']['total'] > 0):
    foreach ($_from_1070965512 as $__tpl_vars['po']):
        $this->_foreach['ii']['iteration']++;
?>	
pr_o[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
]['pm'] = <?php echo $__tpl_vars['ldelim']; ?>
<?php echo $__tpl_vars['rdelim']; ?>
;
<?php $_from_1494924664 = & $__tpl_vars['po']['variants']; if (!is_array($_from_1494924664) && !is_object($_from_1494924664)) { settype($_from_1494924664, 'array'); }$this->_foreach['jj'] = array('total' => count($_from_1494924664), 'iteration' => 0);
if ($this->_foreach['jj']['total'] > 0):
    foreach ($_from_1494924664 as $__tpl_vars['var']):
        $this->_foreach['jj']['iteration']++;
?>
	pr_o[<?php echo $__tpl_vars['id']; ?>
][<?php echo $__tpl_vars['po']['option_id']; ?>
]['pm'][<?php echo $__tpl_vars['var']['variant_id']; ?>
] = <?php if (floatval($__tpl_vars['var']['point_modifier'])): ?>'<?php echo $__tpl_vars['var']['point_modifier_type']; ?>
<?php echo $__tpl_vars['var']['point_modifier']; ?>
'<?php else: ?>'0'<?php endif; ?>;
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php endif; ?>