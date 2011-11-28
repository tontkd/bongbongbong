<?php /* Smarty version 2.6.18, created on 2011-11-28 13:18:55
         compiled from addons/tags/views/tags/components/tags.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/tags/views/tags/components/tags.tpl', 3, false),array('modifier', 'escape', 'addons/tags/views/tags/components/tags.tpl', 44, false),array('modifier', 'replace', 'addons/tags/views/tags/components/tags.tpl', 96, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('popular_tags','none','my_tags','remove_this_item','remove_this_item','remove_this_item','remove_this_item','add_empty_item','add_empty_item','save_tags','delete','delete','sign_in_to_enter_tags'));
?>
<?php  ob_start();  ?><div id="content_tags">
<?php echo smarty_function_script(array('src' => "lib/autocomplete/autocomplete.js"), $this);?>

<style type="text/css">
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
'; ?>

//]]>
</script>

    <form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_tags_form">
		<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
		<input type="hidden" name="tags_data[object_type]" value="<?php echo $__tpl_vars['object_type']; ?>
" />
		<input type="hidden" name="tags_data[object_id]" value="<?php echo $__tpl_vars['object_id']; ?>
" />
		<input type="hidden" name="selected_section" value="tags" />
		<div class="form-field">
			<label><?php echo fn_get_lang_var('popular_tags', $this->getLanguage()); ?>
:</label>
			<?php if ($__tpl_vars['object']['tags']['popular']): ?>
				<?php $_from_2807579898 = & $__tpl_vars['object']['tags']['popular']; if (!is_array($_from_2807579898) && !is_object($_from_2807579898)) { settype($_from_2807579898, 'array'); }$this->_foreach['tags'] = array('total' => count($_from_2807579898), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from_2807579898 as $__tpl_vars['tag']):
        $this->_foreach['tags']['iteration']++;
?>
					<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tags.view&amp;tag=<?php echo smarty_modifier_escape($__tpl_vars['tag']['tag'], 'url'); ?>
"><?php echo $__tpl_vars['tag']['tag']; ?>
</a> (<?php echo $__tpl_vars['tag']['popularity']; ?>
) <?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>,<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			<?php else: ?>
				<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>

			<?php endif; ?>
		</div>
		<!--dynamic:manage_user_tags-->
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
						<input type="hidden" name="tags_data[values][]" value="<?php echo $__tpl_vars['tag']['tag']; ?>
" />
						<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tags.view&amp;tag=<?php echo smarty_modifier_escape($__tpl_vars['tag']['tag'], 'url'); ?>
"><?php echo $__tpl_vars['tag']['tag']; ?>
</a>
						&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/delete_icon.gif" width="12" height="11" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="return removeTag(this.parentNode);" class="hand" align="top" /><?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>, <?php endif; ?>
					</span>
				<?php endforeach; endif; unset($_from); ?>
			
				<div id="tags_container">
					<p id="tag_input" class="cm-first-sibling">
						<input type="text" name="tags_data[values][]" class="input-text" />
						<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/remove_item.gif" width="14" height="15" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="return removeTag(this.parentNode);" class="valign hand" />
					</p>
				</div>

				<div class="tags-buttons">
					<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/add_empty_item.gif" width="14" height="15" border="0" name="add" alt="<?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?>
" onclick="return addTag();" class="valign hand" />
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('save_tags', $this->getLanguage()), 'but_name' => "dispatch[tags.update]", )); ?>

<?php if ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name'] && $__tpl_vars['but_role'] != 'text' && $__tpl_vars['but_role'] != 'act' && $__tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($__tpl_vars['but_id']): ?>id="wrap_<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $__tpl_vars['suffix']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $__tpl_vars['but_name']; ?>
" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" /></span>

<?php elseif ($__tpl_vars['but_role'] == 'text' || $__tpl_vars['but_role'] == 'act' || $__tpl_vars['but_role'] == 'edit' || ( $__tpl_vars['but_role'] == 'text' && $__tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> cm-submit-link<?php endif; ?> text-button<?php echo $__tpl_vars['suffix']; ?>
"<?php if ($__tpl_vars['but_id']): ?> id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a>

<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_meta']): ?> class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete_small.gif" width="10" height="9" border="0" alt="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" /></a>

<?php else: ?> 

	<span class="button<?php echo $__tpl_vars['suffix']; ?>
" <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?>><a <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($__tpl_vars['but_rev']): ?>rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				</div>

			<?php else: ?>
				<a class="text-button" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.login_form&amp;return_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
"><?php echo fn_get_lang_var('sign_in_to_enter_tags', $this->getLanguage()); ?>
</a>
			<?php endif; ?>
		</div>
		<!--/dynamic-->
	</form>
</div>
<?php  ob_end_flush();  ?>