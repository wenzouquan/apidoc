<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:17:03
  from "/Users/dfrobot/winn/www/phprap/application/install/view/step3.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33930f1e7190_49510125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b68508463b1b081e1e34254455dcaadf371f0a1b' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/install/view/step3.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33930f1e7190_49510125 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'管理员配置——安装步骤三'),$_smarty_tpl);?>

<link href="<?php echo STATIC_URL;?>
/css/install.css" rel="stylesheet">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="install-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">安装步骤三</h3>
                </div>
                <div class="panel-body">

                    <?php echo smarty_function_include_file(array('name'=>'public/nav','step'=>3),$_smarty_tpl);?>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">管理员信息</div>

                                <div class="panel-body">

                                    <form class="form-horizontal" id="js_step3Form" role="form" action="<?php echo url('install/step3');?>
" method="post">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理员邮箱</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="step3[email]"  class="form-control" placeholder="登录邮箱" datatype="e" nullmsg="请输入登录邮箱！" errormsg="请输入合法的邮箱地址">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理员昵称</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step3[name]"  class="form-control" placeholder="建议写真实姓名以方便识别" datatype="*2-10" nullmsg="请输入用户昵称！" errormsg="请输入2-10个由字母或汉字组成的字符">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">管理员密码</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="step3[password]"  class="form-control" placeholder="密码不少于6位" datatype="*6-50" nullmsg="请输入登录密码！" errormsg="请填写6-50个字符">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">确认密码</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" placeholder="再次输入密码" datatype="*" recheck="step3[password]" nullmsg="请输入重复密码！" errormsg="重复密码与密码不一致">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="panel-button text-center">
                                                <a href="javascript:history.go(-1);" class="btn btn-info">上一步</a>
                                                <button type="button" class="btn btn-info js_submit">下一步</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>



                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


</div>

<?php echo '<script'; ?>
>

    $(function(){
        //验证登录表单
        $("#js_step3Form").Validform({

            tiptype:function(msg,o,cssctl){

                if(!o.obj.is("form")){

                    var objtip=o.obj.siblings(".Validform_checktip");

                    cssctl(objtip,o.type);

                    objtip.text(msg);

                }

            },

            label:"label",

            ajaxPost:true,

            btnSubmit: '.js_submit',

            callback:function(json){

                if(json.code == 200){

                    window.location.href = "<?php echo url('install/step4');?>
";

                }else{

                    alert(json.msg, 2000);

                }

            }

        });

        //百度统计
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?daf0d8924deff98ade7d56994ec572d8";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    })

<?php echo '</script'; ?>
>
<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
