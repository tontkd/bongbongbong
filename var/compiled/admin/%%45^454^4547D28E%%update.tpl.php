<?php /* Smarty version 2.6.18, created on 2011-11-28 13:16:54
         compiled from views/product_options/update.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/product_options/update.tpl', 3, false),array('modifier', 'strpos', 'views/product_options/update.tpl', 42, false),array('modifier', 'unescape', 'views/product_options/update.tpl', 104, false),array('modifier', 'is_array', 'views/product_options/update.tpl', 173, false),array('modifier', 'yaml_unserialize', 'views/product_options/update.tpl', 174, false),array('modifier', 'lower', 'views/product_options/update.tpl', 177, false),array('block', 'hook', 'views/product_options/update.tpl', 201, false),array('function', 'math', 'views/product_options/update.tpl', 221, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','variants','name','position','inventory','type','selectbox','radiogroup','checkbox','text','textarea','selectbox','radiogroup','checkbox','text','textarea','description','regexp','required','inner_hint','incorrect_filling_message','position_short','name','modifier','type','weight_modifier','type','status','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','active','hidden','disabled','status','active','hidden','disabled','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','extra','icon','earned_point_modifier','type','points_lower','active','hidden','disabled','status','active','hidden','disabled','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','extra','icon','earned_point_modifier','type','points_lower','create'));
?>

<?php $this->assign('id', smarty_modifier_default(@$__tpl_vars['option_id'], 0), false); ?>

<div id="content_group_product_option_<?php echo $__tpl_vars['id']; ?>
">

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="option_form_<?php echo $__tpl_vars['id']; ?>
" class="form-highlight" enctype="multipart/form-data">
<input type="hidden" name="option_id" value="<?php echo $__tpl_vars['option_id']; ?>
" />
<?php if ($__tpl_vars['_REQUEST']['product_id']): ?>
<?php if (! $__tpl_vars['option_data']): ?>
<input type="hidden" name="option_data[product_id]" value="<?php echo $__tpl_vars['_REQUEST']['product_id']; ?>
" />
<?php endif; ?>
<input type="hidden" name="product_id" value="<?php echo $__tpl_vars['_REQUEST']['product_id']; ?>
" />
<?php endif; ?>

<div class="object-container">

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_option_details_<?php echo $__tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		<?php if ($__tpl_vars['option_data']['option_type'] == 'S' || $__tpl_vars['option_data']['option_type'] == 'R' || $__tpl_vars['option_data']['option_type'] == 'C' || ! $__tpl_vars['option_data']): ?>
			<li id="tab_option_variants_<?php echo $__tpl_vars['id']; ?>
" class="cm-js"><a><?php echo fn_get_lang_var('variants', $this->getLanguage()); ?>
</a></li>
		<?php endif; ?>
	</ul>
</div>
<div class="cm-tabs-content" id="tabs_content_<?php echo $__tpl_vars['id']; ?>
">
	<div id="content_tab_option_details_<?php echo $__tpl_vars['id']; ?>
">
	<fieldset>
		<div class="form-field">
			<label for="name_<?php echo $__tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="option_data[option_name]" id="name_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['option_data']['option_name']; ?>
" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="position_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
			<input type="text" name="option_data[position]" id="position_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['option_data']['position']; ?>
" size="3" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="inventory_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('inventory', $this->getLanguage()); ?>
:</label>
			<input type="hidden" name="option_data[inventory]" value="N" />
			<?php if (strpos('SRC', $__tpl_vars['option_data']['option_type']) !== false): ?>
				<input type="checkbox" name="option_data[inventory]" id="inventory_<?php echo $__tpl_vars['id']; ?>
" value="Y" <?php if ($__tpl_vars['option_data']['inventory'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
			<?php else: ?>
				&nbsp;-&nbsp;
			<?php endif; ?>
		</div>

		<div class="form-field">
			<label for="option_type_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
			<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('name' => "option_data[option_type]", 'value' => $__tpl_vars['option_data']['option_type'], 'display' => 'select', 'tag_id' => "option_type_".($__tpl_vars['id']), 'check' => true, )); ?>
<?php if ($__tpl_vars['display'] == 'view'): ?><?php if ($__tpl_vars['value'] == 'S'): ?><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?><?php elseif ($__tpl_vars['value'] == 'R'): ?><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?><?php elseif ($__tpl_vars['value'] == 'C'): ?><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?><?php elseif ($__tpl_vars['value'] == 'I'): ?><?php echo fn_get_lang_var('text', $this->getLanguage()); ?><?php elseif ($__tpl_vars['value'] == 'T'): ?><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?><?php endif; ?><?php else: ?><?php if ($__tpl_vars['value']): ?><?php if ($__tpl_vars['value'] == 'S' || $__tpl_vars['value'] == 'R' || $__tpl_vars['value'] == 'C'): ?><?php $this->assign('app_types', 'SRC', false); ?><?php else: ?><?php $this->assign('app_types', 'IT', false); ?><?php endif; ?><?php else: ?><?php $this->assign('app_types', "", false); ?><?php endif; ?><select id="<?php echo $__tpl_vars['tag_id']; ?>" name="<?php echo $__tpl_vars['name']; ?>" <?php if ($__tpl_vars['check']): ?>onchange="fn_check_option_type(this.value, this.id);"<?php endif; ?>><?php if (! $__tpl_vars['app_types'] || ( $__tpl_vars['app_types'] && strpos($__tpl_vars['app_types'], 'S') !== false )): ?><option value="S" <?php if ($__tpl_vars['value'] == 'S'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?></option><?php endif; ?><?php if (! $__tpl_vars['app_types'] || ( $__tpl_vars['app_types'] && strpos($__tpl_vars['app_types'], 'R') !== false )): ?><option value="R" <?php if ($__tpl_vars['value'] == 'R'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?></option><?php endif; ?><?php if (! $__tpl_vars['app_types'] || ( $__tpl_vars['app_types'] && strpos($__tpl_vars['app_types'], 'C') !== false )): ?><option value="C" <?php if ($__tpl_vars['value'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?></option><?php endif; ?><?php if (! $__tpl_vars['app_types'] || ( $__tpl_vars['app_types'] && strpos($__tpl_vars['app_types'], 'I') !== false )): ?><option value="I" <?php if ($__tpl_vars['value'] == 'I'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('text', $this->getLanguage()); ?></option><?php endif; ?><?php if (! $__tpl_vars['app_types'] || ( $__tpl_vars['app_types'] && strpos($__tpl_vars['app_types'], 'T') !== false )): ?><option value="T" <?php if ($__tpl_vars['value'] == 'T'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?></option><?php endif; ?></select><?php endif; ?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
		
		<div class="form-field">
			<label for="description_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
			<textarea id="description_<?php echo $__tpl_vars['id']; ?>
" name="option_data[description]" cols="55" rows="8" class="input-textarea-long"><?php echo $__tpl_vars['option_data']['description']; ?>
</textarea>
			<p><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/wysiwyg.tpl", 'smarty_include_vars' => array('id' => "description_".($__tpl_vars['id']))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>
		</div>
		
		<div id="extra_options_<?php echo $__tpl_vars['id']; ?>
" <?php if ($__tpl_vars['option_data']['option_type'] != 'I' && $__tpl_vars['option_data']['option_type'] != 'T'): ?>class="hidden"<?php endif; ?>>
			<div class="form-field">
				<label for="regexp_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('regexp', $this->getLanguage()); ?>
:</label>
				<input type="text" name="option_data[regexp]" id="regexp_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo smarty_modifier_unescape($__tpl_vars['option_data']['regexp']); ?>
" class="input-text-large" />
			</div>
			
			<div class="form-field">
				<label for="required_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('required', $this->getLanguage()); ?>
:</label>
				<input type="hidden" name="option_data[required]" value="N" /><input type="checkbox" id="required_<?php echo $__tpl_vars['id']; ?>
" name="option_data[required]" value="Y" <?php if ($__tpl_vars['option_data']['required'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
			</div>
			
			<div class="form-field">
				<label for="inner_hint_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('inner_hint', $this->getLanguage()); ?>
:</label>
				<input type="text" name="option_data[inner_hint]" id="inner_hint_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['option_data']['inner_hint']; ?>
" class="input-text-large" />
			</div>
			
			<div class="form-field">
				<label for="incorrect_message_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('incorrect_filling_message', $this->getLanguage()); ?>
:</label>
				<input type="text" name="option_data[incorrect_message]" id="incorrect_message_<?php echo $__tpl_vars['id']; ?>
" value="<?php echo $__tpl_vars['option_data']['incorrect_message']; ?>
" class="input-text-large" />
			</div>
		</div>
	<!--content_tab_option_details_<?php echo $__tpl_vars['id']; ?>
--></div>

 	<div class="hidden" id="content_tab_option_variants_<?php echo $__tpl_vars['id']; ?>
">
		<table cellpadding="0" cellspacing="0" class="table">
		<tbody>
		<tr class="first-sibling">
			<th class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
			<th class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('weight_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
			<th class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
			<th><img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_st_<?php echo $__tpl_vars['id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combinations-options-<?php echo $__tpl_vars['id']; ?>
" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_st_<?php echo $__tpl_vars['id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combinations-options-<?php echo $__tpl_vars['id']; ?>
" /></th>
			<th class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">&nbsp;</th>
		</tr>
		</tbody>
		<?php $_from_3298478621 = & $__tpl_vars['option_data']['variants']; if (!is_array($_from_3298478621) && !is_object($_from_3298478621)) { settype($_from_3298478621, 'array'); }$this->_foreach['fe_v'] = array('total' => count($_from_3298478621), 'iteration' => 0);
if ($this->_foreach['fe_v']['total'] > 0):
    foreach ($_from_3298478621 as $__tpl_vars['vr']):
        $this->_foreach['fe_v']['iteration']++;
?>
		<?php $this->assign('num', $this->_foreach['fe_v']['iteration'], false); ?>
		<tbody class="hover cm-row-item" id="option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
">
		<tr>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][position]" value="<?php echo $__tpl_vars['vr']['position']; ?>
" size="3" class="input-text-short" /></td>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][variant_name]" value="<?php echo $__tpl_vars['vr']['variant_name']; ?>
" class="input-text-medium main-input" /></td>
			<td class="nowrap">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][modifier]" value="<?php echo $__tpl_vars['vr']['modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][modifier_type]">
					<option value="A" <?php if ($__tpl_vars['vr']['modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
</option>
					<option value="P" <?php if ($__tpl_vars['vr']['modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>%</option>
				</select>
			</td>
			<td class="nowrap">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][weight_modifier]" value="<?php echo $__tpl_vars['vr']['weight_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][weight_modifier_type]">
					<option value="A" <?php if ($__tpl_vars['vr']['weight_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo $__tpl_vars['settings']['General']['weight_symbol']; ?>
</option>
					<option value="P" <?php if ($__tpl_vars['vr']['weight_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>%</option>
				</select>
			</td>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('input_name' => "option_data[variants][".($__tpl_vars['num'])."][status]", 'display' => 'select', 'obj' => $__tpl_vars['vr'], )); ?>

<?php if ($__tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $__tpl_vars['input_name']; ?>
" <?php if ($__tpl_vars['input_id']): ?>id="<?php echo $__tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($__tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($__tpl_vars['hidden']): ?>
	<option value="H" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from_3342526419), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
" <?php if ($__tpl_vars['obj']['status'] == $__tpl_vars['st'] || ( ! $__tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
"><?php echo $__tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a" <?php if ($__tpl_vars['obj']['status'] == 'A' || ! $__tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($__tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			<td class="nowrap">
				<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combination-options-<?php echo $__tpl_vars['id']; ?>
" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combination-options-<?php echo $__tpl_vars['id']; ?>
" /><a id="sw_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" class="cm-combination-options-<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('extra', $this->getLanguage()); ?>
</a>
				<input type="hidden" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][variant_id]" value="<?php echo $__tpl_vars['vr']['variant_id']; ?>
" />
			 </td>
			 <td class="right cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "option_variants_".($__tpl_vars['id'])."_".($__tpl_vars['num']),'tag_level' => '3','only_delete' => 'Y')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
		<tr id="extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" class="cm-ex-op hidden">
			<td colspan="7">
				<?php $this->_tag_stack[] = array('hook', array('name' => "product_options:edit_product_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<div class="form-field cm-non-cb">
					<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
					<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'variant_image','image_key' => $__tpl_vars['num'],'hide_titles' => true,'no_detailed' => true,'image_object_type' => 'variant_image','image_type' => 'V','image_pair' => $__tpl_vars['vr']['image_pair'],'prefix' => $__tpl_vars['id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>				
				<?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="form-field">
	<label for="point_modifier_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('earned_point_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
	<input type="text" id="point_modifier_<?php echo $__tpl_vars['id']; ?>
" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][point_modifier]" value="<?php echo $__tpl_vars['vr']['point_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][point_modifier_type]">
		<option value="A" <?php if ($__tpl_vars['vr']['point_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>>(<?php echo fn_get_lang_var('points_lower', $this->getLanguage()); ?>
)</option>
		<option value="P" <?php if ($__tpl_vars['vr']['point_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>(%)</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</div>
			</td>
		</tr>
		</tbody>
		<?php endforeach; endif; unset($_from); ?>

		<?php echo smarty_function_math(array('equation' => "x + 1",'assign' => 'num','x' => smarty_modifier_default(@$__tpl_vars['num'], 0)), $this);?>
<?php $this->assign('vr', "", false); ?>
		<tbody class="hover cm-row-item <?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?>hidden<?php endif; ?>" id="box_add_variant_<?php echo $__tpl_vars['id']; ?>
">
		<tr>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][position]" value="" size="3" class="input-text-short" /></td>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][variant_name]" value="" class="input-text-medium main-input" /></td>
			<td>
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][modifier]" value="" size="5" class="input-text" />&nbsp;/
				<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][modifier_type]">
					<option value="A"><?php echo $__tpl_vars['currencies'][$__tpl_vars['primary_currency']]['symbol']; ?>
</option>
					<option value="P">%</option>
				</select>
			</td>
			<td>
				<input type="text" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][weight_modifier]" value="" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][weight_modifier_type]">
					<option value="A"><?php echo $__tpl_vars['settings']['General']['weight_symbol']; ?>
</option>
					<option value="P">%</option>
				</select>
			</td>
			<td class="cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('input_name' => "option_data[variants][".($__tpl_vars['num'])."][status]", 'display' => 'select', )); ?>

<?php if ($__tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $__tpl_vars['input_name']; ?>
" <?php if ($__tpl_vars['input_id']): ?>id="<?php echo $__tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($__tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($__tpl_vars['hidden']): ?>
	<option value="H" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($__tpl_vars['items_status']): ?>
			<?php if (! is_array($__tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', smarty_modifier_yaml_unserialize($__tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from_3342526419 = & $__tpl_vars['items_status']; if (!is_array($_from_3342526419) && !is_object($_from_3342526419)) { settype($_from_3342526419, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from_3342526419), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from_3342526419 as $__tpl_vars['st'] => $__tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
" <?php if ($__tpl_vars['obj']['status'] == $__tpl_vars['st'] || ( ! $__tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $__tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($__tpl_vars['st']); ?>
"><?php echo $__tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a" <?php if ($__tpl_vars['obj']['status'] == 'A' || ! $__tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($__tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h" <?php if ($__tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $__tpl_vars['input_name']; ?>
" id="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d" <?php if ($__tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $__tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$__tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			<td>
				<img src="<?php echo $__tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combination-options-<?php echo $__tpl_vars['id']; ?>
" /><img src="<?php echo $__tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combination-options-<?php echo $__tpl_vars['id']; ?>
" /><a id="sw_extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" class="cm-combination-options-<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('extra', $this->getLanguage()); ?>
</a>
			</td>
			<td class="right cm-non-cb<?php if ($__tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "add_variant_".($__tpl_vars['id']),'tag_level' => '2')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
		<tr id="extra_option_variants_<?php echo $__tpl_vars['id']; ?>
_<?php echo $__tpl_vars['num']; ?>
" class="cm-ex-op hidden">
			<td colspan="7">
				<?php $this->_tag_stack[] = array('hook', array('name' => "product_options:edit_product_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<div class="form-field cm-non-cb">
					<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
					<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'variant_image','image_key' => $__tpl_vars['num'],'hide_titles' => true,'no_detailed' => true,'image_object_type' => 'variant_image','image_type' => 'V','prefix' => $__tpl_vars['id'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<?php if ($__tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<div class="form-field">
	<label for="point_modifier_<?php echo $__tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('earned_point_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
	<input type="text" id="point_modifier_<?php echo $__tpl_vars['id']; ?>
" name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][point_modifier]" value="<?php echo $__tpl_vars['vr']['point_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $__tpl_vars['num']; ?>
][point_modifier_type]">
		<option value="A" <?php if ($__tpl_vars['vr']['point_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>>(<?php echo fn_get_lang_var('points_lower', $this->getLanguage()); ?>
)</option>
		<option value="P" <?php if ($__tpl_vars['vr']['point_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>(%)</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</td>
		</tr>
		</tbody>
		</table>
	</fieldset>
	<!--content_tab_option_variants_<?php echo $__tpl_vars['id']; ?>
--></div>
</div>

</div>

<div class="buttons-container">
	<?php if ($__tpl_vars['mode'] == 'add'): ?>
		<?php $this->assign('_but_text', fn_get_lang_var('create', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('_but_text', "", false); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_text' => $__tpl_vars['_but_text'],'but_name' => "dispatch[product_options.update]",'cancel_action' => 'close','extra' => "")));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<!--content_group_product_option_<?php echo $__tpl_vars['id']; ?>
--></div>