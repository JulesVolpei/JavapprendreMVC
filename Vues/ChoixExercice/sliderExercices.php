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