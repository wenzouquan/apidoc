<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:13
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/header/load.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6152fd5b2_54359756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47374ed9e2d6eccd27b26f4d9d6c97a22cd9fb4a' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/header/load.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6152fd5b2_54359756 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="success">

        <th>字段键</th>
        <th>字段值</th>
        <th>备注说明</th>
        <th>快捷操作</th>
    </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['header_fields']->value, 'header_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['header_field']->value) {
?>
    <tr class="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['class'];?>
">
        <td style="width: 20%"><?php echo $_smarty_tpl->tpl_vars['header_field']->value['name'];?>
</td>
        <td style="width: 35%"><?php echo $_smarty_tpl->tpl_vars['header_field']->value['default_value'];?>
</td>
        <td style="width: 35%"><?php echo $_smarty_tpl->tpl_vars['header_field']->value['intro'];?>
</td>
        <td style="width: 10%">
            <a href="javascript:void(0);" class="fa fa-pencil js_addHeaderFieldBtn" data-title="编辑header参数" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['header_field']->value['id'];?>
"></a>
            <a href="javascript:void(0);" class="fa fa-trash-o js_deleteFieldBtn" data-title="删除参数" data-id="<?php echo $_smarty_tpl->tpl_vars['header_field']->value['id'];?>
"></a>
        </td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

    </tbody>
</table><?php }
}
