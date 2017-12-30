<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:03:38
  from "/Users/dfrobot/winn/www/phprap/application/admin/view/public/footer.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a339dfa847c16_29425658',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '726cfe985dfe32ef36ef7776c668dc57f4ad49d9' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/admin/view/public/footer.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a339dfa847c16_29425658 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!-- 修改个人资料模态框 -->
<div class="modal fade" id="js_settingProfileModal" tabindex="-1" role="dialog" aria-labelledby="settingLabel" aria-hidden="true">
    <form id="js_settingProfileForm" role="form" action="<?php echo url('user');?>
" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="settingLabel">个人设置</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group">
                                <label>登录邮箱</label>
                                <input name="email" class="form-control" value="<?php echo \app\user::get_user_email();?>
" disabled datatype="e">
                            </div>

                            <div class="form-group">
                                <label>用户昵称</label>
                                <input name="name" class="form-control" value="<?php echo \app\user::get_user_name();?>
" placeholder="必填，建议写真实姓名以方便识别" name="nick_name" type="text" datatype="s2-10" nullmsg="请输入用户昵称！" errormsg="请输入2-10个由字母或汉字组成的字符">
                            </div>

                            <div class="form-group">
                                <label>登录密码</label>
                                <input class="form-control" placeholder="修改密码需要重新登录，密码不少于6位" name="password" type="text" ignore="ignore" datatype="*6-20" nullmsg="请输入登录密码！" errormsg="请填写6-20个字符">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary js_submit">保存</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
    <!-- /.modal-dialog -->
</div>

<?php echo '<script'; ?>
>
    $(function(){

        // 判断是否是默认密码
        var isDefaultPassword = "<?php echo is_default_password();?>
";

        if(isDefaultPassword){

            confirm('您的密码是默认密码，为安全起见，请立即修改密码', function(){

                $('#js_settingProfileModal').modal('show');

            });
        }

        //退出登录
        $(document).delegate('.js_logoutBtn', 'click',function(){

            var url = "<?php echo url('logout','','','json');?>
";

            $.post(url, {}, function(json){

                if(json.code == 200){

                    alert(json.msg, 800, function(){

                        window.location.href = "<?php echo url('login');?>
";

                    });
                }

            }, 'json');
        });

        // 关闭单条消息
        $(document).delegate('.js_cleanSingleNotify', 'click',function(event){
            event.stopPropagation();

            var thisObj = $(this);

            var id  = thisObj.data('id');

            var url = "<?php echo url('notify/delete');?>
";

            $.post(url, { id:id }, function(json){

                if(json.code == 200){

                    alert(json.msg, 1000, function(){

                        thisObj.closest('li').remove();

                        var url = "<?php echo url('notify/load');?>
";
                        $('.js_notifyDropdown').load(url);

                    });

                }else{

                    alert(json.msg, 3000);

                }

            }, 'json');

        });

        // 清空全部消息
        $(document).delegate('.js_cleanAllNotify', 'click',function(){
            confirm('确定要清空所有的提醒消息?', function(){
                var ids = '';
                $(".js_cleanSingleNotify").each(function () {

                    ids += $(this).data('id') + ',';

                });

                var url = "<?php echo url('notify/delete');?>
";

                $.post(url, { id:ids }, function(json){

                    if(json.code == 200){

                        alert(json.msg, 1000, function(){

                            var url = "<?php echo url('notify/load');?>
";
                            $('.js_notifyDropdown').load(url);

                        });

                    }else{

                        alert(json.msg, 3000);

                    }

                }, 'json');

                //alert('提醒消息清理成功', 500);

            });

        });

        //修改个人资料表单验证
        $("#js_settingProfileForm").validateForm();

        // ajax消息通知
        <?php if (get_config('is_push')) {?>

        var loadUrl = "<?php echo url('notify/load');?>
";
        var pushTime = "<?php echo get_config('push_time');?>
";

        setInterval(function(){

            $('.js_notifyDropdown').load(loadUrl);

        }, pushTime*1000);
        <?php }?>

    });
<?php echo '</script'; ?>
>

</body>

</html><?php }
}
