{* $Id: logos.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<p>{$lang.text_gift_certificate_logo}</p>
<div class="clear">
	{include file="common_templates/fileuploader.tpl" var_name="logotypes[G]"}
	<div class="float-left"><img class="solid-border" src="{$config.current_path}/skins/{$settings.skin_name_customer}/mail/images/{$customer_manifest.Gift_certificate_logo.filename}" width="{$customer_manifest.Gift_certificate_logo.width}" height="{$customer_manifest.Gift_certificate_logo.height}" /></div>
</div>
<hr />