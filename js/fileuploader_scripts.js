// $Id: fileuploader_scripts.js 7497 2009-05-19 10:41:21Z zeke $

var fileuploader = {

	result_id: '',
	
	set_file: function(name, tiny)
	{
		if (tiny) {
			parent.window.jQuery('iframe').contents().find('#advimage #src').val(name);
			parent.window.jQuery('iframe').contents().find('#advimage #src').trigger('change');
			tinyMCEPopup.close();
		} else {
			this.display_filename(this.result_id, 'server', name);
			$('.cm-popup-bg:last').click();
		}
	},

	show_image: function(name)
	{
		$('#fo_img').attr('src', current_path + '/' + name);
	},

	init: function(dialog_id, result_id)
	{
		this.result_id = result_id;

		jQuery.show_picker('view_' + dialog_id, '', '.object-container');
	},

	show_loader: function(elm_id)
	{
		var suffix = elm_id.str_replace('_local_', '').str_replace('server_', '').str_replace('url_', '');

		if (elm_id.indexOf('_local') != -1) {
			this.display_filename(suffix, 'local', $('#' + elm_id).val());
		}

		if (elm_id.indexOf('server') != -1) {
			fileuploader.init('box_server_upload', suffix);
		}

		if (elm_id.indexOf('url') != -1) {
			var e_url = $('#message_' + suffix + ' span').html();
			var n_url = '';

			if (n_url = prompt($('#' + elm_id).html(), (e_url.indexOf('://') !== -1) ? e_url : '')) {
				if (this.validate_url(n_url)) {
					this.display_filename(suffix, 'url', n_url);
				} else {
					alert(lang.text_invalid_url);
				}
			}
		}
	},

	display_filename: function(id, type, val)
	{
		// Highlight active link
		var types = ['local', 'server', 'url'];
		var file = $('#message_' + id + ' p.cm-fu-file');
		var no_file = $('#message_' + id + ' p.cm-fu-no-file');

		for (var i = 0; i < types.length ;i++ )	{
			if (types[i] == type) {
				$('#' + types[i] + '_' + id).addClass('active');
			} else {
				$('#' + types[i] + '_' + id).removeClass('active');
			}
		}

		$('#type_' + id).val(type); // switch type
		$('#file_' + id).val(val); // set file name

		if (val == '') {
			file.hide();
			no_file.show();
		} else {
			no_file.hide();
			$('span', file).html(val).attr('title', val); // display file name
			file.show();
		}
	},

	clean_selection: function(elm_id)
	{
		var suffix = elm_id.str_replace('clean_selection_', '');

		this.display_filename(suffix, '', '');

	},
	
	get_content_callback: function(data) 
	{
		if (data.content.indexOf('text:') == 0) {
			$('#fo_img').hide();
			$('#fo_no_preview').hide();
			$('#fo_preview').show();
			$('#fo_preview').val(data.content.substr(5));
		} else if (data.content.indexOf('image:') == 0) {
			$('#fo_img').show();
			$('#fo_no_preview').hide();
			$('#fo_preview').hide();
			fileuploader.show_image(data.content.substr(6));
		} else {
			$('#fo_img').hide();
			$('#fo_no_preview').show();
			$('#fo_preview').hide();
		}
	},

	validate_url: function(url)
	{
		var regexp = /^[A-Za-z]+:\/\/[A-Za-z0-9-_\.]+[A-Za-z0-9-_%~&\\?\/.=]+$/;
		return regexp.test(url);
	}
}
