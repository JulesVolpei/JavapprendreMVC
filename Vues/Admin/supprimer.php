<!DOCTYPE html>

<head>
    <title>Modifier exercice </title>
    <link rel="icon" href="../images/logo.ico">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- CSS -->
    <link rel="stylesheet" href="css/supprimer.css">
</head>

<form method="POST" action="index.php?url=Admin/supprimerExercice&id_exo=<?php echo $_GET['id_exo']; ?>">
    <div class="button">
        <button name="supprimer">Confirmer la suppression</button>
        <button name="annuler"><a href="index.php?url=ChoixExercice">Annuler la suppression<a/></button>
    <div/>
<form/>
