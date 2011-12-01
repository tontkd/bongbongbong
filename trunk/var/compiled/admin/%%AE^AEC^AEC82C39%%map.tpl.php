<?php /* Smarty version 2.6.18, created on 2011-11-30 23:41:13
         compiled from addons/store_locator/pickers/map.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'addons/store_locator/pickers/map.tpl', 3, false),array('modifier', 'fn_store_locator_google_langs', 'addons/store_locator/pickers/map.tpl', 6, false),array('modifier', 'escape', 'addons/store_locator/pickers/map.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_address_not_found','close','select_coordinates','set'));
?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php if (! $this->_smarty_vars['capture']['goole_api']): ?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $__tpl_vars['addons']['store_locator']['google_key']; ?>
&amp;hl=<?php echo fn_store_locator_google_langs(@CART_LANGUAGE); ?>
" type="text/javascript"></script>
<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['goole_api'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<script type="text/javascript">
//<![CDATA[
var map;
var saved_point = null;
var marker = null;
var city = null;

var latitude_name = '';
var longitude_name = '';
lang.text_address_not_found = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_address_not_found', $this->getLanguage()), 'javascript'); ?>
';

<?php echo '
function fn_init_map(country_field, city_field, latitude_field, longitude_field)
{
	saved_point = null;
	marker = null;

	latitude_name = latitude_field;
	longitude_name = longitude_field;

	map = new GMap2(document.getElementById("map_canvas"), {draggableCursor: \'crosshair\', draggingCursor: \'pointer\'});
	map.addControl(new GLargeMapControl());
	map.addControl(new GScaleControl());

	if ($(\'#\' + latitude_name).val() && $(\'#\' + longitude_name).val()) {
		var start = new GLatLng($(\'#\' + latitude_name).val(), $(\'#\' + longitude_name).val());
		map.setCenter(start, 15);
		fn_update_point(start);
	} else {
		var address = \'\';
		var value = $(\'#\' + city_field).val();
		if (value) {
			city = value;
			address = value;
		}

		var value = $(\'#\' + country_field).val();
		if (value) {
			if (address) {
				address += \' \';
			}

			address += value;
		}

		var geocoder = new GClientGeocoder();
		geocoder.getLatLng(address, function(point) {
			if (!point) {
				alert(lang.text_address_not_found + \': \' + address);
			} else {
				if (city && city.length) {
					map.setCenter(point, 13);
				} else {
					map.setCenter(point, 5);
				}
			}
		});
	}

	GEvent.addListener(map, \'click\', function(overlay, point)
	{
		if (overlay) {
		} else if (point) {
			fn_update_point(point) ;
		}
	});
}

function fn_update_point(point)
{
	if (saved_point && marker) {
		map.removeOverlay(marker);
	}

	marker = new GMarker(point);

	map.addOverlay(marker);
	saved_point = point;
}

function fn_save_point()
{
	if (saved_point) {
		$(\'#\' + latitude_name).val(saved_point[\'y\']);
		$(\'#\' + longitude_name).val(saved_point[\'x\']);
	}
	jQuery.hide_picker();
}
'; ?>

//]]>
</script>

<div class="popup-content cm-popup-box cm-picker hidden" id="map_picker">
	<div class="cm-popup-content-header">
		<div class="float-right">
			<img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" class="hand cm-popup-switch" />
		</div>
		<h3><?php echo fn_get_lang_var('select_coordinates', $this->getLanguage()); ?>
:</h3>
	</div>
	<div class="cm-popup-content-footer">
		<div class="object-container">
			<div class="map-canvas" id="map_canvas"></div>
		</div>

		<form name="map_picker" action="" method="">
		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_onclick' => "fn_save_point()",'but_type' => 'button','but_text' => fn_get_lang_var('set', $this->getLanguage()),'cancel_action' => 'close')));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		</form>
	</div>
</div>