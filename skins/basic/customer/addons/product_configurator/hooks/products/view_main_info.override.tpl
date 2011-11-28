{* $Id: view_main_info.override.tpl 7574 2009-06-10 13:15:30Z lexa $ *}

{if $product_configurator_steps}
{assign var="product_id" value=$product.product_id}
{assign var="product_configurator_groups" value=$product_configurator_groups}

{script src="addons/product_configurator/js/compatibilities.js"}
{script src="js/picker.js"}
{script src="js/jquery.easydrag.js"}

<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax && !$edit_configuration}class="cm-ajax"{/if} action="{$index_script}" method="post" name="product_form_{$obj_id}">
<input type="hidden" name="result_ids" value="cart_status,wish_list" />
<input type="hidden" name="product_data[{$product.product_id}][product_id]" value="{$product.product_id}" />
<input type="hidden" name="product_data[{$product.product_id}][amount]" value="{if $edit_configuration}{$cart_item.amount}{else}1{/if}" />
<input type="hidden" name="product_data[{$product_id}][price]" value="0" />


<div class="clear">
	<div class="product-image">
		{include file="views/products/components/product_images.tpl" product=$product show_detailed_link="Y"}
	</div>

	<div class="product-description product-details-options">

	{include file="views/products/components/buy_now.tpl" product=$product but_role="action" separate_add_button=false show_qty=false show_sku=true capture_buttons=true hide_form=true}

	</div>

	<h2 class="product-config-header">{$lang.product_configuration}</h2>

	{capture name="tabsbox"}
	{foreach from=$product_configurator_steps item="step" name="configurator_steps"}
	<div id="content_pc_{$step.step_id}"{if !$smarty.foreach.configurator_steps.first} class="hidden"{/if}>
	{if $smarty.foreach.configurator_steps.first}
		{assign var="active_tab" value="pc_`$step.step_id`"}
	{/if}
	<table cellpadding="2" cellspacing="0" border="0" width="100%" class="product-configuration">
	{foreach from=$step.product_configurator_groups item="po" name="groups_name"}
	<tr>
		<td colspan="3"{if !$smarty.foreach.groups_name.first} class="field-title"{/if}>
		<div class="info-field-title">
			<div class="float-right">{include file="common_templates/popupbox.tpl" id="description_`$po.group_id`" link_text="?" text=$po.configurator_group_name href="$index_script?dispatch=products.configuration_group&amp;step_id=`$step.step_id`&amp;group_id=`$po.group_id`&amp;product_id=$product_id"}</div>
			{$po.configurator_group_name}
		</div>
		</td>
	</tr>
	{***************** if there is only one product and it is required - just show it **************}
	{if $po.products_count == "1" && $po.required == "Y"}
		{foreach from=$po.products item="group_product"}
		<tbody>
			<tr>
				<td colspan="2" width="100%">
				<input type="hidden" id="group_one_{$po.group_id}" name="product_data[{$product_id}][configuration][{$po.group_id}]" value="{$group_product.product_id}" />
				{include file="common_templates/popupbox.tpl" id="description_`$po.group_id`_`$group_product.product_id`" link_text=$group_product.product text=$group_product.product href="`$index_script`?dispatch=products.configuration_product&amp;group_id=`$po.group_id`&amp;product_id=`$group_product.product_id`"}</td>
				<td>&nbsp;<span class="price">{include file="common_templates/price.tpl" value=$group_product.price}</span>&nbsp;</td>
			</tr>
		{/foreach}
	{else}
	{***************** display the list of products with ability to choose **************}
		{if $po.configurator_group_type == "S"}
			{if $po.products}
			<tr>
				<td width="100%" colspan="2">
				<select name="product_data[{$product_id}][configuration][{$po.group_id}]" id="group_{$po.group_id}" onchange="fn_check_exceptions({$product_id});fn_check_compatibilities({$po.group_id},'select','{$po.configurator_group_type}');">
					<option id="product_0" value="0">{$lang.none}</option>
					{foreach from=$po.products item="group_product"}
					<option id="product_{$group_product.product_id}" value="{$group_product.product_id}" {if $group_product.selected == "Y"}selected="selected"{assign var="selected_exist" value=true}}{/if}>{$group_product.product} <span class="price">{include file="common_templates/price.tpl" value=$group_product.price}</span>{if $group_product.recommended == "Y"}{$lang.recommended}{/if}</option>
					{/foreach}
				</select>
				</td>
				<td>
					<div id="select_{$po.group_id}">
						{foreach from=$po.products item="group_product" name="descr_links"}
							{if $group_product.selected == "Y" || $po.required == "Y" && !$selected_exist && $smarty.foreach.descr_links.first}
								{assign var="cur_class" value=""}
							{else}
								{assign var="cur_class" value="hidden"}
							{/if}
							{include file="common_templates/popupbox.tpl" id="description_`$po.group_id`_`$group_product.product_id`" link_text=$lang.details text=$group_product.product href="`$index_script`?dispatch=products.configuration_product&amp;group_id=`$po.group_id`&amp;product_id=`$group_product.product_id`" link_meta=$cur_class}
						{/foreach}
					</div>
				</td>
			</tr>
			{else}
			<tr>
				<td width="100%" colspan="3">
					<span class="price strong">{$lang.text_no_items_defined|replace:"[items]":$lang.products}</span>
				</td>
			</tr>
			{/if}
		{elseif $po.configurator_group_type == "R" }
			{if $po.products}
			<tbody id="group_{$po.group_id}">
				{foreach from=$po.products item="group_product" name="vars"}
				{if $smarty.foreach.vars.first && $po.required!="Y"}
				<tr>
					<td><input  id="group_{$po.group_id}_product_0" type="radio" class="radio" name="product_data[{$product_id}][configuration][{$po.group_id}]" value="0" onclick="fn_check_exceptions({$product_id});fn_check_compatibilities({$po.group_id}, 0, '{$po.configurator_group_type}');" checked="checked" {if $group_product.disabled == true}disabled="disabled"{/if} /></td>
					<td>&nbsp;{$lang.none}</td>
					<td>&nbsp;</td>
				</tr>
				{/if}
				<tr>
					<td><input type="radio" class="radio" id="group_{$po.group_id}_product_{$group_product.product_id}" name="product_data[{$product_id}][configuration][{$po.group_id}]" value="{$group_product.product_id}" onclick="fn_check_exceptions({$product_id});fn_check_compatibilities({$po.group_id},{$group_product.product_id}, '{$po.configurator_group_type}');" {if $group_product.selected == "Y"}checked="checked"{/if} {if $group_product.disabled == true}disabled="disabled"{/if} /></td>
					<td width="100%">{include file="common_templates/popupbox.tpl" id="description_`$po.group_id`_`$group_product.product_id`" link_text=$group_product.product text=$group_product.product href="`$index_script`?dispatch=products.configuration_product&amp;group_id=`$po.group_id`&amp;product_id=`$group_product.product_id`"}</td>
					<td class="right">&nbsp;<span class="price">{include file="common_templates/price.tpl" value=$group_product.price}</span>&nbsp;{if $group_product.recommended == "Y"}<strong>{$lang.recommended}</strong>{/if}</td>
				</tr>
				{/foreach}
			</tbody>
			{else}
			<span class="price strong"> {$lang.text_no_items_defined|replace:"[items]":$lang.products}</span>
			{/if}
		{elseif $po.configurator_group_type == "C"}
			{if $po.products}
				<tbody id="group_{$po.group_id}">
				{foreach from=$po.products item="group_product"}
				<tr>
					<td>
						<input type="checkbox" class="checkbox" id="group_{$po.group_id}_product_{$group_product.product_id}" name="product_data[{$product_id}][configuration][{$po.group_id}][]" value="{$group_product.product_id}" onclick="fn_check_exceptions({$product_id}); fn_check_compatibilities({$po.group_id},{$group_product.product_id}, '{$po.configurator_group_type}');" {if $group_product.selected == "Y"}checked="checked"{/if} {if $group_product.disabled == true}disabled="disabled"{/if} /></td>
					<td width="100%">{include file="common_templates/popupbox.tpl" id="description_`$po.group_id`_`$group_product.product_id`" link_text=$group_product.product text=$group_product.product href="`$index_script`?dispatch=products.configuration_product&amp;group_id=`$po.group_id`&amp;product_id=`$group_product.product_id`"}</td>
					<td class="right">&nbsp;<span class="price">{include file="common_templates/price.tpl" value=$group_product.price}</span>&nbsp;{if $group_product.recommended == "Y"}<strong>{$lang.recommended}</strong>{/if}</td>
				</tr>
				{/foreach}
				</tbody>
			{else}
			<p class="price">{$lang.text_no_items_defined|replace:"[items]":$lang.products}</p>
			{/if}

		{/if}
	</td>
	{/if}
	{/foreach}
	</table>
	</div>
	{/foreach}
	{/capture}
	{include file="addons/product_configurator/views/products/components/tabsbox.tpl" content=$smarty.capture.tabsbox tabs_section="configurator"}

	{if !$edit_configuration}
		<div class="float-left" id="pconf_buttons_block">
			{$smarty.capture.cart_buttons}
		</div>

		<div class="float-right buttons-container">
			{include file="buttons/button.tpl" but_onclick="fn_check_step();" but_text=$lang.continue but_role="action" but_id="next_button"}
		</div>
	{else}
		<div class="buttons-container" id="pconf_buttons_block">
			<input type="hidden" name="product_data[{$product.product_id}][edit_configuration]" value="{$edit_configuration}" />
			{include file="buttons/save.tpl" but_name="dispatch[checkout.add]"}
		</div>
	{/if}
</div>

</form>

<script type="text/javascript">
//<![CDATA[

// Extend core function
fn_register_hooks('product_configurator', ['check_exceptions']);

current_step_id = 'pc_{$current_step_id}';

var price = {$ldelim}{$rdelim};

price[{$product.product_id}] = '{$product.base_price}';

// Define the discounts for the product
{if $product.discounts && !$product.product_options}
pr_d[{$product.product_id}] = {$ldelim}{$rdelim};
pr_d[{$product.product_id}]['P'] = {if $product.discounts.P}{$product.discounts.P}{else}0{/if};
pr_d[{$product.product_id}]['A'] = {if $product.discounts.A}{$product.discounts.A}{else}0{/if};
{/if}

{if $settings.Appearance.show_prices_taxed_clean == "Y"}
	{include file="views/products/components/product_taxes.tpl" id=$product.product_id}
{/if}

var depth = {$smarty.const.DIGG_DEPTH};
var free_rec = {$smarty.const.FREE_RECCOMMENDED};
var conf = {$ldelim}{$rdelim};
var conf_prod  = {$ldelim}{$rdelim};
var conf_product_id = {$product.product_id};
{foreach from=$product_configurator_steps item="step"}
	 conf['pc_{$step.step_id}'] = {$ldelim}{$rdelim};
	{foreach from=$step.product_configurator_groups item="_group" name="__sect"}
		 conf['pc_{$step.step_id}'][{$_group.group_id}] = {$ldelim}{$rdelim};
		 conf_prod[{$_group.group_id}] = {$ldelim}{$rdelim};
		 conf['pc_{$step.step_id}'][{$_group.group_id}]['required'] = '{$_group.required}';
		 conf['pc_{$step.step_id}'][{$_group.group_id}]['type'] = '{$_group.configurator_group_type}';
		 conf['pc_{$step.step_id}'][{$_group.group_id}]['name'] = '{$_group.configurator_group_name|escape:javascript}';
		 {if $_group.configurator_group_type == "S"}
			conf_prod[{$_group.group_id}][0] = {$ldelim}{$rdelim};
			conf_prod[{$_group.group_id}][0]['product_id'] = 0;
			conf_prod[{$_group.group_id}][0]['type'] = '{$_group.configurator_group_type}';
			conf_prod[{$_group.group_id}][0]['required'] = '{$_group.required}';
			conf_prod[{$_group.group_id}][0]['price'] = 0;
			conf_prod[{$_group.group_id}][0]['product_name'] = '{$lang.none}';
		 {/if}
		{foreach from=$_group.products item="_products" name="__group"}
			 conf_prod[{$_group.group_id}][{$_products.product_id}] = {$ldelim}{$rdelim};
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['product_id'] = {$_products.product_id};
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['type'] = '{$_group.configurator_group_type}';
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['required'] = '{$_group.required}';
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['price'] = {$_products.price};
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['product_name'] = {if $_group.configurator_group_type == 'S' && ($_group.products_count != '1' || $_group.required != "Y")}document.getElementById('product_{$_products.product_id}').innerHTML{else}"{$_products.product|escape:javascript}"{/if};
			 conf_prod[{$_group.group_id}][{$_products.product_id}]['class_id'] = {if $_products.class_id}{$_products.class_id}{else}''{/if};
			conf_prod[{$_group.group_id}][{$_products.product_id}]['compatible_classes'] = {$ldelim}{$rdelim};
			{foreach from=$_products.compatible_classes item="compatible_class" key="class_key"  name="__compt"}
				conf_prod[{$_group.group_id}][{$_products.product_id}]['compatible_classes'][{$class_key}]='{$compatible_class.group_id}';
			{/foreach}
		{/foreach}
	{/foreach}
{/foreach}

fn_check_all_compatibilities();
//]]>
</script>

{/if}