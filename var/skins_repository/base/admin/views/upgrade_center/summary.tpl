{* $Id: summary.tpl 7243 2009-04-10 08:59:36Z zeke $ *}

{capture name="mainbox"}

<p>
{$lang.text_uc_upgrade_completed}
</p>

<a href="{$index_script}?dispatch=upgrade_center.revert&amp;package={$smarty.request.package|escape:url}">{$lang.revert}</a>

<a href="{$index_script}?dispatch=upgrade_center.manage">{$lang.upgrade_center}</a>


{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.summary content=$smarty.capture.mainbox}
