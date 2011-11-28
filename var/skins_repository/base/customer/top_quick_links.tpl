{* $Id: top_quick_links.tpl 7257 2009-04-14 06:30:22Z angel $ *}

<p class="quick-links">&nbsp;
	{foreach from=$quick_links item="link"}
		<a href="{$link.param}">{$link.descr}</a>
	{/foreach}
</p>
