{* $Id: installed_upgrades.tpl 6772 2009-01-15 15:15:09Z zeke $ *}

{capture name="mainbox"}

{foreach from=$packages item="package" name="fep" key="p"}
	{include file="common_templates/subheader.tpl" title=$package.details.name}

	<p>
		<a class="tool-link cm-confirm" href="{$index_script}?dispatch=upgrade_center.revert&amp;package={$p|escape:url}&amp;redirect_url={$config.current_url|escape:url}">{$lang.revert}</a>&nbsp;|&nbsp;<a class="tool-link cm-confirm" href="{$index_script}?dispatch=upgrade_center.remove&amp;package={$p|escape:url}">{$lang.remove}</a>
	</p>

	<div class="order-info">
	{$lang.version}:&nbsp;<span>{$package.details.to_version}</span>,&nbsp;{$lang.release_date}:&nbsp;<span>{$package.details.timestamp|date_format:"`$settings.Appearance.date_format` `$settings.Appearance.time_format`"}</span>,&nbsp;{$lang.filesize}:&nbsp;<span>{$package.details.size|formatfilesize}</span>
	</div>
	
	<table width="100%">
	<tr>
		<td valign="top" width="50%">
			<p>{$lang.package_contents}</p>

			<div class="table scrollable">
				<h5>{$lang.file}</h5>
				<div class="uc-package-contents">
			{foreach from=$package.details.contents item="c"}
				<p title="{$c}">{$c|truncate:85:"&nbsp;...&nbsp;":true:true}</p>
			{/foreach}
				</div>
			</div>
		</td>
		<td valign="top" width="50%">
			<p>{$lang.text_uc_conflicts}</p>

			<div class="table scrollable">
				<h5>{$lang.file}</h5>
				<div class="uc-package-contents">
			{foreach from=$package.files key="c" item="s"}
				<p title="{$c}">
					<span class="float-left">{$c|truncate:60:"&nbsp;...&nbsp;":true:true}</span>
					<span class="float-right"><a class="tool-link" href="{$index_script}?dispatch=upgrade_center.diff&amp;file={$c|escape:url}&amp;package={$p|escape:url}">{$lang.changes}</a>&nbsp;&nbsp;&nbsp;{if $s == true}<span class="uc-ok">{$lang.resolved}</span>&nbsp;<a class="tool-link" href="{$index_script}?dispatch=upgrade_center.conflicts.unmark&amp;file={$c|escape:url}&amp;package={$p|escape:url}">{$lang.unmark}</a>{else}<a class="tool-link" href="{$index_script}?dispatch=upgrade_center.conflicts.mark&amp;file={$c|escape:url}&amp;package={$p|escape:url}">{$lang.mark}</a>{/if}</span>
				</p>
			{foreachelse}
				<p class="no-items">
				{$lang.text_no_conflicts}
				</p>
			{/foreach}
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>&nbsp;</p>
			{$package.details.description|unescape}
		</td>
	</tr>

	</table>

{foreachelse}
	<p class="no-items">{$lang.no_data}</p>
{/foreach}


{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.installed_upgrades content=$smarty.capture.mainbox}
