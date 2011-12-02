<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:18
         compiled from views/products/view.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/products/view.tpl', 3, false),array('function', 'block', 'views/products/view.tpl', 78, false),array('modifier', 'trim', 'views/products/view.tpl', 5, false),array('modifier', 'default', 'views/products/view.tpl', 19, false),array('modifier', 'unescape', 'views/products/view.tpl', 19, false),array('modifier', 'formatfilesize', 'views/products/view.tpl', 55, false),array('block', 'hook', 'views/products/view.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('filename','filesize','license','readme','download'));
?>

<?php echo smarty_function_script(array('src' => "js/exceptions.js"), $this);?>


<?php if ($__tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/products/view_main_info.override.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean();
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($__tpl_vars['addon_content'])): ?><?php echo $__tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:view_main_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="clear">
	<div class="product-image" id="product_images_<?php echo $__tpl_vars['product']['product_id']; ?>
">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_images.tpl", 'smarty_include_vars' => array('product' => $__tpl_vars['product'],'show_detailed_link' => 'Y')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div class="product-description product-details-options">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/buy_now.tpl", 'smarty_include_vars' => array('product' => $__tpl_vars['product'],'but_role' => 'action','show_qty' => true,'show_sku' => true,'obj_id' => $__tpl_vars['product']['product_id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>

<?php ob_start(); ?>

	<div id="content_description">
		<?php echo smarty_modifier_unescape(smarty_modifier_default(@$__tpl_vars['product']['full_description'], @$__tpl_vars['product']['short_description'])); ?>

	</div>

	<?php if ($__tpl_vars['product']['product_features']): ?>
	<div id="content_features">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_features.tpl", 'smarty_include_vars' => array('product_features' => $__tpl_vars['product']['product_features'],'details_page' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php endif; ?>

	<?php if ($__tpl_vars['files']): ?>
	<div id="content_files">
		<?php $__parent_tpl_vars = $__tpl_vars; ?>

<table cellspacing="1" cellpadding="5" class="table" width="30%">
<tr>
	<th><?php echo fn_get_lang_var('filename', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('filesize', $this->getLanguage()); ?>
</th>
</tr>
<?php $_from_2242064780 = & $__tpl_vars['files']; if (!is_array($_from_2242064780) && !is_object($_from_2242064780)) { settype($_from_2242064780, 'array'); }if (count($_from_2242064780)):
    foreach ($_from_2242064780 as $__tpl_vars['file']):
?>
<tr>
	<td width="80">
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=orders.get_file&file_id=<?php echo $__tpl_vars['file']['file_id']; ?>
&preview=Y"><strong><?php echo $__tpl_vars['file']['file_name']; ?>
</strong></a>
		<?php if ($__tpl_vars['file']['readme'] || $__tpl_vars['file']['license']): ?>
		<ul class="bullets-list">
		<?php if ($__tpl_vars['file']['license']): ?>
			<li><a onclick="$('#license_<?php echo $__tpl_vars['file']['file_id']; ?>
').toggle(); return false;"><?php echo fn_get_lang_var('license', $this->getLanguage()); ?>
</a></li>
			<div class="hidden" id="license_<?php echo $__tpl_vars['file']['file_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['file']['license']); ?>
</div>
		<?php endif; ?>
		<?php if ($__tpl_vars['file']['readme']): ?>
			<li><a onclick="$('#readme_<?php echo $__tpl_vars['file']['file_id']; ?>
').toggle(); return false;"><?php echo fn_get_lang_var('readme', $this->getLanguage()); ?>
</a></li>
			<div class="hidden" id="readme_<?php echo $__tpl_vars['file']['file_id']; ?>
"><?php echo smarty_modifier_unescape($__tpl_vars['file']['readme']); ?>
</div>
		<?php endif; ?>
		</ul>
		<?php endif; ?>
	</td>
	<td width="20%" valign="top">
		 <strong><?php echo smarty_modifier_formatfilesize($__tpl_vars['file']['file_size']); ?>
</strong>
	</td>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	<?php endif; ?>
	
	<?php $this->_tag_stack[] = array('hook', array('name' => "products:tabs_block")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['required_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/required_products/hooks/products/tabs_block.pre.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/products/tabs_block.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['attachments']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['attachments_data']): ?>
<div id="content_attachments">
<?php $_from_2777741670 = & $__tpl_vars['attachments_data']; if (!is_array($_from_2777741670) && !is_object($_from_2777741670)) { settype($_from_2777741670, 'array'); }if (count($_from_2777741670)):
    foreach ($_from_2777741670 as $__tpl_vars['file']):
?>
<p>
<?php echo $__tpl_vars['file']['description']; ?>
 (<?php echo $__tpl_vars['file']['filename']; ?>
, <?php echo smarty_modifier_formatfilesize($__tpl_vars['file']['filesize']); ?>
) [<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=attachments.getfile&attachment_id=<?php echo $__tpl_vars['file']['attachment_id']; ?>
"><?php echo fn_get_lang_var('download', $this->getLanguage()); ?>
</a>]
</p>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['send_to_friend']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/send_to_friend/hooks/products/tabs_block.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($__tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/products/tabs_block.post.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php if ($__tpl_vars['tab_blocks']): ?>
	<?php $_from_2364395662 = & $__tpl_vars['tab_blocks']; if (!is_array($_from_2364395662) && !is_object($_from_2364395662)) { settype($_from_2364395662, 'array'); }if (count($_from_2364395662)):
    foreach ($_from_2364395662 as $__tpl_vars['block']):
?>
	<div id="content_block_<?php echo $__tpl_vars['block']['block_id']; ?>
">
		<?php echo smarty_function_block(array('id' => $__tpl_vars['block']['block_id'],'template' => smarty_modifier_default(@$__tpl_vars['block']['properties']['appearances'], @$__tpl_vars['block']['properties']['list_object']),'no_box' => true), $this);?>

	</div>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $__tpl_vars['_REQUEST']['selected_section'], )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs clear cm-j-tabs">
	<ul <?php if ($__tpl_vars['tabs_section']): ?>id="tabs_<?php echo $__tpl_vars['tabs_section']; ?>
"<?php endif; ?>>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $__tpl_vars['tabs_section'] && ! $__tpl_vars['tab']['section'] ) || ( $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section'] )): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a<?php if ($__tpl_vars['tab']['href']): ?> href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content" id="tabs_content">
	<?php echo $__tpl_vars['content']; ?>

</div>

<?php if ($__tpl_vars['onclick']): ?>
<script>
	//<![CDATA[
	var hndl = <?php echo $__tpl_vars['ldelim']; ?>

		'tabs_<?php echo $__tpl_vars['tabs_section']; ?>
': <?php echo $__tpl_vars['onclick']; ?>

	<?php echo $__tpl_vars['rdelim']; ?>

	//]]>
</script>
<?php endif; ?>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php ob_start(); ?><?php echo smarty_modifier_unescape($__tpl_vars['product']['product']); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>