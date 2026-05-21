{extends file="main.tpl"}

{block name="content"}
<div style="padding: 2em 0;">
    <h2 style="font-weight: bold; margin-bottom: 0.2em; color: #555;">PANEL ADMINISTRATORA</h2>
    <p style="color: #aaa; margin-bottom: 2em; text-transform: uppercase; font-size: 0.85em; letter-spacing: 1px; font-weight: bold;">Zarządzanie strukturą techniczną systemu, użytkownikami i katalogiem nastrojów.</p>

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

    {if $msgs->isInfo()}
        <div class="messages" style="margin: 0 0 1.5em 0; padding: 1em; border-radius: 4px; border: 1px solid #2ecc71; background-color: #f4fbf7; color: #27ae60;">
            <h4 style="margin-bottom: 0.8em; font-weight: bold; color: #27ae60; display: flex; align-items: center;">
                <span style="margin-right: 0.5em; font-size: 1.2em;">✓</span> SUKCES:
            </h4>
            <ul style="margin: 0; padding-left: 1em; color: #27ae60; font-size: 0.9em; list-style-type: square;">
            {foreach $msgs->getMessages() as $msg}
                <li style="margin-bottom: 0.4em;">{$msg->text}</li>
            {/foreach}
            </ul>
        </div>
    {/if}

    <div style="background: #fff; padding: 1.5em; border: 1px solid #dbdbdb; border-radius: 4px; margin-bottom: 2em;">
        <h4 style="margin-bottom: 0.8em; font-weight: bold; font-size: 0.85em; color: #555; text-transform: uppercase; letter-spacing: 0.5px;">Dodaj nowy nastrój do globalnego katalogu</h4>
        <form method="post" action="{$conf->action_url}moodSave" style="margin: 0;">
            <div style="display: flex; gap: 10px;">
                <input type="text" name="name" placeholder="Wpisz nazwę emocji / nastroju (np. Melancholia, Euforia)..." style="flex: 1; height: 2.8em; padding: 0 0.8em; background: #fff; font-size: 0.9em; margin: 0; border: 1px solid #dbdbdb; border-radius: 4px; box-shadow: none;">
                <button type="submit" class="button" style="height: 2.8em; line-height: 2.8em; padding: 0 1.5em; font-size: 0.85em; background-color: #bdc3c7; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; box-shadow: none; text-transform: uppercase;">+ DODAJ NASTRÓJ</button>
            </div>
        </form>
    </div>

    <div class="row gtr-100">
        
        <div class="col-4 col-12-small">
            <div style="background: #fff; padding: 1em; border: 1px solid #dbdbdb; border-radius: 4px;">
                <h3 style="margin-bottom: 0.8em; font-weight: bold; border-bottom: 2px solid #f5f5f5; padding-bottom: 0.2em; font-size: 1.05em;">Katalog nastrojów</h3>
                
                <form id="mood-search-form" onsubmit="ajaxPostForm('mood-search-form','{$conf->action_url}adminViewPart','table-mood-container'); return false;" style="margin-bottom: 1em; display: flex; gap: 5px;">
                    <input type="text" name="searchMood" value="{$searchMood}" placeholder="Szukaj nastroju..." style="height: 2em; padding: 0 0.5em; font-size: 0.85em; flex: 1; margin: 0; border: 1px solid #dbdbdb; border-radius: 3px; box-shadow: none;">
                    <button type="submit" style="padding: 0 0.8em; height: 2em; font-size: 0.85em; background: #34495e; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-weight: bold;">Filtruj</button>
                    <a href="{$conf->action_url}adminView" style="padding: 0 0.8em; height: 2em; line-height: 2em; font-size: 0.85em; background: #e74c3c; color: #fff; border-radius: 3px; text-decoration: none; text-align: center; font-weight: bold;">X</a>
                </form>

                <div id="table-mood-container" style="overflow-x: auto; margin-bottom: 0;">
                    {include file="AdminMoodTable.tpl"}
                </div>
            </div>
        </div>

        <div class="col-8 col-12-small">
            <div style="background: #fff; padding: 1em; border: 1px solid #dbdbdb; border-radius: 4px;">
                <h3 style="margin-bottom: 0.8em; font-weight: bold; border-bottom: 2px solid #f5f5f5; padding-bottom: 0.2em; font-size: 1.05em;">Użytkownicy systemu</h3>
                
                <div class="table-wrapper" style="overflow-x: auto; margin-bottom: 1em;">
                    <table class="default" style="width: 100%; font-size: 0.85em; margin-bottom: 0;">
                        <thead>
                            <tr style="background-color: #f5f5f5; border-bottom: 2px solid #dbdbdb;">
                                <th style="padding: 0.4em; font-weight: bold; text-align: left; width: 35%;">Użytkownik (Login)</th>
                                <th style="padding: 0.4em; font-weight: bold; text-align: left; width: 35%;">Hasło użytkownika</th>
                                <th style="padding: 0.4em; font-weight: bold; text-align: center; width: 30%;">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                        {foreach $users as $u}
                            <tr style="border-bottom: 1px solid #e0e0e0;">
                                <form id="user-form-{$u['idUser']}" class="user-row-form" data-id="{$u['idUser']}" method="post" action="{$conf->action_url}userSave">
                                    <input type="hidden" name="idUser" value="{$u['idUser']}">
                                    
                                    <td style="padding: 0.4em; vertical-align: middle; color: #333; font-weight: bold;">{$u['login']}</td>
                                    <td style="padding: 0.4em; vertical-align: middle;">
                                        <span id="view-pass-{$u['idUser']}" style="color: #999; font-style: italic; font-size: 0.9em;">••••••••</span>
                                        <input type="password" id="edit-pass-{$u['idUser']}" name="password" placeholder="Wpisz nowe hasło..." style="display: none; height: 1.8em; padding: 0 0.4em; background: #fff; font-size: 1em; width: 100%; margin: 0; box-shadow: none; border: 1px solid #dbdbdb;">
                                    </td>
                                    <td style="padding: 0.4em; text-align: center; vertical-align: middle; white-space: nowrap;">
                                        <div id="btn-group-view-{$u['idUser']}">
                                            <a class="button small" href="javascript:void(0);" onclick="toggleUserEdit({$u['idUser']}, true)" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #3498db; color: #fff; box-shadow: none; border-radius: 3px; margin-right: 3px;">Zmień hasło</a>
                                            <a class="button small" href="{$conf->action_url}userDelete&idUser={$u['idUser']}" onclick="return confirm('Czy chcesz bezpowrotnie usunąć konto {$u['login']}?')" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #e74c3c; color: #fff; box-shadow: none; border-radius: 3px;">Usuń</a>
                                        </div>
                                        <div id="btn-group-edit-{$u['idUser']}" style="display: none;">
                                            <button type="submit" class="button small" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #2ecc71; color: #fff; box-shadow: none; border-radius: 3px; margin-right: 3px; border: none; cursor: pointer;">Zapisz</button>
                                            <a class="button small" href="javascript:void(0);" onclick="toggleUserEdit({$u['idUser']}, false)" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #95a5a6; color: #fff; box-shadow: none; border-radius: 3px;">Anuluj</a>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="3" style="padding: 1em; text-align: center; color: #999; font-style: italic;">Brak użytkowników.</td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>

                {if $totalPages > 1}
                <div style="display: flex; justify-content: center; align-items: center; gap: 5px; margin-top: 1em;">
                    {if $currentPage > 1}
                        <a href="{$conf->action_url}adminView&page={$currentPage-1}" style="padding: 0.2em 0.6em; background: #f5f5f5; border: 1px solid #dbdbdb; border-radius: 3px; font-size: 0.85em; text-decoration: none; color: #333; font-weight: bold;">&laquo; Poprzednia</a>
                    {/if}
                    <span style="font-size: 0.85em; color: #666; padding: 0 1em;">Strona <strong>{$currentPage}</strong> z {$totalPages}</span>
                    {if $currentPage < $totalPages}
                        <a href="{$conf->action_url}adminView&page={$currentPage+1}" style="padding: 0.2em 0.6em; background: #f5f5f5; border: 1px solid #dbdbdb; border-radius: 3px; font-size: 0.85em; text-decoration: none; color: #333; font-weight: bold;">Następna &raquo;</a>
                    {/if}
                </div>
                {/if}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function toggleUserEdit(id, showEdit) {
    if(showEdit) {
        var allForms = document.querySelectorAll('.user-row-form');
        allForms.forEach(function(f) {
            var fId = f.getAttribute('data-id');
            if (fId != id) {
                document.getElementById('edit-pass-'+fId).style.display = 'none';
                document.getElementById('btn-group-edit-'+fId).style.display = 'none';
                document.getElementById('view-pass-'+fId).style.display = 'block';
                document.getElementById('btn-group-view-'+fId).style.display = 'block';
            }
        });
        document.getElementById('view-pass-'+id).style.display = 'none';
        document.getElementById('btn-group-view-'+id).style.display = 'none';
        document.getElementById('edit-pass-'+id).style.display = 'block';
        document.getElementById('btn-group-edit-'+id).style.display = 'block';
    } else {
        document.getElementById('edit-pass-'+id).style.display = 'none';
        document.getElementById('btn-group-edit-'+id).style.display = 'none';
        document.getElementById('view-pass-'+id).style.display = 'block';
        document.getElementById('btn-group-view-'+id).style.display = 'block';
    }
}

function toggleMoodEdit(id, showEdit) {
    if(showEdit) {
        document.getElementById('view-mood-name-'+id).style.display = 'none';
        document.getElementById('btn-mood-view-'+id).style.display = 'none';
        document.getElementById('edit-mood-name-'+id).style.display = 'block';
        document.getElementById('btn-mood-edit-'+id).style.display = 'block';
    } else {
        document.getElementById('edit-mood-name-'+id).style.display = 'none';
        document.getElementById('btn-mood-edit-'+id).style.display = 'none';
        document.getElementById('view-mood-name-'+id).style.display = 'block';
        document.getElementById('btn-mood-view-'+id).style.display = 'block';
    }
}
</script>
{/block}