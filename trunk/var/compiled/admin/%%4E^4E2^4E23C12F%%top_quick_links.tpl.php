<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:06
         compiled from top_quick_links.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('view_storefront'));
?>

<a href="<?php echo $__tpl_vars['config']['http_location']; ?>
" class="top-quick-links" target="_blank"><?php echo fn_get_lang_var('view_storefront', $this->getLanguage()); ?>
</a>&nbsp;&nbsp;|&nbsp;
<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=profiles.update&amp;user_id=<?php echo $__tpl_vars['auth']['user_id']; ?>
"><strong class="lowercase"><?php if ($__tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?><?php echo $__tpl_vars['user_info']['email']; ?>
<?php else: ?><?php echo $__tpl_vars['user_info']['user_login']; ?>
<?php endif; ?></strong></a>
(<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/sign_out.tpl", 'smarty_include_vars' => array('but_href' => ($__tpl_vars['index_script'])."?dispatch=auth.logout",'but_role' => 'text')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)