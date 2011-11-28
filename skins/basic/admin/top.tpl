{* $Id: top.tpl 7764 2009-07-30 08:03:31Z angel $ *}

<div id="header">
	<div id="logo">
		<a href="{$index_script}"><img src="{$images_dir}/{$manifest.Admin_logo.filename}" width="{$manifest.Admin_logo.width}" height="{$manifest.Admin_logo.height}" border="0" alt="{$settings.Company.company_name}" title="{$settings.Company.company_name}" /></a>
	</div>
	
	<div id="top_quick_links">
		{if $auth.user_id}
		<div>
			{hook name="index:top"}
			<span class="underline">{$lang.users_online}:&nbsp;<strong>{$users_online}</strong></span>
			{/hook}
		</div>

		<div>
			{if $languages|sizeof > 1}
			{include file="common_templates/select_object.tpl" style="graphic" link_tpl=$config.current_url|fn_link_attach:"sl=" items=$languages selected_id=$smarty.const.CART_LANGUAGE display_icons=true key_name="name" language_var_name="sl" class="languages"}
			{/if}
			{if $languages|sizeof > 1 && $currencies|sizeof > 1}&nbsp;|&nbsp;{/if}
			{if $currencies|sizeof > 1}
			{include file="common_templates/select_object.tpl" style="graphic" link_tpl=$config.current_url|fn_link_attach:"currency=" items=$currencies selected_id=$secondary_currency display_icons=false key_name="description"}
			{/if}
		</div>
		<div class="nowrap">
			{include file="top_quick_links.tpl"}
		</div>
		{/if}
	</div>
	
	<div id="menu_first_level">
		{if $auth.user_id}
		<ul id="menu_first_level_ul" class="clear">
			<li id="tabs_home" {if !$navigation.selected_tab}class="cm-active"{/if}><a href="{$index_script}">&nbsp;</a></li>
			{foreach from=$navigation.static key=title item=m}
			<li {if $title == $navigation.selected_tab}class="cm-active"{/if} id="tabs_{$title}"><a onclick="fn_switch_tab('{$title}')">{$lang.$title}</a></li>
			{/foreach}
		</ul>
		{/if}
	</div>
	
	<div id="menu_second_level">
		{if $auth.user_id}
		{foreach from=$navigation.static key=title item=m}
		<ul id="elements_{$title}" class="clear{if $title != $navigation.selected_tab} hidden{/if}">
			{foreach from=$m key=_title item=_m name=sec_level}
			<li class="{if $_title == $navigation.subsection && $title == $navigation.selected_tab}cm-active{/if} {if $smarty.foreach.sec_level.last}no-border{/if}"><a href="{$_m.href}">{$lang.$_title}</a></li>
			{/foreach}
		</ul>
		{/foreach}
		{/if}
	</div>
<!--header--></div>

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_switch_tab(section)
{
	$('#menu_second_level ul').each(function(){
		var self = $(this);
		self.toggleBy(self.attr('id') != 'elements_' + section)
	});

	$('#menu_first_level_ul li').each(function(){
		var self = $(this);
		if (self.attr('id') != 'tabs_' + section) {
			self.removeClass('cm-active');
		} else {
			self.addClass('cm-active');
		}
	});
}
//]]>
</script>
{/literal}			