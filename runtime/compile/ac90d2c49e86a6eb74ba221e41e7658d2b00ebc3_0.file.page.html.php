<?php
/* Smarty version 3.1.31, created on 2017-12-15 17:40:37
  from "/Users/dfrobot/winn/www/phprap/application/home/view/public/page.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a339895a5e8d2_57376755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac90d2c49e86a6eb74ba221e41e7658d2b00ebc3' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/public/page.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a339895a5e8d2_57376755 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['page']->value->totalPages > 1) {?>
<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
    <ul class="pagination">
        <li class=""><a aria-label="Previous"><span aria-hidden="true">共<?php echo $_smarty_tpl->tpl_vars['page']->value->totalPages;?>
页<?php echo $_smarty_tpl->tpl_vars['page']->value->totalRows;?>
条数据</span></a></li>
        <li class="paginate_button hidden-xs" aria-controls="dataTables-example"  >
            <a href="<?php echo $_smarty_tpl->tpl_vars['page']->value->start();?>
">首页</a>
        </li>
        <li class="paginate_button previous " aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">
            <a href="<?php echo $_smarty_tpl->tpl_vars['page']->value->prev();?>
">上一页</a>
        </li>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['page']->value->numbers(), 'number');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['number']->value) {
?>
        <li class="paginate_button
        <?php if ($_smarty_tpl->tpl_vars['page']->value->nowPage == $_smarty_tpl->tpl_vars['number']->value->num) {?>
        active
        <?php }?>" >
            <a href="<?php echo $_smarty_tpl->tpl_vars['number']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['number']->value->num;?>
</a>
        </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>


        <li class="paginate_button next" id="dataTables-example_next">
            <a href="<?php echo $_smarty_tpl->tpl_vars['page']->value->next();?>
">下一页</a>
        </li>
        <li class="paginate_button hidden-xs" id="dataTables-example_next">
            <a href="<?php echo $_smarty_tpl->tpl_vars['page']->value->end();?>
">末页</a>
        </li>
    </ul>
</div>
<?php }
}
}
