{* $Id: create_profile_subj.tpl 5807 2008-08-26 09:27:03Z zeke $ *}

{assign var='u_type' value=$user_data.user_type|fn_get_user_type_description|lower}
{$settings.Company.company_name}: {$lang.new_profile_notification|replace:'[user_type]':$u_type}