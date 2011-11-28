{* $Id: membership_activation.tpl 6747 2009-01-13 09:00:52Z zeke $ *}

{include file="letter_header.tpl"}

{$lang.text_membership_activated}<br>
<p>
<table>
<tr>
	<td>{$lang.membership}:</td>
	<td><b>{foreach from=$memberships item=m}{if $user_data.membership_id == $m.membership_id}{$m.membership}{/if}{/foreach}</b></td>
</tr>
<tr>
	<td>{$lang.username}:</td>
	<td>{$user_data.user_login}</td>
</tr>
<tr>
	<td>{$lang.name}:</td>
	<td>{$user_data.firstname}&nbsp;{$user_data.lastname}</td>
</tr>
</table>
</p>
{include file="letter_footer.tpl"}
