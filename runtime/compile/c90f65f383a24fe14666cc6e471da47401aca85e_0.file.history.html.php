<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:38:18
  from "/Users/dfrobot/winn/www/phprap/application/home/view/project/history.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33980aec1529_98490517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c90f65f383a24fe14666cc6e471da47401aca85e' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/project/history.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33980aec1529_98490517 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'项目动态'),$_smarty_tpl);?>

<?php $_smarty_tpl->_assignInScope('user_id', $_smarty_tpl->tpl_vars['project']->value['user_id']);
?>
<style>
    .pagination {
        display: inline-block;
        padding-left: 0;
         margin: 0;
        border-radius: 4px;
    }
</style>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'project_sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>项目动态 </h1>
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
                                    <th>操作人</th>
                                    <th>操作类型</th>
                                    <th>操作对象</th>
                                    <th>操作内容</th>
                                    <th>操作时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['historys']->value, 'history');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['history']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['history']->value['user_name'];?>
<br><?php echo $_smarty_tpl->tpl_vars['history']->value['user_email'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['history']->value['type'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['history']->value['object'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['history']->value['content'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['history']->value['add_time'];?>
</td>
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

<hr>
<p class="text-center"><?php echo get_config('copyright');?>
</p>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
