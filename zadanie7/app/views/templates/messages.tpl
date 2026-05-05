{if $msgs->isMessage()}
<div class="box" style="background-color: #ff9191; border-radius: 5px; padding: 1em; margin-bottom: 2em; color: #fff;">
    <ol style="margin: 0; padding-left: 2em; color: #fff;">
    {foreach $msgs->getMessages() as $msg}
        <li style="margin-bottom: 0.5em;">{$msg->text}</li>
    {/foreach}
    </ol>
</div>
{/if}