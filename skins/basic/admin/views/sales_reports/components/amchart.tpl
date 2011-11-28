{* $Id: amchart.tpl 5626 2008-07-21 07:47:04Z brook $ *}
<!-- amchart script-->
	<div id="flashcontent_{$chart_id}am{$type}" align="center">
		<strong>{$lang.upgrade_flash_player}</strong>
	</div>
	{assign var="setting_type" value=$set_type|default:$type}
	<script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("{$config.current_path}/lib/amcharts/am{$type}/am{$type}.swf", "{$chart_id}am{$type}", "{$chart_width|default:'650'}", "{$chart_height|default:'500'}", "8", "{$chart_bgcolor|default:'#FFFFFF'}");
		so.addVariable("path", "{$config.current_path}/lib/amcharts/am{$type}/");
		so.addVariable("settings_file", escape("{$index_script}?dispatch={$controller}.get_settings&type={$type}&setting_type={$setting_type}&title=" + encodeURI("{$chart_title|escape:javascript}")));
		so.addVariable("chart_data", encodeURIComponent('{$chart_data|escape:"javascript"}'));
		so.addVariable("preloader_color", "#999999");
		so.write("flashcontent_{$chart_id}am{$type}");
		// ]]>
	</script>
<!-- end of amchart script -->
