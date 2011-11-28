{* $Id: help.tpl 6780 2009-01-16 13:16:57Z zeke $ *}

{if $content}
{script src="js/picker.js"}
{script src="js/jquery.easydrag.js"}
<div class="float-right">
	{capture name="notes_picker"}
		<div class="object-container">
			{$content}
		</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" act="notes" id="content_`$id`_notes" text=$text content=$smarty.capture.notes_picker link_text="?"}
</div>
{/if}