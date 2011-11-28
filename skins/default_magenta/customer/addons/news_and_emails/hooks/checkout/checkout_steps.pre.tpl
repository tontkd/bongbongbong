{* $Id: checkout_steps.pre.tpl 7271 2009-04-15 06:46:41Z angel $ *}

{if $page_mailing_lists}

	{include file="common_templates/subheader.tpl" title=$lang.mailing_lists}

	<p>{$lang.text_signup_for_subscriptions}</p>
	
	{foreach from=$page_mailing_lists item=list}
		<div class="select-field">
			<input type="hidden" name="mailing_lists[{$list.list_id}]" value="0" />
			<input type="checkbox" name="mailing_lists[{$list.list_id}]" value="1" {if $user_mailing_lists[$list.list_id]}checked="checked"{/if} class="checkbox" /><label>{$list.object}</label>
		</div>
	{/foreach}
	

	<select name="newsletter_format">
		<option value="{$smarty.const.NEWSLETTER_FORMAT_TXT}" {if $newsletter_format == $smarty.const.NEWSLETTER_FORMAT_TXT}selected="selected"{/if}>{$lang.txt_format}</option>
		<option value="{$smarty.const.NEWSLETTER_FORMAT_HTML}" {if $newsletter_format == $smarty.const.NEWSLETTER_FORMAT_HTML}selected="selected"{/if}>{$lang.html_format}</option>
	</select>

{/if}