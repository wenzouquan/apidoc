<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:40
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/response/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6304d4684_96652724',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15dd90f8fd08f7bbd3479a722cfc62aab8dd4f6d' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/response/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6304d4684_96652724 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>

<?php echo smarty_function_include_file(array('name'=>'public/header','title'=>'添加响应参数'),$_smarty_tpl);?>

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
        <form id="js_addResponseFieldForm" role="form" action="<?php echo url('field/add');?>
" method="post">
            <input type="hidden" class="form-control" name="field[id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
">
            <input type="hidden" class="form-control" name="field[api_id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
">
            <input type="hidden" class="form-control" name="field[parent_id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['parent_id'];?>
">
            <input type="hidden" class="form-control" name="field[method]" value="2">
            <input type="hidden" class="form-control" name="field[is_required]" value="0">

            <div class="form-group">
                <label>参数别名</label>
                <input class="form-control" name="field[name]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
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
"  <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == $_smarty_tpl->tpl_vars['k']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </select>
            </div>

            <div class="form-group">
                <label>MOCK规则
                    <a target="_blank" href="https://github.com/gouguoyin/phprap/wiki/Mock" data-toggle="tooltip" data-placement="right" title="" class="btn-show-tips" data-original-title="点击查看MOCK语法">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </label>
                <input class="form-control js_selectMockRuleBtn" name="field[mock]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['mock'];?>
" placeholder="非必填，如果要使用mock服务，必须填写" datatype="*" ignore="ignore">
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
 src="<?php echo STATIC_URL;?>
/plugins/bootstrap/js/bootstrap3-typeahead.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

    $(function(){

        $('[data-toggle="tooltip"]').tooltip();

        //选择mock规则
        var selectMemberBtn = $('.js_selectMockRuleBtn');
        var localArrayData = <?php echo $_smarty_tpl->tpl_vars['methods']->value;?>
;

        selectMemberBtn.typeahead({
            source: localArrayData,
            items: 8, //显示8条
            delay: 100, //延迟时间

        });

        //验证表单
        var responseFieldModal = $(window.parent.document).find('#js_addResponseFieldModal');

        //验证表单
        $("#js_addResponseFieldForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                responseFieldModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {

                // 重新载入响应参数列表
                var apiId = "<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
";
                $('#js_addApiForm', parent.document).find(".panel-response").load("<?php echo url('field/load');?>
", {'method':2,'api_id':apiId});
                // 重新载入响应示例json
                $('#js_addApiForm', parent.document).find(".panel-json").load("<?php echo url('field/json');?>
", {'api_id':apiId}, function () {
                    // 格式化json
                    window.parent.jsonFormat();
                    // 吐司提示
                    //$(window.parent.document).contents().find('[data-toggle="tooltip"]').tooltip();
                });
                // 关闭父级模态框
                responseFieldModal.find(".js_close").trigger('click');
                responseFieldModal.find(".js_submit").text('提交').removeAttr("disabled");

            },
            error:function () {
                // iframe父级提交按钮激活
                responseFieldModal.find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

    });

<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
