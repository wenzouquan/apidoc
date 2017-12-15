<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:19
  from "/Users/dfrobot/winn/www/phprap/application/home/view/module/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6577e1492_74115426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dbb2d04dca82243cf270d93b411af0e760d5467a' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/module/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6577e1492_74115426 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目管理'),$_smarty_tpl);?>

<style>
    body {
        background-color: #ffffff;
    }
    .container {
        min-height: 200px;
    }
</style>
</head>

<body>

<div class="container">
    <!-- /.row -->
    <div class="row">
        <form id="js_addModuleForm" role="form" action="<?php echo url('module/add','','','json');?>
" method="post">
            <input type="hidden" class="form-control" name="project_id" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
">
            <input type="hidden" class="form-control" name="module_id" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
">

            <div class="form-group">
                <label for="recipient-name" class="control-label">模块名称:</label>
                <input type="text" class="form-control" name="title" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
" placeholder="必填，不大于8位" datatype="*1-8">
            </div>

            <div class="form-group">
                <label for="message-text" class="control-label">模块描述:</label>
                <textarea class="form-control" placeholder="必填" datatype="*1-250" name="intro"><?php echo $_smarty_tpl->tpl_vars['module']->value['intro'];?>
</textarea>
            </div>

            <input type="hidden" id="js_submit" value="提交">

        </form>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#wrapper -->

<?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/bootstrap/js/bootstrap3-typeahead.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

    $(function(){

        var moduleModal = $(window.parent.document).find('#js_addModuleModal');

        //验证表单
        $("#js_addModuleForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                moduleModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {
                parent.location.reload();
            },
            error:function () {
                // iframe父级提交按钮激活
                moduleModal.find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

    });


<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
