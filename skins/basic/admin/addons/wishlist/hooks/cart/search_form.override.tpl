{* $Id: search_form.override.tpl 6483 2008-12-03 14:57:53Z zeke $ *}

<input type="checkbox" value="Y" {if $search.product_type_c == "Y"}checked="checked"{/if} name="product_type_c" id="cb_product_type_c" onclick="if (!this.checked) document.getElementById('cb_product_type_w').checked = true;" class="checkbox" />
<label for="cb_product_type_c">{$lang.cart}</label>

<input type="checkbox" value="Y" {if $search.product_type_w == "Y"}checked="checked"{/if} name="product_type_w" id="cb_product_type_w" onclick="if (!this.checked) document.getElementById('cb_product_type_c').checked = true;" class="checkbox" />
<label for="cb_product_type_w">{$lang.wishlist}</label>