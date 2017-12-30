<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:05
  from "/Users/dfrobot/winn/www/phprap/application/home/view/field/response/load.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a64924fc34_45766826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6970f983416893872c00c57cfd06d6b976cfcbdc' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/field/response/load.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a64924fc34_45766826 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>
    .panel-response .btn {
        padding: 0;
    }
</style>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="success">
        <th>字段别名</th>
        <th>字段含义</th>
        <th>字段类型</th>
        <th>MOCK规则</th>
        <th>备注说明</th>
        <th>快捷操作</th>
    </tr>
    </thead>
    <tbody>
    
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['response_fields']->value, 'response_field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['response_field']->value) {
?>
    <tr class="<?php if ($_smarty_tpl->tpl_vars['response_field']->value['level'] == 1) {?>warning<?php }?>">

        <td style="text-align: left;padding-left: 50px;"><?php echo $_smarty_tpl->tpl_vars['response_field']->value['delimiter'];
if ($_smarty_tpl->tpl_vars['response_field']->value['parent_id']) {?>└<?php }
echo $_smarty_tpl->tpl_vars['response_field']->value['name'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['title'];?>
</td>
        <td><?php ob_start();
echo $_smarty_tpl->tpl_vars['response_field']->value['type'];
$_prefixVariable1=ob_get_clean();
echo \app\field::get_type_list($_prefixVariable1);?>
</td>

        <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['mock'];?>
</td>

        <td><?php echo $_smarty_tpl->tpl_vars['response_field']->value['intro'];?>
</td>

        <td style="width: 10%">

            <a href="javascript:void(0);" class="btn btn-xs js_addResponseFieldBtn" data-title="编辑响应参数<?php echo $_smarty_tpl->tpl_vars['response_field']->value['title'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['response_field']->value['parent_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['response_field']->value['id'];?>
" data-toggle="tooltip" title="编辑响应参数" data-placement="bottom"><i class="fa fa-fw fa-pencil"></i></a>

            <a href="javascript:void(0);" class="btn btn-xs js_deleteFieldBtn" data-title="删除参数" data-id="<?php echo $_smarty_tpl->tpl_vars['response_field']->value['id'];?>
" data-toggle="tooltip" title="删除响应参数" data-placement="bottom"><i class="fa fa-fw fa-trash-o"></i></a>

            <a href="javascript:void(0);" class="btn btn-xs js_addResponseFieldBtn" data-title="添加响应子参数" data-id="<?php echo $_smarty_tpl->tpl_vars['api']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['response_field']->value['id'];?>
-0" data-toggle="tooltip" title="添加子参数" data-placement="bottom" <?php if (!in_array($_smarty_tpl->tpl_vars['response_field']->value['type'],array('array','object'))) {?>disabled<?php }?> ><i class="fa fa-fw fa-plus"></i></a>

        </td>

    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


    </tbody>
</table>
<?php }
}
