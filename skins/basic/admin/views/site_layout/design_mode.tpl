{* $Id: design_mode.tpl 7128 2009-03-25 10:02:46Z zeke $ *}

{capture name="mainbox"}
<div class="clear">
	<form action="{$index_script}" method="post" name="translation_mode_form">
	<input type="hidden" name="design_mode" value="translation_mode" />
	{if "TRANSLATION_MODE"|defined}
		{assign var="mode_val" value=$lang.disable_translation_mode}
		{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode]"}
		<a href="{$index_script}?dispatch=profiles.act_as_user&amp;user_id={$auth.user_id}&amp;area=C" target="_blank">{$lang.view_storefront_translation_mode}</a>
	{else}
		{assign var="mode_val" value=$lang.enable_translation_mode}
		{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode.translation_mode]"}
		<input type="hidden" name="disable_mode" value="{if "CUSTOMIZATION_MODE"|defined}customization_mode{/if}" />
	{/if}
	<p>{include file="buttons/button.tpl" but_name=$dispatch_val but_role="button_main" but_text=$mode_val}</p>
	</form>
</div>
<hr />
<div class="clear">
	<form action="{$index_script}" method="post" name="customization_mode_form">
	<input type="hidden" name="design_mode" value="customization_mode" />
	{if "CUSTOMIZATION_MODE"|defined}
		{assign var="mode_val" value=$lang.disable_customization_mode}
		{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode]"}
		<a href="{$index_script}?dispatch=profiles.act_as_user&amp;user_id={$auth.user_id}&amp;area=C" target="_blank">{$lang.view_storefront_customization_mode}</a>
	{else}
		{assign var="mode_val" value=$lang.enable_customization_mode}
		{assign var="dispatch_val" value="dispatch[site_layout.update_design_mode.customization_mode]"}
		<input type="hidden" name="disable_mode" value="{if "TRANSLATION_MODE"|defined}translation_mode{/if}" />
	{/if}
	<p>{include file="buttons/button.tpl" but_name=$dispatch_val but_role="button_main" but_text=$mode_val}</p>
	</form>
</div>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.design_mode content=$smarty.capture.mainbox}
