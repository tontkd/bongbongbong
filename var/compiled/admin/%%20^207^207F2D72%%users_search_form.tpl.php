<?php /* Smarty version 2.6.18, created on 2011-11-28 12:08:32
         compiled from views/profiles/components/users_search_form.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/profiles/components/users_search_form.tpl', 118, false),array('modifier', 'escape', 'views/profiles/components/users_search_form.tpl', 138, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name','search','search','company','email','username','membership','not_a_member','tax_exempt','yes','no','address','city','country','select_country','state','select_state','zip_postal_code','tag','ordered_products','close'));
?>

<?php ob_start(); ?>

<form name="user_search_form" action="<?php echo $__tpl_vars['index_script']; ?>
" method="get">

<?php if ($__tpl_vars['_REQUEST']['redirect_url']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $__tpl_vars['_REQUEST']['redirect_url']; ?>
" />
<?php endif; ?>

<?php if ($__tpl_vars['selected_section'] != ""): ?>
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $__tpl_vars['selected_section']; ?>
" />
<?php endif; ?>

<?php if ($__tpl_vars['search']['user_type']): ?>
<input type="hidden" name="user_type" value="<?php echo $__tpl_vars['search']['user_type']; ?>
" />
<?php endif; ?>

<?php echo $__tpl_vars['extra']; ?>


<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field nowrap">
		<label for="name"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="search-input-text" type="text" name="name" id="name" value="<?php echo $__tpl_vars['search']['name']; ?>
" />
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('search' => 'Y', 'but_name' => $__tpl_vars['dispatch'], )); ?>

<input type="hidden" name="dispatch" value="<?php echo $__tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $__tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	</td>
	<td class="search-field">
		<label for="company"><?php echo fn_get_lang_var('company', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="input-text" type="text" name="company" id="company" value="<?php echo $__tpl_vars['search']['company']; ?>
" />
		</div>
	</td>
	<td class="search-field">
		<label for="email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="input-text" type="text" name="email" id="email" value="<?php echo $__tpl_vars['search']['email']; ?>
" />
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

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td>
		<div class="search-field">
			<label for="user_login"><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="user_login" id="user_login" value="<?php echo $__tpl_vars['search']['user_login']; ?>
" />
		</div>

		<div class="search-field">
			<label for="membership_id"><?php echo fn_get_lang_var('membership', $this->getLanguage()); ?>
:</label>
			<select name="membership_id" id="membership_id">
				<option value="<?php echo @ALL_MEMBERSHIPS; ?>
"> -- </option>
				<option value="0" <?php if ($__tpl_vars['search']['membership_id'] == @NOT_A_MEMBER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('not_a_member', $this->getLanguage()); ?>
</option>
				<?php $_from_3805038599 = & $__tpl_vars['memberships']; if (!is_array($_from_3805038599) && !is_object($_from_3805038599)) { settype($_from_3805038599, 'array'); }if (count($_from_3805038599)):
    foreach ($_from_3805038599 as $__tpl_vars['membership']):
?>
				<option value="<?php echo $__tpl_vars['membership']['membership_id']; ?>
" <?php if ($__tpl_vars['search']['membership_id'] == $__tpl_vars['membership']['membership_id']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['membership']['membership']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="search-field">
			<label for="tax_exempt"><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
:</label>
			<select name="tax_exempt" id="tax_exempt">
				<option value="">--</option>
				<option value="Y" <?php if ($__tpl_vars['search']['tax_exempt'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
				<option value="N" <?php if ($__tpl_vars['search']['tax_exempt'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
			</select>
		</div>

		<div class="search-field">
			<label for="address"><?php echo fn_get_lang_var('address', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="address" id="address" value="<?php echo $__tpl_vars['search']['address']; ?>
" />
		</div>
	</td>
	<td>

		<div class="search-field">
			<label for="city"><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="city" id="city" value="<?php echo $__tpl_vars['search']['city']; ?>
" />
		</div>
		<div class="search-field">
			<label for="srch_country" class="cm-country cm-location-search"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</label>
			<select id="srch_country" name="country" class="cm-location-search">
				<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
				<?php $_from_3268346460 = & $__tpl_vars['countries']; if (!is_array($_from_3268346460) && !is_object($_from_3268346460)) { settype($_from_3268346460, 'array'); }if (count($_from_3268346460)):
    foreach ($_from_3268346460 as $__tpl_vars['country']):
?>
				<option value="<?php echo $__tpl_vars['country']['code']; ?>
" <?php if ($__tpl_vars['search']['country'] == $__tpl_vars['country']['code']): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['country']['country']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="search-field">
			<label for="srch_state" class="cm-state cm-location-search"><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
:</label>
			<input type="text" id="srch_state_d" name="state" maxlength="64" value="<?php echo $__tpl_vars['search']['state']; ?>
" disabled="disabled" class="input-text hidden" />
			<select id="srch_state" name="state">
				<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
			</select>
		</div>

		<div class="search-field">
			<label for="zipcode"><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="zipcode" id="zipcode" value="<?php echo $__tpl_vars['search']['zipcode']; ?>
" />
		</div>
	</td>
</tr>
</table>

<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($__tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="search-field">
	<label for="elm_tag"><?php echo fn_get_lang_var('tag', $this->getLanguage()); ?>
:</label>
	<input id="elm_tag" type="text" name="tag" value="<?php echo $__tpl_vars['search']['tag']; ?>
" onfocus="this.select();" class="input-text" />
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('ordered_products', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/search_products_picker.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $__tpl_vars['dispatch'],'view_type' => 'users')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>
<script type="text/javascript">
//<![CDATA[
	default_state = <?php echo $__tpl_vars['ldelim']; ?>
'search':'<?php echo smarty_modifier_escape($__tpl_vars['_REQUEST']['state'], 'javascript'); ?>
'<?php echo $__tpl_vars['rdelim']; ?>
;
//]]>
</script>

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