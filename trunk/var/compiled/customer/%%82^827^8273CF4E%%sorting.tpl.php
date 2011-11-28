<?php /* Smarty version 2.6.18, created on 2011-11-28 13:18:25
         compiled from views/products/components/sorting.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_query_remove', 'views/products/components/sorting.tpl', 8, false),array('modifier', 'fn_get_products_sorting', 'views/products/components/sorting.tpl', 9, false),array('modifier', 'fn_get_products_views', 'views/products/components/sorting.tpl', 10, false),array('modifier', 'count', 'views/products/components/sorting.tpl', 22, false),array('modifier', 'default', 'views/products/components/sorting.tpl', 36, false),array('modifier', 'replace', 'views/products/components/sorting.tpl', 40, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_as','sort_by'));
?>
<?php  ob_start();  ?>
<!--dynamic:product_sorting-->
<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>
<?php endif; ?>

<?php $this->assign('curl', fn_query_remove($__tpl_vars['config']['current_url'], 'sort_by', 'sort_order', 'result_ids', 'layout'), false); ?>
<?php $this->assign('sorting', fn_get_products_sorting("", 'false'), false); ?>
<?php $this->assign('layouts', fn_get_products_views("", false, false), false); ?>

<?php if ($__tpl_vars['search']['sort_order'] == 'asc'): ?>
	<?php ob_start(); ?>
		<?php echo $__tpl_vars['sorting'][$__tpl_vars['search']['sort_by']]['description']; ?>
&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/sort_desc.gif" width="7" height="6" border="0" alt="" />
	<?php $this->_smarty_vars['capture']['sorting_text'] = ob_get_contents(); ob_end_clean(); ?>
<?php else: ?>
	<?php ob_start(); ?>
		<?php echo $__tpl_vars['sorting'][$__tpl_vars['search']['sort_by']]['description']; ?>
&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/sort_asc.gif" width="7" height="6" border="0" alt="" />
	<?php $this->_smarty_vars['capture']['sorting_text'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php if (! ( ( count($__tpl_vars['category_data']['selected_layouts']) == 1 ) || ( count($__tpl_vars['category_data']['selected_layouts']) == 0 && count(fn_get_products_views("", true)) <= 1 ) )): ?>
<div class="float-left">
<strong><?php echo fn_get_lang_var('view_as', $this->getLanguage()); ?>
:</strong>&nbsp;
<?php ob_start(); ?>
	<ul>
	<?php $_from_4273201199 = & $__tpl_vars['layouts']; if (!is_array($_from_4273201199) && !is_object($_from_4273201199)) { settype($_from_4273201199, 'array'); }if (count($_from_4273201199)):
    foreach ($_from_4273201199 as $__tpl_vars['layout'] => $__tpl_vars['item']):
?>
		<?php if (( $__tpl_vars['category_data']['selected_layouts'][$__tpl_vars['layout']] ) || ( ! $__tpl_vars['category_data']['selected_layouts'] && $__tpl_vars['item']['active'] )): ?>
			<li><a class="<?php echo $__tpl_vars['ajax_class']; ?>
 <?php if ($__tpl_vars['layout'] == $__tpl_vars['selected_layout']): ?>active<?php endif; ?>" rev="pagination_contents" href="<?php echo $__tpl_vars['curl']; ?>
&amp;sort_by=<?php echo $__tpl_vars['search']['sort_by']; ?>
&amp;sort_order=<?php if ($__tpl_vars['search']['sort_order'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>&amp;layout=<?php echo $__tpl_vars['layout']; ?>
" rel="nofollow"><?php echo $__tpl_vars['item']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tools_list' => $this->_smarty_vars['capture']['tools_list'], 'suffix' => 'view_as', 'link_text' => $__tpl_vars['layouts'][$__tpl_vars['selected_layout']]['title'], )); ?>

<a class="select-link cm-combo-on cm-combination" id="sw_select_wrap_<?php echo $__tpl_vars['suffix']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], 'tools'); ?>
</a>

<div id="select_wrap_<?php echo $__tpl_vars['suffix']; ?>
" class="select-popup cm-popup-box hidden left">
	<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
	<?php echo smarty_modifier_replace($__tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-select-list\">"); ?>

</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>
<?php endif; ?>

<div class="right">
<strong><?php echo fn_get_lang_var('sort_by', $this->getLanguage()); ?>
:</strong>&nbsp;
<?php ob_start(); ?>
	<ul>
		<?php $_from_1926045643 = & $__tpl_vars['sorting']; if (!is_array($_from_1926045643) && !is_object($_from_1926045643)) { settype($_from_1926045643, 'array'); }if (count($_from_1926045643)):
    foreach ($_from_1926045643 as $__tpl_vars['option'] => $__tpl_vars['value']):
?>
			<li><a class="<?php echo $__tpl_vars['ajax_class']; ?>
 <?php if ($__tpl_vars['search']['sort_by'] == $__tpl_vars['option']): ?>active<?php endif; ?>" rev="pagination_contents" href="<?php echo $__tpl_vars['curl']; ?>
&amp;sort_by=<?php echo $__tpl_vars['option']; ?>
&amp;sort_order=<?php if ($__tpl_vars['search']['sort_by'] == $__tpl_vars['option']): ?><?php echo $__tpl_vars['search']['sort_order']; ?>
<?php else: ?><?php if ($__tpl_vars['value']['default_order']): ?><?php echo $__tpl_vars['value']['default_order']; ?>
<?php else: ?>asc<?php endif; ?><?php endif; ?>" rel="nofollow"><?php echo $__tpl_vars['value']['description']; ?>
<?php if ($__tpl_vars['search']['sort_by'] == $__tpl_vars['option']): ?>&nbsp;<?php if ($__tpl_vars['search']['sort_order'] == 'asc'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/sort_desc.gif" width="7" height="6" border="0" alt="" /><?php else: ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/sort_asc.gif" width="7" height="6" border="0" alt="" /><?php endif; ?><?php endif; ?></a>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tools_list' => $this->_smarty_vars['capture']['tools_list'], 'suffix' => 'sort_by', 'link_text' => $this->_smarty_vars['capture']['sorting_text'], )); ?>

<a class="select-link cm-combo-on cm-combination" id="sw_select_wrap_<?php echo $__tpl_vars['suffix']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], 'tools'); ?>
</a>

<div id="select_wrap_<?php echo $__tpl_vars['suffix']; ?>
" class="select-popup cm-popup-box hidden left">
	<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
	<?php echo smarty_modifier_replace($__tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-select-list\">"); ?>

</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<hr />
<!--/dynamic--><?php  ob_end_flush();  ?>