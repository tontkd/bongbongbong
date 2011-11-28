{* $Id: manage.tpl 7101 2009-03-20 12:56:51Z zeke $ *}

{capture name="mainbox"}

<form action="{$index_script}" method="post" name="access_restrictions" class="cm-form-highlight">
<input type="hidden" name="selected_section" value="{$selected_section}" />

{notes}
	{$lang.text_access_notice}
{/notes}

{capture name="tabsbox"}

{include file="addons/access_restrictions/views/access_restrictions/components/access_tabs.tpl" selected_section=$selected_section form_name="access_restrictions"}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$selected_section}

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.store_access content=$smarty.capture.mainbox select_languages=true}
