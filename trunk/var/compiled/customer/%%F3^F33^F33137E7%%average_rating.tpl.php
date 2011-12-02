<?php /* Smarty version 2.6.18, created on 2011-12-01 22:05:18
         compiled from addons/discussion/views/discussion/components/average_rating.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_discussion_rating', 'addons/discussion/views/discussion/components/average_rating.tpl', 1, false),array('modifier', 'fn_get_average_rating', 'addons/discussion/views/discussion/components/average_rating.tpl', 3, false),)), $this); ?>
<?php  ob_start();  ?>
<?php $this->assign('average_rating', fn_get_average_rating($__tpl_vars['object_id'], $__tpl_vars['object_type']), false); ?>

<?php if ($__tpl_vars['average_rating']): ?>
<?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('stars' => fn_get_discussion_rating($__tpl_vars['average_rating']), )); ?>

<p class="nowrap stars">
<?php unset($this->_sections['full_star']);
$this->_sections['full_star']['name'] = 'full_star';
$this->_sections['full_star']['loop'] = is_array($_loop=$__tpl_vars['stars']['full']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_star']['show'] = true;
$this->_sections['full_star']['max'] = $this->_sections['full_star']['loop'];
$this->_sections['full_star']['step'] = 1;
$this->_sections['full_star']['start'] = $this->_sections['full_star']['step'] > 0 ? 0 : $this->_sections['full_star']['loop']-1;
if ($this->_sections['full_star']['show']) {
    $this->_sections['full_star']['total'] = $this->_sections['full_star']['loop'];
    if ($this->_sections['full_star']['total'] == 0)
        $this->_sections['full_star']['show'] = false;
} else
    $this->_sections['full_star']['total'] = 0;
if ($this->_sections['full_star']['show']):

            for ($this->_sections['full_star']['index'] = $this->_sections['full_star']['start'], $this->_sections['full_star']['iteration'] = 1;
                 $this->_sections['full_star']['iteration'] <= $this->_sections['full_star']['total'];
                 $this->_sections['full_star']['index'] += $this->_sections['full_star']['step'], $this->_sections['full_star']['iteration']++):
$this->_sections['full_star']['rownum'] = $this->_sections['full_star']['iteration'];
$this->_sections['full_star']['index_prev'] = $this->_sections['full_star']['index'] - $this->_sections['full_star']['step'];
$this->_sections['full_star']['index_next'] = $this->_sections['full_star']['index'] + $this->_sections['full_star']['step'];
$this->_sections['full_star']['first']      = ($this->_sections['full_star']['iteration'] == 1);
$this->_sections['full_star']['last']       = ($this->_sections['full_star']['iteration'] == $this->_sections['full_star']['total']);
?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_full.gif" width="16" height="15" alt="*" /><?php endfor; endif; ?>
<?php if ($__tpl_vars['stars']['part']): ?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_<?php echo $__tpl_vars['stars']['part']; ?>
.gif" width="16" height="15" alt="" /><?php endif; ?>
<?php unset($this->_sections['full_star']);
$this->_sections['full_star']['name'] = 'full_star';
$this->_sections['full_star']['loop'] = is_array($_loop=$__tpl_vars['stars']['empty']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_star']['show'] = true;
$this->_sections['full_star']['max'] = $this->_sections['full_star']['loop'];
$this->_sections['full_star']['step'] = 1;
$this->_sections['full_star']['start'] = $this->_sections['full_star']['step'] > 0 ? 0 : $this->_sections['full_star']['loop']-1;
if ($this->_sections['full_star']['show']) {
    $this->_sections['full_star']['total'] = $this->_sections['full_star']['loop'];
    if ($this->_sections['full_star']['total'] == 0)
        $this->_sections['full_star']['show'] = false;
} else
    $this->_sections['full_star']['total'] = 0;
if ($this->_sections['full_star']['show']):

            for ($this->_sections['full_star']['index'] = $this->_sections['full_star']['start'], $this->_sections['full_star']['iteration'] = 1;
                 $this->_sections['full_star']['iteration'] <= $this->_sections['full_star']['total'];
                 $this->_sections['full_star']['index'] += $this->_sections['full_star']['step'], $this->_sections['full_star']['iteration']++):
$this->_sections['full_star']['rownum'] = $this->_sections['full_star']['iteration'];
$this->_sections['full_star']['index_prev'] = $this->_sections['full_star']['index'] - $this->_sections['full_star']['step'];
$this->_sections['full_star']['index_next'] = $this->_sections['full_star']['index'] + $this->_sections['full_star']['step'];
$this->_sections['full_star']['first']      = ($this->_sections['full_star']['iteration'] == 1);
$this->_sections['full_star']['last']       = ($this->_sections['full_star']['iteration'] == $this->_sections['full_star']['total']);
?><img src="<?php echo $__tpl_vars['images_dir']; ?>
/icons/star_empty.gif" width="16" height="15" alt="" /><?php endfor; endif; ?>
</p><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>
<?php  ob_end_flush();  ?>