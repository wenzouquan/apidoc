<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:03:38
  from "/Users/dfrobot/winn/www/phprap/application/admin/view/project/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a339dfa6562b6_43482131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '079fcc524205617c4e282c4938d2e7f1c8864951' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/admin/view/project/index.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a339dfa6562b6_43482131 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
if (!is_callable('smarty_modifier_truncate')) require_once '/Users/dfrobot/winn/www/phprap/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目管理'),$_smarty_tpl);?>


</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">项目管理</h1>
                <div class="search">
                    <div class="well">
                        <form class="form-inline" action="<?php echo url();?>
" method="get">
                            <div class="form-group">
                                <label>项目名</label>
                                <input name="search[project]" type="text" class="form-control" placeholder="支持模糊查询" value="<?php echo $_smarty_tpl->tpl_vars['search']->value['project'];?>
">
                            </div>

                            <div class="form-group">
                                <label>创建人</label>
                                <input name="search[user]" type="text" class="form-control" placeholder="支持模糊查询" value="<?php echo $_smarty_tpl->tpl_vars['search']->value['user'];?>
">
                            </div>

                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>项目名称</th>
                                    <th>创建人/创建人账号</th>
                                    <th>成员数</th>
                                    <th>模块数</th>
                                    <th>接口数</th>
                                    <th>创建时间</th>
                                    <th>操作面板</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($_smarty_tpl->tpl_vars['projects']->value) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projects']->value, 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
                                <?php $_smarty_tpl->_assignInScope('project_id', $_smarty_tpl->tpl_vars['project']->value['id']);
?>
                                <?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['project']->value['user_id']);
?>
                                <tr>
                                    <td ><a target="_blank" href="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['project_id']->value);
$_prefixVariable1=ob_get_clean();
echo url("project/".$_prefixVariable1);?>
" title="<?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['project']->value['title'],12);?>
</a></td>
                                    <td ><?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'name');?>
<br/><?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'email');?>
</td>
                                    <td ><a href="<?php echo url("admin/user");?>
?project_id=<?php echo $_smarty_tpl->tpl_vars['project_id']->value;?>
"><?php echo \app\project::get_member_num($_smarty_tpl->tpl_vars['project_id']->value);?>
</a></td>
                                    <td ><?php echo \app\project::get_module_num($_smarty_tpl->tpl_vars['project_id']->value);?>
</td>
                                    <td ><?php echo \app\project::get_api_num($_smarty_tpl->tpl_vars['project_id']->value);?>
</td>
                                    <td ><?php echo $_smarty_tpl->tpl_vars['project']->value['add_time'];?>
</td>
                                    <td style="width: 15%">
                                        <button type="button" class="btn btn-warning btn-xs js_transferProjectBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['project_id']->value;?>
">转让</button>
                                        <button type="button" class="btn btn-danger btn-xs js_deleteProjectBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['project_id']->value;?>
">删除</button>
                                        <a class="btn btn-success btn-xs js_viewProjectBtn" target="_blank" href="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['project_id']->value);
$_prefixVariable2=ob_get_clean();
echo url("project/".$_prefixVariable2);?>
">查看</a>
                                    </td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                <?php }?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-sm-12">
                <?php echo smarty_function_include_file(array('name'=>'public/page'),$_smarty_tpl);?>

            </div>

            <!-- /.col-lg-6 -->
        </div>
        <!-- /#page-wrapper -->

        <!-- 删除项目模态框 -->
        <div class="modal fade" id="js_deleteProjectModal" tabindex="2" role="dialog">
            <div class="modal-dialog" role="document">
                <form role="form" action="<?php echo url('project/delete','','','json');?>
" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">确定删除此项目吗？</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-dismissable alert-warning">
                                <i class="fa fa-fw fa-info-circle"></i>&nbsp;
                                项目删除后，该项目下所有版本将被立刻删除，不可恢复，请谨慎操作！
                            </div>
                            <div class="form-group">
                                <input name="id" type="hidden" class="form-control">
                                <input name="password" type="text" class="form-control" placeholder="重要操作，请输入登录密码" datatype="s5-50" nullmsg="请输入登录密码!" errormsg="请输入正确的登录密码!">
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

        <!-- 转让项目模态框 -->
        <div class="modal fade" id="js_transferProjectModal" tabindex="-9" role="dialog">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">转让项目</h4>
                    </div>
                    <div class="modal-body">

                        <iframe id="js_transferProjectIframe" style="min-height: 320px;" src="<?php echo url('project/transfer');?>
"></iframe>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary js_submit">提交</button>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- /#wrapper -->

    <hr>
    <p class="text-center"><?php echo get_config('copyright');?>
</p>

    <?php echo '<script'; ?>
>
        $(function(){

            //删除项目表单合法性验证
            $("#js_deleteProjectModal form").validateForm();

            //删除项目
            $('.js_deleteProjectBtn').click(function(event){
                // 阻止事件冒泡
                event.stopPropagation();

                var id = $(this).data('id');

                if(id <= 0){

                    alert('请选择要删除的项目!', 1000);

                }

                $('#js_deleteProjectModal input[name=id]').val(id);
                $('#js_deleteProjectModal').modal('show');

            });

            // 转让项目
            $(".js_transferProjectBtn").iframeModal({
                modalItem: '#js_transferProjectModal', //modal元素
                iframeItem: '#js_transferProjectIframe', //iframe元素
                submitBtn: '.js_submit',
            });

        });
    <?php echo '</script'; ?>
>

    <?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
