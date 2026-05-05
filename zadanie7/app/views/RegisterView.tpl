{extends file="main.tpl"}

{block name=content}
<article class="box post">
    <header>
        <h2>Rejestracja</h2>
        <p>Utwórz konto, aby zacząć katalogować piosenki</p>
    </header>

    {include file="messages.tpl"}

    <form action="{$conf->action_url}register" method="post" class="style1">
        <div class="row gtr-50">
            <div class="col-12">
                <label for="id_login">Login:</label>
                <input type="text" name="login" id="id_login" value="{$form->login}" />
            </div>
            <div class="col-6 col-12-mobile">
                <label for="id_pass">Hasło:</label>
                <input type="password" name="pass" id="id_pass" />
            </div>
            <div class="col-6 col-12-mobile">
                <label for="id_pass2">Powtórz hasło:</label>
                <input type="password" name="pass2" id="id_pass2" />
            </div>
            <div class="col-12">
                <ul class="actions">
                    <li><input type="submit" value="Zarejestruj się" class="button alt" /></li>
                </ul>
            </div>
        </div>
    </form>

</article>
{/block}