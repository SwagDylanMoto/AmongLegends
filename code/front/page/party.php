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
    <div class="fill"></div>
    <div class="help-dropdown-container">
        <img class="help-icon" src="<?php echo(Config::$baseUrl) ?>/resources/img/confused.png"/>
        <div class="dropdown">
            <p class="title">Explication des rôles:</p>
            <select class="input-select" id="help-select">
                <?php
                    $roles = SingletonRegistry::$registry['Roles']->rolesEnum;
                    foreach ($roles as $role) {
                        echo("
                            <option value='".$role."'>".$role."</option>
                        ");
                    }
                ?>
            </select>
            <div class="role-explication-container">
                <div class="role-header">
                    <img class="role-img" id="role-img" src=""/>
                    <div class="role-title-container">
                        <p class="role-title" id="role-title"></p>
                        <p class="role-subtitle" id="role-subtitle"></p>
                    </div>
                </div>
                <p class="role-explication" id="role-explication"></p>
            </div>
        </div>
    </div>
</div>
<div class="page-content" id="page-content"
     nickname="<?php echo(SingletonRegistry::$registry['SessionManager']->currentSessionDTO->nickname) ?>"
     admin="<?php echo(SingletonRegistry::$registry['SessionManager']->currentSessionDTO->admin ? 'true' : 'false') ?>">

</div>
<script type="module" src="<?php echo(Config::$baseUrl) ?>/resources/js/party/main.js"></script>
<script type="module" src="<?php echo(Config::$baseUrl) ?>/resources/js/party/help.js"></script>
<script>
    const copyButton = document.getElementById('copy-button');
    if (!window.isSecureContext) {
        copyButton.disabled = true;
    }
</script>