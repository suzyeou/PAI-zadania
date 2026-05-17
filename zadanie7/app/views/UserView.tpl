{extends file="main.tpl"}

{block name=content}
<article class="box post">
    <header>
        <h2>Twój Dziennik Muzyczny</h2>
        <p>Tutaj znajdziesz swoje utwory przypisane do nastrojów.</p>
    </header>
</article>

{if $msgs->isError()}
    <div class="messages" style="margin: 0 0 1.5em 0; padding: 1em; border-radius: 4px; border: 1px solid #e74c3c; background-color: #fdf2f2; color: #c0392b;">
        <h4 style="margin-bottom: 0.8em; font-weight: bold; color: #c0392b; display: flex; align-items: center;">
            <span style="margin-right: 0.5em; font-size: 1.2em;">⚠</span> WYKRYTO BŁĘDY:
        </h4>
        <ul style="margin: 0; padding-left: 1em; color: #c0392b; font-size: 0.9em; list-style-type: square;">
        {foreach $msgs->getMessages() as $msg}
            <li style="margin-bottom: 0.4em;">{$msg->text}</li>
        {/foreach}
        </ul>
    </div>
{/if}

<div style="background: #fff; padding: 1.5em; border: 1px solid #dbdbdb; border-radius: 4px; margin-bottom: 2em;">
    <h3 style="margin-bottom: 1em; font-weight: bold;">
        {if empty($form->idSong)}Dodaj nową piosenkę{else}Edytuj utwór: "{$form->title}"{/if}
    </h3>
    
    <form action="{$conf->action_url}songSave" method="post" class="pure-form pure-form-stacked">
        <input type="hidden" name="idSong" value="{$form->idSong}">

        <div class="row gtr-50">
            <div class="col-3 col-12-small">
                <label for="title" style="font-weight: bold; font-size: 0.85em; margin-bottom: 0.25em;">Tytuł utworu:</label>
                <input type="text" id="title" name="title" value="{$form->title}" style="width: 100%; height: 2.5em;">
            </div>
            <div class="col-3 col-12-small">
                <label for="artist" style="font-weight: bold; font-size: 0.85em; margin-bottom: 0.25em;">Wykonawca:</label>
                <input type="text" id="artist" name="artist" value="{$form->artist}" style="width: 100%; height: 2.5em;">
            </div>
            <div class="col-3 col-12-small">
                <label for="idMood" style="font-weight: bold; font-size: 0.85em; margin-bottom: 0.25em;">Twój nastrój:</label>
                <select id="idMood" name="idMood" style="width: 100%; height: 2.5em; line-height: 2.5em; padding: 0 0.75em; background: #fff;">
                    <option value="">Wybierz</option>
                    {foreach $moods as $m}
                        <option value="{$m['idMood']}" {if $form->idMood == $m['idMood']}selected{/if}>{$m['name']}</option>
                    {/foreach}
                </select>
            </div>
            <div class="col-3 col-12-small">
                <label for="intensity" style="font-weight: bold; font-size: 0.85em; margin-bottom: 0.25em;">Intensywność (1-10):</label>
                <input type="text" id="intensity" name="intensity" value="{$form->intensity}" style="width: 100%; height: 2.5em; background: #fff;">
            </div>
        </div>
        
        <button type="submit" class="button alt small" style="margin-top: 1.25em; width: 100%; height: 2.8em; line-height: 2.8em; padding: 0;">
            {if empty($form->idSong)}Dodaj utwór do dziennika{else}Zapisz zmiany w utworze{/if}
        </button>
        
        {if !empty($form->idSong)}
            <a href="{$conf->action_url}userView" class="button small" style="margin-top: 0.5em; width: 100%; height: 2.8em; line-height: 2.8em; padding: 0; text-align: center; background: #999; color:#fff; box-shadow: none;">Anuluj edycję</a>
        {/if}
    </form>
</div>

<div style="background: #f9f9f9; padding: 1.25em; border: 1px solid #dbdbdb; border-radius: 4px; margin-bottom: 1em;">
    <form id="search-form" onsubmit="ajaxPostForm('search-form','{$conf->action_url}userViewPart','table-container'); return false;" class="pure-form">
        <div class="row gtr-50 aln-middle">
            <div class="col-4 col-12-small">
                <input type="text" name="sf_artist" placeholder="Szukaj po wykonawcy..." value="{$searchForm['artist']}" style="width: 100%; height: 2.5em; background: #fff;">
            </div>
            <div class="col-3 col-12-small">
                <select name="sf_mood" onchange="ajaxPostForm('search-form','{$conf->action_url}userViewPart','table-container')" style="width: 100%; height: 2.5em; line-height: 2.5em; padding: 0 0.75em; background: #fff;">
                    <option value="">Wszystkie nastroje</option>
                    {foreach $moods as $m}
                        <option value="{$m['idMood']}" {if $searchForm['idMood'] == $m['idMood']}selected{/if}>{$m['name']}</option>
                    {/foreach}
                </select>
            </div>
            <div class="col-3 col-12-small">
                <select name="sf_sort" onchange="ajaxPostForm('search-form','{$conf->action_url}userViewPart','table-container')" style="width: 100%; height: 2.5em; line-height: 2.5em; padding: 0 0.75em; background: #fff;">
                    <option value="date_desc" {if $searchForm['sort'] == 'date_desc'}selected{/if}>Data: od najnowszych</option>
                    <option value="date_asc" {if $searchForm['sort'] == 'date_asc'}selected{/if}>Data: od najstarszych</option>
                    <option value="artist_asc" {if $searchForm['sort'] == 'artist_asc'}selected{/if}>Wykonawca: A-Z</option>
                    <option value="artist_desc" {if $searchForm['sort'] == 'artist_desc'}selected{/if}>Wykonawca: Z-A</option>
                </select>
            </div>
            <div class="col-2 col-12-small">
                <button type="submit" class="button alt small" style="width: 100%; height: 2.5em; line-height: 2.5em; padding: 0;">Filtruj</button>
            </div>
        </div>
    </form>
</div>

<div id="table-container" style="background: #fff; border: 1px solid #dbdbdb; border-radius: 4px; overflow: hidden;">
    {include file="UserViewTable.tpl"}
</div>
{/block}