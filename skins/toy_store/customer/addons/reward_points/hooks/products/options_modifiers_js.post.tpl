{* $Id: options_modifiers_js.post.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $var.point_modifier|floatval}+' {include file="addons/reward_points/common_templates/point_modifier.tpl" mod_type=$var.point_modifier_type mod_value=$var.point_modifier }'{/if}