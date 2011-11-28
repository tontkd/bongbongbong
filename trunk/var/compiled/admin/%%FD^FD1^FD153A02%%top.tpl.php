<?php /* Smarty version 2.6.18, created on 2011-11-28 11:47:42
         compiled from top.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'top.tpl', 1, false),array('modifier', 'trim', 'top.tpl', 11, false),array('modifier', 'sizeof', 'top.tpl', 17, false),array('modifier', 'default', 'top.tpl', 22, false),array('modifier', 'string_format', 'top.tpl', 27, false),array('modifier', 'lower', 'top.tpl', 27, false),array('modifier', 'unescape', 'top.tpl', 36, false),array('block', 'hook', 'top.tpl', 11, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('users_online','select_descr_lang','select_descr_lang'));
?>

<div id="header">
	<div id="logo">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/<?php echo $__tpl_vars['manifest']['Admin_logo']['filename']; ?>
" width="<?php echo $__tpl_vars['manifest']['Admin_logo']['width']; ?>
" height="<?php echo $__tpl_vars['manifest']['Admin_logo']['height']; ?>
" border="0" alt="<?php echo $__tpl_vars['settings']['Company']['company_name']; ?>
" title="<?php echo $__tpl_vars['settings']['Company']['company_name']; ?>
" /></a>
	</div>
	
	<div id="top_quick_links">
		<?php if ($__tpl_vars['auth']['user_id']): ?>
		<div>
			<?php if ($__tpl_vars['addons']['statistics']['status'] == 'A'): ?><?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/statistics/hooks/index/top.override.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean();
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($__tpl_vars['addon_content'])): ?><?php echo $__tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "index:top")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<span class="underline"><?php echo fn_get_lang_var('users_online', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo $__tpl_vars['users_online']; ?>
</strong></span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		</div>

		<div>
			<?php if (sizeof($__tpl_vars['languages']) > 1): ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "sl="), 'items' => $__tpl_vars['languages'], 'selected_id' => @CART_LANGUAGE, 'display_icons' => true, 'key_name' => 'name', 'language_var_name' => 'sl', 'class' => 'languages', )); ?>

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
			<?php endif; ?>
			<?php if (sizeof($__tpl_vars['languages']) > 1 && sizeof($__tpl_vars['currencies']) > 1): ?>&nbsp;|&nbsp;<?php endif; ?>
			<?php if (sizeof($__tpl_vars['currencies']) > 1): ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "currency="), 'items' => $__tpl_vars['currencies'], 'selected_id' => $__tpl_vars['secondary_currency'], 'display_icons' => false, 'key_name' => 'description', )); ?>

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
			<?php endif; ?>
		</div>
		<div class="nowrap">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top_quick_links.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php endif; ?>
	</div>
	
	<div id="menu_first_level">
		<?php if ($__tpl_vars['auth']['user_id']): ?>
		<ul id="menu_first_level_ul" class="clear">
			<li id="tabs_home" <?php if (! $__tpl_vars['navigation']['selected_tab']): ?>class="cm-active"<?php endif; ?>><a href="<?php echo $__tpl_vars['index_script']; ?>
">&nbsp;</a></li>
			<?php $_from_906090678 = & $__tpl_vars['navigation']['static']; if (!is_array($_from_906090678) && !is_object($_from_906090678)) { settype($_from_906090678, 'array'); }if (count($_from_906090678)):
    foreach ($_from_906090678 as $__tpl_vars['title'] => $__tpl_vars['m']):
?>
			<li <?php if ($__tpl_vars['title'] == $__tpl_vars['navigation']['selected_tab']): ?>class="cm-active"<?php endif; ?> id="tabs_<?php echo $__tpl_vars['title']; ?>
"><a onclick="fn_switch_tab('<?php echo $__tpl_vars['title']; ?>
')"><?php echo fn_get_lang_var($__tpl_vars['title'], $this->getLanguage()); ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
		<?php endif; ?>
	</div>
	
	<div id="menu_second_level">
		<?php if ($__tpl_vars['auth']['user_id']): ?>
		<?php $_from_906090678 = & $__tpl_vars['navigation']['static']; if (!is_array($_from_906090678) && !is_object($_from_906090678)) { settype($_from_906090678, 'array'); }if (count($_from_906090678)):
    foreach ($_from_906090678 as $__tpl_vars['title'] => $__tpl_vars['m']):
?>
		<ul id="elements_<?php echo $__tpl_vars['title']; ?>
" class="clear<?php if ($__tpl_vars['title'] != $__tpl_vars['navigation']['selected_tab']): ?> hidden<?php endif; ?>">
			<?php $_from_1549951138 = & $__tpl_vars['m']; if (!is_array($_from_1549951138) && !is_object($_from_1549951138)) { settype($_from_1549951138, 'array'); }$this->_foreach['sec_level'] = array('total' => count($_from_1549951138), 'iteration' => 0);
if ($this->_foreach['sec_level']['total'] > 0):
    foreach ($_from_1549951138 as $__tpl_vars['_title'] => $__tpl_vars['_m']):
        $this->_foreach['sec_level']['iteration']++;
?>
			<li class="<?php if ($__tpl_vars['_title'] == $__tpl_vars['navigation']['subsection'] && $__tpl_vars['title'] == $__tpl_vars['navigation']['selected_tab']): ?>cm-active<?php endif; ?> <?php if (($this->_foreach['sec_level']['iteration'] == $this->_foreach['sec_level']['total'])): ?>no-border<?php endif; ?>"><a href="<?php echo $__tpl_vars['_m']['href']; ?>
"><?php echo fn_get_lang_var($__tpl_vars['_title'], $this->getLanguage()); ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</div>
<!--header--></div>

<?php echo '
<script type="text/javascript">
//<![CDATA[
function fn_switch_tab(section)
{
	$(\'#menu_second_level ul\').each(function(){
		var self = $(this);
		self.toggleBy(self.attr(\'id\') != \'elements_\' + section)
	});

	$(\'#menu_first_level_ul li\').each(function(){
		var self = $(this);
		if (self.attr(\'id\') != \'tabs_\' + section) {
			self.removeClass(\'cm-active\');
		} else {
			self.addClass(\'cm-active\');
		}
	});
}
//]]>
</script>
'; ?>
			