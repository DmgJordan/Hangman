<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pendu</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="steelsheet" href="style.css">
    </head>
    <body>

        <div class="container">
            <!-- Page Content goes here -->
            <h2 class="center blue-text text-darken-2">Le Pendu</h2>
            <span class="flow-text">Entrez un mot pour jouer : </span>
            <form method="post" action="pendu.php">
                <input type="text" name="motAtrouver" pattern="[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ\-\']+" required />
                <input class=" btn waves-effect waves-light card-panel blue darken-2" type="submit" id="send" value="Envoyer" />
            </form>
        </div>
    </body>

</html>
