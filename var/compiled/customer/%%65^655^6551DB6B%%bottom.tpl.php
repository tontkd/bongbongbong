<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:20
         compiled from bottom.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'bottom.tpl', 14, false),array('modifier', 'date_format', 'bottom.tpl', 15, false),array('modifier', 'defined', 'bottom.tpl', 28, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('copyright','powered_by','copyright_shopping_cart','skin_by'));
?>

<div class="bottom-search center">
	<span class="float-left">&nbsp;</span>
	<span class="float-right">&nbsp;</span>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/search.tpl", 'smarty_include_vars' => array('hide_advanced_search' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<p class="quick-links">
	<?php $_from_1513176447 = & $__tpl_vars['quick_links']; if (!is_array($_from_1513176447) && !is_object($_from_1513176447)) { settype($_from_1513176447, 'array'); }if (count($_from_1513176447)):
    foreach ($_from_1513176447 as $__tpl_vars['link']):
?>
		<a href="<?php echo $__tpl_vars['link']['param']; ?>
"><?php echo $__tpl_vars['link']['descr']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
</p>
<?php $this->_tag_stack[] = array('hook', array('name' => "index:bottom")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<p class="bottom-copyright class"><?php echo fn_get_lang_var('copyright', $this->getLanguage()); ?>
 &copy; <?php if (smarty_modifier_date_format(@TIME, "%Y") != $__tpl_vars['settings']['Company']['company_start_year']): ?><?php echo $__tpl_vars['settings']['Company']['company_start_year']; ?>
-<?php endif; ?><?php echo smarty_modifier_date_format(@TIME, "%Y"); ?>
 <?php echo $__tpl_vars['settings']['Company']['company_name']; ?>
. &nbsp;<?php echo fn_get_lang_var('powered_by', $this->getLanguage()); ?>
 <a href="http://www.cs-cart.com" target="_blank" class="underlined"><?php echo fn_get_lang_var('copyright_shopping_cart', $this->getLanguage()); ?>
</a>
</p>
<?php if ($__tpl_vars['addons']['affiliate']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['addons']['affiliate']['show_affiliate_code'] == 'Y' && $__tpl_vars['partner_code']): ?>
<div class="affiliate-code"><?php echo $__tpl_vars['partner_code']; ?>
</div>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($__tpl_vars['manifest']['copyright']): ?>
<p class="bottom-copyright mini"><?php echo fn_get_lang_var('skin_by', $this->getLanguage()); ?>
&nbsp;<a href="<?php echo $__tpl_vars['manifest']['copyright_url']; ?>
"><?php echo $__tpl_vars['manifest']['copyright']; ?>
</a></p>
<?php endif; ?>

<?php if (defined('DEBUG_MODE')): ?>
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
<?php endif; ?>