{* $Id: button_popup_link.tpl 7330 2009-04-22 06:31:55Z lexa $ *}

{if $but_role == "act" || $but_role == "action"}
	{assign var="file_prefix" value="action_"}
{/if}

<a href="{$but_href}" onclick="window.open(this.href{if $href_extra} + {$href_extra}{/if}, '{$window|default:"popupwindow"}', 'width={$width|default:"550"}, height={$height|default:"450"}, toolbar={$toolbar|default:"no"}, status={$status|default:"no"}, scrollbars={$scrollbars|default:"yes"}, resizable={$resizable|default:"no"}, menubar={$menubar|default:"yes"}, location={$location|default:"no"}, direction={$direction|default:"no"}'); return false;" {if $but_role == "text" || $but_role == "act"}class="text-button"{/if}>{$but_text}</a>
