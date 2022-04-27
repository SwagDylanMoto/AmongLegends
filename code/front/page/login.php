<div class="login-page">
    <form class="form" action="" method="post">
        <h4 class="title">Connecte toi pd</h4>
        <label for="nickname">Nickname :</label>
        <input type="text" name="nickname" id="nickname" value="<?php echo($_SESSION['nickname']) ?>"/>
        <br/>
        <?php
            if ($_GET["party"]) {
                echo('<input class="button" type="submit" value="Rejoindre">');
            } else {
                echo('<input class="button" type="submit" value="Créer une partie">');
            }
        ?>
        <?php
        if (SingletonRegistry::$registry['SessionManager']->currentSessionDTO) {
            echo('
                <a class="button" href="./party">Reprendre</a>
            ');
        }
        ?>
    </form>
</div>