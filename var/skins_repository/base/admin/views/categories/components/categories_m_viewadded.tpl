{* $Id: categories_m_viewadded.tpl 5626 2008-07-21 07:47:04Z brook $ *}

{* NOTE: This template doesn\'t used for direct display
   It will store in the session and then display into notification box
   ---------------------------------------------------------------
   So, it is STRONGLY recommended to use strip tags in such templates
*}

{strip}
<p>{$lang.text_categories_added}</p>
{foreach from=$added_categories item=category}
<p><a href="{$index_script}?dispatch=categories.update&amp;category_id={$category.category_id}">{$category.category}</a></p>
{/foreach}
{/strip}
