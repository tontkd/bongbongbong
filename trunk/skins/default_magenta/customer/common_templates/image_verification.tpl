{* $Id: image_verification.tpl 7497 2009-05-19 10:41:21Z zeke $ *}

{if ""|fn_needs_image_verification == true}

<p{if $align} class="{$align}"{/if}>{$lang.image_verification_body}</p>

{if $sidebox}
	<p><img id="verification_image_{$id}" class="image-captcha valign" src="{$config.current_location}/{$index_script}?dispatch=image.captcha&amp;verification_id={$SESS_ID}:{$id}&amp;{$id|uniqid}&amp;" alt="" onclick="this.src += 'reload' ;" /></p>
{/if}

<p><input class="captcha-input-text valign" type="text" name="verification_answer" value= "" />
	{if !$sidebox}
	<img id="verification_image_{$id}" class="image-captcha valign" src="{$config.current_location}/{$index_script}?dispatch=image.captcha&amp;verification_id={$SESS_ID}:{$id}&amp;{$id|uniqid}&amp;" alt="" onclick="this.src += 'reload' ;" />
	{/if}</p>
{/if}
