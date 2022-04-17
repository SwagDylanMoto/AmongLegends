<div>
    <a href="./logout">Quitter</a>
    <p><?php
        echo(Config::$baseUrl .
            '/login?party=' .
            SingletonRegistry::$registry['PartyService']->get(
                    SingletonRegistry::$registry['SessionManager']->currentSessionDTO->partyId
            )->code
        )
        ?></p>
</div>
<div id="page-content">

</div>
<script type="module" src="<?php echo(Config::$baseUrl) ?>/resources/js/party/main.js"></script>