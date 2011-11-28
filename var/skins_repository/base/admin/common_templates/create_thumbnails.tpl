{* $Id: create_thumbnails.tpl 7687 2009-07-09 12:33:49Z zeke $ *}

{if "gd"|extension_loaded && $settings.Thumbnails.create_thumbnails == "Y"}
	{assign var="_width" value=$width|intval}
	{assign var="_formats" value=""|fn_check_gd_formats}
	{assign var="_fmt" value=$settings.Thumbnails.convert_to}
	{$lang.text_gd_loaded_note|replace:"[width]":$_width|replace:"[link_width]":"$index_script?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=`$option_name`"|replace:"[format]":$_formats.$_fmt|replace:"[link_format]":"$index_script?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=convert_to"|replace:"[link_avail]":"$index_script?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=create_thumbnails"}
{elseif $settings.Thumbnails.create_thumbnails != "Y"}
	{$lang.text_auto_thumbnails_disabled|replace:"[link_avail]":"$index_script?dispatch=settings.manage&amp;section_id=Thumbnails&amp;highlight=create_thumbnails"}
{else}
	{$lang.error_gd_not_installed}
{/if}