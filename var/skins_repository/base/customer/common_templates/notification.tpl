{* $Id: notification.tpl 6289 2008-11-10 09:22:02Z zeke $ *}

{if !"AJAX_REQUEST"|defined}

<div class="cm-notification-container">
{foreach from=""|fn_get_notifications item="message" key="key"}
<div class="notification-content{if $message.save_state == false} cm-auto-hide{/if}" id="notification_{$key}">
	<div class="notification-{$message.type|lower}">
		<img class="cm-notification-close hand" src="{$images_dir}/icons/notification_close.gif" width="10" height="19" border="0" alt="{$lang.close}" title="{$lang.close}" onclick="jQuery.closeNotification('{$key}', false, true);" />
		<div class="notification-body">
			{$message.message}
		</div>
	</div>
	<h1 class="notification-header-{$message.type|lower}">{$message.title}</h1>
</div>
{/foreach}
</div>

{/if}