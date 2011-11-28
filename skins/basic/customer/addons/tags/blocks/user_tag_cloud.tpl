{* $Id: user_tag_cloud.tpl 7128 2009-03-25 10:02:46Z zeke $ *}
{** block-description:my_tag_cloud **}

<!--dynamic:user_tags-->
{if $items}
{foreach from=$items item="tag"}
	<a href="{$index_script}?dispatch=tags.view&amp;tag={$tag.tag|escape:url}&amp;see=my" class="tag-level-{$tag.level}">{$tag.tag}</a>&nbsp;({$tag.popularity})
{/foreach}

<p class="right">
	<a class="extra-link" href="{$index_script}?dispatch=tags.summary">{$lang.my_tags_summary}</a>
</p>
{/if}
<!--/dynamic-->