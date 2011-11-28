<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from views/products/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/update.tpl', 1, false),array('modifier', 'unescape', 'views/products/update.tpl', 1, false),array('modifier', 'extension_loaded', 'views/products/update.tpl', 12, false),array('modifier', 'intval', 'views/products/update.tpl', 13, false),array('modifier', 'fn_check_gd_formats', 'views/products/update.tpl', 14, false),array('modifier', 'replace', 'views/products/update.tpl', 16, false),array('modifier', 'fn_show_picker', 'views/products/update.tpl', 47, false),array('modifier', 'fn_get_plain_categories_tree', 'views/products/update.tpl', 53, false),array('modifier', 'indent', 'views/products/update.tpl', 54, false),array('modifier', 'is_array', 'views/products/update.tpl', 87, false),array('modifier', 'yaml_unserialize', 'views/products/update.tpl', 88, false),array('modifier', 'lower', 'views/products/update.tpl', 91, false),array('modifier', 'fn_check_view_permissions', 'views/products/update.tpl', 155, false),array('modifier', 'in_array', 'views/products/update.tpl', 240, false),array('modifier', 'date_format', 'views/products/update.tpl', 288, false),array('modifier', 'range', 'views/products/update.tpl', 295, false),array('modifier', 'implode', 'views/products/update.tpl', 299, false),array('modifier', 'fn_explode_localizations', 'views/products/update.tpl', 367, false),array('modifier', 'fn_compact_value', 'views/products/update.tpl', 510, false),array('block', 'notes', 'views/products/update.tpl', 9, false),array('block', 'hook', 'views/products/update.tpl', 444, false),array('function', 'script', 'views/products/update.tpl', 291, false),array('function', 'math', 'views/products/update.tpl', 293, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_gd_loaded_note','text_auto_thumbnails_disabled','error_gd_not_installed','information','name','main_category','main_category','price','full_description','active','hidden','disabled','status','active','hidden','disabled','images','text_product_thumbnail','text_product_detailed_image','pricing_inventory','product_code','list_price','in_stock','edit','remove_this_item','remove_this_item','zero_price_action','zpa_refuse','zpa_permit','zpa_ask_price','inventory','track_with_options','track_without_options','dont_track','min_order_qty','max_order_qty','quantity_step','list_quantity_count','weight','free_shipping','shipping_freight','taxes','seo_meta_data','page_title','meta_description','meta_keywords','search_words','availability','created_date','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','available_since','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','buy_in_advance','extra','feature_comparison','downloadable','edp_enable_shipping','time_unlimited_download','localization','multiple_selectbox_notice','short_description','popularity','additional_images','additional_thumbnail','additional_popup_larger_image','text_additional_thumbnail','text_additional_detailed_image','additional_thumbnail','additional_popup_larger_image','text_additional_thumbnail','text_additional_detailed_image','new_product','preview','txt_page_access_link','editing_product'));
?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>

<?php $this->_tag_stack[] = array('notes', array()); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('width' => $__tpl_vars['settings']['Thumbnails']['product_thumbnail_width'], 'option_name' => 'product_thumbnail_width', )); ?>

<?php if (extension_loaded('gd') && $__tpl_vars['settings']['Thumbnails']['create_thumbnails'] == 'Y'): ?>
	<?php $this->assign('_width', intval($__tpl_vars['width']), false); ?>
	<?php $this->assign('_formats', fn_check_gd_formats(""), false); ?>
	<?php $this->assign('_fmt', $__tpl_vars['settings']['Thumbnails']['convert_to'], false); ?>
	<?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(fn_get_lang_var('text_gd_loaded_note', $this->getLanguage()), "[width]", $__tpl_vars['_width']), "[link_width]", ($__tpl_vars['index_script'])."?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=".($__tpl_vars['option_name'])), "[format]", $__tpl_vars['_formats'][$__tpl_vars['_fmt']]), "[link_format]", ($__tpl_vars['index_script'])."?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=convert_to"), "[link_avail]", ($__tpl_vars['index_script'])."?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=create_thumbnails"); ?>

<?php elseif ($__tpl_vars['settings']['Thumbnails']['create_thumbnails'] != 'Y'): ?>
	<?php echo smarty_modifier_replace(fn_get_lang_var('text_auto_thumbnails_disabled', $this->getLanguage()), "[link_avail]", ($__tpl_vars['index_script'])."?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=create_thumbnails"); ?>

<?php else: ?>
	<?php echo fn_get_lang_var('error_gd_not_installed', $this->getLanguage()); ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="product_update_form" class="cm-form-highlight" enctype="multipart/form-data"> <input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" id="selected_section" value="<?php echo $__tpl_vars['_REQUEST']['selected_section']; ?>
" />
<input type="hidden" name="product_id" value="<?php echo $__tpl_vars['product_data']['product_id']; ?>
" />


<div id="content_detailed"> 
<fieldset>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('information', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_description_product" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[product]" id="product_description_product" size="55" value="<?php echo $__tpl_vars['product_data']['product']; ?>
" class="input-text-large main-input" />
</div>

<div class="form-field">
	<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
		<label for="main_category_id" class="cm-required"><?php echo fn_get_lang_var('main_category', $this->getLanguage()); ?>
:</label>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => 'main_category','input_name' => "product_data[main_category]",'item_ids' => smarty_modifier_default(@$__tpl_vars['product_data']['main_category'], @$__tpl_vars['_REQUEST']['category_id']),'hide_link' => true,'hide_delete_button' => true,'display_input_id' => 'main_category_id','disable_no_item_text' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<label for="products_categories_M" class="cm-required"><?php echo fn_get_lang_var('main_category', $this->getLanguage()); ?>
:</label>
		<select	name="product_data[main_category]" id="products_categories_M">
			<?php $_from_1987358827 = & fn_get_plain_categories_tree(0, false); if (!is_array($_from_1987358827) && !is_object($_from_1987358827)) { settype($_from_1987358827, 'array'); }if (count($_from_1987358827)):
    foreach ($_from_1987358827 as $__tpl_vars['cat']):
?>
				<option	value="<?php echo $__tpl_vars['cat']['category_id']; ?>
" <?php if ($__tpl_vars['product_data']['main_category'] == $__tpl_vars['cat']['category_id'] || $__tpl_vars['cat']['category_id'] == $__tpl_vars['_REQUEST']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($__tpl_vars['cat']['category'], $__tpl_vars['cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php endif; ?>
</div>

<div class="form-field">
	<label for="price_price" class="cm-required"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
) :</label>
	<input type="text" name="product_data[price]" id="price_price" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['price'], "0.00"); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_full_descr"><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>
:</label>
	<textarea id="product_full_descr" name="product_data[full_description]" cols="55" rows="8" class="input-textarea-long"><?php echo $__tpl_vars['product_data']['full_description']; ?>
</textarea>
	<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => 'product_full_descr')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
</div>

<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('input_name' => "product_data[status]", 'id' => 'product_data', 'obj' => $__tpl_vars['product_data'], 'hidden' => true, )); ?>

<?php if ($__tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $__tpl_vars['input_name']; ?>
" <?php if ($__tpl_vars['input_id']): ?>id="<?php echo $__tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($__tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($__tpl_vars['hidden']): ?>
	<option value="H" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from_3342526419), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
" <?php if ($__tpl_vars['obj']['status'] == $__tpl_vars['st'] || ( ! $__tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
"><?php echo $__tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a" <?php if ($__tpl_vars['obj']['status'] == 'A' || ! $__tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($__tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('images', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_main','image_object_type' => 'product','image_pair' => $__tpl_vars['product_data']['main_pair'],'icon_text' => fn_get_lang_var('text_product_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_product_detailed_image', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('pricing_inventory', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_product_code"><?php echo fn_get_lang_var('product_code', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[product_code]" id="product_product_code" size="20" value="<?php echo $__tpl_vars['product_data']['product_code']; ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_list_price"><?php echo fn_get_lang_var('list_price', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
) :</label>
	<input type="text" name="product_data[list_price]" id="product_data_list_price" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['list_price'], "0.00"); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_amount"><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:</label>
	<?php if ($__tpl_vars['product_data']['tracking'] == 'O'): ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('edit', $this->getLanguage()), 'but_href' => ($__tpl_vars['index_script'])."?dispatch=product_options.inventory&product_id=".($__tpl_vars['product_data']['product_id']), 'but_role' => 'edit', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php else: ?>
		<input type="text" name="product_data[amount]" id="product_amount" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['amount'], '1'); ?>
" class="input-text-short" />
	<?php endif; ?>
</div>

<div class="form-field">
	<label for="zero_price_action"><?php echo fn_get_lang_var('zero_price_action', $this->getLanguage()); ?>
:</label>
	<select name="product_data[zero_price_action]" id="zero_price_action">
		<option value="R" <?php if ($__tpl_vars['product_data']['zero_price_action'] == 'R'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_refuse', $this->getLanguage()); ?>
</option>
		<option value="P" <?php if ($__tpl_vars['product_data']['zero_price_action'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_permit', $this->getLanguage()); ?>
</option>
		<option value="A" <?php if ($__tpl_vars['product_data']['zero_price_action'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('zpa_ask_price', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="product_tracking"><?php echo fn_get_lang_var('inventory', $this->getLanguage()); ?>
:</label>
	<select name="product_data[tracking]" id="product_tracking">
		<?php if ($__tpl_vars['product_options']): ?>
			<option value="O" <?php if ($__tpl_vars['product_data']['tracking'] == 'O'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('track_with_options', $this->getLanguage()); ?>
</option>
		<?php endif; ?>
		<option value="B" <?php if ($__tpl_vars['product_data']['tracking'] == 'B'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('track_without_options', $this->getLanguage()); ?>
</option>
		<option value="D" <?php if ($__tpl_vars['product_data']['tracking'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('dont_track', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="min_qty"><?php echo fn_get_lang_var('min_order_qty', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[min_qty]" size="10" id="min_qty" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['min_qty'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="max_qty"><?php echo fn_get_lang_var('max_order_qty', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[max_qty]" id="max_qty" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['max_qty'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="qty_step"><?php echo fn_get_lang_var('quantity_step', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[qty_step]" id="qty_step" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['qty_step'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="list_qty_count"><?php echo fn_get_lang_var('list_quantity_count', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[list_qty_count]" id="list_qty_count" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['list_qty_count'], '0'); ?>
" class="input-text-short" />
</div>

<div class="form-field">
	<label for="product_weight"><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['settings']['General']['weight_symbol']; ?>
) :</label>
	<input type="text" name="product_data[weight]" id="product_weight" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['weight'], '0'); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_free_shipping"><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[free_shipping]" value="N" />
	<input type="checkbox" name="product_data[free_shipping]" id="product_free_shipping" value="Y" <?php if ($__tpl_vars['product_data']['free_shipping'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="product_shipping_freight"><?php echo fn_get_lang_var('shipping_freight', $this->getLanguage()); ?>
 (<?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
):</label>
	<input type="text" name="product_data[shipping_freight]" id="product_shipping_freight" size="10" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['shipping_freight'], "0.00"); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="products_tax_id"><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<input type="hidden" name="product_data[tax_ids]" value="" />
		<?php $_from_215027524 = & $__tpl_vars['taxes']; if (!is_array($_from_215027524) && !is_object($_from_215027524)) { settype($_from_215027524, 'array'); }if (count($_from_215027524)):
    foreach ($_from_215027524 as $__tpl_vars['tax']):
?>
			<input type="checkbox" name="product_data[tax_ids][<?php echo $__tpl_vars['tax']['tax_id']; ?>
]" id="product_data_<?php echo $__tpl_vars['tax']['tax_id']; ?>
" <?php if (smarty_modifier_in_array($__tpl_vars['tax']['tax_id'], $__tpl_vars['product_data']['taxes']) || $__tpl_vars['product_data']['taxes'][$__tpl_vars['tax']['tax_id']]): ?>checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $__tpl_vars['tax']['tax_id']; ?>
" />
			<label for="product_data_<?php echo $__tpl_vars['tax']['tax_id']; ?>
"><?php echo $__tpl_vars['tax']['tax']; ?>
</label>
		<?php endforeach; else: ?>
			&ndash;
		<?php endif; unset($_from); ?>
	</div>
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('seo_meta_data', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_page_title"><?php echo fn_get_lang_var('page_title', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[page_title]" id="product_page_title" size="55" value="<?php echo $__tpl_vars['product_data']['page_title']; ?>
" class="input-text-large" />
</div>

<div class="form-field">
	<label for="product_meta_descr"><?php echo fn_get_lang_var('meta_description', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[meta_description]" id="product_meta_descr" cols="55" rows="2" class="input-textarea-long"><?php echo $__tpl_vars['product_data']['meta_description']; ?>
</textarea>
</div>

<div class="form-field">
	<label for="product_meta_keywords"><?php echo fn_get_lang_var('meta_keywords', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[meta_keywords]" id="product_meta_keywords" cols="55" rows="2" class="input-textarea-long"><?php echo $__tpl_vars['product_data']['meta_keywords']; ?>
</textarea>
</div>

<div class="form-field">
	<label for="product_search_words"><?php echo fn_get_lang_var('search_words', $this->getLanguage()); ?>
:</label>
	<textarea name="product_data[search_words]" id="product_search_words" cols="55" rows="2" class="input-textarea-long"><?php echo $__tpl_vars['product_data']['search_words']; ?>
</textarea>
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('availability', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('created_date', $this->getLanguage()); ?>
:</label>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => 'date_holder', 'date_name' => "product_data[timestamp]", 'date_val' => smarty_modifier_default(@$__tpl_vars['product_data']['timestamp'], @TIME), 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text<?php if ($__tpl_vars['date_meta']): ?> <?php echo $__tpl_vars['date_meta']; ?>
<?php endif; ?>" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but" id="sw_<?php echo $__tpl_vars['date_id']; ?>
_picker" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />
<div id="<?php echo $__tpl_vars['date_id']; ?>
_picker" class="calendar-box cm-smart-position cm-popup-box hidden"></div>

<?php echo smarty_function_script(array('src' => "js/calendar.js"), $this);?>


<?php echo smarty_function_math(array('equation' => "x+y",'assign' => 'end_year','x' => smarty_modifier_default(@$__tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>

<?php $this->assign('start_year', smarty_modifier_default(@$__tpl_vars['start_year'], @$__tpl_vars['settings']['Company']['company_start_year']), false); ?>
<?php $this->assign('years_list', range($__tpl_vars['start_year'], $__tpl_vars['end_year']), false); ?>

<script type="text/javascript">
//<![CDATA[
new ccal(<?php echo $__tpl_vars['ldelim']; ?>
id: '<?php echo $__tpl_vars['date_id']; ?>
_picker', date_id: '<?php echo $__tpl_vars['date_id']; ?>
', button_id: 'sw_<?php echo $__tpl_vars['date_id']; ?>
_picker', month_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>true<?php else: ?>false<?php endif; ?>, sunday_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>true<?php else: ?>false<?php endif; ?>, week_days_name: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'], months: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'], years: [<?php echo implode(", ", $__tpl_vars['years_list']); ?>
]<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<div class="form-field">
	<label for="date_avail_holder"><?php echo fn_get_lang_var('available_since', $this->getLanguage()); ?>
:</label>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('date_id' => 'date_avail_holder', 'date_name' => "product_data[avail_since]", 'date_val' => smarty_modifier_default(@$__tpl_vars['product_data']['avail_since'], ""), 'start_year' => $__tpl_vars['settings']['Company']['company_start_year'], )); ?>

<?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $__tpl_vars['date_id']; ?>
" name="<?php echo $__tpl_vars['date_name']; ?>
" class="input-text<?php if ($__tpl_vars['date_meta']): ?> <?php echo $__tpl_vars['date_meta']; ?>
<?php endif; ?>" value="<?php if ($__tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($__tpl_vars['date_val'], ($__tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $__tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/calendar.gif" class="cm-combo-on cm-combination calendar-but" id="sw_<?php echo $__tpl_vars['date_id']; ?>
_picker" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />
<div id="<?php echo $__tpl_vars['date_id']; ?>
_picker" class="calendar-box cm-smart-position cm-popup-box hidden"></div>

<?php echo smarty_function_script(array('src' => "js/calendar.js"), $this);?>


<?php echo smarty_function_math(array('equation' => "x+y",'assign' => 'end_year','x' => smarty_modifier_default(@$__tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>

<?php $this->assign('start_year', smarty_modifier_default(@$__tpl_vars['start_year'], @$__tpl_vars['settings']['Company']['company_start_year']), false); ?>
<?php $this->assign('years_list', range($__tpl_vars['start_year'], $__tpl_vars['end_year']), false); ?>

<script type="text/javascript">
//<![CDATA[
new ccal(<?php echo $__tpl_vars['ldelim']; ?>
id: '<?php echo $__tpl_vars['date_id']; ?>
_picker', date_id: '<?php echo $__tpl_vars['date_id']; ?>
', button_id: 'sw_<?php echo $__tpl_vars['date_id']; ?>
_picker', month_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>true<?php else: ?>false<?php endif; ?>, sunday_first: <?php if ($__tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>true<?php else: ?>false<?php endif; ?>, week_days_name: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'], months: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'], years: [<?php echo implode(", ", $__tpl_vars['years_list']); ?>
]<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<div class="form-field">
	<label for="buy_in_advance"><?php echo fn_get_lang_var('buy_in_advance', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[buy_in_advance]" value="N" />
	<input type="checkbox" id="buy_in_advance" name="product_data[buy_in_advance]" value="Y" <?php if ($__tpl_vars['product_data']['buy_in_advance'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>
</fieldset>

<fieldset>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('extra', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_feature_comparison"><?php echo fn_get_lang_var('feature_comparison', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[feature_comparison]" value="N" />
	<input type="checkbox" name="product_data[feature_comparison]" id="product_feature_comparison" value="Y" <?php if ($__tpl_vars['product_data']['feature_comparison'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="product_is_edp"><?php echo fn_get_lang_var('downloadable', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[is_edp]" value="N" />
	<input type="checkbox" name="product_data[is_edp]" id="product_is_edp" value="Y" <?php if ($__tpl_vars['product_data']['is_edp'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="$('#edp_shipping').toggleBy(); $('#edp_unlimited').toggleBy();" class="checkbox" />
</div>

<div class="form-field <?php if ($__tpl_vars['product_data']['is_edp'] != 'Y'): ?>hidden<?php endif; ?>" id="edp_shipping">
	<label for="product_edp_shipping"><?php echo fn_get_lang_var('edp_enable_shipping', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[edp_shipping]" value="N" />
	<input type="checkbox" name="product_data[edp_shipping]" id="product_edp_shipping" value="Y" <?php if ($__tpl_vars['product_data']['edp_shipping'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field <?php if ($__tpl_vars['product_data']['is_edp'] != 'Y'): ?>hidden<?php endif; ?>" id="edp_unlimited">
	<label for="product_edp_unlimited"><?php echo fn_get_lang_var('time_unlimited_download', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[edp_unlimited_expire]" value="N" />
	<input type="checkbox" name="product_data[unlimited_download]" id="product_edp_unlimited" value="Y" <?php if ($__tpl_vars['product_data']['unlimited_download'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('data_from' => $__tpl_vars['product_data']['localization'], 'data_name' => "product_data[localization]", )); ?>

<?php $this->assign('data', fn_explode_localizations($__tpl_vars['data_from']), false); ?>

<?php if ($__tpl_vars['localizations']): ?>
<?php if (! $__tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $__tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $__tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $__tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$__tpl_vars['id'], @$__tpl_vars['data_name']); ?>
" class="<?php if ($__tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($__tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from_466923040 = & $__tpl_vars['localizations']; if (!is_array($_from_466923040) && !is_object($_from_466923040)) { settype($_from_466923040, 'array'); }if (count($_from_466923040)):
    foreach ($_from_466923040 as $__tpl_vars['loc']):
?>
			<option	value="<?php echo $__tpl_vars['loc']['localization_id']; ?>
" <?php $_from_1215306045 = & $__tpl_vars['data']; if (!is_array($_from_1215306045) && !is_object($_from_1215306045)) { settype($_from_1215306045, 'array'); }if (count($_from_1215306045)):
    foreach ($_from_1215306045 as $__tpl_vars['p_loc']):
?><?php if ($__tpl_vars['p_loc'] == $__tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $__tpl_vars['loc']['localization']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $__tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<div class="form-field">
	<label for="product_short_descr"><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>
:</label>
	<textarea id="product_short_descr" name="product_data[short_description]" cols="55" rows="2" class="input-textarea-long"><?php echo $__tpl_vars['product_data']['short_description']; ?>
</textarea>
	<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => 'product_short_descr')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
</div>

<div class="form-field">
	<label for="product_popularity"><?php echo fn_get_lang_var('popularity', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[popularity]" id="product_popularity" size="55" value="<?php echo smarty_modifier_default(@$__tpl_vars['product_data']['popularity'], 0); ?>
" class="input-text-medium" />
</div>

</fieldset>
</div> 

<div id="content_categories" class="hidden"> 	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('input_name' => "product_data[add_categories]",'item_ids' => $__tpl_vars['product_data']['add_categories'],'multiple' => true,'single_line' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div> 
<div id="content_images" class="hidden"> <fieldset>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('additional_images', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_from_535960251 = & $__tpl_vars['product_data']['image_pairs']; if (!is_array($_from_535960251) && !is_object($_from_535960251)) { settype($_from_535960251, 'array'); }$this->_foreach['detailed_images'] = array('total' => count($_from_535960251), 'iteration' => 0);
if ($this->_foreach['detailed_images']['total'] > 0):
    foreach ($_from_535960251 as $__tpl_vars['pair']):
        $this->_foreach['detailed_images']['iteration']++;
?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_additional','image_object_type' => 'product','image_key' => $__tpl_vars['pair']['pair_id'],'image_type' => 'A','image_pair' => $__tpl_vars['pair'],'icon_title' => fn_get_lang_var('additional_thumbnail', $this->getLanguage()),'detailed_title' => fn_get_lang_var('additional_popup_larger_image', $this->getLanguage()),'icon_text' => fn_get_lang_var('text_additional_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_additional_detailed_image', $this->getLanguage()),'delete_pair' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<hr />
	<?php endforeach; endif; unset($_from); ?>
</fieldset>

<div id="box_new_image" class="margin-top">
	<div class="clear cm-row-item">
		<div class="float-left"><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'product_add_additional','image_object_type' => 'product','image_type' => 'A','icon_title' => fn_get_lang_var('additional_thumbnail', $this->getLanguage()),'detailed_title' => fn_get_lang_var('additional_popup_larger_image', $this->getLanguage()),'icon_text' => fn_get_lang_var('text_additional_thumbnail', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_additional_detailed_image', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		<div class="buttons-container"><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'new_image')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	</div>
	<hr />
</div>

</div> 
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_qty_discounts.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_features.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['mode'] != 'add'): ?>
<div id="content_blocks">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/select_blocks.tpl", 'smarty_include_vars' => array('object_id' => $__tpl_vars['product_data']['product_id'],'data_name' => 'product_data','section' => 'products')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<div id="content_addons">
<?php $this->_tag_stack[] = array('hook', array('name' => "products:detailed_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['suppliers']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/suppliers/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bestsellers/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['age_verification']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/age_verification/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>


<?php $this->_tag_stack[] = array('hook', array('name' => "products:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['required_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/required_products/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>


<div class="buttons-container cm-toggle-button buttons-bg">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.add]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form> 
<?php $this->_tag_stack[] = array('hook', array('name' => "products:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['attachments']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/attachments/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($__tpl_vars['mode'] == 'update'): ?>
<div class="cm-hide-save-button hidden" id="content_options">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_options.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="content_files" class="cm-hide-save-button hidden">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_update_files.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'group_name' => $__tpl_vars['controller'], 'active_tab' => $__tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($__tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (! $__tpl_vars['tabs_section'] || $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section']): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
<?php echo $__tpl_vars['id_suffix']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($__tpl_vars['tab']['href']): ?>href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $__tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($__tpl_vars['mode'] == 'add'): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('new_product', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php $this->_tag_stack[] = array('notes', array('title' => fn_get_lang_var('preview', $this->getLanguage()))); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<p><?php echo fn_get_lang_var('txt_page_access_link', $this->getLanguage()); ?>
: <a target="_blank" title="<?php echo $__tpl_vars['config']['customer_index']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product_data']['product_id']; ?>
" href="<?php echo $__tpl_vars['config']['customer_index']; ?>
?dispatch=products.view&amp;product_id=<?php echo $__tpl_vars['product_data']['product_id']; ?>
"><?php echo fn_compact_value(($__tpl_vars['config']['customer_index'])."?dispatch=products.view&amp;product_id=".($__tpl_vars['product_data']['product_id']), 28); ?>
</a></p>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => smarty_modifier_unescape((fn_get_lang_var('editing_product', $this->getLanguage())).":&nbsp;".($__tpl_vars['product_data']['product'])),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>