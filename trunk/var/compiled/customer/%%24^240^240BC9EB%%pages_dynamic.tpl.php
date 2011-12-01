<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:18
         compiled from blocks/pages_dynamic.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'blocks/pages_dynamic.tpl', 17, false),array('modifier', 'substr_count', 'blocks/pages_dynamic.tpl', 19, false),)), $this); ?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['items']): ?>
<ul class="tree-list">
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('tree' => $__tpl_vars['items'], 'root' => true, )); ?>
<?php if (! $__tpl_vars['root']): ?>

<?php $this->assign('not_root', '_', false); ?>
<?php endif; ?>

<?php $_from_2202693330 = & $__tpl_vars['tree']; if (!is_array($_from_2202693330) && !is_object($_from_2202693330)) { settype($_from_2202693330, 'array'); }$this->_foreach["fe".($__tpl_vars['not_root'])] = array('total' => count($_from_2202693330), 'iteration' => 0);
if ($this->_foreach["fe".($__tpl_vars['not_root'])]['total'] > 0):
    foreach ($_from_2202693330 as $__tpl_vars['key'] => $__tpl_vars['page']):
        $this->_foreach["fe".($__tpl_vars['not_root'])]['iteration']++;
?>
	<?php if ($__tpl_vars['page']['page_id'] == $__tpl_vars['_REQUEST']['page_id']): ?><?php $this->assign('path', $__tpl_vars['page']['id_path'], false); ?><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from_2202693330 = & $__tpl_vars['tree']; if (!is_array($_from_2202693330) && !is_object($_from_2202693330)) { settype($_from_2202693330, 'array'); }$this->_foreach["fe".($__tpl_vars['not_root'])] = array('total' => count($_from_2202693330), 'iteration' => 0);
if ($this->_foreach["fe".($__tpl_vars['not_root'])]['total'] > 0):
    foreach ($_from_2202693330 as $__tpl_vars['key'] => $__tpl_vars['page']):
        $this->_foreach["fe".($__tpl_vars['not_root'])]['iteration']++;
?>
	<?php echo smarty_function_math(array('equation' => "x*7",'x' => $__tpl_vars['page']['level'],'assign' => 'shift'), $this);?>

	
	<li class="<?php if ($__tpl_vars['page']['has_children'] && substr_count($__tpl_vars['path'], $__tpl_vars['page']['page_id'])): ?>cm-expanded<?php elseif ($__tpl_vars['page']['has_children']): ?>cm-collapsed<?php endif; ?>"><a href="<?php if ($__tpl_vars['page']['page_type'] == @PAGE_TYPE_LINK): ?><?php echo $__tpl_vars['page']['link']; ?>
<?php else: ?><?php echo $__tpl_vars['index_script']; ?>
?dispatch=pages.view&amp;page_id=<?php echo $__tpl_vars['page']['page_id']; ?>
<?php endif; ?>"<?php if ($__tpl_vars['page']['new_window']): ?> target="_blank"<?php endif; ?><?php if ($__tpl_vars['page']['level'] != '0'): ?> style="padding-left: <?php echo $__tpl_vars['shift']; ?>
px;"<?php endif; ?>><?php echo $__tpl_vars['page']['page']; ?>
</a>
</li>
<?php if ($__tpl_vars['root'] && ! ($this->_foreach['fe']['iteration'] == $this->_foreach['fe']['total']) && ! $__tpl_vars['no_delim']): ?><li class="delim"></li><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</ul>
<?php endif; ?>
<?php  ob_end_flush();  ?>