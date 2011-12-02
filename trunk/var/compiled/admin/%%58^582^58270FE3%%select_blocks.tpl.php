<?php /* Smarty version 2.6.18, created on 2011-12-01 22:30:10
         compiled from views/block_manager/components/select_blocks.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_lang_var', 'views/block_manager/components/select_blocks.tpl', 43, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('listed_items','general','block_name','filling','static_block','enable_for_this_page','disabled','no_blocks_defined','manage_custom_blocks'));
?>

<?php if ($__tpl_vars['blocks']): ?>
	<div class="clear">
		<div id="content_block_manager_blocks" class="listmania-lists">
			<?php $_from_3611123917 = & $__tpl_vars['blocks']; if (!is_array($_from_3611123917) && !is_object($_from_3611123917)) { settype($_from_3611123917, 'array'); }$this->_foreach['block_list'] = array('total' => count($_from_3611123917), 'iteration' => 0);
if ($this->_foreach['block_list']['total'] > 0):
    foreach ($_from_3611123917 as $__tpl_vars['block']):
        $this->_foreach['block_list']['iteration']++;
?>
				&nbsp;<span class="bull">&bull;</span>&nbsp;<?php if ($__tpl_vars['selected_block']['block_id'] == $__tpl_vars['block']['block_id']): ?><span class="strong"><?php else: ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo @CONTROLLER; ?>
<?php if (@MODE): ?>.<?php echo @MODE; ?>
<?php endif; ?><?php if ($__tpl_vars['location']): ?>&amp;page_section=<?php echo $__tpl_vars['location']; ?>
<?php endif; ?><?php if ($__tpl_vars['selected_block']['object_id'] && $__tpl_vars['object_id']): ?>&amp;<?php echo $__tpl_vars['selected_block']['object_id']; ?>
=<?php echo $__tpl_vars['object_id']; ?>
<?php endif; ?>&amp;selected_section=<?php if ($__tpl_vars['location']): ?><?php echo $__tpl_vars['location']; ?>
_<?php endif; ?>blocks&amp;selected_block_id=<?php echo $__tpl_vars['block']['block_id']; ?>
"><?php endif; ?><?php echo $__tpl_vars['block']['block']; ?>
<?php if ($__tpl_vars['selected_block']['block_id'] == $__tpl_vars['block']['block_id']): ?></span><?php else: ?></a><?php endif; ?><?php if ($__tpl_vars['lm_list']['use'] == 'Y'): ?>&nbsp;(+)<?php else: ?><?php endif; ?>&nbsp;&nbsp;&nbsp;&nbsp;
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>

<?php if ($__tpl_vars['selected_block']['properties']['fillings'] == 'manually'): ?>
	<?php $this->assign('_view_mode', 'mixed', false); ?>
	<?php $this->assign('_hide_delete_button', false, false); ?>
<?php else: ?>
	<?php $this->assign('_view_mode', 'list', false); ?>
	<?php $this->assign('_hide_delete_button', true, false); ?>
<?php endif; ?>
	<div class="clear">
		<?php if ($__tpl_vars['selected_block']['properties']['fillings'] && $__tpl_vars['block_properties'][$__tpl_vars['selected_block']['properties']['list_object']]['picker_props']['picker']): ?>
		<div class="listed-items">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('listed_items', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<input type="hidden" name="<?php echo $__tpl_vars['data_name']; ?>
[block_id]" value="<?php echo $__tpl_vars['selected_block']['block_id']; ?>
" />
			<?php if ($__tpl_vars['selected_block']['properties']['fillings'] == 'manually'): ?>
				<?php $this->assign('show_position', true, false); ?>
			<?php else: ?>
				<?php $this->assign('show_position', false, false); ?>
			<?php endif; ?>

			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $__tpl_vars['block_properties'][$__tpl_vars['selected_block']['properties']['list_object']]['picker_props']['picker'], 'smarty_include_vars' => array('data_id' => "added_".($__tpl_vars['selected_block']['block_id']),'input_name' => ($__tpl_vars['data_name'])."[add_items]",'item_ids' => $__tpl_vars['selected_block']['item_ids'],'positions' => $__tpl_vars['show_position'],'view_mode' => $__tpl_vars['_view_mode'],'hide_delete_button' => $__tpl_vars['_hide_delete_button'],'params_array' => $__tpl_vars['block_properties'][$__tpl_vars['selected_block']['properties']['list_object']]['picker_props']['params'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php endif; ?>

		<div class="general-items">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('general', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<div class="form-field">
				<label><?php echo fn_get_lang_var('block_name', $this->getLanguage()); ?>
:</label>
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=block_manager.manage"><?php echo $__tpl_vars['selected_block']['block']; ?>
</a>
			</div>

			<div class="form-field">
				<label><?php echo fn_get_lang_var('filling', $this->getLanguage()); ?>
:</label>
				<?php if ($__tpl_vars['selected_block']['properties']['fillings']): ?><?php echo fn_get_lang_var($__tpl_vars['selected_block']['properties']['fillings']); ?>
<?php else: ?><?php echo fn_get_lang_var('static_block', $this->getLanguage()); ?>
<?php endif; ?>
			</div>

			<div class="form-field">
				<label for="enable_block_<?php echo $__tpl_vars['selected_block']['block_id']; ?>
"><?php echo fn_get_lang_var('enable_for_this_page', $this->getLanguage()); ?>
:</label>
				<input id="enable_block_<?php echo $__tpl_vars['selected_block']['block_id']; ?>
" type="checkbox" name="enable_block_<?php echo $__tpl_vars['selected_block']['block_id']; ?>
" value="Y" <?php if ($__tpl_vars['selected_block']['assigned'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="jQuery.ajaxRequest('<?php echo $__tpl_vars['index_script']; ?>
?dispatch=block_manager.enable_disable<?php if ($__tpl_vars['object_id']): ?>&amp;location=<?php echo @CONTROLLER; ?>
&amp;object_id=<?php echo $__tpl_vars['object_id']; ?>
<?php elseif ($__tpl_vars['location']): ?>&amp;location=<?php echo $__tpl_vars['location']; ?>
<?php endif; ?>&amp;block_id=<?php echo $__tpl_vars['selected_block']['block_id']; ?>
&amp;enable=' + (this.checked ? this.value : 'N'), <?php echo '{method: \'POST\', cache: false}'; ?>
);" />
			</div>
			<?php if ($__tpl_vars['selected_block']['disabled']): ?>
				<div class="form-field">
					<label><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:</label>
					<?php echo $__tpl_vars['selected_block']['disabled']; ?>

				</div>
			<?php endif; ?>
		</div>
	</div>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_blocks_defined', $this->getLanguage()); ?>
 <a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=block_manager.manage&amp;selected_section=<?php echo $__tpl_vars['section']; ?>
"><?php echo fn_get_lang_var('manage_custom_blocks', $this->getLanguage()); ?>
 &raquo;</a></p>
<?php endif; ?>