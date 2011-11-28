<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:51
         compiled from views/addons/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'views/addons/update.tpl', 20, false),array('modifier', 'fn_get_simple_countries', 'views/addons/update.tpl', 55, false),array('modifier', 'escape', 'views/addons/update.tpl', 64, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','select_country','select_state','browse'));
?>

<?php $this->assign('_addon', $__tpl_vars['_REQUEST']['addon'], false); ?>

<div id="content_group<?php echo $__tpl_vars['_addon']; ?>
">
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="update_addon_<?php echo $__tpl_vars['_addon']; ?>
_form" class="cm-form-highlight">
<input type="hidden" name="addon" value="<?php echo $__tpl_vars['_REQUEST']['addon']; ?>
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
		<?php $_from_2062017905 = & $__tpl_vars['fields']; if (!is_array($_from_2062017905) && !is_object($_from_2062017905)) { settype($_from_2062017905, 'array'); }$this->_foreach['fe_addons'] = array('total' => count($_from_2062017905), 'iteration' => 0);
if ($this->_foreach['fe_addons']['total'] > 0):
    foreach ($_from_2062017905 as $__tpl_vars['name'] => $__tpl_vars['data']):
        $this->_foreach['fe_addons']['iteration']++;
?>
			<?php if ($__tpl_vars['data']['type'] == 'O'): ?>
				<div><?php echo smarty_modifier_unescape($__tpl_vars['data']['info']); ?>
</div>
			<?php elseif ($__tpl_vars['data']['type'] == 'H'): ?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['data']['description'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
			<div class="form-field">
				<label for="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
"><?php echo $__tpl_vars['data']['description']; ?>
:</label>
				<?php if ($__tpl_vars['data']['type'] == 'S'): ?>
					<select id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]">
						<?php $_from_2381242308 = & $__tpl_vars['data']['variants']; if (!is_array($_from_2381242308) && !is_object($_from_2381242308)) { settype($_from_2381242308, 'array'); }if (count($_from_2381242308)):
    foreach ($_from_2381242308 as $__tpl_vars['v_name'] => $__tpl_vars['v_data']):
?>
						<option value="<?php echo $__tpl_vars['v_name']; ?>
" <?php if ($__tpl_vars['addon_options'][$__tpl_vars['name']] == $__tpl_vars['v_name']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['v_data']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php elseif ($__tpl_vars['data']['type'] == 'M'): ?>
					<select id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
][]" multiple="multiple">
						<?php $_from_2381242308 = & $__tpl_vars['data']['variants']; if (!is_array($_from_2381242308) && !is_object($_from_2381242308)) { settype($_from_2381242308, 'array'); }if (count($_from_2381242308)):
    foreach ($_from_2381242308 as $__tpl_vars['v_name'] => $__tpl_vars['v_data']):
?>
						<option value="<?php echo $__tpl_vars['v_name']; ?>
" <?php if ($__tpl_vars['addon_options'][$__tpl_vars['name']] && $__tpl_vars['addon_options'][$__tpl_vars['name']][$__tpl_vars['v_name']]): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['v_data']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php elseif ($__tpl_vars['data']['type'] == 'R'): ?>
					<div class="select-field">
					<?php $_from_2381242308 = & $__tpl_vars['data']['variants']; if (!is_array($_from_2381242308) && !is_object($_from_2381242308)) { settype($_from_2381242308, 'array'); }if (count($_from_2381242308)):
    foreach ($_from_2381242308 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
					<input type="radio" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['addon_options'][$__tpl_vars['name']] == $__tpl_vars['k']): ?>checked="checked"<?php endif; ?> class="radio" id="variant_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['k']; ?>
" /><label for="variant_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['k']; ?>
"><?php echo $__tpl_vars['v']; ?>
</label>
					<?php endforeach; endif; unset($_from); ?>
					</div>

				<?php elseif ($__tpl_vars['data']['type'] == 'N'): ?>
					<div class="select-field">
					<?php $_from_2381242308 = & $__tpl_vars['data']['variants']; if (!is_array($_from_2381242308) && !is_object($_from_2381242308)) { settype($_from_2381242308, 'array'); }if (count($_from_2381242308)):
    foreach ($_from_2381242308 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
					<input type="checkbox" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
][<?php echo $__tpl_vars['k']; ?>
]" value="Y" <?php if ($__tpl_vars['addon_options'][$__tpl_vars['name']][$__tpl_vars['k']]): ?>checked="checked"<?php endif; ?> class="checkbox" id="variant_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['k']; ?>
" /><label for="variant_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
_<?php echo $__tpl_vars['k']; ?>
"><?php echo $__tpl_vars['v']; ?>
</label>
					<?php endforeach; endif; unset($_from); ?>
					</div>

				<?php elseif ($__tpl_vars['data']['type'] == 'X'): ?>
					<select id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]">
						<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
						<?php $this->assign('countries', fn_get_simple_countries(""), false); ?>
						<?php $_from_3268346460 = & $__tpl_vars['countries']; if (!is_array($_from_3268346460) && !is_object($_from_3268346460)) { settype($_from_3268346460, 'array'); }if (count($_from_3268346460)):
    foreach ($_from_3268346460 as $__tpl_vars['ccode'] => $__tpl_vars['country']):
?>
							<option value="<?php echo $__tpl_vars['ccode']; ?>
" <?php if ($__tpl_vars['ccode'] == $__tpl_vars['addon_options'][$__tpl_vars['name']]): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['country']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>

				<?php elseif ($__tpl_vars['data']['type'] == 'W'): ?>
					<script type="text/javascript">
						//<![CDATA[
						var default_state = <?php echo $__tpl_vars['ldelim']; ?>
'billing':'<?php echo smarty_modifier_escape($__tpl_vars['addon_options'][$__tpl_vars['name']], 'javascript'); ?>
'<?php echo $__tpl_vars['rdelim']; ?>
;
						//]]>
					</script>
					<input type="text" id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
_d" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" value="<?php echo $__tpl_vars['addon_options'][$__tpl_vars['name']]; ?>
" size="32" maxlength="64" value="" disabled="disabled" class="hidden" />
					<select id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]">
						<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
					</select>

				<?php elseif ($__tpl_vars['data']['type'] == 'F'): ?>
					<input id="input_addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" type="text" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" value="<?php echo $__tpl_vars['addon_options'][$__tpl_vars['name']]; ?>
" size="30" class="valign input-text" />&nbsp;<input id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" type="button" value="<?php echo fn_get_lang_var('browse', $this->getLanguage()); ?>
" class="valign input-text" onclick="fileuploader.init('box_server_upload', 'input_' + this.id, event);" />

				<?php elseif ($__tpl_vars['data']['type'] == 'C'): ?>
					<input type="hidden" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" value="N" />
					<input type="checkbox" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" value="Y" <?php if ($__tpl_vars['addon_options'][$__tpl_vars['name']] == 'Y'): ?> checked="checked"<?php endif; ?> class="checkbox" />

				<?php elseif ($__tpl_vars['data']['type'] == 'I'): ?>
					<input type="text" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" value="<?php echo $__tpl_vars['addon_options'][$__tpl_vars['name']]; ?>
" class="input-text" />

				<?php elseif ($__tpl_vars['data']['type'] == 'P'): ?>
					<input type="password" name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
" value="<?php echo $__tpl_vars['addon_options'][$__tpl_vars['name']]; ?>
" class="input-text" />

				<?php elseif ($__tpl_vars['data']['type'] == 'T'): ?>
					<textarea name="addon_data[options][<?php echo $__tpl_vars['name']; ?>
]" id="addon_option_<?php echo $__tpl_vars['_addon']; ?>
_<?php echo $__tpl_vars['name']; ?>
"><?php echo $__tpl_vars['addon_options'][$__tpl_vars['name']]; ?>
</textarea>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</fieldset>
	</div>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[addons.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>
<!--content_group<?php echo $__tpl_vars['_addon']; ?>
--></div>