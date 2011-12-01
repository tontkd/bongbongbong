<?php /* Smarty version 2.6.18, created on 2011-11-30 23:22:19
         compiled from blocks/wrappers/mainbox_simple.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php  ob_start();  ?><?php if ($__tpl_vars['anchor']): ?>
<a name="<?php echo $__tpl_vars['anchor']; ?>
"></a>
<?php endif; ?>
<div class="mainbox2-container">
	<h1 class="mainbox2-title clear"><span><?php echo $__tpl_vars['title']; ?>
</span></h1>
	<div class="mainbox2-body"><?php echo $__tpl_vars['content']; ?>
</div>
	<div class="mainbox2-bottom"><span>&nbsp;</span></div>
</div><?php  ob_end_flush();  ?>