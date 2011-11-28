{* $Id: products_m_update.tpl 5996 2008-09-25 14:51:26Z zeke $ *}

	<table cellpadding="1" cellspacing="1" border="0">
	{foreach from=$v item="membership" key="membership_id"}
	<tr>
		<td>{$membership}:</td>
		<td>&nbsp;</td>
		<td><input type="text" {if $override_box}id="field_{$field}__"{/if} value="{$product.reward_points.$membership_id.amount|default:"0"}" class="input-text" name="{if $override_box}override_reward_points[{$membership_id}]{else}reward_points[{$product.product_id}][{$membership_id}]{/if}" class="elm-disabled" {if $override_box}disabled="disabled"{/if} /></td>
	</tr>
	{/foreach}
	<tr>
		<td>{$lang.not_a_member}:</td>
		<td>&nbsp;</td>
		<td><input type="text" {if $override_box}id="field_{$field}__"{/if} value="{$product.reward_points.0.amount|default:"0"}" class="input-text" name="{if $override_box}override_reward_points[0]{else}reward_points[{$product.product_id}][0]{/if}" {if $override_box}disabled="disabled"{/if} /></td>
	</tr>
	</table>
