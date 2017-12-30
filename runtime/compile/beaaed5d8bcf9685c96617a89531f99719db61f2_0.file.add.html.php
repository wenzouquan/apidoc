<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:56
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a67c3775d1_65004622',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'beaaed5d8bcf9685c96617a89531f99719db61f2' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/add.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a67c3775d1_65004622 (Smarty_Internal_Template $_smarty_tpl) {
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

        <form id="js_addProjectForm" role="form" action="<?php echo url('project/add','','','json');?>
" method="post">

            <input type="hidden" class="form-control" name="project[id]" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
">

            <div class="form-group">
                <label for="recipient-name" class="control-label">项目名称:</label>
                <input type="text" class="form-control" name="project[title]" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
" placeholder="必填" datatype="*" nullmsg="请输入项目名称!" errormsg="请输入项目名称!">
            </div>

            <div class="form-group">
                <label for="message-text" class="control-label">项目描述:</label>
                <textarea class="form-control" name="project[intro]" placeholder="必填" datatype="*" nullmsg="请输入项目描述!" errormsg="请输入项目描述!"><?php echo $_smarty_tpl->tpl_vars['project']->value['intro'];?>
</textarea>
            </div>

            <div class="form-group">
                <label for="recipient-name" class="control-label">环境域名:</label>
                <div class="table-responsive table-bordered">
                    <table class="table">
                        <tbody>
                        <?php if ($_smarty_tpl->tpl_vars['envs']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['envs']->value, 'env');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['env']->value) {
?>
                        <tr>
                            <td style="width:20%"><input name="env[name][]" class="form-control" placeholder="必填，标识符" datatype="/[a-z|A-Z|0-9|\-|_|\.]$/" value="<?php echo $_smarty_tpl->tpl_vars['env']->value['name'];?>
"></td>
                            <td style="width:20%"><input name="env[title][]" class="form-control" placeholder="必填，备注" datatype="*" value="<?php echo $_smarty_tpl->tpl_vars['env']->value['title'];?>
"></td>
                            <td style="width:50%"><input name="env[domain][]" class="form-control" placeholder="必填，环境域名，包含协议" datatype="/^(http|https)\:\/\//" value="<?php echo $_smarty_tpl->tpl_vars['env']->value['domain'];?>
"></td>
                            <td style="width:10%">
                                <a href="javascript:void(0);" class="fa fa-plus js_addEnvBtn" data-title="添加环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                                <a href="javascript:void(0);" class="fa fa-trash-o js_deleteEnvBtn" data-title="删除环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                            </td>
                        </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                        <?php } else { ?>
                        <tr>
                            <td style="width:20%"><input name="env[name][]" class="form-control" placeholder="必填，标识符" datatype="/^(\w){1,30}$/" value="product"></td>
                            <td style="width:20%"><input name="env[title][]" class="form-control" placeholder="必填，备注" datatype="*" value="生产环境"></td>
                            <td style="width:50%"><input name="env[domain][]" class="form-control" placeholder="必填，环境域名，包含协议" datatype="/^(http|https)\:\/\//" value=""></td>
                            <td style="width:10%">
                                <a href="javascript:void(0);" class="fa fa-plus js_addEnvBtn" data-title="添加环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                                <a href="javascript:void(0);" class="fa fa-trash-o js_deleteEnvBtn" data-title="删除环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:20%"><input name="env[name][]" class="form-control" placeholder="必填，标识符" datatype="/^(\w){1,30}$/" value="develop"></td>
                            <td style="width:20%"><input name="env[title][]" class="form-control" placeholder="必填，备注" datatype="*" value="开发环境"></td>
                            <td style="width:50%"><input name="env[domain][]" class="form-control" placeholder="必填，环境域名，包含协议" datatype="/^(http|https)\:\/\//" value=""></td>
                            <td style="width:10%">
                                <a href="javascript:void(0);" class="fa fa-plus js_addEnvBtn" data-title="新增环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                                <a href="javascript:void(0);" class="fa fa-trash-o js_deleteEnvBtn" data-title="删除环境" data-project_id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"></a>
                            </td>
                        </tr>
                        <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-group">
                <label for="recipient-name" class="control-label">是否允许被搜索到:
                    <a data-toggle="tooltip" data-placement="right" title="如果设为不允许搜索，那么其他人无法通过搜索项目搜索到该项目" class="btn-show-tips">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </label>
                <div class="form-group">
                    <label class="radio-inline">
                        <input type="radio" name="project[allow_search]" <?php if (!$_smarty_tpl->tpl_vars['project']->value || $_smarty_tpl->tpl_vars['project']->value['allow_search'] == 1) {?>checked<?php }?> value="1"> 允许
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="project[allow_search]" <?php if ($_smarty_tpl->tpl_vars['project']->value && $_smarty_tpl->tpl_vars['project']->value['allow_search'] == 0) {?>checked<?php }?> value="0"> 禁止
                    </label>
                </div>

                <input type="hidden" id="js_submit" value="提交">

            </div>



        </form>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#wrapper -->

<?php echo '<script'; ?>
>

    $(function(){

        //验证表单
        var projectModal = $(window.parent.document).find('#js_addRequestFieldModal');
        $("#js_addProjectForm").validateForm({
            submitBtn: '#js_submit',
            before:function () {
                // iframe父级提交按钮禁用
                projectModal.find(".js_submit").attr("disabled", "disabled").text('提交中..');
            },
            success:function () {
                parent.location.reload();
            },
            error:function () {
                // iframe父级提交按钮激活
                projectModal.find(".js_submit").text('重新提交').removeAttr("disabled");
            }
        });

        // 新增环境
        $("body").on('click', '.js_addEnvBtn',function () {
            var trObj = $(this).closest('tr');
            trObj.before(trObj.clone(true)).find('input').val('');
        });

        //删除环境
        $("body").on('click', '.js_deleteEnvBtn',function () {
            // 阻止事件冒泡
            event.stopPropagation();

            if($('.js_deleteEnvBtn').length <= 1){
                alert('至少要保留一个环境域名', 1000);
                return false;
            }

            $(this).closest('tr').remove();
        });

    });

<?php echo '</script'; ?>
>
<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
