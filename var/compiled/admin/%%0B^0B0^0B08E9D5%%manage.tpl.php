<?php /* Smarty version 2.6.18, created on 2011-11-28 11:47:42
         compiled from views/skin_selector/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'views/skin_selector/manage.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_customer_skin','templates_dir','text_admin_skin','templates_dir','skin_selector'));
?>

<?php ob_start(); ?>

<?php if (defined('DEVELOPMENT')): ?>
	<p class="no-items">Cart is in development mode now and skin selector is unavailable</div>
<?php else: ?>
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="skin_selector_form">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td valign="top" width="50%">
	<div class="form-field">
		<label for="customer_skin"><?php echo fn_get_lang_var('text_customer_skin', $this->getLanguage()); ?>
:</label>
		<select id="customer_skin" name="skin_data[customer]" onchange="$('#c_screenshot').attr('src', '<?php echo $__tpl_vars['config']['current_path']; ?>
/var/skins_repository/'+this.value+'/customer_screenshot.png');">
			<?php $_from_2313371840 = & $__tpl_vars['available_skins']; if (!is_array($_from_2313371840) && !is_object($_from_2313371840)) { settype($_from_2313371840, 'array'); }if (count($_from_2313371840)):
    foreach ($_from_2313371840 as $__tpl_vars['k'] => $__tpl_vars['s']):
?>
				<?php if ($__tpl_vars['s']['customer'] == 'Y'): ?>
					<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['settings']['skin_name_customer'] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['s']['description']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('templates_dir', $this->getLanguage()); ?>
:</label>
		<?php echo $__tpl_vars['customer_path']; ?>

		<div class="break">
			<img class="solid-border" width="300" id="c_screenshot" src="" />
		</div>
	</div></td>
	<td width="50%">
	<div class="form-field">
		<label for="admin_skin"><?php echo fn_get_lang_var('text_admin_skin', $this->getLanguage()); ?>
:</label>
		<select id="admin_skin" name="skin_data[admin]" onchange="$('#a_screenshot').attr('src', '<?php echo $__tpl_vars['config']['current_path']; ?>
/var/skins_repository/' + this.value + '/admin_screenshot.png');">
			<?php $_from_2313371840 = & $__tpl_vars['available_skins']; if (!is_array($_from_2313371840) && !is_object($_from_2313371840)) { settype($_from_2313371840, 'array'); }if (count($_from_2313371840)):
    foreach ($_from_2313371840 as $__tpl_vars['k'] => $__tpl_vars['s']):
?>
				<?php if ($__tpl_vars['s']['admin'] == 'Y'): ?>
					<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['settings']['skin_name_admin'] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['s']['description']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('templates_dir', $this->getLanguage()); ?>
:</label>
		<?php echo $__tpl_vars['admin_path']; ?>

		<div class="break">
			<img class="solid-border" width="300" id="a_screenshot" src="" />
		</div>
	</div></td>
</tr>
</table>


<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[skin_selector.update]",'but_role' => 'button_main')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<script type="text/javascript">
//<![CDATA[
	$('#c_screenshot').attr('src', '<?php echo $__tpl_vars['config']['current_path']; ?>
/var/skins_repository/' + $('#customer_skin').val() + '/customer_screenshot.png');
	$('#a_screenshot').attr('src', '<?php echo $__tpl_vars['config']['current_path']; ?>
/var/skins_repository/' + $('#admin_skin').val() + '/admin_screenshot.png');
//]]>
</script>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('skin_selector', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>