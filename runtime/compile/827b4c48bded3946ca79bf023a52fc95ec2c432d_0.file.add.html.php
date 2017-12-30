<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:16
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/request/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a61866f451_88062544',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '827b4c48bded3946ca79bf023a52fc95ec2c432d' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/request/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a61866f451_88062544 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>

<?php echo smarty_function_include_file(array('name'=>'public/header','title'=>'添加请求参数'),$_smarty_tpl);?>

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
        <form id="js_addRequestFieldForm" role="form" action="<?php echo url('field/add');?>
" method="post">
            <input type="hidden" class="form-control" name="field[id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
">
            <input type="hidden" class="form-control" name="field[parent_id]" value="0">
            <input type="hidden" class="form-control" name="field[api_id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
">
            <input type="hidden" class="form-control" name="field[method]" value="1">

            <div class="form-group">
                <label>参数别名</label>
                <input class="form-control ime-disabled" name="field[name]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" placeholder="必填，只能是数字和字母组合，且首位不能是数字" datatype="/[a-z|A-Z|0-9|\-|_|\.]$/" nullmsg="请输入接口名称">
            </div>

            <div class="form-group">
                <label>参数含义</label>
                <input class="form-control" name="field[title]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
" placeholder="必填" datatype="*" nullmsg="请输入接口名称">
            </div>

            <div class="form-group">
                <label>参数类型</label>
                <select class="form-control" name="field[type]">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, \app\field::get_type_list(), 'type', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['type']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == $_smarty_tpl->tpl_vars['k']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </select>
            </div>

            <div class="form-group">
                <label class="control-label">是否必传</label>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="field[is_required]" value="1" checked> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="field[is_required]" value="0"> 否
                    </label>

                </div>
            </div>

            <div class="form-group">
                <label>默认值</label>
                <input class="form-control" name="field[default_value]" value=<?php echo $_smarty_tpl->tpl_vars['field']->value['default_value'];?>
 placeholder="非必填">
            </div>

            <div class="form-group">
                <label>备注说明</label>
                <textarea class="form-control" name="field[intro]" rows="2" placeholder="非必填"><?php echo $_smarty_tpl->tpl_vars['field']->value['intro'];?>
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
>

    $(function(){

        //验证表单
        var requestFieldModal = $(window.parent.document).find('#js_addRequestFieldModal');
        $("#js_addRequestFieldForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                requestFieldModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {

                // 重新载入请求参数列表
                var apiId = "<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
";

                $('#js_addApiForm', parent.document).find(".panel-request").load("<?php echo url('field/load');?>
", {'method':1,'api_id':apiId});

                // 关闭父级模态框
                requestFieldModal.find(".js_close").trigger('click');
                requestFieldModal.find(".js_submit").text('提交').removeAttr("disabled");

            },
            error:function () {
                // iframe父级提交按钮激活
                requestFieldModal.find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

    });


<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
