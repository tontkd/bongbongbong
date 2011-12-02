<?php /* Smarty version 2.6.18, created on 2011-12-01 22:19:10
         compiled from addons/discussion/views/discussion_manager/components/discussion.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 4, false),array('function', 'cycle', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 19, false),array('modifier', 'fn_get_discussion_posts', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 7, false),array('modifier', 'date_format', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 45, false),array('modifier', 'substr_count', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 82, false),array('modifier', 'replace', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 83, false),array('modifier', 'default', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 88, false),array('modifier', 'fn_check_view_permissions', 'addons/discussion/views/discussion_manager/components/discussion.tpl', 112, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('ip_address','rating','excellent','very_good','average','fair','poor','delete','disapprove','approve','approved','not_approved','no_data','delete_selected','choose_action','or','tools','add','add_post','general','name','your_rating','excellent','very_good','average','fair','poor','your_message','add','new_post'));
?>

<?php if ($__tpl_vars['discussion']): ?>
<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<div class="cm-hide-save-button" id="content_discussion">
<?php $this->assign('posts', fn_get_discussion_posts($__tpl_vars['discussion']['thread_id'], $__tpl_vars['_REQUEST']['page']), false); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="POST" class="cm-form-highlight" name="update_posts_form">
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
&amp;selected_section=discussion" />
<input type="hidden" name="selected_section" value="" />

<?php if ($__tpl_vars['posts']): ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('id' => 'pagination_discussion')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="posts-container">

<?php $_from_1575046092 = & $__tpl_vars['posts']; if (!is_array($_from_1575046092) && !is_object($_from_1575046092)) { settype($_from_1575046092, 'array'); }if (count($_from_1575046092)):
    foreach ($_from_1575046092 as $__tpl_vars['post']):
?>
<div class="<?php echo smarty_function_cycle(array('values' => "manage-row, "), $this);?>
 posts <?php if ($__tpl_vars['discussion']['object_type'] == 'O'): ?><?php if ($__tpl_vars['post']['user_id'] == $__tpl_vars['user_id']): ?>incoming<?php else: ?>outgoing<?php endif; ?><?php endif; ?>">
	<div class="clear">
		<div class="valign float-left">
			<input type="text" name="posts[<?php echo $__tpl_vars['post']['post_id']; ?>
][name]" value="<?php echo $__tpl_vars['post']['name']; ?>
" size="40" class="input-text valign strong" /><span class="valign">&nbsp;|&nbsp;<?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
:&nbsp;<?php echo $__tpl_vars['post']['ip_address']; ?>
</span>
		</div>
		<?php if ($__tpl_vars['discussion']['type'] == 'R' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<div class="float-right">

			<strong class="valign"><?php echo fn_get_lang_var('rating', $this->getLanguage()); ?>
:</strong>
			<select class="valign" name="posts[<?php echo $__tpl_vars['post']['post_id']; ?>
][rating_value]">
				<option value="5" <?php if ($__tpl_vars['post']['rating_value'] == '5'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('excellent', $this->getLanguage()); ?>
</option>
				<option value="4" <?php if ($__tpl_vars['post']['rating_value'] == '4'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('very_good', $this->getLanguage()); ?>
</option>
				<option value="3" <?php if ($__tpl_vars['post']['rating_value'] == '3'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('average', $this->getLanguage()); ?>
</option>
				<option value="2" <?php if ($__tpl_vars['post']['rating_value'] == '2'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('fair', $this->getLanguage()); ?>
</option>
				<option value="1" <?php if ($__tpl_vars['post']['rating_value'] == '1'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('poor', $this->getLanguage()); ?>
</option>
			</select>

		</div>
		<?php endif; ?>
	</div>

	<?php if ($__tpl_vars['discussion']['type'] == 'C' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<textarea name="posts[<?php echo $__tpl_vars['post']['post_id']; ?>
][message]" class="input-textarea-long" cols="80" rows="5"><?php echo $__tpl_vars['post']['message']; ?>
</textarea>
	<?php endif; ?>

<p>
	<span class="strong italic"><?php echo smarty_modifier_date_format($__tpl_vars['post']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format']).", ".($__tpl_vars['settings']['Appearance']['time_format'])); ?>
</span>
	&nbsp;-&nbsp;
	[&nbsp;&nbsp<span class="select-field"><input type="checkbox" name="delete_posts[<?php echo $__tpl_vars['post']['post_id']; ?>]" id="delete_checkbox_<?php echo $__tpl_vars['post']['post_id']; ?>"  class="checkbox cm-item" value="Y" /><label for="delete_checkbox_<?php echo $__tpl_vars['post']['post_id']; ?>"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?></label></span><?php if ($__tpl_vars['discussion']['object_type'] != 'O'): ?>|&nbsp;&nbsp;<span class="select-field"><input type="hidden" name="posts[<?php echo $__tpl_vars['post']['post_id']; ?>][status]" value="<?php echo $__tpl_vars['post']['status']; ?>" /><input type="checkbox" class="checkbox" name="posts[<?php echo $__tpl_vars['post']['post_id']; ?>][status]" id="dis_approve_post_<?php echo $__tpl_vars['post']['post_id']; ?>" value="<?php if ($__tpl_vars['post']['status'] == 'A'): ?>D<?php else: ?>A<?php endif; ?>" /><label for="dis_approve_post_<?php echo $__tpl_vars['post']['post_id']; ?>"><?php if ($__tpl_vars['post']['status'] == 'A'): ?><?php echo fn_get_lang_var('disapprove', $this->getLanguage()); ?><?php else: ?><?php echo fn_get_lang_var('approve', $this->getLanguage()); ?><?php endif; ?></label></span><?php endif; ?>]<?php if ($__tpl_vars['discussion']['object_type'] != 'O'): ?>&nbsp;-&nbsp;<?php if ($__tpl_vars['post']['status'] == 'A'): ?><span class="approved-text"><?php echo fn_get_lang_var('approved', $this->getLanguage()); ?><?php else: ?><span class="not-approved-text"><?php echo fn_get_lang_var('not_approved', $this->getLanguage()); ?><?php endif; ?></span><?php endif; ?>

</p>

</div>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('id' => 'pagination_discussion')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; ?>

<div class="buttons-container buttons-bg">
	<?php if ($__tpl_vars['posts']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[discussion.delete_posts]" class="cm-process-items cm-confirm" rev="update_posts_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[discussion.update_posts]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?>


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
	</div>
	<?php endif; ?>

	<div class="float-right">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_post','link_text' => fn_get_lang_var('add_post', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
</form>

<?php if (fn_check_view_permissions('discussion_manager')): ?>
	<?php ob_start(); ?>
	<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="POST" name="add_post_form" class="cm-form-highlight">
	<div class="object-container">
		<div class="tabs cm-j-tabs">
			<ul>
				<li id="tab_add_post" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
			</ul>
		</div>

		<div class="cm-tabs-content" id="content_tab_add_post">
		<input type ="hidden" name="post_data[thread_id]" value="<?php echo $__tpl_vars['discussion']['thread_id']; ?>
" />
		<input type ="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
&amp;selected_section=discussion" />

		<div class="form-field">
			<label for="post_data_name" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="post_data[name]" id="post_data_name" value="<?php if ($__tpl_vars['auth']['user_id']): ?><?php echo $__tpl_vars['user_info']['firstname']; ?>
 <?php echo $__tpl_vars['user_info']['lastname']; ?>
<?php endif; ?>" size="40" class="input-text-large main-input" />
		</div>

		<?php if ($__tpl_vars['discussion']['type'] == 'R' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<div class="form-field">
			<label for="rating_value"><?php echo fn_get_lang_var('your_rating', $this->getLanguage()); ?>
:</label>
			<select name="post_data[rating_value]" id="rating_value">
				<option value="5" selected="selected"><?php echo fn_get_lang_var('excellent', $this->getLanguage()); ?>
</option>
				<option value="4"><?php echo fn_get_lang_var('very_good', $this->getLanguage()); ?>
</option>
				<option value="3"><?php echo fn_get_lang_var('average', $this->getLanguage()); ?>
</option>
				<option value="2"><?php echo fn_get_lang_var('fair', $this->getLanguage()); ?>
</option>
				<option value="1"><?php echo fn_get_lang_var('poor', $this->getLanguage()); ?>
</option>
			</select>
		</div>
		<?php endif; ?>

		<?php if ($__tpl_vars['discussion']['type'] == 'C' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<div class="form-field">
			<label for="message"><?php echo fn_get_lang_var('your_message', $this->getLanguage()); ?>
:</label>
			<textarea name="post_data[message]" id="message" class="input-textarea-long" cols="70" rows="8"></textarea>
		</div>
		<?php endif; ?>
		</div>
	</div>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('add', $this->getLanguage()),'but_name' => "dispatch[discussion.add_post]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	</form>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_post','text' => fn_get_lang_var('new_post', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'act' => 'fake')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

</div>

<?php endif; ?>