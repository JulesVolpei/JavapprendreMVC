<?php
$indiceExo = $A_vue['Indice'];
if (isset($indiceExo['indice'])) {
    $indices = $indiceExo['indice'];
}
$resultats = $A_vue['ExoChoisi'];
$idExo = $_SESSION['id_exo'];


$numFichiersTests = $resultats['numFichiersTests'];
//getting all the test files as a single string:

$chemin_fichier_test = $A_vue['Tests'];
//splitting the test files into an array:
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exercice</title>
    <link rel = "stylesheet" type = "text/css" href = "/css/choixExercice.css">
    <link rel = "stylesheet" type = "text/css" href = "/prism/prism.css">


    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
    <link rel =  "stylesheet" type = "text/css" href = "/css/exercice.css">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        var n = "<?php echo"$numFichiersTests"?>";
        for(let i = 0; i < n; ++i)
        {
            //console.log("#dialog-"+i);
            //console.log($("dialog-"+i));
            $(function() {
                $( "#dialog-"+i).dialog({
                    autoOpen: false,
                    modal: true,
                    draggable: false,
                    height: 400,
                    width: 600,
                    resizeable: false,
                    buttons: {
                        OK: function() {$(this).dialog("close");}
                    },
                });
                $( "#opener-"+i).click(function() {
                    console.log("clicked");
                    $( "#dialog-"+i).dialog( "open" );
                });
            });
        }
    </script>
</head>
<body>
<body>
<!--Navigation bar -->
<section class="navigation">
    <div class="nav-container">
        <div class="image-container">
            <a href="index.php"><img class="logo-imagetest" src="images/logo1.png" alt="Logo"></a>
        </div>
        <div class="affichage-temps">
            <div name="affi" id="time"></div>
            <div class="image-chrono"><img src="images/chrono.png"></div>
        </div>
        <div id = "nom_exo" data-id="<?php echo $idExo; ?>">
            <?php
            $ind = $idExo + 1;
            echo $ind." - ".$resultats['description_exo']; ?>
        </div>

        <!--<a href="#" class="bn14">Indice</a>-->
    </div>
</section>
<!-- Form for inserting code -->
<div class = "form-code">
    <a href="#" class="brese" onclick = "javascript:reset_code();"> Reset </a>

    <label for="editing"></label><textarea id = "editing" spellcheck = "false" autocomplete = "off" oninput  = "update(this.value); sync_scroll(this);" onscroll="sync_scroll(this);" onkeydown="check_tab(this, event);"><?php echo $resultats['text_de_base'] ?></textarea>
    <!-- Pre and code tags because otherwise we can not use Prism.js in a textarea-->

    <pre id = "highlighting" aria-hidden = "true"><code class = "language-java" id = "highlighting-content"></code></pre>

    <!-- Execute code button -->
    <a href = "#" class = "brese" onclick = "executeCode(0, this)">Run </a>

</div>
<!-- Rendu visuel -->

<?php if ($idExo > 5) {
    echo '<div class = "exo-prof"><img src="css/images/crayon.png"></div>';
 }
else {
    echo '<div class = "visuel"></div>';
 }?>

<!-- Console -->
<div class="output">Output</div>
<!-- Objectif -->
<div class = "float-container">
    <div class = "objectif float-child"><?php echo $resultats['objectif_exo'] ?></div>
    <!-- Tests unitaires-->
    <div class = "test float-child">
        <?php
        for($x = 1; $x < $numFichiersTests; ++$x)
        {
            echo '<br><div class = "test-child">Test ' . $chemin_fichier_test[$x]['fichier'] .'<div class = "sign" id = "test-'.$x.'"></div><div id = "dialog-'.$x.'" title = "Indice exo">'.$indiceExo[$x - 1]['indice'].'</div> <button id = "opener-'.$x.'" class = "bn15">Voir indice</button><button class = "bn15" onclick = "executeCode('.$x. ', this)">Run</button></div><br>';

        }
        ?>

    </div>
    <!--Tests unitaires -->
</div>

<script src = "/js/exercice.js"> </script>
<script src = "/js/chronometre.js"> </script>
<!-- Script for Prism.js library -->
<script src = "/prism/prism.js"></script>
<!-- JQUERY -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->

</body>
</html>