<!DOCTYPE html>

<html lang="fr"> <!--Page de création d'exercice -->
<head>
    <meta charset="utf-8">
    <title>Créer exercice </title>
    <link rel="icon" href="/images/logo.ico">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/creation_modif.css">
</head>
<body>
    <div class="image-container"></div><a href="index.php?url=Admin/checkAdmin"><img src="/images/logo1.png" alt="Logo" class="logo"></a><div/>
    <form method="POST" action="index.php?url=Admin/creerExercice">
        <div class="all-container">
            <div class="left-flex-box">
                <div class="flex-container1">
                    <label for="nom">Titre de l'exercice:</label><br>
                    <textarea id="nom" name="nom" required="required"></textarea><br>
                </div>
                <div class="flex-container2">
                    <label for="description">Description de l'exercice:</label><br>
                    <textarea id="description" name="description" required="required"></textarea><br>
                </div>
                <div class="flex-container3">
                    <label for="objectifs">Objectifs de l'exercice:</label><br>
                    <textarea id="objectifs" name="objectifs" required="required"></textarea><br>
                </div>
                <div class="button">
                    <button name="creer">Confirmer la création</button>
                </div>
            </div>
            <div class="right-flex-box">
                <div class="flex-container4">
                    <label for="contenu">Contenu de l'exercice:</label></br>
                    <textarea id="contenu" name="contenu" required="required"></textarea><br>
                </div>
                <div class="flex-container5">
                    <label for="testsUnitaires">Tests unitaires:</label></br>
                    <textarea id="testsUnitaires" name="testsUnitaires" required="required"></textarea><br>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
