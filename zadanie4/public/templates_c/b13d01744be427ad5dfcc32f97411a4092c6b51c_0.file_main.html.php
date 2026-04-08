<?php
/* Smarty version 5.4.5, created on 2026-04-08 20:01:24
  from 'file:main.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69d697f499caf6_82890911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b13d01744be427ad5dfcc32f97411a4092c6b51c' => 
    array (
      0 => 'main.html',
      1 => 1775643906,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d697f499caf6_82890911 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\zadanie4\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Kalkulator Kredytowy" ?? null : $tmp);?>
</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/css/main.css" />
    </head>
    <body class="is-preload">
        <div id="page-wrapper">

            <header id="header">
                <div class="logo container">
                    <div>
                        <h1><a href="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
" id="logo">Zadanie 4: </a></h1>
                        <p>Framework Amelia - Kalkulator</p>
                    </div>
                </div>
            </header>

            <nav id="nav">
                <ul>
                    <li class="current"><a href="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
">Strona Główna</a></li>
                </ul>
            </nav>

            <section id="main">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="content">
                                <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10978022969d697f499ae19_62442674', 'content');
?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div id="copyright">
                                <ul class="menu">
                                    <li>&copy; 2026 Zuzanna Brzozowska</li>
                                    <li>Framework: Amelia</li>
                                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/jquery.dropotron.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/jquery.scrolly.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/browser.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/breakpoints.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/util.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('conf')->app_url;?>
/assets/js/main.js"><?php echo '</script'; ?>
>

    </body>
</html><?php }
/* {block 'content'} */
class Block_10978022969d697f499ae19_62442674 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\zadanie4\\app\\views';
?>
 <?php
}
}
/* {/block 'content'} */
}
