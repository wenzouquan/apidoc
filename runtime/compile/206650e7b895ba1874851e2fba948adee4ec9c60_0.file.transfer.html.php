<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:56
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/transfer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a67c516717_26760568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '206650e7b895ba1874851e2fba948adee4ec9c60' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/transfer.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a67c516717_26760568 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目管理'),$_smarty_tpl);?>

<style>
    body {
        background-color: #ffffff;
    }
</style>
</head>

<body>

<div class="container">

    <!-- /.row -->
    <div class="row">
        <form id="js_transferProjectForm" role="form" action="<?php echo url('project/transfer','','','json');?>
" method="post">
            <input type="hidden" class="form-control" name="id" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
">

            <div class="alert alert-dismissable alert-warning">
                <i class="fa fa-fw fa-info-circle"></i>
                只能转让给项目成员，转让后与该项目不再有任何关系，如果要加入需要重新申请，请谨慎操作!
            </div>

            <div class="form-group">
                <label for="recipient-name" class="control-label">转让项目:</label>
                <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
" placeholder="必填" readonly>
            </div>

            <div class="form-group">
                <label for="recipient-name" class="control-label">登录密码:</label>
                <input type="text" class="form-control" name="password" value="" placeholder="重要操作，请输入登录密码" datatype="*" nullmsg="请输入登录密码!">
            </div>

            <div class="form-group">
                <label for="" class="control-label">转让给:</label>

                <select class="form-control" name="user_id" data-live-search="true">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['members']->value, 'member');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['member']->value) {
?>
                    <?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['member']->value['user_id']);
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
"><?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'name');?>
(<?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'email');?>
)</option>
                    <?php
}
} else {
?>

                    <option value="0">暂无成员</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </select>

            </div>

            <input type="hidden" id="js_submit" value="提交">

        </form>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#wrapper -->

<?php echo '<script'; ?>
>

    $(function(){

        //验证表单
        var projectModal = $(window.parent.document).find('#js_transferProjectModal');

        $("#js_transferProjectForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                projectModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {
                parent.location.reload();
            },
            error:function () {
                // iframe父级提交按钮激活
                projectModal.find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

    });


<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
