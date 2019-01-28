<?php
session_start();

function skip_accents($str, $charset = 'utf-8') {

    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

if (isset($_POST['motAtrouver'])) {
    $unionTcheck = strpos($_POST['motAtrouver'], "-");
    $_SESSION['mot'] = skip_accents($_POST['motAtrouver']);
}


$nblettre = strlen($_POST['motAtrouver']);
$letterArray = array();
$i=0;
while ($i != $nblettre) {

    
    $letterArray[$i]= "_ ";
    if (isset($unionTcheck)) {
        if ($unionTcheck == $i) {
            $letterArray[$i] = "-";
        }
    }
    $i++;
}
var_dump($letterArray);
$hiddenWord = "";
$i = 0;
foreach ($letterArray as $letter) {
    $hiddenWord .= "<p id=" . $i . ">$letter</p>";
    $i++;
}
echo $hiddenWord;
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>

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
        <button type="button" id="N">N</button></BR>

        <img id ="img" src="img/pendu0.png" alt="HangmanState" height="100" width="100" ></img>
        <script>
            j = 0;
            winTcheck = 0;
            $("button").click(function () {
                var lettre = $(this).attr('id');
                var x = false;

                $('#' + lettre + '').attr('disabled', 'true');
                j++;
                $.post(
                        "test.php",
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
                            b = 0;
                            for (let test in splitMot) {
                                if (splitMot[test]==="-"){
                                    lgtMot--;
                                }

                                if (splitMot[test] == lettre) {

                                    document.getElementById(i).innerHTML = splitMot[test];

                                    b++;

                                    x = true;

                                }
                                i++;
                            }
                            if (x === false) {
                                $('#img').attr('src', 'img/pendu' + j + '.png');
                                if (j == 8) {
                                    $('#requestajax').html('Perdu');
                                    $('button').attr('disabled', 'true');
                                }
                            } else {
                                winTcheck += b;
                            }
                            if (winTcheck === lgtMot) {
                                $('#requestajax').html('Gagné');
                                $('button').attr('disabled', 'true');
                            }
                            console.log(winTcheck);

                        });
            });
        </script>

    </body>

</html>
