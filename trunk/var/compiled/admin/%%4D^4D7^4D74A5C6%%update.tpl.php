<?php /* Smarty version 2.6.18, created on 2011-11-28 12:21:01
         compiled from views/statuses/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'views/statuses/update.tpl', 3, false),array('modifier', 'default', 'views/statuses/update.tpl', 7, false),array('modifier', 'range', 'views/statuses/update.tpl', 28, false),array('modifier', 'fn_get_statuses', 'views/statuses/update.tpl', 75, false),array('function', 'html_options', 'views/statuses/update.tpl', 82, false),array('function', 'html_checkboxes', 'views/statuses/update.tpl', 85, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','status','email_subject','email_header'));
?>

<?php $this->assign('st', smarty_modifier_lower($__tpl_vars['_REQUEST']['status']), false); ?>

<div id="content_group<?php echo $__tpl_vars['st']; ?>
">
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="update_status_<?php echo $__tpl_vars['st']; ?>
_form" class="cm-form-highlight">
<input type="hidden" name="type" value="<?php echo smarty_modifier_default(@$__tpl_vars['type'], 'O'); ?>
" />
<input type="hidden" name="status" value="<?php echo $__tpl_vars['_REQUEST']['status']; ?>
" />

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>
	
	<div class="cm-tabs-content">
	<fieldset>
		<div class="form-field">
			<label for="description_<?php echo $__tpl_vars['st']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" size="70" id="description_<?php echo $__tpl_vars['st']; ?>
" name="status_data[description]" value="<?php echo $__tpl_vars['status_data']['description']; ?>
" class="input-text-large main-input" />
		</div>
	
		<div class="form-field">
			<label for="status_<?php echo $__tpl_vars['st']; ?>
" class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
			<?php if ($__tpl_vars['mode'] == 'add'): ?>
				<select id="status_<?php echo $__tpl_vars['st']; ?>
" name="status_data[status]">
				<?php $_from_3248945688 = & range('A', 'Z'); if (!is_array($_from_3248945688) && !is_object($_from_3248945688)) { settype($_from_3248945688, 'array'); }if (count($_from_3248945688)):
    foreach ($_from_3248945688 as $__tpl_vars['_st']):
?>
					<?php if (! $__tpl_vars['statuses'][$__tpl_vars['_st']]): ?>
						<option value="<?php echo $__tpl_vars['_st']; ?>
"><?php echo $__tpl_vars['_st']; ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php else: ?>
				<input type="hidden" name="status_data[status]" value="<?php echo $__tpl_vars['status_data']['status']; ?>
" />
				<strong><?php echo $__tpl_vars['status_data']['status']; ?>
</strong>
			<?php endif; ?>
		</div>
	
		<div class="form-field">
			<label for="email_subj_<?php echo $__tpl_vars['st']; ?>
"><?php echo fn_get_lang_var('email_subject', $this->getLanguage()); ?>
:</label>
			<input type="text" size="40" name="status_data[email_subj]" id="email_subj_<?php echo $__tpl_vars['st']; ?>
" value="<?php echo $__tpl_vars['status_data']['email_subj']; ?>
" class="input-text-large" />
		</div>
	
		<div class="form-field">
			<label for="email_header_<?php echo $__tpl_vars['st']; ?>
"><?php echo fn_get_lang_var('email_header', $this->getLanguage()); ?>
:</label>
			<textarea id="email_header_<?php echo $__tpl_vars['st']; ?>
" name="status_data[email_header]" class="input-textarea-long"><?php echo $__tpl_vars['status_data']['email_header']; ?>
</textarea>
			<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => "email_header_".($__tpl_vars['st']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
		</div>
	
		<?php $_from_3126957916 = & $__tpl_vars['status_params']; if (!is_array($_from_3126957916) && !is_object($_from_3126957916)) { settype($_from_3126957916, 'array'); }if (count($_from_3126957916)):
    foreach ($_from_3126957916 as $__tpl_vars['name'] => $__tpl_vars['data']):
?>
			<div class="form-field">
				<label for="status_param_<?php echo $__tpl_vars['st']; ?>
_<?php echo $__tpl_vars['name']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['data']['label'], $this->getLanguage()); ?>
:</label>
				<?php if ($__tpl_vars['data']['not_default'] == true && $__tpl_vars['status_data']['is_default'] === 'Y'): ?>
					<?php $this->assign('var', $__tpl_vars['status_data']['params'][$__tpl_vars['name']], false); ?>
					<?php $this->assign('lbl', $__tpl_vars['data']['variants'][$__tpl_vars['var']], false); ?>
					<strong><?php echo fn_get_lang_var($__tpl_vars['lbl'], $this->getLanguage()); ?>
</strong>
				
				<?php elseif ($__tpl_vars['data']['type'] == 'select'): ?>
					<select id="status_param_<?php echo $__tpl_vars['st']; ?>
_<?php echo $__tpl_vars['name']; ?>
" name="status_data[params][<?php echo $__tpl_vars['name']; ?>
]">
						<?php $_from_2381242308 = & $__tpl_vars['data']['variants']; if (!is_array($_from_2381242308) && !is_object($_from_2381242308)) { settype($_from_2381242308, 'array'); }if (count($_from_2381242308)):
    foreach ($_from_2381242308 as $__tpl_vars['v_name'] => $__tpl_vars['v_data']):
?>
						<option value="<?php echo $__tpl_vars['v_name']; ?>
" <?php if ($__tpl_vars['status_data']['params'][$__tpl_vars['name']] == $__tpl_vars['v_name']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($__tpl_vars['v_data'], $this->getLanguage()); ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				
				<?php elseif ($__tpl_vars['data']['type'] == 'checkbox'): ?>
					<input type="hidden" name="status_data[params][<?php echo $__tpl_vars['name']; ?>
]" value="N" />
					<input type="checkbox" name="status_data[params][<?php echo $__tpl_vars['name']; ?>
]" id="status_param_<?php echo $__tpl_vars['st']; ?>
_<?php echo $__tpl_vars['name']; ?>
" value="Y" <?php if ($__tpl_vars['status_data']['params'][$__tpl_vars['name']] == 'Y'): ?> checked="checked"<?php endif; ?> class="checkbox" />

				<?php elseif ($__tpl_vars['data']['type'] == 'status'): ?>
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('status' => $__tpl_vars['status_data']['params'][$__tpl_vars['name']], 'display' => 'select', 'name' => "status_data[params][".($__tpl_vars['name'])."]", 'status_type' => $__tpl_vars['data']['status_type'], 'select_id' => "status_param_".($__tpl_vars['st'])."_".($__tpl_vars['name']), )); ?>

<?php if (! $__tpl_vars['order_status_descr']): ?>
	<?php if (! $__tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($__tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['display'] == 'view'): ?><?php echo $__tpl_vars['order_status_descr'][$__tpl_vars['status']]; ?><?php elseif ($__tpl_vars['display'] == 'select'): ?><?php echo smarty_function_html_options(array('name' => $__tpl_vars['name'],'options' => $__tpl_vars['order_status_descr'],'selected' => $__tpl_vars['status'],'id' => $__tpl_vars['select_id']), $this);?><?php elseif ($__tpl_vars['display'] == 'checkboxes'): ?><div><?php echo smarty_function_html_checkboxes(array('name' => $__tpl_vars['name'],'options' => $__tpl_vars['order_status_descr'],'selected' => $__tpl_vars['status'],'columns' => 4), $this);?></div><?php endif; ?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php endif; ?>
			</div>
		<?php endforeach; endif; unset($_from); ?>
	</fieldset>
	</div>
</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[statuses.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[statuses.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>
<!--content_group<?php echo $__tpl_vars['st']; ?>
--></div>