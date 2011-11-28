{* $Id: breadcrumbs.tpl 7532 2009-05-26 08:18:56Z angel $ *}

{if $breadcrumbs && $breadcrumbs|@sizeof > 1}
	<div class="breadcrumbs">
		{strip}
			{foreach from=$breadcrumbs item="bc" name="bcn" key="key"}
				{if $key != "0"}
					<img src="{$images_dir}/icons/breadcrumbs_arrow.gif" class="bc-arrow" border="0" alt="&gt;" />
				{/if}
				{if $bc.link}
					<a href="{$bc.link}"{if $additional_class} class="{$additional_class}"{/if}>{$bc.title|unescape}</a>
				{else}
					{$bc.title|unescape}
				{/if}
			{/foreach}
		{/strip}
	</div>
{/if}