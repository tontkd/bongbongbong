<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:17
         compiled from top.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'top.tpl', 1, false),array('modifier', 'escape', 'top.tpl', 25, false),array('modifier', 'replace', 'top.tpl', 57, false),array('modifier', 'sizeof', 'top.tpl', 92, false),array('modifier', 'default', 'top.tpl', 96, false),array('modifier', 'string_format', 'top.tpl', 103, false),array('modifier', 'lower', 'top.tpl', 103, false),array('modifier', 'unescape', 'top.tpl', 112, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('sign_in','or','register','sign_out','delete','delete','sign_in','localization','select_descr_lang','select_descr_lang','select_descr_lang'));
?>

<div class="header-helper-container">
	<div class="logo-image">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/<?php echo $__tpl_vars['manifest']['Customer_logo']['filename']; ?>
" width="<?php echo $__tpl_vars['manifest']['Customer_logo']['width']; ?>
" height="<?php echo $__tpl_vars['manifest']['Customer_logo']['height']; ?>
" border="0" alt="<?php echo $__tpl_vars['settings']['Company']['company_name']; ?>
" /></a>
	</div>
	
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<p class="quick-links">&nbsp;
	<?php $_from_1513176447 = & $__tpl_vars['quick_links']; if (!is_array($_from_1513176447) && !is_object($_from_1513176447)) { settype($_from_1513176447, 'array'); }if (count($_from_1513176447)):
    foreach ($_from_1513176447 as $__tpl_vars['link']):
?>
		<a href="<?php echo $__tpl_vars['link']['param']; ?>
"><?php echo $__tpl_vars['link']['descr']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
</p>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top_menu.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
	
<div class="top-tools-container">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	<div class="top-tools-helper">
		<div class="float-right" id="sign_io"><!--dynamic:sign_io-->
			<?php $this->assign('escaped_current_url', smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'), false); ?>
			<?php if (! $__tpl_vars['auth']['user_id']): ?>
				<a id="sw_login" <?php if ($__tpl_vars['settings']['General']['secure_auth'] == 'Y'): ?> href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.login_form"<?php else: ?>class="cm-combination"<?php endif; ?>><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
</a>
				<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>

				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.add"><?php echo fn_get_lang_var('register', $this->getLanguage()); ?>
</a>
			<?php else: ?>
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update" class="strong"><?php echo $__tpl_vars['user_info']['firstname']; ?>
&nbsp;<?php echo $__tpl_vars['user_info']['lastname']; ?>
</a>
				(<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_role' => 'text', 'but_href' => ($__tpl_vars['index_script'])."?dispatch=auth.logout&amp;redirect_url=".($__tpl_vars['escaped_current_url']), 'but_text' => fn_get_lang_var('sign_out', $this->getLanguage()), )); ?>

<?php if ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name'] && $__tpl_vars['but_role'] != 'text' && $__tpl_vars['but_role'] != 'act' && $__tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($__tpl_vars['but_id']): ?>id="wrap_<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $__tpl_vars['suffix']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $__tpl_vars['but_name']; ?>
" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" /></span>

<?php elseif ($__tpl_vars['but_role'] == 'text' || $__tpl_vars['but_role'] == 'act' || $__tpl_vars['but_role'] == 'edit' || ( $__tpl_vars['but_role'] == 'text' && $__tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> cm-submit-link<?php endif; ?> text-button<?php echo $__tpl_vars['suffix']; ?>
"<?php if ($__tpl_vars['but_id']): ?> id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a>

<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($__tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($__tpl_vars['but_meta']): ?> class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete_small.gif" width="10" height="9" border="0" alt="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" /></a>

<?php else: ?> 

	<span class="button<?php echo $__tpl_vars['suffix']; ?>
" <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?>><a <?php if ($__tpl_vars['but_href']): ?>href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($__tpl_vars['but_meta']): ?><?php echo $__tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($__tpl_vars['but_rev']): ?>rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['but_text']; ?>
</a></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>)
			<?php endif; ?>
			
			<?php if ($__tpl_vars['settings']['General']['secure_auth'] != 'Y'): ?>
			<div id="login" class="cm-popup-box hidden">
				<div class="login-popup">
					<h1><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
</h1>
					<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/auth/login_form.tpl", 'smarty_include_vars' => array('style' => 'popup','form_name' => 'login_popup_form','id' => 'popup')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
			<?php endif; ?>
		<!--/dynamic--><!--sign_io--></div>
		<div class="top-search">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/search.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>

<div class="content-tools">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	<div class="content-tools-helper clear">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/cart_status.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="float-right">
			<?php if (sizeof($__tpl_vars['localizations']) > 1): ?>
			<!--dynamic:localizations-->
				<div class="select-wrap localization"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "lc="), 'items' => $__tpl_vars['localizations'], 'selected_id' => @CART_LOCALIZATION, 'display_icons' => false, 'key_name' => 'localization', 'text' => fn_get_lang_var('localization', $this->getLanguage()), )); ?>

<?php $this->assign('language_text', smarty_modifier_default(@$__tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>
<?php $this->assign('icon_tpl', ($__tpl_vars['images_dir'])."/flags/%s.png", false); ?>

<?php if ($__tpl_vars['style'] == 'graphic'): ?>
	<?php if ($__tpl_vars['text']): ?><?php echo $__tpl_vars['text']; ?>
:<?php endif; ?>
	
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
" class="select-popup cm-popup-box hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
		<ul class="cm-select-list">
			<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
				<li><a rel="nofollow" name="<?php echo $__tpl_vars['id']; ?>
" href="<?php echo $__tpl_vars['link_tpl']; ?>
<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['display_icons'] == true): ?>style="background-image: url('<?php echo smarty_modifier_string_format(smarty_modifier_lower($__tpl_vars['id']), $__tpl_vars['icon_tpl']); ?>
');"<?php endif; ?> class="<?php if ($__tpl_vars['display_icons'] == true): ?>item-link<?php endif; ?> <?php if ($__tpl_vars['selected_id'] == $__tpl_vars['id']): ?>active<?php endif; ?>"><?php echo smarty_modifier_unescape($__tpl_vars['item'][$__tpl_vars['key_name']]); ?>
<?php if ($__tpl_vars['item']['symbol']): ?>&nbsp;(<?php echo smarty_modifier_unescape($__tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php else: ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
			<!--/dynamic-->
			<?php endif; ?>

			<?php if (sizeof($__tpl_vars['languages']) > 1): ?>
				<div class="select-wrap"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "sl="), 'items' => $__tpl_vars['languages'], 'selected_id' => @CART_LANGUAGE, 'display_icons' => true, 'key_name' => 'name', 'language_var_name' => 'sl', )); ?>

<?php $this->assign('language_text', smarty_modifier_default(@$__tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>
<?php $this->assign('icon_tpl', ($__tpl_vars['images_dir'])."/flags/%s.png", false); ?>

<?php if ($__tpl_vars['style'] == 'graphic'): ?>
	<?php if ($__tpl_vars['text']): ?><?php echo $__tpl_vars['text']; ?>
:<?php endif; ?>
	
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
" class="select-popup cm-popup-box hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
		<ul class="cm-select-list">
			<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
				<li><a rel="nofollow" name="<?php echo $__tpl_vars['id']; ?>
" href="<?php echo $__tpl_vars['link_tpl']; ?>
<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['display_icons'] == true): ?>style="background-image: url('<?php echo smarty_modifier_string_format(smarty_modifier_lower($__tpl_vars['id']), $__tpl_vars['icon_tpl']); ?>
');"<?php endif; ?> class="<?php if ($__tpl_vars['display_icons'] == true): ?>item-link<?php endif; ?> <?php if ($__tpl_vars['selected_id'] == $__tpl_vars['id']): ?>active<?php endif; ?>"><?php echo smarty_modifier_unescape($__tpl_vars['item'][$__tpl_vars['key_name']]); ?>
<?php if ($__tpl_vars['item']['symbol']): ?>&nbsp;(<?php echo smarty_modifier_unescape($__tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php else: ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
			<?php endif; ?>
			
			<?php if (sizeof($__tpl_vars['currencies']) > 1): ?>
			<!--dynamic:currency-->
				<div class="select-wrap"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($__tpl_vars['config']['current_url'], "currency="), 'items' => $__tpl_vars['currencies'], 'selected_id' => $__tpl_vars['secondary_currency'], 'display_icons' => false, 'key_name' => 'description', )); ?>

<?php $this->assign('language_text', smarty_modifier_default(@$__tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>
<?php $this->assign('icon_tpl', ($__tpl_vars['images_dir'])."/flags/%s.png", false); ?>

<?php if ($__tpl_vars['style'] == 'graphic'): ?>
	<?php if ($__tpl_vars['text']): ?><?php echo $__tpl_vars['text']; ?>
:<?php endif; ?>
	
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
" class="select-popup cm-popup-box hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
		<ul class="cm-select-list">
			<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }if (count($_from_67574462)):
    foreach ($_from_67574462 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
				<li><a rel="nofollow" name="<?php echo $__tpl_vars['id']; ?>
" href="<?php echo $__tpl_vars['link_tpl']; ?>
<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['display_icons'] == true): ?>style="background-image: url('<?php echo smarty_modifier_string_format(smarty_modifier_lower($__tpl_vars['id']), $__tpl_vars['icon_tpl']); ?>
');"<?php endif; ?> class="<?php if ($__tpl_vars['display_icons'] == true): ?>item-link<?php endif; ?> <?php if ($__tpl_vars['selected_id'] == $__tpl_vars['id']): ?>active<?php endif; ?>"><?php echo smarty_modifier_unescape($__tpl_vars['item'][$__tpl_vars['key_name']]); ?>
<?php if ($__tpl_vars['item']['symbol']): ?>&nbsp;(<?php echo smarty_modifier_unescape($__tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php else: ?>
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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
			<!--/dynamic-->
			<?php endif; ?>
		</div>
	</div>
</div>