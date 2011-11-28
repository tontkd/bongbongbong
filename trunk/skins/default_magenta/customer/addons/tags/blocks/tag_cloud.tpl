{* $Id: tag_cloud.tpl 7127 2009-03-25 08:27:40Z angel $ *}
{** block-description:tag_cloud **}

{if $items}
{foreach from=$items item="tag"}
	<a href="{$index_script}?dispatch=tags.view&amp;tag={$tag.tag|escape:url}" class="tag-level-{$tag.level}">{$tag.tag}</a>
{/foreach}
{/if}