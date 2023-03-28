
<!DOCTYPE html>
<html lang="fr">

<head>

  <title>Exercice</title>
  <meta charset="UTF-8">
  <link rel="icon" href="images/logo.ico">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <meta name="Choix Exercice" content="Page choix d'exercice" />
  <link rel="stylesheet" type="text/css" href="css/choixExercice.css">
  <link rel="stylesheet" type="text/css" href="css/swiper.css">
  <link rel="stylesheet" href="css/popup.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.css" />
</head>

<body>
  <section class="navigation">
    <div class="nav-container">
      <a href="index.php"><img src="css/images/logo.png" alt="Logo"></a>

      <div class="bouttons">
        <a class="bn14">Progression : <?php echo $A_vue['progression']; ?>/<?php ; ?> </a>
        <a href="index.php?url=Utilisateur/deconnexion" class="bn14">Déconnexion</a>
        <a href="index.php?url=Admin/admin" class="bn14">Admin</a>
      </div>

    </div>
  </section>
