<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:35:05
  from "/Users/dfrobot/winn/www/phprap/application/home/view/debug/detail.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a559f20ee4_11271759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10a33283c708a2673df74c197e2127b04f5265c7' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/debug/detail.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a559f20ee4_11271759 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_include_file')) require_once '/Users/dfrobot/winn/www/phprap/application/common/smarty/function.include_file.php';
?>

<?php echo smarty_function_include_file(array('name'=>'public/header','title'=>'在线调试'),$_smarty_tpl);?>

<link href="<?php echo STATIC_URL;?>
/plugins/jsonFormat/css.css" rel="stylesheet" type="text/css">

<style>
    body {
        background-color: #ffffff;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 0;
    }

    table a{
        margin-top: 10px;
    }

    .panel-body {
        padding: 15px 0 15px 15px;
    }

    .table>tbody>tr>td {
        padding: 8px 8px 8px 0;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0;
    }

    .nav-pills{
        margin-bottom: 10px;
    }

    .nav-pills>li>a {

        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;

        position: relative;
        display: block;
    }

    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
        color: #fff;
        background-color: #5cb85c;
    }

    .nav-pills>li>a:visited{
        text-decoration: none;
        background-color: #eee;
    }

    .tab-pane p{
        font-size: 12px;
    }

    .tab-pane p:last-child{
        margin: 0px;
    }

</style>
<div id="wrapper">
    <!-- Navigation --> <?php echo smarty_function_include_file(array('name'=>'public/nav','sidebar'=>'debug_sidebar'),$_smarty_tpl);?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>接口调试 </h1>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form id="js_requestForm" method="post" action="<?php echo url('debug');?>
">
            <input name="api[id]" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
">
            <input class="js_ApiMethod" name="api[method]" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['api']->value['method'];?>
">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button style="width: 80px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="js_envName"><?php echo $_smarty_tpl->tpl_vars['envs']->value[0]['name'];?>
</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['envs']->value, 'env');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['env']->value) {
?>
                                        <li><a class="js_envItem" href="javascript:void(0);" data-url="<?php echo $_smarty_tpl->tpl_vars['env']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['env']->value['name'];?>
</a></li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


                                    </ul>
                                </div>
                                <input type="text" class="form-control js_envUrl" name="api[url]" placeholder="请输入请求地址" value="<?php echo $_smarty_tpl->tpl_vars['envs']->value[0]['url'];?>
" />
                                <div class="input-group-btn">
                                    <button style="width: 80px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="js_methodName"><?php echo $_smarty_tpl->tpl_vars['api']->value['method'];?>
</span> <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['methods']->value, 'method');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['method']->value) {
?>
                                        <li class="js_methodItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['method']->value;?>
</a></li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                    </ul>
                                    <button class="btn btn-success js_submit" type="button"><i class="fa fa-search"></i> 请求</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Header参数 <a href="javascript:void(0);" class="fa fa-plus js_addHeaderBtn" data-toggle="tooltip" data-placement="right" title="添加参数"></a>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <table class="table header-table">
                                            <tbody>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['header_fields']->value, 'header_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['header_field']->value) {
?>

                                            <tr>
                                                <td style="width:25%"> <input name="header[key][]" class="form-control js_selectHeaderBtn" placeholder="key" datatype="*" value="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['name'];?>
" /> </td>
                                                <td style="width:40%"> <input name="header[value][]" class="form-control" placeholder="value" datatype="*"  value="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['default_value'];?>
" /> </td>
                                                <td style="width:30%"> <input class="form-control" placeholder="description" value="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['intro'];?>
" /> </td>
                                                <td style="width:5%">
                                                    <a href="javascript:void(0);" class="fa fa-trash-o js_deleteBtn" data-title="删除header参数" data-project_id="3"></a> </td>
                                            </tr>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                请求参数
                                <a href="javascript:void(0);" class="fa fa-plus js_addRequestBtn" data-toggle="tooltip" data-placement="right" title="添加参数"></a>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <table class="table request-table">
                                            <tbody>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['request_fields']->value, 'request_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request_field']->value) {
?>
                                            <tr>
                                                <td style="width:25%"><input name="request[key][]" class="form-control" placeholder="key" datatype="*"  value="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['name'];?>
"/></td>
                                                <td style="width:40%"><input name="request[value][]" class="form-control" placeholder="value" datatype="*"  value="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['default_value'];?>
"/></td>
                                                <td style="width:30%"><input class="form-control" placeholder="description" value="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['title'];?>
"/></td>
                                                <td style="width:5%">
                                                    <a href="javascript:void(0);" class="fa fa-trash-o js_deleteBtn" data-project_id="3"></a>
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
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
            </div>
            <div class="col-lg-5 js_responseBox" >
                <?php echo smarty_function_include_file(array('name'=>'debug/load'),$_smarty_tpl);?>

            </div>
        </div>
        </form>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<div class="hidden js_headerCloneBox">
    <table>
    <tr>
        <td style="width:25%"><input name="header[key][]" class="form-control js_selectHeaderBtn" placeholder="key" datatype="*" value=""/></td>
        <td style="width:40%"><input name="header[value][]" class="form-control" placeholder="value" datatype="*" value=""/></td>
        <td style="width:30%"><input class="form-control" placeholder="description" value=""/></td>
        <td style="width:5%">
            <a href="javascript:void(0);" class="fa fa-trash-o js_deleteBtn" data-project_id="3"></a>
        </td>
    </tr>
    </table>
</div>

<div class="hidden js_requestCloneBox">
    <table>
        <tr>
            <td style="width:25%"><input name="request[key][]" class="form-control" placeholder="key" datatype="*" value=""/></td>
            <td style="width:40%"><input name="request[value][]" class="form-control" placeholder="value" datatype="*" value=""/></td>
            <td style="width:30%"><input class="form-control" placeholder="description" value=""/></td>
            <td style="width:5%">
                <a href="javascript:void(0);" class="fa fa-trash-o js_deleteBtn" data-project_id="3"></a>
            </td>
        </tr>
    </table>
</div>

<hr />
<p class="text-center"><?php echo get_config('copyright');?>
</p>
<!-- /#wrapper -->
<?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/bootstrap/js/bootstrap3-typeahead.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var selectHeader = function () {
        var selectMemberBtn = $('.js_selectHeaderBtn');
        var localArrayData = ['Accept', 'Accept-Charset', 'Accept-Encoding', 'Accept-Language', 'Accept-Ranges', 'Authorization', 'Cache-Control', 'Connection','Cookie','Content-Length','Content-Type','Referer','User-Agent'];

        selectMemberBtn.typeahead({
            source: localArrayData,
            items: 8, //显示8条
            delay: 100, //延迟时间

        });
    }

    $(function () {

        // 选择环境
        $(".js_envItem").click(function () {
            var name = $(this).text();
            var url = $(this).data('url');

            $(".js_envName").text(name);
            $(".js_envUrl").val(url);

        });

        // 选择请求方式
        $(".js_methodItem").click(function () {
            var name = $(this).text();

            $(".js_methodName").text(name);
            $(".js_ApiMethod").val(name);

        });

        // 新增header参数
        $(".js_addHeaderBtn").click(function (event) {
            event.stopPropagation();
            var trObj = $(".js_headerCloneBox").find('tr');
            $(this).closest('.panel').find('tbody').append(trObj.clone(true));
        });

        // 新增请求参数
        $(".js_addRequestBtn").click(function (event) {
            event.stopPropagation();
            var trObj = $(".js_requestCloneBox").find('tr');
            $(this).closest('.panel').find('tbody').append(trObj.clone(true));
        });

        // 删除参数
        $("body").on('click', '.js_deleteBtn',function () {
            // 阻止事件冒泡
            event.stopPropagation();
            $(this).closest('tr').remove();
        });

        //验证表单
        $("#js_requestForm").Validform({
            tiptype:function(msg,o,cssctl){

                if(!o.obj.is("form")){

                    var objtip=o.obj.siblings(".Validform_checktip");

                    cssctl(objtip,o.type);

                    objtip.text(msg);

                }

            },

            btnSubmit:".js_submit",

            label:"label",

            ajaxPost:true,

            beforeSubmit: function () {
                $(".js_submit").attr("disabled", "disabled");
            },
            callback: function (data) {
                var url  = "<?php echo url('debug/load');?>
";
                var info = data.info;
                var body = data.body;
                var header = data.header;
                $(".js_responseBox").load(url, {info:info,header:header,body:body});

                $(".js_submit").removeAttr("disabled");
            }

        });

        //选择header
        selectHeader();
    });
<?php echo '</script'; ?>
>

<?php echo smarty_function_include_file(array('name'=>'public/footer'),$_smarty_tpl);?>

</body>
</html><?php }
}
