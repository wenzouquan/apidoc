<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:31:33
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/home.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a4854ec0a1_37308015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '437e3d288e10738832133ec6107082f5e32a4688' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/home.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a4854ec0a1_37308015 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目主页'),$_smarty_tpl);?>

<?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['project']->value['user_id']);
?>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'project_sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>项目主页 </h1>
                    <div class="opt-btn">
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable1=ob_get_clean();
if (\app\member::has_rule($_prefixVariable1,'project','update')) {?>
                        <a href="javascript:void(0);" class="btn hidden-xs btn-sm btn-success js_addProjectBtn" data-toggle="tooltip" title="编辑项目" data-placement="bottom" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"><i class="fa fa-fw fa-edit"></i>编辑</a>
                        <?php }?>

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable2=ob_get_clean();
if (\app\member::has_rule($_prefixVariable2,'project','export')) {?>
                        <a href="<?php echo url("project/export");?>
?id=<?php echo id_encode($_smarty_tpl->tpl_vars['project']->value['id']);?>
" class="btn hidden-xs btn-sm btn-warning" data-toggle="tooltip" title="导出HTML" data-placement="bottom"><i class="fa fa-fw fa-download"></i>导出</a>
                        <?php }?>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">

                    <?php echo smarty_function_include_file(array('name'=>'project/tab'),$_smarty_tpl);?>


                    <div class="panel-body">
                        <p class="text-muted"><label>项目名称：</label><?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
</p>
                        <p class="text-muted"><label>项目创建人：</label><?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'name');?>
(<?php echo _uri('user',$_smarty_tpl->tpl_vars['user_id']->value,'email');?>
）</p>
                        <p class="text-muted"><label>搜索状态：</label><?php if ($_smarty_tpl->tpl_vars['project']->value['allow_search']) {?>允许搜索<?php } else { ?>禁止搜索<?php }?></p>
                        <p class="text-muted"><label>创建时间：</label><?php echo $_smarty_tpl->tpl_vars['project']->value['add_time'];?>
</p>
                        <p class="text-muted"><label>更新时间：</label><?php echo $_smarty_tpl->tpl_vars['project']->value['update_time'];?>
</p>

                        <p class="text-muted"><label>项目描述：</label><span style="word-break:break-all"><?php echo $_smarty_tpl->tpl_vars['project']->value['intro'];?>
</span></p>
                        <p class="text-muted"><label>环境域名：</label>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>环境标识符</th>
                                    <th>标识符备注</th>
                                    <th>环境域名</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['envs']->value, 'env');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['env']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['env']->value['name'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['env']->value['title'];?>
</td>
                                    <td><code><?php echo $_smarty_tpl->tpl_vars['env']->value['domain'];?>
</code></td>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                </tbody>
                            </table>

                        </div>
                        </p>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->




</div>
<!-- /#wrapper -->
<!-- 编辑项目模态框 -->
<div class="modal fade" id="js_addProjectModal" tabindex="-9" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">编辑项目</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addProjectIframe" style="min-height: 375px;" src="<?php echo url('project/add');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_submit">提交</button>
            </div>

        </div>

    </div>

</div>

<hr>
<p class="text-center"><?php echo get_config('copyright');?>
</p>

<?php echo '<script'; ?>
>
    $(function(){

        // 编辑项目
        $(".js_addProjectBtn").iframeModal({
            modalItem: '#js_addProjectModal', //modal元素
            iframeItem: '#js_addProjectIframe', //iframe元素
            submitBtn: '.js_submit',
        });


    });
<?php echo '</script'; ?>
>



<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
