<?php /* Smarty version 2.6.18, created on 2011-12-01 21:45:15
         compiled from common_templates/quick_menu.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'common_templates/quick_menu.tpl', 1, false),array('modifier', 'sizeof', 'common_templates/quick_menu.tpl', 53, false),array('modifier', 'default', 'common_templates/quick_menu.tpl', 55, false),array('modifier', 'string_format', 'common_templates/quick_menu.tpl', 60, false),array('modifier', 'lower', 'common_templates/quick_menu.tpl', 60, false),array('modifier', 'unescape', 'common_templates/quick_menu.tpl', 69, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('editing_quick_menu_section','editing_quick_menu_link','select_descr_lang','name','link','position','use_current_link','quick_menu','remove_this_item','edit','remove_this_item','edit','add_link','add_section','done','edit'));
?>

<script type="text/javascript">
//<![CDATA[
<?php echo '
function fn_quick_menu_content_switch_callback()
{
	var container = $(\'#quick_menu_content\');
	var scroll_elm = $(\'.menu-container\', container);
	var elm = $(\'#sw_quick_menu_content\').get(0);
	var w = jQuery.get_window_sizes();
	var offset = container.offset();
	var max_height = offset.top - w.offset_y > w.view_height / 2 ? offset.top - w.offset_y - elm.offsetHeight: w.offset_y + w.view_height - offset.top;
	scroll_elm.css(\'height\', \'\');
	if (container.get(0).offsetHeight > max_height) {
		var diff = container.get(0).offsetHeight - scroll_elm.get(0).offsetHeight;
		scroll_elm.css(\'height\', max_height - diff - 10 + \'px\');
	}
	if (offset.top + container.get(0).offsetHeight > w.offset_y + w.view_height) {
		container.css(\'top\', elm.offsetTop - container.get(0).offsetHeight + 1);
		container.addClass(\'quick-menu-bottom\');
	} else {
		container.css(\'top\', elm.offsetTop + elm.offsetHeight - 1);
		container.removeClass(\'quick-menu-bottom\');
	}
	if (offset.left - elm.offsetWidth <= w.offset_x) {
		container.css(\'left\', 0);
	} else {
		container.css(\'left\', elm.offsetLeft + elm.offsetWidth - container.get(0).offsetWidth);
	}
}
'; ?>

<?php if (! $__tpl_vars['edit_quick_menu'] && ! $__tpl_vars['expand_quick_menu']): ?>
<?php echo '
function fn_switch_quick_menu()
{
	$(\'head\').append(\'<script type="text/javascript" src="\' + current_path + \'/js/quick_menu.js"></sc\' + \'ript>\');
}
'; ?>

<?php endif; ?>
//]]>
</script>

<div class="quick-menu-container" <?php if ($_COOKIE['quick_menu_offset']): ?>style="<?php echo $_COOKIE['quick_menu_offset']; ?>
"<?php endif; ?> id="quick_menu">
<?php if ($__tpl_vars['show_quick_popup']): ?>
	<div id="quick_box" class="cm-popup-box hidden">
		<div class="cm-popup-content-header">
			<h3 class="float-left"><?php echo fn_get_lang_var('editing_quick_menu_section', $this->getLanguage()); ?>
</h3>
			<h3 class="float-left"><?php echo fn_get_lang_var('editing_quick_menu_link', $this->getLanguage()); ?>
</h3>
			<div class="select-lang float-right">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach(($__tpl_vars['index_script'])."?dispatch=tools.get_quick_menu_variant", "descr_sl="), 'items' => $__tpl_vars['languages'], 'selected_id' => @DESCR_SL, 'key_name' => 'name', 'suffix' => 'quick_menu', 'display_icons' => true, )); ?>

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
			</div>
		</div>
		<div class="cm-popup-content-footer">
			<form class="cm-ajax" name="quick_menu_form" action="<?php echo $__tpl_vars['index_script']; ?>
" method="post">
			<input id="qm_item_id" type="hidden" name="item[id]" value="" />
			<input id="qm_item_parent" type="hidden" name="item[parent_id]" value="0" />
			<input id="qm_descr_sl" type="hidden" name="descr_sl" value="" />
			<input type="hidden" name="result_ids" value="quick_menu" />

			<div class="form-field">
				<label class="cm-required" for="qm_item_name"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
				<input id="qm_item_name" name="item[name]" class="input-text-large main-input" type="text" value="" size="40"/>
			</div>
			
			<div class="form-field">
				<label class="cm-required" for="qm_item_link"><?php echo fn_get_lang_var('link', $this->getLanguage()); ?>
:</label>
				<input id="qm_item_link" name="item[url]" class="input-text-large" type="text" value="" size="40"/>
			</div>
			
			<div class="form-field">
				<label for="qm_item_position"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
				<input id="qm_item_position" name="item[position]" class="input-text-short" type="text" value="" size="6"/>
			</div>

			<div class="form-field">
				<a id="qm_current_link" class="underline-dashed"><?php echo fn_get_lang_var('use_current_link', $this->getLanguage()); ?>
</a>
			</div>

			<div class="buttons-container">
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[tools.update_quick_menu_item.edit]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>

			</form>
		</div>
	</div>
<?php endif; ?>
	<div class="cm-popup-content-header quick-menu">
		<a id="sw_quick_menu_content" class="cm-combo-<?php if ($__tpl_vars['edit_quick_menu'] || $__tpl_vars['expand_quick_menu']): ?>off<?php else: ?>on<?php endif; ?> cm-combination"><?php echo fn_get_lang_var('quick_menu', $this->getLanguage()); ?>
</a>
	</div>
	
	<div id="quick_menu_content" class="quick-menu-content cm-popup-box cm-smart-position<?php if (! $__tpl_vars['edit_quick_menu'] && ! $__tpl_vars['expand_quick_menu']): ?> hidden<?php endif; ?>">
		<?php if ($__tpl_vars['edit_quick_menu']): ?>
		<div class="menu-container">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<?php $_from_1302045737 = & $__tpl_vars['quick_menu']; if (!is_array($_from_1302045737) && !is_object($_from_1302045737)) { settype($_from_1302045737, 'array'); }if (count($_from_1302045737)):
    foreach ($_from_1302045737 as $__tpl_vars['sect_id'] => $__tpl_vars['sect']):
?>
				<tr item="<?php echo $__tpl_vars['sect_id']; ?>
" parent_id="0" pos="<?php echo $__tpl_vars['sect']['section']['position']; ?>
">
					<td class="nowrap section-header">
						<strong class="cm-qm-name"><?php echo $__tpl_vars['sect']['section']['name']; ?>
</strong><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="hand valign cm-delete-section" />
					</td>
					<td class="right"><a class="edit cm-update-item"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a></td>
				</tr>
				<?php $_from_3693657271 = & $__tpl_vars['sect']['subsection']; if (!is_array($_from_3693657271) && !is_object($_from_3693657271)) { settype($_from_3693657271, 'array'); }if (count($_from_3693657271)):
    foreach ($_from_3693657271 as $__tpl_vars['subsect']):
?>
				<tr item="<?php echo $__tpl_vars['subsect']['menu_id']; ?>
" parent_id="<?php echo $__tpl_vars['subsect']['parent_id']; ?>
" pos="<?php echo $__tpl_vars['subsect']['position']; ?>
">
					<td class="nowrap">
						<a class="cm-qm-name" href="<?php echo $__tpl_vars['subsect']['url']; ?>
"><?php echo $__tpl_vars['subsect']['name']; ?>
</a><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="hand valign cm-delete-section" />
					</td>
					<td class="right"><a class="edit cm-update-item"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr item="<?php echo $__tpl_vars['sect_id']; ?>
" parent_id="0" pos="<?php echo $__tpl_vars['sect']['section']['position']; ?>
">
					<td colspan="2" class="cm-add-link"><a class="edit cm-add-link"><?php echo fn_get_lang_var('add_link', $this->getLanguage()); ?>
</a></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</table>
		</div>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr class="done">
				<td class="nowrap"><a class="edit cm-add-section"><?php echo fn_get_lang_var('add_section', $this->getLanguage()); ?>
</a></td>
				<td class="right">
					<a class="edit cm-ajax" rev="quick_menu" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tools.show_quick_menu" name="quick_menu_content_switch_callback"><?php echo fn_get_lang_var('done', $this->getLanguage()); ?>
</a></td>
			</tr>
		</table>
		<?php else: ?>
		<?php if ($__tpl_vars['quick_menu']): ?>
		<div class="menu-container">
			<ul>
			<?php $_from_1302045737 = & $__tpl_vars['quick_menu']; if (!is_array($_from_1302045737) && !is_object($_from_1302045737)) { settype($_from_1302045737, 'array'); }if (count($_from_1302045737)):
    foreach ($_from_1302045737 as $__tpl_vars['sect']):
?>
				<li><strong><?php echo $__tpl_vars['sect']['section']['name']; ?>
</strong></li>
				<?php $_from_3693657271 = & $__tpl_vars['sect']['subsection']; if (!is_array($_from_3693657271) && !is_object($_from_3693657271)) { settype($_from_3693657271, 'array'); }if (count($_from_3693657271)):
    foreach ($_from_3693657271 as $__tpl_vars['subsect']):
?>
				<li><a href="<?php echo $__tpl_vars['subsect']['url']; ?>
"><?php echo $__tpl_vars['subsect']['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<?php endif; ?>
		<p class="right">
			<a <?php if (! $__tpl_vars['expand_quick_menu']): ?>class="edit" onclick="fn_switch_quick_menu();"<?php else: ?>class="edit cm-ajax" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tools.show_quick_menu.edit" rev="quick_menu" name="quick_menu_content_switch_callback"<?php endif; ?>><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a>
		</p>
		<?php endif; ?>
	</div>
<!--quick_menu--></div>