{* $Id: backup.tpl 7406 2009-04-30 13:57:33Z zeke $ *}

{capture name="mainbox"}


<table width="100%">
<tr>
        <td valign="top" width="50%">
                <p>{$lang.text_uc_backup_files}</p>

                <div class="table scrollable">
                        <h5>{$lang.file}</h5>
                        <div class="uc-package-contents">
                {foreach from=$backup_details.files item="c"}
                        <p title="{$c}">
                                <span class="float-left">{$c|truncate:60:"&nbsp;...&nbsp;":true:true}</span>
                                <span class="uc-ok float-right">{$lang.uc_ok}</span>
                        </p>
                {foreachelse}
                        <p class="no-items">
                        {$lang.no_data}
                        </p>
                {/foreach}
                        </div>
                </div>

        </td>
        <td valign="top" width="50%">
                <p>{$lang.text_uc_backup_database}</p>

                <div class="table scrollable">
                        <h5>{$lang.table}</h5>
                        <div class="uc-package-contents">
                {foreach from=$backup_details.tables item="c"}
                        <p title="{$c}">
                                <span class="float-left">{$c|truncate:60:"&nbsp;...&nbsp;":true:true}</span>
                                <span class="uc-ok float-right">{$lang.uc_ok}</span>
                        </p>
                {foreachelse}
                        <p class="no-items">
                        {$lang.no_data}
                        </p>
                {/foreach}
                        </div>
                </div>
        </td>
</tr>
</table>

<form action="{$index_script}" method="get" name="uc_check_form">
<div class="buttons-container buttons-bg">
        {include file="buttons/button.tpl" but_text=$lang.continue but_name="dispatch[upgrade_center.upgrade]" but_role="button_main"}
</div>
</form>


{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.backup content=$smarty.capture.mainbox}
