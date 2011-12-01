<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:07
         compiled from bottom.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'bottom.tpl', 3, false),array('modifier', 'default', 'bottom.tpl', 14, false),array('modifier', 'fn_check_view_permissions', 'bottom.tpl', 51, false),array('modifier', 'substr_count', 'bottom.tpl', 74, false),array('modifier', 'replace', 'bottom.tpl', 75, false),array('modifier', 'truncate', 'bottom.tpl', 105, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('quick_search','quick_search','product_code','order_id','user','search_in_content','search_product','remove_this_item','remove_this_item','or','choose','or','tools','add','cleanup_history','no_items','last_viewed_items','open_store','close_store'));
?>
<?php  ob_start();  ?>
<?php if (defined('DEBUG_MODE')): ?>
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
<?php endif; ?>

<div id="bottom_menu">
	<div class="float-left">
		<form id="bottom_quick_search" name="quick_search_form" action="<?php echo $__tpl_vars['index_script']; ?>
">
			<input type="hidden" value="Y" name="redirect_if_one" />
			<input type="hidden" value="<?php echo fn_get_lang_var('quick_search', $this->getLanguage()); ?>
..." name="_default_search" id="elm_default_search" />
			<input type="text" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['q'], (fn_get_lang_var('quick_search', $this->getLanguage()))."..."); ?>
" name="q" id="quick_search" class="input-text <?php if ($__tpl_vars['search']['q'] == ""): ?>cm-hint<?php endif; ?>" />
			<?php ob_start(); ?>
			<ul>
				<li><a name="dispatch[products.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'pcode');"><?php echo fn_get_lang_var('product_code', $this->getLanguage()); ?>
</a></li>
				<li><a name="dispatch[orders.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'order_id');"><?php echo fn_get_lang_var('order_id', $this->getLanguage()); ?>
</a></li>
				<li><a name="dispatch[profiles.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'name');"><?php echo fn_get_lang_var('user', $this->getLanguage()); ?>
</a></li>
				<?php if ($__tpl_vars['settings']['General']['search_objects']): ?>
				<li><a name="dispatch[search.results]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'q');"><?php echo fn_get_lang_var('search_in_content', $this->getLanguage()); ?>
</a></li>
				<?php endif; ?>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('search_product', $this->getLanguage()), 'but_name' => "dispatch[products.manage]", 'but_onclick' => "$('#quick_search').attr('name', 'q').val($('#quick_search').val() == $('#elm_default_search').val() ? '' : $('#quick_search').val());", 'but_role' => 'submit', 'allow_href' => true, )); ?>

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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => 'bottom', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose', $this->getLanguage()), 'link_meta' => 'lowercase', )); ?>


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
		</form>
	</div>

	<div class="float-right">
		<?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="last-items-content cm-smart-position cm-popup-box hidden" id="last_edited_items">
<?php if ($__tpl_vars['last_edited_items']): ?>
	<ul>
	<?php $_from_1231955463 = & $__tpl_vars['last_edited_items']; if (!is_array($_from_1231955463) && !is_object($_from_1231955463)) { settype($_from_1231955463, 'array'); }if (count($_from_1231955463)):
    foreach ($_from_1231955463 as $__tpl_vars['lnk']):
?>
		<li><a <?php if ($__tpl_vars['lnk']['icon']): ?>class="<?php echo $__tpl_vars['lnk']['icon']; ?>
"<?php endif; ?> href="<?php echo $__tpl_vars['lnk']['url']; ?>
" title="<?php echo $__tpl_vars['lnk']['name']; ?>
"><?php echo smarty_modifier_truncate($__tpl_vars['lnk']['name'], 40); ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<p class="float-right"><a class="cm-ajax text-button-edit" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tools.cleanup_history" rev="last_edited_items"><?php echo fn_get_lang_var('cleanup_history', $this->getLanguage()); ?>
</a></p>
<?php else: ?>
	<p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>
<?php endif; ?>
<!--last_edited_items--></div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<div id="bottom_popup_menu_wrap">
			<a id="sw_last_edited_items" class="cm-combo-on cm-combination"><?php echo fn_get_lang_var('last_viewed_items', $this->getLanguage()); ?>
</a>
		</div>
	</div>

	<div class="float-right" id="store_mode">
		<?php if ($__tpl_vars['settings']['store_mode'] == 'closed'): ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tools.store_mode&amp;state=opened"><?php echo fn_get_lang_var('open_store', $this->getLanguage()); ?>
</a>
		<?php else: ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tools.store_mode&amp;state=closed"><?php echo fn_get_lang_var('close_store', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
	<!--store_mode--></div>
</div>
<?php  ob_end_flush();  ?>