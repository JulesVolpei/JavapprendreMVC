
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/logo.ico">
    <title> Tableau de score </title>
    <meta name="Tableau des scores" content="Page de tableau des scores" />
    <link rel="stylesheet" type="text/css" href="css/tableau_score.css">
</head>
<body>
<section class="navigation">
    <div class="nav-container">
        <div class="brand">
            <a href="index.php?url=ChoixExercice"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <?php if (isset($exercice['id_exo']) && isset($exercice['description_exo'])) : ?>
            <div id="nom_exo">
                <?= $exercice['id_exo'] ?>. <?= $exercice['description_exo'] ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<table>
    <tr>
        <th>Pseudo</th>
        <th>Temps</th>
    </tr>
    <?php if (isset($tableau_scores)) : ?>
        <?php foreach ($tableau_scores as $score) : ?>
            <tr>
                <td><?= $score['pseudo'] ?></td>
                <td><?= $score['temps'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>


</body>
</html>
