<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:03:38
  from "/Users/dfrobot/winn/www/phprap/application/admin/view/public/sidebar.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a339dfa7731e4_28115934',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9bfdcd2a304542e03576082bc0e34ded230560d6' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/admin/view/public/sidebar.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a339dfa7731e4_28115934 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php echo url("admin");?>
"><i class="fa fa-home fa-fw"></i> 管理主页</a>
            </li>

            <li>
                <a href="<?php echo url('admin/project');?>
"><i class="fa fa-folder-open fa-fw"></i> 项目管理</a>
            </li>
            <li>
                <a href="<?php echo url('admin/user');?>
"><i class="fa fa-user fa-fw"></i> 用户管理</a>
            </li>

            <li>
                <a href="<?php echo url('admin/history/login');?>
"><i class="fa fa-history fa-fw"></i> 登录历史</a>
            </li>

            <li>
                <a href="<?php echo url('admin//db/index');?>
"><i class="fa fa-database fa-fw"></i> 数据备份</a>
            </li>

            <li>
                <a href="<?php echo url('admin/setting');?>
"><i class="fa fa-gear fa-fw"></i> 系统设置</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div><?php }
}
