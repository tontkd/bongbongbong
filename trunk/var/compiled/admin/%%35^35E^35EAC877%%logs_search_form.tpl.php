<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:48
         compiled from views/logs/components/logs_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/logs/components/logs_search_form.tpl', 43, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('user','type','action','all','all','close'));
?>

<?php ob_start(); ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="logs_form" method="get">
<input type="hidden" name="object" value="<?php echo $__tpl_vars['_REQUEST']['object']; ?>
">

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $__tpl_vars['search']['period'],'extra' => "",'display' => 'form','but_name' => "dispatch[logs.manage]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('user', $this->getLanguage()); ?>
:</label>
	<input type="text" name="q_user" size="30" value="<?php echo $__tpl_vars['search']['q_user']; ?>
" class="input-text" />
</div>

<div class="search-field">
	<label><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
/<?php echo fn_get_lang_var('action', $this->getLanguage()); ?>
:</label>
	<select id="q_type" name="q_type" onchange="fn_logs_build_options();">
		<option value=""<?php if (! $__tpl_vars['search']['q_type']): ?> selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
</option>
		<?php $_from_2639383230 = & $__tpl_vars['log_types']; if (!is_array($_from_2639383230) && !is_object($_from_2639383230)) { settype($_from_2639383230, 'array'); }if (count($_from_2639383230)):
    foreach ($_from_2639383230 as $__tpl_vars['o']):
?>
			<option value="<?php echo $__tpl_vars['o']['type']; ?>
"<?php if ($__tpl_vars['search']['q_type'] == $__tpl_vars['o']['type']): ?> selected="selected"<?php endif; ?>><?php echo $__tpl_vars['o']['description']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
	&nbsp;&nbsp;
	<select id="q_action" class="hidden" name="q_action">
	</select>
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => "logs.manage",'view_type' => 'logs')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
//<![CDATA[
var types = new Array();
<?php $_from_2639383230 = & $__tpl_vars['log_types']; if (!is_array($_from_2639383230) && !is_object($_from_2639383230)) { settype($_from_2639383230, 'array'); }if (count($_from_2639383230)):
    foreach ($_from_2639383230 as $__tpl_vars['o']):
?>
types['<?php echo $__tpl_vars['o']['type']; ?>
'] = new Array();
<?php $_from_261017158 = & $__tpl_vars['o']['actions']; if (!is_array($_from_261017158) && !is_object($_from_261017158)) { settype($_from_261017158, 'array'); }if (count($_from_261017158)):
    foreach ($_from_261017158 as $__tpl_vars['v']):
?>
types['<?php echo $__tpl_vars['o']['type']; ?>
']['<?php echo $__tpl_vars['v']['action']; ?>
'] = '<?php echo $__tpl_vars['v']['description']; ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>

lang.all = '<?php echo smarty_modifier_escape(fn_get_lang_var('all', $this->getLanguage()), 'javascript'); ?>
';

<?php echo '
function fn_logs_build_options(current_action)
{
	var elm_t = $(\'#q_type\');
	var elm_a = $(\'#q_action\');

	elm_a.html(\'<option value="">\' + lang.all + \'</option>\');

	for (var action in types[elm_t.val()]) {
		elm_a.append(\'<option value="\' + action + \'"\' + (current_action && current_action == action ? \' selected="selected"\' : \'\') + \'>\' + types[elm_t.val()][action] + \'</option>\');
	}

	$(\'#q_action\').toggleBy(($(\'option\', elm_a).length == 1));
}
'; ?>


fn_logs_build_options('<?php echo $__tpl_vars['search']['q_action']; ?>
');

//]]>
</script>

</form>
<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?>

<div class="clear">
	<div class="section-border">
		<?php echo $__tpl_vars['section_content']; ?>

		<?php if ($__tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $_SERVER['QUERY_STRING']; ?>
&amp;close_section=<?php echo $__tpl_vars['key']; ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>