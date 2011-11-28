{* $Id: product_files.tpl 7419 2009-05-05 11:40:34Z lexa $ *}

<table cellspacing="1" cellpadding="5" class="table" width="30%">
<tr>
	<th>{$lang.filename}</th>
	<th>{$lang.filesize}</th>
</tr>
{foreach from=$files item="file"}
<tr>
	<td width="80">
		<a href="{$index_script}?dispatch=orders.get_file&file_id={$file.file_id}&preview=Y"><strong>{$file.file_name}</strong></a>
		{if $file.readme || $file.license}
		<ul class="bullets-list">
		{if $file.license}
			<li><a onclick="$('#license_{$file.file_id}').toggle(); return false;">{$lang.license}</a></li>
			<div class="hidden" id="license_{$file.file_id}">{$file.license|unescape}</div>
		{/if}
		{if $file.readme}
			<li><a onclick="$('#readme_{$file.file_id}').toggle(); return false;">{$lang.readme}</a></li>
			<div class="hidden" id="readme_{$file.file_id}">{$file.readme|unescape}</div>
		{/if}
		</ul>
		{/if}
	</td>
	<td width="20%" valign="top">
		 <strong>{$file.file_size|formatfilesize}</strong>
	</td>
{/foreach}
</table>
