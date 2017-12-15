<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:18:09
  from "/Users/dfrobot/winn/www/phprap/application/admin/view/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a3393519f0c97_69531368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22104cfc5084c650fd9e8fde2bc826d56b7925bb' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/admin/view/index.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3393519f0c97_69531368 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'管理中心'),$_smarty_tpl);?>


<style>
    .huge {
        font-size: 35px;
    }

    .last-item {
        margin: 0;
    }
    .pro_name a{color: #4183c4;}
    .ui.segment.osc_git_box {height: 260px;padding: 0px !important;border: 1px solid #E3E9ED;}
    .osc_git_title{background-color: #fff;}
    .osc_git_box{background-color: #fff;}
    .osc_git_box{border-color: #E3E9ED;}
    .osc_git_info{color: #666;}
    .osc_git_main a{color: #9B9B9B;}
    .osc_git_footer {display: none;}

</style>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">管理中心</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php if ($_smarty_tpl->tpl_vars['last_login']->value) {?>
        <div class="alert alert-warning fade in m-b-15">
            <strong>温馨提示!</strong>
            您上次登录时间<?php echo $_smarty_tpl->tpl_vars['last_login']->value['add_time'];?>
，登录地点<?php echo $_smarty_tpl->tpl_vars['last_login']->value['address'];?>
 ，登录设备 <?php ob_start();
echo $_smarty_tpl->tpl_vars['last_login']->value['device'];
$_prefixVariable1=ob_get_clean();
echo \app\user::get_device_list('icon',$_prefixVariable1);?>
 ，更多登录历史请点击<a href="<?php echo url('admin/history/login');?>
?user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">这里</a>。
            <span class="close" data-dismiss="alert">×</span>
        </div>
        <?php }?>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <i class="fa fa-user fa-4x"></i>
                                <div>会员</div>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge"><?php echo \app\statistics::get_all_num('user');?>
</div>
                                <div>今日新增<?php echo \app\statistics::get_today_num('user');?>
</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <i class="fa fa-th fa-4x"></i>
                                <div>项目</div>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge"><?php echo \app\statistics::get_all_num('project');?>
</div>
                                <div>今日新增<?php echo \app\statistics::get_today_num('project');?>
</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <i class="fa fa-folder-open fa-4x"></i>
                                <div>模块</div>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge"><?php echo \app\statistics::get_all_num('module');?>
</div>
                                <div>今日新增<?php echo \app\statistics::get_today_num('module');?>
</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row text-center">
                            <div class="col-xs-4">
                                <i class="fa fa-files-o fa-4x"></i>
                                <div>接口</div>
                            </div>
                            <div class="col-xs-8">
                                <div class="huge"><?php echo \app\statistics::get_all_num('api');?>
</div>
                                <div>今日新增<?php echo \app\statistics::get_today_num('api');?>
</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">

                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user fa-fw"></i> 会员统计
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="user-chart" style="width: 100%;height:400px;"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">

                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> 项目统计
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="project-chart" style="width: 100%;height:400px;"></div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->

            <!-- /.col-lg-4 -->
        </div>

        <div class="row">
            <div class="col-lg-6">

                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-dribbble fa-fw"></i> 系统信息
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <p>程序版本：V<?php echo $_smarty_tpl->tpl_vars['system']->value['gophp_version'];?>
 <a target="_blank" href="https://github.com/gouguoyin/phprap/releases">最新版本</a></p>
                        <p>系统环境：<?php echo PHP_OS;?>
+PHP<?php echo $_smarty_tpl->tpl_vars['system']->value['php_version'];?>
+MySQL<?php echo $_smarty_tpl->tpl_vars['system']->value['mysql_version'];?>
</p>
                        <p>使用技术：PHP+MySQL+Bootstrap+JQuery</p>
                        <p>系统开发：<a target="_blank" href="http://www.gouguoyin.cn/about.html">勾国印</a></p>
                        <p>官方网站：<a target="_blank" href="http://www.phprap.com/">www.phprap.com</a></p>
                        <p>演示网站：<a target="_blank" href="http://demo.phprap.com">demo.phprap.com</a></p>
                        <p class="last-item">官方QQ群：<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=cf9440f673d6a29150bb8f033ed5fdf0e4e685f92350b7006778660bf8580f57"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="GoPHP官方交流群" title="GoPHP官方交流群"></a></p>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-6">

                <!-- /.panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comments fa-fw"></i> 常见问题
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq1">安装时报错General error: 1366 Incorrect integer value: '' for column 'id' at row 1</a></p>
                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq2">虚拟主机不能绑定域名到public目录怎么办?</a></p>
                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq3">NGINX环境下安装时不断刷新页面</a></p>
                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq4">如何手动安装PHPRAP?</a></p>
                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq5">如何查看错误日志?</a></p>
                        <p><a target="_blank" href="http://www.phprap.com/doc/faq.html#faq6">如何关闭异常提示页面?</a></p>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->

            <!-- /.col-lg-4 -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <hr>
    <p class="text-center"><?php echo get_config('copyright');?>
</p>

    <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo STATIC_URL;?>
/plugins/echarts/echarts.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('user-chart'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('project-chart'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [50, 45, 55, 38, 43, 20]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    <?php echo '</script'; ?>
>
    <?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

<?php }
}
