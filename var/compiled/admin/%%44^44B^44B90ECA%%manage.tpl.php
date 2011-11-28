<?php /* Smarty version 2.6.18, created on 2011-11-28 12:00:54
         compiled from views/settings/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/settings/manage.tpl', 3, false),array('modifier', 'fn_get_all_states', 'views/settings/manage.tpl', 6, false),array('modifier', 'escape', 'views/settings/manage.tpl', 7, false),array('modifier', 'explode', 'views/settings/manage.tpl', 25, false),array('modifier', 'unescape', 'views/settings/manage.tpl', 46, false),array('modifier', 'in_array', 'views/settings/manage.tpl', 59, false),array('modifier', 'md5', 'views/settings/manage.tpl', 80, false),array('modifier', 'fn_get_simple_countries', 'views/settings/manage.tpl', 99, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('multiple_selectbox_notice','select_country','select_state','browse','settings'));
?>

<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>

<script type="text/javascript">
	//<![CDATA[
	<?php $this->assign('states', fn_get_all_states(@CART_LANGUAGE, false, true), false); ?>
	var default_country = '<?php echo smarty_modifier_escape($__tpl_vars['settings']['General']['default_country'], 'javascript'); ?>
';
	var states = new Array();
	<?php if ($__tpl_vars['states']): ?>
	<?php $_from_990436864 = & $__tpl_vars['states']; if (!is_array($_from_990436864) && !is_object($_from_990436864)) { settype($_from_990436864, 'array'); }if (count($_from_990436864)):
    foreach ($_from_990436864 as $__tpl_vars['country_code'] => $__tpl_vars['country_states']):
?>
	states['<?php echo $__tpl_vars['country_code']; ?>
'] = new Array();
	<?php $_from_2529267374 = & $__tpl_vars['country_states']; if (!is_array($_from_2529267374) && !is_object($_from_2529267374)) { settype($_from_2529267374, 'array'); }$this->_foreach['fs'] = array('total' => count($_from_2529267374), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from_2529267374 as $__tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
	states['<?php echo $__tpl_vars['country_code']; ?>
']['<?php echo smarty_modifier_escape($__tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($__tpl_vars['state']['state'], 'javascript'); ?>
';
	<?php endforeach; endif; unset($_from); ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	//]]>
</script>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/file_browser.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($__tpl_vars['_REQUEST']['highlight']): ?>
<?php $this->assign('highlight', explode(",", $__tpl_vars['_REQUEST']['highlight']), false); ?>
<?php endif; ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="settings_form" class="cm-form-highlight">
<input name="section_id" type="hidden" value="<?php echo $__tpl_vars['section_id']; ?>
" />
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $__tpl_vars['selected_section']; ?>
" />

<?php ob_start(); ?>

<?php ob_start(); ?>

<?php $_from_3579139930 = & $__tpl_vars['options']; if (!is_array($_from_3579139930) && !is_object($_from_3579139930)) { settype($_from_3579139930, 'array'); }if (count($_from_3579139930)):
    foreach ($_from_3579139930 as $__tpl_vars['ukey'] => $__tpl_vars['subsection']):
?>
<div id="content_<?php echo $__tpl_vars['ukey']; ?>
">
<table cellpadding="0" cellspacing="0" border="0" class="settings" width="100%">
<?php $_from_3325021058 = & $__tpl_vars['subsection']; if (!is_array($_from_3325021058) && !is_object($_from_3325021058)) { settype($_from_3325021058, 'array'); }$this->_foreach['section'] = array('total' => count($_from_3325021058), 'iteration' => 0);
if ($this->_foreach['section']['total'] > 0):
    foreach ($_from_3325021058 as $__tpl_vars['item']):
        $this->_foreach['section']['iteration']++;
?>
<?php if ($__tpl_vars['item']['element_type'] == 'D'): ?>
	<tr>
		<td colspan="2"><hr width="100%" /></td>
	</tr>
<?php elseif ($__tpl_vars['item']['element_type'] == 'I'): ?>
	<tr>
		<td colspan="2"><?php echo smarty_modifier_unescape($__tpl_vars['item']['info']); ?>
</td>
	</tr>
<?php elseif ($__tpl_vars['item']['element_type'] == 'H'): ?>
	<tr>
		<td colspan="2">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['item']['description'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
<?php endif; ?>

<?php if (! $__tpl_vars['item']['element_type']): ?>
<tr class="form-field">
	<td width="60%">
		<label for="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" class="description <?php if ($__tpl_vars['highlight'] && smarty_modifier_in_array($__tpl_vars['item']['option_name'], $__tpl_vars['highlight'])): ?>highlight<?php endif; ?> <?php if ($__tpl_vars['item']['option_type'] == 'X'): ?>cm-country cm-location-billing<?php elseif ($__tpl_vars['item']['option_type'] == 'W'): ?>cm-state cm-location-billing<?php endif; ?>">
		<?php echo smarty_modifier_unescape($__tpl_vars['item']['description']); ?>

		</label>
	</td>
	<td class="nowrap" width="40%">
	<?php if ($__tpl_vars['item']['option_type'] == 'P'): ?>
		<input id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" type="password" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" size="30" value="<?php echo $__tpl_vars['item']['value']; ?>
" class="input-text" />
	<?php elseif ($__tpl_vars['item']['option_type'] == 'T'): ?>
		<textarea id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" rows="5" cols="19" class="input-text"><?php echo $__tpl_vars['item']['value']; ?>
</textarea>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'C'): ?>
		<input type="hidden" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" value="N" />
		<input id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" type="checkbox" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" value="Y" <?php if ($__tpl_vars['item']['value'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
	<?php elseif ($__tpl_vars['item']['option_type'] == 'S'): ?>
		<select id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]">
			<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
				<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['v']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'R'): ?>
		<div class="select-field">
		<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
		<input type="radio" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'] == $__tpl_vars['k']): ?>checked="checked"<?php endif; ?> class="radio" id="variant_<?php echo md5($__tpl_vars['item']['description']); ?>
_<?php echo md5($__tpl_vars['k']); ?>
" />&nbsp;<label for="variant_<?php echo md5($__tpl_vars['item']['description']); ?>
_<?php echo md5($__tpl_vars['k']); ?>
"><?php echo $__tpl_vars['v']; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'M'): ?>
		<select id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
][]" multiple="multiple">
		<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
		<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'][$__tpl_vars['k']] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['v']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
		<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

	<?php elseif ($__tpl_vars['item']['option_type'] == 'N'): ?>
		<div class="select-field">
		<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
		<input type="checkbox" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
][]" id="variant_<?php echo md5($__tpl_vars['item']['description']); ?>
_<?php echo md5($__tpl_vars['k']); ?>
" value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'][$__tpl_vars['k']] == 'Y'): ?>checked="checked"<?php endif; ?> />&nbsp;<label for="variant_<?php echo md5($__tpl_vars['item']['description']); ?>
_<?php echo md5($__tpl_vars['k']); ?>
"><?php echo $__tpl_vars['v']; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'X'): ?>
		<select id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]">
			<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
			<?php $this->assign('countries', fn_get_simple_countries(""), false); ?>
			<?php $_from_3268346460 = & $__tpl_vars['countries']; if (!is_array($_from_3268346460) && !is_object($_from_3268346460)) { settype($_from_3268346460, 'array'); }if (count($_from_3268346460)):
    foreach ($_from_3268346460 as $__tpl_vars['ccode'] => $__tpl_vars['country']):
?>
				<option value="<?php echo $__tpl_vars['ccode']; ?>
" <?php if ($__tpl_vars['ccode'] == $__tpl_vars['item']['value']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['country']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'W'): ?>
		<script type="text/javascript">
			//<![CDATA[
			var default_state = <?php echo $__tpl_vars['ldelim']; ?>
'billing':'<?php echo smarty_modifier_escape($__tpl_vars['item']['value'], 'javascript'); ?>
'<?php echo $__tpl_vars['rdelim']; ?>
;
			//]]>
		</script>
		<input type="text" id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
_d" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" value="<?php echo $__tpl_vars['item']['value']; ?>
" size="32" maxlength="64" disabled="disabled" class="hidden input-text" />
		<select id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]">
			<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
		</select>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'F'): ?>
		<input id="file_elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" type="text" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" value="<?php echo $__tpl_vars['item']['value']; ?>
" size="30" class="valign input-text" />&nbsp;<input id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" type="button" value="<?php echo fn_get_lang_var('browse', $this->getLanguage()); ?>
" class="valign input-text" onclick="fileuploader.init('box_server_upload', this.id);" />
	<?php elseif ($__tpl_vars['item']['option_type'] == 'G'): ?>
		<div class="table-filters">
			<div class="scroll-y">
				<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
					<div class="select-field"><input type="checkbox" class="checkbox cm-combo-checkbox" id="option_<?php echo $__tpl_vars['k']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
][]" value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'][$__tpl_vars['k']] == 'Y'): ?>checked="checked"<?php endif; ?> /><label for="option_<?php echo $__tpl_vars['k']; ?>
"><?php echo $__tpl_vars['v']; ?>
</label></div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
	<?php elseif ($__tpl_vars['item']['option_type'] == 'K'): ?>
		<select id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" class="cm-combo-select">
			<?php $_from_2415944501 = & $__tpl_vars['item']['variants']; if (!is_array($_from_2415944501) && !is_object($_from_2415944501)) { settype($_from_2415944501, 'array'); }if (count($_from_2415944501)):
    foreach ($_from_2415944501 as $__tpl_vars['k'] => $__tpl_vars['v']):
?>
				<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['item']['value'] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['v']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php else: ?>
		<input id="elm_<?php echo $__tpl_vars['item']['option_id']; ?>
" type="text" name="update[<?php echo $__tpl_vars['item']['option_id']; ?>
]" size="30" value="<?php echo $__tpl_vars['item']['value']; ?>
" class="input-text" />
	<?php endif; ?>
	</td>
</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endforeach; endif; unset($_from); ?>

<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[settings.update]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'track' => true, )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($__tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (! $__tpl_vars['tabs_section'] || $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section']): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
<?php echo $__tpl_vars['id_suffix']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($__tpl_vars['tab']['href']): ?>href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $__tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => (fn_get_lang_var('settings', $this->getLanguage())).": ".($__tpl_vars['settings_title']),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>
