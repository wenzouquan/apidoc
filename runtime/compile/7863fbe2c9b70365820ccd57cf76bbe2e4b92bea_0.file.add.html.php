<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:13
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/header/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6158091e4_55135651',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7863fbe2c9b70365820ccd57cf76bbe2e4b92bea' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/header/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6158091e4_55135651 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>

<?php echo smarty_function_include_file(array('name'=>'public/header','title'=>'添加header参数'),$_smarty_tpl);?>

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
        <form id="js_addHeaderFieldForm" role="form" action="<?php echo url('field/add');?>
" method="post">
            <input type="hidden" class="form-control" name="field[id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
">
            <input type="hidden" class="form-control" name="field[api_id]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
">
            <input type="hidden" class="form-control" name="field[parent_id]" value="0">
            <input type="hidden" class="form-control" name="field[method]" value="3">
            <input type="hidden" class="form-control" name="field[title]" value="header头">
            <input type="hidden" class="form-control" name="field[type]" value="string">
            <input type="hidden" class="form-control" name="field[is_required]" value="0">

            <div class="form-group">
                <label>字段键</label>
                <input class="form-control js_selectHeaderBtn" name="field[name]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" placeholder="必填" datatype="*">
            </div>

            <div class="form-group">
                <label>字段值</label>
                <input class="form-control" name="field[default_value]" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['default_value'];?>
" placeholder="必填" datatype="*">
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

        //选择header
        var selectMemberBtn = $('.js_selectHeaderBtn');
        var localArrayData = ['Accept', 'Accept-Charset', 'Accept-Encoding', 'Accept-Language', 'Accept-Ranges', 'Authorization', 'Cache-Control', 'Connection','Cookie','Content-Length','Content-Type','Referer','User-Agent'];

        selectMemberBtn.typeahead({
            source: localArrayData,
            items: 8, //显示8条
            delay: 100, //延迟时间

        });

        //验证表单
        var headerFieldModal = $(window.parent.document).find('#js_addHeaderFieldModal');
        $("#js_addHeaderFieldForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                headerFieldModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {

                // 重新载入header参数列表
                var apiId = "<?php echo $_smarty_tpl->tpl_vars['field']->value['api_id'];?>
";
                $('#js_addApiForm', parent.document).find(".panel-header").load("<?php echo url('field/load');?>
", {'method':3,'api_id':apiId});

                // 关闭父级模态框
                headerFieldModal.find(".js_close").trigger('click');
                headerFieldModal.find(".js_submit").text('提交').removeAttr("disabled");

            },
            error:function () {
                // iframe父级提交按钮激活
                headerFieldModal.find(".js_submit").text('重新提交').removeAttr("disabled");

            }
        });

    });

<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
