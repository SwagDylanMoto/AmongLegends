<div class="page-header">
    <a class="button cancel" href="<?php echo(Config::$baseUrl) ?>/logout">Quitter</a>
    <div class="link-to-copy">
        <p id="link-to-copy"><?php
            echo(Config::$baseUrl .
                '/login?party=' .
                SingletonRegistry::$registry['PartyService']->get(
                        SingletonRegistry::$registry['SessionManager']->currentSessionDTO->partyId
                )->code
            )
            ?></p>
        <button class="button" id="copy-button"
                onclick="navigator.clipboard.writeText(getElementById('link-to-copy').innerHTML)">
            Copier
        </button>
    </div>
</div>
<div class="page-content" id="page-content"
     nickname="<?php echo(SingletonRegistry::$registry['SessionManager']->currentSessionDTO->nickname) ?>"
     admin="<?php echo(SingletonRegistry::$registry['SessionManager']->currentSessionDTO->admin ? 'true' : 'false') ?>">

</div>
<script type="module" src="<?php echo(Config::$baseUrl) ?>/resources/js/party/main.js"></script>
<script>
    const copyButton = document.getElementById('copy-button');
    if (!window.isSecureContext) {
        copyButton.disabled = true;
    }
</script>