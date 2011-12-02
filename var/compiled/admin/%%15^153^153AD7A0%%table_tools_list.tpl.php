<?php /* Smarty version 2.6.18, created on 2011-12-01 21:45:15
         compiled from common_templates/table_tools_list.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/table_tools_list.tpl', 6, false),array('modifier', 'strpos', 'common_templates/table_tools_list.tpl', 8, false),array('modifier', 'substr_count', 'common_templates/table_tools_list.tpl', 14, false),array('modifier', 'replace', 'common_templates/table_tools_list.tpl', 15, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('edit','more','or','tools','add'));
?>

<?php if ($__tpl_vars['popup']): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => $__tpl_vars['id'],'text' => $__tpl_vars['text'],'link_text' => $__tpl_vars['link_text'],'act' => $__tpl_vars['act'],'href' => $__tpl_vars['href'],'link_class' => $__tpl_vars['link_class'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($__tpl_vars['href']): ?>
	<a class="tool-link" href="<?php echo $__tpl_vars['href']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('edit', $this->getLanguage())); ?>
</a>
<?php endif; ?>
<?php if (strpos($__tpl_vars['tools_list'], "<li")): ?><?php if ($__tpl_vars['href']): ?>&nbsp;&nbsp;|<?php elseif ($__tpl_vars['separate']): ?>|<?php endif; ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => $__tpl_vars['prefix'], 'hide_actions' => true, 'tools_list' => "<ul>".($__tpl_vars['tools_list'])."</ul>", 'display' => 'inline', 'link_text' => fn_get_lang_var('more', $this->getLanguage()), 'link_meta' => 'lowercase', )); ?>


<?php if ($__tpl_vars['tools_list'] && $__tpl_vars['prefix'] == 'main' && ! $__tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($__tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($__tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $__tpl_vars['hide_tools'] && $__tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($__tpl_vars['display']): ?> <?php echo $__tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($__tpl_vars['override_meta']): ?><?php echo $__tpl_vars['override_meta']; ?>
<?php else: ?>select-link<?php endif; ?><?php if ($__tpl_vars['link_meta']): ?> <?php echo $__tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $__tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $__tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box">
				<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
					<?php echo $__tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $__tpl_vars['hide_actions']): ?>
		<span class="action-add">
			<a<?php if ($__tpl_vars['tool_id']): ?> id="<?php echo $__tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_href']): ?> href="<?php echo $__tpl_vars['tool_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['tool_onclick']): ?> onclick="<?php echo $__tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$__tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
		</span>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>