{* $Id: manage.tpl 6369 2008-11-20 10:54:05Z zeke $ *}

<div class="items-container">
{foreach from=$static_data item="s"}

	{include file="common_templates/object_group.tpl" id=$s.param_id text=$s.descr status=$s.status hidden=false href="$index_script?dispatch=static_data.update&amp;param_id=`$s.param_id`&amp;section=$section" object_id_name="param_id" table="static_data" href_delete="$index_script?dispatch=static_data.delete&amp;param_id=`$s.param_id`&amp;section=$section" rev_delete="static_data_list" header_text=$lang[$section_data.edit_title]|cat:": `$s.descr`" link_text=""}

{foreachelse}
	<p class="no-items">{$lang.no_data}</p>
{/foreach}
</div>
