{* $Id: bottom.tpl 7806 2009-08-12 10:22:35Z alexions $ *}

{if 'DEBUG_MODE'|defined}
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
{/if}

<div id="bottom_menu">
	<div class="float-left">
		<form id="bottom_quick_search" name="quick_search_form" action="{$index_script}">
			<input type="hidden" value="Y" name="redirect_if_one" />
			<input type="hidden" value="{$lang.quick_search}..." name="_default_search" id="elm_default_search" />
			<input type="text" value="{$search.q|default:"`$lang.quick_search`..."}" name="q" id="quick_search" class="input-text {if $search.q == ""}cm-hint{/if}" />
			{capture name="tools_list"}
			<ul>
				<li><a name="dispatch[products.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'pcode');">{$lang.product_code}</a></li>
				<li><a name="dispatch[orders.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'order_id');">{$lang.order_id}</a></li>
				<li><a name="dispatch[profiles.manage]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'name');">{$lang.user}</a></li>
				{if $settings.General.search_objects}
				<li><a name="dispatch[search.results]" rev="bottom_quick_search" onmouseover="$('#quick_search').attr('name', 'q');">{$lang.search_in_content}</a></li>
				{/if}
			</ul>
			{/capture}
			{include file="buttons/button.tpl" but_text=$lang.search_product but_name="dispatch[products.manage]" but_onclick="$('#quick_search').attr('name', 'q').val($('#quick_search').val() == $('#elm_default_search').val() ? '' : $('#quick_search').val());" but_role="submit" allow_href=true} {$lang.or} {include file="common_templates/tools.tpl" prefix="bottom" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose link_meta="lowercase"}
		</form>
	</div>

	<div class="float-right">
		{include file="common_templates/last_viewed_items.tpl"}
		<div id="bottom_popup_menu_wrap">
			<a id="sw_last_edited_items" class="cm-combo-on cm-combination">{$lang.last_viewed_items}</a>
		</div>
	</div>

	<div class="float-right" id="store_mode">
		{if $settings.store_mode == "closed"}
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="{$index_script}?dispatch=tools.store_mode&amp;state=opened">{$lang.open_store}</a>
		{else}
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="{$index_script}?dispatch=tools.store_mode&amp;state=closed">{$lang.close_store}</a>
		{/if}
	<!--store_mode--></div>
</div>
