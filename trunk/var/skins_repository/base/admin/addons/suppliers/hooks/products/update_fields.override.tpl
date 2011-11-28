{* $Id: update_fields.override.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

{if $field == "supplier_id"}
	{include file="addons/suppliers/views/products/components/products_m_update.tpl" override_box="Y"}
{/if}