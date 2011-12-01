<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from common_templates/search.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'common_templates/search.tpl', 11, false),array('modifier', 'fn_get_subcategories', 'common_templates/search.tpl', 18, false),array('modifier', 'escape', 'common_templates/search.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search','all_categories','search','search','advanced_search'));
?>
<?php  ob_start();  ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="search_form" method="get">
<input type="hidden" name="subcats" value="Y" />
<input type="hidden" name="type" value="extended" />
<input type="hidden" name="status" value="A" />
<input type="hidden" name="pshort" value="Y" />
<input type="hidden" name="pfull" value="Y" />
<input type="hidden" name="pname" value="Y" />
<input type="hidden" name="pkeywords" value="Y" />
<?php $this->_tag_stack[] = array('hook', array('name' => "search:additional_fields")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 

<span class="search-products-text"><?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
:</span>

<?php if (! $__tpl_vars['settings']['General']['search_objects']): ?>
<select	name="cid" class="search-selectbox">
	<option	value="0">- <?php echo fn_get_lang_var('all_categories', $this->getLanguage()); ?>
 -</option>
	<?php $_from_103763107 = & fn_get_subcategories(0); if (!is_array($_from_103763107) && !is_object($_from_103763107)) { settype($_from_103763107, 'array'); }if (count($_from_103763107)):
    foreach ($_from_103763107 as $__tpl_vars['cat']):
?>
	<option	value="<?php echo $__tpl_vars['cat']['category_id']; ?>
" <?php if ($__tpl_vars['mode'] == 'search' && $__tpl_vars['_REQUEST']['cid'] == $__tpl_vars['cat']['category_id']): ?>selected="selected"<?php elseif ($__tpl_vars['_REQUEST']['category_id'] == $__tpl_vars['cat']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_escape($__tpl_vars['cat']['category'], 'html'); ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
</select>
<?php endif; ?>

<input type="text" name="q" value="<?php echo $__tpl_vars['search']['q']; ?>" onfocus="this.select();" class="search-input" /><?php if ($__tpl_vars['settings']['General']['search_objects']): ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "search.results", 'alt' => fn_get_lang_var('search', $this->getLanguage()), )); ?><input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>/icons/go.gif" alt="<?php echo $__tpl_vars['alt']; ?>" title="<?php echo $__tpl_vars['alt']; ?>" class="go-button" /><input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "products.search", 'alt' => fn_get_lang_var('search', $this->getLanguage()), )); ?><input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>/icons/go.gif" alt="<?php echo $__tpl_vars['alt']; ?>" title="<?php echo $__tpl_vars['alt']; ?>" class="go-button" /><input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if (! $__tpl_vars['hide_advanced_search']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>?dispatch=products.search" class="search-advanced"><?php echo fn_get_lang_var('advanced_search', $this->getLanguage()); ?></a><?php endif; ?>


</form>
<?php  ob_end_flush();  ?>