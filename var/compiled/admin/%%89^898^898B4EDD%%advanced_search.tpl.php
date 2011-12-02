<?php /* Smarty version 2.6.18, created on 2011-12-01 22:12:49
         compiled from common_templates/advanced_search.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_crc32', 'common_templates/advanced_search.tpl', 3, false),array('modifier', 'string_format', 'common_templates/advanced_search.tpl', 3, false),array('modifier', 'fn_get_views', 'common_templates/advanced_search.tpl', 13, false),array('modifier', 'strpos', 'common_templates/advanced_search.tpl', 22, false),array('modifier', 'fn_check_view_permissions', 'common_templates/advanced_search.tpl', 53, false),array('modifier', 'default', 'common_templates/advanced_search.tpl', 56, false),array('modifier', 'count', 'common_templates/advanced_search.tpl', 86, false),array('modifier', 'fn_query_remove', 'common_templates/advanced_search.tpl', 104, false),array('modifier', 'escape', 'common_templates/advanced_search.tpl', 105, false),array('function', 'split', 'common_templates/advanced_search.tpl', 79, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('advanced_search_options','save_this_search_as','name','save','remove_this_item','remove_this_item','all','all','delete','new_saved_search','remove_this_item','remove_this_item','new_saved_search','remove_this_item','remove_this_item','object_exists'));
?>

<?php $this->assign('a_id', smarty_modifier_string_format(fn_crc32($__tpl_vars['dispatch']), "s_%s"), false); ?>

<div class="advanced-search-button">
	<a id="sw_<?php echo $__tpl_vars['a_id']; ?>
" class="cm-combination cm-save-state">
		<?php echo fn_get_lang_var('advanced_search_options', $this->getLanguage()); ?>
&nbsp;
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/section_collapsed.gif" width="7" height="9" border="0" alt="" id="on_<?php echo $__tpl_vars['a_id']; ?>
" class="cm-combination cm-save-state <?php if ($_COOKIE[$__tpl_vars['a_id']]): ?>hidden<?php endif; ?>" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/section_expanded.gif" width="7" height="9" border="0" alt="" id="off_<?php echo $__tpl_vars['a_id']; ?>
" class="cm-combination cm-save-state <?php if (! $_COOKIE[$__tpl_vars['a_id']]): ?>hidden<?php endif; ?>" />
	</a>
</div>

<?php $this->assign('views', fn_get_views($__tpl_vars['view_type']), false); ?>

<div id="<?php echo $__tpl_vars['a_id']; ?>
" class="search-advanced <?php if (! $_COOKIE[$__tpl_vars['a_id']]): ?>hidden<?php endif; ?>">
	<?php echo $__tpl_vars['content']; ?>


	<div class="buttons-container save-search">
		<div class="float-left">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($__tpl_vars['dispatch'])."]",'but_role' => 'submit')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php if (strpos($__tpl_vars['_REQUEST']['dispatch'], ".picker") === false): ?>
		<div class="right">
			<?php echo fn_get_lang_var('save_this_search_as', $this->getLanguage()); ?>
:
			<input type="text" id="view_name" name="new_view" value="<?php if ($__tpl_vars['search']['view_id'] && $__tpl_vars['views'][$__tpl_vars['search']['view_id']]): ?><?php echo $__tpl_vars['views'][$__tpl_vars['search']['view_id']]['name']; ?>
<?php else: ?><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
<?php endif; ?>" class="input-save-name <?php if (! $__tpl_vars['search']['view_id'] && ! $__tpl_vars['views'][$__tpl_vars['search']['view_id']]): ?>cm-hint<?php endif; ?>" />
			<span class="submit-button">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('save', $this->getLanguage()), 'but_onclick' => "fn_check_views('view_name', 'views')", 'but_role' => 'button', )); ?>

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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</span>
		</div>
		<?php endif; ?>
	</div>

	<?php ob_start(); ?>
	<?php $this->assign('items', '10', false); ?>
	<?php echo smarty_function_split(array('data' => $__tpl_vars['views'],'size' => $__tpl_vars['items'],'assign' => 'splitted_views'), $this);?>


	<div class="float-left">
		<div class="views">
			<a id="sw_views" class="cm-combo-on cm-combination"><?php if ($__tpl_vars['search']['view_id'] && $__tpl_vars['views'][$__tpl_vars['search']['view_id']]): ?><?php echo $__tpl_vars['views'][$__tpl_vars['search']['view_id']]['name']; ?>
<?php else: ?><?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
<?php endif; ?></a>
			<div id="views" class="list nowrap hidden cm-popup-box">
				<div class="list-content">
				<?php if (count($__tpl_vars['views']) <= 10): ?>
					<ul>
				<?php endif; ?>
					<?php $_from_3730643399 = & $__tpl_vars['splitted_views']; if (!is_array($_from_3730643399) && !is_object($_from_3730643399)) { settype($_from_3730643399, 'array'); }$this->_foreach['splitted_views'] = array('total' => count($_from_3730643399), 'iteration' => 0);
if ($this->_foreach['splitted_views']['total'] > 0):
    foreach ($_from_3730643399 as $__tpl_vars['s_views']):
        $this->_foreach['splitted_views']['iteration']++;
?>
						<?php if (count($__tpl_vars['views']) > 10): ?>
							<div class="float-left">
								<ul>
						<?php endif; ?>
							<?php if (($this->_foreach['splitted_views']['iteration'] <= 1)): ?>
								<li onmouseover="this.className = 'item-hover'" onmouseout="this.className = ''">
									<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo $__tpl_vars['dispatch']; ?>
.reset_view"><?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
</a>
								</li>
							<?php else: ?>
								<li>&nbsp;</li>
							<?php endif; ?>
							<?php $_from_1338607448 = & $__tpl_vars['s_views']; if (!is_array($_from_1338607448) && !is_object($_from_1338607448)) { settype($_from_1338607448, 'array'); }if (count($_from_1338607448)):
    foreach ($_from_1338607448 as $__tpl_vars['view']):
?>
							<?php if ($__tpl_vars['view']): ?>
							<li onmouseover="this.className = 'item-hover'" onmouseout="this.className = ''">
								<a class="cm-view-name" rev="<?php echo $__tpl_vars['view']['view_id']; ?>
" href="<?php echo fn_query_remove($__tpl_vars['config']['current_url'], 'view_id', 'new_view'); ?>
&amp;view_id=<?php echo $__tpl_vars['view']['view_id']; ?>
"><?php echo $__tpl_vars['view']['name']; ?>
</a>
								<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=<?php echo $__tpl_vars['dispatch']; ?>
/delete_view&amp;view_id=<?php echo $__tpl_vars['view']['view_id']; ?>
&amp;redirect_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
" class="cm-confirm"><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="hand valign" /></a>
							</li>
							<?php elseif (! $__tpl_vars['view'] && count($__tpl_vars['views']) > 10): ?>
							<li>&nbsp;</li>
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						<?php if (count($__tpl_vars['views']) > 10): ?>
								</ul>
							</div>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				<?php if (count($__tpl_vars['views']) <= 10): ?>
						<li class="last right">
							<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('new_saved_search', $this->getLanguage()), 'but_role' => 'text', 'but_onclick' => "fn_advanced_search_open('".($__tpl_vars['a_id'])."');", 'but_meta' => "text-button", )); ?>

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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
						</li>
					</ul>
				<?php endif; ?>
				<?php if (count($__tpl_vars['views']) > 10): ?>
				<p class="last right">
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('new_saved_search', $this->getLanguage()), 'but_role' => 'text', 'but_onclick' => "fn_advanced_search_open('".($__tpl_vars['a_id'])."');", 'but_meta' => "text-button", )); ?>

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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				</p>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->_smarty_vars['capture']['title_extra'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<script type="text/javascript">
//<![CDATA[
lang.object_exists = '<?php echo fn_get_lang_var('object_exists', $this->getLanguage()); ?>
';
<?php echo '
function fn_advanced_search_open(id)
{
	var elm = $(\'#\' + id);
	elm.show(); 
	jQuery.scrollToElm(elm);
	$(\'input[name=new_view]\', elm).focus();
}
function fn_check_views(input_id, views_id)
{
	var match = true;
	var sbm_button = $(\':submit:first\', $(\'#\' + input_id).parents(\'form:first\'));
	$(\'.cm-view-name\', $(\'#\' + views_id)).each(function() {
		if ($(this).text().toLowerCase() == $(\'#\' + input_id).val().toLowerCase()) {
			match = confirm(lang.object_exists);
			if (match) {
				$(\'<input type="hidden" name="update_view_id" value="\' + $(this).attr(\'rev\') + \'" />\').appendTo($(\'#\' + input_id).parent());
			}
			return false;
		}
	});
	if (match) {
		sbm_button.attr(\'name\', sbm_button.attr(\'name\').substr(0, sbm_button.attr(\'name\').length - 1) + \'.save_view]\');
		sbm_button.click();
	}
}
'; ?>

//]]>
</script>