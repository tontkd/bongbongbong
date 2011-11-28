{* $Id: subscribe.tpl 7806 2009-08-12 10:22:35Z alexions $ *}
{** block-description:mailing_lists **}

{if $mailing_lists}
<form action="{$index_script}" method="post" name="subscribe_form">
<input type="hidden" name="redirect_url" value="{$config.current_url}" />

<p>{$lang.text_signup_for_subscriptions}</p>
{foreach from=$mailing_lists item=list}
	<div class="select-field">
		<input id="mailing_list_{$list.list_id}" type="checkbox" class="checkbox" name="mailing_lists[{$list.list_id}]" value="1" />
		<label for="mailing_list_{$list.list_id}">{$list.object}</label>
	</div>
{/foreach}
<select name="newsletter_format" id="newsletter_format">
	<option value="{$smarty.const.NEWSLETTER_FORMAT_TXT}">{$lang.txt_format}</option>
	<option value="{$smarty.const.NEWSLETTER_FORMAT_HTML}">{$lang.html_format}</option>
</select>
{strip}
<div class="form-field">
	<label for="subscr_email" class="cm-required cm-email hidden">{$lang.email}</label>
	<input type="text" name="subscribe_email" id="subscr_email" size="20" value="{$lang.enter_email|escape:html}" class="input-text cm-hint" />
	{include file="buttons/go.tpl" but_name="newsletters.add_subscriber" alt=$lang.go}
</div>
{/strip}
</form>
{/if}
