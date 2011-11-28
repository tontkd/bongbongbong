//
// $Id: func.js 6929 2009-02-20 07:01:33Z zeke $
//

function fn_banners_add_js_item(var_prefix, object_html, var_id, item_id)
{
	if (var_prefix == 'b') {
		append_obj_content = unescape(object_html).str_replace('{banner_id}', var_id).str_replace('{banner}', item_id);
	}
}