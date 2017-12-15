<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:40:37
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/member.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a3398958288b0_33059704',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a26c7450f09db8b554d602822150c89bbd229e7d' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/member.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3398958288b0_33059704 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目成员'),$_smarty_tpl);?>

<?php $_smarty_tpl->_assignInScope('project_id', $_smarty_tpl->tpl_vars['project']->value['id']);
$_smarty_tpl->_assignInScope('is_creater', \app\user::is_creater($_smarty_tpl->tpl_vars['project_id']->value));
$_smarty_tpl->_assignInScope('has_delete_rule', \app\member::has_rule($_smarty_tpl->tpl_vars['project_id']->value,'project','delete'));
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
                    <h1>项目成员 </h1>
                    <div class="opt-btn">
                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable1=ob_get_clean();
if (\app\member::has_rule($_prefixVariable1,'member','add')) {?>
                        <a href="javascript:void(0);" class="btn hidden-xs btn-sm btn-success js_addMemberBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
-0" data-title='添加成员'><i class="fa fa-fw fa-plus"></i>添加</a>

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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>昵称/邮箱</th>
                                    <th>项目权限</th>
                                    <th>模块权限</th>
                                    <th>接口权限</th>
                                    <th>会员权限</th>
                                    <th>字典权限</th>
                                    <th>加入时间</th>
                                    <?php if ($_smarty_tpl->tpl_vars['is_creater']->value || $_smarty_tpl->tpl_vars['has_delete_rule']->value) {?>
                                    <th width="15%">操作面板</th>
                                    <?php }?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['members']->value, 'member');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['member']->value) {
?>

                                <?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['member']->value['user_id']);
?>

                                <tr>
                                    <td><?php echo \app\user::get_name_email($_smarty_tpl->tpl_vars['user_id']->value);?>
</td>
                                    <td><?php echo \app\member::get_rules_title($_smarty_tpl->tpl_vars['member']->value['project_rule']);?>
</td>
                                    <td><?php echo \app\member::get_rules_title($_smarty_tpl->tpl_vars['member']->value['module_rule']);?>
</td>
                                    <td><?php echo \app\member::get_rules_title($_smarty_tpl->tpl_vars['member']->value['api_rule']);?>
</td>
                                    <td><?php echo \app\member::get_rules_title($_smarty_tpl->tpl_vars['member']->value['member_rule']);?>
</td>
                                    <td><?php echo \app\member::get_rules_title($_smarty_tpl->tpl_vars['member']->value['map_rule']);?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['member']->value['add_time'];?>
</td>
                                    <?php if ($_smarty_tpl->tpl_vars['is_creater']->value || $_smarty_tpl->tpl_vars['has_delete_rule']->value) {?>
                                    <td width="15%">

                                        <?php if (\app\user::is_creater($_smarty_tpl->tpl_vars['project_id']->value)) {?>
                                        <a type="button" class="btn btn-success btn-xs js_addMemberBtn" data-title="编辑权限" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
"><i class="fa fa-fw fa-key"></i>权限</a>
                                        <?php }?>

                                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project_id']->value;
$_prefixVariable2=ob_get_clean();
if (\app\member::has_rule($_prefixVariable2,'project','delete')) {?>
                                        <a type="button" class="btn btn-danger btn-xs js_quitProjectBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
"><i class="fa fa-fw fa-sign-out"></i>移除</a>
                                        <?php }?>

                                    </td>
                                    <?php }?>


                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                </tbody>
                            </table>
                            <?php echo smarty_function_include_file(array('name'=>'public/page'),$_smarty_tpl);?>

                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

    </div>
    <!-- /#page-wrapper -->




</div>
<!-- /#wrapper -->
<div class="modal fade" id="js_addMemberModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">添加成员</h4>
            </div>
            <div class="modal-body">

                <iframe id="js_addMemberIframe" style="min-height: 370px;" src="<?php echo url('member/add');?>
"></iframe>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary js_submit">提交</button>
            </div>

        </div>

    </div><!-- /.modal-dialog -->
</div>
<hr>
<p class="text-center"><?php echo get_config('copyright');?>
</p>
<?php echo '<script'; ?>
>
    $(function(){

        // 添加/编辑成员
        $(".js_addMemberBtn").iframeModal({
            modalItem: '#js_addMemberModal', //modal元素
            iframeItem: '#js_addMemberIframe', //iframe元素
            submitBtn: '.js_submit',
        });

        //移除成功
        $(".js_quitProjectBtn").click(function(event){
            // 阻止事件冒泡
            event.stopPropagation();

            var thisObj = $(this);

            var memberId    = thisObj.data('id');

            var url = "<?php echo url('member/delete');?>
";

            confirm('确认将该成员移出项目?', function(){

                $.post(url, { member_id:memberId }, function(json){

                    if(json.code == 200){

                        alert(json.msg, 500, function () {
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
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
