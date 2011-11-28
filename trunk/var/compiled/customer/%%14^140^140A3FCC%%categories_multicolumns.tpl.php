<?php /* Smarty version 2.6.18, created on 2011-11-28 12:21:48
         compiled from views/categories/components/categories_multicolumns.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/categories/components/categories_multicolumns.tpl', 3, false),array('function', 'math', 'views/categories/components/categories_multicolumns.tpl', 4, false),array('modifier', 'default', 'views/categories/components/categories_multicolumns.tpl', 3, false),array('modifier', 'fn_generate_thumbnail', 'views/categories/components/categories_multicolumns.tpl', 32, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_larger_image','categories'));
?>
<?php  ob_start();  ?>
<?php echo smarty_function_split(array('data' => $__tpl_vars['categories'],'size' => smarty_modifier_default(@$__tpl_vars['columns'], '3'),'assign' => 'splitted_categories'), $this);?>

<?php echo smarty_function_math(array('equation' => "floor(100/x)",'x' => smarty_modifier_default(@$__tpl_vars['columns'], '3'),'assign' => 'cell_width'), $this);?>


<table cellpadding="0" cellspacing="3" border="0" width="100%">
<?php $_from_3613826365 = & $__tpl_vars['splitted_categories']; if (!is_array($_from_3613826365) && !is_object($_from_3613826365)) { settype($_from_3613826365, 'array'); }if (count($_from_3613826365)):
    foreach ($_from_3613826365 as $__tpl_vars['scats']):
?>
<tr valign="bottom">
<?php $_from_32200136 = & $__tpl_vars['scats']; if (!is_array($_from_32200136) && !is_object($_from_32200136)) { settype($_from_32200136, 'array'); }if (count($_from_32200136)):
    foreach ($_from_32200136 as $__tpl_vars['category']):
?>
	<?php if ($__tpl_vars['category']): ?>
	<td class="center" width="<?php echo $__tpl_vars['cell_width']; ?>
%">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.view&amp;category_id=<?php echo $__tpl_vars['category']['category_id']; ?>
"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('show_detailed_link' => false, 'object_type' => 'category', 'images' => $__tpl_vars['category']['main_pair'], 'no_ids' => true, )); ?>
<?php if ($__tpl_vars['show_thumbnail'] != 'Y'): ?><?php if (! $__tpl_vars['image_width']): ?><?php if ($__tpl_vars['images']['icon']['image_x']): ?><?php $this->assign('image_width', $__tpl_vars['images']['icon']['image_x'], false); ?><?php endif; ?><?php if ($__tpl_vars['images']['icon']['image_y']): ?><?php $this->assign('image_height', $__tpl_vars['images']['icon']['image_y'], false); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['images']['icon']['image_x'] && $__tpl_vars['images']['icon']['image_y']): ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $__tpl_vars['image_width'],'x' => $__tpl_vars['images']['icon']['image_x'],'y' => $__tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php endif; ?><?php endif; ?><?php endif; ?><?php if ($__tpl_vars['show_thumbnail'] == 'Y' && ( $__tpl_vars['image_width'] || $__tpl_vars['image_height'] ) && $__tpl_vars['images']['image_id']): ?><?php $this->assign('object_type', smarty_modifier_default(@$__tpl_vars['object_type'], 'product'), false); ?><?php $this->assign('icon_image_path', fn_generate_thumbnail($__tpl_vars['images']['icon']['image_path'], $__tpl_vars['image_width'], $__tpl_vars['image_height'], $__tpl_vars['make_box']), false); ?><?php if ($__tpl_vars['make_box'] == true): ?><?php $this->assign('image_height', $__tpl_vars['image_width'], false); ?><?php endif; ?><?php else: ?><?php $this->assign('icon_image_path', $__tpl_vars['images']['icon']['image_path'], false); ?><?php endif; ?><?php if (! $__tpl_vars['images']['icon']['is_flash']): ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?><a<?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?> id="detailed_href1_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?><?php if ($__tpl_vars['rel']): ?> rel="<?php echo $__tpl_vars['rel']; ?>"<?php endif; ?><?php if ($__tpl_vars['link_class']): ?> class="<?php echo $__tpl_vars['link_class']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" rev="<?php echo $__tpl_vars['images']['detailed']['alt']; ?>"><?php endif; ?><?php if (! ( $__tpl_vars['object_type'] == 'category' && ! $__tpl_vars['icon_image_path'] )): ?><img class="<?php echo $__tpl_vars['valign']; ?> <?php echo $__tpl_vars['class']; ?>" <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="det_img_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> src="<?php echo smarty_modifier_default(@$__tpl_vars['icon_image_path'], @$__tpl_vars['config']['no_image_path']); ?>" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> alt="<?php echo $__tpl_vars['images']['icon']['alt']; ?>" <?php if ($__tpl_vars['image_onclick']): ?>onclick="<?php echo $__tpl_vars['image_onclick']; ?>"<?php endif; ?> border="0" /><?php endif; ?><?php if ($__tpl_vars['show_detailed_link'] && $__tpl_vars['images']['detailed_id']): ?></a><?php endif; ?><?php else: ?><object <?php if ($__tpl_vars['valign']): ?>class="valign"<?php endif; ?> classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?>><param name="movie" value="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><?php if ($__tpl_vars['flash_vars']): ?><param name="FlashVars" value="<?php echo $__tpl_vars['flash_vars']; ?>"><?php endif; ?><embed src="<?php echo smarty_modifier_default(@$__tpl_vars['images']['icon']['image_path'], @$__tpl_vars['config']['no_image_path']); ?>" quality="high" wmode="transparent" <?php if ($__tpl_vars['image_width']): ?>width="<?php echo $__tpl_vars['image_width']; ?>"<?php endif; ?> <?php if ($__tpl_vars['image_height']): ?>height="<?php echo $__tpl_vars['image_height']; ?>"<?php endif; ?> allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" <?php if ($__tpl_vars['flash_vars']): ?>FlashVars="<?php echo $__tpl_vars['flash_vars']; ?>"<?php endif; ?> /></object><?php endif; ?><?php if ($__tpl_vars['show_detailed_link']): ?><p class="<?php if (! $__tpl_vars['images']['detailed_id']): ?>hidden<?php endif; ?> <?php echo $__tpl_vars['detailed_link_class']; ?> center" id="detailed_box_<?php echo $__tpl_vars['obj_id']; ?>"><a <?php if ($__tpl_vars['obj_id'] && ! $__tpl_vars['no_ids']): ?>id="detailed_href2_<?php echo $__tpl_vars['obj_id']; ?>"<?php endif; ?> href="<?php echo $__tpl_vars['images']['detailed']['image_path']; ?>" class="cm-thumbnails-opener view-large-image-link"><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?></a></p><?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></a>
	</td>
	<?php else: ?>
	<td width="<?php echo $__tpl_vars['cell_width']; ?>
%">&nbsp;</td>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
<tr class="category-names">
<?php $_from_32200136 = & $__tpl_vars['scats']; if (!is_array($_from_32200136) && !is_object($_from_32200136)) { settype($_from_32200136, 'array'); }if (count($_from_32200136)):
    foreach ($_from_32200136 as $__tpl_vars['category']):
?>
	<?php if ($__tpl_vars['category']): ?>
	<td class="center" valign="top" width="<?php echo $__tpl_vars['cell_width']; ?>
%">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.view&amp;category_id=<?php echo $__tpl_vars['category']['category_id']; ?>
" class="underlined-bold"><?php echo $__tpl_vars['category']['category']; ?>
</a>
	</td>
	<?php else: ?>
	<td width="<?php echo $__tpl_vars['cell_width']; ?>
%">&nbsp;</td>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php ob_start(); ?><?php echo smarty_modifier_default(@$__tpl_vars['title'], fn_get_lang_var('categories', $this->getLanguage())); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?><?php  ob_end_flush();  ?>