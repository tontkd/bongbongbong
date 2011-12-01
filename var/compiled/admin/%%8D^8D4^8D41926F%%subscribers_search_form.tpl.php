<?php /* Smarty version 2.6.18, created on 2011-11-30 23:41:18
         compiled from addons/news_and_emails/views/subscribers/components/subscribers_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('email','search','search','mailing_list','confirmed','yes','no','format','txt_format','html_format','language','period','close'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="subscribers_search_form" method="get">

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="email" size="20" value="<?php echo $__tpl_vars['search']['email']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('search' => 'Y', 'but_name' => ($__tpl_vars['dispatch']), )); ?>

<input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('mailing_list', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<select	name="list_id">
				<option	value="">--</option>
				<?php $_from_1568803587 = & $__tpl_vars['mailing_lists']; if (!is_array($_from_1568803587) && !is_object($_from_1568803587)) { settype($_from_1568803587, 'array'); }if (count($_from_1568803587)):
    foreach ($_from_1568803587 as $__tpl_vars['m_id'] => $__tpl_vars['m']):
?>
					<option	value="<?php echo $__tpl_vars['m_id']; ?>
" <?php if ($__tpl_vars['search']['list_id'] == $__tpl_vars['m_id']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['m']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('confirmed', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<select	name="confirmed">
				<option	value="">--</option>
				<option	value="Y" <?php if ($__tpl_vars['search']['confirmed'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
				<option	value="N" <?php if ($__tpl_vars['search']['confirmed'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
			</select>
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($__tpl_vars['dispatch'])."]",'but_role' => 'submit')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<div class="search-field">
	<label for="elm_search_format"><?php echo fn_get_lang_var('format', $this->getLanguage()); ?>
:</label>
	<select id="elm_search_format" name="format">
		<option value="">--</option>
		<option <?php if ($__tpl_vars['search']['format'] == @NEWSLETTER_FORMAT_TXT): ?>selected="selected"<?php endif; ?> value="<?php echo @NEWSLETTER_FORMAT_TXT; ?>
"><?php echo fn_get_lang_var('txt_format', $this->getLanguage()); ?>
</option>
		<option <?php if ($__tpl_vars['search']['format'] == @NEWSLETTER_FORMAT_HTML): ?>selected="selected"<?php endif; ?> value="<?php echo @NEWSLETTER_FORMAT_HTML; ?>
"><?php echo fn_get_lang_var('html_format', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="search-field">
	<label for="elm_search_language"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
:</label>
	<select id="elm_search_language" name="language">
		<option value="">--</option>
		<?php $_from_3793863758 = & $__tpl_vars['languages']; if (!is_array($_from_3793863758) && !is_object($_from_3793863758)) { settype($_from_3793863758, 'array'); }if (count($_from_3793863758)):
    foreach ($_from_3793863758 as $__tpl_vars['lng']):
?>
		<option <?php if ($__tpl_vars['search']['language'] == $__tpl_vars['lng']['lang_code']): ?>selected="selected"<?php endif; ?> value="<?php echo $__tpl_vars['lng']['lang_code']; ?>
"><?php echo $__tpl_vars['lng']['name']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="search-field">
	<label><?php echo fn_get_lang_var('period', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $__tpl_vars['search']['period'],'form_name' => 'subscribers_search_form')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $__tpl_vars['dispatch'],'view_type' => 'subscribers')));
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