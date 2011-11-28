{* $Id: manage.tpl 7036 2009-03-13 12:29:40Z zeke $ *}

{script src="js/picker.js"}
{include file="views/block_manager/components/scripts.tpl"}
{include file="common_templates/popupbox.tpl" text=$lang.editing_block content=$content id="edit_block_picker" edit_picker=true}

{capture name="mainbox"}
{capture name="tabsbox"}
<div id="content_{$location}">
<div class="block-manager">
	<div id="top_column_holder">
		<h2>{$lang.top}</h2>
		<div id="top" class="cm-sortable-items grab-items">
			{if $positions.top}
			{foreach from=$positions.top item="block_data"}
				{include file="views/block_manager/components/block_element.tpl" block_data=$blocks[$block_data.id] position="top"}
			{/foreach}
			{/if}
			<p class="no-items{if $positions.top} hidden{/if}">{$lang.no_blocks}</p>
		</div>
	</div>
	<div class="clear">
	<div id="left_column_holder" class="float-left">
		<h2>{$lang.left_sidebox}</h2>
		<div id="left" class="cm-sortable-items grab-items">
		{if $positions.left}
			{foreach from=$positions.left item="block_data"}
				{include file="views/block_manager/components/block_element.tpl" block_data=$blocks[$block_data.id] position="left"}
			{/foreach}
		{/if}
			<p class="no-items{if $positions.left} hidden{/if}">{$lang.no_blocks}</p>
		</div>
	</div>
	<div id="central_column_holder" class="float-left">
		<h2>{$lang.central}</h2>
		<div id="central" class="cm-sortable-items grab-items">
			{if $positions.central}
				{foreach from=$positions.central item="block_data"}
					{if $blocks[$block_data.id]}
						{include file="views/block_manager/components/block_element.tpl" block_data=$blocks[$block_data.id] position="central"}
					{elseif $block_data.content}
						<div class="cm-list-box">
							<h3>{$lang.central_content}</h3>
							<input type="hidden" name="block_positions[]" class="block-position" value="central" />
							<div class="block-content clear">
							{if $block_data.wrapper}
								<p><label>{$lang.wrapper}:</label>
								{$block_data.wrapper}</p>
							{/if}

							{include file="common_templates/object_group.tpl" content="" id="central_`$location`" no_table=true but_name="dispatch[block_manager.update]" href="$index_script?dispatch=block_manager.update&amp;block_id=central&amp;location=$location&amp;position=central" header_text="`$lang.editing_block`: `$lang.central_content`"}
							</div>
						</div>
						{if $location == "products"}
						<div id="product_details_holder" class="items-container">
							<div id="product_details" class="cm-sortable-items grab-items">
								<h3 align="center">{$lang.product_details_page_tabs}</h3>
								{foreach from=$blocks item="block"}
									{if $block.properties.positions == "product_details"}
										{include file="views/block_manager/components/block_element.tpl" block_data=$block position="product_details"}
										{assign var="not_empty" value=true}
									{/if}
								{/foreach}
								<p class="no-items{if $not_empty} hidden{/if}">{$lang.no_blocks}</p>
								<div class="cm-list-box list-box-invisible"></div>
							</div>
						</div>
						{/if}
					{/if}
				{/foreach}
			{/if}
			<p class="no-items{if $positions.central} hidden{/if}">{$lang.no_blocks}</p>
		</div>
	</div>
	<div id="right_column_holder" class="float-left">
		<h2>{$lang.right_sidebox}</h2>
		<div id="right" class="cm-sortable-items grab-items">
			{if $positions.right}
			{foreach from=$positions.right item="block_data"}
				{include file="views/block_manager/components/block_element.tpl" block_data=$blocks[$block_data.id] position="right"}
			{/foreach}
			{/if}
			<p class="no-items{if $positions.right} hidden{/if}">{$lang.no_blocks}</p>
		</div>
	</div>
	</div>
	<div id="bottom_column_holder">
		<h2>{$lang.bottom}</h2>
		<div id="bottom" class="cm-sortable-items grab-items">
			{if $positions.bottom}
			{foreach from=$positions.bottom item="block_data"}
				{include file="views/block_manager/components/block_element.tpl" block_data=$blocks[$block_data.id] position="bottom"}
			{/foreach}
			{/if}
			<p class="no-items{if $positions.bottom} hidden{/if}">{$lang.no_blocks}</p>
		</div>
	</div>
</div>
<input type="hidden" name="block_positions" />
{script src="js/iutil.js"}
{script src="js/idrag.js"}
{script src="js/idrop.js"}
{script src="js/isortables.js"}
{literal}
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	var h_height = 100;
	var h_width = 300;
	var h_hidden_height = 160;

	$('.cm-sortable-items').Sortable({
		accept: 'cm-list-box',
		helperclass: 'ui-select',
		handle: 'h4',
		tolerance: 'intersect',
		cursorAt: {top: 60},
		opacity: 0.5,
		onStart: function(elm) {
			$('html,body').css('overflow-x', 'hidden');
			jQuery.iDrag.helper.children().hide();
			jQuery.iDrag.helper.css('height', h_hidden_height);
			jQuery.iDrag.helper.append('<div class="ui-drag-holder"><div class="ui-drag"></div></div>');
			$('.ui-drag', jQuery.iDrag.helper).css({'height': h_height, 'width' : h_width});
		},
		onStop: function(elm) {
			$('html,body').css('overflow-x', '');

			$('div.cm-sortable-items').each(function() {
				$('.cm-list-box', this).length == 0 || $(this).is('#product_details') && $('.cm-list-box', this).length == 1 ? $('p.no-items', this).show() : $('p.no-items', this).hide();
			});
		},
		onDrag: function(elm) {
			var w = jQuery.get_window_sizes();
			var pos = jQuery.iDrag.helper.offset();
			if (pos.top < w.offset_y) {
				$(document).scrollTop(w.offset_y - 20);
			} else if (pos.top + jQuery.iDrag.helper.height() > w.offset_y + w.view_height) {
				$(document).scrollTop(w.offset_y + w.view_height + 20 < $('body').height() ? w.offset_y + 20 : $('body').height() - w.view_height);
			}
		}
	});
});

function fn_form_pre_block_positions_form()
{
	var positions = [];
	var str_positions;

	$('.grab-items').each(function() {
		var self = this;
		if (!positions[self.id]) {
			positions[self.id] = [];
		}
		$('#' + self.id + ' :input').filter('.block-position').each(function() {
			if ($(this).parents('.grab-items:first').attr('id') == self.id) {
				positions[self.id].push($(this).val());
			}
		});
	});

	for (var section in positions) {
		if (positions[section]) {
			$("input[name='block_positions[" + section + "]']").val(positions[section].join(','));
		}
	}

	return true;
}
//]]>
</script>
{/literal}
</div>

<form action="{$index_script}" method="post" name="block_positions_form">
<input type="hidden" name="add_selected_section" value="{$location}" />
<input type="hidden" name="block_positions[left]" value="" />
<input type="hidden" name="block_positions[right]" value="" />
<input type="hidden" name="block_positions[central]" value="" />
<input type="hidden" name="block_positions[top]" value="" />
<input type="hidden" name="block_positions[bottom]" value="" />
{if $location == "products"}
<input type="hidden" name="block_positions[product_details]" value="" />
{/if}

{capture name="tools"}
	{capture name="add_new_picker"}
		{include file="views/block_manager/update.tpl" add_block=true block=null}
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_block" text=$lang.add_block content=$smarty.capture.add_new_picker link_text=$lang.add_block act="general"}
{/capture}

<div class="buttons-container cm-toggle-button buttons-bg">
	<div class="float-left">
		{include file="buttons/button.tpl" but_text=$lang.save but_name="dispatch[block_manager.save_layout]" but_role="button_main"}
	</div>
	
	<div class="float-right">
		{include file="common_templates/popupbox.tpl" id="add_new_block" text=$lang.add_block link_text=$lang.add_block act="general"}
	</div>
</div>

</form>
{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$location}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.blocks content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}