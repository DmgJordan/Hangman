<?php
session_start();

function skip_accents($str, $charset = 'utf-8') {                               //

    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

if (isset($_POST['motAtrouver'])) {                                 
    $unionTcheck = strpos($_POST['motAtrouver'], "-");
    $apostropheTcheck = strpos($_POST['motAtrouver'], "'");
    $mot = skip_accents($_POST['motAtrouver']);

    $_SESSION['mot'] = $mot;
}


$nblettre = strlen($mot);
$letterArray = array();
$i = 0;
while ($i != $nblettre) {


    $letterArray[$i] = "_ ";
    if ($unionTcheck != 0) {
        if ($unionTcheck == $i) {

            $letterArray[$i] = "-";
        }
    }

    if ($apostropheTcheck != 0) {
        if ($apostropheTcheck == $i) {

            $letterArray[$i] = "'";
        }
    }

    $i++;
}

$hiddenWord = "";
$i = 0;

foreach ($letterArray as $letter) {
    $hiddenWord .= "<span style='font-size:3em; text-align=center;' id=" . $i . ">$letter</span>";
    $i++;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <style>

        </style>

    </head>
    <body>



        <div class="container center ">
            <h2 class="center blue-text text-darken-2">Le Pendu</h2>
            <div class="container">
<?= ($hiddenWord) ?>
            </div><a class="waves-effect waves-light btn card-panel blue darken-2" href="index.php">Nouveau Mot</a>
            <h6 id="requestajax"><h6/>
                <div class="raw">
                    </BR><button class="btn waves-effect waves-light card-panel blue darken-2"  type="button" id="A">A</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="Z">Z</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="E">E</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="R">R</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="T">T</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="Y">Y</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="U">U</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="I">I</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="O">O</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="P">P</button></BR>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="Q">Q</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="S">S</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="D">D</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="F">F</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="G">G</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="H">H</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="J">J</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="K">K</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="L">L</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="M">M</button></BR>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="W">W</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="X">X</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="C">C</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="V">V</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="B">B</button>
                    <button class="btn waves-effect waves-light card-panel blue darken-2" type="button" id="N">N</button></BR>
                </div>
                <img id ="img" src="img/pendu0.png" alt="HangmanState" height="250" width="250" ></img>
        </div>
        <script>
            loseTcheck = 0;
            winTcheck = 0;
            $("button").click(function () {
                var lettre = $(this).attr('id');
                var x = false;

                $('#' + lettre + '').attr('disabled', 'true');

                $.post(
                        "JsonTransition.php",
                        {
                            letter: $(this).text()
                        },
                        function (data) {
                            var mot = JSON.parse(data);
                            var lgtMot = mot.length;
                            var letter = $(this).attr('id');
                            var texte = "";


                            //$('#requestajax').html(texte)
                            var MajMot = mot.toUpperCase();
                            var splitMot = MajMot.split("");
                            i = 0;
                            letterRepetition = 0;
                            for (let test in splitMot) {
                                if (splitMot[test] === "-" || splitMot[test] === "'") {
                                    lgtMot--;
                                }

                                if (splitMot[test] === lettre) {

                                    document.getElementById(i).innerHTML = splitMot[test];
                                    letterRepetition++;
                                    x = true;

                                }
                                i++;
                            }
                            if (x === false) {
                                loseTcheck++;
                                $('#img').attr('src', 'img/pendu' + loseTcheck + '.png');
                                if (loseTcheck === 8) {
                                    $('#requestajax').html("Perdu, vous n'avez pas trouvé : " + mot);
                                    $('button').attr('disabled', 'true');
                                }
                            } else {
                                winTcheck += letterRepetition;
                            }
                            if (winTcheck === lgtMot) {
                                $('#requestajax').html('Gagné');
                                $('button').attr('disabled', 'true');
                            }


                        });
            });
        </script>

    </body>

</html>
