<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:35:06
  from "/Users/dfrobot/winn/www/phprap/application/home/view/public/debug_sidebar.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a55a152ee8_22719587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8e4347b9807be61c2b894ccc9330deaf5f5f7d7' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/public/debug_sidebar.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a55a152ee8_22719587 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>


    @media(min-width:768px) {

        .sidebar {
            z-index: 1;
            position: absolute;
            width: 200px;
            margin-top: 51px;
        }
        #page-wrapper {
            position: inherit;
            margin: 0 0 0 200px;
            padding: 0 30px;
            border-left: 1px solid #e7e7e7;
        }
    }

</style>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php echo url('project/search');?>
"><i class="fa fa-search fa-fw"></i> 搜索项目</a>
            </li>

            <li>
                <a href="<?php echo url('apply');?>
"><i class="fa fa-bell-o fa-fw"></i> 申请管理</a>
            </li>

<!--            <li>-->
<!--                <a href="<?php echo url('notice');?>
"><i class="fa fa-bell-o fa-fw"></i> 消息中心</a>-->
<!--            </li>-->

            <li>
                <a href="<?php echo url('history/login');?>
"><i class="fa fa-history fa-fw"></i> 登录历史</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div><?php }
}
