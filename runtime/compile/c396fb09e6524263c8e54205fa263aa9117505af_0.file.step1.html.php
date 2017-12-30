<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:14:08
  from "/Users/dfrobot/winn/www/phprap/application/install/view/step1.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a339260bbf6e0_89811834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c396fb09e6524263c8e54205fa263aa9117505af' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/install/view/step1.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a339260bbf6e0_89811834 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'环境检测——安装步骤一'),$_smarty_tpl);?>

<link href="<?php echo STATIC_URL;?>
/css/install.css" rel="stylesheet">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="install-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">安装步骤一</h3>
                </div>
                <div class="panel-body">

                    <?php echo smarty_function_include_file(array('name'=>'public/nav','step'=>1),$_smarty_tpl);?>

                    <form id="js_step1Form" role="form" action="<?php echo url('install/step1');?>
" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        系统环境检测
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>检查项目</th>
                                                    <th>当前配置</th>
                                                    <th>所需配置</th>
                                                    <th>检测结果</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>操作系统</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['system']->value['php_os'];?>
</td>
                                                    <td>Linux/Win</td>
                                                    <td><i class="fa fa-check"></i></td>
                                                </tr>

                                                <tr>
                                                    <td>PHP版本</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['system']->value['php_version'];?>
</td>
                                                    <td>>=5.4.0</td>
                                                    <td>
                                                        <?php if (version_compare($_smarty_tpl->tpl_vars['system']->value['php_version'],'5.4.0','>=')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['php_version']" value="当前PHP版本不符合要求" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        依赖性检测
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>检查项目</th>
                                                    <th>当前配置</th>
                                                    <th>所需配置</th>
                                                    <th>检测结果</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <td>pdo扩展</td>
                                                    <td><?php if (extension_loaded('pdo')) {?>支持<?php } else { ?>不支持<?php }?></td>
                                                    <td>支持</td>
                                                    <td>
                                                        <?php if (extension_loaded('pdo')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['pdo']" value="必须安装PDO扩展" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>pdo_mysql扩展</td>
                                                    <td><?php if (extension_loaded('pdo_mysql')) {?>支持<?php } else { ?>不支持<?php }?></td>
                                                    <td>支持</td>
                                                    <td>
                                                        <?php if (extension_loaded('pdo_mysql')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['mysql']" value="必须安装pdo_mysql扩展" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>gd扩展</td>
                                                    <td>
                                                        <?php if (extension_loaded('gd')) {?>
                                                        支持
                                                        <?php } else { ?>
                                                        不支持
                                                        <?php }?>
                                                    </td>
                                                    <td>支持</td>
                                                    <td>
                                                        <?php if (extension_loaded('gd')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['gd']" value="必须安装GD扩展" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>openssl扩展</td>
                                                    <td>
                                                        <?php if (extension_loaded('openssl')) {?>
                                                        支持
                                                        <?php } else { ?>
                                                        不支持
                                                        <?php }?>
                                                    </td>
                                                    <td>支持</td>
                                                    <td>
                                                        <?php if (extension_loaded('openssl')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['openssl']" value="必须安装OPENSSL扩展" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>curl扩展</td>
                                                    <td>
                                                        <?php if (extension_loaded('curl')) {?>
                                                        支持
                                                        <?php } else { ?>
                                                        不支持
                                                        <?php }?>
                                                    </td>
                                                    <td>支持</td>
                                                    <td>
                                                        <?php if (extension_loaded('curl')) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1['curl']" value="必须安装CURL扩展" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        目录权限检测
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>检查项目</th>
                                                    <th>当前权限</th>
                                                    <th>所需权限</th>
                                                    <th>检测结果</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <td>runtime</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['chmod']->value['runtime'];?>
</td>
                                                    <td>可读,可写</td>
                                                    <td>
                                                        <?php if (is_writable(RUNTIME_PATH)) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1[log]" value="runtime目录必须可写" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>runtime/compile</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['chmod']->value['compile'];?>
</td>
                                                    <td>可读,可写</td>
                                                    <td>
                                                        <?php if (is_writable((RUNTIME_PATH).('/compile'))) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1[db]" value="runtime/compile目录必须可读可写" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>runtime/config</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['chmod']->value['config'];?>
</td>
                                                    <td>可读,可写</td>
                                                    <td>
                                                        <?php if (is_writable((RUNTIME_PATH).('/config'))) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1[db]" value="runtime/config目录必须可读可写" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>runtime/log</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['chmod']->value['log'];?>
</td>
                                                    <td>可读,可写</td>
                                                    <td>
                                                        <?php if (is_writable((RUNTIME_PATH).('/log/'))) {?>
                                                        <i class="fa fa-check"></i>
                                                        <?php } else { ?>
                                                        <i class="fa fa-times"></i>
                                                        <input type="hidden" name="step1[install]" value="runtime/log目录必须可读可写" >
                                                        <?php }?>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-button form-group text-center">
                                            <button type="button" class="btn btn-info js_submit">下一步</button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<?php echo '<script'; ?>
>

    $(function(){

        //验证登录表单
        $("#js_step1Form").Validform({

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

                    window.location.href = "<?php echo url('install/step2');?>
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
