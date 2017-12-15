<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:19
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/response/json.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a65727b244_58875726',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a6793262fca73c4e3cf542197677e6a3239b455' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/response/json.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a65727b244_58875726 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                返回示例<a role="button" class="btn fa fa-refresh js_refreshField" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
" data-toggle="tooltip" title="刷新数据" ></a>
            </div>
            <div class="panel-body">
                <div class="hidden json-data"><?php echo $_smarty_tpl->tpl_vars['respose_json']->value;?>
</div>
                <div class="json-box"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/jsonFormat/js.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    $(function () {
        // 格式化json
        jsonFormat();

        // 吐司提示
        $('[data-toggle="tooltip"]').tooltip();

    });
<?php echo '</script'; ?>
><?php }
}
