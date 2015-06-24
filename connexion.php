<!doctype html>
<html>
<?php
   include "includes/head.php";
?>

    <body>
        <div class="wrap">
            <h4>S'IDENTIFIER</h4>

            <div class="flick-form_grid">
                <form method="post" action="" name="newletter">
                    <input type="text" class="textbox" placeholder="Votre Login" name="lelogin" required>
                    <input type="text" class="textbox" placeholder="Mot de passe" name="lepswd" required >
                    <div class="smt">
                        <input type="submit" value="S'identifier">
                    </div>
                    <?php
                    //Si il y a une erreur lors de loggage
                    if (isset($error_connect)) {
                        echo $error_connect;
                    }
                    ?>
                </form>
            </div>


        </div>
    </body>
</html>