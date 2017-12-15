<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:56
  from "/Users/dfrobot/winn/www/phprap/application/home/view/public/nav.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a67c02b599_43976732',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e16d7f2e4847e60d9f77f869b822e46b0a246b4' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/public/nav.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a67c02b599_43976732 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0);">
            <?php if ($_smarty_tpl->tpl_vars['project']->value) {?>当前项目:<?php echo $_smarty_tpl->tpl_vars['project']->value['title'];
} else {
echo get_config('name');
}?>
        </a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">

        <li class="dropdown">
            <a class="dropdown-toggle" href="<?php echo url('project/select');?>
">
                <i class="fa fa fa-random fa-fw"></i> 切换项目
            </a>
        </li>

        <!-- /.dropdown -->
        <li class="dropdown js_notifyDropdown">

            <?php echo smarty_function_include_file(array('name'=>"notify/load"),$_smarty_tpl);?>


            <!-- /.dropdown-alerts -->
        </li>

        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php echo \app\user::get_user_name();?>
  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo url('project/search');?>
"><i class="fa fa-search fa-fw"></i> 搜索项目</a>
                </li>

                <li><a href="#" data-toggle="modal" data-target="#js_settingProfileModal"><i class="fa fa-user fa-fw"></i> 个人设置</a>
                </li>
                <?php if (\app\user::is_admin()) {?>
                <li><a href="<?php echo url('admin');?>
"><i class="fa fa-gear fa-fw"></i> 管理中心</a>
                </li>
                <?php }?>
                <li><a target="_blank" href="http://www.phprap.com/doc/index.html"><i class="fa fa-file-text fa-fw"></i> 帮助文档</a>
                </li>
                <li class="divider"></li>
                <li><a class="js_logoutBtn" href="#"><i class="fa fa-sign-out fa-fw"></i> 退出登录</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <?php if ($_smarty_tpl->tpl_vars['sidebar']->value) {?>

    <?php echo smarty_function_include_file(array('name'=>"public/".((string)$_smarty_tpl->tpl_vars['sidebar']->value)),$_smarty_tpl);?>


    <?php }?>

    <!-- /.navbar-static-side -->
</nav><?php }
}
