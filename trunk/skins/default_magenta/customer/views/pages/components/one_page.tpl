{* $Id: one_page.tpl 6967 2009-03-04 09:26:06Z angel $ *}

<div class="search-result">
	<strong>{$page.result_number}.</strong> <a href="{$index_script}?dispatch=pages.view&page_id={$page.page_id}" class="product-title">{$page.page}</a>
	<p>{$page.description|unescape|strip_tags|truncate:380:"..."}</p>
</div>