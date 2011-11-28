{* $Id: select_popup.tpl 7770 2009-07-30 14:03:41Z angel $ *}

{assign var="prefix" value=$prefix|default:"select"}
<div class="select-popup-container">
	<div {if $id}id="sw_{$prefix}_{$id}_wrap"{/if} class="selected-status status-{if $suffix}{$suffix}-{/if}{$status|lower}{if $id} cm-combo-on cm-combination{/if}">
		<a {if $id}class="cm-combo-on{if !$popup_disabled} cm-combination{/if}"{/if}>
		{if $items_status}
			{if !$items_status|is_array}
				{assign var="items_status" value=$items_status|yaml_unserialize}
			{/if}
			{$items_status.$status}
		{else}
			{if $status == "A"}
				{$lang.active}
			{elseif $status == "D"}
				{$lang.disabled}
			{elseif $status == "H"}
				{$lang.hidden}
			{elseif $status == "P"}
				{$lang.pending}
			{/if}
		{/if}
		</a>
	</div>
	{if $id}
		<div id="{$prefix}_{$id}_wrap" class="popup-tools cm-popup-box hidden">
			<img src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
			<ul class="cm-select-list">
			{if $items_status}
				{foreach from=$items_status item="val" key="st"}
				<li><a class="status-link-{$st|lower} {if $status == $st}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{$index_script}?dispatch={$update_controller|default:"tools"}.update_status&amp;id={$id}&amp;status={$st}{if $table && $object_id_name}&amp;table={$table}&amp;id_name={$object_id_name}{/if}{$extra}" onclick="return fn_check_object_status(this, '{$st|lower}');" name="update_object_status_callback">{$val}</a></li>
				{/foreach}
			{else}
				<li><a class="status-link-a {if $status == "A"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{$index_script}?dispatch={$update_controller|default:"tools"}.update_status&amp;id={$id}&amp;table={$table}&amp;id_name={$object_id_name}&amp;status=A" onclick="return fn_check_object_status(this, 'a');" name="update_object_status_callback">{$lang.active}</a></li>
				<li><a class="status-link-d {if $status == "D"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{$index_script}?dispatch={$update_controller|default:"tools"}.update_status&amp;id={$id}&amp;table={$table}&amp;id_name={$object_id_name}&amp;status=D" onclick="return fn_check_object_status(this, 'd');" name="update_object_status_callback">{$lang.disabled}</a></li>
				{if $hidden}
				<li><a class="status-link-h {if $status == "H"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{$index_script}?dispatch={$update_controller|default:"tools"}.update_status&amp;id={$id}&amp;table={$table}&amp;id_name={$object_id_name}&amp;status=H" onclick="return fn_check_object_status(this, 'h');" name="update_object_status_callback">{$lang.hidden}</a></li>
				{/if}
			{/if}
			{if $notify}
				<li class="select-field">
					<input type="checkbox" name="__notify_user" id="{$prefix}_{$id}_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
					<label for="{$prefix}_{$id}_notify">{$notify_text|default:$lang.notify_customer}</label>
				</li>
			{/if}
			</ul>
		</div>
		{if !$smarty.capture.avail_box}
		<script type="text/javascript">
		//<![CDATA[
		{literal}
		function fn_check_object_status(obj, status) 
		{
			if ($(obj).hasClass('cm-active')) {
				$(obj).removeClass('cm-ajax');
				return false;
			}
			fn_update_object_status(obj, status);
			return true;
		}
		function fn_update_object_status_callback(data, params) 
		{
			if (data.return_status && params.preload_obj) {
				fn_update_object_status(params.preload_obj, data.return_status.toLowerCase());
			}
		}
		function fn_update_object_status(obj, status)
		{
			var upd_elm_id = $(obj).parents('.cm-popup-box:first').attr('id');
			var upd_elm = $('#' + upd_elm_id);
			upd_elm.hide();
			if ($('input[name=__notify_user]:checked', upd_elm).length) {
				$(obj).attr('href', $(obj).attr('href') + '&notify_user=Y');
			} else {
				$(obj).attr('href', fn_query_remove($(obj).attr('href'), 'notify_user'));
			}
			$('.cm-select-list li a', upd_elm).removeClass('cm-active').addClass('cm-ajax');
			$('.status-link-' + status, upd_elm).addClass('cm-active');
			$('#sw_' + upd_elm_id + ' a').text($('.status-link-' + status, upd_elm).text());
			{/literal}
			$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-{if $suffix}{$suffix}-{/if}' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
			{literal}
		}
		{/literal}
		//]]>
		</script>
		{capture name="avail_box"}Y{/capture}
		{/if}
	{/if}
</div>

