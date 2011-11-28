{* $Id: stars.tpl 7286 2009-04-16 13:13:14Z angel $ *}

<p class="nowrap stars">
{section name="full_star" loop=$stars.full}<img src="{$images_dir}/icons/star_full.gif" width="16" height="15" alt="*" />{/section}
{if $stars.part}<img src="{$images_dir}/icons/star_{$stars.part}.gif" width="16" height="15" alt="" />{/if}
{section name="full_star" loop=$stars.empty}<img src="{$images_dir}/icons/star_empty.gif" width="16" height="15" alt="" />{/section}
</p>