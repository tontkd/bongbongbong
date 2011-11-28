{* $Id: manage.tpl 6971 2009-03-05 09:28:18Z zeke $ *}

{script src="js/picker.js"}
{script src="js/tabs.js"}

{capture name="mainbox"}

<div id="static_data_list">
{if $section_data.multi_level == true}
	<div class="items-container multi-level">
	{include file="views/static_data/components/multi_list.tpl" items=$static_data header=true}
	</div>
{else}
	{include file="views/static_data/components/single_list.tpl}
{/if}
<!--static_data_list--></div>

<div class="buttons-container">
	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/static_data/update.tpl" mode="add" static_data=""}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_section" text=$lang[$section_data.add_title] content=$smarty.capture.add_new_picker link_text=$lang[$section_data.add_button] act="general"}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_section" text=$lang[$section_data.add_title] link_text=$lang[$section_data.add_button] act="general"}
</div>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang[$section_data.mainbox_title] content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}