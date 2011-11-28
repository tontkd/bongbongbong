<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:58
         compiled from common_templates/pagination.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/pagination.tpl', 4, false),array('modifier', 'fn_query_remove', 'common_templates/pagination.tpl', 5, false),array('modifier', 'escape', 'common_templates/pagination.tpl', 35, false),array('modifier', 'substr_count', 'common_templates/pagination.tpl', 77, false),array('modifier', 'replace', 'common_templates/pagination.tpl', 78, false),array('function', 'script', 'common_templates/pagination.tpl', 9, false),array('function', 'math', 'common_templates/pagination.tpl', 71, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('go_to_page','go','go','previous','next','total_items','items_per_page','or','tools','add'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['pagination']): ?>
<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['div_id'], 'pagination_contents'), false); ?>
<?php $this->assign('qstring', fn_query_remove($_SERVER['QUERY_STRING'], 'page', 'result_ids'), false); ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if ($__tpl_vars['settings']['DHTML']['admin_ajax_based_pagination'] == 'Y' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "js/jquery.history.js"), $this);?>

	<?php endif; ?>
<div id="<?php echo $__tpl_vars['id']; ?>
">

<?php if ($__tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(smarty_modifier_default(@$__tpl_vars['search']['page'], @$__tpl_vars['_REQUEST']['page']), 1); ?>
" />
<?php endif; ?>

<?php if ($__tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
<?php endif; ?>

<?php endif; ?>

<?php if ($__tpl_vars['settings']['DHTML']['admin_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>
<?php endif; ?>
<?php if (! $__tpl_vars['disable_history']): ?>
	<?php $this->assign('history_class', " cm-history", false); ?>
<?php else: ?>
	<?php $this->assign('history_class', " cm-ajax-cache", false); ?>
<?php endif; ?>

<div class="pagination clear cm-pagination-wraper<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?> top-pagination<?php endif; ?>">
	<?php if ($__tpl_vars['pagination']['total_pages'] > 1): ?>
	<div class="float-left">
		<label><?php echo smarty_modifier_escape(fn_get_lang_var('go_to_page', $this->getLanguage()), 'html'); ?>
:</label>
		<input type="text" class="input-text-short valign cm-pagination<?php echo $__tpl_vars['history_class']; ?>
" value="<?php if ($__tpl_vars['_REQUEST']['page'] > $__tpl_vars['pagination']['total_pages']): ?>1<?php else: ?><?php echo smarty_modifier_default(@$__tpl_vars['_REQUEST']['page'], 1); ?>
<?php endif; ?>" />
		<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/pg_right_arrow.gif" class="pagination-go-button hand cm-pagination-button" alt="<?php echo smarty_modifier_escape(fn_get_lang_var('go', $this->getLanguage()), 'html'); ?>
" title="<?php echo smarty_modifier_escape(fn_get_lang_var('go', $this->getLanguage()), 'html'); ?>
" />
	</div>
	<?php endif; ?>

	<div class="float-right">
	<?php if ($__tpl_vars['pagination']['current_page'] != 'full_list' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<span class="lowercase"><a name="pagination" class="<?php if ($__tpl_vars['pagination']['prev_page']): ?><?php echo $__tpl_vars['ajax_class']; ?>
<?php endif; ?><?php echo $__tpl_vars['history_class']; ?>
" <?php if ($__tpl_vars['pagination']['prev_page']): ?>href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_page']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_page']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"<?php endif; ?>>&laquo;&nbsp;<?php echo fn_get_lang_var('previous', $this->getLanguage()); ?>
</a></span>

		<?php $_from_3143212386 = & $__tpl_vars['pagination']['navi_pages']; if (!is_array($_from_3143212386) && !is_object($_from_3143212386)) { settype($_from_3143212386, 'array'); }$this->_foreach['f_pg'] = array('total' => count($_from_3143212386), 'iteration' => 0);
if ($this->_foreach['f_pg']['total'] > 0):
    foreach ($_from_3143212386 as $__tpl_vars['pg']):
        $this->_foreach['f_pg']['iteration']++;
?>
			<?php if (($this->_foreach['f_pg']['iteration'] <= 1) && $__tpl_vars['pg'] > 1): ?>
			<a name="pagination" class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php echo $__tpl_vars['history_class']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=1" rel="1" rev="<?php echo $__tpl_vars['id']; ?>
">1</a>
			<?php if ($__tpl_vars['pg'] != 2): ?><a name="pagination" class="<?php if ($__tpl_vars['pagination']['prev_range']): ?><?php echo $__tpl_vars['ajax_class']; ?>
<?php endif; ?> prev-range<?php echo $__tpl_vars['history_class']; ?>
" <?php if ($__tpl_vars['pagination']['prev_range']): ?>href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"<?php endif; ?>>&nbsp;...&nbsp;</a><?php endif; ?>
			<?php endif; ?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['current_page']): ?><a name="pagination" class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php echo $__tpl_vars['history_class']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pg']; ?>
" rel="<?php echo $__tpl_vars['pg']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pg']; ?>
</a><?php else: ?><strong><?php echo $__tpl_vars['pg']; ?>
</strong><?php endif; ?>
			<?php if (($this->_foreach['f_pg']['iteration'] == $this->_foreach['f_pg']['total']) && $__tpl_vars['pg'] < $__tpl_vars['pagination']['total_pages']): ?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['total_pages']-1): ?><a name="pagination" class="<?php if ($__tpl_vars['pagination']['next_range']): ?><?php echo $__tpl_vars['ajax_class']; ?>
<?php endif; ?> next-range<?php echo $__tpl_vars['history_class']; ?>
" <?php if ($__tpl_vars['pagination']['next_range']): ?>href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"<?php endif; ?>>&nbsp;...&nbsp;</a><?php endif; ?><a name="pagination" class="<?php echo $__tpl_vars['ajax_class']; ?>
<?php echo $__tpl_vars['history_class']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['total_pages']; ?>
" rel="<?php echo $__tpl_vars['pagination']['total_pages']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pagination']['total_pages']; ?>
</a>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<span class="lowercase"><a name="pagination" class="<?php if ($__tpl_vars['pagination']['next_page']): ?><?php echo $__tpl_vars['ajax_class']; ?>
<?php endif; ?><?php echo $__tpl_vars['history_class']; ?>
" <?php if ($__tpl_vars['pagination']['next_page']): ?>href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_page']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_page']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('next', $this->getLanguage()); ?>
&nbsp;&raquo;</a></span>
	<?php endif; ?>
	<?php if ($__tpl_vars['pagination']): ?>
		<?php if ($__tpl_vars['pagination']['total_items']): ?>
			&nbsp;<?php echo fn_get_lang_var('total_items', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo $__tpl_vars['pagination']['total_items']; ?>
&nbsp;/</strong>
			
			<?php ob_start(); ?>
				<ul>
					<li class="strong"><?php echo fn_get_lang_var('items_per_page', $this->getLanguage()); ?>
:</li>
					<?php $this->assign('range_url', fn_query_remove($__tpl_vars['qstring'], 'items_per_page'), false); ?>
					<?php $_from_213804713 = & $__tpl_vars['pagination']['per_page_range']; if (!is_array($_from_213804713) && !is_object($_from_213804713)) { settype($_from_213804713, 'array'); }if (count($_from_213804713)):
    foreach ($_from_213804713 as $__tpl_vars['step']):
?>
						<li><a name="pagination" class="<?php echo $__tpl_vars['ajax_class']; ?>
" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['range_url']; ?>
&amp;items_per_page=<?php echo $__tpl_vars['step']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['step']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			<?php $this->_smarty_vars['capture']['pagination_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => "pagination_".($__tpl_vars['rnd']), 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['pagination_list'], 'display' => 'inline', 'link_text' => $__tpl_vars['pagination']['items_per_page'], 'override_meta' => "pagination-selector", )); ?>


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
		<?php endif; ?>
	<?php endif; ?>
	</div>
</div>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $__tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php endif; ?><?php  ob_end_flush();  ?>