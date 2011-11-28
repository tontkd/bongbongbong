{* $Id: gift_certificate.tpl 3740 2007-08-24 12:44:57Z zenuch $ *}

{include file="letter_header.tpl"}

{$lang.dear} {$gift_cert_data.recipient},<br /><br />

{$certificate_status.email_header}<br /><br />

{include file="addons/gift_certificates/templates/`$gift_cert_data.template`"}
	
{include file="letter_footer.tpl"}