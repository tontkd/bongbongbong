<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:06
         compiled from common_templates/mainbox.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'common_templates/mainbox.tpl', 1, false),array('modifier', 'default', 'common_templates/mainbox.tpl', 22, false),array('modifier', 'sizeof', 'common_templates/mainbox.tpl', 40, false),array('modifier', 'string_format', 'common_templates/mainbox.tpl', 51, false),array('modifier', 'lower', 'common_templates/mainbox.tpl', 51, false),array('modifier', 'unescape', 'common_templates/mainbox.tpl', 60, false),array('modifier', 'trim', 'common_templates/mainbox.tpl', 77, false),array('modifier', 'fn_check_view_permissions', 'common_templates/mainbox.tpl', 109, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('back_to','select_descr_lang','remove_this_item','remove_this_item'));
?>
<?php if ($__tpl_vars['anchor']): ?>
<a name="<?php echo $__tpl_vars['anchor']; ?>
"></a>
<?php endif; ?>
<div>

<?php if ($__tpl_vars['title_extra'] || $__tpl_vars['tools'] || ( $__tpl_vars['navigation']['dynamic'] && $__tpl_vars['navigation']['dynamic']['actions'] ) || $__tpl_vars['select_languages'] || $__tpl_vars['extra_tools']): ?>
	<div class="clear mainbox-title-container">
<?php endif; ?>

	<?php if ($__tpl_vars['breadcrumbs']): ?>
	<div>
	<?php $_from_1561183700 = & $__tpl_vars['breadcrumbs']; if (!is_array($_from_1561183700) && !is_object($_from_1561183700)) { settype($_from_1561183700, 'array'); }$this->_foreach['f_b'] = array('total' => count($_from_1561183700), 'iteration' => 0);
if ($this->_foreach['f_b']['total'] > 0):
    foreach ($_from_1561183700 as $__tpl_vars['b']):
        $this->_foreach['f_b']['iteration']++;
?><a class="back-link strong" href="<?php echo $__tpl_vars['b']['link']; ?>
"><?php if (($this->_foreach['f_b']['iteration'] <= 1)): ?>&laquo; <?php echo fn_get_lang_var('back_to', $this->getLanguage()); ?>
:&nbsp;<?php endif; ?><?php echo $__tpl_vars['b']['title']; ?>
</a><?php if (! ($this->_foreach['f_b']['iteration'] == $this->_foreach['f_b']['total'])): ?>&nbsp;::&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endif; ?>

	<?php if ($__tpl_vars['notes']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/help.tpl", 'smarty_include_vars' => array('content' => $__tpl_vars['notes'],'id' => $__tpl_vars['notes_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<h1 class="mainbox-title<?php if ($__tpl_vars['title_extra'] || $__tpl_vars['tools']): ?> float-left<?php endif; ?>">
		<?php echo smarty_modifier_default(@$__tpl_vars['title'], "&nbsp;"); ?>

	</h1>

	<?php if (! $__tpl_vars['title_extra'] && ! $__tpl_vars['tools'] && ! $__tpl_vars['notes']): ?>
		<div class="mainbox-title-bg">&nbsp;</div>
	<?php endif; ?>

	<?php if ($__tpl_vars['title_extra']): ?><div class="title">-&nbsp;</div>
		<?php echo $__tpl_vars['title_extra']; ?>

	<?php endif; ?>

	<?php if ($__tpl_vars['tools']): ?><?php echo $__tpl_vars['tools']; ?>
<?php endif; ?>
<?php if ($__tpl_vars['title_extra'] || $__tpl_vars['tools'] || $__tpl_vars['navigation']['dynamic']['actions'] || $__tpl_vars['select_languages'] || $__tpl_vars['extra_tools']): ?>
	</div>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['dynamic']['actions'] || $__tpl_vars['select_languages'] || $__tpl_vars['extra_tools']): ?><div class="extra-tools"><?php endif; ?>

<?php if ($__tpl_vars['select_languages'] && sizeof($__tpl_vars['languages']) > 1): ?>
<div class="select-lang">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "descr_sl="), 'items' => $__tpl_vars['languages'], 'selected_id' => @DESCR_SL, 'key_name' => 'name', 'suffix' => 'content', 'display_icons' => true, )); ?>

<?php if (sizeof($__tpl_vars['items']) > 1): ?>
<div class="tools-container inline <?php echo $__tpl_vars['class']; ?>
">
<?php $this->assign('language_text', smarty_modifier_default(@$__tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>
<?php $this->assign('icon_tpl', ($__tpl_vars['images_dir'])."/flags/%s.png", false); ?>

<?php if ($__tpl_vars['style'] == 'graphic'): ?>
	<?php if ($__tpl_vars['display_icons'] == true): ?>
		<img src="<?php echo smarty_modifier_lower(smarty_modifier_string_format($__tpl_vars['selected_id'], $__tpl_vars['icon_tpl'])); ?>
" width="16" height="16" border="0" alt="" onclick="$('#sw_select_<?php echo $__tpl_vars['selected_id']; ?>
_wrap_<?php echo $__tpl_vars['suffix']; ?>
').click();" class="icons" />
	<?php endif; ?>

	<a class="select-link cm-combo-on cm-combination" id="sw_select_<?php echo $__tpl_vars['selected_id']; ?>
_wrap_<?php echo $__tpl_vars['suffix']; ?>
"><?php echo $__tpl_vars['items'][$__tpl_vars['selected_id']][$__tpl_vars['key_name']]; ?>
<?php if ($__tpl_vars['items'][$__tpl_vars['selected_id']]['symbol']): ?>&nbsp;(<?php echo $__tpl_vars['items'][$__tpl_vars['selected_id']]['symbol']; ?>
)<?php endif; ?></a>

	<div id="select_<?php echo $__tpl_vars['selected_id']; ?>
_wrap_<?php echo $__tpl_vars['suffix']; ?>
" class="popup-tools cm-popup-box hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
		<ul class="cm-select-list <?php if ($__tpl_vars['display_icons'] == true): ?>popup-icons<?php endif; ?>">
			<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
				<li><a name="<?php echo $__tpl_vars['id']; ?>
" href="<?php echo $__tpl_vars['link_tpl']; ?>
<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['display_icons'] == true): ?>style="background-image: url('<?php echo smarty_modifier_lower(smarty_modifier_string_format($__tpl_vars['id'], $__tpl_vars['icon_tpl'])); ?>
');"<?php endif; ?>><?php echo smarty_modifier_unescape($__tpl_vars['item'][$__tpl_vars['key_name']]); ?>
<?php if ($__tpl_vars['item']['symbol']): ?>&nbsp;(<?php echo smarty_modifier_unescape($__tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php elseif ($__tpl_vars['style'] == 'select'): ?>
	<?php if ($__tpl_vars['text']): ?><label for="id_<?php echo $__tpl_vars['var_name']; ?>
"><?php echo $__tpl_vars['text']; ?>
:</label><?php endif; ?>
	<select id="id_<?php echo $__tpl_vars['var_name']; ?>
" name="<?php echo $__tpl_vars['var_name']; ?>
" onchange="jQuery.redirect(this.value);" class="valign">
		<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
			<option value="<?php echo $__tpl_vars['link_tpl']; ?>
<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['id'] == $__tpl_vars['selected_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_unescape($__tpl_vars['item'][$__tpl_vars['key_name']]); ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div><?php if ($__tpl_vars['navigation']['dynamic']['actions'] || $__tpl_vars['extra_tools']): ?>&nbsp;|&nbsp;<?php endif; ?>
<?php endif; ?>

<?php if (trim($__tpl_vars['extra_tools'])): ?>
	<?php echo $__tpl_vars['extra_tools']; ?>
<?php if ($__tpl_vars['navigation']['dynamic']['actions']): ?>&nbsp;|&nbsp;<?php endif; ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['dynamic']['actions']): ?>
	<?php $_from_2156091021 = & $__tpl_vars['navigation']['dynamic']['actions']; if (!is_array($_from_2156091021) && !is_object($_from_2156091021)) { settype($_from_2156091021, 'array'); }$this->_foreach['actions'] = array('total' => count($_from_2156091021), 'iteration' => 0);
if ($this->_foreach['actions']['total'] > 0):
    foreach ($_from_2156091021 as $__tpl_vars['title'] => $__tpl_vars['m']):
        $this->_foreach['actions']['iteration']++;
?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_href' => $__tpl_vars['m']['href'], 'but_text' => fn_get_lang_var($__tpl_vars['title'], $this->getLanguage()), 'but_role' => 'tool', 'but_target' => $__tpl_vars['m']['target'], 'but_meta' => $__tpl_vars['m']['meta'], )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php if (! ($this->_foreach['actions']['iteration'] == $this->_foreach['actions']['total'])): ?>&nbsp;|&nbsp;<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['dynamic']['actions'] || $__tpl_vars['select_languages'] || $__tpl_vars['extra_tools']): ?></div><?php endif; ?>

	<div class="mainbox-body">
		<?php echo smarty_modifier_default(@$__tpl_vars['content'], "&nbsp;"); ?>

	</div>
</div>