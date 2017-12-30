<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:55
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/select.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a67beef462_07736034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fef9b97bb64511b14b44a0486625f52c3608ebfa' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/select.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a67beef462_07736034 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
if (!is_callable('smarty_modifier_truncate')) require_once '/Users/dfrobot/winn/www/phprap/vendor/smarty/smarty/libs/plugins/modifier.truncate.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'选择项目'),$_smarty_tpl);?>


<style>
    .panel-body {
        height: 80px;
        overflow: hidden;
    }

    .project-add,.project-search {
        height: 180px;
        overflow: hidden;
        text-align:center;
        line-height:140px;
        font-size: 36px;
    }

    .panel:hover  {
        background-color:#EFEFEF;
        cursor: pointer;
        solid;background:#fff;color:#333;
        filter:progid:DXImageTransform.Microsoft.Shadow(color=#909090,direction=120,strength=4);/*ie*/
        -moz-box-shadow: 2px 2px 10px #909090;/*firefox*/
        -webkit-box-shadow: 2px 2px 10px #909090;/*safari或chrome*/
        box-shadow:2px 2px 10px #909090;/*opera或ie9*/
    }
    .head-btn {
        float: right;
    }
    .head-btn a {
        text-decoration : none;
        margin: 0 0 0 10px;
    }

    #page-wrapper {
        position: inherit;
        margin: 0;
        padding: 0 30px;
        border-left: 1px solid #e7e7e7;
    }
    .drag-sort{
        cursor: move;
    }

</style>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <div class="nav-box">
    <?php echo smarty_function_include_file(array('name'=>'public/nav'),$_smarty_tpl);?>

    </div>
    <!-- Page Content -->
    <div id="page-wrapper" style="min-height: 635px;">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">我创建的项目</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row" id="sortable">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['create_projects']->value, 'create_project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['create_project']->value) {
?>
            <?php $_smarty_tpl->_assignInScope('project_id', $_smarty_tpl->tpl_vars['create_project']->value['id']);
?>
            <?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['create_project']->value['user_id']);
?>
            <div class="col-lg-3 view-project js_viewProject pannel-project" data-url="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['create_project']->value['id']);
$_prefixVariable1=ob_get_clean();
echo url("project/".$_prefixVariable1);?>
">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="head-title">
                        <a href="javascript:void(0);" class="drag-sort fa hidden-xs fa-navicon js_dragProjectBtn" title='拖拽排序' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
  <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['create_project']->value['title'],12);?>
</span>
                    <span class="head-btn">
                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['create_project']->value['id'];
$_prefixVariable2=ob_get_clean();
if (\app\member::has_rule($_prefixVariable2,'project','update')) {?>
                                <a class="fa hidden-xs fa-pencil js_addProjectBtn" data-title='编辑项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                                <?php }?>

                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['create_project']->value['id'];
$_prefixVariable3=ob_get_clean();
if (\app\member::has_rule($_prefixVariable3,'project','delete')) {?>
                                <a class="fa hidden-xs fa-trash-o js_deleteProjectBtn" data-title='删除项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                                <?php }?>

                                <?php ob_start();
echo $_smarty_tpl->tpl_vars['create_project']->value['id'];
$_prefixVariable4=ob_get_clean();
if (\app\member::has_rule($_prefixVariable4,'project','transfer')) {?>
                                <a class="fa hidden-xs fa-exchange js_transferProjectBtn" data-title='转让项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                                <?php }?>
                            </span>
                </div>
                <div class="panel-body">
                    <p><?php echo $_smarty_tpl->tpl_vars['create_project']->value['intro'];?>
</p>
                </div>
                <div class="panel-footer">
                    项目创建时间(<?php echo $_smarty_tpl->tpl_vars['create_project']->value['add_time'];?>
)
                    <br>
                    最近更新时间(<?php echo $_smarty_tpl->tpl_vars['create_project']->value['update_time'];?>
)
                </div>
            </div>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


        <!-- /.col-lg-4 -->

        <!-- /.col-lg-4 -->
        <div class="col-lg-3 hidden-xs js_addProjectBtn">
            <div class="panel panel-default">

                <div class="panel-body project-add">
                    <p class="fa fa-plus">添加项目</p>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">我加入的项目</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['join_projects']->value, 'join_project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['join_project']->value) {
?>
        <?php $_smarty_tpl->_assignInScope('project_id', $_smarty_tpl->tpl_vars['join_project']->value['project_id']);
?>
        <?php if (_uri('project',$_smarty_tpl->tpl_vars['project_id']->value)) {?>
        <?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['join_project']->value['user_id']);
?>
        <?php $_smarty_tpl->_assignInScope('join_project_title', _uri('project',$_smarty_tpl->tpl_vars['project_id']->value,'title'));
?>
        <div class="col-lg-3 view-project js_viewProject pannel-project" data-url="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['join_project']->value['project_id']);
$_prefixVariable5=ob_get_clean();
echo url("project/".$_prefixVariable5);?>
">
         <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['join_project_title']->value,14);?>

                <span class="head-btn">
                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'project','update')) {?>
                    <a class="fa hidden-xs fa-pencil js_addProjectBtn" data-title='编辑项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                    <?php }?>

                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'project','delete')) {?>
                    <a class="fa hidden-xs fa-trash-o js_deleteProjectBtn" data-title='删除项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                    <?php }?>

                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'project','transfer')) {?>
                    <a class="fa hidden-xs fa-exchange js_transferProjectBtn" data-title='转让项目' data-id="<?php echo $_smarty_tpl->tpl_vars['create_project']->value['id'];?>
"></a>
                    <?php }?>
                    <a class="fa hidden-xs fa-sign-out js_quitProject" data-toggle="tooltip" title="退出项目" data-id="<?php echo $_smarty_tpl->tpl_vars['project_id']->value;?>
"></a>
                </span>
            </div>
            <div class="panel-body">
                <p><?php echo _uri('project',$_smarty_tpl->tpl_vars['project_id']->value,'intro');?>
</p>
            </div>
            <div class="panel-footer">
                创建时间(<?php echo _uri('project',$_smarty_tpl->tpl_vars['project_id']->value,'add_time');?>
)
                <br>
                加入时间(<?php echo $_smarty_tpl->tpl_vars['join_project']->value['add_time'];?>
)
            </div>
         </div>
      </div>
     <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>



    <div class="col-lg-3">
        <div class="panel panel-default">

            <div class="panel-body project-search js_searchProjectBtn">
                <p class="fa fa-search">搜索项目</p>
            </div>

        </div>
    </div>
    <!-- /.col-lg-4 -->


    <!-- /#page-wrapper -->

</div>

<hr>
<p class="text-center"><?php echo get_config('copyright');?>
</p>

<!-- /#wrapper -->
<!-- 添加/编辑项目模态框 -->
<div class="modal fade" id="js_addProjectModal" tabindex="-9" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加项目</h4>
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
                        <input name="password" type="text" class="form-control" placeholder="重要操作，请输入登录密码" datatype="*" nullmsg="请输入登录密码!" errormsg="请输入正确的登录密码!">
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

                <iframe id="js_transferProjectIframe" src="<?php echo url('project/transfer');?>
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
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo STATIC_URL;?>
/plugins/sortable/sortable.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $(function(){

        // 拖拽排序
        var el = document.getElementById('sortable');
        var sortable = Sortable.create(el,{
            animation: 150,
            forceFallback: true,
            handle: ".js_dragProjectBtn",
            draggable: ".js_viewProject",
            scrollSensitivity: 100,
            scrollSpeed: 20
        });

        // 添加/编辑项目
        $(".js_addProjectBtn").iframeModal({
            modalItem: '#js_addProjectModal', //modal元素
            iframeItem: '#js_addProjectIframe', //iframe元素
            submitBtn: '.js_submit',
        });

        // 转让项目
        $(".js_transferProjectBtn").iframeModal({
            modalItem: '#js_transferProjectModal', //modal元素
            iframeItem: '#js_transferProjectIframe', //iframe元素
            submitBtn: '.js_submit',
        });

        //搜索项目
        $(".js_searchProjectBtn").click(function(){

            window.location.href = "<?php echo url('project/search');?>
";

        });

        //查看项目
        $(".js_viewProject").click(function (event) {

            event.stopPropagation();
            window.location.href = $(this).data('url');

        });

        //退出项目
        $(".js_quitProject").click(function(event){
            // 阻止事件冒泡
            event.stopPropagation();
            var thisObj = $(this);
            var id = thisObj.data('id');
            var url = "<?php echo url('project/quit');?>
";

            confirm('确认退出项目?', function(){

                $.post(url, { project_id:id }, function(json){

                    if(json.code == 200){

                        alert(json.msg, 500, function () {
                            thisObj.closest('.view-project').remove();
//                            window.location.reload();
                        });

                    }else{

                        alert(json.msg, 2000);

                    }

                }, 'json');
            });

        });

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

    });
<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
