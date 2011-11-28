<?php /* Smarty version 2.6.18, created on 2011-11-28 12:29:28
         compiled from addons/tags/hooks/products/tabs_content.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/tags/hooks/products/tabs_content.post.tpl', 6, false),array('modifier', 'escape', 'addons/tags/hooks/products/tabs_content.post.tpl', 58, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('popular_tags','none','my_tags','remove_this_item','remove_this_item','remove_this_item','remove_this_item','add_empty_item','add_empty_item','sign_in_to_enter_tags'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['addons']['tags']['tags_for_products'] == 'Y'): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('object' => $__tpl_vars['product_data'], 'input_name' => 'product_data', )); ?>
<div id="content_tags">
<?php echo smarty_function_script(array('src' => "lib/autocomplete/autocomplete.js"), $this);?>


<style>
	@import url("<?php echo $__tpl_vars['config']['current_path']; ?>
/lib/autocomplete/autocomplete.css");
</style>
<script type="text/javascript">
//<![CDATA[
<?php echo '
$(document).ready(function(){
	$(\'#tag_input input\').autocomplete(index_script, { extraParams: { dispatch: \'tags.list\' } });
});

function removeTag(tag) {
	if (!$(tag).is(\'.cm-first-sibling\')) {
		tag.parentNode.removeChild(tag);
	}

	// prevent default
	return false;
}

function addTag() {
	var t = $(\'#tag_input\').clone().appendTo(\'#tags_container\').removeClass(\'cm-first-sibling\');
	t.find(\'input\').val(\'\');
	t.find(\'input\').autocomplete(index_script, { extraParams: { dispatch: \'tags.list\' } }).get(0).focus();

	//prevent default
	return false;
}
//]]>
'; ?>

</script>

<fieldset>
	<div class="form-field">
		<label><?php echo fn_get_lang_var('popular_tags', $this->getLanguage()); ?>
:</label>
		<?php if ($__tpl_vars['object']['tags']['popular']): ?>
			<?php $_from_2807579898 = & $__tpl_vars['object']['tags']['popular']; if (!is_array($_from_2807579898) && !is_object($_from_2807579898)) { settype($_from_2807579898, 'array'); }$this->_foreach['tags'] = array('total' => count($_from_2807579898), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from_2807579898 as $__tpl_vars['tag']):
        $this->_foreach['tags']['iteration']++;
?>
				<?php echo $__tpl_vars['tag']['tag']; ?>
(<?php echo $__tpl_vars['tag']['popularity']; ?>
) <?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>,<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>

		<?php endif; ?>
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('my_tags', $this->getLanguage()); ?>
:</label>
		<?php if ($__tpl_vars['auth']['user_id']): ?>
			<?php $_from_1741686460 = & $__tpl_vars['object']['tags']['user']; if (!is_array($_from_1741686460) && !is_object($_from_1741686460)) { settype($_from_1741686460, 'array'); }$this->_foreach['tags'] = array('total' => count($_from_1741686460), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from_1741686460 as $__tpl_vars['tag']):
        $this->_foreach['tags']['iteration']++;
?>
				<span>
					<input type="hidden" name="<?php echo $__tpl_vars['input_name']; ?>
[tags][]" value="<?php echo $__tpl_vars['tag']['tag']; ?>
" />
					<?php echo $__tpl_vars['tag']['tag']; ?>

					<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('remove_this_item', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('remove_this_item', $this->getLanguage()), 'html'); ?>
" onclick="return removeTag(this.parentNode);" class="hand" align="top" style="padding-top:3px;" /> ,
				</span>
			<?php endforeach; endif; unset($_from); ?>
			<span id="tags_container">
				<span id="tag_input" class="cm-first-sibling">
					<input type="text" name="<?php echo $__tpl_vars['input_name']; ?>
[tags][]">
					<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" border="0" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('remove_this_item', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('remove_this_item', $this->getLanguage()), 'html'); ?>
" onclick="return removeTag(this.parentNode);" class="hand" align="top" style="padding-top:3px;" />
				</span>
			</span>

			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_add.gif" border="0" name="add" id="<?php echo $__tpl_vars['item_id']; ?>
" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('add_empty_item', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('add_empty_item', $this->getLanguage()), 'html'); ?>
" onclick="return addTag();" class="hand" align="top" style="padding-top:3px" />

		<?php else: ?>
			<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.login_form&amp;return_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
"><?php echo fn_get_lang_var('sign_in_to_enter_tags', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
	</div>
</fieldset>

</div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?><?php  ob_end_flush();  ?>