// $Id: profiles_scripts.js 7816 2009-08-13 12:06:59Z zeke $

jQuery.profiles = {
	rebuild_states : function(section)
	{
		var country_id = $('.cm-country.cm-location-' + section).attr('for');
		var elm = $('#' + $('.cm-state.cm-location-' + section).attr('for')).attr('id');
		var sbox = $('#' + elm).is('select') ? $('#' + elm) : $('#' + elm + '_d');
		var inp = $('#' + elm).is('input') ? $('#' + elm) : $('#' + elm + '_d');
		var cntr = $('#' + country_id);
		var cntr_disabled = cntr.is(':disabled');
		var country_code = (cntr.length) ? cntr.val() : default_country;
		var tag_switched = false;

		if ((!sbox.length && !inp.length) || (sbox.is(':disabled') && inp.is(':disabled'))) {
			return false;
		}

		if (states && states[country_code]) { // Populate selectbox with states
			sbox.attr('length', 1);
			for (var k in states[country_code]) {
				sbox.append('<option value="' + k + '">' + states[country_code][k] + '</option>');
				if (k == default_state[section]) {
					sh_addr = $('#sa');
					if (sh_addr.length && sh_addr.is(':hidden')) {
						sh_addr.show();
						tag_switched = true;
					}
					sbox.val(k);
					if (tag_switched)	{
						sh_addr.hide();
					}
				}
			}

			sbox.attr('id', elm).attr('disabled', '').show().removeClass('cm-skip-avail-switch');
			inp.attr('id', elm + '_d').attr('disabled', 'disabled').hide().addClass('cm-skip-avail-switch');

		} else { // Disable states

			sbox.attr('id', elm + '_d').attr('disabled', 'disabled').hide().addClass('cm-skip-avail-switch');
			inp.attr('id', elm).attr('disabled', '').show().removeClass('cm-skip-avail-switch');
		}

		if (cntr_disabled == true) {
			sbox.attr('disabled', 'disabled');
			inp.attr('disabled', 'disabled');
		}

		default_state[section] = (sbox.attr('disabled')) ? inp.val() : sbox.val();
	}
}