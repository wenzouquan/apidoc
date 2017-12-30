<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:19
  from "/Users/dfrobot/winn/www/phprap/application/home/view/public/project_sidebar.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a65722c4b9_93803018',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '733cf8afc32e1f4fa7b360ad38f69953fa1e27a2' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/public/project_sidebar.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a65722c4b9_93803018 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['project']->value['id']);
$_prefixVariable10=ob_get_clean();
echo url("project/".$_prefixVariable10);?>
"><i class="fa fa-home fa-fw"></i> 项目主页</a>
            </li>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'module');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['module']->value) {
?>
            <li class="module-item js_moduleItem" data-id="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
">
                <a href="javascript:void(0);"><i class="fa fa-fw fa-folder-open"></i>
                    <?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>

                    <?php $_smarty_tpl->_assignInScope('project_id', $_smarty_tpl->tpl_vars['project']->value['id']);
?>

                    <span class="fa fa-fw arrow"></span>

                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'module','delete')) {?>
                    <span class="fa hidden-xs fa-fw fa-trash-o js_deleteModuleBtn hidden" data-id="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" data-title="删除模块"></span>
                    <?php }?>

                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'api','add')) {?>
                    <span class="fa hidden-xs fa-fw fa-plus js_addApiBtn hidden" data-id="<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" data-title="添加接口"></span>
                    <?php }?>

                    <?php if (\app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'module','update')) {?>
                    <span class="fa hidden-xs fa-fw fa-pencil  js_addModuleBtn hidden" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
" data-title="编辑模块"></span>
                    <?php }?>
                </a>
                <ul class="nav nav-second-level collapse" id="api-menu-<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
">
                    <?php $_smarty_tpl->_assignInScope('apis', \app\api::get_api_list($_smarty_tpl->tpl_vars['module']->value['id']));
?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['apis']->value, 'api');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['api']->value) {
?>
                    <?php $_smarty_tpl->_assignInScope('api_id', $_smarty_tpl->tpl_vars['api']->value['id']);
?>
                    <li class="api-item js_apiItem" data-id="<?php echo $_smarty_tpl->tpl_vars['api_id']->value;?>
">
                        <a href="<?php ob_start();
echo id_encode($_smarty_tpl->tpl_vars['api_id']->value);
$_prefixVariable11=ob_get_clean();
echo url("api/".$_prefixVariable11);?>
" title="点击查看接口详情">
                        <i class="fa fa-fw fa-files-o"></i><?php echo $_smarty_tpl->tpl_vars['api']->value['title'];?>

                        <i class="fa fa-fw fa-eye pull-right"></i>
                        </a>
                    </li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


            <li>
                <a class="js_addModuleBtn hidden-xs" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
-0" data-title="添加模块" href="javascript:void(0);"><i class="fa fa-fw fa-plus"></i> 添加模块</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

<!-- 添加/编辑模块模态框 -->
<div class="modal fade" id="js_addModuleModal" tabindex="1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加模块</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addModuleIframe" style="min-height: 180px;" src="<?php echo url('module/add');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_submit">提交</button>
            </div>

        </div>
    </div>

</div>

<!-- 添加接口模态框 -->
<div class="modal fade" id="js_addApiModal" tabindex="1" role="dialog">
    <div class="modal-dialog" style="width: 700px;" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">添加接口</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addApiIframe" style="min-height: 380px;" src="<?php echo url('api/add');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_submit">提交</button>
            </div>

        </div>

    </div>

</div>

<!-- 删除模块模态框 -->
<div class="modal fade" id="js_deleteModuleModal" tabindex="2" role="dialog">
    <div class="modal-dialog" role="document">
        <form role="form" action="<?php echo url('module/delete','','','json');?>
" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">确定删除此模块吗？</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-dismissable alert-warning">
                        <i class="fa fa-fw fa-info-circle"></i>
                        模块删除后，该模块下所有接口也将被立刻删除，不可恢复，请谨慎操作！
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

<?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/sortable/sortable.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $(function(){

        //添加/编辑模块表单合法性验证
        $("#js_addModuleForm").validateForm();

        // 添加/编辑模块
        $(".js_addModuleBtn").iframeModal({
            clickItem: '.js_addModuleBtn', //modal元素
            modalItem: '#js_addModuleModal', //modal元素
            iframeItem: '#js_addModuleIframe', //提交按钮
            submitBtn: '.js_submit'
        });

        //删除模块表单合法性验证
        $("#js_deleteModuleModal form").validateForm();

        // 删除模块
        $(".js_deleteModuleBtn").click(function () {
            // 阻止事件冒泡
            event.stopPropagation();
            var id = $(this).data('id');

            if(id <= 0){
                alert('请选择要删除的模块');
            }

            $('#js_deleteModuleModal input[name=id]').val(id);

            $('#js_deleteModuleModal').modal('show');
        });

        // 添加/编辑接口
        $(".js_addApiBtn").iframeModal({
            clickItem: '.js_addApiBtn', //modal元素
            modalItem: '#js_addApiModal', //modal元素
            iframeItem: '#js_addApiIframe', //提交按钮
            submitBtn: '.js_submit'
        });

        $(".js_moduleItem").mouseover(function(event){
            event.stopPropagation();
            $(this).find('span').removeClass('hidden');
            $('.js_apiItem').find('span').addClass('hidden');

        }).mouseout(function(event){
            event.stopPropagation();
            $(this).find('span').addClass('hidden');

        });

        $(".js_apiItem").mouseover(function(event){
            event.stopPropagation();
            $(this).find('span').removeClass('hidden');
            $(this).find('.fa-eye').removeClass('hidden');

        }).mouseout(function(event){
            event.stopPropagation();
            $(this).find('span').addClass('hidden');
            $(this).find('.fa-eye').addClass('hidden');

        });

    });
<?php echo '</script'; ?>
><?php }
}
