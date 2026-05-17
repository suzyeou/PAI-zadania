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