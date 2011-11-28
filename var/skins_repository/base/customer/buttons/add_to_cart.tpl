{* $Id: add_to_cart.tpl 6967 2009-03-04 09:26:06Z angel $ *}

{assign var="c_url" value=$config.current_url|escape:url}

{if $settings.General.allow_anonymous_shopping == "Y" || $auth.user_id}
	{include file="buttons/button.tpl" but_id=$but_id but_text=$but_text|default:$lang.add_to_cart but_name=$but_name but_onclick=$but_onclick but_href=$but_href but_target=$but_target but_role=$but_role|default:"text"}
{else}
	<p>{$lang.text_login_to_add_to_cart}</p>
	{include file="buttons/button.tpl" but_id=$but_id but_text=$lang.sign_in_to_buy but_href="$index_script?dispatch=auth.login_form&amp;return_url=$c_url" but_role=$but_role|default:"text" but_name=""}
{/if}
