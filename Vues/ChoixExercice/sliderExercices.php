
<!DOCTYPE html>
<html lang="fr">

<head>

    <title>Exercice</title>
    <meta charset="UTF-8">
    <link rel="icon" href="images/logo.ico">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta name="Choix Exercice" content="Page choix d'exercice" />
    <link rel="stylesheet" type="text/css" href="/css/choixExercice.css">
    <link rel="stylesheet" type="text/css" href="/css/swiper.css">
    <link rel="stylesheet" href="/css/popup.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.css" />
</head>

<body>
<section class="navigation">
    <div class="nav-container">
        <div class="image-container">
            <a href="index.php"><img class="logo" src="images/logo1.png" alt="Logo"></a>
        </div>

        <div class="bouttons">

            <div class="progression-container">
                <a class="progression-link"> Votre progression : <?php echo $_SESSION['membre']['exo']; ?>/<?php echo count($A_vue['exercices']); ?></a>
            </div>

            <div class="deconnexion-container">
                <a href="index.php?url=Utilisateur/deconnexion" class="bn14">Déconnexion</a>
            </div>
            <div class="prof-container">
                <a href="index.php?url=Prof" class="bn14">Prof</a>
            </div>

                <?php if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) { ?>
                    <div class="creer-container"><a href="index.php?url=Admin/creer" class="bn14">Créer exercice</a></div>
                <?php }

                else { ?>
                    <div class="admin-container"><a href="index.php?url=Admin/checkAdmin" class="bn14">Admin</a></div>
                <?php }?>


        </div>

    </div>
</section>

<div class="swiper-parent">
<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php
        for ($x = 0; $x < count($A_vue['exercices']); ++$x) {
            echo '<div class="swiper-slide c1">

          <div class="nom-exo">' . $A_vue['exercices'][$x]['nom_exo'] . '</div>
          <div class="description-exo">' . $A_vue['exercices'][$x]['description_exo'] . '</div>
          <div class="image">
';

            if ($x >= 5) {
                echo ' <a class="type-exercice">(Exercice créé par un professeur)<a/>
                <img src="css/images/crayon.png" alt="'.$A_vue['exercices'][$x]['description_exo'] . '">
';
            } else {
                echo '    <img src="/images/'.$A_vue['exercices'][$x]['fichier'].'.png" alt="'.$A_vue['exercices'][$x]['description_exo'] . '">
';
            }

            echo '  </div>
          <a href="index.php?id_exo=' . $A_vue['exercices'][$x]['id_exo'] .'&url=Exo">

            <button class="learn-more" id="button1">
                <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text">voir exo</span>
            </button>
        </a>';

            if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) {
                echo '<a href="index.php?id_exo=' . $A_vue['exercices'][$x]['id_exo'] .'&url=Admin/supprimer ">
            <button class="learn-more2" id="button2">
                <span class="circle2" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text2">supprimer exo</span>
            </button>
        </a>';
            }
            if (isset($_SESSION['userAdmin']) && $_SESSION['userAdmin']) {
                echo '<a href="index.php?id_exo=' . $A_vue['exercices'][$x]['id_exo'] .'&url=Admin/modifier ">
            <button class="learn-more3" id="button3">
                <span class="circle3" aria-hidden="true">
                    <span class="icon arrow"></span>
                </span>
                <span class="button-text3">modifier exo</span>
            </button>

        </a>';
            }
            echo '</div>';
            $_SESSION['id_exo'] = ($A_vue['exercices'][$x]['id_exo']);
            $_SESSION['exercice'] = $A_vue['exercices'][$x];

        }
        ?>


    </div>

    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="js/swiper.js"></script>

<?php
if (!isset($_SESSION['popup'])) {
    echo '<div class="popup">
    <button id="close">&times;</button>
    <h2>Information </h2>
    <p>
        Bonjour <strong>'.htmlentities(trim($_SESSION['membre']['pseudo'])).' </strong> </h3> nous sommes heureux de vous (re)voir. Nous espérons que notre site vous permettra d\'apprendre de nombreuses choses !
    </p>
</div>';
    $_SESSION['popup'] = 1;
}
?>
<!--Script-->
<script src="/js/popup.js"></script>
</body>

</html>
