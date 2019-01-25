<?php session_start();?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
    </head>
    <body>
        <?php
            if (isset($_POST['motAtrouver'])){
                $_SESSION['mot']=$_POST['motAtrouver'];
            }
            

//$nblettre = strlen($_POST['motAtrouver']);
//while ($nblettre != 0){
//            $nblettre--;
//            echo "_ ";
//        } 

            
            
        ?>
        <div id="requestajax"></div>
        </BR><button type="button" id="A">A</button>
        <button type="button" id="Z">Z</button>
        <button type="button" id="E">E</button>
        <button type="button" id="R">R</button>
        <button type="button" id="T">T</button>
        <button type="button" id="Y">Y</button>
        <button type="button" id="U">U</button>
        <button type="button" id="I">I</button>
        <button type="button" id="O">O</button>
        <button type="button" id="P">P</button></BR>
        <button type="button" id="Q">Q</button>
        <button type="button" id="S">S</button>
        <button type="button" id="D">D</button>
        <button type="button" id="F">F</button>
        <button type="button" id="G">G</button>
        <button type="button" id="H">H</button>
        <button type="button" id="J">J</button>
        <button type="button" id="K">K</button>
        <button type="button" id="L">L</button>
        <button type="button" id="M">M</button></BR>
        <button type="button" id="W">W</button>
        <button type="button" id="X">X</button>
        <button type="button" id="C">C</button>
        <button type="button" id="V">V</button>
        <button type="button" id="B">B</button>
        <button type="button" id="N">N</button>
    <script>

    $("button").click(function(){
        var lettre = $(this).attr('id');

        $.post (
          "test.php",
            {
              letter : $(this).text()
            },
            function(data) {
                
                var lgtMot = data.length -2 ;
                var letter = $(this).attr('id');
                var texte ="";
                
                while (lgtMot !=0){
                    lgtMot--;
                    texte = texte + "_ ";
                    
                }
                $('#requestajax').html(texte)
                var MajMot = data.toUpperCase();
                var splitMot = MajMot.split("");
                for (let test in splitMot){

                    if (splitMot[test]==lettre){
                        console.log(splitMot[test])
                    }
                }
                    
                
                
            })
        })    
    </script>
    
    </body>
    
</html>
