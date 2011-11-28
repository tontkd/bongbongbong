<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:58
         compiled from views/languages/components/langvars_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('search_for_pattern','search','search','close'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="langvars_search_form" method="get">

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('search_for_pattern', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="<?php echo $__tpl_vars['_REQUEST']['q']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('search' => 'Y', 'but_name' => "languages.manage", )); ?>

<input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.manage]",'but_role' => 'submit')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

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