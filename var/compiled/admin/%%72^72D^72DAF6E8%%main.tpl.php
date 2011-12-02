<?php /* Smarty version 2.6.18, created on 2011-12-01 21:45:14
         compiled from main.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'notes', 'main.tpl', 10, false),array('block', 'hook', 'main.tpl', 15, false),array('modifier', 'is_array', 'main.tpl', 24, false),array('modifier', 'reset', 'main.tpl', 25, false),array('modifier', 'fn_revisions_is_active', 'main.tpl', 29, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('note','you_are_editing_revision','active','if_press_save','note'));
?>

<?php if ($__tpl_vars['auth']['user_id']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/quick_menu.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php ob_start(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $__tpl_vars['content_tpl'], 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['content'] = ob_get_contents(); ob_end_clean(); ?>
<?php $this->_tag_stack[] = array('notes', array('assign' => 'notes')); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td class="<?php if (! $__tpl_vars['auth']['user_id']): ?>login-page<?php else: ?>content<?php endif; ?>">
		<?php $this->_tag_stack[] = array('hook', array('name' => "index:main_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<div id="main_column<?php if (! $__tpl_vars['auth']['user_id']): ?>_login<?php endif; ?>" class="clear">
			<?php echo $this->_smarty_vars['capture']['content']; ?>

		</div>
	</td>
<?php if (( $__tpl_vars['navigation'] && $__tpl_vars['navigation']['dynamic']['sections'] ) || $__tpl_vars['notes']): ?>
	<td>
	<div id="right_column">
		<?php if ($__tpl_vars['_REQUEST']['rev'] && is_array($__tpl_vars['_REQUEST']['rev'])): ?>
			<?php $this->assign('rev_id', reset($__tpl_vars['_REQUEST']['rev_id']), false); ?>
			<?php $this->assign('rev', reset($__tpl_vars['_REQUEST']['rev']), false); ?>
			<div class="notes">
				<h5><?php echo fn_get_lang_var('note', $this->getLanguage()); ?>
:</h5>
				<?php echo fn_get_lang_var('you_are_editing_revision', $this->getLanguage()); ?>
 <strong>#<?php echo $__tpl_vars['rev']; ?>
</strong> <?php if ($__tpl_vars['rev_id'] && smarty_modifier_fn_revisions_is_active($__tpl_vars['rev_id'], $__tpl_vars['rev'])): ?>(<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
) <?php endif; ?><?php echo fn_get_lang_var('if_press_save', $this->getLanguage()); ?>

			</div>
		<?php endif; ?>

		<?php if ($__tpl_vars['navigation']['dynamic']['sections']): ?>
			<div id="navigation" class="cm-j-tabs">
				<ul>
					<?php $_from_2202534291 = & $__tpl_vars['navigation']['dynamic']['sections']; if (!is_array($_from_2202534291) && !is_object($_from_2202534291)) { settype($_from_2202534291, 'array'); }$this->_foreach['first_level'] = array('total' => count($_from_2202534291), 'iteration' => 0);
if ($this->_foreach['first_level']['total'] > 0):
    foreach ($_from_2202534291 as $__tpl_vars['s_id'] => $__tpl_vars['m']):
        $this->_foreach['first_level']['iteration']++;
?>
						<li class="<?php if ($__tpl_vars['m']['js'] == true): ?>cm-js<?php endif; ?><?php if (($this->_foreach['first_level']['iteration'] == $this->_foreach['first_level']['total'])): ?> cm-last-item<?php endif; ?><?php if ($__tpl_vars['navigation']['dynamic']['active_section'] == $__tpl_vars['s_id']): ?> cm-active<?php endif; ?>"><span><a href="<?php echo $__tpl_vars['m']['href']; ?>
"><?php echo $__tpl_vars['m']['title']; ?>
</a></span></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php if ($__tpl_vars['notes']): ?>
			<?php $_from_814039221 = & $__tpl_vars['notes']; if (!is_array($_from_814039221) && !is_object($_from_814039221)) { settype($_from_814039221, 'array'); }if (count($_from_814039221)):
    foreach ($_from_814039221 as $__tpl_vars['title'] => $__tpl_vars['note']):
?>
			<div class="notes">
				<h5><?php if ($__tpl_vars['title'] == '_note_'): ?><?php echo fn_get_lang_var('note', $this->getLanguage()); ?>
<?php else: ?><?php echo $__tpl_vars['title']; ?>
<?php endif; ?>:</h5>
				<?php echo $__tpl_vars['note']; ?>

			</div>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</div>
	</td>
<?php endif; ?>
</tr>
</table>

