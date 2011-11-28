<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from blocks/product_filters.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'blocks/product_filters.tpl', 7, false),array('modifier', 'fn_query_remove', 'blocks/product_filters.tpl', 8, false),array('modifier', 'fn_delete_range_from_url', 'blocks/product_filters.tpl', 30, false),array('modifier', 'fn_text_placeholders', 'blocks/product_filters.tpl', 32, false),array('modifier', 'fn_add_range_to_url_hash', 'blocks/product_filters.tpl', 38, false),array('modifier', 'unescape', 'blocks/product_filters.tpl', 58, false),array('modifier', 'escape', 'blocks/product_filters.tpl', 60, false),array('modifier', 'defined', 'blocks/product_filters.tpl', 71, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('remove','remove','choose_other','more','view_all','advanced','reset'));
?>
<?php  ob_start();  ?>
<!--dynamic:filters-->
<?php if ($__tpl_vars['items'] && ! $__tpl_vars['_REQUEST']['advanced_filter']): ?>

<?php if (strpos($_SERVER['QUERY_STRING'], "dispatch=") !== false): ?>
	<?php $this->assign('filter_qstring', fn_query_remove($__tpl_vars['config']['current_url'], 'result_ids', 'filter_id', 'view_all', 'req_range_id', 'advanced_filter', 'features_hash', 'subcats'), false); ?>
<?php else: ?>
	<?php $this->assign('filter_qstring', ($__tpl_vars['index_script'])."?dispatch=products.search", false); ?>
<?php endif; ?>

<?php $this->assign('reset_qstring', $__tpl_vars['filter_qstring'], false); ?>

<?php if ($__tpl_vars['_REQUEST']['category_id']): ?>
	<?php $this->assign('filter_qstring', ($__tpl_vars['filter_qstring'])."&amp;subcats=Y", false); ?>
	<?php $this->assign('reset_qstring', ($__tpl_vars['reset_qstring'])."&amp;subcats=Y", false); ?>
	<?php $this->assign('extra_query', "&amp;subcats=Y", false); ?>
<?php endif; ?>

<?php $this->assign('has_selected', false, false); ?>
<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }$this->_foreach['filters'] = array('total' => count($_from_67574462), 'iteration' => 0);
if ($this->_foreach['filters']['total'] > 0):
    foreach ($_from_67574462 as $__tpl_vars['filter']):
        $this->_foreach['filters']['iteration']++;
?>

<h4><?php echo $__tpl_vars['filter']['filter']; ?>
</h4>
<ul class="product-filters" id="content_product_more_filters_<?php echo $__tpl_vars['filter']['filter_id']; ?>
">
<?php $_from_3049802886 = & $__tpl_vars['filter']['ranges']; if (!is_array($_from_3049802886) && !is_object($_from_3049802886)) { settype($_from_3049802886, 'array'); }$this->_foreach['ranges'] = array('total' => count($_from_3049802886), 'iteration' => 0);
if ($this->_foreach['ranges']['total'] > 0):
    foreach ($_from_3049802886 as $__tpl_vars['range']):
        $this->_foreach['ranges']['iteration']++;
?>
	<li <?php if ($this->_foreach['ranges']['iteration'] > @FILTERS_RANGES_COUNT): ?>class="hidden"<?php endif; ?>>
		<?php if ($__tpl_vars['range']['selected'] == true): ?><?php $this->assign('fh', fn_delete_range_from_url($__tpl_vars['_REQUEST']['features_hash'], $__tpl_vars['range'], $__tpl_vars['filter']['field_type']), false); ?><?php $this->assign('has_selected', true, false); ?><a class="extra-link filter-delete" href="<?php if ($__tpl_vars['filter']['feature_type'] == 'E' && $__tpl_vars['range']['range_id'] == $__tpl_vars['_REQUEST']['variant_id']): ?><?php echo $__tpl_vars['index_script']; ?>?dispatch=products.search<?php if ($__tpl_vars['fh']): ?>&amp;features_hash=<?php echo $__tpl_vars['fh']; ?><?php endif; ?><?php echo $__tpl_vars['extra_query']; ?><?php else: ?><?php echo $__tpl_vars['reset_qstring']; ?><?php if ($__tpl_vars['fh']): ?>&amp;features_hash=<?php echo $__tpl_vars['fh']; ?><?php endif; ?><?php echo $__tpl_vars['extra_query']; ?><?php endif; ?>" title="<?php echo fn_get_lang_var('remove', $this->getLanguage()); ?>"><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/delete_icon.gif" width="12" height="11" border="0" alt="<?php echo fn_get_lang_var('remove', $this->getLanguage()); ?>" align="bottom" /></a><?php echo $__tpl_vars['filter']['prefix']; ?><?php echo fn_text_placeholders($__tpl_vars['range']['range_name']); ?><?php echo $__tpl_vars['filter']['suffix']; ?><?php if ($__tpl_vars['filter']['other_variants']): ?><ul id="other_variants_<?php echo $__tpl_vars['filter']['filter_id']; ?>" class="hidden"><?php $_from_1418118991 = & $__tpl_vars['filter']['other_variants']; if (!is_array($_from_1418118991) && !is_object($_from_1418118991)) { settype($_from_1418118991, 'array'); }if (count($_from_1418118991)):
    foreach ($_from_1418118991 as $__tpl_vars['r']):
?><li><a href="<?php if ($__tpl_vars['r']['feature_type'] == 'E' && ! $__tpl_vars['r']['simple_link']): ?><?php echo $__tpl_vars['index_script']; ?>?dispatch=product_features.view&amp;variant_id=<?php echo $__tpl_vars['r']['range_id']; ?><?php if ($__tpl_vars['fh']): ?>&amp;features_hash=<?php echo $__tpl_vars['fh']; ?><?php endif; ?><?php else: ?><?php echo $__tpl_vars['filter_qstring']; ?>&features_hash=<?php echo fn_add_range_to_url_hash($__tpl_vars['fh'], $__tpl_vars['r'], $__tpl_vars['filter']['field_type']); ?><?php endif; ?>"><?php echo $__tpl_vars['filter']['prefix']; ?><?php echo fn_text_placeholders($__tpl_vars['r']['range_name']); ?><?php echo $__tpl_vars['filter']['suffix']; ?></a>&nbsp;<span class="details">&nbsp;(<?php echo $__tpl_vars['r']['products']; ?>)</span></li><?php endforeach; endif; unset($_from); ?></ul><p><a id="sw_other_variants_<?php echo $__tpl_vars['filter']['filter_id']; ?>" class="extra-link cm-combination"><?php echo fn_get_lang_var('choose_other', $this->getLanguage()); ?></a></p><?php endif; ?><?php else: ?><a href="<?php if ($__tpl_vars['filter']['feature_type'] == 'E' && ! $__tpl_vars['filter']['simple_link']): ?><?php echo $__tpl_vars['index_script']; ?>?dispatch=product_features.view&amp;variant_id=<?php echo $__tpl_vars['range']['range_id']; ?><?php if ($__tpl_vars['_REQUEST']['features_hash']): ?>&amp;features_hash=<?php echo $__tpl_vars['_REQUEST']['features_hash']; ?><?php endif; ?><?php else: ?><?php echo $__tpl_vars['filter_qstring']; ?>&amp;features_hash=<?php echo fn_add_range_to_url_hash($__tpl_vars['_REQUEST']['features_hash'], $__tpl_vars['range'], $__tpl_vars['filter']['field_type']); ?><?php endif; ?>"><?php echo $__tpl_vars['filter']['prefix']; ?><?php echo fn_text_placeholders($__tpl_vars['range']['range_name']); ?><?php echo $__tpl_vars['filter']['suffix']; ?></a>&nbsp;<span class="details">&nbsp;(<?php echo $__tpl_vars['range']['products']; ?>)</span><?php endif; ?>

	</li>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_foreach['ranges']['iteration'] > @FILTERS_RANGES_COUNT): ?>
	<li class="right">
		<a href="<?php echo $__tpl_vars['filter_qstring']; ?>
&amp;filter_id=<?php echo $__tpl_vars['filter']['filter_id']; ?>
&amp;more_filters=Y" onclick="$('#content_product_more_filters_<?php echo $__tpl_vars['filter']['filter_id']; ?>
 li').show(); $('#view_all_<?php echo $__tpl_vars['filter']['filter_id']; ?>
').show(); $(this).hide(); return false;" class="extra-link"><?php echo fn_get_lang_var('more', $this->getLanguage()); ?>
</a>
	</li>
<?php endif; ?>

<?php if ($__tpl_vars['filter']['more_cut']): ?>
	<?php ob_start(); ?><?php echo smarty_modifier_unescape($__tpl_vars['filter_qstring']); ?>
&filter_id=<?php echo $__tpl_vars['filter']['filter_id']; ?>
&<?php if ($__tpl_vars['_REQUEST']['features_hash']): ?>&features_hash=<?php echo fn_delete_range_from_url($__tpl_vars['_REQUEST']['features_hash'], $__tpl_vars['range'], $__tpl_vars['filter']['field_type']); ?>
<?php endif; ?><?php $this->_smarty_vars['capture']['q'] = ob_get_contents(); ob_end_clean(); ?>
	<li id="view_all_<?php echo $__tpl_vars['filter']['filter_id']; ?>
" class="right hidden">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=product_features.view_all&amp;q=<?php echo smarty_modifier_escape($this->_smarty_vars['capture']['q'], 'url'); ?>
" class="extra-link"><?php echo fn_get_lang_var('view_all', $this->getLanguage()); ?>
</a>
	</li>
<?php endif; ?>

<li class="delim">&nbsp;</li>

</ul>

<?php endforeach; endif; unset($_from); ?>

<div class="clear filters-tools">
	<div class="float-right"><a href="<?php if (! defined('FILTER_CUSTOM_ADVANCED')): ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=products.search&amp;advanced_filter=Y<?php else: ?><?php echo $__tpl_vars['reset_qstring']; ?>
&amp;advanced_filter=Y<?php endif; ?>"><?php echo fn_get_lang_var('advanced', $this->getLanguage()); ?>
</a></div>
	<?php if ($__tpl_vars['has_selected']): ?>
	<a href="<?php if ($__tpl_vars['_REQUEST']['category_id']): ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=categories.view&amp;category_id=<?php echo $__tpl_vars['_REQUEST']['category_id']; ?>
<?php else: ?><?php echo $__tpl_vars['index_script']; ?>
<?php endif; ?>" class="reset-filters"><?php echo fn_get_lang_var('reset', $this->getLanguage()); ?>
</a>
	<?php endif; ?>
</div>
<?php endif; ?>
<!--/dynamic--><?php  ob_end_flush();  ?>