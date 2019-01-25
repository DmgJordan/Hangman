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
    </head>
    <body>
        
        
        <form method="post" action="pendu.php">
            <input type="text" name="motAtrouver" />
            <input type="submit" id="send" value="Envoyer" />
        </form>
    </body>
</html>
