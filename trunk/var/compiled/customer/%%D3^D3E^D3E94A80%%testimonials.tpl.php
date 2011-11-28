<?php /* Smarty version 2.6.18, created on 2011-11-28 11:48:01
         compiled from addons/discussion/blocks/testimonials.tpl */ 
 $__tpl_vars = & $this->_tpl_vars;
 ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_discussion_rating', 'addons/discussion/blocks/testimonials.tpl', 1, false),array('modifier', 'fn_get_discussion', 'addons/discussion/blocks/testimonials.tpl', 5, false),array('modifier', 'fn_get_discussion_posts', 'addons/discussion/blocks/testimonials.tpl', 9, false),array('modifier', 'truncate', 'addons/discussion/blocks/testimonials.tpl', 15, false),array('modifier', 'nl2br', 'addons/discussion/blocks/testimonials.tpl', 15, false),array('modifier', 'date_format', 'addons/discussion/blocks/testimonials.tpl', 18, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('more_w_ellipsis'));
?>
<?php  ob_start();  ?>

<?php $this->assign('discussion', fn_get_discussion(0, 'E'), false); ?>

<?php if ($__tpl_vars['discussion'] && $__tpl_vars['discussion']['type'] != 'D'): ?>

<?php $this->assign('posts', fn_get_discussion_posts($__tpl_vars['discussion']['thread_id'], 0, $__tpl_vars['block']['properties']['limit']), false); ?>

<?php if ($__tpl_vars['posts']): ?>
<?php $_from_1575046092 = & $__tpl_vars['posts']; if (!is_array($_from_1575046092) && !is_object($_from_1575046092)) { settype($_from_1575046092, 'array'); }if (count($_from_1575046092)):
    foreach ($_from_1575046092 as $__tpl_vars['post']):
?>

<?php if ($__tpl_vars['discussion']['type'] == 'C' || $__tpl_vars['discussion']['type'] == 'B'): ?>
	<p class="post-message">"<?php echo smarty_modifier_nl2br(smarty_modifier_truncate($__tpl_vars['post']['message'], 100)); ?>
"</p>
<?php endif; ?>

<p class="post-author">&ndash; <?php echo $__tpl_vars['post']['name']; ?>
<?php if ($__tpl_vars['block']['properties']['positions'] != 'left' && $__tpl_vars['block']['properties']['positions'] != 'right'): ?>, <em><?php echo smarty_modifier_date_format($__tpl_vars['post']['timestamp'], ($__tpl_vars['settings']['Appearance']['date_format'])); ?>
</em><?php endif; ?></p>

<?php if ($__tpl_vars['block']['properties']['positions'] != 'left' && $__tpl_vars['block']['properties']['positions'] != 'right'): ?>
<div class="clear">
	<div class="right"></div>
	<?php if ($__tpl_vars['discussion']['type'] == 'R' || $__tpl_vars['discussion']['type'] == 'B'): ?>
		<div class="right"><?php $__parent_tpl_vars = $__tpl_vars;$__tpl_vars = array_merge($__tpl_vars, array('stars' => fn_get_discussion_rating($__tpl_vars['post']['rating_value']), )); ?>

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
</p><?php if (isset($__parent_tpl_vars)) { $__tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>



<?php endforeach; endif; unset($_from); ?>

<div class="right">
	<a href="<?php echo $__tpl_vars['index_script']; ?>
?dispatch=discussion.view&amp;thread_id=<?php echo $__tpl_vars['discussion']['thread_id']; ?>
"><?php echo fn_get_lang_var('more_w_ellipsis', $this->getLanguage()); ?>
</a>
</div>
<?php endif; ?>

<?php endif; ?><?php  ob_end_flush();  ?>