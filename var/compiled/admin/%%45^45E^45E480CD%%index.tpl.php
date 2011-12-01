<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:05
         compiled from index.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'index.tpl', 32, false),array('modifier', 'defined', 'index.tpl', 38, false),array('modifier', 'escape', 'index.tpl', 49, false),array('modifier', 'fn_query_remove', 'index.tpl', 128, false),array('modifier', 'strpos', 'index.tpl', 129, false),array('modifier', 'fn_link_attach', 'index.tpl', 139, false),array('modifier', 'fn_get_notifications', 'index.tpl', 165, false),array('modifier', 'lower', 'index.tpl', 167, false),array('modifier', 'default', 'index.tpl', 187, false),array('modifier', 'unescape', 'index.tpl', 187, false),array('function', 'script', 'index.tpl', 43, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('admin_panel','cannot_buy','no_products_selected','error_no_items_selected','delete_confirmation','text_out_of_stock','items','text_required_group_product','save','close','loading','notice','warning','error','text_are_you_sure_to_proceed','text_invalid_url','error_validator_email','error_validator_confirm_email','error_validator_phone','error_validator_integer','error_validator_multiple','error_validator_password','error_validator_required','error_validator_zipcode','error_validator_message','text_page_loading','loading','close','close'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php $__parent_tpl_vars = $__tpl_vars; ?>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo @CHARSET; ?>
" />
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<title><?php if ($__tpl_vars['page_title']): ?><?php echo $__tpl_vars['page_title']; ?><?php else: ?><?php if ($__tpl_vars['navigation']['selected_tab']): ?><?php echo fn_get_lang_var($__tpl_vars['navigation']['selected_tab'], $this->getLanguage()); ?><?php if ($__tpl_vars['navigation']['subsection']): ?> :: <?php echo fn_get_lang_var($__tpl_vars['navigation']['subsection'], $this->getLanguage()); ?><?php endif; ?> - <?php endif; ?><?php echo fn_get_lang_var('admin_panel', $this->getLanguage()); ?><?php endif; ?></title>


<link href="<?php echo $__tpl_vars['images_dir']; ?>
/icons/favicon.ico" rel="shortcut icon" />
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('include_file_tree' => true, )); ?>

<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/styles.css" rel="stylesheet" type="text/css" />
<?php if ($__tpl_vars['include_file_tree']): ?>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/jqueryFileTree.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!--[if lte IE 7]>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/custom_styles.css" rel="stylesheet" type="text/css" />
<?php $this->_tag_stack[] = array('hook', array('name' => "index:styles")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['magicslideshow']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?><?php echo '
<style type="text/css">
#tabs_content_magicslideshow .form-field { padding: 6px 5px 6px 250px !important; }
#tabs_content_magicslideshow .form-field > label { margin-left: -250px !important; width: 240px !important;}
</style>
'; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php if (defined('TRANSLATION_MODE')): ?>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/design_mode.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php echo smarty_function_script(array('src' => "lib/jquery/jquery.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/core.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/ajax.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/jquery.easydrag.js"), $this);?>

<script type="text/javascript">
//<![CDATA[
	var index_script = '<?php echo smarty_modifier_escape($__tpl_vars['index_script'], 'javascript'); ?>
';

	var lang = <?php echo $__tpl_vars['ldelim']; ?>

		cannot_buy: '<?php echo smarty_modifier_escape(fn_get_lang_var('cannot_buy', $this->getLanguage()), 'javascript'); ?>
',
		no_products_selected: '<?php echo smarty_modifier_escape(fn_get_lang_var('no_products_selected', $this->getLanguage()), 'javascript'); ?>
',
		error_no_items_selected: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_no_items_selected', $this->getLanguage()), 'javascript'); ?>
',
		delete_confirmation: '<?php echo smarty_modifier_escape(fn_get_lang_var('delete_confirmation', $this->getLanguage()), 'javascript'); ?>
',
		text_out_of_stock: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_out_of_stock', $this->getLanguage()), 'javascript'); ?>
',
		items: '<?php echo smarty_modifier_escape(fn_get_lang_var('items', $this->getLanguage()), 'javascript'); ?>
',
		text_required_group_product: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_required_group_product', $this->getLanguage()), 'javascript'); ?>
',
		save: '<?php echo smarty_modifier_escape(fn_get_lang_var('save', $this->getLanguage()), 'javascript'); ?>
',
		close: '<?php echo smarty_modifier_escape(fn_get_lang_var('close', $this->getLanguage()), 'javascript'); ?>
',
		loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('loading', $this->getLanguage()), 'javascript'); ?>
',
		notice: '<?php echo smarty_modifier_escape(fn_get_lang_var('notice', $this->getLanguage()), 'javascript'); ?>
',
		warning: '<?php echo smarty_modifier_escape(fn_get_lang_var('warning', $this->getLanguage()), 'javascript'); ?>
',
		error: '<?php echo smarty_modifier_escape(fn_get_lang_var('error', $this->getLanguage()), 'javascript'); ?>
',
		text_are_you_sure_to_proceed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_are_you_sure_to_proceed', $this->getLanguage()), 'javascript'); ?>
',
		text_invalid_url: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_invalid_url', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_email: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_email', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_confirm_email: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_confirm_email', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_phone: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_phone', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_integer: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_integer', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_multiple: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_multiple', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_password: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_password', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_required: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_required', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_zipcode: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_zipcode', $this->getLanguage()), 'javascript'); ?>
',
		error_validator_message: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_message', $this->getLanguage()), 'javascript'); ?>
',
		text_page_loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_page_loading', $this->getLanguage()), 'javascript'); ?>
'
	<?php echo $__tpl_vars['rdelim']; ?>


	var warning_mark = "&lt;&lt;";
	var currencies = <?php echo $__tpl_vars['ldelim']; ?>

		'primary': <?php echo $__tpl_vars['ldelim']; ?>

			'decimals_separator': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['decimals_separator'], 'javascript'); ?>
',
			'thousands_separator': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['thousands_separator'], 'javascript'); ?>
',
			'decimals': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['decimals'], 'javascript'); ?>
'
		<?php echo $__tpl_vars['rdelim']; ?>
,
		'secondary': <?php echo $__tpl_vars['ldelim']; ?>

			'decimals_separator': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['secondary_currency']]['decimals_separator'], 'javascript'); ?>
',
			'thousands_separator': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['secondary_currency']]['thousands_separator'], 'javascript'); ?>
',
			'decimals': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['secondary_currency']]['decimals'], 'javascript'); ?>
',
			'coefficient': '<?php echo $__tpl_vars['currencies'][$__tpl_vars['secondary_currency']]['coefficient']; ?>
'
		<?php echo $__tpl_vars['rdelim']; ?>

	<?php echo $__tpl_vars['rdelim']; ?>

	var current_path = '<?php echo smarty_modifier_escape($__tpl_vars['config']['current_path'], 'javascript'); ?>
';
	var images_dir = '<?php echo $__tpl_vars['images_dir']; ?>
';
	var cart_language = '<?php echo @CART_LANGUAGE; ?>
';
	var cart_prices_w_taxes = <?php if (( $__tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] == 'Y' )): ?>true<?php else: ?>false<?php endif; ?>;
	var translate_mode = <?php if (defined('TRANSLATION_MODE')): ?>true<?php else: ?>false<?php endif; ?>;
	var iframe_urls = new Array();
	var iframe_extra = new Array();
	var control_buttons_container, control_buttons_floating;
	var regexp = new Array();
	$(document).ready(function()<?php echo $__tpl_vars['ldelim']; ?>

		jQuery.runCart('A');
	<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:scripts")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['magicslideshow']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($__tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php echo smarty_function_script(array('src' => "addons/banners/js/func.js"), $this);?>

<script type="text/javascript">

// Extend core function
fn_register_hooks('banners', ['add_js_item']);

</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</head>

<body>
<?php if (defined('SKINS_PANEL')): ?>
<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php $this->assign('area', @AREA, false); ?>
<?php $this->assign('area_name', @AREA_NAME, false); ?>
<?php $this->assign('l', "text_".($__tpl_vars['area_name'])."_skin", false); ?>
<?php $this->assign('c_url', fn_query_remove($__tpl_vars['config']['current_url'], 'demo_skin'), false); ?>
<?php if (strpos($__tpl_vars['c_url'], "?") === false): ?>
	<?php $this->assign('c_url', ($__tpl_vars['c_url'])."?", false); ?>
<?php endif; ?>

<div class="demo-site-panel" style="padding: 3px;">
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
	<td class="strong">DEMO SITE PANEL</td>
	<td class="right"><?php echo fn_get_lang_var($__tpl_vars['l'], $this->getLanguage()); ?>
:</td>
	<td>
		<select name="demo_skin[<?php echo $__tpl_vars['area']; ?>
]" onchange="jQuery.redirect('<?php echo fn_link_attach($__tpl_vars['c_url'], "demo_skin[".($__tpl_vars['area'])."]="); ?>
' + this.value);">
		<?php $_from_3787095468 = & $__tpl_vars['demo_skin']['available_skins']; if (!is_array($_from_3787095468) && !is_object($_from_3787095468)) { settype($_from_3787095468, 'array'); }if (count($_from_3787095468)):
    foreach ($_from_3787095468 as $__tpl_vars['k'] => $__tpl_vars['s']):
?>
			<option value="<?php echo $__tpl_vars['k']; ?>
" <?php if ($__tpl_vars['demo_skin']['selected'][$__tpl_vars['area']] == $__tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['s']['description']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	<td width="100%" class="right">Area:</td>
	<td>
		<select name="area" onchange="jQuery.redirect(this.value);">
			<option value="<?php echo $__tpl_vars['config']['customer_index']; ?>
" <?php if ($__tpl_vars['area'] == 'C'): ?>selected="selected"<?php endif; ?>>Storefront</option>
			<option value="<?php echo $__tpl_vars['config']['admin_index']; ?>
" <?php if ($__tpl_vars['area'] == 'A'): ?>selected="selected"<?php endif; ?>>Administration panel</option>
		</select>
	</td>
</tr>
</table>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<div id="ajax_loading_box" class="ajax-loading-box"><div class="right-inner-loading-box"><div id="ajax_loading_message" class="ajax-inner-loading-box"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</div></div></div>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if (! defined('AJAX_REQUEST')): ?>

<div class="cm-notification-container">
<?php $_from_2362920887 = & fn_get_notifications(""); if (!is_array($_from_2362920887) && !is_object($_from_2362920887)) { settype($_from_2362920887, 'array'); }if (count($_from_2362920887)):
    foreach ($_from_2362920887 as $__tpl_vars['key'] => $__tpl_vars['message']):
?>
<div class="notification-content<?php if ($__tpl_vars['message']['save_state'] == false): ?> cm-auto-hide<?php endif; ?>" id="notification_<?php echo $__tpl_vars['key']; ?>
">
	<div class="notification-<?php echo smarty_modifier_lower($__tpl_vars['message']['type']); ?>
">
		<img class="cm-notification-close hand" src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/notification_close.gif" width="10" height="19" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" onclick="jQuery.closeNotification('<?php echo $__tpl_vars['key']; ?>
', false, true);" />
		<div class="notification-body">
			<?php echo $__tpl_vars['message']['message']; ?>

		</div>
	</div>
	<h1 class="notification-header-<?php echo smarty_modifier_lower($__tpl_vars['message']['type']); ?>
"><?php echo $__tpl_vars['message']['title']; ?>
</h1>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php if ($__tpl_vars['auth']['user_id']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "main.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($__tpl_vars['auth']['user_id']): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php echo smarty_modifier_unescape(smarty_modifier_default(@$__tpl_vars['stats'], "")); ?>

<?php if (defined('TRANSLATION_MODE')): ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/translate_box.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
</body>

</html>