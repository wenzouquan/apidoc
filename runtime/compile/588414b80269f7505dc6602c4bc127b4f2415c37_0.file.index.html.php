<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:44:03
  from "/Users/dfrobot/winn/www/phprap/application/home/view/map/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a3399635e2692_00746540',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '588414b80269f7505dc6602c4bc127b4f2415c37' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/map/index.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a3399635e2692_00746540 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
echo smarty_function_include_file(array('name'=>'public/header','title'=>'数据字典'),$_smarty_tpl);?>


<style>
    .table-name{
        text-indent: 8px;
        border-left: 2px solid #88B7E0;
    }
    .upload-box {
        border: 2px dashed #efefef;
        border-radius: 5px;
        background: white;
        min-height: 150px;
        padding: 20px 20px;
        cursor: pointer;
        margin-bottom: 20px;
    }

    .upload-box .icon {
        margin: 0 auto .8rem;
        display: inline-block;
        width: 6.4rem;
        height: 5.760000000000001rem;
        background-position: -11.8rem -22.1rem;
        background-repeat: no-repeat;
        -webkit-background-size: 60rem;
        -moz-background-size: 60rem;
        background-size: 60rem;
        display: block;
    }

    .upload-box .icon i{
        opacity: .6;
    }

    .upload-box p {
        margin: 0;
        text-align: center;
        font-weight: bold;
        font-size: 1.75rem;
    }

    .upload-box p small {
        font-weight: normal;
        font-size: 1.28rem;
        opacity: .7;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
        filter: alpha(opacity=70);
    }

    .sql-upload {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 260px;
        padding: 0;
        cursor: pointer;
        filter:alpha(opacity=0);
        -moz-opacity:0;
        opacity:0;
        outline: medium none;
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
                    <h1>数据字典 </h1>
                    <div class="opt-btn">

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable1=ob_get_clean();
if (\app\member::has_rule($_prefixVariable1,'map','import')) {?>
                        <a href="javascript:void(0);" class="btn hidden-xs btn-sm btn-info js_importMapBtn" data-toggle="tooltip" title="导入建表sql文件" data-placement="bottom"><i class="fa fa-fw fa-upload"></i>导入</a>
                        <?php }?>

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable2=ob_get_clean();
if (\app\member::has_rule($_prefixVariable2,'map','update')) {?>
                        <a href="javascript:void(0);" class="btn hidden-xs btn-sm btn-success js_editMapBtn" data-toggle="tooltip" title="编辑数据字典" data-placement="bottom" data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"><i class="fa fa-fw fa-edit"></i>编辑</a>
                        <?php }?>

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable3=ob_get_clean();
if (\app\member::has_rule($_prefixVariable3,'map','delete')) {?>
                        <a <?php if (!$_smarty_tpl->tpl_vars['maps']->value) {?>disabled<?php }?> href="javascript:void(0);" class="btn hidden-xs btn-sm btn-danger js_deleteMapBtn" data-toggle="tooltip" title="删除数据字典" data-placement="bottom"  data-id="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"><i class="fa fa-fw fa-times"></i>删除</a>
                        <?php }?>

                        <?php ob_start();
echo $_smarty_tpl->tpl_vars['project']->value['id'];
$_prefixVariable4=ob_get_clean();
if (\app\member::has_rule($_prefixVariable4,'map','export')) {?>
                        <a <?php if (!$_smarty_tpl->tpl_vars['maps']->value) {?>disabled<?php }?> href="<?php echo url("map/export");?>
?id=<?php echo id_encode($_smarty_tpl->tpl_vars['project']->value['id']);?>
" class="btn hidden-xs btn-sm btn-warning" data-toggle="tooltip" title="导出HTML" data-placement="bottom"><i class="fa fa-fw fa-download"></i>导出</a>
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
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['maps']->value, 'map');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['map']->value) {
?>
                        <div class="table-responsive">
                            <p class="table-name"><strong><?php echo $_smarty_tpl->tpl_vars['map']->value['table_name'];
if ($_smarty_tpl->tpl_vars['map']->value['table_comment']) {?>(<?php echo $_smarty_tpl->tpl_vars['map']->value['table_comment'];?>
)<?php }?></strong></p>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="success">
                                    <th>字段</th>
                                    <th>类型</th>
                                    <th>是否为空</th>
                                    <th>是否主键</th>
                                    <th>默认值</th>
                                    <th>备注</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, json_decode($_smarty_tpl->tpl_vars['map']->value['field_json'],true), 'field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
?>
                                <tr>
                                    <td><?php echo $_smarty_tpl->tpl_vars['field']->value['field'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['field']->value['type'];?>
</td>
                                    <td><i class="fa <?php if ($_smarty_tpl->tpl_vars['field']->value['is_null']) {?>fa-check<?php } else { ?>fa-times<?php }?>"></i></td>
                                    <td><i class="fa <?php if ($_smarty_tpl->tpl_vars['field']->value['is_pk']) {?>fa-key<?php }?>"></i></td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['field']->value['default_value'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['field']->value['comment'];?>
</td>

                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                </tbody>
                            </table>
                        </div>
                        <?php
}
} else {
?>


                        <p class="text-center">
                            <i class="fa fa-fw fa-ban fa-3x"></i>
                            <br/>
                            无数据</p>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

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

<!-- 导入数据字典模态框 -->
<div class="modal fade" id="js_importMapModal" tabindex="2" role="dialog">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">导入数据字典</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-dismissable alert-warning">
                        <i class="fa fa-fw fa-info-circle"></i>
                        导入建表sql文件后会覆盖已有数据字典，请谨慎操作！
                    </div>
                    <div class="form-group">

                        <div class="upload-box">
                            <div class="icon"><i class="fa fa-fw fa-upload fa-5x"></i></div>
                            <p>点击这里上传建表sql文件</p>
                            <p><small>上传文件最大不能超过2M</small></p>
                            <input id="sql-upload" class="sql-upload" type="file" name="sql-file">
                        </div>

                        <div class="progress">
                            <div id="processbar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                0%
                            </div>
                        </div>



                    </div>

                </div>

            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- 删除数据字典模态框 -->
<div class="modal fade" id="js_deleteMapModal" tabindex="2" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="js_deleteMapForm" role="form" action="<?php echo url('map/delete','','','json');?>
" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">确定删除此项目的数据字典吗？</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-dismissable alert-warning">
                        <i class="fa fa-fw fa-info-circle"></i>
                        数据字典删除后不可恢复，请谨慎操作！
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
/js/ajaxfileupload.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

    //ajax文件上传
    function ajaxFileUpload() {

        $.ajaxFileUpload({
            url:"<?php echo url('upload/sql');?>
",//用于文件上传的服务器端请求地址
            secureuri:false ,//一般设置为false
            type: 'post',
            dataType: 'json',//返回值类型 一般设置为json
            fileElementId:'sql-upload',//文件上传控件的id属性
            data: { id: "<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"},
            success: function (data) {

                if(data.code != '200'){
                    alert(data.msg, 3000);
                }else{

                    function setProcess(){
                        var processbar = document.getElementById("processbar");
                        processbar.style.width = parseInt(processbar.style.width) + 5 + "%";
                        processbar.innerHTML   = processbar.style.width;
                        if(processbar.style.width == "100%"){

                            $('.js_restoreStatus').text('还原成功，页面刷新中').removeClass('disabled');
                            window.setInterval(function(){
                                parent.location.reload();
                            },1000);
                            window.clearInterval(bartimer);
                        }
                    }

                    var bartimer = window.setInterval(function(){setProcess();},100);

                }

            },
            error: function (data, status, e) {

                console.log(e);

            }
        });

        return false;
    }

    $(function(){

        // 导入数据字典
        $(document).delegate('.js_importMapBtn', 'click',function(){

            $('#js_importMapModal').modal('show');

        });

        $("#sql-upload").on('change', function () {
            ajaxFileUpload();
        });

        // 修改数据字典
        $(document).delegate('.js_editMapBtn', 'click',function(){
            alert('下个版本即将支持，敬请期待', 2000);return;
            var id = $(this).data('id');
            $('#page-wrapper').load("<?php echo url('map/edit');?>
", {'id':id});
        });

        // 删除数据字典
        $(document).delegate('.js_deleteMapBtn', 'click',function(){
            var id = $(this).data('id');

            if(id <= 0){
                alert('请选择要删除的项目', 1000);
            }

            $('#js_deleteMapModal input[name=id]').val(id);

            $('#js_deleteMapModal').modal('show');
        });

        //删除数据字典表单合法性验证
        $("#js_deleteMapForm").validateForm({
            success:function () {
                parent.location.reload();
            },
        });

    });
<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);
}
}
