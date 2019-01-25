<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $mot = $_POST['motAtrouver'];
        $nblettre = strlen($mot);
        while ($nblettre != 0){
            $nblettre--;
            echo "_ ";
        } 
        
        
        ?>
    </body>
</html>
