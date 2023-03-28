
<!DOCTYPE html>
<html lang="fr">

<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php
        // Penser à changer le bouton pour voir les exos
        for ($x = 0; $x < count($A_vue['exercices']); ++$x) {
            echo '<div class="swiper-slide c1">
          <div class="nom-exo">' . $A_vue['exercices'][$x]['nom_exo'] . '</div>
          <div class="description-exo">' . $A_vue['exercices'][$x]['description_exo'] . '</div>
          <div class="image">
            <img src="/images/'.$A_vue['exercices'][$x]['fichier'].'.png" alt="'.$A_vue['exercices'][$x]['description_exo'] . '">
          </div>
          <a href="exercice.php?id=' . $x . '">
            <button class="learn-more" id="button1">
              <span class="circle" aria-hidden="true">
                <span class="icon arrow"></span>
              </span>
              <span class="button-text">voir exo</span>
            </button>
          </a>
        </div>';
        }
        ?>

    </div>

    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>


<div class="wrapper">
    <div id="cent">
        <a href="aPropos.html" class="bn14 btn-footer-right">À propos</a>
        <a href="https://github.com/JulesVolpei/Javapprendre" class="bn14 btn-footer-left">GitHub</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="js/swiper.js"></script>


<div class="popup">
    <button id="close">&times;</button>
    <h2>Information </h2>
    <p>
        Bonjour <strong><?php echo htmlentities(trim($_SESSION['membre']['pseudo'])); ?> </strong> </h3> nous sommes heureux de vous (re)voir. Nous espérons que notre site vous permettra d'apprendre de nombreuses choses !
    </p>
</div>
<!--Script-->
<script src="js/popup.js"></script>
</body>

</html>
