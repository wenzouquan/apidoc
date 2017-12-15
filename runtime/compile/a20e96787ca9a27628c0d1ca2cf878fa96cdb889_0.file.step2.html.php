<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:14:15
  from "/Users/dfrobot/winn/www/phprap/application/install/view/step2.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a3392675e0f24_42626146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a20e96787ca9a27628c0d1ca2cf878fa96cdb889' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/install/view/step2.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3392675e0f24_42626146 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'数据库配置——安装步骤二'),$_smarty_tpl);?>

<link href="<?php echo STATIC_URL;?>
/css/install.css" rel="stylesheet">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="install-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">安装步骤二</h3>
                </div>
                <div class="panel-body">

                    <?php echo smarty_function_include_file(array('name'=>'public/nav','step'=>2),$_smarty_tpl);?>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">数据库信息</div>

                                <div class="panel-body">
                                    <form class="form-horizontal" id="js_step2Form" role="form" action="<?php echo url('install/step2');?>
" method="post">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库类型</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[host]" class="form-control disabled" disabled value="MySQL">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库服务器</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[host]" class="form-control" placeholder="数据库服务器地址，一般为localhost" datatype="*" value="localhost">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库端口号</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[port]" class="form-control" datatype="n" value="3306">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库名</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[name]" class="form-control" datatype="*" value="phprap" placeholder="不存在会自动创建">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库用户名</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[user]" class="form-control" datatype="*" value="root">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库密码</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[password]" class="form-control" datatype="*">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">数据库表前缀</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="step2[prefix]" class="form-control" datatype="*" placeholder="同一个数据库安装多个程序请修改" value="doc_">
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
        $("#js_step2Form").Validform({

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

                    window.location.href = "<?php echo url('install/step3');?>
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
<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
