{* $Id: store_locator.tpl 6986 2009-03-10 13:35:00Z zeke $ *}
{** block-description:store_locator **}

<form action="{$index_script}" method="get" name="track_order_quick">

<p><label for="store_locator_search" class="required-hidden">{$lang.search}:</label></p>

{strip}
<input type="text" size="20" class="input-text" id="store_locator_search" name="q" value="{$store_locator_search.q}" />
{include file="buttons/go.tpl" but_name="store_locator.search" alt=$lang.search}
{/strip}

</form>
