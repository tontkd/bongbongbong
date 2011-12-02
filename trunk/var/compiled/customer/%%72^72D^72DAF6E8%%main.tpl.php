<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:16
         compiled from main.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'main.tpl', 7, false),array('modifier', 'sizeof', 'main.tpl', 43, false),array('modifier', 'unescape', 'main.tpl', 51, false),array('block', 'hook', 'main.tpl', 12, false),)), $this); ?>
	
<?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['location_dir'])."/top.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['top'] = ob_get_contents(); ob_end_clean();
 ?>
<?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['location_dir'])."/left.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['left'] = ob_get_contents(); ob_end_clean();
 ?>
<?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['location_dir'])."/right.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['right'] = ob_get_contents(); ob_end_clean();
 ?>
<?php ob_start();
$_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['location_dir'])."/bottom.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$__tpl_vars['bottom'] = ob_get_contents(); ob_end_clean();
 ?>
<?php if (@CONTROLLER == 'checkout' && @MODE == 'checkout' && trim($__tpl_vars['right']) && $__tpl_vars['settings']['General']['one_page_checkout'] == 'Y'): ?>
	<?php ob_start(); ?><?php echo $__tpl_vars['right']; ?>
<?php $this->_smarty_vars['capture']['checkout_column'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $this->assign('right', "", false); ?>
<?php endif; ?>
<div id="container" class="container<?php if (! trim($__tpl_vars['left']) && ! trim($__tpl_vars['right'])): ?>-long<?php elseif (! trim($__tpl_vars['left'])): ?>-left<?php elseif (! trim($__tpl_vars['right'])): ?>-right<?php endif; ?>">
	<?php $this->_tag_stack[] = array('hook', array('name' => "index:main_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div id="header"><?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	<?php if ($__tpl_vars['addons']['google_analytics']['status'] == 'A'): ?><?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	jQuery.getScript(gaJsHost + \'google-analytics.com/ga.js\', function() {
		var pageTracker = _gat._getTracker("'; ?>
<?php echo $__tpl_vars['addons']['google_analytics']['tracking_code']; ?>
<?php echo '");
		pageTracker._initData();
		pageTracker._trackPageview();
	});
});
//]]>
</script>
'; ?>
<?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
	<div id="content">
		<div class="content-helper clear">
			<?php if (trim($__tpl_vars['top'])): ?>
			<div class="header">
				<?php echo $__tpl_vars['top']; ?>

			</div>
			<?php endif; ?>
			
			<div class="central-column">
				<div class="central-content">
					<?php $__parent_tpl_vars = $__tpl_vars; ?>

<?php if ($__tpl_vars['breadcrumbs'] && sizeof($__tpl_vars['breadcrumbs']) > 1): ?>
	<div class="breadcrumbs">
		<?php $_from_1561183700 = & $__tpl_vars['breadcrumbs']; if (!is_array($_from_1561183700) && !is_object($_from_1561183700)) { settype($_from_1561183700, 'array'); }$this->_foreach['bcn'] = array('total' => count($_from_1561183700), 'iteration' => 0);
if ($this->_foreach['bcn']['total'] > 0):
    foreach ($_from_1561183700 as $__tpl_vars['key'] => $__tpl_vars['bc']):
        $this->_foreach['bcn']['iteration']++;
?><?php if ($__tpl_vars['key'] != '0'): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>/icons/breadcrumbs_arrow.gif" class="bc-arrow" border="0" alt="&gt;" /><?php endif; ?><?php if ($__tpl_vars['bc']['link']): ?><a href="<?php echo $__tpl_vars['bc']['link']; ?>"<?php if ($__tpl_vars['additional_class']): ?> class="<?php echo $__tpl_vars['additional_class']; ?>"<?php endif; ?>><?php echo smarty_modifier_unescape($__tpl_vars['bc']['title']); ?></a><?php else: ?><?php echo smarty_modifier_unescape($__tpl_vars['bc']['title']); ?><?php endif; ?><?php endforeach; endif; unset($_from); ?>

	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($__tpl_vars['location_dir'])."/central.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
		
			<?php if (trim($__tpl_vars['left'])): ?>
			<div class="left-column">
				<?php echo $__tpl_vars['left']; ?>

			</div>
			<?php endif; ?>
			
			<?php if (trim($__tpl_vars['right'])): ?>
			<div class="right-column">
				<?php echo $__tpl_vars['right']; ?>

			</div>
			<?php endif; ?>
		</div>
	</div>
	
	<div id="footer">
		<div class="footer-helper-container">
			<?php if (trim($__tpl_vars['bottom'])): ?>
			<div>
				<?php echo $__tpl_vars['bottom']; ?>

			</div>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $__tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$__tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
</div>