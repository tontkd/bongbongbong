{* $Id: tabs_block.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $attachments_data}
<div id="content_attachments">
{foreach from=$attachments_data item="file"}
<p>
{$file.description} ({$file.filename}, {$file.filesize|formatfilesize}) [<a href="{$index_script}?dispatch=attachments.getfile&attachment_id={$file.attachment_id}">{$lang.download}</a>]
</p>
{/foreach}
</div>
{/if}