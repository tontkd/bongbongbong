<?php /* Smarty version 2.6.18, created on 2011-11-28 13:18:55
         compiled from addons/send_to_friend/hooks/products/tabs_block.post.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'addons/send_to_friend/hooks/products/tabs_block.post.tpl', 29, false),array('modifier', 'fn_needs_image_verification', 'addons/send_to_friend/hooks/products/tabs_block.post.tpl', 35, false),array('modifier', 'uniqid', 'addons/send_to_friend/hooks/products/tabs_block.post.tpl', 40, false),array('modifier', 'replace', 'addons/send_to_friend/hooks/products/tabs_block.post.tpl', 77, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name_of_friend','email_of_friend','your_name','your_email','your_message','image_verification_body','send','delete','delete'));
?>
<?php  ob_start();  ?>
<div id="content_send_to_friend">
<form name="send_to_friend_form" action="<?php echo $__tpl_vars['index_script']; ?>
" method="post">
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
&amp;selected_section=send_to_friend" />

<div class="form-field">
	<label for="send_name"><?php echo fn_get_lang_var('name_of_friend', $this->getLanguage()); ?>
:</label>
	<input id="send_name" class="input-text" size="50" type="text" name="send_data[to_name]" value="<?php echo $__tpl_vars['send_data']['to_name']; ?>
" />
</div>

<div class="form-field">
	<label for="send_email" class="cm-required cm-email"><?php echo fn_get_lang_var('email_of_friend', $this->getLanguage()); ?>
:</label>
	<input id="send_email" class="input-text" size="50" type="text" name="send_data[to_email]" value="<?php echo $__tpl_vars['send_data']['to_email']; ?>
" />
</div>

<div class="form-field">
	<label for="send_yourname"><?php echo fn_get_lang_var('your_name', $this->getLanguage()); ?>
:</label>
	<input id="send_yourname" size="50" class="input-text" type="text" name="send_data[from_name]" value="<?php if ($__tpl_vars['send_data']['from_name']): ?><?php echo $__tpl_vars['send_data']['from_name']; ?>
<?php elseif ($__tpl_vars['auth']['user_id']): ?><?php echo $__tpl_vars['user_info']['firstname']; ?>
 <?php echo $__tpl_vars['user_info']['lastname']; ?>
<?php endif; ?>" />
</div>

<div class="form-field">
	<label for="send_youremail" class="cm-email"><?php echo fn_get_lang_var('your_email', $this->getLanguage()); ?>
:</label>
	<input id="send_youremail" class="input-text" size="50" type="text" name="send_data[from_email]" value="<?php if ($__tpl_vars['send_data']['from_email']): ?><?php echo $__tpl_vars['send_data']['from_email']; ?>
<?php elseif ($__tpl_vars['auth']['user_id']): ?><?php echo $__tpl_vars['user_info']['email']; ?>
<?php endif; ?>" />
</div>

<div class="form-field">
	<label for="send_notes" class="cm-required"><?php echo fn_get_lang_var('your_message', $this->getLanguage()); ?>
:</label>
	<textarea id="send_notes"  class="input-textarea" rows="5" cols="72" name="send_data[notes]"><?php if ($__tpl_vars['send_data']['notes']): ?><?php echo $__tpl_vars['send_data']['notes']; ?>
<?php else: ?><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
<?php endif; ?></textarea>
</div>

<?php if ($__tpl_vars['settings']['Image_verification']['use_for_send_to_friend'] == 'Y'): ?>
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('id' => 'send_to_friend', 'align' => 'left', )); ?>

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
	<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('send', $this->getLanguage()), 'but_name' => "dispatch[send_to_friend.send]", )); ?>

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
</div>
<?php  ob_end_flush();  ?>