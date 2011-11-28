{* $Id: tools.tpl 7745 2009-07-21 07:15:15Z alexions $ *}

<a class="select-link cm-combo-on cm-combination" id="sw_select_wrap_{$suffix}">{$link_text|default:"tools"}</a>

<div id="select_wrap_{$suffix}" class="select-popup cm-popup-box hidden left">
	<img src="{$images_dir}/icons/icon_close.gif" width="13" height="13" border="0" alt="" class="close-icon no-margin cm-popup-switch" />
	{$tools_list|replace:"<ul>":"<ul class=\"cm-select-list\">"}
</div>