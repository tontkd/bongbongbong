{* $Id: account.override.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<option value="P" {if $user_data.user_type == "P" || ($mode == "add" && $smarty.request.user_type == "P")}selected="selected"{/if}>{$lang.affiliate}</option>
