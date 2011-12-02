<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:16
         compiled from index.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'index.tpl', 3, false),array('modifier', 'count', 'index.tpl', 13, false),array('modifier', 'default', 'index.tpl', 22, false),array('modifier', 'sizeof', 'index.tpl', 29, false),array('modifier', 'fn_convert_php_urls', 'index.tpl', 31, false),array('modifier', 'defined', 'index.tpl', 40, false),array('modifier', 'escape', 'index.tpl', 57, false),array('modifier', 'fn_query_remove', 'index.tpl', 159, false),array('modifier', 'strpos', 'index.tpl', 160, false),array('modifier', 'fn_link_attach', 'index.tpl', 170, false),array('modifier', 'fn_get_notifications', 'index.tpl', 198, false),array('modifier', 'string_format', 'index.tpl', 226, false),array('block', 'hook', 'index.tpl', 19, false),array('function', 'script', 'index.tpl', 52, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('page_title_text','home_meta_description','home_meta_keywords','cannot_buy','no_products_selected','error_no_items_selected','delete_confirmation','text_out_of_stock','items','text_required_group_product','notice','warning','loading','none','text_are_you_sure_to_proceed','text_invalid_url','text_cart_changed','error_validator_email','error_validator_confirm_email','error_validator_phone','error_validator_integer','error_validator_multiple','error_validator_password','error_validator_required','error_validator_zipcode','error_validator_message','text_page_loading','loading','close','close','edit','save_translation','or','cancel','close','close','template_editor','templates_tree','save','restore_from_repository','or','cancel','text_page_changed','text_restore_question','text_template_changed','customization_mode','translate_mode','switch_to_translation_mode','switch_to_customization_mode','page_title_text'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo smarty_modifier_lower(@CART_LANGUAGE); ?>
">
<head>
<title><?php if ($__tpl_vars['page_title']): ?><?php echo $__tpl_vars['page_title']; ?><?php else: ?><?php $_from_1561183700 = & $__tpl_vars['breadcrumbs']; if (!is_array($_from_1561183700) && !is_object($_from_1561183700)) { settype($_from_1561183700, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from_1561183700), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from_1561183700 as $__tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo $__tpl_vars['i']['title']; ?><?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?> :: <?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php if (! $__tpl_vars['skip_page_title']): ?><?php if (count($__tpl_vars['breadcrumbs']) > 1): ?> - <?php endif; ?><?php echo fn_get_lang_var('page_title_text', $this->getLanguage()); ?><?php endif; ?><?php endif; ?></title>

<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:meta")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo @CHARSET; ?>
" />
<meta http-equiv="Content-Language" content="<?php echo smarty_modifier_lower(@CART_LANGUAGE); ?>
" />
<meta name="description" content="<?php echo smarty_modifier_default(@$__tpl_vars['meta_description'], fn_get_lang_var('home_meta_description', $this->getLanguage())); ?>
" />
<meta name="keywords" content="<?php echo smarty_modifier_default(@$__tpl_vars['meta_keywords'], fn_get_lang_var('home_meta_keywords', $this->getLanguage())); ?>
" />
<meta name="author" content="Simbirsk Technologies LTD." />
<meta name="robots" content="index, all" />
<?php if ($__tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<base href="<?php echo @REAL_LOCATION; ?>
/" />
<?php if (sizeof($__tpl_vars['languages']) > 1): ?>
<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['language']):
?>
<link title="<?php echo $__tpl_vars['language']['name']; ?>
" dir="rtl" type="text/html" rel="alternate" charset="<?php echo @CHARSET; ?>
" hreflang="<?php echo smarty_modifier_lower($__tpl_vars['language']['lang_code']); ?>
" href="<?php ob_start(); ?><?php echo $__tpl_vars['config']['current_url']; ?>
&amp;sl=<?php echo $__tpl_vars['language']['lang_code']; ?>
<?php $this->_smarty_vars['capture']['t_url'] = ob_get_contents(); ob_end_clean(); ?><?php echo smarty_modifier_fn_convert_php_urls($this->_smarty_vars['capture']['t_url']); ?>
" />
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<link href="<?php echo $__tpl_vars['images_dir']; ?>
/icons/favicon.ico" rel="shortcut icon" />
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('include_dropdown' => true, )); ?>

<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/print.css" rel="stylesheet" media="print" type="text/css" />
<?php if (defined('TRANSLATION_MODE') || defined('CUSTOMIZATION_MODE')): ?>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/design_mode.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php if ($__tpl_vars['include_dropdown']): ?>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/dropdown.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!--[if lte IE 7]>
<link href="<?php echo $__tpl_vars['config']['skin_path']; ?>
/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php $this->_tag_stack[] = array('hook', array('name' => "index:styles")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php echo smarty_function_script(array('src' => "lib/jquery/jquery.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/core.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/ajax.js"), $this);?>

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
	notice: '<?php echo smarty_modifier_escape(fn_get_lang_var('notice', $this->getLanguage()), 'javascript'); ?>
',
	warning: '<?php echo smarty_modifier_escape(fn_get_lang_var('warning', $this->getLanguage()), 'javascript'); ?>
',
	loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('loading', $this->getLanguage()), 'javascript'); ?>
',
	none: '<?php echo smarty_modifier_escape(fn_get_lang_var('none', $this->getLanguage()), 'javascript'); ?>
',
	text_are_you_sure_to_proceed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_are_you_sure_to_proceed', $this->getLanguage()), 'javascript'); ?>
',
	text_invalid_url: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_invalid_url', $this->getLanguage()), 'javascript'); ?>
',
	text_cart_changed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_cart_changed', $this->getLanguage()), 'javascript'); ?>
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
',
		'coefficient': '<?php echo smarty_modifier_escape($__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['coefficient'], 'javascript'); ?>
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
;

var cart_language = '<?php echo @CART_LANGUAGE; ?>
';
var images_dir = '<?php echo $__tpl_vars['images_dir']; ?>
';
var cart_prices_w_taxes = <?php if (( $__tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] == 'Y' && defined('CHECKOUT') ) || ( $__tpl_vars['settings']['Appearance']['show_prices_taxed_clean'] == 'Y' && ! defined('CHECKOUT') )): ?>true<?php else: ?>false<?php endif; ?>;
var translate_mode = <?php if (defined('TRANSLATION_MODE')): ?>true<?php else: ?>false<?php endif; ?>;
var iframe_urls = new Array();
var iframe_extra = new Array();
var regexp = new Array();
$(document).ready(function()<?php echo $__tpl_vars['ldelim']; ?>

	jQuery.runCart('C');
<?php echo $__tpl_vars['rdelim']; ?>
);

document.write('<style>.cm-noscript <?php echo $__tpl_vars['ldelim']; ?>
 display:none <?php echo $__tpl_vars['rdelim']; ?>
</style>'); // hide noscript tags
//]]>
</script>
<?php echo '
<!--[if lt IE 8]>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	$(\'ul.dropdown li\').hover(function(){
		$(this).addClass(\'hover\');
		$(\'> .dir\',this).addClass(\'open\');
		$(\'ul:first\',this).css(\'visibility\', \'visible\');
	},function(){
		$(this).removeClass(\'hover\');
		$(\'.open\',this).removeClass(\'open\');
		$(\'ul:first\',this).css(\'visibility\', \'hidden\');
	});
});
//]]>
</script>
<![endif]-->
'; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:scripts")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php echo smarty_function_script(array('src' => "addons/reward_points/js/func.js"), $this);?>

<script type="text/javascript">
//<![CDATA[
var price_in_points_with_discounts = '<?php echo $__tpl_vars['addons']['reward_points']['price_in_points_with_discounts']; ?>
';
var points_with_discounts = '<?php echo $__tpl_vars['addons']['reward_points']['points_with_discounts']; ?>
';

// Extend core function
fn_register_hooks('reward_points', ['check_exceptions']);

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
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
<div class="helper-container">
	<a name="top"></a>
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

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "main.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if (defined('TRANSLATION_MODE')): ?>
		<?php $__parent_tpl_vars = $__tpl_vars; ?>

<div id="translate_link" class="cm-popup-box hidden">
	<a class="edit-link" onclick="fn_show_translate_box();"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a>
</div>
<div id="translate_box" class="cm-popup-box hidden">
	<div class="cm-popup-content-header">
		<?php $this->assign('icon_tpl', ($__tpl_vars['images_dir'])."/flags/%s.png", false); ?>
		<div class="float-right">
			<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['id'] => $__tpl_vars['item']):
?>
			<img src="<?php echo smarty_modifier_lower(smarty_modifier_string_format($__tpl_vars['id'], $__tpl_vars['icon_tpl'])); ?>
" width="16" height="16" border="0" alt="<?php echo $__tpl_vars['id']; ?>
" title="<?php echo $__tpl_vars['item']['name']; ?>
" onclick="fn_switch_langvar(this);" class="icons<?php if ($__tpl_vars['id'] == @CART_LANGUAGE): ?> cm-cur-lang<?php endif; ?>" />
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php $this->assign('cart_lang', @CART_LANGUAGE, false); ?>
		<h3 id="lang_header"><?php echo $__tpl_vars['languages'][$__tpl_vars['cart_lang']]['name']; ?>
:</h3>
	</div>
	<div class="cm-popup-content-footer">
		<input id="trans_val" class="input-text" type="text" value="" size="37" onkeyup="fn_change_phrase();"/>
		<div class="clear-both"></div>
		<span id="orig_phrase"></span>
		<div class="buttons-container">
			<span class="submit-button cm-button-main">
			<input type="button" onclick="fn_save_phrase();" value="<?php echo fn_get_lang_var('save_translation', $this->getLanguage()); ?>
" />
			</span>
			&nbsp;&nbsp;&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;&nbsp;
			<a class="cm-popup-switch"><?php echo fn_get_lang_var('cancel', $this->getLanguage()); ?>
</a>
		</div>
	</div>
</div>

<?php echo smarty_function_script(array('src' => "js/jquery.easydrag.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/design_mode.js"), $this);?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
	<?php if (defined('CUSTOMIZATION_MODE')): ?>
		<?php $__parent_tpl_vars = $__tpl_vars; ?>

<div id="template_list_menu"><div></div><ul class="float-left"><li></li></ul></div>

<div class="popup-content cm-popup-box cm-picker hidden" id="template_editor">
	<div class="cm-popup-content-header">
		<div class="float-right">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" class="hand cm-popup-switch" />
		</div>
		<h3><?php echo fn_get_lang_var('template_editor', $this->getLanguage()); ?>
:</h3>
	</div>
	<div class="cm-popup-content-footer">
		<div id="template_editor_content">
			<table width="100%" cellpadding="0" cellspacing="0" class="editor-table">
				<tr valign="top" class="max-height">
					<td class="templates-tree max-height">
						<div>
						<h4><?php echo fn_get_lang_var('templates_tree', $this->getLanguage()); ?>
</h4>
						<ul id="template_list"><li></li></ul></div>
					</td>
					<td>
						<textarea id="template_text"></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div class="buttons-container">
			<span class="submit-button cm-button-main">
			<input type="button" class="cm-popup-switch" onclick="fn_save_template();" value="<?php echo fn_get_lang_var('save', $this->getLanguage()); ?>
" />
			</span>
			<input type="button" class="cm-popup-switch" onclick="fn_restore_template();" value="<?php echo fn_get_lang_var('restore_from_repository', $this->getLanguage()); ?>
" />
			<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;&nbsp;<a class="cm-popup-switch"><?php echo fn_get_lang_var('cancel', $this->getLanguage()); ?>
</a>
		</div>
	</div>
</div>

<?php echo smarty_function_script(array('src' => "js/jquery.easydrag.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/design_mode.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/editarea/edit_area_loader.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
var current_url = '<?php echo $__tpl_vars['config']['current_url']; ?>
';
lang.text_page_changed = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_page_changed', $this->getLanguage()), 'javascript'); ?>
';
lang.text_restore_question = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_restore_question', $this->getLanguage()), 'javascript'); ?>
';
lang.text_template_changed = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_template_changed', $this->getLanguage()), 'javascript'); ?>
';
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
	<?php if (defined('CUSTOMIZATION_MODE') || defined('TRANSLATION_MODE')): ?>
		<?php $__parent_tpl_vars = $__tpl_vars; ?>

<div id="design_mode_panel" class="popup <?php if (defined('CUSTOMIZATION_MODE')): ?>customization<?php else: ?>translate<?php endif; ?>-mode" style="<?php if ($_COOKIE['design_mode_panel_offset']): ?><?php echo $_COOKIE['design_mode_panel_offset']; ?>
<?php endif; ?>">
	<div class="cm-popup-content-header">
		<h1><?php if (defined('CUSTOMIZATION_MODE')): ?><?php echo fn_get_lang_var('customization_mode', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('translate_mode', $this->getLanguage()); ?>
<?php endif; ?></h1>
	</div>
	<div class="cm-popup-content-footer">
		<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="design_mode_panel_form">
			<input type="hidden" name="design_mode" value="<?php if (defined('CUSTOMIZATION_MODE')): ?>translation_mode<?php else: ?>customization_mode<?php endif; ?>" />
			<input type="hidden" name="current_url" value="<?php echo $__tpl_vars['config']['current_url']; ?>
" />
			<input type="submit" name="dispatch[design_mode.update_design_mode]" value="" class="hidden" />
			<?php if (defined('CUSTOMIZATION_MODE')): ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_translation_mode', $this->getLanguage()), false); ?>
			<?php else: ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_customization_mode', $this->getLanguage()), false); ?>
			<?php endif; ?>
			<p class="right"><a class="cm-submit" name="dispatch[design_mode.update_design_mode]" rev="design_mode_panel_form"><?php echo $__tpl_vars['mode_val']; ?>
</a></p>
		</form>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:footer")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($__tpl_vars['addons']['statistics']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function()<?php echo $__tpl_vars['ldelim']; ?>

	jQuery.ajaxRequest('<?php echo $__tpl_vars['index_script']; ?>
?dispatch=statistics.collect', <?php echo $__tpl_vars['ldelim']; ?>

		method: 'post',
		data: <?php echo $__tpl_vars['ldelim']; ?>

			've[url]': location.href,
			've[title]': document.title,
			've[browser_version]': jQuery.ua.version,
			've[browser]': jQuery.ua.browser,
			've[os]': jQuery.ua.os,
			've[client_language]': jQuery.ua.language,
			've[referrer]': document.referrer,
			've[screen_x]': (screen.width || null),
			've[screen_y]': (screen.height || null),
			've[color]': (screen.colorDepth || screen.pixelDepth || null),
			've[time_begin]': <?php echo @MICROTIME; ?>

		<?php echo $__tpl_vars['rdelim']; ?>
,
		hidden: true
	<?php echo $__tpl_vars['rdelim']; ?>
);
<?php echo $__tpl_vars['rdelim']; ?>
);
//]]>
</script>

<noscript>
<object data="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=statistics.collect&amp;ve[url]=<?php echo $__tpl_vars['config']['current_location']; ?>
/<?php echo smarty_modifier_escape($__tpl_vars['config']['current_url'], 'url'); ?>
&amp;ve[title]=<?php if ($__tpl_vars['page_title']): ?><?php echo smarty_modifier_escape($__tpl_vars['page_title'], 'url'); ?>
<?php else: ?><?php echo smarty_modifier_escape(fn_get_lang_var('page_title_text', $this->getLanguage()), 'url'); ?>
<?php $_from_1561183700 = & $__tpl_vars['breadcrumbs']; if (!is_array($_from_1561183700) && !is_object($_from_1561183700)) { settype($_from_1561183700, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from_1561183700), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from_1561183700 as $__tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php if (($this->_foreach['bkt']['iteration']-1) == 1): ?> - <?php endif; ?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo smarty_modifier_escape($__tpl_vars['i']['title'], 'url'); ?>
<?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?> :: <?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php endif; ?>&amp;ve[referrer]=<?php echo smarty_modifier_escape($_SERVER['HTTP_REFERER'], 'url'); ?>
&amp;ve[time_begin]=<?php echo @MICROTIME; ?>
" width="0" height="0"></object>
</noscript><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</body>

</html>