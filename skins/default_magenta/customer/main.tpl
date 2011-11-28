{* $Id: main.tpl 7793 2009-08-07 07:39:31Z alexey $ *}
	
{include file="`$location_dir`/top.tpl" assign="top"}
{include file="`$location_dir`/left.tpl" assign="left"}
{include file="`$location_dir`/right.tpl" assign="right"}
{include file="`$location_dir`/bottom.tpl" assign="bottom"}
{if $smarty.const.CONTROLLER == 'checkout' && $smarty.const.MODE == 'checkout' && $right|trim && $settings.General.one_page_checkout == "Y"}
	{capture name="checkout_column"}{$right}{/capture}
	{assign var="right" value=""}
{/if}
<div id="container" class="container{if !$left|trim && !$right|trim}-long{elseif !$left|trim}-left{elseif !$right|trim}-right{/if}">
	{hook name="index:main_content"}
	<div id="header">{include file="top.tpl"}</div>
	{/hook}
	
	<div id="content">
		<div class="content-helper clear">
			{if $top|trim}
			<div class="header">
				{$top}
			</div>
			{/if}
			
			<div class="central-column">
				<div class="central-content">
					{include file="common_templates/breadcrumbs.tpl"}
					{include file="`$location_dir`/central.tpl"}
				</div>
			</div>
		
			{if $left|trim}
			<div class="left-column">
				{$left}
			</div>
			{/if}
			
			{if $right|trim}
			<div class="right-column">
				{$right}
			</div>
			{/if}
		</div>
	</div>
	
	<div id="footer">
		<div class="footer-helper-container">
			{if $bottom|trim}
			<div>
				{$bottom}
			</div>
			{/if}
			{include file="bottom.tpl"}
		</div>
	</div>
</div>