<?php
include ("conecao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf8">
        <title>Registrar</title>
    </head>
    <body>
        <form action="mailsend.php" method="post">
            <fieldset>
                <label for="email">E-mail: </label>
                <input required name="email" type="email">
            </fieldset>
            <fieldset>
                <button type="submit">Enviar</button>
            </fieldset>
        </form>
    </body>
</html>

