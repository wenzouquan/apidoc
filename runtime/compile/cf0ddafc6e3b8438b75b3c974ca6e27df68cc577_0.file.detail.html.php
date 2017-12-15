<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:19
  from "/Users/dfrobot/winn/www/phprap/application/home/view/api/detail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6570cbce7_49989803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf0ddafc6e3b8438b75b3c974ca6e27df68cc577' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/api/detail.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6570cbce7_49989803 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'接口详情'),$_smarty_tpl);?>

<link href="<?php echo STATIC_URL;?>
/plugins/jsonFormat/css.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'project_sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">


        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>接口主页 </h1>
                    <div class="opt-btn">

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable1=ob_get_clean();
if (\app\member::has_rule($_prefixVariable1,'api','update')) {?>
                        <a href="javascript:void(0);" class="btn btn-sm btn-success js_editApiBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
"><i class="fa fa-fw fa-edit"></i>编辑</a>
                        <?php }?>

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable2=ob_get_clean();
if (\app\member::has_rule($_prefixVariable2,'api','delete')) {?>
                        <a href="javascript:void(0);" class="btn btn-sm btn-danger js_deleteApiBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
"><i class="fa fa-fw fa-times"></i>删除</a>
                        <?php }?>


                        <a target="_blank" href="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['api']->value['id']);
$_prefixVariable3=ob_get_clean();
echo url("debug/".$_prefixVariable3);?>
" class="btn btn-sm btn-warning js_debugApiBtn"><i class="fa fa-fw fa-wrench"></i>调试</a>

                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        接口详情
                    </div>
                    <div class="panel-body">
                        <p class="text-muted"><label>接口名称：</label><?php echo $_smarty_tpl->tpl_vars['api']->value['title'];?>
</p>
                        <p class="text-muted"><label>所属模块：</label><?php echo $_smarty_tpl->tpl_vars['api']->value['module']['title'];?>
</p>
                        <p class="text-muted"><label>请求类型：</label><?php echo $_smarty_tpl->tpl_vars['api']->value['method'];?>
</p>
                        <p class="text-muted"><label>接口描述：</label><?php echo $_smarty_tpl->tpl_vars['api']->value['intro'];?>
</p>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        接口地址
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">

                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['envs']->value, 'env');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['env']->value) {
?>
                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['env']->value['domain'];
$_prefixVariable4=ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['api']->value['uri'];
$_prefixVariable5=ob_get_clean();
$_smarty_tpl->_assignInScope('env_url', (($_prefixVariable4).('/')).($_prefixVariable5));
?>
                                <tr>
                                    <td style="width: 20%;"><?php echo $_smarty_tpl->tpl_vars['env']->value['title'];?>
(<?php echo $_smarty_tpl->tpl_vars['env']->value['name'];?>
)</td>
                                    <td style="width: 50%;"><code><?php echo $_smarty_tpl->tpl_vars['env_url']->value;?>
</code></td>
                                    <td style="width: 15%;">
                                        <button type="button" data-clipboard-text="<?php echo $_smarty_tpl->tpl_vars['env_url']->value;?>
" class="btn btn-xs btn-success js_copyUrl"><i class="fa fa-fw fa-copy"></i>复制链接</button>
                                    </td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                <tr>
                                    <td style="width: 20%;">模拟环境(mock)</td>
                                    <td style="width: 50%;"><code><?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['api']->value['id']);
$_prefixVariable6=ob_get_clean();
echo url("mock/".$_prefixVariable6,'',true);?>
</code></td>
                                    <td style="width: 15%;">
                                        <button type="button" data-clipboard-text="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['api']->value['id']);
$_prefixVariable7=ob_get_clean();
echo url("mock/".$_prefixVariable7,'',true);?>
" class="btn btn-xs btn-success js_copyUrl"><i class="fa fa-fw fa-copy"></i>复制链接</button>
                                    </td>

                                </tr>

                                </tbody>
                            </table>

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
                        Header参数
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="success">
                                    <th>字段键</th>
                                    <th>字段值</th>
                                    <th>备注说明</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['header_fields']->value, 'header_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['header_field']->value) {
?>
                                <tr class="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['class'];?>
">
                                    <td><?php echo $_smarty_tpl->tpl_vars['header_field']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['header_field']->value['default_value'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['header_field']->value['intro'];?>
</td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                </tbody>
                            </table>
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
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="success">
                                    <th>字段别名</th>
                                    <th>字段含义</th>
                                    <th>字段类型</th>
                                    <th>是否必填</th>
                                    <th>默认值</th>
                                    <th>备注说明</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['request_fields']->value, 'request_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request_field']->value) {
?>
                                <tr class="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['class'];?>
">
                                    <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['delimiter'];
if ($_smarty_tpl->tpl_vars['request_field']->value['parent_id']) {?>--<?php }
echo $_smarty_tpl->tpl_vars['request_field']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['title'];?>
</td>
                                    <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['request_field']->value['type'];
$_prefixVariable8=ob_get_clean();
echo \app\field::get_type_list($_prefixVariable8);?>
</td>
                                    <td><?php if ($_smarty_tpl->tpl_vars['request_field']->value['is_required']) {?>是<?php } else { ?>否<?php }?></td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['default_value'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['intro'];?>
</td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                </tbody>
                            </table>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        响应参数
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="success">
                                    <th>字段别名</th>
                                    <th>字段含义</th>
                                    <th>字段类型</th>
                                    <th>MOCK规则</th>
                                    <th>备注说明</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['response_fields']->value, 'response_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['response_field']->value) {
?>
                                <tr class="<?php if ($_smarty_tpl->tpl_vars['response_field']->value['level'] == 1) {?>warning<?php }?>">
                                    <td style="text-align: left;padding-left: 50px;"><?php echo $_smarty_tpl->tpl_vars['response_field']->value['delimiter'];
if ($_smarty_tpl->tpl_vars['response_field']->value['parent_id']) {?>└<?php }
echo $_smarty_tpl->tpl_vars['response_field']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['title'];?>
</td>
                                    <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['response_field']->value['type'];
$_prefixVariable9=ob_get_clean();
echo \app\field::get_type_list($_prefixVariable9);?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['mock'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['intro'];?>
</td>
                                </tr>

                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                </tbody>
                            </table>
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

    </div>
    <!-- /#page-wrapper -->
    <hr>
    <p class="text-center"><?php echo get_config('copyright');?>
</p>
    <!-- 删除接口模态框 -->
    <div class="modal fade" id="js_deleteApiModal" tabindex="2" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="js_deleteApiForm" role="form" action="<?php echo url('api/delete','','','json');?>
" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">确定删除此接口吗？</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-dismissable alert-warning">
                            <i class="fa fa-fw fa-info-circle"></i>
                            接口删除后，该项目下所有字段将被立刻删除，不可恢复，请谨慎操作！
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control">
                            <input type="text" name='password' class="form-control" placeholder="重要操作，请输入登录密码" datatype="*" nullmsg="请输入登录密码!" errormsg="请输入正确的登录密码!">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-danger js_submit">删除</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- /#wrapper -->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo STATIC_URL;?>
/plugins/clipboard/clipboard.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $(function () {

        //删除接口表单合法性验证
        $("#js_deleteApiForm").validateForm({
            success:function () {
                window.location.href = "<?php echo url("project/".((string)$_smarty_tpl->tpl_vars['project']->value['encode_id']));?>
";
                //parent.location.reload();
            },
        });

        // 删除接口
        $(document).delegate('.js_deleteApiBtn', 'click',function(){
            var id = $(this).data('id');

            if(id <= 0){
                alert('请选择要删除的模块', 1000);
            }

            $('#js_deleteApiModal input[name=id]').val(id);

            $('#js_deleteApiModal').modal('show');
        });

        // 修改接口
        $(document).delegate('.js_editApiBtn', 'click',function(){
            var id = $(this).data('id');
            $('#page-wrapper').load("<?php echo url('api/edit');?>
", {'id':id});
        });

        // 复制链接
        var clipboard = new Clipboard('.js_copyUrl');
        clipboard.on('success', function(e) {
            alert('地址复制成功', 1000);
            e.clearSelection();
        });
        clipboard.on('error', function() {
            alert('地址复制失败，请手动复制', 3000);
        });

        //刷新数据
        $(document).delegate('.js_refreshField', 'click',function(event){
            // 阻止事件冒泡
            event.stopPropagation();

            var thisObj = $(this);

            var id = thisObj.data('id');

            var url = "<?php echo url('field/refresh');?>
";

            thisObj.attr("disabled", "disabled");

            setTimeout(function () {
                $.post(url, { api_id:id }, function(json){

                    if(json.code == 200){

                        thisObj.attr("disabled", "disabled");

                        $(".panel-json").load("<?php echo url('field/json');?>
", {'api_id':id});

                    }else{

                        alert(json.msg, 2000);

                    }

                }, 'json');
            }, 2000);

        });

    })
<?php echo '</script'; ?>
>
<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
