{* $Id: manage.tpl 6986 2009-03-10 13:35:00Z zeke $ *}

{capture name="tabsbox"}

<div id="content_{$selected_section}">
{include file="addons/affiliate/views/banners_manager/components/banners_list.tpl" prefix=$selected_section}
<!--content_{$selected_section}--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" tabs=$page_sections content=$smarty.capture.tabsbox active_tab=$selected_section}

{capture name="mainbox_title"}{$mainbox_title}{/capture}