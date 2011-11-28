<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:48
         compiled from views/logs/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'views/logs/manage.tpl', 20, false),array('modifier', 'lower', 'views/logs/manage.tpl', 22, false),array('modifier', 'date_format', 'views/logs/manage.tpl', 24, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('time','user','type','content','backtrace','no_data','logs'));
?>

<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/logs/components/logs_search_form.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>&nbsp;</th>
	<th><?php echo fn_get_lang_var('time', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('user', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('content', $this->getLanguage()); ?>
</th>
</tr>
<?php $_from_1176349278 = & $__tpl_vars['logs']; if (!is_array($_from_1176349278) && !is_object($_from_1176349278)) { settype($_from_1176349278, 'array'); }if (count($_from_1176349278)):
    foreach ($_from_1176349278 as $__tpl_vars['log']):
?>
<?php $this->assign('_type', "log_type_".($__tpl_vars['log']['type']), false); ?>
<?php $this->assign('_action', "log_action_".($__tpl_vars['log']['action']), false); ?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
 valign="top">
	<td>
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/notification_icon_<?php echo smarty_modifier_lower($__tpl_vars['log']['event_type']); ?>
.gif" width="19" height="19" alt="" /></td>
	<td class="nowrap">
		<?php echo smarty_modifier_date_format($__tpl_vars['log']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
</td>
	<td class="nowrap">
		<?php if ($__tpl_vars['log']['user_id']): ?><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['log']['user_id']; ?>
"><?php echo $__tpl_vars['log']['firstname']; ?>
<?php if ($__tpl_vars['log']['firstname'] || $__tpl_vars['log']['lastname']): ?>&nbsp;<?php endif; ?><?php echo $__tpl_vars['log']['lastname']; ?>
</a><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
	<td class="nowrap">
		<?php echo fn_get_lang_var($__tpl_vars['_type'], $this->getLanguage()); ?>
<?php if ($__tpl_vars['log']['action']): ?>&nbsp;(<?php echo fn_get_lang_var($__tpl_vars['_action'], $this->getLanguage()); ?>
)<?php endif; ?></td>
	<td width="100%">
		<?php $_from_2249262186 = & $__tpl_vars['log']['content']; if (!is_array($_from_2249262186) && !is_object($_from_2249262186)) { settype($_from_2249262186, 'array'); }if (count($_from_2249262186)):
    foreach ($_from_2249262186 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
		<?php echo fn_get_lang_var($__tpl_vars['k'], $this->getLanguage()); ?>
:&nbsp;<?php echo $__tpl_vars['v']; ?>
<br />
		<?php endforeach; else: ?>
		&nbsp;-&nbsp;
		<?php endif; unset($_from); ?>

		<?php if ($__tpl_vars['log']['backtrace']): ?>
		<p><a onclick="$('#backtrace_<?php echo $__tpl_vars['log']['log_id']; ?>
').toggle(); return false;" class="underlined"><strong><?php echo fn_get_lang_var('backtrace', $this->getLanguage()); ?>
&#155;&#155;</strong></a></p>
		<div id="backtrace_<?php echo $__tpl_vars['log']['log_id']; ?>
" class="notice-box hidden">
		<?php $_from_3197718911 = & $__tpl_vars['log']['backtrace']; if (!is_array($_from_3197718911) && !is_object($_from_3197718911)) { settype($_from_3197718911, 'array'); }if (count($_from_3197718911)):
    foreach ($_from_3197718911 as $__tpl_vars['v']):
?>
		<?php echo $__tpl_vars['v']['file']; ?>
<?php if ($__tpl_vars['v']['function']): ?>&nbsp;(<?php echo $__tpl_vars['v']['function']; ?>
)<?php endif; ?>:&nbsp;<?php echo $__tpl_vars['v']['line']; ?>
<br />
		<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="5"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('logs', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>