<?php /* Smarty version 2.6.18, created on 2011-12-06 01:34:16
         compiled from addons/discussion/views/discussion/view.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_discussion_rating', 'addons/discussion/views/discussion/view.tpl', 1, false),array('modifier', 'fn_get_discussion', 'addons/discussion/views/discussion/view.tpl', 5, false),array('modifier', 'fn_get_discussion_posts', 'addons/discussion/views/discussion/view.tpl', 15, false),array('modifier', 'default', 'addons/discussion/views/discussion/view.tpl', 20, false),array('modifier', 'fn_query_remove', 'addons/discussion/views/discussion/view.tpl', 38, false),array('modifier', 'escape', 'addons/discussion/views/discussion/view.tpl', 38, false),array('modifier', 'date_format', 'addons/discussion/views/discussion/view.tpl', 85, false),array('modifier', 'nl2br', 'addons/discussion/views/discussion/view.tpl', 89, false),array('modifier', 'strpos', 'addons/discussion/views/discussion/view.tpl', 149, false),array('modifier', 'fn_needs_image_verification', 'addons/discussion/views/discussion/view.tpl', 186, false),array('modifier', 'uniqid', 'addons/discussion/views/discussion/view.tpl', 191, false),array('modifier', 'replace', 'addons/discussion/views/discussion/view.tpl', 228, false),array('function', 'script', 'addons/discussion/views/discussion/view.tpl', 23, false),array('function', 'cycle', 'addons/discussion/views/discussion/view.tpl', 71, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('navi_pages','navi_pages','no_posts_found','new_post','your_name','your_rating','excellent','very_good','average','fair','poor','your_message','image_verification_body','submit','delete','delete'));
?>

<div id="content_discussion">

<?php $this->assign('discussion', fn_get_discussion($__tpl_vars['object_id'], $__tpl_vars['object_type']), false); ?>

<?php if ($__tpl_vars['discussion'] && $__tpl_vars['discussion']['type'] != 'D'): ?>

<?php if ($__tpl_vars['wrap'] == true): ?>
<p>&nbsp;</p>
<?php ob_start(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $__tpl_vars['title'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $this->assign('posts', fn_get_discussion_posts($__tpl_vars['discussion']['thread_id'], $__tpl_vars['_REQUEST']['page']), false); ?>

<?php if ($__tpl_vars['posts']): ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => "pagination_contents_comments_".($__tpl_vars['object_id']), )); ?>

<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "js/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $__tpl_vars['id']; ?>
">
	
	<?php if ($__tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['page'], @$__tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>
	
	<?php if ($__tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if ($__tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php $this->assign('qstring', smarty_modifier_escape(fn_query_remove($_SERVER['QUERY_STRING'], 'page', 'result_ids')), false); ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
		<?php $this->assign('ajax_class', "cm-ajax", false); ?>
	<?php endif; ?>
	
	<div class="pagination cm-pagination-wraper center">
		<?php echo fn_get_lang_var('navi_pages', $this->getLanguage()); ?>
:&nbsp;&nbsp;
	
		<?php if ($__tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	
		<?php $_from_3143212386 = & $__tpl_vars['pagination']['navi_pages']; if (!is_array($_from_3143212386) && !is_object($_from_3143212386)) { settype($_from_3143212386, 'array'); }if (count($_from_3143212386)):
    foreach ($_from_3143212386 as $__tpl_vars['pg']):
?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pg']; ?>
" rel="<?php echo $__tpl_vars['pg']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<strong class="pagination-selected-page"><?php echo $__tpl_vars['pg']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	
		<?php if ($__tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $__tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $_from_1575046092 = & $__tpl_vars['posts']; if (!is_array($_from_1575046092) && !is_object($_from_1575046092)) { settype($_from_1575046092, 'array'); }if (count($_from_1575046092)):
    foreach ($_from_1575046092 as $__tpl_vars['post']):
?>
<div class="posts<?php echo smarty_function_cycle(array('values' => ", manage-post"), $this);?>
">
	<div class="clear">
		<?php if ($__tpl_vars['discussion']['type'] == 'R' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<div class="float-left">
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('stars' => fn_get_discussion_rating($__tpl_vars['post']['rating_value']), )); ?>

<p class="nowrap stars">
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
.gif" width="16" height="15" alt="" /><?php endif; ?>
<?php unset($this->_sections['full_star']);
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
/icons/star_empty.gif" width="16" height="15" alt="" /><?php endfor; endif; ?>
</p><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
		<?php endif; ?>
		<div class="float-right">
			<em><?php echo smarty_modifier_date_format($__tpl_vars['post']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
</em>
		</div>
	</div>
	
	<?php if ($__tpl_vars['discussion']['type'] == 'C' || $__tpl_vars['discussion']['type'] == 'B'): ?><p class="post-message">"<?php echo smarty_modifier_nl2br($__tpl_vars['post']['message']); ?>
"</p><?php endif; ?>
	<p class="post-author">&ndash; <?php echo $__tpl_vars['post']['name']; ?>
</p>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => "pagination_contents_comments_".($__tpl_vars['object_id']), )); ?>

<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' && $__tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "js/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $__tpl_vars['id']; ?>
">
	
	<?php if ($__tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$__tpl_vars['search']['page'], @$__tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>
	
	<?php if ($__tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
	
	<?php endif; ?>
	
	<?php if ($__tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php $this->assign('qstring', smarty_modifier_escape(fn_query_remove($_SERVER['QUERY_STRING'], 'page', 'result_ids')), false); ?>
	<?php if ($__tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
		<?php $this->assign('ajax_class', "cm-ajax", false); ?>
	<?php endif; ?>
	
	<div class="pagination cm-pagination-wraper center">
		<?php echo fn_get_lang_var('navi_pages', $this->getLanguage()); ?>
:&nbsp;&nbsp;
	
		<?php if ($__tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['prev_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	
		<?php $_from_3143212386 = & $__tpl_vars['pagination']['navi_pages']; if (!is_array($_from_3143212386) && !is_object($_from_3143212386)) { settype($_from_3143212386, 'array'); }if (count($_from_3143212386)):
    foreach ($_from_3143212386 as $__tpl_vars['pg']):
?>
			<?php if ($__tpl_vars['pg'] != $__tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pg']; ?>
" rel="<?php echo $__tpl_vars['pg']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
"><?php echo $__tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<strong class="pagination-selected-page"><?php echo $__tpl_vars['pg']; ?>
</strong>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	
		<?php if ($__tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $__tpl_vars['qstring']; ?>
&amp;page=<?php echo $__tpl_vars['pagination']['next_range']; ?>
" rel="<?php echo $__tpl_vars['pagination']['next_range']; ?>
" class="cm-history <?php echo $__tpl_vars['ajax_class']; ?>
" rev="<?php echo $__tpl_vars['id']; ?>
">...</a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $__tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php else: ?>
<p class="no-items"><?php echo fn_get_lang_var('no_posts_found', $this->getLanguage()); ?>
</p>
<?php endif; ?>

<?php if (strpos('CRB', $__tpl_vars['discussion']['type']) !== false): ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('new_post', $this->getLanguage()))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="add_post_form">
<input type ="hidden" name="post_data[thread_id]" value="<?php echo $__tpl_vars['discussion']['thread_id']; ?>
" />
<input type ="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
<input type="hidden" name="selected_section" value="" />

<div class="form-field">
	<label for="dsc_name" class="cm-required"><?php echo fn_get_lang_var('your_name', $this->getLanguage()); ?>
:</label>
	<input type="text" id="dsc_name" name="post_data[name]" value="<?php if ($__tpl_vars['auth']['user_id']): ?><?php echo $__tpl_vars['user_info']['firstname']; ?>
 <?php echo $__tpl_vars['user_info']['lastname']; ?>
<?php elseif ($__tpl_vars['discussion']['post_data']['name']): ?><?php echo $__tpl_vars['discussion']['post_data']['name']; ?>
<?php endif; ?>" size="50" class="input-text" />
</div>

<?php if ($__tpl_vars['discussion']['type'] == 'R' || $__tpl_vars['discussion']['type'] == 'B'): ?>
<div class="form-field">

	<label for="dsc_rating" class="cm-required"><?php echo fn_get_lang_var('your_rating', $this->getLanguage()); ?>
:</label>
	<select id="dsc_rating" name="post_data[rating_value]">
		<option value="5" selected="selected"><?php echo fn_get_lang_var('excellent', $this->getLanguage()); ?>
</option>
		<option value="4" <?php if ($__tpl_vars['discussion']['post_data']['rating_value'] == '4'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('very_good', $this->getLanguage()); ?>
</option>
		<option value="3" <?php if ($__tpl_vars['discussion']['post_data']['rating_value'] == '3'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('average', $this->getLanguage()); ?>
</option>
		<option value="2" <?php if ($__tpl_vars['discussion']['post_data']['rating_value'] == '2'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('fair', $this->getLanguage()); ?>
</option>
		<option value="1" <?php if ($__tpl_vars['discussion']['post_data']['rating_value'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('poor', $this->getLanguage()); ?>
</option>
	</select>
</div>
<?php endif; ?>

<?php if ($__tpl_vars['discussion']['type'] == 'C' || $__tpl_vars['discussion']['type'] == 'B'): ?>
<div class="form-field">
	<label for="dsc_message" class="cm-required"><?php echo fn_get_lang_var('your_message', $this->getLanguage()); ?>
:</label>
	<textarea id="dsc_message" name="post_data[message]" class="input-textarea" rows="5" cols="72"><?php echo $__tpl_vars['discussion']['post_data']['message']; ?>
</textarea>
</div>
<?php endif; ?>

<?php if ($__tpl_vars['settings']['Image_verification']['use_for_discussion'] == 'Y'): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => 'discussion', )); ?>

<?php if (fn_needs_image_verification("") == true): ?>

<p<?php if ($__tpl_vars['align']): ?> class="<?php echo $__tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>

<?php if ($__tpl_vars['sidebox']): ?>
	<p><img id="verification_image_<?php echo $__tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo $__tpl_vars['config']['current_location']; ?>
/<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.captcha&amp;verification_id=<?php echo $__tpl_vars['SESS_ID']; ?>
:<?php echo $__tpl_vars['id']; ?>
&amp;<?php echo uniqid($__tpl_vars['id']); ?>
&amp;" alt="" onclick="this.src += 'reload' ;" /></p>
<?php endif; ?>

<p><input class="captcha-input-text valign" type="text" name="verification_answer" value= "" />
	<?php if (! $__tpl_vars['sidebox']): ?>
	<img id="verification_image_<?php echo $__tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo $__tpl_vars['config']['current_location']; ?>
/<?php echo $__tpl_vars['index_script']; ?>
?dispatch=image.captcha&amp;verification_id=<?php echo $__tpl_vars['SESS_ID']; ?>
:<?php echo $__tpl_vars['id']; ?>
&amp;<?php echo uniqid($__tpl_vars['id']); ?>
&amp;" alt="" onclick="this.src += 'reload' ;" />
	<?php endif; ?></p>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<div class="buttons-container">
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('submit', $this->getLanguage()), 'but_name' => "dispatch[discussion.add_post]", )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

</form>

<?php endif; ?>

<?php if ($__tpl_vars['wrap'] == true): ?>
	<?php $this->_smarty_vars['capture']['content'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['content'], )); ?>

<div class="border">
	<div class="subheaders-group"><?php echo smarty_modifier_default(@$__tpl_vars['content'], "&nbsp;"); ?>
</div>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php else: ?>
	<?php ob_start(); ?><?php echo $__tpl_vars['title']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php endif; ?>
</div>
