<?php /* Smarty version 2.6.18, created on 2011-11-28 12:09:56
         compiled from views/block_manager/manage.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/block_manager/manage.tpl', 3, false),array('modifier', 'to_json', 'views/block_manager/manage.tpl', 8, false),array('modifier', 'escape', 'views/block_manager/manage.tpl', 9, false),array('modifier', 'fn_check_view_permissions', 'views/block_manager/manage.tpl', 370, false),array('modifier', 'default', 'views/block_manager/manage.tpl', 373, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('not_applicable','editing_block','top','no_blocks','left_sidebox','no_blocks','central','central_content','wrapper','editing_block','central_content','product_details_page_tabs','no_blocks','no_blocks','right_sidebox','no_blocks','bottom','no_blocks','add_block','add_block','save','remove_this_item','remove_this_item','add_block','add_block','blocks'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>

<?php $__parent_tpl_vars = $__tpl_vars; ?>

<script type="text/javascript">
//<![CDATA[
	var settings = <?php echo smarty_modifier_to_json($__tpl_vars['block_settings']['dynamic']); ?>
;
	lang.not_applicable = '<?php echo smarty_modifier_escape(fn_get_lang_var('not_applicable', $this->getLanguage()), 'javascript'); ?>
';

	block_properties = new Array();
	block_location = new Array();
	block_properties_used = new Array();

	<?php echo '
	function fn_check_block_params(new_block, location, block_id, owner)
	{
		var selected_status = new Array();

		var prefix = location + \'_\' + block_id + \'_\';
		var prop = new_block ? \'\' : block_properties[prefix];
		var prop_used = new_block ? \'\' : block_properties_used[prefix];
		var setting_name = \'\';

		selected_status[\'locations\'] = new Array();
		selected_status[\'positions\'] = \'\';

		// Define selected location (tab)
		if (_id = $(\'#add_selected_section\').val()) {
			selected_status[\'locations\'].push(_id);
		}

		section = $(\'#\' + prefix + \'block_object\').val();

		if (!settings[section]) {
			dis = true;
			section = \'products\';
		} else {
			dis = false;
		}

		if (prop !== \'\' && prop_used == false) {
			selected_status = prop;
			block_properties_used[prefix] = true;
		} else {
			for (setting_name in settings[section]) {
				var _val = $(\'#\'  + prefix + \'id_\' + setting_name).val();

				if (!_val || !settings[section][setting_name][_val]) {
					for (var kk in settings[section][setting_name]) {
						_val = kk;
						break;
					}
				}

				selected_status[setting_name] = _val;
			}
		}

		for (setting_name in settings[section]) {
			// Disable static block
			current_dis = (setting_name) == \'positions\' ? false : dis;

			$(\'#\' + prefix + \'id_\' + setting_name).attr(\'disabled\', current_dis);
			var setting = settings[section][setting_name];
			var select = document.getElementById(prefix + \'id_\' + setting_name);

			if (select && select.options) {
				i = 0;
				value = selected_status[setting_name] || $(select).val();
				select.options.length = 0;

				if (current_dis != true) {
					// Check current setting (selectbox), and rebuild selectbox
					for (val in setting) {
						// object, need check condition
						add_option = true;
						if ($(setting[val]).length == 1) {
							for (cond in setting[val].conditions) {
								add_option = false;
								if (selected_status[cond]) {
									for (var ii in setting[val].conditions[cond]) {
										if (setting[val].conditions[cond][ii] == selected_status[cond]) {
											add_option = true;
											break;
										}
									}
								}
							}
						}

						// Check if filling applicable to certain locations only
						if (setting_name == \'fillings\' && setting[val][\'locations\'] && jQuery.inArray(location, setting[val][\'locations\']) == -1) {
							add_option = false;
						}

						if (add_option == true) {
							select.options[i] = new Option(setting[val][\'name\'] || setting[val], val);
							i++;
						}
					}

					selected_status[setting_name] = value;
					$(select).val(value);

					if (owner && select.options.length != 0) {
						if (select.id == prefix + \'id_fillings\' && owner.id != prefix + \'id_positions\' && owner.id != prefix + \'id_appearances\') {
							fn_get_specific_settings($(select).val(), block_id, \'fillings\');
						} else if (select.id == prefix + \'id_appearances\') {
							fn_get_specific_settings($(select).val(), block_id, \'appearances\');
						}
					}
				}

				if (select.options.length == 0 || current_dis == true) {
					// disabled option
					select.options[i] = new Option(lang.not_applicable, \'\');
					select.disabled = true;
					if (select.id == prefix + \'id_fillings\') {
						$(\'#toggle_\' + block_id + \'_fillings\').empty();
					} else if (select.id == prefix + \'id_appearances\') {
						$(\'#toggle_\' + block_id + \'_appearances\').empty();
					}
				}
			}
		}

		return true;
	}

	function fn_show_block_picker(data)
	{
		jQuery.show_picker(\'edit_block_picker\', null, \'.object-container\');
	}

	function fn_get_specific_settings(value, block_id, type)
	{
		jQuery.ajaxRequest(index_script + \'?dispatch=block_manager.specific_settings&type=\' + type + \'&value=\' + value + \'&block_id=\' + block_id, {
			result_ids: \'toggle_\' + block_id + \'_\' + type,
			caching: true,
			callback: function() {
				if ($(\'#toggle_\' + block_id + \'_\' + type).html() == \'\') {
					$(\'#container_\' + block_id + \'_\' + type).hide();
				} else {
					$(\'#container_\' + block_id + \'_\' + type).show();
				}
			}
		});
	}
	'; ?>

//]]>
</script>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('text' => fn_get_lang_var('editing_block', $this->getLanguage()),'content' => $__tpl_vars['content'],'id' => 'edit_block_picker','edit_picker' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>
<?php ob_start(); ?>
<div id="content_<?php echo $__tpl_vars['location']; ?>
">
<div class="block-manager">
	<div id="top_column_holder">
		<h2><?php echo fn_get_lang_var('top', $this->getLanguage()); ?>
</h2>
		<div id="top" class="cm-sortable-items grab-items">
			<?php if ($__tpl_vars['positions']['top']): ?>
			<?php $_from_3744835213 = & $__tpl_vars['positions']['top']; if (!is_array($_from_3744835213) && !is_object($_from_3744835213)) { settype($_from_3744835213, 'array'); }if (count($_from_3744835213)):
    foreach ($_from_3744835213 as $__tpl_vars['block_data']):
?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['blocks'][$__tpl_vars['block_data']['id']],'position' => 'top')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<p class="no-items<?php if ($__tpl_vars['positions']['top']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
		</div>
	</div>
	<div class="clear">
	<div id="left_column_holder" class="float-left">
		<h2><?php echo fn_get_lang_var('left_sidebox', $this->getLanguage()); ?>
</h2>
		<div id="left" class="cm-sortable-items grab-items">
		<?php if ($__tpl_vars['positions']['left']): ?>
			<?php $_from_1063491966 = & $__tpl_vars['positions']['left']; if (!is_array($_from_1063491966) && !is_object($_from_1063491966)) { settype($_from_1063491966, 'array'); }if (count($_from_1063491966)):
    foreach ($_from_1063491966 as $__tpl_vars['block_data']):
?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['blocks'][$__tpl_vars['block_data']['id']],'position' => 'left')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
			<p class="no-items<?php if ($__tpl_vars['positions']['left']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
		</div>
	</div>
	<div id="central_column_holder" class="float-left">
		<h2><?php echo fn_get_lang_var('central', $this->getLanguage()); ?>
</h2>
		<div id="central" class="cm-sortable-items grab-items">
			<?php if ($__tpl_vars['positions']['central']): ?>
				<?php $_from_4254906042 = & $__tpl_vars['positions']['central']; if (!is_array($_from_4254906042) && !is_object($_from_4254906042)) { settype($_from_4254906042, 'array'); }if (count($_from_4254906042)):
    foreach ($_from_4254906042 as $__tpl_vars['block_data']):
?>
					<?php if ($__tpl_vars['blocks'][$__tpl_vars['block_data']['id']]): ?>
						<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['blocks'][$__tpl_vars['block_data']['id']],'position' => 'central')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php elseif ($__tpl_vars['block_data']['content']): ?>
						<div class="cm-list-box">
							<h3><?php echo fn_get_lang_var('central_content', $this->getLanguage()); ?>
</h3>
							<input type="hidden" name="block_positions[]" class="block-position" value="central" />
							<div class="block-content clear">
							<?php if ($__tpl_vars['block_data']['wrapper']): ?>
								<p><label><?php echo fn_get_lang_var('wrapper', $this->getLanguage()); ?>
:</label>
								<?php echo $__tpl_vars['block_data']['wrapper']; ?>
</p>
							<?php endif; ?>

							<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('content' => "",'id' => "central_".($__tpl_vars['location']),'no_table' => true,'but_name' => "dispatch[block_manager.update]",'href' => ($__tpl_vars['index_script'])."?dispatch=block_manager.update&amp;block_id=central&amp;location=".($__tpl_vars['location'])."&amp;position=central",'header_text' => (fn_get_lang_var('editing_block', $this->getLanguage())).": ".(fn_get_lang_var('central_content', $this->getLanguage())))));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							</div>
						</div>
						<?php if ($__tpl_vars['location'] == 'products'): ?>
						<div id="product_details_holder" class="items-container">
							<div id="product_details" class="cm-sortable-items grab-items">
								<h3 align="center"><?php echo fn_get_lang_var('product_details_page_tabs', $this->getLanguage()); ?>
</h3>
								<?php $_from_3611123917 = & $__tpl_vars['blocks']; if (!is_array($_from_3611123917) && !is_object($_from_3611123917)) { settype($_from_3611123917, 'array'); }if (count($_from_3611123917)):
    foreach ($_from_3611123917 as $__tpl_vars['block']):
?>
									<?php if ($__tpl_vars['block']['properties']['positions'] == 'product_details'): ?>
										<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['block'],'position' => 'product_details')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										<?php $this->assign('not_empty', true, false); ?>
									<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
								<p class="no-items<?php if ($__tpl_vars['not_empty']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
								<div class="cm-list-box list-box-invisible"></div>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<p class="no-items<?php if ($__tpl_vars['positions']['central']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
		</div>
	</div>
	<div id="right_column_holder" class="float-left">
		<h2><?php echo fn_get_lang_var('right_sidebox', $this->getLanguage()); ?>
</h2>
		<div id="right" class="cm-sortable-items grab-items">
			<?php if ($__tpl_vars['positions']['right']): ?>
			<?php $_from_2902203020 = & $__tpl_vars['positions']['right']; if (!is_array($_from_2902203020) && !is_object($_from_2902203020)) { settype($_from_2902203020, 'array'); }if (count($_from_2902203020)):
    foreach ($_from_2902203020 as $__tpl_vars['block_data']):
?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['blocks'][$__tpl_vars['block_data']['id']],'position' => 'right')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<p class="no-items<?php if ($__tpl_vars['positions']['right']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
		</div>
	</div>
	</div>
	<div id="bottom_column_holder">
		<h2><?php echo fn_get_lang_var('bottom', $this->getLanguage()); ?>
</h2>
		<div id="bottom" class="cm-sortable-items grab-items">
			<?php if ($__tpl_vars['positions']['bottom']): ?>
			<?php $_from_864466566 = & $__tpl_vars['positions']['bottom']; if (!is_array($_from_864466566) && !is_object($_from_864466566)) { settype($_from_864466566, 'array'); }if (count($_from_864466566)):
    foreach ($_from_864466566 as $__tpl_vars['block_data']):
?>
				<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_element.tpl", 'smarty_include_vars' => array('block_data' => $__tpl_vars['blocks'][$__tpl_vars['block_data']['id']],'position' => 'bottom')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<p class="no-items<?php if ($__tpl_vars['positions']['bottom']): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('no_blocks', $this->getLanguage()); ?>
</p>
		</div>
	</div>
</div>
<input type="hidden" name="block_positions" />
<?php echo smarty_function_script(array('src' => "js/iutil.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/idrag.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/idrop.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/isortables.js"), $this);?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	var h_height = 100;
	var h_width = 300;
	var h_hidden_height = 160;

	$(\'.cm-sortable-items\').Sortable({
		accept: \'cm-list-box\',
		helperclass: \'ui-select\',
		handle: \'h4\',
		tolerance: \'intersect\',
		cursorAt: {top: 60},
		opacity: 0.5,
		onStart: function(elm) {
			$(\'html,body\').css(\'overflow-x\', \'hidden\');
			jQuery.iDrag.helper.children().hide();
			jQuery.iDrag.helper.css(\'height\', h_hidden_height);
			jQuery.iDrag.helper.append(\'<div class="ui-drag-holder"><div class="ui-drag"></div></div>\');
			$(\'.ui-drag\', jQuery.iDrag.helper).css({\'height\': h_height, \'width\' : h_width});
		},
		onStop: function(elm) {
			$(\'html,body\').css(\'overflow-x\', \'\');

			$(\'div.cm-sortable-items\').each(function() {
				$(\'.cm-list-box\', this).length == 0 || $(this).is(\'#product_details\') && $(\'.cm-list-box\', this).length == 1 ? $(\'p.no-items\', this).show() : $(\'p.no-items\', this).hide();
			});
		},
		onDrag: function(elm) {
			var w = jQuery.get_window_sizes();
			var pos = jQuery.iDrag.helper.offset();
			if (pos.top < w.offset_y) {
				$(document).scrollTop(w.offset_y - 20);
			} else if (pos.top + jQuery.iDrag.helper.height() > w.offset_y + w.view_height) {
				$(document).scrollTop(w.offset_y + w.view_height + 20 < $(\'body\').height() ? w.offset_y + 20 : $(\'body\').height() - w.view_height);
			}
		}
	});
});

function fn_form_pre_block_positions_form()
{
	var positions = [];
	var str_positions;

	$(\'.grab-items\').each(function() {
		var self = this;
		if (!positions[self.id]) {
			positions[self.id] = [];
		}
		$(\'#\' + self.id + \' :input\').filter(\'.block-position\').each(function() {
			if ($(this).parents(\'.grab-items:first\').attr(\'id\') == self.id) {
				positions[self.id].push($(this).val());
			}
		});
	});

	for (var section in positions) {
		if (positions[section]) {
			$("input[name=\'block_positions[" + section + "]\']").val(positions[section].join(\',\'));
		}
	}

	return true;
}
//]]>
</script>
'; ?>

</div>

<form action="<?php echo $__tpl_vars['index_script']; ?>
" method="post" name="block_positions_form">
<input type="hidden" name="add_selected_section" value="<?php echo $__tpl_vars['location']; ?>
" />
<input type="hidden" name="block_positions[left]" value="" />
<input type="hidden" name="block_positions[right]" value="" />
<input type="hidden" name="block_positions[central]" value="" />
<input type="hidden" name="block_positions[top]" value="" />
<input type="hidden" name="block_positions[bottom]" value="" />
<?php if ($__tpl_vars['location'] == 'products'): ?>
<input type="hidden" name="block_positions[product_details]" value="" />
<?php endif; ?>

<?php ob_start(); ?>
	<?php ob_start(); ?>
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/update.tpl", 'smarty_include_vars' => array('add_block' => true,'block' => null)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_block','text' => fn_get_lang_var('add_block', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_block', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

<div class="buttons-container cm-toggle-button buttons-bg">
	<div class="float-left">
		<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('but_text' => fn_get_lang_var('save', $this->getLanguage()), 'but_name' => "dispatch[block_manager.save_layout]", 'but_role' => 'button_main', )); ?>

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
	
	<div class="float-right">
		<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_block','text' => fn_get_lang_var('add_block', $this->getLanguage()),'link_text' => fn_get_lang_var('add_block', $this->getLanguage()),'act' => 'general')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>

</form>
<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $__tpl_vars['location'], )); ?>
<?php if (! $__tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $__tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($__tpl_vars['navigation']['tabs']): ?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($__tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from_2538893706 = & $__tpl_vars['navigation']['tabs']; if (!is_array($_from_2538893706) && !is_object($_from_2538893706)) { settype($_from_2538893706, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from_2538893706), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from_2538893706 as $__tpl_vars['key'] => $__tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (! $__tpl_vars['tabs_section'] || $__tpl_vars['tabs_section'] == $__tpl_vars['tab']['section']): ?>
		<li id="<?php echo $__tpl_vars['key']; ?>
<?php echo $__tpl_vars['id_suffix']; ?>
" class="<?php if ($__tpl_vars['tab']['js']): ?>cm-js<?php elseif ($__tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($__tpl_vars['key'] == $__tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($__tpl_vars['tab']['href']): ?>href="<?php echo $__tpl_vars['tab']['href']; ?>
"<?php endif; ?>><?php echo $__tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $__tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $__tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('blocks', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>