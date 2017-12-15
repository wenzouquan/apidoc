<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:13
  from "/Users/dfrobot/winn/www/phprap/application/home/view/api/edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6152d6763_30930042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93e12ee073bf591fc0cf70827cfc17b7614ae0d9' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/api/edit.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6152d6763_30930042 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
$_smarty_tpl->_assignInScope('api_id', $_smarty_tpl->tpl_vars['api']->value['id']);
?>
<form role="form" id="js_addApiForm" action="<?php echo url('api/add');?>
" method="post">

    <input name="api[id]" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['api_id']->value;?>
">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>接口编辑</h1>
                <div class="opt-btn">
                    <a class="btn btn-sm btn-success js_submit" href="javascript:void(0);"><i class="fa fa-fw fa-save"></i>保存</a>
                    <a class="btn btn-sm btn-warning" href="javascript:location.reload();"><i class="fa fa-fw fa-reply"></i>取消</a>

                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    接口详情
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                                <div class="form-group">
                                    <label>接口名称</label>
                                    <input class="form-control" name="api[title]" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['title'];?>
" placeholder="必填" datatype="*2-250" nullmsg="请输入网站名称！" errormsg="至少2个字符">
                                </div>

                                <div class="form-group">
                                    <label>所属分类</label>
                                    <select class="form-control" name="api[module_id]">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'module');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['module']->value['id'] == $_smarty_tpl->tpl_vars['api']->value['module_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
</option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                    </select>
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
" <?php if (strtoupper($_smarty_tpl->tpl_vars['method']->value) == $_smarty_tpl->tpl_vars['api']->value['method']) {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['method']->value;?>

                                        </label>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>接口路径

                                    </label>

                                    <input class="form-control" name="api[uri]" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['uri'];?>
" placeholder="必填，不包含域名部分，rest参数请用{}，如/user/{id}" datatype="/^(?!http://).*$/" nullmsg="请输入网站名称！" errormsg="至少2个字符">

                                </div>

                                <div class="form-group">
                                    <label>接口描述</label>
                                    <textarea class="form-control" name="api[intro]" rows="3" placeholder="非必填" ><?php echo $_smarty_tpl->tpl_vars['api']->value['intro'];?>
</textarea>
                                </div>

                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <!-- /.col-lg-6 (nested) -->
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Haader参数
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">

                        <div class="panel-header">
                            <?php echo smarty_function_include_file(array('name'=>'field/header/load'),$_smarty_tpl);?>

                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-default js_addHeaderFieldBtn" data-title="添加header参数" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-0"><i class="fa fa-fw fa-plus"></i>添加参数</button>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    请求参数
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">

                        <div class="panel-request">
                            <?php echo smarty_function_include_file(array('name'=>'field/request/load'),$_smarty_tpl);?>

                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-default js_addRequestFieldBtn" data-title="添加请求参数" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-0"><i class="fa fa-fw fa-plus"></i>添加参数</button>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    响应参数
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="panel-response">
                            <?php echo smarty_function_include_file(array('name'=>'field/response/load'),$_smarty_tpl);?>

                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-default js_addResponseFieldBtn" data-title="添加响应参数"  data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-0-0"><i class="fa fa-fw fa-plus"></i>添加参数</button>
                        </div>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>

    <!-- /.row -->
    <div class="panel-json">
        <?php echo smarty_function_include_file(array('name'=>'field/response/json'),$_smarty_tpl);?>

    </div>

</form>

<!-- 添加/编辑header字段模态框 -->
<div class="modal fade" id="js_addHeaderFieldModal" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加header参数</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addHeaderFieldIframe" style="min-height: 250px;" src="<?php echo url('field/header');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default js_close" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_headerSubmitBtn">提交</button>
            </div>

        </div>

    </div>

</div>
<!-- 添加/编辑请求字段模态框 -->
<div class="modal fade" id="js_addRequestFieldModal" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加请求参数</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addRequestFieldIframe" style="min-height: 450px;" src="<?php echo url('field/request');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default js_close" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_requestSubmitBtn">提交</button>
            </div>

        </div>

    </div>

</div>
<!-- 添加/编辑响应字段模态框 -->
<div class="modal fade" id="js_addResponseFieldModal" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加响应参数</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addResponseFieldIframe" style="min-height: 390px;" src="<?php echo url('field/response');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default js_close" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_responSubmitBtn">提交</button>
            </div>

        </div>

    </div>

</div>

<?php echo '<script'; ?>
>

    $(function(){

        //表单合法性验证
        $("#js_addApiForm").validateForm();

        // 添加/编辑header字段
        $(".js_addHeaderFieldBtn").iframeModal({
            modalItem: '#js_addHeaderFieldModal', //modal元素
            iframeItem: '#js_addHeaderFieldIframe', //提交按钮
            submitBtn: '.js_headerSubmitBtn',
            clickBtn: '.js_addHeaderFieldBtn',
        });

        // 添加/编辑请求字段
        $(".js_addRequestFieldBtn").iframeModal({
            modalItem: '#js_addRequestFieldModal', //modal元素
            iframeItem: '#js_addRequestFieldIframe', //提交按钮
            submitBtn: '.js_requestSubmitBtn',
            clickBtn: '.js_addRequestFieldBtn',
        });

        // 添加/编辑响应字段
        $(".js_addResponseFieldBtn").iframeModal({
            modalItem: '#js_addResponseFieldModal', //modal元素
            iframeItem: '#js_addResponseFieldIframe', //提交按钮
            submitBtn: '.js_responSubmitBtn',
            clickBtn: '.js_addResponseFieldBtn',
        });

        //删除字段
        $(document).delegate('.js_deleteFieldBtn', 'click',function(event){
            // 阻止事件冒泡
            event.stopPropagation();
            var thisObj = $(this);

            var id = $(this).data('id');

            var url = "<?php echo url('field/delete');?>
";

            confirm('确认删除该参数?', function(){

                $.post(url, { id:id }, function(json){

                    if(json.code == 200){

                        alert(json.msg, 500, function () {
                            //移除tr
                            thisObj.closest('tr').remove();
                        });

                    }else{

                        alert(json.msg, 2000);

                    }

                }, 'json');
            });

        });

    });

<?php echo '</script'; ?>
><?php }
}
