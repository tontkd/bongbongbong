{* $Id: content.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<td>{if $person.type == "chat"}<a href="{$index_script}?dispatch=statistics.visitors&amp;report=by_ip&amp;ip={$person.ip|escape:url}">{$lang.view}&nbsp;&raquo;</a>{else}&nbsp;{/if}</td>