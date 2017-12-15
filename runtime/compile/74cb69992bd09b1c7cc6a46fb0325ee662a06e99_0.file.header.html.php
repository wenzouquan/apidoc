<?php
/* Smarty version 3.1.31, created on 2017-12-15 18:39:56
  from "/Users/dfrobot/winn/www/phprap/application/home/view/public/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a33a67c544374_97872118',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74cb69992bd09b1c7cc6a46fb0325ee662a06e99' => 
    array (
      0 => '/Users/dfrobot/winn/www/phprap/application/home/view/public/header.html',
      1 => 1513329114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a33a67c544374_97872118 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=0">
    <meta name="keywords" content="<?php echo get_config('keywords');?>
">
    <meta name="description" content="<?php echo get_config('description');?>
">

    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
——<?php echo get_config('name');?>
</title>

    <link rel="icon" href="/favicon.ico" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo STATIC_URL;?>
/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo STATIC_URL;?>
/plugins/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo STATIC_URL;?>
/css/common.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo STATIC_URL;?>
/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Validform -->
    <link href="<?php echo STATIC_URL;?>
/plugins/validform/css.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->

    <!-- jQuery -->
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/jquery/jquery.min.js"><?php echo '</script'; ?>
>

    <!-- Bootstrap Core JavaScript -->
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>

    <!-- Metis Menu Plugin JavaScript -->
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/metisMenu/dist/metisMenu.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/validform/v5.3.2_min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/validform/datatype.js"><?php echo '</script'; ?>
>

    <!-- artDialog -->
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/plugins/artDialog/dist/dialog.js"><?php echo '</script'; ?>
>

    <!-- Custom Theme JavaScript -->
    <?php echo '<script'; ?>
 src="<?php echo STATIC_URL;?>
/js/common.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?daf0d8924deff98ade7d56994ec572d8";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    <?php echo '</script'; ?>
>




<?php }
}
