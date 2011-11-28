<?php /* Smarty version 2.6.18, created on 2011-11-28 12:20:58
         compiled from views/sales_reports/components/sales_reports_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('close'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="report_form_<?php echo $__tpl_vars['report']['report_id']; ?>
">
<input type="hidden" name="report_id" value="<?php echo $__tpl_vars['report']['report_id']; ?>
" />
<input type="hidden" name="selected_section" value="" />

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $__tpl_vars['period'],'form_name' => 'orders_search_form','display' => 'form','but_name' => "dispatch[sales_reports.reports_view.update_report]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?>

<div class="clear">
	<div class="section-border">
		<?php echo $__tpl_vars['section_content']; ?>

		<?php if ($__tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo $__tpl_vars['index_script']; ?>
?<?php echo $_SERVER['QUERY_STRING']; ?>
&amp;close_section=<?php echo $__tpl_vars['key']; ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>