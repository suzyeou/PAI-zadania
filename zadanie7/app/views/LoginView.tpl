{extends file="main.tpl"}

{block name=content}
<article class="box post">
    <header>
        <h2>Logowanie</h2>
        <p>Zaloguj się, aby zarządzać swoim dziennikiem muzycznym</p>
    </header>

    {include file="messages.tpl"}

    <form action="{$conf->action_url}login" method="post" class="style1">
        <div class="row gtr-50">
            <div class="col-6 col-12-mobile">
                <label for="id_login">Login:</label>
                <input type="text" name="login" id="id_login" value="{$form->login}" placeholder="Twój login..." />
            </div>
            <div class="col-6 col-12-mobile">
                <label for="id_pass">Hasło:</label>
                <input type="password" name="pass" id="id_pass" placeholder="Twoje hasło..." />
            </div>
            <div class="col-12">
                <ul class="actions">
                    <li><input type="submit" value="Zaloguj" class="button alt" /></li>
                    <li><a href="{$conf->action_url}registerView" class="button low">Nie masz konta? Zarejestruj się</a></li>
                </ul>
            </div>
        </div>
    </form>

</article>
{/block}