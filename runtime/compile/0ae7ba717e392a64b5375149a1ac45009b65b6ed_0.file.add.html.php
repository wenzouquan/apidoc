<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:40:38
  from "/Users/dfrobot/winn/www/phprap/application/home/view/member/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33989613e3b2_96229925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0ae7ba717e392a64b5375149a1ac45009b65b6ed' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/member/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33989613e3b2_96229925 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目管理'),$_smarty_tpl);?>

<style>
    body {
        background-color: #ffffff;
    }

    table a{
        margin-top: 10px;
    }
</style>
</head>

<body>

<div class="container">

    <!-- /.row -->
    <div class="row">

        <form id="js_addMemberForm" role="form" action="<?php echo url('member/add','','','json');?>
" method="post">

            <div class="alert alert-dismissable alert-warning">
                <i class="fa fa-fw fa-info-circle"></i>&nbsp;
                默认成员只能查看项目及项目接口,
                勾选编辑属性后，该成员可以编辑项目模块和接口,
                勾选删除属性后，该成员可以删除项目模块和接口.
            </div>

            <?php if ($_smarty_tpl->tpl_vars['member']->value['id']) {?>
            <div class="form-group">
                <label>成员信息</label>

                <input type="hidden" name='id' value="<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
">

                <input type="text" readonly class="form-control" datatype="*1-250" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['user']['name'];?>
(<?php echo $_smarty_tpl->tpl_vars['member']->value['user']['email'];?>
)">
            </div>
            <?php } else { ?>
            <div class="form-group input-group">
                <input type="hidden" name='id' value="<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
">
                <input type="hidden" name='user_id' value="0">
                <input type="hidden" name='project_id' value="<?php echo $_smarty_tpl->tpl_vars['member']->value['project_id'];?>
">
                <input type="text" class="form-control js_selectMemberBtn" placeholder="输入昵称/邮箱，支持模糊查询" datatype="*1-250">
                <span class="input-group-btn">
                    <button class="btn btn-default js_cleanMemberBtn" type="button" data-toggle="tooltip" title="清空"><i class="fa fa-times"></i>
                    </button>
                </span>
            </div>

            <?php }?>

            <div class="form-group">
                <label>项目权限</label>
                <label class="checkbox-inline">
                    <input name="project_rule[]" onclick="return false;" checked type="checkbox" value="look">查看
                </label>
                <label class="checkbox-inline">
                    <input name="project_rule[]" <?php if (in_array('transfer',$_smarty_tpl->tpl_vars['project_rules']->value)) {?>checked<?php }?> type="checkbox" value="transfer">转让
                </label>
                <label class="checkbox-inline">
                    <input name="project_rule[]" <?php if (in_array('update',$_smarty_tpl->tpl_vars['project_rules']->value)) {?>checked<?php }?> type="checkbox" value="update">编辑
                </label>
                <label class="checkbox-inline">
                    <input name="project_rule[]" <?php if (in_array('export',$_smarty_tpl->tpl_vars['project_rules']->value)) {?>checked<?php }?> type="checkbox" value="export">导出
                </label>
                <label class="checkbox-inline">
                    <input name="project_rule[]" <?php if (in_array('delete',$_smarty_tpl->tpl_vars['project_rules']->value)) {?>checked<?php }?>  type="checkbox" value="delete">删除
                </label>
            </div>

            <div class="form-group">
                <label>模块权限</label>
                <label class="checkbox-inline">
                    <input name="module_rule[]" onclick="return false;" checked type="checkbox" value="look">查看
                </label>
                <label class="checkbox-inline">
                    <input name="module_rule[]" <?php if (in_array('add',$_smarty_tpl->tpl_vars['module_rules']->value)) {?>checked<?php }?> type="checkbox" value="add">新增
                </label>
                <label class="checkbox-inline">
                    <input name="module_rule[]" <?php if (in_array('update',$_smarty_tpl->tpl_vars['module_rules']->value)) {?>checked<?php }?> type="checkbox" value="update">编辑
                </label>
                <label class="checkbox-inline">
                    <input name="module_rule[]" <?php if (in_array('delete',$_smarty_tpl->tpl_vars['module_rules']->value)) {?>checked<?php }?>  type="checkbox" value="delete">删除
                </label>
            </div>

            <div class="form-group">
                <label>接口权限</label>
                <label class="checkbox-inline">
                    <input name="api_rule[]" onclick="return false;" checked type="checkbox" value="look">查看
                </label>
                <label class="checkbox-inline">
                    <input name="api_rule[]" <?php if (in_array('add',$_smarty_tpl->tpl_vars['api_rules']->value)) {?>checked<?php }?> type="checkbox" value="add">新增
                </label>
                <label class="checkbox-inline">
                    <input name="api_rule[]" <?php if (in_array('update',$_smarty_tpl->tpl_vars['api_rules']->value)) {?>checked<?php }?> type="checkbox" value="update">编辑
                </label>
                <label class="checkbox-inline">
                    <input name="api_rule[]" <?php if (in_array('delete',$_smarty_tpl->tpl_vars['api_rules']->value)) {?>checked<?php }?>  type="checkbox" value="delete">删除
                </label>
            </div>

            <div class="form-group">
                <label>成员权限</label>
                <label class="checkbox-inline">
                    <input name="member_rule[]" onclick="return false;" checked type="checkbox" value="look">查看
                </label>
                <label class="checkbox-inline">
                    <input name="member_rule[]" <?php if (in_array('add',$_smarty_tpl->tpl_vars['member_rules']->value)) {?>checked<?php }?> type="checkbox" value="add">新增
                </label>
                <label class="checkbox-inline">
                    <input name="member_rule[]" <?php if (in_array('remove',$_smarty_tpl->tpl_vars['member_rules']->value)) {?>checked<?php }?>  type="checkbox" value="remove">移除
                </label>
            </div>

            <div class="form-group">
                <label>数据字典</label>
                <label class="checkbox-inline">
                    <input name="map_rule[]" onclick="return false;" checked type="checkbox" value="look">查看
                </label>
                <label class="checkbox-inline">
                    <input name="map_rule[]" <?php if (in_array('import',$_smarty_tpl->tpl_vars['map_rules']->value)) {?>checked<?php }?> type="checkbox" value="import">导入
                </label>

                <label class="checkbox-inline">
                    <input name="map_rule[]" <?php if (in_array('update',$_smarty_tpl->tpl_vars['map_rules']->value)) {?>checked<?php }?> type="checkbox" value="update">编辑
                </label>

                <label class="checkbox-inline">
                    <input name="map_rule[]" <?php if (in_array('export',$_smarty_tpl->tpl_vars['map_rules']->value)) {?>checked<?php }?> type="checkbox" value="export">导出
                </label>
                <label class="checkbox-inline">
                    <input name="map_rule[]" <?php if (in_array('delete',$_smarty_tpl->tpl_vars['map_rules']->value)) {?>checked<?php }?>  type="checkbox" value="delete">删除
                </label>
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
        var selectMemberBtn = $('.js_selectMemberBtn');
        var userIdInput     = $("input[name=user_id]");

        //添加/编辑成员表单合法性验证
        var memberModal = $(window.parent.document).find('#js_addMemberModal');
        $("#js_addMemberForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                if(userIdInput.val() == 0){
                    selectMemberBtn.addClass('Validform_error');
                    selectMemberBtn.val('').attr('placeholder','请选择用户');
                    return false;
                }
            },
            success:function () {
                parent.location.reload();
            },
            error:function () {
                // iframe父级提交按钮激活
                memberModal.find(".js_submit").text('重新提交').removeAttr("disabled");
            }

        });

        // 添加/编辑成员
        $('.js_addMemberBtn').click(function(event){
            // 阻止事件冒泡
            event.stopPropagation();

            var id = $(this).data('id');

            $('#js_addMemberModal input[name=id]').val(id);
            $('#js_addMemberModal').modal('show');

        });

        //选择成员
        selectMemberBtn.typeahead({
            source: function (name, process) {

                var projectId = "<?php echo $_smarty_tpl->tpl_vars['member']->value['project_id'];?>
"; //项目id

                if(!projectId){

                    projectId = 0;

                }

                var url = "<?php echo url('user/select');?>
";

                $.getJSON(url, { "name": name, "project_id":projectId }, function (data) {
                    process(data);
                });

            },
            afterSelect: function (item) {
                //选择项之后的时间，item是当前选中的项
                userIdInput.val(item.id);
                selectMemberBtn.attr("readonly","readonly");
            },

            items: 8, //显示8条
            delay: 100, //延迟时间

        });

        $('.js_cleanMemberBtn').click(function () {
            userIdInput.val(0);
            selectMemberBtn.removeAttr("readonly").val('').focus();
        });

        //移出项目
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
<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
