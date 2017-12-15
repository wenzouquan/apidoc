<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:35:06
  from "/Users/dfrobot/winn/www/phprap/application/home/view/debug/load.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a55a1bd2a5_90161592',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2bf83e9bbf92a7cca7e5ae2846e72472451d3826' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/debug/load.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a55a1bd2a5_90161592 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                <?php if ($_smarty_tpl->tpl_vars['info']->value) {?>
                <a href="javascript:void(0);">status:<?php echo $_smarty_tpl->tpl_vars['info']->value['http_code'];?>
</a>    <a href="javascript:void(0);">time:<?php echo $_smarty_tpl->tpl_vars['info']->value['total_time'];?>
 s</a>
                <?php } else { ?>
                响应面板
                <?php }?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills">

                    <li class="active"><a href="#body-pills" data-toggle="tab" aria-expanded="false">Body</a>
                    </li>

                    <li class=""><a href="#header-pills" data-toggle="tab" aria-expanded="true">Headers</a>
                    </li>

                    <li class=""><a href="#cookie-pills" data-toggle="tab" aria-expanded="false">Cookies</a>
                    </li>

                </ul>

                <!-- Tab panes -->

                <div class="tab-content">

                    <div class="tab-pane fade active in" id="body-pills">
                        <p>
                            <?php if ($_smarty_tpl->tpl_vars['body']->value) {?>
                        <div class="hidden json-data"><?php echo $_smarty_tpl->tpl_vars['body']->value;?>
</div>
                        <div class="json-box"><?php echo $_smarty_tpl->tpl_vars['body']->value;?>
</div>
                        <?php } else { ?>
                        暂无数据
                        <?php }?>
                        </p>

                    </div>

                    <div class="tab-pane fade" id="header-pills">
                        <?php if ($_smarty_tpl->tpl_vars['headers']->value['request']) {?>
                        <h5>request</h5>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['headers']->value['request'], 'header');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['header']->value) {
?>
                        <p>
                            <?php echo $_smarty_tpl->tpl_vars['header']->value;?>

                        </p>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['headers']->value['response']) {?>
                        <h5>response</h5>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['headers']->value['response'], 'header');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['header']->value) {
?>
                        <p>
                            <?php echo $_smarty_tpl->tpl_vars['header']->value;?>

                        </p>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <?php }?>

                    </div>

                    <div class="tab-pane fade" id="cookie-pills">
                        <p>
                            暂无数据
                        </p>
                    </div>

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
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

    });
<?php echo '</script'; ?>
><?php }
}
