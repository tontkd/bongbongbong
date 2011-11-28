{* $Id: manage.tpl 6613 2008-12-19 12:46:16Z angel $ *}

{capture name="mainbox"}

	{capture name="tabsbox"}

	<form action="{$index_script}" method="post" name="language_variables_form">
	<input type="hidden" name="location" value="index" />

	<div id="content_home">
	<fieldset>
		<div class="form-field">
			<label for="lang_data_value" class="cm-required">{$lang.page_title}:</label>
			<input type="hidden" name="lang_data[0][name]" value="page_title_text" />
			<input type="text" name="lang_data[0][value]" id="lang_data_value" size="85" class="input-text-long main-input" value="{$general_content.page_title_text}" />
		</div>

		<div class="form-field">
			<label for="index_page_text">{$lang.text_edit_index_page_text}:</label>
			<input type="hidden" name="lang_data[1][name]" value="text_welcome" />
			<textarea id="index_page_text" name="lang_data[1][value]" cols="85" rows="15" class="input-textarea-long">{$general_content.text_welcome}</textarea>
			<p>{include file="common_templates/wysiwyg.tpl" id="index_page_text"}</p>
		</div>

		<div class="form-field">
			<label for="meta_description">{$lang.meta_description}:</label>
			<input type="hidden" name="lang_data[2][name]" value="home_meta_description" />
			<textarea name="lang_data[2][value]" id="meta_description" cols="55" rows="3" class="input-textarea-long">{$general_content.home_meta_description}</textarea>
		</div>

		<div class="form-field">
			<label for="meta_keywords">{$lang.meta_keywords}:</label>
			<input type="hidden" name="lang_data[3][name]" value="home_meta_keywords" />
			<textarea name="lang_data[3][value]" id="meta_keywords" cols="55" rows="2" class="input-textarea-long">{$general_content.home_meta_keywords}</textarea>
		</div>

		{hook name="site_layout:detailed_content"}
		{/hook}
	</fieldset>
	<!--content_home--></div>

	{hook name="site_layout:tabs_content"}
	{/hook}

	<div class="buttons-container buttons-bg cm-toggle-button">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[site_layout.update_variables]"}
	</div>
	</form>

	{hook name="site_layout:tabs_extra"}
	{/hook}

	{/capture}
	{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.site_layout content=$smarty.capture.mainbox select_languages=true}
