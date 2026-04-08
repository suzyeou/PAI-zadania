<?php
/* Smarty version 5.4.5, created on 2026-04-08 20:01:24
  from 'file:calc.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69d697f45bf842_69482440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93fb4e491764ba5c354d1361a27b7a62cfe947f5' => 
    array (
      0 => 'calc.html',
      1 => 1775643835,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d697f45bf842_69482440 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\zadanie4\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21762176169d697f4323f47_46933139', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.html", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_21762176169d697f4323f47_46933139 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\zadanie4\\app\\views';
?>

<article class="box page-content">
    <header>
        <h2>Kalkulator Kredytowy</h2>
        <p>Wypełnij formularz, aby poznać wysokość swojej raty.</p>
    </header>

    <section>
        <?php if ($_smarty_tpl->getValue('msgs')->isError()) {?>
            <div style="margin: 20px 0; padding: 15px; background: #FF8888; color: white; border-radius: 5px;">
                <ol style="margin: 0; padding-left: 20px;">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
                    <li>
                        <?php if ($_smarty_tpl->getValue('msg')->isError()) {
}?>
                        <?php echo $_smarty_tpl->getValue('msg')->text;?>

                    </li>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ol>
            </div>
        <?php }?>

        <form method="post" action="<?php echo $_smarty_tpl->getValue('conf')->action_url;?>
calcCompute">
            <div class="row gtr-50">
                <div class="col-4 col-12-mobile">
                    <label>Kwota kredytu:</label>
                    <input type="text" name="amount" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['amount'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
                </div>
                <div class="col-4 col-12-mobile">
                    <label>Liczba lat:</label>
                    <input type="text" name="years" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['years'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
                </div>
                <div class="col-4 col-12-mobile">
                    <label>Oprocentowanie:</label>
                    <select name="interest">
                    <option value="2" <?php if ((true && (true && null !== ($_smarty_tpl->getValue('form')['interest'] ?? null))) && $_smarty_tpl->getValue('form')['interest'] == '2') {?>selected<?php }?>>2%</option>
                    <option value="4" <?php if ((true && (true && null !== ($_smarty_tpl->getValue('form')['interest'] ?? null))) && $_smarty_tpl->getValue('form')['interest'] == '4') {?>selected<?php }?>>4%</option>
                    <option value="6" <?php if ((true && (true && null !== ($_smarty_tpl->getValue('form')['interest'] ?? null))) && $_smarty_tpl->getValue('form')['interest'] == '6') {?>selected<?php }?>>6%</option>
                    <option value="8" <?php if ((true && (true && null !== ($_smarty_tpl->getValue('form')['interest'] ?? null))) && $_smarty_tpl->getValue('form')['interest'] == '8') {?>selected<?php }?>>8%</option>
                </select>
                </div>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" value="Oblicz ratę" class="button alt" /></li>
                    </ul>
                </div>
            </div>
        </form>

        <?php if ((true && ($_smarty_tpl->hasVariable('res') && null !== ($_smarty_tpl->getValue('res') ?? null)))) {?>
            <div style="margin-top: 30px; padding: 20px; background: #ebed6a; border-radius: 5px; color: #333;">
                <h3 style="margin: 0;">
                    Miesięczna rata: 
                    <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('res'),2,","," ");?>
 PLN</strong>
                </h3>
            </div>
        <?php }?>
    </section>
</article>
<?php
}
}
/* {/block 'content'} */
}
