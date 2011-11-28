{* $Id: top_menu.tpl 7521 2009-05-22 07:11:50Z angel $ *}

{if $top_menu}
<div id="top_menu">
{strip}
<ul class="top-menu dropdown">
	{foreach from=$top_menu item="m"}
	<li class="first-level {if $m.selected == true}cm-active{/if}">
		<span><a {if $m.href}href="{$m.href}"{/if}>{$m.item}</a></span>
		{if $m.subitems}
			{include file="top_menu.tpl" items=$m.subitems top_menu="" dir=$m.param_4}
		{/if}
	</li>
	{/foreach}
</ul>
{/strip}
</div>
<span class="helper-block">&nbsp;</span>
{elseif $items}
<ul {if $dir == "left"}class="dropdown-vertical-rtl"{/if}>
	{assign var="foreach_name" value="cats_$iter"}
	{foreach from=$items item="_m" name=$foreach_name}
	<li {if $_m.subitems}class="dir"{/if}>
		<a href="{$_m.href}">{$_m.item}</a>
		{if $_m.subitems}
			{include file="top_menu.tpl" items=$_m.subitems top_menu="" dir=$_m.param_4 iter=$smarty.foreach.$foreach_name.iteration+$iter}
		{/if}
	</li>
	{if !$smarty.foreach.$foreach_name.last}
	<li class="h-sep">&nbsp;</li>
	{/if}
	{/foreach}
</ul>
{/if}
