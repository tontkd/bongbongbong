<?php /* Smarty version 2.6.18, created on 2011-11-30 23:29:35
         compiled from addons/discussion/hooks/index/extra.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'addons/discussion/hooks/index/extra.post.tpl', 21, false),array('modifier', 'fn_check_view_permissions', 'addons/discussion/hooks/index/extra.post.tpl', 61, false),array('modifier', 'default', 'addons/discussion/hooks/index/extra.post.tpl', 64, false),array('modifier', 'truncate', 'addons/discussion/hooks/index/extra.post.tpl', 82, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('latest_reviews','hide','hide','close','close','edit','remove_this_item','remove_this_item','comment_by','ip_address','no_items'));
?>

<div class="statistics-box communication">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('title' => fn_get_lang_var('latest_reviews', $this->getLanguage()), )); ?>

<h2>
	<span class="float-right hidden">
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $__tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body">
	<?php if ($__tpl_vars['latest_posts']): ?>
	<div id="stats_discussion">
	<?php $_from_2909489616 = & $__tpl_vars['latest_posts']; if (!is_array($_from_2909489616) && !is_object($_from_2909489616)) { settype($_from_2909489616, 'array'); }if (count($_from_2909489616)):
    foreach ($_from_2909489616 as $__tpl_vars['post']):
?>
	<?php $this->assign('o_type', $__tpl_vars['post']['object_type'], false); ?>
	<?php $this->assign('object_name', $__tpl_vars['discussion_objects'][$__tpl_vars['o_type']], false); ?>
	<?php $this->assign('review_name', "discussion_title_".($__tpl_vars['object_name']), false); ?>
	<div class="<?php echo smarty_function_cycle(array('values' => " ,manage-post"), $this);?>
 posts">
		<div class="clear">
			<?php if ($__tpl_vars['post']['type'] == 'R' || $__tpl_vars['post']['type'] == 'B'): ?>
				<div class="float-left">
					<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('stars' => $__tpl_vars['post']['rating'], )); ?>

<?php unset($this->_sections['full_star']);
$this->_sections['full_star']['name'] = 'full_star';
$this->_sections['full_star']['loop'] = is_array($_loop=$__tpl_vars['stars']['full']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_star']['show'] = true;
$this->_sections['full_star']['max'] = $this->_sections['full_star']['loop'];
$this->_sections['full_star']['step'] = 1;
$this->_sections['full_star']['start'] = $this->_sections['full_star']['step'] > 0 ? 0 : $this->_sections['full_star']['loop']-1;
if ($this->_sections['full_star']['show']) {
    $this->_sections['full_star']['total'] = $this->_sections['full_star']['loop'];
    if ($this->_sections['full_star']['total'] == 0)
        $this->_sections['full_star']['show'] = false;
} else
    $this->_sections['full_star']['total'] = 0;
if ($this->_sections['full_star']['show']):

            for ($this->_sections['full_star']['index'] = $this->_sections['full_star']['start'], $this->_sections['full_star']['iteration'] = 1;
                 $this->_sections['full_star']['iteration'] <= $this->_sections['full_star']['total'];
                 $this->_sections['full_star']['index'] += $this->_sections['full_star']['step'], $this->_sections['full_star']['iteration']++):
$this->_sections['full_star']['rownum'] = $this->_sections['full_star']['iteration'];
$this->_sections['full_star']['index_prev'] = $this->_sections['full_star']['index'] - $this->_sections['full_star']['step'];
$this->_sections['full_star']['index_next'] = $this->_sections['full_star']['index'] + $this->_sections['full_star']['step'];
$this->_sections['full_star']['first']      = ($this->_sections['full_star']['iteration'] == 1);
$this->_sections['full_star']['last']       = ($this->_sections['full_star']['iteration'] == $this->_sections['full_star']['total']);
?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_full.gif" width="16" height="15" alt="*" /><?php endfor; endif; ?>
<?php if ($__tpl_vars['stars']['part']): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_<?php echo $__tpl_vars['stars']['part']; ?>
.gif" width="16" height="15" alt="X" /><?php endif; ?><?php unset($this->_sections['full_star']);
$this->_sections['full_star']['name'] = 'full_star';
$this->_sections['full_star']['loop'] = is_array($_loop=$__tpl_vars['stars']['empty']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_star']['show'] = true;
$this->_sections['full_star']['max'] = $this->_sections['full_star']['loop'];
$this->_sections['full_star']['step'] = 1;
$this->_sections['full_star']['start'] = $this->_sections['full_star']['step'] > 0 ? 0 : $this->_sections['full_star']['loop']-1;
if ($this->_sections['full_star']['show']) {
    $this->_sections['full_star']['total'] = $this->_sections['full_star']['loop'];
    if ($this->_sections['full_star']['total'] == 0)
        $this->_sections['full_star']['show'] = false;
} else
    $this->_sections['full_star']['total'] = 0;
if ($this->_sections['full_star']['show']):

            for ($this->_sections['full_star']['index'] = $this->_sections['full_star']['start'], $this->_sections['full_star']['iteration'] = 1;
                 $this->_sections['full_star']['iteration'] <= $this->_sections['full_star']['total'];
                 $this->_sections['full_star']['index'] += $this->_sections['full_star']['step'], $this->_sections['full_star']['iteration']++):
$this->_sections['full_star']['rownum'] = $this->_sections['full_star']['iteration'];
$this->_sections['full_star']['index_prev'] = $this->_sections['full_star']['index'] - $this->_sections['full_star']['step'];
$this->_sections['full_star']['index_next'] = $this->_sections['full_star']['index'] + $this->_sections['full_star']['step'];
$this->_sections['full_star']['first']      = ($this->_sections['full_star']['iteration'] == 1);
$this->_sections['full_star']['last']       = ($this->_sections['full_star']['iteration'] == $this->_sections['full_star']['total']);
?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_empty.gif" width="16" height="15" alt="o" /><?php endfor; endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				</div>
			<?php endif; ?>
			
			<div class="float-right">
			<a class="tool-link valign" href="<?php echo $__tpl_vars['post']['object_data']['url']; ?>
"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_role' => 'delete_item', 'but_href' => ($__tpl_vars['index_script'])."?dispatch=index.delete_post&amp;post_id=".($__tpl_vars['post']['post_id']), 'but_meta' => "cm-ajax cm-confirm", 'but_rev' => 'stats_discussion', )); ?>

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
			</div>
			
			<?php echo fn_get_lang_var($__tpl_vars['object_name'], $this->getLanguage()); ?>
:&nbsp;<a href="<?php echo $__tpl_vars['post']['object_data']['url']; ?>
"><?php echo smarty_modifier_truncate($__tpl_vars['post']['object_data']['description'], 70); ?>
</a>
			<span class="lowercase">&nbsp;<?php echo fn_get_lang_var('comment_by', $this->getLanguage()); ?>
</span>&nbsp;<?php echo $__tpl_vars['post']['name']; ?>

		</div>
	
		<?php if ($__tpl_vars['post']['type'] == 'C' || $__tpl_vars['post']['type'] == 'B'): ?>
			<div class="scroll-x"><?php echo $__tpl_vars['post']['message']; ?>
</div>
		<?php endif; ?>
		
		<div class="clear">
		<div class="float-left"><strong><?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
:</strong>&nbsp;<?php echo $__tpl_vars['post']['ip_address']; ?>
</div>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/views/index/components/dashboard_status.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
	<?php endforeach; endif; unset($_from); ?>
	<!--stats_discussion--></div>
	<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>
	<?php endif; ?>
	</div>
</div>