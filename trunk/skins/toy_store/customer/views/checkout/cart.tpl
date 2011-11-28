{* $Id: cart.tpl 7252 2009-04-13 11:24:08Z lexa $ *}

{script src="js/exceptions.js"}

<script type="text/javascript">
//<![CDATA[
	var cart_changed = false;
	{literal}
	function fn_proceed_to_checkout(m_name)
	{
		if (cart_changed == true) {
			if (confirm(lang.text_cart_changed)) {
				if (fn_check_all_exceptions(true)) {
					$('form[name="checkout_form"] input[name="redirect_mode"]').val(m_name);
					$('form[name="checkout_form"] :submit').click();
				} else {
					jQuery.showNotifications({'notification': {'type': 'W', 'title': lang.warning, 'message': lang.cannot_buy, 'save_state': false}});
					return false;
				}
			}
		} else {
			if (fn_check_all_exceptions(true)) {
				jQuery.redirect(index_script + '?' + 'dispatch=checkout.' + m_name);
			} else {
				jQuery.showNotifications({'notification': {'type': 'W', 'title': lang.warning, 'message': lang.cannot_buy, 'save_state': false}});
			}
		}
	}
	{/literal}
//]]>
</script>

{if !$cart|fn_cart_is_empty}
	{include file="views/checkout/components/cart_content.tpl"}
{else}
	<p class="no-items">{$lang.text_cart_empty}</p>

	<div class="buttons-container center">
		{include file="buttons/continue_shopping.tpl" but_href=$continue_url|default:$index_script but_role="action"}
	</div>
{/if}