<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:17
         compiled from blocks/my_account.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'blocks/my_account.tpl', 10, false),array('modifier', 'escape', 'blocks/my_account.tpl', 15, false),array('modifier', 'default', 'blocks/my_account.tpl', 25, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('profile_details','downloads','sign_in','register','orders','my_tags','return_requests','my_points','wishlist','sign_out','track_my_order','track_my_order','order_id','order_id','email','go'));
?>
<?php  ob_start();  ?>
<!--dynamic:my_account-->
<?php if ($__tpl_vars['auth']['user_id']): ?>
<strong><?php echo $__tpl_vars['user_info']['firstname']; ?>
 <?php echo $__tpl_vars['user_info']['lastname']; ?>
</strong>
<?php endif; ?>

<ul class="arrows-list">
<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:my_account_menu")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($__tpl_vars['auth']['user_id']): ?>
		<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update" class="underlined"><?php echo fn_get_lang_var('profile_details', $this->getLanguage()); ?>
</a></li>
		<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.downloads" class="underlined"><?php echo fn_get_lang_var('downloads', $this->getLanguage()); ?>
</a></li>
	<?php else: ?>
		<li><a href="<?php if ($__tpl_vars['controller'] == 'auth' && $__tpl_vars['mode'] == 'login_form'): ?><?php echo $__tpl_vars['config']['current_url']; ?>
<?php else: ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.login_form&amp;return_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
<?php endif; ?>" class="underlined"><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
</a> / <a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.add" class="underlined"><?php echo fn_get_lang_var('register', $this->getLanguage()); ?>
</a></li>
	<?php endif; ?>
	<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.search" class="underlined"><?php echo fn_get_lang_var('orders', $this->getLanguage()); ?>
</a></li>
<?php if ($__tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=tags.summary" class="underlined"><?php echo fn_get_lang_var('my_tags', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=rma.returns" class="underlined"><?php echo fn_get_lang_var('return_requests', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['auth']['user_id']): ?>
<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=reward_points.userlog" class="underlined"><?php echo fn_get_lang_var('my_points', $this->getLanguage()); ?>
:&nbsp;<strong><?php echo smarty_modifier_default(@$__tpl_vars['user_info']['points'], '0'); ?>
</strong></a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=wishlist.view" class="underlined"><?php echo fn_get_lang_var('wishlist', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($__tpl_vars['auth']['user_id']): ?>
		<li class="delim"></li>
		<li><a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=auth.logout&amp;redirect_url=<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
" class="underlined"><?php echo fn_get_lang_var('sign_out', $this->getLanguage()); ?>
</a></li>
<?php endif; ?>
</ul>

<div class="updates-wrapper">

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="get" name="track_order_quick">

<p><?php echo fn_get_lang_var('track_my_order', $this->getLanguage()); ?>
:</p>

<div class="form-field">
<label for="track_order_item" class="cm-required hidden"><?php echo fn_get_lang_var('track_my_order', $this->getLanguage()); ?>
:</label>
<?php if ($__tpl_vars['auth']['user_id']): ?><?php $this->assign('_mode', 'details', false); ?><input type="text" size="20" class="input-text cm-hint" id="track_order_item" name="order_id" value="<?php echo smarty_modifier_escape(fn_get_lang_var('order_id', $this->getLanguage()), 'html'); ?>" /><?php else: ?><?php $this->assign('_mode', 'track_request', false); ?><input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>" /><input type="text" size="20" class="input-text cm-hint" id="track_order_item" name="track_data" value="<?php echo smarty_modifier_escape(fn_get_lang_var('order_id', $this->getLanguage()), 'html'); ?>/<?php echo smarty_modifier_escape(fn_get_lang_var('email', $this->getLanguage()), 'html'); ?>" /><?php endif; ?><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_name' => "orders.".($__tpl_vars['_mode']), 'alt' => fn_get_lang_var('go', $this->getLanguage()), )); ?><input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>/icons/go.gif" alt="<?php echo $__tpl_vars['alt']; ?>" title="<?php echo $__tpl_vars['alt']; ?>" class="go-button" /><input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>

</form>

</div>
<!--/dynamic--><?php  ob_end_flush();  ?>