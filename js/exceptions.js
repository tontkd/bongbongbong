// $Id: exceptions.js 7821 2009-08-14 06:20:53Z zeke $

var except = {};
var exceptnone = {};
var exceptions = {};
var pr_i = {}; // option images
var pr_a = {}; // option amount
var pr_o = {}; // option exceptions
var pr_d = {}; // discount
var pr_c = {}; // default product codes
var hide = {};
var price = {};
var exclude_from_calculate = {};
var updated_price = {};
var list_price = {};
var variant_images = {};
var dni = 0;
var ind = 0;
var i = 0;
var j = 0;
var recursion = 0;

// images
var new_ref = {};
var image_changed = {};
var detailed_changed = {};
var default_image = {};
var default_href = {};
var tax_data = {};
var update_ids = {};
var ids_lines = {};
// Number of digits in decimal part
var decplaces = 2;
//
// Check all products for exceptions
//
function fn_check_all_exceptions(one)
{
	recursion = 0;
	ind = 0;
	for (var iii in pr_o) {
		if (!document.getElementById('warning_' + iii)) {
			delete pr_o[iii];
			delete pr_i[iii];
			delete pr_a[iii];
			delete pr_d[iii];
			delete pr_c[iii];
			delete exceptions[iii];
			delete except[iii];
			delete price[iii];
			continue;
		}
		if (fn_check_exceptions(iii) == false) {
			if (one == true) {
				return false;
			}
		}
	}
	return true;
}

// *****************************************  P R O D U C T    P R I C E  **********************************/
//
// Changes product price concerning option modifiers
//

function fn_calculate_tax_rates(id, price)
{
	var taxed_price = parseFloat(price);

	var _tax = 0;
	var previous_priority = 0;
	var previous_price, _tax, _is_zero, base_price;
	var taxes = tax_data[id];
	for (key in taxes) {
		if (!taxes[key]['tax_id']) {
			taxes[key]['tax_id'] = key;
		}

		if (taxes[key]['priority']) {
			taxes[key]['priority'] = 1;
		}
		_is_zero = parseFloat(taxed_price);
		if (!_is_zero) {
			tax_data[id][key]['tax_subtotal'] = 0;
			continue;
		}

		base_price = (taxes[key]['priority'] == previous_priority) ? previous_price : taxed_price;

		if (taxes[key]['rate_type'] == 'P') { // Percent dependence
			// If tax is included into the price
			if (taxes[key]['price_includes_tax'] == 'Y') {
				_tax = base_price - base_price / ( 1 + (parseFloat(taxes[key]['rate_value']) / 100));
			// If tax is NOT included into the price
			} else {
				_tax = base_price * (parseFloat(taxes[key]['rate_value']) / 100);
				taxed_price += _tax;
			}
		} else {
			_tax = parseFloat(taxes[key]['rate_value']);
			// If tax is NOT included into the price
			if (taxes[key]['price_includes_tax'] != 'Y') {
				taxed_price += _tax;
			}
		}

		previous_priority = taxes[key]['priority'];
		previous_price = base_price;

		_pow = Math.pow(10, decplaces);
		pow_tax = Math.round(_tax * _pow);
		tax_data[id][key]['tax_subtotal'] = pow_tax / _pow;
	}
}

// This function calculates the new product price and updates values
function fn_update_product_price(id, orig_price)
{
	if (exclude_from_calculate[id]) {
		return false;
	}

	var modifiers = {};

	var original_price = (typeof(orig_price) == 'undefined') ? parseFloat(price[id]) : orig_price; // Original product price
	var sec_original_price = 0; // Original price (secondary currency)
	var product_price = 0; // Product price with discounts and taxes
	var sec_product_price = 0; // Product price with discounts and taxes (secindary currency)

	var list_pr = (typeof(list_price[id]) != 'undefined') ? parseFloat(list_price[id]) : 0; // List price

	// Apply option modifiers
	for (i in pr_o[id]) {
		if (!document.getElementById(pr_o[id][i]['id']) || document.getElementById(pr_o[id][i]['id']).disabled == true) {
			continue;
		}
		modifiers[i] = pr_o[id][i]['m'][pr_o[id][i]['selected_value']];
		if (typeof(modifiers[i]) == 'undefined') {
			continue;
		}

		if (modifiers[i].substring(0, 1) == 'A') {
			original_price += parseFloat(jQuery.formatPrice(modifiers[i].substring(1, modifiers[i].length-1), decplaces));
			list_pr += parseFloat(jQuery.formatPrice(modifiers[i].substring(1, modifiers[i].length-1), decplaces));
		} else if(modifiers[i].substring(0, 1)  == 'P') {
			original_price += parseFloat(jQuery.formatPrice(price[id] * parseFloat(modifiers[i].substring(1, modifiers[i].length-1))/100, decplaces));
			list_pr += parseFloat(jQuery.formatPrice(price[id] * parseFloat(modifiers[i].substring(1, modifiers[i].length-1))/100, decplaces));
		}
	}

	updated_price[id] = jQuery.formatNum(original_price, decplaces, true);
	sec_original_price = parseFloat(jQuery.formatPrice(original_price / currencies.secondary.coefficient, decplaces));
	sec_list_pr = parseFloat(jQuery.formatPrice(list_pr / currencies.secondary.coefficient, decplaces));

	// Product quantity on cart/checkout page
	var qty = document.getElementById('amount_' + id) ? parseInt(document.getElementById('amount_' + id).value) : 1;

	// If we have discounts, skip list price calculations
	var discount_value = 0; // absolute discount
	var prc_discount_value = 0; // percent discount
	var discounted_price = original_price; // discounted price, equals pure price by default
	var sec_discounted_price = original_price / currencies.secondary.coefficient; // discounted price for secondary currency

	// Discounts
	if (pr_d[id] && (pr_d[id]['A'] || pr_d[id]['P'])) {
		// Discount value (for unit)
		discount_value = parseFloat(jQuery.formatPrice(original_price * pr_d[id]['P']/100 + pr_d[id]['A'], decplaces));
		if (discount_value > original_price) {
			discount_value = original_price;
		}
		// Discount percent value
		prc_discount_value = parseFloat(jQuery.formatPrice((original_price * pr_d[id]['P']/100 + pr_d[id]['A'])/original_price*100, 0));
		if (prc_discount_value > 100) {
			prc_discount_value = 100;
		}

		// Discounted price (unit)
		discounted_price = jQuery.formatPrice(original_price - discount_value);
		// Discounted price (unit) - secondary currency
		sec_discounted_price = jQuery.formatPrice(discounted_price / currencies.secondary.coefficient, decplaces);

	// List price
	} else if (typeof(list_price[id]) != 'undefined') {
		discount_value = parseFloat(jQuery.formatPrice(list_pr - original_price, decplaces));
		prc_discount_value = parseFloat(jQuery.formatPrice((list_pr - original_price)/ list_pr * 100, 0));
	}
	list_pr = list_pr / currencies.primary.coefficient;
	discounted_price = discounted_price / currencies.primary.coefficient;

	// Discount value (unit) - secondary currency
	sec_discount_value = jQuery.formatPrice(discount_value / currencies.secondary.coefficient, decplaces);
	product_price = original_price - ((pr_d[id] && (pr_d[id]['A'] || pr_d[id]['P'])) ? discount_value : 0); // correct resulting product price
	sec_product_price = sec_original_price - ((pr_d[id] && (pr_d[id]['A'] || pr_d[id]['P'])) ? sec_discount_value : 0); // correct resulting product price
	var tx_price = discounted_price; // base price for taxation with discount (if exist)
	var alt_tx_price = sec_discounted_price; // base price for taxation for secondary currency
	discount_value = discount_value / currencies.primary.coefficient;

	// Taxes
	var tax_subtotal = tax_excluded = 0;
	var sec_tax_subtotal = sec_tax_excluded = 0;

	if (tax_data[id]) {
		// Tax value (unit)
		fn_calculate_tax_rates(id, discounted_price);
		for (_k in tax_data[id]) {
			tax_subtotal += parseFloat(tax_data[id][_k]['tax_subtotal']);
			if (tax_data[id][_k]['price_includes_tax'] != 'Y') {
				tax_excluded += parseFloat(tax_data[id][_k]['tax_subtotal']);
			}
		}

		// Tax value (unit) - secondary currency
		fn_calculate_tax_rates(id, sec_discounted_price);
		for (_k in tax_data[id]) {
			sec_tax_subtotal += parseFloat(tax_data[id][_k]['tax_subtotal']);
			if (tax_data[id][_k]['price_includes_tax'] != 'Y') {
				sec_tax_excluded += parseFloat(tax_data[id][_k]['tax_subtotal']);
			}
		}
	}

	product_price = (cart_prices_w_taxes == true) ? product_price + tax_excluded : product_price;
	product_price = product_price / currencies.primary.coefficient;
	sec_product_price = (cart_prices_w_taxes == true) ? sec_product_price + sec_tax_excluded : sec_product_price;
	var product_subtotal = product_price * qty;
	var sec_product_subtotal = sec_product_price * qty;
	original_price = original_price / currencies.primary.coefficient;

	update_ids[id] = {
		'original_price': {P: original_price, S: sec_original_price}, // original price with modifiers
		'old_price': {P: original_price, S: sec_original_price}, // original price with modifiers
		'discounted_price': {P: discounted_price, S: sec_discounted_price}, // original_price - discount_value
		'list_price' : {P: list_pr, S: sec_list_pr}, // list price for the product
		'tax_value': {P: tax_subtotal, S: sec_tax_subtotal},
		'discount_value': {P: discount_value, S: sec_discount_value},
		'prc_discount_value': {E: prc_discount_value},
		'prc_discount_value_label': {E: prc_discount_value},
		'product_price': {P: product_price, S: sec_product_price}, // original_price - discount_value + tax_value
		'tax_subtotal': {P: tax_subtotal * qty, S: sec_tax_subtotal * qty},
		'discount_subtotal': {P: discount_value * qty, S: sec_discount_value * qty},
		'product_subtotal': {P: product_subtotal, S: sec_product_subtotal},
		'product_subtotal_2': {P: product_subtotal, S: sec_product_subtotal}
	};

	fn_update_product_prices_block(update_ids[id], id);

	// If all product prices eq 0 than show standart price block
	if (!(parseFloat(discounted_price) && parseFloat(original_price) && parseFloat(product_price)) && document.getElementById('line_zero_price_' + id)) {
		document.getElementById('line_zero_price_' + id).style.display = '';
	} else if (document.getElementById('line_zero_price_' + id)) {
		document.getElementById('line_zero_price_' + id).style.display = 'none';
	}

	return true;
}

function fn_update_product_prices_block(ids, id)
{
	var elm;

	for (var k in ids) {
		// Primary price
		elm = $('#' + k + '_' + id);
		if (elm.length) {
			if (typeof(ids[k]['E']) != 'undefined') {
				elm.html(Math.round(ids[k]['E']));
			} else if (typeof(ids[k]['P']) != 'undefined') {
				elm.html(jQuery.formatNum(ids[k]['P'], decplaces, true));
			}
		}

		// Secondary price
		elm = $('#sec_' + k + '_' + id);
		if (elm.length) {
			elm.html(jQuery.formatNum(ids[k]['S'], decplaces, false));
		}

		// Discount label/line with discounts
		elm = $('#line_' + k + '_' + id);
		if (elm.length) {
			if ((ids[k]['E'] && parseFloat(ids['original_price']['P'])) || parseFloat(ids[k]['P']) || parseFloat(ids[k]['S'])) {
				elm.show();
			} else {
				elm.hide();
			}
		}
	}

	return true;
}

// *****************************************  Product code  **********************************/
//
// Changes product code to the code of combination
//
function fn_change_sku(id)
{
	var key = '';
	var pcode = $('#product_code_' + id);
	var sku = $('#sku_' + id);

	if (!pcode.length) {
		return false;
	}

	sku.show();

	for (var i in pr_o[id]) {
		if (!$('#' + pr_o[id][i]['id']).length) {
			continue;
		}
		if (pr_o[id][i]['inventory'] == 'Y') {
			key += pr_o[id][i]['option_id'] + '_' + pr_o[id][i]['selected_value'] + '_';
		}
	}

	for (var i in pr_a[id]) {
		if (key == i) {
			if (pr_a[id][i]['product_code']) {
				pcode.html(pr_a[id][i]['product_code']);
				return true;
			}
		}
	}

	if (pr_c[id] != '') {
		pcode.html(pr_c[id]);
	} else {
		sku.hide();
	}
	return true;
}

// *****************************************  A M O U N T   I N   S T O C K  **********************************/
//
// Changes amount in stock if product inventory is in track with options
//
function fn_change_amount(id)
{
	var key = '';
	var pqty = $('#qty_' + id); // input with qty
	var pstock = $('#qty_in_stock_' + id); // qty in stock line
	var padd = $('#cart_buttons_block_' + id); // add to cart button
	var spadd = $('#cart_add_block_' + id);
	var badd = $('#bulk_addition_' + id); // bulk add to cart checkbox

	for (var i in pr_o[id]) {
		if (!$('#' + pr_o[id][i]['id']).length) {
			continue;
		}
		if (pr_o[id][i]['inventory'] == 'Y') {
			key += pr_o[id][i]['option_id'] + '_' + pr_o[id][i]['selected_value'] + '_';
		}
	}

	for (var i in pr_a[id]) {
		if (key == i) {
			if (pr_a[id][i]['amount']) {
				if (pr_a[id][i]['amount'] > 0) {
					pstock.show();
					pstock.html(pr_a[id][i]['amount'] + '&nbsp;' + lang.items);
					pqty.show();
					padd.show();
					spadd.show();
					badd.attr('disabled', false);
				} else {
					if (allow_negative_amount){
						pstock.hide();
						pqty.show();
						padd.show();
						spadd.show();
						badd.attr('disabled', false);
					}else{
						pstock.html('<span class="price">' + lang.text_out_of_stock + '</span>');
						pqty.hide();
						padd.hide();
						spadd.hide();
						badd.attr('disabled', true);
					}	
				}
				return true;
			}
		}

		pstock.html('<span class="price">' + lang.text_out_of_stock + '</span>');
		pqty.hide();
		padd.hide();
		spadd.hide();
		badd.attr('disabled', true);
	}

	return true;
}

// **************************************************** I M A G E S ********************************************/
//
// Calculates options hash and check wether image is available for this combination
//
function fn_check_option_image(id)
{
	var key='';
	for (i in pr_o[id]) {
		if (!document.getElementById(pr_o[id][i]['id'])) {
			continue;
		}
		if (pr_o[id][i]['inventory'] == 'Y') {
			key += (key != '' ? "_" : "") + pr_o[id][i]['option_id'] + "_" + pr_o[id][i]['selected_value'];
		}
	}
	var thumbnail = $(".cm-thumbnails", $('#product_images_' + id)).eq(0);
	if (thumbnail.parent('a').length && default_href[id] == '') {
		thumbnail.insertAfter(thumbnail.parent('a'));
		thumbnail.prev().remove();
	} else if (!thumbnail.parent('a').length && default_href[id] != '') {
		thumbnail.wrap('<a id="detailed_href1_' + id + '" href="' + default_href[id] + '"></a>');
	}
	var thumb_obj = $('.cm-thumbnails-mini', $('#product_images_' + id)).eq(0);
	if (detailed_changed[id] == "Y") {
		if (thumb_obj.length) {
			thumb_obj.attr('href', default_href[id]);
		}
		if ($('#detailed_href1_' + id).length) {
			$('#detailed_href1_' + id).attr('href', default_href[id]);
		}
		if ($('#detailed_href2_' + id).length) {
			$('#detailed_href2_' + id).attr('href', default_href[id]);
		}
		detailed_changed[id] = "";
	}
	for (i in pr_i[id]) {
		if (key == pr_i[id][i]['options']) {
			if (fn_change_image(id, i)) {
				return true;
			}
		}
	}
	if (image_changed[id] == "Y") {
		if (thumb_obj.length) {
			$('img', thumb_obj).attr('src', default_image[id]['src-mini']);
		}
		$('#det_img_' + id).attr('alt', default_image[id]['alt']);
		$('#det_img_' + id).attr('src', default_image[id]['src']);
		image_changed[id] = "";
	}
	return false;
}


function fn_change_image(id, row)
{
	var thumb_obj = $('.cm-thumbnails-mini').eq(0);
	if (thumb_obj.length) {
		if (pr_i[id][row]['icon']) {
			$('img', thumb_obj).attr('src', pr_i[id][row]['icon']['src-mini']);
		}
		thumb_obj.click();
	}

	var thumbnail = $(".cm-thumbnails", $('#product_images_' + id)).eq(0);
	if (pr_i[id][row]['detailed_id'] != '' && pr_i[id][row]['detailed_id'] != '0') {		
		if (thumb_obj.length) {
			thumb_obj.attr('href', pr_i[id][row]['detailed']['image_path']);
		}
		if (!thumbnail.parent('a').length) {
			thumbnail.wrap('<a id="detailed_href1_' + id + '" href=""></a>');
		}
		if ($('#detailed_href1_' + id).length) {
			$('#detailed_href1_' + id).attr('href', pr_i[id][row]['detailed']['image_path']);
		}
		if ($('#detailed_href2_' + id).length) {
			$('#detailed_href2_' + id).attr('href', pr_i[id][row]['detailed']['image_path']);
			$('#detailed_href2_' + id).parent().show();
		}
		detailed_changed[id] = "Y";
	} else {
		
		if (thumb_obj.length) {
			thumb_obj.attr('href', default_href[id]);
		}

		if (!default_href[id] || pr_i[id][row]['image_id']) {
			if (thumbnail.parent('a').length) {
				thumbnail.insertAfter(thumbnail.parent('a'));
				thumbnail.prev().remove();
			}
			$('#detailed_href2_' + id).parent().hide();
		} else {
			thumbnail.parent('a').attr('href', default_href[id]);
			$('#detailed_href1_' + id).attr('href', default_href[id]);
			$('#detailed_href2_' + id).attr('href', default_href[id]).show();
		}

		detailed_changed[id] = "";
	}
	if (pr_i[id][row]['image_id'] != 0) {
		$('#det_img_' + id).attr('src', pr_i[id][row]['icon']['src']);
		$('#det_img_' + id).attr('alt', pr_i[id][row]['icon']['alt']);
		image_changed[id] = "Y";
		return true;
	}

	return false;

}

// ************************************************** E X C E P T I O N S ****************************************/
//
// Check all selected options variants in exceptions
//
function fn_check_exceptions(id)
{
	var m = 0; n = 0; k = 0; index = 0;
	if (typeof(pr_o[id]) == 'undefined') {
		return true;
	}

	// Define Selected values for each option
	for (i in pr_o[id]) {
		if (!document.getElementById(pr_o[id][i]['id'])) {
			continue;
		}
		if (pr_o[id][i]['type'] == 'S') {
			pr_o[id][i]['selected_value'] = document.getElementById(pr_o[id][i]['id']).value;
		} else if (pr_o[id][i]['type'] == 'C') {
			if (document.getElementById(pr_o[id][i]['id']).checked) {
				pr_o[id][i]['selected_value'] = document.getElementById(pr_o[id][i]['id']).value;

			} else {
				pr_o[id][i]['selected_value'] = document.getElementById('unchecked_' + pr_o[id][i]['id']).value;
			}
		} else if (pr_o[id][i]['type'] == 'R'){
			for (var k = 0; k < document.getElementById(pr_o[id][i]['id']).getElementsByTagName("INPUT").length; k++) {
				if (document.getElementById(pr_o[id][i]['id']).getElementsByTagName("INPUT")[k].checked == true) {
					pr_o[id][i]['selected_value'] = document.getElementById(pr_o[id][i]['id']).getElementsByTagName("INPUT")[k].value;
				}
			}
		}
	}

	// Checks the image for an option combination
	fn_check_option_image(id);
	// Change the amount
	fn_change_amount(id);
	// Change the sku
	fn_change_sku(id);

	if (typeof(exceptions[id]) != 'undefined') {

		// Resets all variants in the selectboxes
		fn_empty_selectboxes(id);
		// Function that calculates how many options in exception

		if (fn_calculate_matches(id) == false) {
			return false;
		}
		
		if (exception_style == 'warning' && document.getElementById('warning_' + id)) {
			$('#warning_' + id).hide();
			fn_disable(id);
			return true;
		}

		// Disables options that have status disabled in exception and other exceptions sutisfied
		fn_disable(id);

		// This section fills the array with options considering the exceptions that should be hided
		for (m = 0; m < exceptions[id].length; m++) { // Cylcle all exceptions for the product
			if (except[id][m] == fn_array_length(pr_o[id]) - 1) {
				var k_inc = 0;
				if (!hide[id]) {
					hide[id] = {};
				}
				for (k in pr_o[id]) { // Cycle all options of the product
					if (!hide[id][k]) {
						hide[id][k] = {};
					}
					if ((pr_o[id][k]['selected_value'] != exceptions[id][m][k_inc]) && (exceptions[id][m][k_inc] != '-1')) {
						var j_inc = 0;
						for (var j in pr_o[id][k]['v']) { // Cycle all option variants
							if (j == exceptions[id][m][k_inc]) {
								if (pr_o[id][k]['type'] == 'S') {
									hide[id][k][j] = 'Y';
								}
								if (pr_o[id][k]['type'] == 'C') {
									document.getElementById('unchecked_'+pr_o[id][k]['id']).value = pr_o[id][k]['selected_value'];
									document.getElementById(pr_o[id][k]['id']).disabled = true;
								}
								if (pr_o[id][k]['type'] == 'R') {
									document.getElementById(pr_o[id][k]['id']).getElementsByTagName("INPUT")[j_inc].disabled = true;
								}
							}
							j_inc ++;
						}
					}
					k_inc ++;
				}
			}
		}
		fn_rebuild_options(id);

	}

	// Update the product price due to selected variants
	fn_update_product_price(id);

	fn_set_hook('check_exceptions', [id]);

	if (recursion == false)	{
		recursion = true;
		fn_check_exceptions(id);
	}
	return true;
}

function fn_rebuild_options(id)
{
	// The sections fills the selectboxes with values considering excepted variants
	if (!hide[id])	{
		hide[id] = {};
	}

	for (m in pr_o[id]) {
		j = 0;
		if (!hide[id][m])	{
			hide[id][m] = {};
		}
		for (var k in pr_o[id][m]['v']) {
			if (!hide[id][m][k]) {
				hide[id][m][k] = '';
			}
			// If this variant shouldn't be hided and this option is selectbox than add this variant
			if ((hide[id][m][k] != 'Y') && (pr_o[id][m]['type'] == 'S')) {
				if (document.getElementById(pr_o[id][m]['id'])) {
					document.getElementById(pr_o[id][m]['id']).options[j] = new Option(pr_o[id][m]['v'][k], k);
					// Check if this variants was selected before the check exceptions function called
					if (pr_o[id][m]['selected_value'] == k) {
						document.getElementById(pr_o[id][m]['id']).options[j].selected = true;
					}
				}
				j ++;
			}
			hide[id][m][k] = '';
		}
	}
}


function fn_calculate_matches(id)
{
	// Calculate the mathes between exceptions and selected variants at the moment
	except[id] = {};
	exceptnone[id] = {};
	if (exception_style == 'warning') {
		$('#warning_' + id).hide();
	}
	for (var m = 0; m < exceptions[id].length; m++) {
		k = 0;
		n = 0;
		j = 0;
		except[id][m] = 0;
		exceptnone[id][m] = 0;
		for (var k in pr_o[id]) {
			if (pr_o[id][k]['selected_value'] == exceptions[id][m][j]) {
				n ++;
				except[id][m] = n;
			}
			if (exceptions[id][m][j] == '-1') {
				n ++;
				except[id][m] = n;
			}
			if (exceptions[id][m][j] == '-2') {
				exceptnone[id][m] += 1;
			}
			j ++;
	    }
	}
	for (var m = 0; m < exceptions[id].length; m++) {
		if (except[id][m] == fn_array_length(pr_o[id])) {
			if (exception_style == 'warning') {
				$('#warning_' + id).show();
				fn_empty_selectboxes(id);
				fn_disable(id);
				return false;
			}
			// Change selected variants to avoid exception
			fn_all_excepted(id);
		}
	}
}

//
// Cleans all values from selectboxes and enables all options
//
function fn_empty_selectboxes(id)
{
	for (i in pr_o[id]) {
		if (!document.getElementById(pr_o[id][i]['id'])) {
			continue;
		}
		if (pr_o[id][i]['type'] == 'S') {
			if (exception_style != 'warning') {
				document.getElementById(pr_o[id][i]['id']).options.length = 0;
			}
		   document.getElementById(pr_o[id][i]['id']).disabled = false;
		} else if (pr_o[id][i]['type'] == 'C') {
			document.getElementById(pr_o[id][i]['id']).disabled=false;
		} else if (pr_o[id][i]['type'] == 'R'){
			for (var k = 0; k < document.getElementById(pr_o[id][i]['id']).getElementsByTagName("INPUT").length; k++) {
			   document.getElementById(pr_o[id][i]['id']).getElementsByTagName("INPUT")[k].disabled = false;
		   }
		}
	}
}

//
// Disables options if the the other exception variants are selected and the option has "disable" status
//
function fn_disable(id)
{
	for (i = 0; i < exceptions[id].length; i++) {
		if (except[id][i] == fn_array_length(pr_o[id]) - exceptnone[id][i]) {
			j = 0;
			for (var k in pr_o[id]) {
				if (exceptions[id][i][j] == '-2') {
					if (pr_o[id][k]['type'] == 'S') {
						document.getElementById(pr_o[id][k]['id']).disabled = true;
					} else if (pr_o[id][k]['type'] == 'C') {
						document.getElementById(pr_o[id][k]['id']).disabled = true;
					} else if (pr_o[id][k]['type'] == 'R'){
						for (var j = 0; j < document.getElementById(pr_o[id][k]['id']).getElementsByTagName("INPUT").length; j++) {
							document.getElementById(pr_o[id][k]['id']).getElementsByTagName("INPUT")[j].disabled = true;
						}
					}
				}
			j ++;
			}
		}
	}
}
//
// Function that called if curent selected values are in exception
//
function fn_all_excepted(id)
{
	var opt_id = pr_o[id][fn_key_by_iter(pr_o[id], 0)]['option_id'];
	var var_id = fn_key_by_iter(pr_o[id][fn_key_by_iter(pr_o[id], 0)]['v'], 0);

	for (var i = 0; i < exceptions[id].length; i++) {
		
		if (except[id][i] == fn_array_length(pr_o[id])) {
			// if option has -disregard- exception variant
			if (exceptions[id][i][dni]=='-1') {
				  dni ++;
				  opt_id = pr_o[id][fn_key_by_iter(pr_o[id], dni)]['option_id'];
				  ind = 0;
				  var_id = fn_key_by_iter(pr_o[id][fn_key_by_iter(pr_o[id], dni)]['v'], ind);
			}
			/*
			if (pr_o[id][opt_id]['type'] == 'S') {
				//pr_o[id][opt_id]['v'][var_id]['hide'] = 'Y';
			} else if (pr_o[id][opt_id]['type'] == 'C') {
				document.getElementById(pr_o[id][opt_id]['id']).checked=true;
			} else if (pr_o[id][opt_id]['type'] == 'R') {
				document.getElementById(pr_o[id][opt_id]['id']).getElementsByTagName("INPUT")[var_id].disabled = true;
			}*/

			// Next option variant index is selected else Change option
			if (ind != fn_array_length(pr_o[id][opt_id]['v'])-1) {
				ind ++;
				var_id = fn_key_by_iter(pr_o[id][fn_key_by_iter(pr_o[id], dni)]['v'], ind);
			} else {
				if (pr_o[id][opt_id]['type'] == 'S') {
					pr_o[id][opt_id]['selected_value'] = fn_key_by_iter(pr_o[id][opt_id]['v'], ind);
				} else if (pr_o[id][opt_id]['type'] == 'C') {
					document.getElementById(pr_o[id][opt_id]['id']).disabled=false;
					document.getElementById(pr_o[id][opt_id]['id']).checked=false;
				} else if (pr_o[id][opt_id]['type'] == 'R') {
					document.getElementById(pr_o[id][opt_id]['id']).getElementsByTagName("INPUT")[0].checked = true;
				}
				dni ++;
				opt_id = pr_o[id][fn_key_by_iter(pr_o[id], dni)]['option_id'];
				ind = 0;
				var_id = fn_key_by_iter(pr_o[id][fn_key_by_iter(pr_o[id], dni)]['v'], ind);
			}

			// This section select the next variant in the option
			if (pr_o[id][opt_id]['type'] == 'S') {
				pr_o[id][opt_id]['selected_value'] = pr_o[id][opt_id]['v'][var_id]['variant_id'];
			} else if (pr_o[id][opt_id]['type'] == 'C') {
				document.getElementById(pr_o[id][opt_id]['id']).checked=true;
				document.getElementById(pr_o[id][opt_id]['id']).disabled=true;
				for (var iii in pr_o[id][opt_id]['v']) {
					pr_o[id][opt_id]['selected_value'] = iii;
				}
				document.getElementById('unchecked_'+pr_o[id][opt_id]['id']).value = pr_o[id][opt_id]['selected_value'];
			} else if (pr_o[id][opt_id]['type'] == 'R') {
				document.getElementById(pr_o[id][opt_id]['id']).getElementsByTagName("INPUT")[ind].checked = true;
				pr_o[id][opt_id]['selected_value'] = var_id;
			}

		}
	}
	fn_calculate_matches(id);
}

// Function that called if curent selected values are in exception
function fn_array_length(array)
{
	var result = 0;

	for (var i in array) {
		result ++;
	}
	return result;
}

// Function finds a key by it's index
function fn_key_by_iter(array, iter)
{
	var result = 0, j = 0, i = 0;

	for (var i in array) {
		if (j == iter) {
			return i;
		}
		j ++;
	}
	return false;
}

//
// Variant image functions
//
function fn_change_variant_image(product_id, option_id, variant_id)
{
	if (typeof(variant_images[product_id]) !== 'undefined' && typeof(variant_images[product_id][option_id]) !== 'undefined') {
		for (key in variant_images[product_id][option_id]) {
			if (document.getElementById('det_img_variant_image_' + product_id + '_' + key)) {
				document.getElementById('det_img_variant_image_' + product_id + '_' + key).className = (key == variant_id) ? 'product-variant-image-selected' : 'product-variant-image-unselected';
			}
		}
	}
}

function fn_set_option_value(product_id, option_id, value)
{
	if (pr_o[product_id][option_id]['type'] == 'S') { // select
		$('#option_' + product_id + '_' + option_id).val(value).change();

	} else if (pr_o[product_id][option_id]['type'] == 'R') { // radio
		var elm = $('#option_' + product_id + '_' + option_id);
		$(':radio[value=' + value + ']', elm).click();
	}

	return true;
}
