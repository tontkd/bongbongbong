<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:43
         compiled from addons/statistics/views/statistics/reports.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'addons/statistics/views/statistics/reports.tpl', 1, false),array('function', 'script', 'addons/statistics/views/statistics/reports.tpl', 3, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('statistics'));
?>

<?php echo smarty_function_script(array('src' => "lib/amcharts/swfobject.js"), $this);?>


<div id="content_<?php echo $__tpl_vars['reports_group']; ?>
">
<?php ob_start(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/statistics/views/statistics/components/search_form.tpl", 'smarty_include_vars' => array('key' => $__tpl_vars['action'],'dispatch' => "statistics.reports")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/statistics/views/statistics/components/reports/".($__tpl_vars['reports_group']).".tpl", 'smarty_include_vars' => array('report_data' => $__tpl_vars['statistics_data'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => smarty_modifier_cat((fn_get_lang_var('statistics', $this->getLanguage())).": ", fn_get_lang_var($__tpl_vars['reports_group'], $this->getLanguage())),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--content_<?php echo $__tpl_vars['reports_group']; ?>
--></div>