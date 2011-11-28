<?php /* Smarty version 2.6.18, created on 2011-11-28 12:02:43
         compiled from addons/statistics/views/statistics/components/search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php
fn_preload_lang_vars(array('search_phrase','referrer_url','url','page_title','ip_address','browser_name','browser_version','operating_system','language','country','exclude','limit','close'));
?>

<?php ob_start(); ?>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" name="<?php echo $__tpl_vars['key']; ?>
_filter_form" method="get">
<input type="hidden" name="report" value="<?php echo $__tpl_vars['report_data']['report']; ?>
" />
<input type="hidden" name="reports_group" value="<?php echo $__tpl_vars['reports_group']; ?>
" />
<?php echo $__tpl_vars['extra']; ?>


<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $__tpl_vars['search']['period'],'extra' => "",'display' => 'form','but_name' => "dispatch[".($__tpl_vars['dispatch'])."]")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! $__tpl_vars['hide_advanced']): ?>
<?php ob_start(); ?>


<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td>

		<div class="search-field">
			<label for="filter_search_phrase"><?php echo fn_get_lang_var('search_phrase', $this->getLanguage()); ?>
:</label>
			<input type="text" name="search_phrase" id="filter_search_phrase" value="<?php echo $__tpl_vars['search']['search_phrase']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_referrer_url"><?php echo fn_get_lang_var('referrer_url', $this->getLanguage()); ?>
:</label>
			<input type="text" name="referrer_url" id="filter_referrer_url" value="<?php echo $__tpl_vars['search']['referrer_url']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_url"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
:</label>
			<input type="text" name="url" id="filter_url" value="<?php echo $__tpl_vars['search']['url']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_page_title"><?php echo fn_get_lang_var('page_title', $this->getLanguage()); ?>
:</label>
			<input type="text" name="page_title" id="filter_page_title" value="<?php echo $__tpl_vars['search']['page_title']; ?>
" size="10" class="input-text-medium" />
		</div>
	  
		<div class="search-field">
			<label for="filter_ip_address"><?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
:</label>
			<input type="text" name="ip_address" id="filter_ip_address" value="<?php echo $__tpl_vars['search']['ip_address']; ?>
" size="10" class="input-text-medium" />
		</div>

	</td>
	<td>

		<div class="search-field">
			<label for="filter_browser_name"><?php echo fn_get_lang_var('browser_name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="browser_name" id="filter_browser_name" value="<?php echo $__tpl_vars['search']['browser_name']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_browser_version"><?php echo fn_get_lang_var('browser_version', $this->getLanguage()); ?>
:</label>
			<input type="text" name="browser_version" id="filter_browser_version" value="<?php echo $__tpl_vars['search']['browser_version']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_operating_system"><?php echo fn_get_lang_var('operating_system', $this->getLanguage()); ?>
:</label>
			<input type="text" name="operating_system" id="filter_operating_system" value="<?php echo $__tpl_vars['search']['operating_system']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_language"><?php echo fn_get_lang_var('language', $this->getLanguage()); ?>
:</label>
			<input type="text" name="language" id="filter_language" value="<?php echo $__tpl_vars['search']['language']; ?>
" size="10" class="input-text-medium" />
		</div>

		<div class="search-field">
			<label for="filter_country"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</label>
			<input type="text" name="country" id="filter_country" value="<?php echo $__tpl_vars['search']['country']; ?>
" size="10" class="input-text-medium" />
		</div>
	</td>
</tr>
</table>

<hr />

<div class="search-field">
	<label for="filter_exclude_condition"><?php echo fn_get_lang_var('exclude', $this->getLanguage()); ?>
:</label>
	<input type="checkbox" name="exclude_condition" id="filter_exclude_condition" value="Y" <?php if ($__tpl_vars['search']['exclude_condition'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="search-field">
	<label for="filter_limit"><?php echo fn_get_lang_var('limit', $this->getLanguage()); ?>
:</label>
	<input type="text" name="limit" id="filter_limit" value="<?php echo $__tpl_vars['search']['limit']; ?>
" class="input-text-short" />
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $__tpl_vars['dispatch'],'view_type' => 'statistics')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
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