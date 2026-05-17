{if empty($songs)}
    <p style="text-align: center; margin: 0; padding: 2em; background: #fff; color: #777; font-style: italic;">Brak utworów w bazie danych lub żaden nie spełnia kryteriów wyszukiwania.</p>
{else}
    <div class="table-wrapper" style="margin: 0; overflow-x: auto;">
        <table class="default" style="width: 100%; margin-bottom: 0; border-collapse: collapse; font-size: 0.9em;">
            <thead>
                <tr style="background-color: #f5f5f5; border-bottom: 2px solid #dbdbdb;">
                    <th style="padding: 0.5em 0.75em; font-weight: bold; text-align: left; color: #555;">Tytuł utworu</th>
                    <th style="padding: 0.5em 0.75em; font-weight: bold; text-align: left; color: #555;">Wykonawca</th>
                    <th style="padding: 0.5em 0.75em; font-weight: bold; text-align: left; color: #555; width: 220px;">Nastrój (Skala)</th>
                    <th style="padding: 0.5em 0.75em; font-weight: bold; text-align: center; width: 160px;">Akcje</th>
                </tr>
            </thead>
            <tbody>
            {foreach $songs as $s}
                <tr style="border-bottom: 1px solid #e0e0e0;">
                    <td style="padding: 0.5em 0.75em; vertical-align: middle; word-break: break-all; color: #333;">{$s['title']}</td>
                    <td style="padding: 0.5em 0.75em; vertical-align: middle; word-break: break-all; color: #333;">{$s['artist']}</td>
                    <td style="padding: 0.5em 0.75em; vertical-align: middle;">
                        <span style="background: #e1f5fe; color: #0288d1; padding: 0.15em 0.5em; border-radius: 3px; font-size: 0.85em; font-weight: bold; border: 1px solid #b3e5fc; display: inline-block; white-space: nowrap;">
                            {$s['mood_name']} ({$s['intensity']}/10)
                        </span>
                    </td>
                    <td style="padding: 0.5em 0.75em; text-align: center; vertical-align: middle;">
                        <a class="button alt small" href="{$conf->action_url}songEdit&idSong={$s['idSong']}" style="padding: 0 0.6em; height: 2em; line-height: 2em; font-size: 0.8em; margin-right: 0.25em; border-radius: 3px; display: inline-block;">Edytuj</a>
                        <a class="button small" href="{$conf->action_url}songDelete&idSong={$s['idSong']}" onclick="return confirm('Czy na pewno chcesz usunąć ten utwór?');" style="padding: 0 0.6em; height: 2em; line-height: 2em; font-size: 0.8em; background-color: #e74c3c; color: #fff; box-shadow: none; border-radius: 3px; display: inline-block;">Usuń</a>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>

    {if $totalPages > 1}
        <div style="text-align: center; margin-top: 1.5em; background: #f9f9f9; padding: 0.5em; border: 1px solid #dbdbdb; border-radius: 4px;">
            {if $page > 1}
                <a class="button alt small" href="javascript:void(0);" onclick="ajaxPostForm('search-form','{$conf->action_url}userViewPart&page={$page-1}','table-container')" style="padding: 0 0.75em; height: 2.2em; line-height: 2.2em; font-size: 0.8em; box-shadow: none; margin-right: 0.5em; color: #fff !important;">&laquo; Poprzednia</a>
            {/if}

            {for $i=1 to $totalPages}
                {if $i == $page}
                    <span style="display: inline-block; padding: 0 0.75em; height: 2.2em; line-height: 2.2em; font-size: 0.8em; font-weight: bold; background: #0288d1; color: #fff !important; border-radius: 3px; margin: 0 0.2em;">{$i}</span>
                {else}
                    <a class="button alt small" href="javascript:void(0);" onclick="ajaxPostForm('search-form','{$conf->action_url}userViewPart&page={$i}','table-container')" style="padding: 0 0.75em; height: 2.2em; line-height: 2.2em; font-size: 0.8em; box-shadow: none; margin: 0 0.2em; background: #fff; color: #333 !important;">{$i}</a>
                {/if}
            {/for}

            {if $page < $totalPages}
                <a class="button alt small" href="javascript:void(0);" onclick="ajaxPostForm('search-form','{$conf->action_url}userViewPart&page={$page+1}','table-container')" style="padding: 0 0.75em; height: 2.2em; line-height: 2.2em; font-size: 0.8em; box-shadow: none; margin-left: 0.5em; color: #fff !important;">Następna &raquo;</a>
            {/if}
        </div>
        <p style="text-align: center; font-size: 0.8em; color: #777; margin-top: 0.5em;">Strona {$page} z {$totalPages}</p>
    {/if}
{/if}