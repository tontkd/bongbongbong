<?php
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/

//
// $Id: class.templater.php 7689 2009-07-10 08:00:12Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

require(DIR_LIB . 'templater/Smarty.class.php');
require(DIR_LIB . 'templater/Smarty_Compiler.class.php');

fn_define('SMARTY_CUSTOM_PLUGINS', DIR_CORE . 'templater_plugins');

/**
 * @package Smarty
 */
class Templater extends Smarty
{
    /**#@+
     * Smarty Configuration Section
     */

    /**
     * An array of directories searched for plugins.
     *
     * @var array
     */
    var $plugins_dir     =  array(SMARTY_CUSTOM_PLUGINS, 'plugins');

    /**
     * The file that contains the compiler class. This can a full
     * pathname, or relative to the php_include path.
     *
     * @var string
     */
    var $compiler_file        =    'class.templater.php';

    /**
     * The class used for compiling templates.
     *
     * @var string
     */
    var $compiler_class        =   'Templater_Compiler';

    /**
     * Language for retrieving language variables.
     *
     * @var string
     */
    var $lang_code	=	'';

	function setLanguage($lang_code)
	{
		$this->lang_code = $lang_code;
	}

	function getLanguage()
	{
		return $this->lang_code;
	}

	/**
     * called for included templates
     *
     * @param string $_smarty_include_tpl_file
     * @param string $_smarty_include_vars
     */

    function _smarty_include($params)
    {
        if ($this->debugging) {
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $debug_start_time = smarty_core_get_microtime($_params, $this);
            $this->_smarty_debug_info[] = array('type'      => 'template',
                                                  'filename'  => $params['smarty_include_tpl_file'],
                                                  'depth'     => ++$this->_inclusion_depth);
            $included_tpls_idx = count($this->_smarty_debug_info) - 1;
        }

		if (!empty($params['smarty_include_vars']['params_array'])) {
			foreach ($params['smarty_include_vars']['params_array'] as $k => $v) {
				$this->_tpl_vars[$k] = $v;
			}
			unset($params['smarty_include_vars']['params_array']);
		}

        if ($this->customization) {
        	$this->_smarty_customization_info[] = array('filename' => $params['smarty_include_tpl_file'], 'depth' => ($this->debugging ? $this->_inclusion_depth : ++$this->_inclusion_depth));
		}

        $this->_tpl_vars = array_merge($this->_tpl_vars, $params['smarty_include_vars']);


		if (strpos($params['smarty_include_tpl_file'], 'addons/') === 0) {
			$path_array = explode('/', $params['smarty_include_tpl_file']);
			if (fn_load_addon($path_array[1]) == false) {
				return false;
			}
		}

		//
		// Substitute current skin area
		//

		$_skin_name = ($this->_tpl_vars['skin_area'] == 'mail' || $this->_tpl_vars['skin_area'] == 'customer') ? Registry::get('settings.skin_name_customer') : Registry::get('config.skin_name');
		$this->template_dir = DIR_ROOT . '/skins/' . $_skin_name . '/' . $this->_tpl_vars['skin_area'];
		$this->_tpl_vars['images_dir'] = Registry::get('config.current_path') . '/skins/' . $_skin_name . '/' . $this->_tpl_vars['skin_area'] . '/images';
		$this->_tpl_vars['skin_dir'] = Registry::get('config.current_path') . '/skins/' . $_skin_name . '/' . $this->_tpl_vars['skin_area'];

		// config vars are treated as local, so push a copy of the
        // current ones onto the front of the stack
        array_unshift($this->_config, $this->_config[0]);

        $_smarty_compile_path = $this->_get_compile_path($params['smarty_include_tpl_file']);


        if ($this->_is_compiled($params['smarty_include_tpl_file'], $_smarty_compile_path)
            || $this->_compile_resource($params['smarty_include_tpl_file'], $_smarty_compile_path))
        {
            include($_smarty_compile_path);
        }

        // pop the local vars off the front of the stack
        array_shift($this->_config);

        if ($this->debugging) {
            // capture time for debugging info
            $_params = array();
            require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
            $this->_smarty_debug_info[$included_tpls_idx]['exec_time'] = smarty_core_get_microtime($_params, $this) - $debug_start_time;
        } else {
        	$this->_inclusion_depth--;
		}

        if ($this->caching) {
            $this->_cache_info['template'][$params['smarty_include_tpl_file']] = true;
        }
    }

	function display($tpl, $to_screen = true)
	{
		// Cache includer
		$this->register_function('include_clipcache', array(&$this, 'include_clipcache'));

		if (defined('AJAX_REQUEST')) {
			// Decrease amount of templates to parse if we're using ajax request
			$tpl = $tpl == 'index.tpl' ? (defined('PARSE_ALL')? $tpl : $this->get_var('content_tpl')) : $tpl;
		}

		// Pass navigation to templates
		$this->assign('navigation', Registry::get('navigation'));
		
		if ($to_screen == true) {
			if (ini_get('zlib.output_compression') == '' && strpos(@$_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false && !defined('AJAX_REQUEST')) {
				//ob_start('ob_gzhandler');
			}
			parent::display($tpl);
		} else {
			return $this->fetch($tpl);
		}
	}

	//
	// Checks if inline blocks are changed and parent template should be recompiled
	//
	function check_inline_blocks($resources = array())
	{
		$result = false;
		foreach ($resources as $res => $ts) {
			$_smarty_compile_path = $this->_get_compile_path($res);

			if (!file_exists($_smarty_compile_path) || $ts < filemtime($this->template_dir . '/' . $res)) {
				if ($this->_is_compiled($res, $_smarty_compile_path) == false) {
					$this->_compile_resource($res, $_smarty_compile_path);
				}
				$result = true;
			}
		}

		return $result;
	}

	//
	// Include cached template
	//
	function include_clipcache($params, &$smarty)
	{
		// validation
		if (empty($params['file'])) {
			$smarty->trigger_error( "include_clipcache: 'file' param missing. Aborted.", E_USER_WARNING);
			return false;
		}

		$_caching = $smarty->caching;
		$smarty->caching = 2;

		$content = $smarty->fetch($params['file'], $params['cache_id']);

		$smarty->caching = $_caching;

		return $content;
	}

	//
	// Get template variable
	//
	function get_var($var, $default = NULL)
	{
		if (!isset($this->_tpl_vars[$var])) {
			$this->_tpl_vars[$var] = ($default === NULL) ? array() : $default;
		}

		return fn_html_escape($this->_tpl_vars[$var], true);
	}


	//
	// This filter wraps templates which don't have {include} tags inside into ob_start/ob_end_flush functions
	// to speed-up content displaying
	//
	function prefilter_output_buffering($content, &$compiler)
	{

		if (strpos($content, '{include ') === false) {
			return "{php} ob_start(); {/php}" . $content . "{php} ob_end_flush(); {/php}";
		}

		return $content;
	}

	//
	// This filter gets all available language variables in templates and puts their retrieving to the template start
	//
	function postfilter_translation($content, &$compiler)
	{
		if (preg_match_all('/fn_get_lang_var\(\'(\w*)\', \$this->getLanguage\(\)\)/i', $content, $matches)) {
			return "<?php\nfn_preload_lang_vars(array('" . implode("','", $matches[1]) . "'));\n?>\n" . $content;
		}

		return $content;
	}

	//
	// This prefilter caches defined templates
	//
	function prefilter_cache_templates($content, &$compiler)
	{
		if (preg_match_all('!' . preg_quote($compiler->left_delimiter, '!') . 'include (.*)' . preg_quote($compiler->right_delimiter, '!') . '!Us', $content, $matches)) {
			foreach ($matches[1] as $k => $m) {
				$_attrs = $compiler->_parse_attrs($m);
				if (!empty($_attrs['cache_id'])) {
					$resource_name = $compiler->_dequote($_attrs['file']);
					$content = str_replace($matches[0][$k], str_replace('include ', 'include_clipcache ', $matches[0][$k]), $content);
				}
			}
		}

		return $content;
	}


	//
	// Overload base method to forbid array assigning
	//

	function assign($tpl_var, $value = null, $escape = true)
	{
		fn_update_lang_objects($tpl_var, $value);

		if (is_array($tpl_var)){
			$this->trigger_error("Assigning by array is not implemented");
		} else {
			if ($tpl_var != '') {
				$this->_tpl_vars[$tpl_var] = ($escape) ? fn_html_escape($value) : $value;
			}
		}
	}

	function outputfilter_translate_wrapper($content, &$compiler)
	{
		$pattern = '/\<(input|img)[^>]*?(\[lang name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/lang\])[^>]*?\>/';
		if (preg_match_all($pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$phrase_replaced = str_replace($matches[2][$k], $matches[5][$k], $matches[0][$k]);
				if (strpos($m, 'class="') !== false) {
					$class_added = str_replace('class="', 'class="cm-translate lang_' . $matches[3][$k] . $matches[4][$k] . ' ', $phrase_replaced);
				} else {
					$class_added = str_replace($matches[1][$k], $matches[1][$k] . ' class="cm-translate lang_' . $matches[3][$k] . $matches[4][$k] . '"', $phrase_replaced);
				}
				$content = str_replace($matches[0][$k], $class_added, $content);
			}
		}

		$pattern = '/(\<(textarea|option)[^<]*?)\>(\[lang name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/lang\])[^>]*?\>/is';
		if (preg_match_all($pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$phrase_replaced = str_replace($matches[3][$k], $matches[6][$k], $matches[0][$k]);
				if (strpos($m, 'class="') !== false) {
					$class_added = str_replace('class="', 'class="cm-translate lang_' . $matches[4][$k] . $matches[5][$k] . ' ', $phrase_replaced);
				} else {
					$class_added = str_replace($matches[2][$k], $matches[2][$k] . ' class="cm-translate lang_' . $matches[4][$k] . $matches[5][$k] . '"', $phrase_replaced);
				}
				$content = str_replace($matches[0][$k], $class_added, $content);
			}
		}

		$pattern = '/<title>(.*?)<\/title>/is';
		$pattern_inner = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/is';
		preg_match($pattern, $content, $matches);
		$phrase_replaced = $matches[0];
		$phrase_replaced = preg_replace($pattern_inner, '$4', $phrase_replaced);
		$content = str_replace($matches[0], $phrase_replaced, $content);

		$pattern = '/(?<=>)[^<]*?\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/is';
		$pattern_inner = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\]((?:(?>[^\[]+)|\[(?!\1[^\]]*\]))*?)\[\/\1\]/is';
		$replacement = '<acronym class="cm-translate lang_$2$3">$4</acronym>';
		while (preg_match($pattern, $content, $matches)) {
			$phrase_replaced = $matches[0];
			while (preg_match($pattern_inner, $phrase_replaced)) {
				$phrase_replaced = preg_replace($pattern_inner, $replacement, $phrase_replaced);
			}
			$content = str_replace($matches[0], $phrase_replaced, $content);
		}

		$pattern = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/';
		$replacement = '$4';
		$content = preg_replace($pattern, $replacement, $content);

		return $content;
	}

	function prefilter_hook($content, &$compiler)
	{
		$pattern = '/\{hook( name="([^"}]+)")\}((?:(?>[^\{]+)|\{(?!hook[^\}]*\}))*?)\{\/hook\}/is';
		$cur_templ = !empty($compiler->inline_tpl_name) ? $compiler->inline_tpl_name : $compiler->_current_file;
		$positions = array('pre', 'post', 'override');
		$tmp = array();
		$cnt = 1000;

		while (preg_match($pattern, $content, $matches)) {
			$cnt--;
			$tmp[] = $cnt;
			$override_prefix = '{tmp_prefilter#' . $cnt . $matches[1] .'}';
			$close_tag = '{/tmp_prefilter#' . $cnt .'}';
			$override_suffix = $close_tag;
			$hook_body = $matches[3];
			$tpl_name = str_replace(':', '/', $matches[2]);
			foreach (Registry::get('addons') as $i => $v) {
				foreach ($positions as $pos) {
					$tpl = 'addons/' . $i . '/hooks/' . $tpl_name . '.' . $pos . '.tpl';
					
					if ($this->template_exists($tpl) && strpos($cur_templ, $tpl) === false) {
						
						if ($pos == 'pre') {
							$hook_body = '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '"}{/if}' . $hook_body;
						} elseif ($pos == 'post') {
							$hook_body .= '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '"}{/if}';
						} elseif ($pos == 'override') {
							$override_prefix = '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '" assign="addon_content"}{else}{assign var="addon_content" value=""}{/if}{if $addon_content|trim}{$addon_content}{else}' . $override_prefix;
							$override_suffix .= '{/if}';
						}
					}
				}
			}
			$content = preg_replace($pattern, $override_prefix . $hook_body . $override_suffix, $content, 1);
		}

		foreach ($tmp as $key) {
			$pattern = '/tmp_prefilter#' . $key . '/is';
			$content = preg_replace($pattern, 'hook', $content);
		}

		return $content;
	}

	function prefilter_template_wrapper($content, &$compiler)
	{
		$cur_templ = $compiler->_current_file;
		$ignored_template = array('index.tpl', 'common_templates/pagination.tpl', 'views/categories/components/menu_items.tpl');
		if (!in_array($cur_templ, $ignored_template)) {
			$content = '{capture name="template_content"}' . $content . '{/capture}{if $smarty.capture.template_content|trim}<blockquote class="cm-template-box" template="' . $cur_templ . '" id="{set_id name=' . $cur_templ . '}"><img class="cm-template-icon hidden" src="{$images_dir}/icons/layout_edit.gif" width="16" height="16" alt="" />{$smarty.capture.template_content}<!--[/tpl_id]--></blockquote>{/if}';
		}

		return $content;
	}

	function outputfilter_template_ids($content, &$compiler)
	{
		$pattern = '/(\<head\>.*?)(\<blockquote[^<>]*\>|\<\/blockquote\>|\<img[^<>]*\>|\<!--[\w]*--\>)+?(.*?\<\/head\>)/is';
		while (preg_match($pattern, $content, $match)) {
			$content = str_replace($match[0], $match[1] . $match[3], $content);
		}
		$pattern = '/\<blockquote[^<>]*\>|\<\/blockquote\>|\<img[^<>]*\>|\<!--[\w]*--\>/is';
		$glob_pattern = '/\<script[^<>]*\>.*?\<\/script\>/is';
		if (preg_match_all($glob_pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$replace_script = preg_replace($pattern, '', $matches[0][$k]);
				$content = str_replace($matches[0][$k], $replace_script, $content);
			}
		}

		static $template_ids;
		if (!isset($template_ids)) {
			$template_ids = array();
		}

		$pattern = '/\[(tpl_id) ([^ ]*)\]((?:(?>[^\[]+)|\[(?!\1[^\]]*\]))*?)\[\/\1\]/is';
		while (preg_match($pattern, $content, $matches)) {
			$id = 'te' . md5($matches[2]);
			if (empty($template_ids[$matches[2]])) {
				$template_ids[$matches[2]] = 1;
			} else {
				$template_ids[$matches[2]]++;
				$id .= '_' . $template_ids[$matches[2]];
			}
			$content = preg_replace($pattern, $id . '${3}' . $id, $content, 1);
		}

		return $content;
	}

	//
	// This filter include templates which have no {include} tags inside to the parent template
	//
	function prefilter_inline($source, &$compiler)
	{
		$compiler->_inline_cache = array();
		$output = preg_replace_callback('!' . preg_quote($this->left_delimiter, '!') . 'include (.*)' . preg_quote($this->right_delimiter, '!') . '!Us', array($compiler, '_prefilter_inline_callback'), $source);
		if (!empty($complier->_inline_cache)) {
			$output = "{php}\n
				\$rname = !empty(\$resource_name) ? \$resource_name : \$params['smarty_include_tpl_file'];
				if (\$this->compile_check && empty(\$inline_no_check[\$rname])) {
					if (\$this->check_inline_blocks(" . var_export($compiler->_inline_cache, true) .")) {
						\$_smarty_compile_path = \$this->_get_compile_path(\$rname);
						\$this->_compile_resource(\$rname, \$_smarty_compile_path);
						\$inline_no_check[\$rname] = true;
						include \$_smarty_compile_path;
						return;
					}
				}
			{/php}" . $output;

			$complier->_inline_cache = array();
		}

		return $output;
	}

	/**
     * compile the given source
     *
     * @param string $resource_name
     * @param string $source_content
     * @param string $compiled_content
     * @return boolean
     */
    function _compile_source($resource_name, &$source_content, &$compiled_content, $cache_include_path=null)
    {
        if (file_exists(SMARTY_DIR . $this->compiler_file)) {
            require_once(SMARTY_DIR . $this->compiler_file);
        } else {
            // use include_path
            require_once($this->compiler_file);
        }


        $smarty_compiler = new $this->compiler_class;

        $smarty_compiler->smarty            = & $this;
        $smarty_compiler->template_dir      = $this->template_dir;
        $smarty_compiler->compile_dir       = $this->compile_dir;
        $smarty_compiler->plugins_dir       = $this->plugins_dir;
        $smarty_compiler->config_dir        = $this->config_dir;
        $smarty_compiler->force_compile     = $this->force_compile;
        $smarty_compiler->caching           = $this->caching;
        $smarty_compiler->php_handling      = $this->php_handling;
        $smarty_compiler->left_delimiter    = $this->left_delimiter;
        $smarty_compiler->right_delimiter   = $this->right_delimiter;
        $smarty_compiler->_version          = $this->_version;
        $smarty_compiler->security          = $this->security;
        $smarty_compiler->secure_dir        = $this->secure_dir;
        $smarty_compiler->security_settings = $this->security_settings;
        $smarty_compiler->trusted_dir       = $this->trusted_dir;
        $smarty_compiler->use_sub_dirs      = $this->use_sub_dirs;
        $smarty_compiler->_reg_objects      = &$this->_reg_objects;
        $smarty_compiler->_plugins          = &$this->_plugins;
        $smarty_compiler->_tpl_vars         = &$this->_tpl_vars;
        $smarty_compiler->default_modifiers = $this->default_modifiers;
        $smarty_compiler->compile_id        = $this->_compile_id;
        $smarty_compiler->_config            = $this->_config;
        $smarty_compiler->request_use_auto_globals  = $this->request_use_auto_globals;

        if (isset($cache_include_path) && isset($this->_cache_serials[$cache_include_path])) {
            $smarty_compiler->_cache_serial = $this->_cache_serials[$cache_include_path];
        }
        $smarty_compiler->_cache_include = $cache_include_path;


        $_results = $smarty_compiler->_compile_file($resource_name, $source_content, $compiled_content);

        if ($smarty_compiler->_cache_serial) {
            $this->_cache_include_info = array(
                'cache_serial'=>$smarty_compiler->_cache_serial
                ,'plugins_code'=>$smarty_compiler->_plugins_code
                ,'include_file_path' => $cache_include_path);

        } else {
            $this->_cache_include_info = null;

        }

        return $_results;
    }
}

/**
 * Template compiling class
 * @package Smarty
 */
class Templater_Compiler extends Smarty_Compiler {

	function __construct()
	{
		parent::__construct();

        $this->_dvar_guts_regexp = '\w+(?:' . $this->_var_bracket_regexp
                . ')*(?:\.\#?\$?\w+(?:' . $this->_var_bracket_regexp . ')*)*(?:' . $this->_dvar_math_regexp . '(?:' . $this->_num_const_regexp . '|' . $this->_dvar_math_var_regexp . ')*)?';
		$this->_dvar_regexp = '\$' . $this->_dvar_guts_regexp;

        $this->_avar_regexp = '(?:' . $this->_dvar_regexp . '|'
           . $this->_cvar_regexp . '|' . $this->_svar_regexp . ')';

		$this->_var_regexp = '(?:' . $this->_avar_regexp . '|' . $this->_qstr_regexp . ')';

        $this->_mod_regexp = '(?:\|@?\w+(?::(?:\w+|' . $this->_num_const_regexp . '|'
           . $this->_obj_call_regexp . '|' . $this->_avar_regexp . '|' . $this->_qstr_regexp .'))*)';

        $this->_obj_ext_regexp = '\->(?:\$?' . $this->_dvar_guts_regexp . ')';
        $this->_obj_restricted_param_regexp = '(?:'
                . '(?:' . $this->_var_regexp . '|' . $this->_num_const_regexp . ')(?:' . $this->_obj_ext_regexp . '(?:\((?:(?:' . $this->_var_regexp . '|' . $this->_num_const_regexp . ')'
                . '(?:\s*,\s*(?:' . $this->_var_regexp . '|' . $this->_num_const_regexp . '))*)?\))?)*)';
        $this->_obj_single_param_regexp = '(?:\w+|' . $this->_obj_restricted_param_regexp . '(?:\s*,\s*(?:(?:\w+|'
                . $this->_var_regexp . $this->_obj_restricted_param_regexp . ')))*)';
        $this->_obj_params_regexp = '\((?:' . $this->_obj_single_param_regexp
                . '(?:\s*,\s*' . $this->_obj_single_param_regexp . ')*)?\)';
        $this->_obj_start_regexp = '(?:' . $this->_dvar_regexp . '(?:' . $this->_obj_ext_regexp . ')+)';
        $this->_obj_call_regexp = '(?:' . $this->_obj_start_regexp . '(?:' . $this->_obj_params_regexp . ')?(?:' . $this->_dvar_math_regexp . '(?:' . $this->_num_const_regexp . '|' . $this->_dvar_math_var_regexp . ')*)?)';

        $this->_param_regexp = '(?:\s*(?:' . $this->_obj_call_regexp . '|'
           . $this->_var_regexp . '|' . $this->_num_const_regexp  . '|\w+)(?>' . $this->_mod_regexp . '*)\s*)';

        $this->_parenth_param_regexp = '(?:\((?:\w+|'
                . $this->_param_regexp . '(?:\s*,\s*(?:(?:\w+|'
                . $this->_param_regexp . ')))*)?\))';

	}

	//
	// Overload base method to output content inside literal block as pure html
	//
    function _compile_file($resource_name, $source_content, &$compiled_content)
    {

        if ($this->security) {
            // do not allow php syntax to be executed unless specified
            if ($this->php_handling == SMARTY_PHP_ALLOW &&
                !$this->security_settings['PHP_HANDLING']) {
                $this->php_handling = SMARTY_PHP_PASSTHRU;
            }
        }

        $this->_load_filters();

        $this->_current_file = $resource_name;
        $this->_current_line_no = 1;
        $ldq = preg_quote($this->left_delimiter, '~');
        $rdq = preg_quote($this->right_delimiter, '~');

        // run template source through prefilter functions
        if (count($this->_plugins['prefilter']) > 0) {
            foreach ($this->_plugins['prefilter'] as $filter_name => $prefilter) {
                if ($prefilter === false) continue;
                if ($prefilter[3] || is_callable($prefilter[0])) {
                    $source_content = call_user_func_array($prefilter[0],
                                                            array($source_content, &$this));
                    $this->_plugins['prefilter'][$filter_name][3] = true;
                } else {
                    $this->_trigger_fatal_error("[plugin] prefilter '$filter_name' is not implemented");
                }
            }
        }

        /* fetch all special blocks */
        $search = "~{$ldq}\*(.*?)\*{$rdq}|{$ldq}\s*literal\s*{$rdq}(.*?){$ldq}\s*/literal\s*{$rdq}|{$ldq}\s*php\s*{$rdq}(.*?){$ldq}\s*/php\s*{$rdq}~s";

        preg_match_all($search, $source_content, $match,  PREG_SET_ORDER);
        $this->_folded_blocks = $match;
        reset($this->_folded_blocks);

        /* replace special blocks by "{php}" */
        $source_content = preg_replace($search.'e', "'"
                                       . $this->_quote_replace($this->left_delimiter) . 'php'
                                       . "' . str_repeat(\"\n\", substr_count('\\0', \"\n\")) .'"
                                       . $this->_quote_replace($this->right_delimiter)
                                       . "'"
                                       , $source_content);

        /* Gather all template tags. */
        preg_match_all("~{$ldq}\s*(.*?)\s*{$rdq}~s", $source_content, $_match);
        $template_tags = $_match[1];
        /* Split content by template tags to obtain non-template content. */
        $text_blocks = preg_split("~{$ldq}.*?{$rdq}~s", $source_content);

        /* loop through text blocks */
        for ($curr_tb = 0, $for_max = count($text_blocks); $curr_tb < $for_max; $curr_tb++) {
            /* match anything resembling php tags */
            if (preg_match_all('~(<\?(?:\w+|=)?|\?>|language\s*=\s*[\"\']?\s*php\s*[\"\']?)~is', $text_blocks[$curr_tb], $sp_match)) {
                /* replace tags with placeholders to prevent recursive replacements */
                $sp_match[1] = array_unique($sp_match[1]);
                usort($sp_match[1], '_smarty_sort_length');
                for ($curr_sp = 0, $for_max2 = count($sp_match[1]); $curr_sp < $for_max2; $curr_sp++) {
                    $text_blocks[$curr_tb] = str_replace($sp_match[1][$curr_sp],'%%%SMARTYSP'.$curr_sp.'%%%',$text_blocks[$curr_tb]);
                }
                /* process each one */
                for ($curr_sp = 0, $for_max2 = count($sp_match[1]); $curr_sp < $for_max2; $curr_sp++) {
                    if ($this->php_handling == SMARTY_PHP_PASSTHRU) {
                        /* echo php contents */
                        $text_blocks[$curr_tb] = str_replace('%%%SMARTYSP'.$curr_sp.'%%%', '<?php echo \''.str_replace("'", "\'", $sp_match[1][$curr_sp]).'\'; ?>'."\n", $text_blocks[$curr_tb]);
                    } else if ($this->php_handling == SMARTY_PHP_QUOTE) {
                        /* quote php tags */
                        $text_blocks[$curr_tb] = str_replace('%%%SMARTYSP'.$curr_sp.'%%%', htmlspecialchars($sp_match[1][$curr_sp]), $text_blocks[$curr_tb]);
                    } else if ($this->php_handling == SMARTY_PHP_REMOVE) {
                        /* remove php tags */
                        $text_blocks[$curr_tb] = str_replace('%%%SMARTYSP'.$curr_sp.'%%%', '', $text_blocks[$curr_tb]);
                    } else {
                        /* SMARTY_PHP_ALLOW, but echo non php starting tags */
                        $sp_match[1][$curr_sp] = preg_replace('~(<\?(?!php|=|$))~i', '<?php echo \'\\1\'?>'."\n", $sp_match[1][$curr_sp]);
                        $text_blocks[$curr_tb] = str_replace('%%%SMARTYSP'.$curr_sp.'%%%', $sp_match[1][$curr_sp], $text_blocks[$curr_tb]);
                    }
                }
            }
        }

        /* Compile the template tags into PHP code. */
        $compiled_tags = array();
        for ($i = 0, $for_max = count($template_tags); $i < $for_max; $i++) {
            $this->_current_line_no += substr_count($text_blocks[$i], "\n");
            $compiled_tags[] = $this->_compile_tag($template_tags[$i]);
            $this->_current_line_no += substr_count($template_tags[$i], "\n");
        }
        if (count($this->_tag_stack)>0) {
            list($_open_tag, $_line_no) = end($this->_tag_stack);
            $this->_syntax_error("unclosed tag \{$_open_tag} (opened line $_line_no).", E_USER_ERROR, __FILE__, __LINE__);
            return;
        }

        /* Reformat $text_blocks between 'strip' and '/strip' tags,
           removing spaces, tabs and newlines. */
        $strip = false;
        for ($i = 0, $for_max = count($compiled_tags); $i < $for_max; $i++) {
            if ($compiled_tags[$i] == '{strip}') {
                $compiled_tags[$i] = '';
                $strip = true;
                /* remove leading whitespaces */
                $text_blocks[$i + 1] = ltrim($text_blocks[$i + 1]);
            }
            if ($strip) {
                /* strip all $text_blocks before the next '/strip' */
                for ($j = $i + 1; $j < $for_max; $j++) {
                    /* remove leading and trailing whitespaces of each line */
                    $text_blocks[$j] = preg_replace('![\t ]*[\r\n]+[\t ]*!', '', $text_blocks[$j]);
                    if ($compiled_tags[$j] == '{/strip}') {
                        /* remove trailing whitespaces from the last text_block */
                        $text_blocks[$j] = rtrim($text_blocks[$j]);
                    }

                    /* $text_blocks[$j] = "<?php echo '" . strtr($text_blocks[$j], array("'"=>"\'", "\\"=>"\\\\")) . "'; ?>"; */ //zeke

                    if ($compiled_tags[$j] == '{/strip}') {
                        $compiled_tags[$j] = "\n"; /* slurped by php, but necessary
                                    if a newline is following the closing strip-tag */
                        $strip = false;
                        $i = $j;
                        break;
                    }
                }
            }
        }
        $compiled_content = '';

        $tag_guard = '%%%SMARTYOTG' . md5(uniqid(rand(), true)) . '%%%';

        /* Interleave the compiled contents and text blocks to get the final result. */
        for ($i = 0, $for_max = count($compiled_tags); $i < $for_max; $i++) {
            if ($compiled_tags[$i] == '') {
                // tag result empty, remove first newline from following text block
                $text_blocks[$i+1] = preg_replace('~^(\r\n|\r|\n)~', '', $text_blocks[$i+1]);
            }
            // replace legit PHP tags with placeholder
            $text_blocks[$i] = str_replace('<?', $tag_guard, $text_blocks[$i]);
            $compiled_tags[$i] = str_replace('<?', $tag_guard, $compiled_tags[$i]);

            $compiled_content .= $text_blocks[$i] . $compiled_tags[$i];
        }
        $compiled_content .= str_replace('<?', $tag_guard, $text_blocks[$i]);

        // escape php tags created by interleaving
        $compiled_content = str_replace('<?', "<?php echo '<?' ?>\n", $compiled_content);
        $compiled_content = preg_replace("~(?<!')language\s*=\s*[\"\']?\s*php\s*[\"\']?~", "<?php echo 'language=php' ?>\n", $compiled_content);

        // recover legit tags
        $compiled_content = str_replace($tag_guard, '<?', $compiled_content);

        // remove \n from the end of the file, if any
        if (strlen($compiled_content) && (substr($compiled_content, -1) == "\n") ) {
            $compiled_content = substr($compiled_content, 0, -1);
        }

        if (!empty($this->_cache_serial)) {
            $compiled_content = "<?php \$this->_cache_serials['".$this->_cache_include."'] = '".$this->_cache_serial."'; ?>" . $compiled_content;
        }

        // run compiled template through postfilter functions
        if (count($this->_plugins['postfilter']) > 0) {
            foreach ($this->_plugins['postfilter'] as $filter_name => $postfilter) {
                if ($postfilter === false) continue;
                if ($postfilter[3] || is_callable($postfilter[0])) {
                    $compiled_content = call_user_func_array($postfilter[0],
                                                              array($compiled_content, &$this));
                    $this->_plugins['postfilter'][$filter_name][3] = true;
                } else {
                    $this->_trigger_fatal_error("Smarty plugin error: postfilter '$filter_name' is not implemented");
                }
            }
        }

        // put header at the top of the compiled template
        $template_header = "<?php /* Smarty version ".$this->_version.", created on ".strftime("%Y-%m-%d %H:%M:%S")."\n";
        $template_header .= "         compiled from ".strtr(urlencode($resource_name), array('%2F'=>'/', '%3A'=>':'))." */ \n \$__tpl_vars = & \$this->_tpl_vars;\n ?>\n";

        /* Emit code to load needed plugins. */
        $this->_plugins_code = '';
        if (count($this->_plugin_info)) {
            $_plugins_params = "array('plugins' => array(";
            foreach ($this->_plugin_info as $plugin_type => $plugins) {
                foreach ($plugins as $plugin_name => $plugin_info) {
                    $_plugins_params .= "array('$plugin_type', '$plugin_name', '" . strtr($plugin_info[0], array("'" => "\\'", "\\" => "\\\\")) . "', $plugin_info[1], ";
                    $_plugins_params .= $plugin_info[2] ? 'true),' : 'false),';
                }
            }
            $_plugins_params .= '))';
            $plugins_code = "<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');\nsmarty_core_load_plugins($_plugins_params, \$this); ?>\n";
            $template_header .= $plugins_code;
            $this->_plugin_info = array();
            $this->_plugins_code = $plugins_code;
        }

        if ($this->_init_smarty_vars) {
            $template_header .= "<?php require_once(SMARTY_CORE_DIR . 'core.assign_smarty_interface.php');\nsmarty_core_assign_smarty_interface(null, \$this); ?>\n";
            $this->_init_smarty_vars = false;
        }

        $compiled_content = $template_header . $compiled_content;
        return true;
    }

	//
	// Overload base method to replace $this->_tpl_vars with $__tpl_vars and for better formatting
	//
    function _compile_registered_object_tag($tag_command, $attrs, $tag_modifier)
    {
        if (substr($tag_command, 0, 1) == '/') {
            $start_tag = false;
            $tag_command = substr($tag_command, 1);
        } else {
            $start_tag = true;
        }

        list($object, $obj_comp) = explode('->', $tag_command);

        $arg_list = array();
        if(count($attrs)) {
            $_assign_var = false;
            foreach ($attrs as $arg_name => $arg_value) {
                if($arg_name == 'assign') {
                    $_assign_var = $arg_value;
                    unset($attrs['assign']);
                    continue;
                }
                if (is_bool($arg_value))
                    $arg_value = $arg_value ? 'true' : 'false';
                $arg_list[] = "'$arg_name' => $arg_value";
            }
        }

        if($this->_reg_objects[$object][2]) {
            // smarty object argument format
            $args = "array(".implode(',', (array)$arg_list)."), \$this";
        } else {
            // traditional argument format
            $args = implode(',', array_values($attrs));
            if (empty($args)) {
                $args = 'null';
            }
        }

        $prefix = '';
        $postfix = '';
        $newline = '';
        if(!is_object($this->_reg_objects[$object][0])) {
            $this->_trigger_fatal_error("registered '$object' is not an object" , $this->_current_file, $this->_current_line_no, __FILE__, __LINE__);
        } elseif(!empty($this->_reg_objects[$object][1]) && !in_array($obj_comp, $this->_reg_objects[$object][1])) {
            $this->_trigger_fatal_error("'$obj_comp' is not a registered component of object '$object'", $this->_current_file, $this->_current_line_no, __FILE__, __LINE__);
        } elseif(method_exists($this->_reg_objects[$object][0], $obj_comp)) {
            // method
            if(in_array($obj_comp, $this->_reg_objects[$object][3])) {
                // block method
                if ($start_tag) {
                    $prefix = "\$this->_tag_stack[] = array('$obj_comp', $args); ";
                    $prefix .= "\$_block_repeat=true; \$this->_reg_objects['$object'][0]->$obj_comp(\$this->_tag_stack[count(\$this->_tag_stack)-1][1], null, \$this, \$_block_repeat); ";
                    $prefix .= "while (\$_block_repeat) { ob_start();";
                    $return = null;
                    $postfix = '';
                } else {
                    $prefix = "\$_obj_block_content = ob_get_contents(); ob_end_clean(); \$_block_repeat=false;";
                    $return = "\$this->_reg_objects['$object'][0]->$obj_comp(\$this->_tag_stack[count(\$this->_tag_stack)-1][1], \$_obj_block_content, \$this, \$_block_repeat)";
                    $postfix = "} array_pop(\$this->_tag_stack);";
                }
            } else {
                // non-block method
                $return = "\$this->_reg_objects['$object'][0]->$obj_comp($args)";
            }
        } else {
            // property
            $return = "\$this->_reg_objects['$object'][0]->$obj_comp";
        }

        if($return != null) {
            if($tag_modifier != '') {
                $this->_parse_modifiers($return, $tag_modifier);
            }

            if(!empty($_assign_var)) {
                $output = "\$__tpl_vars['" . $this->_dequote($_assign_var) ."'] = $return;"; //zeke
            } else {
                $output = 'echo ' . $return . ';';
                $newline = $this->_additional_newline;
            }
        } else {
            $output = '';
        }

        return '<?php ' . $prefix . $output . $postfix . "?>";// . $newline; // zeke
    }

	//
	// Overload base method to replace $this->_tpl_vars with $__tpl_vars
	//
    function _compile_include_tag($tag_args)
    {
        $attrs = $this->_parse_attrs($tag_args);
        $arg_list = array();

        if (empty($attrs['file'])) {
            $this->_syntax_error("missing 'file' attribute in include tag", E_USER_ERROR, __FILE__, __LINE__);
        }

        foreach ($attrs as $arg_name => $arg_value) {
            if ($arg_name == 'file') {
                $include_file = $arg_value;
                continue;
            } else if ($arg_name == 'assign') {
                $assign_var = $arg_value;
                continue;
            }
            if (is_bool($arg_value))
                $arg_value = $arg_value ? 'true' : 'false';
            $arg_list[] = "'$arg_name' => $arg_value";
        }

        $output = '<?php ';

        if (isset($assign_var)) {
            $output .= "ob_start();\n";
        }

        $output .=
            "\$_smarty_tpl_vars = \$__tpl_vars;"; //zeke


        $_params = "array('smarty_include_tpl_file' => " . $include_file . ", 'smarty_include_vars' => array(".implode(',', (array)$arg_list)."))";
        $output .= "\$this->_smarty_include($_params);\n" .
        "\$__tpl_vars = \$_smarty_tpl_vars;\n" .
        "unset(\$_smarty_tpl_vars);\n"; //zeke

        if (isset($assign_var)) {
            $output .= "\$__tpl_vars[" . $assign_var . "] = ob_get_contents(); ob_end_clean();\n"; //zeke
        }

        $output .= ' ?>';

        return $output;

    }

	//
	// Overload base method to replace $this->_tpl_vars with $__tpl_vars and pass variable to foreach by reference
	//
    function _compile_foreach_start($tag_args)
    {
        $attrs = $this->_parse_attrs($tag_args);
        $arg_list = array();

        if (empty($attrs['from'])) {
            return $this->_syntax_error("foreach: missing 'from' attribute", E_USER_ERROR, __FILE__, __LINE__);
        }
        $from = $attrs['from'];

        if (empty($attrs['item'])) {
            return $this->_syntax_error("foreach: missing 'item' attribute", E_USER_ERROR, __FILE__, __LINE__);
        }
        $item = $this->_dequote($attrs['item']);
        if (!preg_match('~^\w+$~', $item)) {
            return $this->_syntax_error("'foreach: 'item' must be a variable name (literal string)", E_USER_ERROR, __FILE__, __LINE__);
        }

        if (isset($attrs['key'])) {
            $key  = $this->_dequote($attrs['key']);
            if (!preg_match('~^\w+$~', $key)) {
                return $this->_syntax_error("foreach: 'key' must to be a variable name (literal string)", E_USER_ERROR, __FILE__, __LINE__);
            }
            $key_part = "\$__tpl_vars['$key'] => "; //zeke
        } else {
            $key = null;
            $key_part = '';
        }

        if (isset($attrs['name'])) {
            $name = $attrs['name'];
        } else {
            $name = null;
        }

		$_from = "\$_from_" . fn_crc32($attrs['from']);
        $output = '<?php ';
        $output .= "$_from = & $from; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }"; //zeke
        if (isset($name)) {
            $foreach_props = "\$this->_foreach[$name]";
            $output .= "{$foreach_props} = array('total' => count($_from), 'iteration' => 0);\n";
            $output .= "if ({$foreach_props}['total'] > 0):\n";
            $output .= "    foreach ($_from as $key_part\$__tpl_vars['$item']):\n"; //zeke
            $output .= "        {$foreach_props}['iteration']++;\n";
        } else {
            $output .= "if (count($_from)):\n";
            $output .= "    foreach ($_from as $key_part\$__tpl_vars['$item']):\n"; //zeke
        }
        $output .= '?>';

        return $output;
    }

	//
	// Overload base method to replace $this->_tpl_vars with $__tpl_vars
	//
    function _compile_capture_tag($start, $tag_args = '')
    {
        $attrs = $this->_parse_attrs($tag_args);

        if ($start) {
            if (isset($attrs['name']))
                $buffer = $attrs['name'];
            else
                $buffer = "'default'";

            if (isset($attrs['assign']))
                $assign = $attrs['assign'];
            else
                $assign = null;
            $output = "<?php ob_start(); ?>";
            $this->_capture_stack[] = array($buffer, $assign);
        } else {
            list($buffer, $assign) = array_pop($this->_capture_stack);
            $output = "<?php \$this->_smarty_vars['capture'][$buffer] = ob_get_contents(); ";
            if (isset($assign)) {
                $output .= " \$__tpl_vars[$assign] = ob_get_contents();"; //zeke
            }
            $output .= "ob_end_clean(); ?>";
        }

        return $output;
    }

    function _parse_var($var_expr)
    {
        $_has_math = false;
        $_math_vars = preg_split('~('.$this->_dvar_math_regexp.'|'.$this->_qstr_regexp.')~', $var_expr, -1, PREG_SPLIT_DELIM_CAPTURE);

        if(count($_math_vars) > 1) {
            $_first_var = "";
            $_complete_var = "";
            $_output = "";
            // simple check if there is any math, to stop recursion (due to modifiers with "xx % yy" as parameter)
            foreach($_math_vars as $_k => $_math_var) {
                $_math_var = $_math_vars[$_k];

                if(!empty($_math_var) || is_numeric($_math_var)) {
                    // hit a math operator, so process the stuff which came before it
                    if(preg_match('~^' . $this->_dvar_math_regexp . '$~', $_math_var)) {
                        $_has_math = true;
                        if(!empty($_complete_var) || is_numeric($_complete_var)) {
                            $_output .= $this->_parse_var($_complete_var);
                        }

                        // just output the math operator to php
                        $_output .= $_math_var;

                        if(empty($_first_var))
                            $_first_var = $_complete_var;

                        $_complete_var = "";
                    } else {
                        $_complete_var .= $_math_var;
                    }
                }
            }
            if($_has_math) {
                if(!empty($_complete_var) || is_numeric($_complete_var))
                    $_output .= $this->_parse_var($_complete_var);

                // get the modifiers working (only the last var from math + modifier is left)
                $var_expr = $_complete_var;
            }
        }

        // prevent cutting of first digit in the number (we _definitly_ got a number if the first char is a digit)
        if(is_numeric(substr($var_expr, 0, 1)))
            $_var_ref = $var_expr;
        else
            $_var_ref = ltrim($var_expr, '$');//substr($var_expr, 1); //zeke

        if(!$_has_math) {

            // get [foo] and .foo and ->foo and (...) pieces
            preg_match_all('~(?:^\w+)|' . $this->_obj_params_regexp . '|(?:' . $this->_var_bracket_regexp . ')|->\$?\w+|\.\$?\w+|\S+~', $_var_ref, $match);

            $_indexes = $match[0];
            $_var_name = array_shift($_indexes);

            /* Handle $smarty.* variable references as a special case. */
            if ($_var_name == 'smarty') {
                /*
                 * If the reference could be compiled, use the compiled output;
                 * otherwise, fall back on the $smarty variable generated at
                 * run-time.
                 */
                if (($smarty_ref = $this->_compile_smarty_ref($_indexes)) !== null) {
                    $_output = $smarty_ref;
                } else {
                    $_var_name = substr(array_shift($_indexes), 1);
                    $_output = "\$this->_smarty_vars['$_var_name']";
                }
            } elseif(is_numeric($_var_name) && is_numeric(substr($var_expr, 0, 1))) {
                // because . is the operator for accessing arrays thru inidizes we need to put it together again for floating point numbers
                if(count($_indexes) > 0)
                {
                    $_var_name .= implode("", $_indexes);
                    $_indexes = array();
                }
                $_output = $_var_name;
			} elseif (!empty($_indexes[0]) && strpos($_indexes[0], '(') === 0) { //zeke
				$_output = $_var_name; //zeke
            } else {
                $_output = "\$__tpl_vars['$_var_name']"; //zeke
            }

			foreach ($_indexes as $_index) {
                if (substr($_index, 0, 1) == '[') {
                    $_index = substr($_index, 1, -1);
                    if (is_numeric($_index)) {
                        $_output .= "[$_index]";
                    } elseif (substr($_index, 0, 1) == '$') {
                        if (strpos($_index, '.') !== false) {
                            $_output .= '[' . $this->_parse_var($_index) . ']';
                        } else {
                            $_output .= "[\$__tpl_vars['" . substr($_index, 1) . "']]"; //zeke
                        }
                    } else {
                        $_var_parts = explode('.', $_index);
                        $_var_section = $_var_parts[0];
                        $_var_section_prop = isset($_var_parts[1]) ? $_var_parts[1] : 'index';
                        $_output .= "[\$this->_sections['$_var_section']['$_var_section_prop']]";
                    }
                } else if (substr($_index, 0, 1) == '.') {
                    if (substr($_index, 1, 1) == '$')
                        $_output .= "[\$__tpl_vars['" . substr($_index, 2) . "']]"; //zeke
                    else
                        $_output .= "['" . substr($_index, 1) . "']";
                } else if (substr($_index,0,2) == '->') {
                    if(substr($_index,2,2) == '__') {
                        $this->_syntax_error('call to internal object members is not allowed', E_USER_ERROR, __FILE__, __LINE__);
                    } elseif($this->security && substr($_index, 2, 1) == '_') {
                        $this->_syntax_error('(secure) call to private object member is not allowed', E_USER_ERROR, __FILE__, __LINE__);
                    } elseif (substr($_index, 2, 1) == '$') {
                        if ($this->security) {
                            $this->_syntax_error('(secure) call to dynamic object member is not allowed', E_USER_ERROR, __FILE__, __LINE__);
                        } else {
                            $_output .= '->{(($_var=$__tpl_vars[\''.substr($_index,3).'\']) && substr($_var,0,2)!=\'__\') ? $_var : $this->trigger_error("cannot access property \\"$_var\\"")}'; //zeke
                        }
                    } else {
                        $_output .= $_index;
                    }
                } elseif (substr($_index, 0, 1) == '(') {
                    $_index = $this->_parse_parenth_args($_index);
                    $_output .= $_index;
                } else {
                    $_output .= $_index;
                }
            }
        }


		if (strstr($_output, "\$__tpl_vars['lang']")) {
			$__tmp = str_replace("\$__tpl_vars['lang'][", 'fn_get_lang_var(', $_output);
			$__tmp{strlen($__tmp)-1} = ',';
			$__tmp .= ' $this->getLanguage())';
			$_output = $__tmp;
			unset($__tmp);
		}

        return $_output;
    }

	//
	// Overloads base method to remove checking for variable type
	//
    function _parse_modifiers(&$output, $modifier_string)
    {
        preg_match_all('~\|(@?\w+)((?>:(?:'. $this->_qstr_regexp . '|[^|]+))*)~', '|' . $modifier_string, $_match);
        list(, $_modifiers, $modifier_arg_strings) = $_match;

        for ($_i = 0, $_for_max = count($_modifiers); $_i < $_for_max; $_i++) {
            $_modifier_name = $_modifiers[$_i];

            if($_modifier_name == 'smarty') {
                // skip smarty modifier
                continue;
            }

            preg_match_all('~:(' . $this->_qstr_regexp . '|[^:]+)~', $modifier_arg_strings[$_i], $_match);
            $_modifier_args = $_match[1];

            if (substr($_modifier_name, 0, 1) == '@') {
                $_map_array = false;
                $_modifier_name = substr($_modifier_name, 1);
            } else {
                $_map_array = true;
            }

            if (empty($this->_plugins['modifier'][$_modifier_name])
                && !$this->_get_plugin_filepath('modifier', $_modifier_name)
                && function_exists($_modifier_name)) {
                if ($this->security && !in_array($_modifier_name, $this->security_settings['MODIFIER_FUNCS'])) {
                    $this->_trigger_fatal_error("[plugin] (secure mode) modifier '$_modifier_name' is not allowed" , $this->_current_file, $this->_current_line_no, __FILE__, __LINE__);
                } else {
                    $this->_plugins['modifier'][$_modifier_name] = array($_modifier_name,  null, null, false);
                }
            }
            $this->_add_plugin('modifier', $_modifier_name);

            $this->_parse_vars_props($_modifier_args);

            if($_modifier_name == 'default') {
                // supress notifications of default modifier vars and args
                if(substr($output, 0, 1) == '$') {
                    $output = '@' . $output;
                }
                if(isset($_modifier_args[0]) && substr($_modifier_args[0], 0, 1) == '$') {
                    $_modifier_args[0] = '@' . $_modifier_args[0];
                }
            }
            if (count($_modifier_args) > 0)
                $_modifier_args = ', '.implode(', ', $_modifier_args);
            else
                $_modifier_args = '';

			$output = $this->_compile_plugin_call('modifier', $_modifier_name)."($output$_modifier_args)";
        }
    }

	//
	// Callback for inline prefilter
	//
	function _prefilter_inline_callback($match)
	{
		$ld = $this->left_delimiter;
		$rd = $this->right_delimiter;
		$source_content = '';

		$_attrs = $this->_parse_attrs($match[1]);

		if (isset($_attrs['assign'])) { // Do not inline template if it has "assign" parameter
			return $match[0];
		}

		if (!isset($_attrs['file'])) {
			$this->syntax_error('[inline] missing file-parameter');
			return false;
		}


		$resource_name = $this->_dequote($_attrs['file']);
		unset($_attrs['file']);

		if (strpos($resource_name, '$') !== false) {
			return $match[0];
		}

		if (isset($_attrs['assign'])) {
			$assign = $_attrs['assign'];
			unset($_attrs['assign']);
		} else {
			$assign = null;
		}

		$source_content .= $ld.'php'.$rd;
		$source_content .= "\$__parent_tpl_vars = \$__tpl_vars;";

		if (!empty($_attrs)) {

			$source_content .= "\$__tpl_vars = array_merge(\$__tpl_vars, array(";
			foreach ($_attrs as $_name => $_value) {
				$source_content .= "'$_name' => $_value, ";
			}
			$source_content .= '));';
		}

		$source_content .= $ld.'/php'.$rd;

		$params = array(
			'resource_name' => $resource_name,
			'quiet' => true,
		);

		if ($this->_fetch_resource_info($params)) {
			// remove comments
			$params['source_content'] = preg_replace('~\{\*(.*?)\*}~', '', $params['source_content']);

			// if we do not have includes from this template, inline it
			if (strpos($params['source_content'], '{include ') === false) {
				$smarty = & $this->smarty;
				$this->inline_tpl_name = $params['resource_name'];
				$params['source_content'] = $smarty->prefilter_hook($params['source_content'], $this);
				unset($this->inline_tpl_name);
				if (strpos($params['source_content'], '{include ') !== false) {
					$params['source_content'] = $smarty->prefilter_inline($params['source_content'], $this);
				}
				
				$source_content .= $params['source_content'];
				$this->_inline_cache[$resource_name] = $params['resource_timestamp'];

				// handle assign
				if (isset($assign)) {
					$source_content = $ld.'php'.$rd . 'ob_start();' . $ld.'/php' . $rd . $source_content . $ld.'php'.$rd . "\$__tpl_vars[$assign] = ob_get_contents(); ob_end_clean();";
				}
				$source_content .= $ld.'php'.$rd . "if (isset(\$__parent_tpl_vars)) { \$__tpl_vars = \$__parent_tpl_vars; unset(\$__parent_tpl_vars);}" . $ld.'/php'.$rd;
			} else {
				return $match[0];
			}

		}

		return $source_content;
	}

	// We should reload the parent method in order to prevent using deprecated variables.

	function _compile_smarty_ref(&$indexes)
	{
		$_ref = substr($indexes[0], 1);

		// post, get and env variables are disabled
		if (in_array($_ref, array ('post', 'get', 'env'))) {
			$this->_syntax_error("access for \$smarty.$_ref variables is disabled, please use \$smarty.request", E_USER_WARNING, __FILE__, __LINE__);
		}

		// Access to request variable is provided via escaped one
		if ($_ref == 'request') {
	        array_shift($indexes);
	        return '$__tpl_vars[\'_REQUEST\']';
		}


		return parent::_compile_smarty_ref($indexes);
	}
}

/* vim: set expandtab: */

?>
