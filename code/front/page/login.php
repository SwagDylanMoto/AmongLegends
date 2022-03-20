<div class="content">
    <h4>Connecte toi pd</h4>
    <form action="" method="post">
        <label for="nickname">Nickname :</label>
        <input type="text" name="nickname" id="nickname"/>
        <br/>
        <?php
            if ($_GET["party"]) {
                echo('<input type="submit" value="Rejoindre">');
            } else {
                echo('<input type="submit" value="Créer une partie">');
            }
        ?>
    </form>
</div>