<?php
$exercice= $A_vue['exercice'];
?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="utf-8">
    <title>Modifier exercice</title>
    <link rel="icon" href="/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/creation_modif.css">
</head>

<body>

<a href="../choix_exercice.php"><img src="/images/logo.png" alt="Logo" class="logo"></a>
<form method="POST" action="index.php?url=Admin/modifierExercice&id_exo=<?php echo $_GET['id_exo']; ?>">

    <div class="all-container">
        <div class="left-flex-box">
            <div class="flex-container1">
                <label for="nom">Titre de l'exercice:</label><br>
                <textarea id="nom" name="nom" required="required"><?php echo $exercice['nom_exo'] ?></textarea><br>
            </div>
            <div class="flex-container2">
                <label for="description">Description de l'exercice:</label><br>
                <textarea id="description" name="description" required="required"><?php echo $exercice['description_exo']?></textarea><br>
            </div>
            <div class="flex-container3">
                <label for="objectifs">Objectifs de l'exercice:</label><br>
                <textarea id="objectifs" name="objectifs" required="required"><?php echo $exercice['objectif_exo']?></textarea><br>
            </div>
            <div class="button">
                <button name="modifier"> Confirmer la modification</button>
            </div>
        </div>
        <div class="right-flex-box">
            <div class="flex-container4">
                <label for="contenu">Contenu de l'exercice:</label></br>
                <textarea id="contenu" name="contenu" required="required"><?php echo $exercice['text_de_base']?></textarea><br>
            </div>
            <div class="flex-container5">
                <label for="testsUnitaires">Tests unitaires:</label></br>
                <textarea id="testsUnitaires" name="testsUnitaires" required="required"><?php echo $exercice['fichier_test']?></textarea><br>
            </div>
        </div>
    </div>
</form>
</body>

</html>
