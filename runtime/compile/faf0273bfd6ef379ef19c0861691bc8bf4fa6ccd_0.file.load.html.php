<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:38:13
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/request/load.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a6153300f7_39783931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faf0273bfd6ef379ef19c0861691bc8bf4fa6ccd' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/request/load.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a6153300f7_39783931 (Smarty_Internal_Template $_smarty_tpl) {
?>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="success">

        <th>字段别名</th>
        <th>字段含义</th>
        <th>字段类型</th>
        <th>是否必填</th>
        <th>默认值</th>
        <th>备注说明</th>
        <th>快捷操作</th>
    </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['request_fields']->value, 'request_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['request_field']->value) {
?>
    <tr class="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['class'];?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['name'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['title'];?>
</td>
        <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['request_field']->value['type'];
$_prefixVariable1=ob_get_clean();
echo \app\field::get_type_list($_prefixVariable1);?>
</td>
        <td><?php if ($_smarty_tpl->tpl_vars['request_field']->value['is_required']) {?>是<?php } else { ?>否<?php }?></td>
        <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['default_value'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['request_field']->value['intro'];?>
</td>
        <td style="width: 10%">
            <a href="javascript:void(0);" class="fa fa-pencil js_addRequestFieldBtn" data-title="编辑请求参数" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['request_field']->value['id'];?>
"></a>
            <a href="javascript:void(0);" class="fa fa-trash-o js_deleteFieldBtn" data-title="删除参数" data-id="<?php echo $_smarty_tpl->tpl_vars['request_field']->value['id'];?>
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
