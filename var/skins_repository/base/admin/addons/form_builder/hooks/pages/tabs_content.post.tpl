{* $Id: tabs_content.post.tpl 7488 2009-05-18 09:59:28Z zeke $ *}

{if $page_type == $smarty.const.PAGE_TYPE_FORM}
<div id="content_build_form">

	{literal}
	<script type="text/javascript">
		//<![CDATA[
		function fn_check_element_type(elm, id, type_id)
		{
			var noopts = 'ITCHDVWXYZFP';
			if (noopts.indexOf(elm) != -1) {
				document.getElementById(id).style.display = 'none';
			} else {
				document.getElementById(id).style.display = '';
			}

			// Hide description box for separator
			document.getElementById('descr_'+type_id).style.display = (elm == 'D') ? 'none' : '';
			document.getElementById('hr_'+type_id).style.display = (elm == 'D') ? '' : 'none';
		}
		//]]>
	</script>
	{/literal}


	<div class="form-field">
		<label for="form_submit_text">{$lang.form_submit_text}:</label>
		{assign var="form_submit_const" value=$smarty.const.FORM_SUBMIT}
		<textarea id="form_submit_text" class="input-textarea-long" rows="5" cols="50" name="page_data[form][general][{$form_submit_const}]" rows="5">{$form.$form_submit_const}</textarea>
		<p>{include file="common_templates/wysiwyg.tpl" id="form_submit_text"}</p>
	</div>

	<div class="form-field">
		<label for="form_recipient" class="cm-required">{$lang.email_to}:</label>
		{assign var="form_recipient_const" value=$smarty.const.FORM_RECIPIENT}
		<input id="form_recipient" class="input-text" name="page_data[form][general][{$form_recipient_const}]" value="{$form.$form_recipient_const}" />
	</div>

	<div class="form-field">
		<label for="form_is_secure">{$lang.form_is_secure}:</label>
		{assign var="form_secure_const" value=$smarty.const.FORM_IS_SECURE}
		<input type="hidden" name="page_data[form][general][{$smarty.const.FORM_IS_SECURE}]" value="N" />
		<input type="checkbox" id="form_is_secure" class="checkbox" value="Y" {if $form.$form_secure_const == "Y"}checked="checked"{/if} name="page_data[form][general][{$form_secure_const}]" />
	</div>

	{include file="addons/form_builder/views/pages/components/pages_form_elements.tpl"}

</div>
{/if}