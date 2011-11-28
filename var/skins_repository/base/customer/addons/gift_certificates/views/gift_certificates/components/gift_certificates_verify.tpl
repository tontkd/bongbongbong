{* $Id: gift_certificates_verify.tpl 7806 2009-08-12 10:22:35Z alexions $ *}

<div class="updates-wrapper float-right">

<form name="gift_certificate_verification_form" action="{$index_script}">

<p><label for="id_verify_code" class="cm-required">{$lang.certificate_verification}:</label></p>

{strip}
<input type="text" name="verify_code" id="id_verify_code" value="{$lang.enter_code|escape:html}" class="input-text cm-hint" />
{include file="buttons/go.tpl" but_name="gift_certificates.verify" alt=$lang.go}
{/strip}

</form>

</div>
