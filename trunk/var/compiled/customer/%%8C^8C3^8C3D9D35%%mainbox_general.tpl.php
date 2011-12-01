<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:20
         compiled from blocks/wrappers/mainbox_general.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php  ob_start();  ?><?php if ($__tpl_vars['anchor']): ?>
<a name="<?php echo $__tpl_vars['anchor']; ?>
"></a>
<?php endif; ?>
<div class="mainbox-container">
	<?php if ($__tpl_vars['title']): ?>
	<h1 class="mainbox-title"><span><?php echo $__tpl_vars['title']; ?>
</span></h1>
	<?php endif; ?>
	<div class="mainbox-body"><?php echo $__tpl_vars['content']; ?>
</div>
</div><?php  ob_end_flush();  ?>