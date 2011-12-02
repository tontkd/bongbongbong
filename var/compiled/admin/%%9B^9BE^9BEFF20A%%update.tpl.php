<?php /* Smarty version 2.6.18, created on 2011-12-01 22:50:46
         compiled from addons/store_locator/views/store_locator/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/store_locator/views/store_locator/update.tpl', 3, false),array('modifier', 'fn_get_countries', 'addons/store_locator/views/store_locator/update.tpl', 46, false),array('modifier', 'fn_check_view_permissions', 'addons/store_locator/views/store_locator/update.tpl', 90, false),array('modifier', 'default', 'addons/store_locator/views/store_locator/update.tpl', 93, false),array('modifier', 'fn_explode_localizations', 'addons/store_locator/views/store_locator/update.tpl', 113, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','position','description','country','select_country','city','coordinates','latitude_short','longitude_short','select','remove_this_item','remove_this_item','localization','multiple_selectbox_notice'));
?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if ($__tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('id', '0', false); ?>
	<?php $this->assign('prefix', 'add_store_location', false); ?>
	<?php $this->assign('suffix', '_add', false); ?>
<?php else: ?>
	<?php $this->assign('id', $__tpl_vars['loc']['store_location_id'], false); ?>
	<?php $this->assign('prefix', 'store_locations', false); ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<div id="content_group<?php echo $__tpl_vars['id']; ?>
">
<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" class="cm-form-highlight" name="store_locations_form<?php echo $__tpl_vars['suffix']; ?>
">

<div class="object-container">
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_general_<?php echo $__tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content">
	<fieldset>
		<div class="form-field">
			<label for="name_<?php echo $__tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" id="name_<?php echo $__tpl_vars['id']; ?>
" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][name]" value="<?php echo $__tpl_vars['loc']['name']; ?>
" class="input-text-large" />
		</div>


		<div class="form-field">
			<label for="position_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
</label>
			<input type="text" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][position]" id="position_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['loc']['position']; ?>
" size="3" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="description_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
			<textarea id="description_<?php echo $__tpl_vars['id']; ?>
" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][description]" cols="55" rows="2" class="input-textarea-long"><?php echo $__tpl_vars['loc']['description']; ?>
</textarea>
			<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => "description_".($__tpl_vars['id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
		</div>

		<div class="form-field">
			<label for="country_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</label>
			<?php $this->assign('countries', fn_get_countries(@CART_LANGUAGE, true), false); ?>
			<select id="country_<?php echo $__tpl_vars['id']; ?>
" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][country]" class="select">
				<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
				<?php $_from_3268346460 = & $__tpl_vars['countries']; if (!is_array($_from_3268346460) && !is_object($_from_3268346460)) { settype($_from_3268346460, 'array'); }if (count($_from_3268346460)):
    foreach ($_from_3268346460 as $__tpl_vars['country']):
?>
				<option <?php if ($__tpl_vars['loc']['country'] == $__tpl_vars['country']['code']): ?>selected="selected"<?php endif; ?> value="<?php echo $__tpl_vars['country']['code']; ?>
"><?php echo $__tpl_vars['country']['country']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="form-field">
			<label for="city_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
:</label>
			<input type="text" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][city]" id="city_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['loc']['city']; ?>
" class="input-text" />
		</div>

		<div class="form-field">
			<label for="latitude_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('coordinates', $this->getLanguage()); ?>
 (<?php echo fn_get_lang_var('latitude_short', $this->getLanguage()); ?>
 x <?php echo fn_get_lang_var('longitude_short', $this->getLanguage()); ?>
):</label>
			<input type="text" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][latitude]" id="latitude_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['loc']['latitude']; ?>
" class="input-text-medium input-fill" /> x <input type="text" name="<?php echo $__tpl_vars['prefix']; ?>
[<?php echo $__tpl_vars['id']; ?>
][longitude]" id="longitude_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['loc']['longitude']; ?>
" class="input-text-medium input-fill" />
			
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('select', $this->getLanguage()), 'but_onclick' => "jQuery.show_picker('map_picker', '', '.object-container'); fn_init_map('country_".($__tpl_vars['id'])."', 'city_".($__tpl_vars['id'])."', 'latitude_".($__tpl_vars['id'])."', 'longitude_".($__tpl_vars['id'])."');", 'but_type' => 'button', )); ?>

<?php if ($__tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button-add", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($__tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['but_name']): ?><?php $this->assign('r', $__tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $__tpl_vars['but_href'], false); ?><?php endif; ?>
<?php if (fn_check_view_permissions($__tpl_vars['r'])): ?>

<?php if ($__tpl_vars['but_name'] || $__tpl_vars['but_role'] == 'submit' || $__tpl_vars['but_role'] == 'button_main' || $__tpl_vars['but_type'] || $__tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($__tpl_vars['but_css']): ?>style="<?php echo $__tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($__tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'submit'): ?> strong<?php endif; ?><?php if ($__tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $__tpl_vars['but_meta']; ?>
"><input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$__tpl_vars['but_type'], 'submit'); ?>
"<?php if ($__tpl_vars['but_name']): ?> name="<?php echo $__tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> /></span>

<?php elseif ($__tpl_vars['but_role'] && $__tpl_vars['but_role'] != 'submit' && $__tpl_vars['but_role'] != 'action' && $__tpl_vars['but_role'] != "advanced-search" && $__tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_onclick']): ?> onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($__tpl_vars['but_target']): ?> target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_rev']): ?> rev="<?php echo $__tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $__tpl_vars['class']; ?>
<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($__tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $__tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($__tpl_vars['but_role'] == 'action' || $__tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($__tpl_vars['but_href']): ?> href="<?php echo $__tpl_vars['but_href']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($__tpl_vars['but_target']): ?>target="<?php echo $__tpl_vars['but_target']; ?>
"<?php endif; ?> class="button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $__tpl_vars['but_text']; ?>
<?php if ($__tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($__tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($__tpl_vars['but_meta']): ?>class="<?php echo $__tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($__tpl_vars['but_onclick']): ?>onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $__tpl_vars['but_text']; ?>
" <?php if ($__tpl_vars['tabindex']): ?>tabindex="<?php echo $__tpl_vars['tabindex']; ?>
"<?php endif; ?> />

<?php elseif (! $__tpl_vars['but_role']): ?> 
	<input <?php if ($__tpl_vars['but_id']): ?>id="<?php echo $__tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($__tpl_vars['but_meta']): ?> <?php echo $__tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $__tpl_vars['but_onclick']; ?>
;<?php if (! $__tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $__tpl_vars['but_text']; ?>
" />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>

		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('data_from' => $__tpl_vars['loc']['localization'], 'data_name' => ($__tpl_vars['prefix'])."[".($__tpl_vars['id'])."][localization]", )); ?>

<?php $this->assign('data', fn_explode_localizations($__tpl_vars['data_from']), false); ?>

<?php if ($__tpl_vars['localizations']): ?>
<?php if (! $__tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $__tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $__tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $__tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$__tpl_vars['id'], @$__tpl_vars['data_name']); ?>
" class="<?php if ($__tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($__tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from_466923040 = & $__tpl_vars['localizations']; if (!is_array($_from_466923040) && !is_object($_from_466923040)) { settype($_from_466923040, 'array'); }if (count($_from_466923040)):
    foreach ($_from_466923040 as $__tpl_vars['loc']):
?>
			<option	value="<?php echo $__tpl_vars['loc']['localization_id']; ?>
" <?php $_from_1215306045 = & $__tpl_vars['data']; if (!is_array($_from_1215306045) && !is_object($_from_1215306045)) { settype($_from_1215306045, 'array'); }if (count($_from_1215306045)):
    foreach ($_from_1215306045 as $__tpl_vars['p_loc']):
?><?php if ($__tpl_vars['p_loc'] == $__tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo $__tpl_vars['loc']['localization']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $__tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</fieldset>
	</div>
</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/create_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[store_locator.add]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[store_locator.update]",'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>
	
</form>

<!--content_group<?php echo $__tpl_vars['id']; ?>
--></div>