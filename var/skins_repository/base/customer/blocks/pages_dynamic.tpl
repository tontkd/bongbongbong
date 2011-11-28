{* $Id: pages_dynamic.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:dynamic **}

{if $items}
<ul class="tree-list">
{include file="views/pages/components/pages_tree.tpl" tree=$items root=true}
</ul>
{/if}
