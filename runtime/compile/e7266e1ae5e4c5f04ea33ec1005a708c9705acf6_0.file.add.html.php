<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:19
  from "/Users/dfrobot/winn/www/phprap/application/home/view/api/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a657658534_95675802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7266e1ae5e4c5f04ea33ec1005a708c9705acf6' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/api/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a657658534_95675802 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>

<?php echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目管理'),$_smarty_tpl);?>

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
        <form id="js_addApiForm" role="form" action="<?php echo url('api/add');?>
" method="post">
            <input type="hidden" class="form-control" name="api[id]" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
">
            <input type="hidden" class="form-control" name="api[module_id]" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
">

            <div class="form-group">
                <label>所属模块</label>
                <input class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
" placeholder="必填" disabled>
            </div>

            <div class="form-group">
                <label>接口名称</label>
                <input class="form-control" name="api[title]" value="" placeholder="必填" datatype="*" nullmsg="请输入接口名称">
            </div>

            <div class="form-group">
                <label class="control-label">请求类型</label>
                <div class="form-group">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, \app\api::get_method_list(), 'method', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['method']->value) {
?>
                    <label class="radio-inline">
                        <input type="radio" name="api[method]" value="<?php echo $_smarty_tpl->tpl_vars['method']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['method']->value == 'POST') {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['method']->value;?>

                    </label>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                </div>
            </div>

            <div class="form-group">
                <label>接口路径</label>
                <input class="form-control" name="api[uri]" placeholder="必填，不包含域名部分，rest参数请用{}，如/user/{id}" datatype="*2-250">
            </div>


            <div class="form-group">
                <label>接口描述</label>
                <textarea class="form-control" name="api[intro]" rows="2" placeholder="非必填"></textarea>
                <span class="Validform_checktip"></span>
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
        $("#js_addApiForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                $('#js_addApiForm', parent.document).find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {
                parent.location.reload();
//                parent.$('#js_addApiModal').modal('hide');

            },
            error:function () {
                // iframe父级提交按钮激活
                $('#js_addApiForm', parent.document).find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

        $('.js_addUrlBtn').on('click', function () {
            var inputObj = $(this).siblings('input');
            var url = inputObj.val();
            if(!url){
                inputObj.focus();
                alert('请输入合法的URL');
            }else{
                $(".input-group").after($(".input-group").clone());
            }

        });

    });


<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
