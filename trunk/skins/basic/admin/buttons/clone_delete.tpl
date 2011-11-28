{* $Id: clone_delete.tpl 7162 2009-03-31 10:08:36Z zeke $ *}

{if $href_clone}
<a class="clone-item" href="{$href_clone}"><img src="{$images_dir}/icons/icon_clone.gif" width="13" height="18" border="0" alt="{$lang.clone_this_item|escape:html}" title="{$lang.clone_this_item|escape:html}" /></a>
{/if}
<a class="delete-item {if !$no_confirm}cm-confirm{/if}{if $microformats} {$microformats}{/if}" {if $href_delete}href="{$href_delete}"{/if} {if $rev_delete}rev="{$rev_delete}"{/if}><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" alt="{$lang.delete|escape:html}" title="{$lang.delete|escape:html}" /></a>