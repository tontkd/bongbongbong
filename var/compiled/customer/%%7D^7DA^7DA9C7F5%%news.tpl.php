<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from addons/news_and_emails/blocks/news.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'addons/news_and_emails/blocks/news.tpl', 8, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_all'));
?>
<?php  ob_start();  ?>
<?php if ($__tpl_vars['items']): ?>
<ul class="site-news">
<?php $_from_67574462 = & $__tpl_vars['items']; if (!is_array($_from_67574462) && !is_object($_from_67574462)) { settype($_from_67574462, 'array'); }$this->_foreach['site_news'] = array('total' => count($_from_67574462), 'iteration' => 0);
if ($this->_foreach['site_news']['total'] > 0):
    foreach ($_from_67574462 as $__tpl_vars['news']):
        $this->_foreach['site_news']['iteration']++;
?>
	<li>
		<strong><?php echo smarty_modifier_date_format($__tpl_vars['news']['date'], $__tpl_vars['settings']['Appearance']['date_format']); ?>
</strong>
		<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=news.view&amp;news_id=<?php echo $__tpl_vars['news']['news_id']; ?>
#<?php echo $__tpl_vars['news']['news_id']; ?>
"><?php echo $__tpl_vars['news']['news']; ?>
</a>
	</li>
	<?php if (! ($this->_foreach['site_news']['iteration'] == $this->_foreach['site_news']['total'])): ?>
	<li class="delim"></li>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>

<p class="right">
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=news.list" class="extra-link"><?php echo fn_get_lang_var('view_all', $this->getLanguage()); ?>
</a>
</p>
<?php endif; ?>
<?php  ob_end_flush();  ?>