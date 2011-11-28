<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from top_menu.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>

<?php if ($__tpl_vars['top_menu']): ?>
<div id="top_menu">
<ul class="top-menu dropdown"><?php $_from_2382246574 = & $__tpl_vars['top_menu']; if (!is_array($_from_2382246574) && !is_object($_from_2382246574)) { settype($_from_2382246574, 'array'); }if (count($_from_2382246574)):
    foreach ($_from_2382246574 as $__tpl_vars['m']):
?><li class="first-level <?php if ($__tpl_vars['m']['selected'] == true): ?>cm-active<?php endif; ?>"><span><a <?php if ($__tpl_vars['m']['href']): ?>href="<?php echo $__tpl_vars['m']['href']; ?>"<?php endif; ?>><?php echo $__tpl_vars['m']['item']; ?></a></span><?php if ($__tpl_vars['m']['subitems']): ?><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top_menu.tpl", 'smarty_include_vars' => array('items' => $__tpl_vars['m']['subitems'],'top_menu' => "",'dir' => $__tpl_vars['m']['param_4'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?></li><?php endforeach; endif; unset($_from); ?></ul>

</div>
<span class="helper-block">&nbsp;</span>
<?php elseif ($__tpl_vars['items']): ?>
<ul <?php if ($__tpl_vars['dir'] == 'left'): ?>class="dropdown-vertical-rtl"<?php endif; ?>>
	<?php $this->assign('foreach_name', "cats_".($__tpl_vars['iter']), false); ?>
	<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }$this->_foreach[$__tpl_vars['foreach_name']] = array('total' => count($_from_67574462), 'iteration' => 0);
if ($this->_foreach[$__tpl_vars['foreach_name']]['total'] > 0):
    foreach ($_from_67574462 as $__tpl_vars['_m']):
        $this->_foreach[$__tpl_vars['foreach_name']]['iteration']++;
?>
	<li <?php if ($__tpl_vars['_m']['subitems']): ?>class="dir"<?php endif; ?>>
		<a href="<?php echo $__tpl_vars['_m']['href']; ?>
"><?php echo $__tpl_vars['_m']['item']; ?>
</a>
		<?php if ($__tpl_vars['_m']['subitems']): ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top_menu.tpl", 'smarty_include_vars' => array('items' => $__tpl_vars['_m']['subitems'],'top_menu' => "",'dir' => $__tpl_vars['_m']['param_4'],'iter' => $this->_foreach[$__tpl_vars['foreach_name']]['iteration']+$__tpl_vars['iter'])));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</li>
	<?php if (! ($this->_foreach[$__tpl_vars['foreach_name']]['iteration'] == $this->_foreach[$__tpl_vars['foreach_name']]['total'])): ?>
	<li class="h-sep">&nbsp;</li>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>