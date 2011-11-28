{* $Id: logos.tpl 7024 2009-03-12 14:57:54Z zeke $ *}

{** include fileuploader **}
{include file="common_templates/file_browser.tpl"}
{** /include fileuploader **}

{capture name="mainbox"}
<form action="{$index_script}" method="post" name="logotypes_form" enctype="multipart/form-data">

<p>{$lang.text_customer_area_logo}</p>
<div class="clear">
	{include file="common_templates/fileuploader.tpl" var_name="logotypes[C]"}
	<div class="float-left"><img class="solid-border" src="{$config.current_path}/skins/{$settings.skin_name_customer}/customer/images/{$customer_manifest.Customer_logo.filename}" width="{$customer_manifest.Customer_logo.width}" height="{$customer_manifest.Customer_logo.height}" /></div>
</div>
<hr />

<p>{$lang.text_mail_area_logo}</p>
<div class="clear">
	{include file="common_templates/fileuploader.tpl" var_name="logotypes[M]"}
	<div class="float-left"><img class="solid-border" src="{$config.current_path}/skins/{$settings.skin_name_customer}/mail/images/{$customer_manifest.Mail_logo.filename}" width="{$customer_manifest.Mail_logo.width}" height="{$customer_manifest.Mail_logo.height}" /></div>
</div>
<hr />

{hook name="site_layout:logos"}
{/hook}

<p>{$lang.text_admin_panel_logo}</p>
<div class="clear">
	{include file="common_templates/fileuploader.tpl" var_name="logotypes[A]"}
	<div class="float-left"><img class="solid-border" src="{$config.current_path}/skins/{$settings.skin_name_admin}/admin/images/{$manifest.Admin_logo.filename}" width="{$manifest.Admin_logo.width}" height="{$manifest.Admin_logo.height}" /></div>
</div>

<p>{$lang.text_signin_logo}</p>
<div class="clear">
        {include file="common_templates/fileuploader.tpl" var_name="logotypes[L]"}
        <div class="float-left"><img class="solid-border" src="{$config.current_path}/skins/{$settings.skin_name_admin}/admin/images/{$manifest.Signin_logo.filename}" width="{$manifest.Signgin_logo.width}" height="{$manifest.Signin_logo.height}" /></div>
</div>

<div class="buttons-container buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[site_layout.update_logos]"}
</div>

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.logos content=$smarty.capture.mainbox}
