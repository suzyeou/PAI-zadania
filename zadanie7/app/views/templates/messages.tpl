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
        <ul style="margin: 0; padding: 0; list-style-type: none; font-size: 0.9em; font-weight: bold;">
        {foreach $msgs->getMessages() as $msg}
            <li>✓ {$msg->text}</li>
        {/foreach}
        </ul>
    </div>
{/if}