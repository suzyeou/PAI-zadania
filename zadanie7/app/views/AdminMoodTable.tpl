<table class="default" style="width: 100%; font-size: 0.85em; margin-bottom: 0; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f5f5f5; border-bottom: 2px solid #dbdbdb;">
            <th style="padding: 0.4em; font-weight: bold; text-align: left;">Nazwa nastroju</th>
            <th style="padding: 0.4em; font-weight: bold; text-align: center; width: 110px;">Akcje</th>
        </tr>
    </thead>
    <tbody>
    {foreach $moods as $m}
        <tr style="border-bottom: 1px solid #e0e0e0;">
            <form id="mood-form-{$m['idMood']}" method="post" action="{$conf->action_url}moodSave">
                <input type="hidden" name="idMood" value="{$m['idMood']}">
                <td style="padding: 0.4em; vertical-align: middle; color: #333;">
                    <span id="view-mood-name-{$m['idMood']}">{$m['name']}</span>
                    <input type="text" id="edit-mood-name-{$m['idMood']}" name="name" value="{$m['name']}" style="display: none; height: 1.8em; padding: 0 0.4em; background: #fff; font-size: 1em; width: 100%; margin: 0; box-shadow: none; border: 1px solid #dbdbdb;">
                </td>
                <td style="padding: 0.4em; text-align: center; vertical-align: middle; white-space: nowrap;">
                    <div id="btn-mood-view-{$m['idMood']}">
                        <a class="button small" href="javascript:void(0);" onclick="toggleMoodEdit({$m['idMood']}, true)" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #3498db; color: #fff; box-shadow: none; border-radius: 3px; margin-right: 3px;">Edytuj</a>
                        <a class="button small" href="{$conf->action_url}moodDelete&idMood={$m['idMood']}" onclick="return confirm('Czy na pewno chcesz usunąć nastrój: {$m['name']}?')" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #e74c3c; color: #fff; box-shadow: none; border-radius: 3px;">Usuń</a>
                    </div>
                    <div id="btn-mood-edit-{$m['idMood']}" style="display: none;">
                        <button type="submit" class="button small" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #2ecc71; color: #fff; box-shadow: none; border-radius: 3px; margin-right: 3px; border: none; cursor: pointer;">Zapisz</button>
                        <a class="button small" href="javascript:void(0);" onclick="toggleMoodEdit({$m['idMood']}, false)" style="padding: 0 0.5em; height: 1.6em; line-height: 1.6em; font-size: 0.85em; background-color: #95a5a6; color: #fff; box-shadow: none; border-radius: 3px;">Anuluj</a>
                    </div>
                </td>
            </form>
        </tr>
    {foreachelse}
        <tr>
            <td colspan="2" style="padding: 1em; text-align: center; color: #999; font-style: italic;">Brak nastrojów.</td>
        </tr>
    {/foreach}
    </tbody>
</table>