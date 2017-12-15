<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:31:33
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/tab.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a4856e65a3_69033491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4138b31087202a6fef0eacbd821fa77bbdd5f460' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/tab.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a4856e65a3_69033491 (Smarty_Internal_Template $_smarty_tpl) {
?>

<ul class="nav nav-tabs">
    <li class="<?php if ($_smarty_tpl->tpl_vars['tab']->value == 'home') {?>active<?php }?>"><a href="<?php echo url();?>
?tab=home">项目主页</a></li>
    <li class="<?php if ($_smarty_tpl->tpl_vars['tab']->value == 'member') {?>active<?php }?>"><a href="<?php echo url();?>
?tab=member">项目成员</a></li>
    <li class="<?php if ($_smarty_tpl->tpl_vars['tab']->value == 'map') {?>active<?php }?>"><a href="<?php echo url();?>
?tab=map">数据字典</a></li>
    <li class="hidden-xs <?php if ($_smarty_tpl->tpl_vars['tab']->value == 'history') {?>active<?php }?>"><a href="<?php echo url();?>
?tab=history">项目动态</a></li>
</ul><?php }
}
