<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:17:59
  from "/Users/dfrobot/winn/www/phprap/application/install/view/public/nav.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a3393475add98_73465453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9099ac1edba8e2df7239b5452035a949060cadc9' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/install/view/public/nav.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3393475add98_73465453 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
<ul class="clearfix hidden-xs">

    <li <?php if ($_smarty_tpl->tpl_vars['step']->value == 1) {?>class="active"<?php }?>>
        <div class="pic"><i class="fa fa-key fa-3x panel-fa"></i></div>
        <div class="name">环境检测</div>
        <div class="txt"></div>
        <div class="num">1</div>
    </li>

    <li <?php if ($_smarty_tpl->tpl_vars['step']->value == 2) {?>class="active"<?php }?>>
        <div class="pic"><i class="fa fa-database fa-3x panel-fa"></i></div>
        <div class="name">数据库配置</div>
        <div class="txt"></div>
        <div class="num">2</div>
    </li>

    <li <?php if ($_smarty_tpl->tpl_vars['step']->value == 3) {?>class="active"<?php }?>>
        <div class="pic"><i class="fa fa-user fa-3x panel-fa"></i></div>
        <div class="name">管理员配置</div>
        <div class="txt"></div>
        <div class="num">3</div>
    </li>

    <li <?php if ($_smarty_tpl->tpl_vars['step']->value == 4) {?>class="active"<?php }?>>
        <div class="pic"><i class="fa fa-check fa-3x panel-fa"></i></div>
        <div class="name">安装完成</div>
        <div class="txt"></div>
        <div class="num">4</div>
    </li>

</ul>
</div>
<div class="line hidden-xs"></div><?php }
}
