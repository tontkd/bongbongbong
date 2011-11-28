{* $Id: processor.tpl 5882 2008-09-09 13:51:06Z brook $ *}

<div id="content_tab_conf_{$payment_id}">

{if $callback == "Y"}
	{$processor_name|fn_get_curl_info}
{/if}

{include file="views/payments/components/cc_processors/$processor_template"}

<!--content_tab_conf_{$payment_id}--></div>
