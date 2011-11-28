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
// $Id: class.profiler.php 7502 2009-05-19 14:54:59Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

class Profiler {
	static public $checkpoints = array();
	static public $queries = array();

	static function checkpoint($name)
	{
		if (!defined('PROFILER')) {
			return false;
		}

		self::$checkpoints[$name] = array(
			'time' => self::microtime(),
			'memory' => memory_get_usage(),
			'included_files' => count(get_included_files()),
			'queries' => count(self::$queries)
		);
	}

	static function microtime()
	{
		list($usec, $sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}

	static function display()
	{
		if (!defined('PROFILER')) {
			return false;
		}

		$previous = array();
		$cummulative = array();

		$first = true;

		if (defined('PROFILER_SQL')) {
			$it = 0;
			echo '<ul style="list-style:none; border: 1px solid #cccccc; padding: 3px;">';
			foreach (self::$queries as $query) {
				$it++;
				echo '<li ' . ($it % 2 ? 'style="background-color: #eeeeee;">' : '>') . $query . '</li>';
			}
			echo '</ul>';
		}

		foreach (self::$checkpoints as $name => $c) {
			echo '<br /><b>' . $name . '</b><br />';
			if ($first == false) {
				echo '- Memory: ' . (number_format($c['memory'] - $previous['memory'])) . ' (' . number_format($c['memory']) . ')' . '<br />';
				echo '- Files: ' . ($c['included_files'] - $previous['included_files']) . ' (' . $c['included_files'] . ')' . '<br />';
				echo '- Queries: ' . ($c['queries'] - $previous['queries']) . ' (' . $c['queries'] . ')' . '<br />';
				echo '- Time: ' . sprintf("%01.4f", $c['time'] - $previous['time']) . ' (' . sprintf("%01.4f", $c['time'] - $cummulative['time']) . ')' . '<br />';
			} else {
				echo '- Memory: ' . number_format($c['memory']) . '<br />';
				echo '- Files: ' . $c['included_files'] . '<br />';
				echo '- Queries: ' . $c['queries'] .  '<br />';

				$first = false;
				$cummulative = $c;
			}
			$previous = $c;
		}
	}

	static function set_query($query)
	{
		if (!defined('PROFILER')) {
			return false;
		}

		self::$queries[] = $query;
	}
}

?>
